@extends('layouts.app')

@section('title','confirm.blade.php')

@section('content')

<div class="confirm__content">
    <div class="confirm__heading">
        <h1 class="confirm-title">Confirm</h1>
    </div>
    <form class="form-post" action="{{route('contact.store')}}" method="post">
    @csrf
    <div class="confirm-table">
        <table class="confirm-table__inner">
            <tr class="confirm-table__row">
                <th class="confirm-table__header">お名前</th>
                <td class="confirm-table__text">
                    {{$contact['first_name'] }}{{$contact['last_name']}}
                    <input type="hidden" name="first_name" value="{{$contact['first_name'] }}"><input type="hidden" name="last_name" value="{{$contact['last_name'] }}">
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__header">性別</th>
                <td class="confirm-table__text">
                    @if($contact['gender'] == 1) 男性
                    @elseif($contact['gender'] == 2) 女性
                    @else
                    その他
                    @endif
                    <input  type="hidden" name="gender" value="{{$contact['gender']}}">
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__header">メールアドレス</th>
                <td class="confirm-table__text">
                    {{$contact['email'] }}
                    <input type="hidden" name="email" value="{{$contact['email'] }}" readonly/>
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__header">電話番号</th>
                <td class="confirm-table__text">
                    {{$contact['tel1'] }}{{$contact['tel2'] }}{{$contact['tel3'] }}
                    <input type="hidden" name="tel1" value="{{$contact['tel1'] }}">
                    <input type="hidden" name="tel2" value="{{$contact['tel2'] }}">
                    <input type="hidden" name="tel3" value="{{$contact['tel3'] }}">
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__header">住所</th>
                <td class="confirm-table__text">
                    {{$contact['address'] }}<input type="hidden" name="address" value="{{$contact['address'] }}" readonly/>
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__header">建物名</th>
                <td class="confirm-table__text">
                    {{$contact['building'] }}<input type="hidden" name="building" value="{{$contact['building'] }}" readonly/>
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__header">お問い合わせの種類</th>
                <td class="confirm-table__text">
                    {{$category->content}}
                 <input type="hidden" name="category_id" value="{{ $contact['category_id']}}">   
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__header">お問い合わせ内容</th>
                <td class="confirm-table__text">
                    {{$contact['detail'] }}
                    <input type="hidden" name="detail" value="{{$contact['detail'] }}" readonly/>
                </td>
            </tr>
        </table>
    </div>
    <div class="confirm-submit__button">
        <button class="form__button" type="submit">送信</button>
    </form>
        <form class="form-get" action="{{route('contact.form')}}" method="GET">
        <button class="update__button" type="submit" onclick="history.back();">修正</button>
        </form>
    </div>
</div>
@endsection