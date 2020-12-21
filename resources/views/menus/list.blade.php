@extends('layouts.app')

@include('layouts.navbar')

@section('content')
<div class="container pt-5">
    <h1 class="h2 mb-3">買い物リスト</h1>
    <div id="kondate_list">
        {!! Form::model($kondate, ['id' => 'kondate-save-form', 'route' => ['kondate.save'], 'method' => 'post']) !!}
            <ul class="list-unstyled">
@foreach($ingredients_list as $id => $ingredient)
                <p>{{ $ingredient['name'] }}</p>
                <input type="hidden" name="id[]" value="{{ $id }}">
@foreach($ingredient['ingredient'] as $value)
                <li>
                    <label>
                        <input type="checkbox" class="mr-2">
                        <span>{{ $value[0] }} {{ $value[1] }}</span>
                    </label>
                </li>
@endforeach
@endforeach
            </ul>
            <div id="btn-area">
                <a href="/"><button type="button" class="btn btn-secondary btn-sm btn-block mb-2">TOPに戻る</button></a>
                {!! Form::submit('買い物リストを保存する', ['id' => 'save-btn', 'class' => 'btn btn-pink btn-sm btn-block mb-2']) !!}
                {!! Form::button('編集する', ['id' => 'edit-btn', 'class' => 'btn btn-pink2 btn-sm btn-block mb-2']) !!}
                {!! Form::button('完了', ['id' => 'complete-btn', 'class' => 'btn btn-pink2 btn-sm btn-block mb-2']) !!}
            </div>
        {!! Form::close() !!}
    </div>
</div>

@endsection