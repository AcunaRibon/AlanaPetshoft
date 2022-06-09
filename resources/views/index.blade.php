@extends('layouts.app')


@section('content')
<section>
<div id="carrusel" class="carousel carousel-dark slide" data-bs-ride="carousel">

<div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="10000">
        <img src="{{ asset('images/landing.svg') }}" class="d-block w-100"  alt="Regístrate">
    </div>
</div>
</div>


<h1 class="m-0 text-center my-4 title-ofertas">El mejor sitio para comprarle a tu mascota</h1>

<div class="container">
<div class="row">
<div class="col-sm-6">
    <div class="card ">
        <img class="card-img-top" src="images/petfood.png" alt="" >
        <div class="card-block">
            <h4 class="card-title title-landing">Alimentos</h4>
            <p class="card-text text-landing">Encontrarás los mejores precios en alimentos, aporta energía para el desarrollo de las actividades del día a día de tu mascota</p>
            
        </div>
    </div>
</div>
<div class="col-sm-6">
    <div class="card">
        <img class="card-img-top" src="images/juguete.svg" alt="" >
        <div class="card-block">
            <h4 class="card-title title-landing">Juguetes</h4>
            <p class="card-text text-landing">Encuentra aquí juguetes para perros a domicilio en Medellín, son divertidos y estimulantes para que tu amigo este entretenido</p>
            
        </div>
    </div>
</div>
<div class="col-sm-6">
    <div class="card">
        <img class="card-img-top" src="images/medicina.svg" alt="" >
        <div class="card-block">
            <h4 class="card-title title-landing">Medicina</h4>
            <p class="card-text text-landing">
            Medicamentos biológicos,
veterinarios e insumos hospitalarios, especializada en animales
de compañía comprometida con el servicio a sus clientes
            </p>
            
        </div>
    </div>
</div>
<div class="col-sm-6">
    <div class="card">
        <img class="card-img-top" src="images/accesorios.svg" alt="" >
        <div class="card-block">
            <h4 class="card-title title-landing">Accesorios</h4>
            <p class="card-text text-landing">
            Camas, correas , collares, pecheras y accesorios para ellos. La comodidad en tu mascota es fundamental para el desarrollo y relacionamiento de ellos.
            </p>
            
        </div>
    </div>
</div>
    </div>
</div>
</div>

</div>


<div class="" style="background: linear-gradient(90deg, #EE9CA7 0%, #FFDDE1 100%);">
<footer class="" style="background: linear-gradient(90deg, #EE9CA7 0%, #FFDDE1 100%);">
        <img src="images/Vector.svg" alt="">
        
            <img src="images/footerwave.svg" class="d-block w-100" alt="">
        </footer>
</div>
</section>
@endsection