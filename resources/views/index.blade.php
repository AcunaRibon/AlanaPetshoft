@extends('layouts.app')


@section('content')
<section>
    <div id="carrusel" class="carousel carousel-dark slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carrusel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carrusel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carrusel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="10000">
                <img src="{{ asset('ilustraciones/Fondo_landing.svg') }}" class="d-block w-100" alt="Regístrate">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Regístrate ahora mismo</h5>
                    <p>Un espacio para las necesidades de tu mascota</p>
                </div>
            </div>
            <div class="carousel-item" data-bs-interval="2000">
                <img src="{{ asset('ilustraciones/Fondo_landing.svg') }}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Second slide label</h5>
                    <p>Some representative placeholder content for the second slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('ilustraciones/Fondo_landing.svg') }}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Third slide label</h5>
                    <p>Some representative placeholder content for the third slide.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carrusel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carrusel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div>
        <h1 class="m-0 text-center my-4">Ofertas</h1>
        <div id="productos" class="carousel carousel-dark slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="container">
                        <div class="row p-4">
                            <div class="col-3">
                                <div class="card">
                                    <img src="{{ asset('ilustraciones/petys.png') }}" width="100" height="200" class="card-img-top" alt="...">
                                    <div class="card-body text-center text-white" style="background-color: #3E3E54;">
                                        <h4 class="card-title fw-bolder">Jabón Petys</h4>
                                        <p class="card-text fw-bold fs-6 mb-0">⭐⭐⭐⭐⭐</p>
                                        <p class="card-text fw-bold fs-5 mb-2">$15000</p>
                                        <a href="#" class="btn btn-primary">Comprar</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card">
                                    <img src="{{ asset('ilustraciones/cama.jpg') }}" width="100" height="200" class="card-img-top" alt="...">
                                    <div class="card-body text-center text-white" style="background-color: #3E3E54;">
                                        <h4 class="card-title fw-bolder">Cama Perro</h4>
                                        <p class="card-text fw-bold fs-6 mb-0">⭐⭐⭐⭐⭐</p>
                                        <p class="card-text fw-bold fs-5 mb-2">$40000</p>
                                        <a href="#" class="btn btn-primary">Comprar</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card">
                                    <img src="{{ asset('ilustraciones/cobija.jpg') }}" width="100" height="200" class="card-img-top" alt="...">
                                    <div class="card-body text-center text-white" style="background-color: #3E3E54;">
                                        <h4 class="card-title fw-bolder">Cobijita warm</h4>
                                        <p class="card-text fw-bold fs-6 mb-0">⭐⭐⭐⭐⭐</p>
                                        <p class="card-text fw-bold fs-5 mb-2">$30000</p>
                                        <a href="#" class="btn btn-primary">Comprar</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card">
                                    <img src="{{ asset('ilustraciones/perfume.jpg') }}" width="100" height="200" class="card-img-top" alt="...">
                                    <div class="card-body text-center text-white" style="background-color: #3E3E54;">
                                        <h4 class="card-title fw-bolder">Perfume Harto</h4>
                                        <p class="card-text fw-bold fs-6 mb-0">⭐⭐⭐⭐⭐</p>
                                        <p class="card-text fw-bold fs-5 mb-2">$50000</p>
                                        <a href="#" class="btn btn-primary">Comprar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                <div class="container">
                        <div class="row p-4">
                            <div class="col-3">
                                <div class="card">
                                    <img src="{{ asset('ilustraciones/petys.png') }}" width="100" height="200" class="card-img-top" alt="...">
                                    <div class="card-body text-center text-white" style="background-color: #3E3E54;">
                                        <h4 class="card-title fw-bolder">Jabón Petys</h4>
                                        <p class="card-text fw-bold fs-6 mb-0">⭐⭐⭐⭐⭐</p>
                                        <p class="card-text fw-bold fs-5 mb-2">$15000</p>
                                        <a href="#" class="btn btn-primary">Comprar</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card">
                                    <img src="{{ asset('ilustraciones/cama.jpg') }}" width="100" height="200" class="card-img-top" alt="...">
                                    <div class="card-body text-center text-white" style="background-color: #3E3E54;">
                                        <h4 class="card-title fw-bolder">Cama Perro</h4>
                                        <p class="card-text fw-bold fs-6 mb-0">⭐⭐⭐⭐⭐</p>
                                        <p class="card-text fw-bold fs-5 mb-2">$40000</p>
                                        <a href="#" class="btn btn-primary">Comprar</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card">
                                    <img src="{{ asset('ilustraciones/cobija.jpg') }}" width="100" height="200" class="card-img-top" alt="...">
                                    <div class="card-body text-center text-white" style="background-color: #3E3E54;">
                                        <h4 class="card-title fw-bolder">Cobijita warm</h4>
                                        <p class="card-text fw-bold fs-6 mb-0">⭐⭐⭐⭐⭐</p>
                                        <p class="card-text fw-bold fs-5 mb-2">$30000</p>
                                        <a href="#" class="btn btn-primary">Comprar</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card">
                                    <img src="{{ asset('ilustraciones/perfume.jpg') }}" width="100" height="200" class="card-img-top" alt="...">
                                    <div class="card-body text-center text-white" style="background-color: #3E3E54;">
                                        <h4 class="card-title fw-bolder">Perfume Harto</h4>
                                        <p class="card-text fw-bold fs-6 mb-0">⭐⭐⭐⭐⭐</p>
                                        <p class="card-text fw-bold fs-5 mb-2">$50000</p>
                                        <a href="#" class="btn btn-primary">Comprar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#productos" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#productos" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <div class="m-0 p-1" style="background: linear-gradient(90deg, #EE9CA7 0%, #FFDDE1 100%);">
        <h1 class="text-center my-4">Servicios</h1>
        <div class="container">
            <div class="row mb-3">
                <div class="col-4 text-center">
                    <img class="rounded-circle circle-image" src="{{ asset('ilustraciones/domicilio.jpg') }}" alt="">
                    <h3>domicilios</h3>
                </div>
                <div class="col-4 text-center">
                    <img class="rounded-circle circle-image" src="{{ asset('ilustraciones/servicios2.png') }}" alt="">
                    <h3>Productos</h3>
                </div>
                <div class="col-4 text-center">
                    <img class="rounded-circle circle-image" src="{{ asset('ilustraciones/servicio3.png') }}" alt="">
                    <h3>Recoge tu pedido</h3>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection