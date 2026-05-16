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
        return response()->json($contact);
    }

    //削除
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('admin')->with('status', '削除しました');
    }

    //CSVエクスポート
    public function exportCsv(Request $request)
    {
        $query = Contact::query()->select([
            'id', 'first_name', 'last_name', 'email', 'gender', 'category_id', 'created_at'
        ]);
        //名前検索（姓・名・フルネーム）
        $query->when($request->filled('name'), function ($q) use ($request) {
            $name = $request->name;
            $q->where(function ($q2) use ($name) {
                $q2->where('first_name', 'like', "%{$name}%")
                ->orWhere('last_name', 'like', "%{$name}%")
                ->orWhereRaw("CONCAT_WS(' ', first_name, last_name) LIKE ?",["%{$name}%"]);
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

        $data = $query->with('category')->get();

        $callback = function() use ($data) {
            $file = fopen('php://output', 'w');

            fputcsv($file,['id', 'first_name', 'last_name', 'email', 'gender', 'category_id', 'created_at']);

            foreach ($data as $row) {
                fputcsv($file,[
                    $row->id,
                    $row->first_name,
                    $row->last_name,
                    $row->email,
                    $row->gender,
                    $row->category,
                    $row->created_at
                ]);
            }
            fclose($file);
        };
        return response()->streamDownload($callback, 'inquiries.csv');
    }
}
