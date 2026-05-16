<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <title>Test-form</title>
</head>
<body>
    <div class="thanks-box">
        <h1>お問い合わせありがとうございました</h1>
        <a class="home-button" href="{{route('contact.form')}}">HOME</a>
    </div>
</body>
</html>