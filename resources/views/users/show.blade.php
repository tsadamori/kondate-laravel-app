@extends('layouts.app')

@include('layouts.navbar')

@section('content')

    <div class="pt-5">
        <p>{!! link_to_route('users.password_change', 'パスワードを変更する') !!}</p>
        <p>{!! link_to_route('users.delete', 'アカウントを削除する') !!}</p>
        <p>{!! link_to_route('logout', 'ログアウト') !!}</p>
    </div>

@endsection