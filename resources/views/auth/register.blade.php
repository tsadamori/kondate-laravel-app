@extends('layouts.app')

@section('content')
<div class="mb-5">
    <div class="text-center mt-5">
        <h1 class="h3 mb-3">ユーザ登録</h1>
    </div>
    {!! Form::open(['route' => 'signup.post']) !!}
        <div class="mb-5">
            <div class="form-group">
                {!! Form::label('name', '名前') !!}
                {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
            </div>
            @error('name')
                <p class="alert alert-danger" role="alert">{{ $message }}</p>
            @enderror
            <div class="form-group">
                {!! Form::label('email', 'メールアドレス') !!}
                {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
            </div>
            @error('email')
                <p class="alert alert-danger" role="alert">{{ $message }}</p>
            @enderror
            <div class="form-group">
                {!! Form::label('password', 'パスワード') !!}
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('password_confirmation', 'パスワード（確認）') !!}
                {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
            </div>
            @error('password')
                <p class="alert alert-danger" role="alert">{{ $message }}</p>
            @enderror
            @error('password_confirmation')
                <p class="alert alert-danger" role="alert">{{ $message }}</p>
            @enderror
            </div>
        <div>
        <div>
            {!! Form::submit('新規登録', ['class' => 'btn btn-block btn-pink mb-3']) !!}
            <p class="mb-0">>> ログインは{!! link_to_route('login', 'こちら') !!}</p>
            <p>>> {!! link_to_route('/', 'TOPに戻る') !!}</p>
        </div>

        {!! Form::close() !!}

    </div>
</div>
@endsection