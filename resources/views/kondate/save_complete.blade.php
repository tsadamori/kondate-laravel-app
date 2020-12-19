@extends('layouts.app')

@include('layouts.navbar')

@section('content')

<div class="container pt-5">
    <p>献立リストを保存しました。</p>
    <a href="/"><button type="button" class="btn btn-secondary btn-sm">TOPに戻る</button></a>
    <a href="{{ route('kondate.history') }}"><button type="button" class="btn btn-pink btn-sm">献立リストを見る</button></a>
</div>

@endsection