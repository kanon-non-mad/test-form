<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\TestUser;

class AuthorController extends Controller
{
    public function loginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email','password');
        if(Auth::attempt($credentials))
            {
                $request->session()->regenerate();

                //ログイン成功時のリダイレクト先
                return redirect()->intended('admin');
            }
            return back()->withErrors(['email' => 'ログイン情報が登録されていません']);
    }

    //ログアウト処理
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function register(RegisterRequest $request)
    {   
        //ユーザー登録//
        $user = TestUser::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),        
                ]);

                //ログイン状態
                Auth::login($user);  
                $request->session()->regenerate();
            return redirect()->intended(route('admin'));
    }

    public function create()
    {
        return view('register');
    }
}
