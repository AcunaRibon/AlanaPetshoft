<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <!-- JavaScript Bundle with Popper -->

    <!-- CSS only -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
    <!-- JavaScript Bundle with Popper -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/alertas.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/estilo.css') }}" rel="stylesheet">

    


</head>
<body>
    <div id="app">
        <header>
            <nav class="navbar navbar-expand-md navbar-dark bg-dark">
                <div class="container-fluid">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('images/logo.png') }}" alt="Alana Petshop" title="Logo de Alana Petshoft">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mb-lg-0 d-flex align-items-center">
                            <li class="nav-item ms-3">
                                <a class="nav-link fs-4 fw-bolder text-success p-0 text-center" href="{{ url('/') }}" title="Ir a la página principal">
                                    ALANA PETSHOP
                                </a>
                            </li>
                        
                                <a id="navbarDropdown" href="{{ url('/productos') }}" class="nav-link text-white fw-bold fs-7 px-lg-5 px-3 text-center"  aria-haspopup="true" aria-expanded="false" v-pre title="Ver catálogo de productos">
                                    Catálogo
                                </a>
                            
                        </ul>
                        <form class="d-flex flex-grow-1" action="search">
                            <input class="form-control me-2 " name="query" type="text" placeholder="¿Qué buscas?" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Buscar</button>

                        </form>
                        <ul class="navbar-nav d-flex align-items-center ps-lg-5">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link fs-7 text-center text-white me-lg-3 fw-bold" href="{{ route('login') }}" title="Iniciar sesión">Iniciar<font class="text-success"> sesión </font></a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link fs-7 text-center text-white me-lg-3 fw-bold" href="{{ route('register') }}" title="Registro">Registrarse</a>
                                </li>
                            @endif
                        @else
                            <div class=" nav-item dropdown">
                                <a class="dropdown-toggle nav-link fs-7 text-white fw-bold text-center me-lg-3" role="button" id="menuAdmin" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false" title="Ver opciones">
                                    {{ Auth::user()->name }} <font class="text-success">{{ Auth::user()->last_name }}</font>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-light" aria-labelledby="menuAdmin">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('profile.index') }}" title="Ver mis datos">
                                            Ver perfil
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('miDomicilio.index') }}" title="Ver mis domicilios">
                                            Mis domicilios
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();" title="Cerrar cuenta">
                                            {{ __('Cerrar sesión') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>

                            
                        @endguest
                            <li class="nav-item">
                                <a class="nav-link fs-7 ms-lg-3 text-center text-white fw-bold" href="{{url('/cartlist')}}" title="Ver mi carrito">Mi<font class="text-success"> carrito </font></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        <main>
            @yield('content')
        </main>
        <footer class="bg-dark text-white pt-3 pb-1 px-2" >
            <div class="container-fluid row m-0">
                <div class="row col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 pb-4">
                    <div class="col-xs-6 col-sm-4 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('images/logo.png') }}" alt="Alana Petshop" class="img-fluid" width="130" height="130" title="Ir a la página principal">
                        </a>
                    </div>
                    <div class="col-xs-6 col-sm-8 col-md-9 col-lg-9 col-xl-9 col-xxl-9">
                        <h5>Alana Petshoft</h5>
                        <p>Contacto: <i>soporte.alana.petshop@outlook.es</i></p>
                        
                        <div class="img-fluid">
                            <a href="https://es-la.facebook.com/" class="link-light text-decoration-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-facebook me-3" viewBox="0 0 16 16">
                                    <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                                </svg>
                            </a>
                            <a href="https://www.instagram.com/" class="link-light text-decoration-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-instagram mx-3" viewBox="0 0 16 16">
                                    <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                                </svg>
                            </a>
                            <a href="https://www.tiktok.com/es/" class="link-light text-decoration-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-tiktok ms-3" viewBox="0 0 16 16">
                                    <path d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3V0Z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-2 col-xl-2 col-xxl-2 pb-2">
                    <h5>Mi cuenta</h5>
                    @if(Auth::user())
                        <ul class="list-unstyled">
                            <li class="py-1">
                                <a class="link-light text-decoration-none" href="">Ver perfil</a>
                            </li>
                            <li class="py-1">
                                <a class="link-light text-decoration-none" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar sesión') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    @else
                        <ul class="list-unstyled">
                            <li class="py-1">
                                <a class="link-light text-decoration-none" href="{{ route('login') }}">Iniciar sesión</a>
                            </li>
                            <li class="py-1">
                                <a class="link-light text-decoration-none" href="{{ route('register') }}">Crear cuenta</a>
                            </li>
                            <li class="py-1">
                                <a class="link-light text-decoration-none"  href="{{ route('password.request') }}">Recuperar cuenta</a>
                            </li>
                        </ul>
                    @endif
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-2 col-xl-2 col-xxl-2 pb-2">
                    <h5>Catálogo</h5>
                    <ul class="list-unstyled">
                        <li class="py-1">
                            <a class="link-light text-decoration-none" href="">Alimentos</a>
                        </li>
                        <li class="py-1">
                            <a class="link-light text-decoration-none" href="">Snacks</a>
                        </li>
                        <li class="py-1">
                            <a class="link-light text-decoration-none" href="">Higiene</a>
                        </li>
                        <li class="py-1">
                            <a class="link-light text-decoration-none" href="">Accesorios</a>
                        </li>
                        <li class="py-1">
                            <a class="link-light text-decoration-none" href="">Juguetes</a>
                        </li>
                        <li class="py-1">
                            <a class="link-light text-decoration-none" href="">Medicamentos</a>
                        </li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-2 col-xl-2 col-xxl-2 pb-2 justify-content-sm-center">
                    <h5>Accesibilidad</h5>
                    <ul class="list-unstyled">
                        <li class="py-1">
                            <a class="link-light text-decoration-none" href="{{ asset('files/manual_usuario_alana_petshop.pdf') }}" target="_blank">Manual de usuario</a>
                        </li>
                    </ul>
                </div>
                <div class="text-center text-white py-1">
                    <h6>Alana Petshop © 2022 Copyright</h6>
                </div>
            </div>
        </footer>
    </div>
    @yield('js')
     
</body>
</html>
