@extends('layouts.app')

@section('content')

<div class="container-detalle">
<link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
<script src="{{ asset('js/shop.js') }}" defer></script>

</div>
    <?php foreach($productos as $producto ) { ?>
    <div class="row" style="padding: 5%; padding-top: 0%;">
        <div class="col-6">
            <img class="detalle_img" width="auto" height="auto" src="{{ asset('../storage').'/app/public/'.$producto->url_imagen_producto }}" alt="" >
        </div>
        <div class="col-6">
            <a href="{{ url('/productos') }}">Go back</a>
            <h2 class="h2pro">{{$producto->nombre_producto}}</h2>
            <div class="rw-ui-container"></div>
           <br>
           <br>
            
            <h4>Precio: {{$producto->precio_producto}} </h4>
            <h6>Productos disponibles: {{$producto->existencia_producto}}</h6>
            <br>
            
            <form action="{{ url('addcart',$producto->id_producto) }}" method="POST" >
            @csrf
                <input type="number" value="1" min="1" class="form-control" style="width:100px" name="quantity">                <br>
                
                <button class="btn btn-success addcartbtn">Agregar al carrito</button>
            </form>
        </div>
    </div>
</div>
<?php } ?>
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

