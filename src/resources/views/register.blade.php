@extends('layouts.app')

@section('title','register.blade.php')

@section('content')

<div class="contact-form__content">
    <h1 class="contact-title">Register</h1>
    <form class="form" method="POST" action="{{route('login')}}">
        @csrf
        <div class="contact-form__group">
            <p>お名前</p>
            <div class="name-fields">
                <input type="text" name="first_name" placeholder="例：山田" required>
                <input type="text" name="last_name" placeholder="例：太郎" required>
            </div>
        </div>
        <div class="contact-form__group">
            <p>メールアドレス</p>
            <input type="email" id="email" name="email" value="{{old('email')}}" placeholder="text@example.com" required>
        </div>
        <div class="contact-form__group">
            <p>パスワード</p>
            <input type="password" id="password" name="password">
        </div>
        
        <button class="form-button" type="submit">登録</button>
    </form>
</div>

@endsection