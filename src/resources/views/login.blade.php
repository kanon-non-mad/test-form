@extends('layouts.app')

@section('title','login.blade.php')

@section('content')

<div class="contact-form__content">
    <h1 class="contact-title">Login</h1>
    <form class="form" method="POST" action="{{route('login')}}">
        @csrf
        
        <div class="contact-form__group">
            <p>メールアドレス</p>
            <input type="email" id="email" name="email" value="{{old('email')}}" placeholder="text@example.com" required>
        </div>
        <div class="contact-form__group">
            <p>パスワード</p>
            <input type="password" id="password" name="password">
        </div>
        
        <button class="form-button" type="submit">ログイン</button>
    </form>
</div>

@endsection