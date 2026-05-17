@extends('layouts.app')

@section('title','admin.blade.php')

@section('content')

<div class="admin-search__content">
    <div class="content__header">
        <h1 class="admin-title">Admin</h1>
        <form class="logout" method="POST" action="{{route('logout')}}">
        @csrf
            <button class="login-button" type="submit">logout</button>
        </form>
    </div>
    <form class="form" method="GET" action="{{route('admin')}}">
        @csrf
        <input type="text" name="name" placeholder="名前やメールアドレスを入力してください" value="{{ request ('name')}}" class="search__form-text">
        <input type="text" name="email" placeholder="メールアドレスを入力してください" value="{{ request('email') }}">

        <select class="search__form-gender" name="gender">
            <option value="">性別</option>
            <option value="1" {{request('gender') == '1' ? 'selected' : ''}}>男性</option>
            <option value="2" {{request('gender') == '2' ? 'selected' : ''}}>女性</option>
            <option value="3" {{request('gender') == '3' ? 'selected' : ''}}>その他</option>
        </select>

        <select class="search__form-type" name="category_id">
            <option value="">お問い合わせの種類</option>
            @foreach($categories as $category)
            <option value="{{$category->id}}"
                {{request('category_id') == $category->id ? 'selected' : ''}}>
                {{$category->content}}
            </option>
            @endforeach
        </select>

        <input type="date" name="date_from" value="{{request('date_from')}}">
        <input type="date" name="date_to" value="{{request('date_to')}}">

        <div class="search-button">
            <button type="submit" class="search-button">検索</button>
            <button type="reset" class="reset-button">リセット</button>
        </div>
    </form>
    <div class="admin__content-table">
        @if($contacts->count())
        <table class="admin__contact-table">
            <thead>
            <tr class="admin-table__row">
                <th class="admin-table__header">お名前</th>
                <th class="admin-table__header">性別</th>
                <th class="admin-table__header">メールアドレス</th>
                <th class="admin-table__header">お問い合わせの種類</th>
            </tr>
        </thead>
        <tbody>
        @foreach($contacts as $contact)
        <tr class="admin-table__content">
            <td class="admin-table__border">{{$contact->first_name}}
            {{$contact->last_name}}
            </td>
            <td class="admin-table__border">
                @if($contact['gender'] == 1) 男性
                @elseif($contact['gender'] == 2) 女性
                @else
                その他
                @endif
            </td>
            <td class="admin-table__border">{{$contact->email}}</td>
            <td class="admin-table__border">{{$contact->category->content}}</td>
            <td class="admin-table__border">
            <button class="admin__modal" type="button" onclick="openModal({{$contact->id}})">詳細</button>
            </td>
        </div>    
        </tr>
        <div class="admin__modal-content" id="modal-{{$contact->id}}">
            <div class="modal-content">
                <button class="modal-close" type="button" onclick="closeModal({{$contact->id}})">
                    ×
                </button>
                <table class="modal__content">
                    <tr class="modal-inner">
                        <th class="modal-title">お名前</th>
                        <td class="modal-data">
                            {{$contact['first_name']}}
                            {{$contact['last_name']}}
                        </td>
                    </tr>
                    <tr class="modal-inner">
                        <th class="modal-title">性別</th>
                        <td class="modal-data">
                            @if($contact['gender'] == 1) 男性
                            @elseif($contact['gender'] == 2) 女性
                            @else
                            その他
                            @endif
                        </td>
                    </tr>
                    <tr class="modal-inner">
                        <th class="modal-title">メールアドレス</th>
                        <td class="modal-data">
                            {{$contact['email']}}
                        </td>
                    </tr>
                    <tr class="modal-inner">
                        <th class="modal-title">電話番号</th>
                        <td class="modal-data">
                            {{$contact['tel']}}
                        </td>
                    </tr>
                    <tr class="modal-inner">
                        <th class="modal-title">住所</th>
                        <td class="modal-data">
                            {{$contact['address']}}
                        </td>
                    </tr>
                    <tr class="modal-inner">
                        <th class="modal-title">建物名</th>
                        <td class="modal-data">
                            {{$contact['building']}}
                        </td>
                    </tr>
                    <tr class="modal-inner">
                        <th class="modal-title">お問い合わせの種類</th>
                        <td class="modal-data">
                            {{$contact->category->content}}
                        </td>
                    </tr>
                    <tr class="modal-inner">
                        <th class="modal-title">お問い合わせ内容</th>
                        <td class="modal-data">
                            {{$contact['detail']}}
                         </td>
                    </tr>
                </table>
                <form class="delete-form" 
                action="{{route('admin.destroy',$contact)}}" method="POST">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" name="id" value="{{$contact['id']}}">
                    <button class="modal-delete">削除
                    </button>
                </form>
            </div>
        </div>
            @endforeach
        </tbody>
        </table>
        @endif
    </div>
</div>

<script>
    function openModal(id)
    {
        document.getElementById('modal-' + id)
        .style.display = 'block';
    }

    function closeModal(id)
    {
       document.getElementById('modal-' + id)
        .style.display = 'none'; 
    }
    </script>
@endsection