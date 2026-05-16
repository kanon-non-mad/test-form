<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\DB;

use App\Models\Category;
use App\Models\Contact;

class ContactController extends Controller
{
    //入力画面表示//
    public function contact()
    {
        $categories = Category::all();
        return view('contact',['categories' => $categories]);
    }

    //入力内容を確認画面へ送信//
    public function confirm(ContactRequest $request)
    {
        $contact = $request->all();

        $category = Category::find($request->category_id);

        return view('confirm',['contact' => $contact,'category' => $category]);
    }

    //DB保存
    public function store(ContactRequest $request)
    {
        Contact::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'email' => $request->email,
            'tel' => $request->tel1 .
                     $request->tel2 .
                     $request->tel3,
            'address' => $request->address,
            'building' => $request->building,
            'category_id' => $request->category_id,
            'detail' => $request->detail,
        ]);

        return redirect()->route('contact.thanks');
    }

    public function thanks()
    {
        return view('thanks');
    }

    public function update(ContactRequest $request)
    {
        $content;

        return redirect('contact.form');
    }

}
