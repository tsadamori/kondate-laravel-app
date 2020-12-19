@extends('layouts.app')

@include('layouts.navbar')

@section('content')
<div class="container pt-5">
    <h1 class="h3 mb-3">{{ $menu->name }}</h1>
    <hr>
    <div>
        <a href="../img/{{ $menu->img_name }}">
            @if ($menu->img_name)
                <img src="../img/{{ $menu->img_name }}" alt="{{ $menu->name }}" width="100" height="100">
            @else
                <img src="../img/no-image.png" alt="no-image" width="200" height="200">
            @endif
        </a>
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
    <a href="{{ $menu->outside_link }}" target="_blank">{{ $menu->outside_link }}</a></td>
    <hr>
    {!! Form::model($menu, ['route' => ['menus.destroy', $menu->id], 'method' => 'delete']) !!}
        {!! link_to_route('/', 'TOPに戻る', [], ['class' => 'btn btn-sm btn-pink2 btn-block']) !!}
        {!! link_to_route('menus.edit', '編集する', [$menu->id], ['class' => 'btn btn-sm btn-pink btn-block']) !!}
        {!! Form::submit('削除する', ['class' => 'btn btn-sm btn-danger btn-block']) !!}
    {!! Form::close() !!}
</div>
@endsection