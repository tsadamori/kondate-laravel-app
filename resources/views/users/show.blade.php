@extends('layouts.app')

@include('layouts.navbar')

@section('content')

    <div class="pt-5">
        <!-- <p>{!! link_to_route('users.password_change', 'パスワードを変更する') !!}</p> -->
        <!-- <p>{!! link_to_route('users.delete', 'アカウントを削除する') !!}</p> -->
        {!! Form::model('users', [
            'route' => ['users.delete', Auth::id()],
            'method' => 'post',
            'id' => 'user-form'
        ]) !!}
        <!-- <p id="user-delete-btn"><a href="">アカウントを削除する</a></p> -->
        {!! Form::button('アカウントを削除する', ['class' => 'btn btn-sm btn-danger mb-3', 'id' => 'user-delete-btn']) !!}
        <p>{!! link_to_route('logout', 'ログアウト') !!}</p>
        {!! Form::close() !!}
    </div>

@endsection