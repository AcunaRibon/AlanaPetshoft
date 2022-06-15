@extends('layouts.app')

@section('content')

<link href="{{ asset('css/estilo.css') }}" rel="stylesheet">

<div class="box">
    <div class="boxup">
        <img src="{{ asset('images/lupa.png') }}" alt="">
    </div>
    <div class="boxdown">
        <h1 class="success">Ooopss...</h1>
        <p>No encontramos ese producto, pero seguro que puedes encontrar productos similares en nuestro catálogo</p>
    </div>
    <div class="btn">
        <a class="btn btn-success" href="{{ url('/productos') }}">Catálogo</a>
    </div>
</div>

@endsection