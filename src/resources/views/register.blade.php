@extends('layouts.app')

@section('title','register.blade.php')

@section('content')

<div class="contact-form__content">
    <h1 class="contact-title">Register</h1>
    <a class="login-button" href="{{route('login')}}">login</a>
    <form class="form" method="POST" action="{{route('register.store')}}">
        @csrf
        <div class="contact-form__group">
            <p>お名前</p>
            @error('name')
            <p class="error">{{$message}}</p>
            @enderror
            <div class="name-fields">
                <input type="text" name="name" placeholder="例：山田 太郎" required>
            </div>
        </div>
        <div class="contact-form__group">
            <p>メールアドレス</p>
            @error('email')
            <p class="error">{{$message}}</p>
            @enderror
            <input type="email" id="email" name="email" value="{{old('email')}}" placeholder="text@example.com" required>
        </div>
        <div class="contact-form__group">
            <p>パスワード</p>
            @error('password')
            <p class="error">{{$message}}</p>
            @enderror
            <input type="password" id="password" name="password" required>
        </div>
        
        <button class="form-button" type="submit">登録</button>
    </form>
</div>

@endsection