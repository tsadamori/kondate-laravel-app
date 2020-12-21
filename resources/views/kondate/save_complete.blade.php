@extends('layouts.app')

@include('layouts.navbar')

@section('content')

<div class="container pt-5">
    <p>献立リストを保存しました。</p>
    {!! link_to_route('/', 'TOPに戻る', [], ['class' => 'btn btn-secondary btn-sm btn-block mb-2']) !!}
    {!! link_to_route('kondate.history', '献立リストを見る', [], ['class' => 'btn btn-pink btn-sm btn-block']) !!}
</div>

@endsection