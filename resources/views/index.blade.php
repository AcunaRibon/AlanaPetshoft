@extends('layouts.app')


@section('content')
<section>
<div id="carrusel" class="carousel carousel-dark slide" data-bs-ride="carousel">

<div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="10000">
        <img src="{{ asset('ilustraciones/landing.svg') }}" class="d-block w-100"  alt="Regístrate">
    </div>
</div>
</div>


<h1 class="m-0 text-center my-4 title-ofertas">El mejor sitio para comprarle a tu mascota</h1>

<div class="container">
<div class="row">
<div class="col-sm-6">
    <div class="card ">
        <img class="card-img-top" src="ilustraciones/petfood.png" alt="" >
        <div class="card-block">
            <h4 class="card-title title-landing">Alimentos</h4>
            <p class="card-text text-landing">En AlanaPetshoft encontrarás los mejores precios en alimentos para tus peludos</p>
            
        </div>
    </div>
</div>
<div class="col-sm-6">
    <div class="card">
        <img class="card-img-top" src="ilustraciones/juguete.svg" alt="" >
        <div class="card-block">
            <h4 class="card-title title-landing">Juguetes</h4>
            <p class="card-text text-landing">Encuentra aquí juguetes para perros a domicilio en Medellín, son divertidos y estimulantes para que tu amigo este entretenido</p>
            
        </div>
    </div>
</div>
<div class="col-sm-6">
    <div class="card">
        <img class="card-img-top" src="ilustraciones/medicina.svg" alt="" >
        <div class="card-block">
            <h4 class="card-title title-landing">Medicina</h4>
            <p class="card-text text-landing">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            
        </div>
    </div>
</div>
<div class="col-sm-6">
    <div class="card">
        <img class="card-img-top" src="ilustraciones/accesorios.svg" alt="" >
        <div class="card-block">
            <h4 class="card-title title-landing">Accesorios</h4>
            <p class="card-text text-landing">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            
        </div>
    </div>
</div>
    </div>
</div>
</div>

</div>


<div class="" style="background: linear-gradient(90deg, #EE9CA7 0%, #FFDDE1 100%);">
<footer class="" style="background: linear-gradient(90deg, #EE9CA7 0%, #FFDDE1 100%);">
        <img src="ilustraciones/Vector.svg" alt="">
        
            <img src="ilustraciones/footerwave.svg" class="d-block w-100" alt="">
        </footer>
</div>
</section>
@endsection