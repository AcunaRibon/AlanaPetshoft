@extends('adminlte::page')

@section('title', 'Domiciliarios')

@section('content')

<div class="container py-5">
    <div class="row">
        <div class="col-12">
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
@elseif (session('status') == 'listado')
<input value="listado" id="tipoAlerta" hidden>
@else
<input value="error" id="tipoAlerta" hidden>
@endif
@endif
<script src="{{ asset('js/alertas.js') }}"></script>
@stop