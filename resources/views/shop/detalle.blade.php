@extends('layouts.app')

@section('content')

<div class="container-detalle">
<link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
<script src="{{ asset('js/calificaciones.js') }}" defer></script>


    <div class="row datos_productos">
    <div>
@if (session('status'))
        @if (session('status')==1)
            <div class="alert alert-success">
                Producto agregado al carrito
            </div>
            @endif
    @endif
</div>
    <?php foreach($productos as $producto ) { ?>
        <div class="col-sm-6">
        <img class="detalle_img" width="auto" height="auto" src="{{ asset('../storage').'/app/public/'.$producto->url_imagen_producto }}" alt="" >
        </div>
        <div class="col-sm-6">
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

