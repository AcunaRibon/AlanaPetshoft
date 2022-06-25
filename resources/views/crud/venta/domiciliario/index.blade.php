@extends('adminlte::page')

@section('title', 'Domiciliarios')

@section('content')

<div class="container py-5">
    <div class="row">
        <div class="col-12 col-md-10 ">
            <div class="table-responsive p-2">
                <div class="d-flex justify-content-between">
                    <h2 class="text-center">Domiciliarios</h2>
                    <button type="button" class="btn btn-dark mb-2" data-bs-toggle="modal" data-bs-target="#registrar">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-plus-lg me-1" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                        </svg>
                        Registrar
                    </button>
                </div>
                <div class="modal fade" id="registrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Registrar Domiciliario</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <form action="{{route('domiciliario.store')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            @include('crud.venta.domiciliario.form',['modo'=>'errorRegistrar','tipo'=>'1'])
                                        </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-success registrar">Registrar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <table id="tabla" class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Documento</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Celular</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($domiciliarios as $listdomiciliario)
                        <tr>
                            <td> {{$listdomiciliario->documento_domiciliario}}</td>
                            <td> {{$listdomiciliario->nombres_domiciliario}}</td>
                            <td> {{$listdomiciliario->apellidos_domiciliario}}</td>
                            <td> {{$listdomiciliario->celular_domiciliario}}</td>
                            <td> <?php
                                    if ($listdomiciliario->estado_domiciliario == 1) {

                                    ?> <p>disponibles</p> <?php } elseif ($listdomiciliario->estado_domiciliario == 0) { ?>

                                    <p>No disponibles</p> <?php
                                                        } ?>
                            </td>
                            <td>
                                <div class="d-flex justify-content-between">

                                    <div class="dropdown">
                                        <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" title="Acciones disponibles">
                                            Acciones
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                            <li> <button type="button" class="dropdown-item fw-bold" data-bs-toggle="modal" data-bs-target="#editar_{{$listdomiciliario->documento_domiciliario}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-pen me-1" viewBox="0 0 16 16">
                                                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                                    </svg>
                                                    Editar
                                                </button>
                                            </li>
                                            <li>
                                                <form action="{{ route('domiciliario.destroy', $listdomiciliario->documento_domiciliario)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item fw-bold cancelar">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-x-lg me-1" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z" />
                                                            <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z" />
                                                        </svg>
                                                        Cancelar
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>



                                    </div>

                                    <div class="modal fade" id="editar_{{$listdomiciliario->documento_domiciliario}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Editar Venta</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container-fluid">
                                                        <form action="{{route('domiciliario.update',$listdomiciliario->documento_domiciliario)}}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            {{method_field('PATCH')}}
                                                            <div class="row">
                                                                @include('crud.venta.domiciliario.form',['modo'=>'errorModificar','tipo'=>'2'])
                                                            </div>


                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-success actualizar">Actualizar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        <div class="col-12 col-md-2 d-flex flex-column justify-content-center align-items-center ">
            <div class="bg-dark text-white text-center p-2 rounded-3 mb-2 mt-5">
                <p class="text-center fs-5 fw-bolder">Domiciliarios registrados</p>
                <div class="d-flex justify-content-center align-items-center fs-3">

                    <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-bicycle me-1" viewBox="0 0 16 16">
                        <path d="M4 4.5a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1v.5h4.14l.386-1.158A.5.5 0 0 1 11 4h1a.5.5 0 0 1 0 1h-.64l-.311.935.807 1.29a3 3 0 1 1-.848.53l-.508-.812-2.076 3.322A.5.5 0 0 1 8 10.5H5.959a3 3 0 1 1-1.815-3.274L5 5.856V5h-.5a.5.5 0 0 1-.5-.5zm1.5 2.443-.508.814c.5.444.85 1.054.967 1.743h1.139L5.5 6.943zM8 9.057 9.598 6.5H6.402L8 9.057zM4.937 9.5a1.997 1.997 0 0 0-.487-.877l-.548.877h1.035zM3.603 8.092A2 2 0 1 0 4.937 10.5H3a.5.5 0 0 1-.424-.765l1.027-1.643zm7.947.53a2 2 0 1 0 .848-.53l1.026 1.643a.5.5 0 1 1-.848.53L11.55 8.623z" />
                    </svg>
                    <p class="fw-bold m-0">{{$Existencia}} </p>
                </div>
            </div>

            <button type="button" class="btn btn-danger mb-2" data-bs-toggle="modal" data-bs-target="#domiciliariosInactivos" title="Ver domiciliarios cancelados">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-x-lg me-1" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z" />
                    <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z" />
                </svg>
                cancelados
            </button>
            <div class="modal fade" id="domiciliariosInactivos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                    <div class="modal-content">
                        <div class="modal-header ">
                            <h5 class="modal-title" id="exampleModalLabel">Productos Cancelados</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">

                                <table id="tabla" class="table table-striped table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Documento</th>
                                            <th>Nombre</th>
                                            <th>Apellidos</th>
                                            <th>Celular</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($domiciliariosInactivos as $listdomiciliario)
                                        <tr>
                                            <td> {{$listdomiciliario->documento_domiciliario}}</td>
                                            <td> {{$listdomiciliario->nombres_domiciliario}}</td>
                                            <td> {{$listdomiciliario->apellidos_domiciliario}}</td>
                                            <td> {{$listdomiciliario->celular_domiciliario}}</td>
                                            <td> <?php
                                                    if ($listdomiciliario->estado_domiciliario == 1) {

                                                    ?> <p>disponibles</p> <?php } elseif ($listdomiciliario->estado_domiciliario == 0) { ?>

                                                    <p>No disponibles</p> <?php
                                                                        } ?>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-between">

                                                    <form action="{{ route('domiciliario.destroy', $listdomiciliario->documento_domiciliario)}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger habilitar" title="Habilitar domiciliario">

                                                            Habilitar
                                                        </button>
                                                    </form>





                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-dark" data-bs-dismiss="modal" title="Cerrar ventana">Cerrar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @section('css')
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.css" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stop

    @section('js')
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.js" defer></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/tablas.js') }}" defer></script>

    <input value="el domiciliario" id="mensajeAlerta" hidden>
    <input value="Domiciliario" id="mensajeAlerta1" hidden>
    <input value="El domiciliario" id="mensajeAlerta2" hidden>
    @if (session('status'))
    @if (session('status') == 'registrado')
    <input value="registrado" id="tipoAlerta" hidden>
    @elseif (session('status') == 'actualizado')
    <input value="actualizado" id="tipoAlerta" hidden>
    @elseif (session('status') == 'cancelado')
    <input value="cancelado" id="tipoAlerta" hidden>
    @elseif (session('status') == 'restaurado')
    <input value="restaurado" id="tipoAlerta" hidden>
    @else
    <input value="error" id="tipoAlerta" hidden>
    @endif
    @endif
    <script src="{{ asset('js/alertas.js') }}"></script>
    @stop