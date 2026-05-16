<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\AdminController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//お問い合わせ関連//
//入力画面表示
Route::get('/', [ContactController::class, 'contact'])->name('contact.form');
//入力した内容を確認画面に送信
Route::post('/confirm',[ContactController::class,'confirm'])->name('contact.confirm'); 
//DB保存
Route::post('/thanks',[ContactController::class, 'store'])->name('contact.store');
//thanks画面へ遷移
Route::get('/thanks',[ContactController::class,'thanks'])->name('contact.thanks');

//認証関連//
//新規登録画面表示
Route::get('/register',[AuthorController::class,'create'])->name('register.form');
//入力した内容（新規ユーザー登録）DBに保存
Route::post('/register',[AuthorController::class,'register'])->name('register.store');
//ログイン画面表示
Route::get('/login',[AuthorController::class,'loginForm'])->name('login');
Route::post('/login',[AuthorController::class,'login'])->name('login.store');
//ログアウト
Route::post('/logout',[AuthorController::class,'logout'])->middleware('auth')
          ->name('logout');

//管理関連//
//管理画面
Route::middleware('auth')->prefix('admin')->group(function(){
    //表示・検索
    Route::get('/',[AdminController::class,'admin'])->name('admin');
    //CSV出力
    Route::get('/export-csv',[AdminController::class, 'exportCsv'])->name('admin.export-csv');
    //モーダル表示
    Route::get('/{contact}', [AdminController::class, 'detail'])->name('admin.detail');
    //リセット
    Route::post('/reset',[AdminController::class,'reset'])->name('admin.reset');
    //削除
    Route::delete('/{contact}', [AdminController::class, 'destroy'])->name('admin.destroy');
});