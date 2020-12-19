@extends('layouts.app')

@include('layouts.navbar')

@section('content')

<div class="pt-5">
    @include('menus.kondate')
    
    @include('menus.menus')
</div>

@endsection