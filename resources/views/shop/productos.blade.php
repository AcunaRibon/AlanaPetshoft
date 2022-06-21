@extends('layouts.app')

@section('title', 'Catalogo')

@section('content')


<div class="container1-card-products">

    <h1>Catálogo</h1>

    <br><br>
    <div class="row">

        <?php foreach ($productos as $producto) { ?>
            <div class="col-3 cd-size" width="auto" height="auto">
                <div class="card ">
                    <a href="detalle/{{$producto->id_producto}}">

                        @foreach($imagenes as $imagen)
                        <?php if ($imagen->producto_id == $producto->id_producto) { ?>
                            <img title="{{$producto-> nombre_producto}}" src="{{ asset('../storage').'/app/public/'.$imagen->url_imagen_producto }}">
                        <?php
                        }
                        ?>
                        @endforeach

                    </a>
                    <div class="card-body">
                        <h5 class="card-title">{{$producto-> nombre_producto}}</h5>

                        <p class="precio1 ">$ {{$producto-> precio_producto}} </p>

                        <form action="{{ route('shop.addcart',$producto->id_producto) }}" method="POST">
                            @csrf
                            <input type="hidden" name="idProducto" id="idProducto" value="{{$producto-> id_producto}}">
                            <input type="hidden" name="nombreProducto" id="nombreProducto" value="{{$producto-> nombre_producto}}">
                            <input type="hidden" name="precioProducto" id="precioProducto" value="{{$producto-> precio_producto}}">
                            <input type="hidden" name="cantidadProducto" id="cantidadProducto" value="{{$producto-> existencia_producto}}">

                            <input type="hidden" value="1" min="1" class="form-control" style="width:100px" name="quantity">
                            <button class="btn-card registrar" data-toggle="modal" value="Registrar" type="submit">Agregar al carrito</button>

                        </form>
                    </div>




                </div>
            </div>
        <?php } ?>
    </div>



    <br><br><br>
    </div>
    @endsection
   
 
   @section('js')
  
    <input value="el producto" id="mensajeAlerta" hidden>
    <input value="Producto" id="mensajeAlerta1" hidden>
    <input value="El producto" id="mensajeAlerta2" hidden>

    @if (session('status'))
    @if (session('status') == 'registrado')
    <input value="registrado" id="tipoAlerta" hidden>
    @elseif (session('status') == 'Producto Agregado')
    <input value="Producto Agregado" id="tipoAlerta" hidden>
    @else
    <input value="error" id="tipoAlerta" hidden>
    @endif
    @endif
    
    
   @stop
    