@extends('layouts.app')

@section('title','contact.blade.php')

@section('content')

<div class="contact-form__content">
    <h1 class="contact-title">Contact</h1>
    <form class="form" method="POST" action="{{route('contacts.store')}}">
        @csrf
        <div class="contact-form__group">
            <label class="contact-name">お名前<span class="required">必須</span></label>
            <div class="name-fields">
                <input type="text" name="first_name" placeholder="例：山田" required>
                <input type="text" name="last_name" placeholder="例：太郎" required>
            </div>
        </div>
        <div class="contact-form__group">
            <label class="contact-gender">性別<span class="required">必須</span></label>
            <div class="gender-radio">
                <input type="radio" id="male" name="gender" value="1" required>
                <label for="male">男性</label>
                <input type="radio" id="female" name="gender" value="2">
                <label for="female">女性</label>
                <input type="radio" id="other" name="gender" value="3">
                <label for="othor">その他</label>
            </div>
        </div>
        <div class="contact-form__group">
            <label for="email">メールアドレス<span class="required">必須</span></label>
            <input type="email" id="email" name="email" placeholder="text@example.com" required>
        </div>
        <div class="contact-form__group">
            <label class="contact-tel">電話番号<span class="required">必須</span></label>
            <div class="tel-group">
                <input type="tel" name="tel1" maxlength="5" placeholder="080" required>-
                <input type="tel" name="tel2" maxlength="5" placeholder="1234" required>-
                <input type="tel" name="tel3" maxlength="5" placeholder="5678" required>
            </div>
        </div>
        <div class="contact-form__group">
            <label class="address">住所<span class="required">必須</span></label>
            <input type="text" id="address" name="address" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3" required>
        </div>
        <div class="contact-form__group">
            <label class="building">建物(任意)</label>
            <input type="text" id="building" name="building" placeholder="例：千駄ヶ谷マンション101">
        </div>
        <div class="contact-form__group">
            <label for="type">お問い合わせの種類</label>
            <select id="type" name="type" placeholder="選択してください">
                <option value="" selected>選択してください</option>
                <option value="1">商品のお届について</option>
                <option value="2">商品の交換について</option>
                <option value="3">商品トラブル</option>
                <option value="4">ショップへのお問い合わせ</option>
                <option value="5">その他</option>
            </select>
        </div>
        <div class="contact-form__group">
            <label class="detail">お問い合わせの内容<span class="required">必須</span></label>
            <textarea id="detail" name="detail" maxlength="120" placeholder="お問い合わせの内容をご記載ください" required></textarea>
        </div>
        <button class="form-button" type="submit">確認画面</button>
    </form>
</div>

@endsection