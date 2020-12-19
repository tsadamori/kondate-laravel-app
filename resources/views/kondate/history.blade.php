@extends('layouts.app')

@include('layouts.navbar')

@section('content')
<div class="container pt-5">
    <h1 class="h3">献立リスト</h1>
    <hr>
@if (count($kondate) !== 0)
    <div id="kondate-history">
        <ul id="kondate-history-list">
@foreach ($kondate as $value)
            <li class="mb-2 d-flex justify-content-between">
                <div>
                    <a href="history/{{ $value->id }}">
                        {{ $value->created_at->format('Y年m月d日') }}
                    </a>
                </div>
                <div>
                    {!! Form::button('削除', [
                        'class' => 'kondate_delete_btn btn btn-sm btn-danger',
                        'data-id' => $value->id
                    ]) !!}
                </div>
            </li>
@endforeach
        </ul>
    </div>
@else
    <p>献立リストはまだありません</p>
@endif
    <hr>
    {!! link_to_route('/', 'TOPに戻る', [], ['class' => 'btn btn-secondary btn-sm btn-block w-75 mx-auto']) !!}
</div>
@endsection