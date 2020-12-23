@extends('layouts.app')

@include('layouts.navbar')

@section('content')

    <div class="pt-5">
        <p>{{ $user->name }}</p>
        {!! link_to_route('users.edit', 'プロフィールを変更する') !!}
        {!! Form::model('users', [
            'route' => ['users.delete', Auth::id()],
            'method' => 'post',
            'id' => 'user-form'
        ]) !!}
            @csrf
            {!! Form::button('アカウントを削除する', ['class' => 'btn btn-sm btn-danger mb-3', 'id' => 'user-delete-btn']) !!}
            <p>{!! link_to_route('logout', 'ログアウト') !!}</p>
        {!! Form::close() !!}
    </div>

@endsection