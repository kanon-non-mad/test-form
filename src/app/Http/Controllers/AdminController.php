<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class AdminController extends Controller
{
    public function admin(Request $request)
    {
        $query = Contact::query()->select([
            'id', 'first_name', 'last_name', 'email', 'gender', 'category_id', 'created_at'
        ]);

        //名前検索（姓・名・フルネーム）
        $query->when($request->filled('name'), function ($q) use ($request) {
            $name = $request->name;
            $q->where(function ($q2) use ($name) {
                $q2->where('first_name', 'like', "%{$name}%")
                ->orwhere('last_name', 'like', "%{$name}%")
                ->orwhereRaw("CONCAT_WS(' ', first_name, last_name) LIKE ?",["%{$name}%"]);
            });
        });

        //メール検索
        $query->when($request->filled('email'), function ($q) use ($request){
            $q->where('email', 'like', "%{$request->email}%");
        });

        //性別検索
        $query->when($request->filled('gender'), function ($q) use ($request) {
            if($request->gender !== 'all') {
            $q->where('gender', $request->gender);
            }
        });

        //お問い合わせ種類検索
        $query->when($request->filled('category_id'), function ($q) use ($request) {
            $q->where('category_id', $request->category_id);
        });

        //日付検索
        $query->when($request->filled('date_from'), function ($q) use ($request) {
            $q->whereDate('created_at', '>=',$request->date_from);
        });
        $query->when($request->filled('date_to'), function ($q) use ($request) {
            $q->whereDate('created_at', '<=',$request->date_to);
        });

        //ページネーション
        $contacts = $query->orderByDesc('created_at')->paginate(7)->appends($request->except('page'));

        return view('admin',[
            'categories' => Category::all(),
            'contacts' => $contacts,
            'request' => $request->all(),
        ]);
    }

    //モーダル表示
    public function detail(Contact $contact)
    {
        return response()->json([
            'id' => $contact->id,
            'first_name' => $contact->first_name,
            'last_name' => $contact->last_name,
            'gender' => $contact->gender,
            'email' => $contact->email,
            'tel' => $contact->tel,
            'address' => $contact->address,
            'building' => $contact->address,
            'category_id' => $contact->category_id,
            'detail' => $contact->detail
        ]);
    }

    //削除
    public function destroy($id)
    {
        Contact::findOrFail($id)->delete();
        return redirect()->route('admin')->with('status', '削除しました');
    }  
}
