@extends('layouts.app')

@include('layouts.navbar')

@section('content')
<div class="container pt-5">
    <h1 class="h3 mb-3">{{ $menu->name }}</h1>
    <hr>
    <div>
        @if ($menu->img_name)
            <a href="/img/upload/{{ $menu->img_name }}">
                <img src="/img/upload/{{ $menu->img_name }}" alt="{{ $menu->name }}" width="200" height="200">
            </a>
        @else
            <a href="/img/no-image.png">
                <img src="/img/no-image.png" alt="no-image" width="200" height="200">
            </a>
        @endif
    </div>
    <hr>
    <div>
        <p class="head">内容</p>
        <p>{{ $menu->content }}</p>
    </div>
    <hr>
    <div>
        <p class="head">材料</p>
        <ul>
        @foreach($ingredients as $ingredient)
            <li>{{ $ingredient['ingredient'] }} {{ $ingredient['count'] }}</li>
        @endforeach
        </ul>
    </div>
    <hr>
    <div>
        <p class="head">カテゴリ</p>
        <ul>
            <li>1:　{{ $menu->category1_mod }}</li>
            <li>2:　{{ $menu->category2_mod }}</li>
        </ul>
    </div>
    <hr>
    <p class="head">外部リンク</p>
    @if (!empty($menu->outside_link))
        <a href="{{ $menu->outside_link }}" target="_blank"><p>{{ $menu->outside_link }}</p></a>
    @else
        <p>なし</p>
    @endif
    <hr>
    {!! Form::model($menu, ['route' => ['menus.destroy', $menu->id], 'method' => 'delete']) !!}
        {!! link_to_route('/', 'TOPに戻る', [], ['class' => 'btn btn-sm btn-pink2 btn-block mb-2']) !!}
        {!! link_to_route('menus.edit', '編集する', [$menu->id], ['class' => 'btn btn-sm btn-pink btn-block mb-2']) !!}
        {!! Form::submit('削除する', ['class' => 'btn btn-sm btn-danger btn-block']) !!}
    {!! Form::close() !!}
</div>
@endsection