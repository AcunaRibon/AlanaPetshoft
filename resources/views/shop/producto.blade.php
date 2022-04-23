@extends('layouts.app')

@section('content')

<link href="{{ asset('css/estilo.css') }}" rel="stylesheet">
<section class="container1-card-products">
    
    <h1>Catálogo</h1>
    
    <br><br>
        <div class="row">
        <?php foreach($productos as $producto ) { ?>
            <div class="col-3 cd-size"> 
                <div class="card {{$producto['id_producto']==1?'active':''}}">
                <a  href="detalle/{{$producto['id_producto']}}">
                <img
                    title="{{$producto['nombre_producto']}}"
                    class="card-img-top"
                    src="{{$producto['url_imagen_producto']}}">
                    <div class="b-card">
                   
                        <a class="card-title title-tj1"></a>
                        </a> 
                        <br><br>
                        <p class="precio1 ">$  {{$producto['precio_producto']}} </p>
                        
                        <form action=" {{ url('/add_to_cart') }}" method="POST">
                            @csrf
                        <input type="hidden" name="idProducto" id="idProducto" value="{{$producto['id_producto']}}">
                        <input type="hidden" name="nombreProducto" id="nombreProducto" value="{{$producto['nombre_producto']}}">
                        <input type="hidden" name="precioProducto" id="precioProducto" value="{{$producto['precio_producto']}}">
                        <input type="hidden" name="cantidadProducto" id="cantidadProducto" value="{{$producto['1']}}">

                        <button class=" btn-card" name="btnAccion" value="Agregar" type="submit">Agregar al carrito</button>
                        </form>
                    
                    </div> 
                </div>
            </div>
        <?php } ?>
        <br><br><br>
@endsection