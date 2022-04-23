@extends('layouts.app')

@section('content')

<link href="{{ asset('css/estilo.css') }}" rel="stylesheet">
<section class="container1-card-products">
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
                        <h2>{{$producto['nombre_producto']}}</h2>
                        <h4>{{$producto['precio_producto']}}</h4>
                    </div> 
                </div>
            </div>
        <?php } ?>
        <br><br><br>
@endsection