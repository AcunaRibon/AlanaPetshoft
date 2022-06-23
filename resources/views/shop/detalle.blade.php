@extends('layouts.app')

@section('content')

<div class="container-detalle">
    <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
    <script src="{{ asset('js/shop.js') }}" defer></script>

</div>

<div id="panel-control" class="row" style="padding: 5%; padding-top: 0%;">
    <div class="col-6">


        <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">

            <div class="carousel-inner">
                @foreach($imagenes as $imagen)
                <?php if ($imagen->producto_id == $producto[0]->id_producto) { ?>
                    <div class="carousel-item active" data-bs-interval="10000">
                        <img src="{{ asset('../storage').'/app/public/'.$imagen->url_imagen_producto }}" class="" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>{{$producto[0]->nombre_producto}}</h5>

                        </div>
                    </div>
                <?php
                }
                ?>
                @endforeach

                <button class="carousel-control-prev" type="button" title="Imagen Anterior" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" title="Siguiente imagen" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>


        </div>
    </div>



    <div class="col-6">
        <a href="{{ url('/productos') }}" title="Regresar al catálogo">Regresar</a>
        <h2 class="h2pro">{{$producto[0]->nombre_producto}}</h2>
        <br><br>



        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true" title="Formulario para agregar un producto">Agrega</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false" title="Formulario para calificar un producto">Califica</button>

            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                <br>
                <h4>Precio: {{$producto[0]->precio_producto}} </h4>
                <h6>Productos disponibles: {{$producto[0]->existencia_producto}}</h6>
                <br>

                <form action="{{ route('shop.addcart',$producto[0]->id_producto) }}" method="POST">
                    @csrf
                    <input type="number" value="1" min="1" max="{{$producto[0]->existencia_producto}}" class="form-control" style="width:100px" name="quantity" title="Cantidad de productos que desea llevar"> <br>

                    <button class="btn btn-success addcartbtn" data-id="{{$producto[0]  ->id_producto}}" data-name="{{$producto[0]->nombre_producto}}" title="Agregar producto al carrito">Agregar al carrito</button>
                </form>
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                <br>
                <h4>Califica el producto:</h4>
                <h6>Siguienos ayudando a mejorar nuestros productos</h6>
                <br>

                <form action="{{ route('shop.order',$producto[0]->id_producto) }}" method="POST">
                    @csrf

                    <div class="form-check">
                        <input class="form-check-input" value="1" type="radio" name="calificacion" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Pésimo
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" value="2" type="radio" name="calificacion" id="flexRadioDefault2" checked>
                        <label class="form-check-label" for="flexRadioDefault2">
                            Malo
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" value="3" type="radio" name="calificacion" id="flexRadioDefault3">
                        <label class="form-check-label" for="flexRadioDefault3">
                            Regular
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" value="4" type="radio" name="calificacion" id="flexRadioDefault4" checked>
                        <label class="form-check-label" for="flexRadioDefault4">
                            Bueno
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" value="5" type="radio" name="calificacion" id="flexRadioDefault5" checked>
                        <label class="form-check-label" for="flexRadioDefault5">
                            Excelente
                        </label>
                    </div>
                    <br>
                    <button class="btn btn-success registrar" title="Calificar producto">Calificar</button>
                </form>

            </div>


        </div>


    </div>
</div>


@endsection
@section('js')
  
    <input value="la calificación" id="mensajeAlerta" hidden>
    <input value="Calidicación" id="mensajeAlerta1" hidden>
    <input value="La calificación" id="mensajeAlerta2" hidden>

    @if (session('status'))
    @if (session('status') == 'registrado')
    <input value="registrado" id="tipoAlerta" hidden>
    @else
    <input value="error" id="tipoAlerta" hidden>
    @endif
    @endif
    
    
   @stop