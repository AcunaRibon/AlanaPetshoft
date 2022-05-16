@extends('layouts.app')

@section('content')

<link href="{{ asset('css/estilo.css') }}" rel="stylesheet">
<script src="{{ asset('js/shop.js') }}" defer></script>
<section class="container1-card-products">
    
    <h1>Catálogo</h1>
    
    <br><br>
        <div class="row">
        <?php foreach($productos as $producto ) { ?>
            <div class="col-3 cd-size" width="auto" height="auto"> 
                <div class="card {{$producto->id_producto==1?'active':''}}">
                <a  href="detalle/{{$producto->id_producto}}">
                <center>
                <img
                    title="{{$producto-> nombre_producto}}"
                    src="{{ asset('../storage').'/app/public/'.$producto->url_imagen_producto }}"
                    height="250px" width="200px"
                    ></center>
                    <div class="b-card">
                   
                        <a class="card-title title-tj1">{{$producto-> nombre_producto}}</a>
                        </a> 

                        <br><br>
                        <p class="precio1 ">$  {{$producto-> precio_producto}} </p>
                        
                        <form action="{{ url('addcart',$producto->id_producto) }}" method="POST">
                            @csrf
                        <input type="hidden" name="idProducto" id="idProducto" value="{{$producto-> id_producto}}">
                        <input type="hidden" name="nombreProducto" id="nombreProducto" value="{{$producto-> nombre_producto}}">
                        <input type="hidden" name="precioProducto" id="precioProducto" value="{{$producto-> precio_producto}}">
                        <input type="hidden" name="cantidadProducto" id="cantidadProducto" value="{{$producto-> existencia_producto}}">

                        <input type="hidden" value="1" min="1" class="form-control" style="width:100px" name="quantity">
                        <button class="btn-card" data-toggle="modal" value="Agregar" type="submit">Agregar al carrito</button>

                        </form>
                    </div> 
                </div>
            </div>
        <?php } ?>
        </div>

<br><br><br>
@endsection


@section('css')
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;700&display=swap" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.css" />
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@stop

@section('js')
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.js" defer></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/tablas.js') }}" defer></script>

<input value="el producto" id="mensajeAlerta" hidden>
<input value="Producto" id="mensajeAlerta1" hidden>
<input value="El producto" id="mensajeAlerta2" hidden>
@if (session('status'))
@if (session('status') == 'registrado')
<input value="registrado" id="tipoAlerta" hidden>
@elseif (session('status') == 'actualizado')
<input value="actualizado" id="tipoAlerta" hidden>
@elseif (session('status') == 'listado')
<input value="listado" id="tipoAlerta" hidden>
@else
<input value="error" id="tipoAlerta" hidden>
@endif
@endif
<script src="{{ asset('js/alertas.js') }}"></script>
@stop