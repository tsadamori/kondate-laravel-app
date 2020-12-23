@extends('layouts.app')

@section('content')
<div class="mb-5">
    <div class="text-center mt-5">
        <h1 class="h3 mb-3">ログイン</h1>
    </div>

    {!! Form::open(['route' => 'login.post']) !!}
        @csrf
        <div class="mb-5">
            <div class="form-group">
                {!! Form::label('email', 'メールアドレス') !!}
                {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
            </div>
            @error('email')
                <p class="alert alert-danger mb-3" role="alert">{{ $message }}</p>
            @enderror

            <div class="form-group">
                {!! Form::label('password', 'パスワード') !!}
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>
            @error('password')
                <p class="alert alert-danger mb-3" role="alert">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            {!! Form::submit('ログイン', ['class' => 'btn btn-block btn-pink mb-3']) !!}
            <div class="text-right">
            <a href="/login/google" role="button">
                <img src="{{ asset('img/btn_google_signin_dark_normal_web.png') }}" alt="google-login">
            </a>
            </div>
        </div>
    {!! Form::close() !!}

    <p class="mb-0">>> 新規ユーザ登録は{!! link_to_route('signup.get', 'こちら') !!}</p>
    <p>>> {!! link_to_route('/', 'TOPに戻る') !!}</p>
</div>
@endsection