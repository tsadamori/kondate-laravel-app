@extends('layouts.app')

@include('layouts.navbar')

@section('content')
<div class="pt-5">
<h1 class="h3 mb-3">{{ $kondate->created_at->format('Y年m月d日') }}</h2>
<hr>
@for($i = 0; $i < count($menu_array['name']); $i++)
    <div>
        <h2 class="h4">{{ $menu_array['name'][$i] }}</h2>
        <ul>
@foreach($menu_array['ingredients'][$i] as $ingredient)
            <li>{{ $ingredient[0] }} {{ $ingredient[1] }}</li>
@endforeach
        </ul>
    </div>
    <hr>
@endfor
{!! link_to_route('kondate.history', '一覧に戻る', [], ['class' => 'btn btn-secondary btn-sm']) !!}
</div>
@endsection