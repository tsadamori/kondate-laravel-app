@extends('layouts.app')

@include('layouts.navbar')

@section('content')

    <div class="pt-5">
        <h1 class="h3">マイページ</h1>
        <hr>
        <div class="row mb-5">
            <div class="col-12 col-lg-6">
                <p>{{ $user->name }}</p>
                @if ($user->img_name)
                    <p><img src="img/profile/{{ $user->img_name }}" alt="profile" width="200" height="200"></p>
                @else
                    <p><img src="img/no-image.png" alt="no-image" width="200" height="200"></p>
                @endif
            </div>
            <div class="col-12 col-lg-6">
                <p class="mb-3">プロフィール</p>
                <p>{{ $user->profile }}</p>
            </div>
        </div>

        {!! Form::model('users', [
            'route' => ['users.delete', Auth::id()],
            'method' => 'post',
            'id' => 'user-form'
        ]) !!}
            @csrf
            {!! link_to_route('users.edit', 'プロフィールを変更する', [], ['class' => 'btn btn-sm btn-pink btn-block mb-2']) !!}
            {!! Form::button('アカウントを削除する', ['class' => 'btn btn-sm btn-danger btn-block mb-2', 'id' => 'user-delete-btn']) !!}
            <p>{!! link_to_route('logout', 'ログアウト', [], ['class' => 'btn btn-sm btn-secondary btn-block']) !!}</p>
        {!! Form::close() !!}
    </div>

@endsection