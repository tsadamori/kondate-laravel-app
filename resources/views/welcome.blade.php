@extends('layouts.app')

@section('content')
<div class="center">
    <div class="text-center mt-5">
        <h1 class="h2 mb-3">This is <br class="d-block d-sm-none">the 献立アプリ</h1>
        <p class="mb-5">〜自分の献立を登録して、日々の料理を楽しく〜</p>
        {!! link_to_route('signup.get', '新規登録', [], ['class' => 'btn btn-pink btn-block']) !!}
        {!! link_to_route('login', 'ログイン', [], ['class' => 'btn btn-pink2 btn-block']) !!}
    </div>
</div>
@endsection