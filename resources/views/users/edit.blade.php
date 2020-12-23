@extends('layouts.app')

@include('layouts.navbar')

@section('content')

    <div class="pt-5">
        <h1 class="h3 mb-5">編集</h1>
        <div id="edit-form">
            {!! Form::model($user, ['enctype' => 'multipart/form-data', 'route' => ['users.update', $user->id], 'method' => 'put']) !!}
                @csrf
                <div class="form-group">
                    {!! Form::label('name', 'ユーザ名（必須）') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('file', 'プロフィール画像を変更', ['class' => 'btn btn-sm btn-pink image-btn']) !!}
                    {!! Form::file('file', ['class' => 'd-none', 'accept' => 'image/*', 'onchange' => 'onChangeFileInput(this)']) !!}
                    <div id="thumbnail" class="mt-2 mb-4">
                        @if ($user->img_name)
                            <img id="thumbnail-img" src="../../img/upload/{{ $user->img_name }}" height="150">
                        @else
                            <img id="thumbnail-img" src="../../img/no-image.png" height="150">
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('profile', 'プロフィール:') !!}
                    {!! Form::textarea('profile', null, ['class' => 'form-control']) !!}
                </div>
                
                {{ link_to_route('/', 'TOPに戻る', [], ['class' => 'btn btn-sm btn-secondary btn-block mb-2']) }}
                {!! Form::submit('更新', ['class' => 'btn btn-sm btn-pink btn-block']) !!}
            {!! Form::close() !!}
        </div>
    </div>

@endsection