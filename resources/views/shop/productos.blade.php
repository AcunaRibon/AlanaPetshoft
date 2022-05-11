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
                <img
                    title="{{$producto-> nombre_producto}}"
                    src="{{ asset('../storage').'/app/public/'.$producto->url_imagen_producto }}"
                    height="250px" width="200px"
                    >
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
                        <button class="btn-card" data-toggle="modal" data-target="#myModal" name="btnAccion" value="Agregar" type="submit">Agregar al carrito</button>

                        <!-- Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                            </div>
                        </div>
                        </div>
                        </form>
                    </div> 
                </div>
            </div>
        <?php } ?>
        </div>

<br><br><br>
@endsection