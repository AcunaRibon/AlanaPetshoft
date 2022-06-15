@extends('layouts.app')

@section('content')

<link href="{{ asset('css/estilo.css') }}" rel="stylesheet">

<div class="box">
    <div class="boxup">
        <img src="{{ asset('images/carritovacio.png') }}" alt="">
    </div>
    <div class="boxdown">
        <h1 class="success">Ooopss...</h1>
        <p>Debes agregar productos al carrito desde el catálogo para continuar con la compra</p>
    </div>
    <div class="btn">
        <a class="btn btn-success" href="{{ url('/productos') }}">Agregar productos</a>
    </div>
</div>

@endsection