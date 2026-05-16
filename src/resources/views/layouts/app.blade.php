<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    @yield('css')
    <title>Test-form</title>
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="{{route('contact.form')}}">FashionablyLate</a>
        </div>
    </header>

    <main>
        @error('content')
        <div class="alert-error">
            {{$message}}
        </div>
        @enderror

        @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
        @endif
        @yield('content')
    </main>
</body>
</html>