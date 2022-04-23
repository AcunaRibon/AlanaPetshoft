@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content')

<div class="container pt-5">
    <div class="row">
        <div class="col-10">
            <div class="table-responsive p-2">
                <div class="d-flex justify-content-between">
                    <h2 class="text-center">Usuario</h2>
                    <button type="button" class="btn btn-dark mb-2" data-bs-toggle="modal" data-bs-target="#registrar">
                        Registrar
                    </button>
                </div>
                <div class="modal fade" id="registrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Registrar Usuario</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <form action="{{ route('usuario.store')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @include('crud.usuario.usuario.form')
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cerrar</button>
                                <input type="submit" value="Registrar" class="btn btn-primary">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <table id="tabla" class="table table-ligth table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Correo</th>
                            <th>Celular</th>
                            <th>Dirección</th>
                            <th>Estado</th>
                            <th>Tipo de Usuario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $usuario)
                        <tr>
                            <th scope="row">{{ $usuario ->id }}</th>
                            <td>{{ $usuario ->name }}</td>
                            <td>{{ $usuario ->last_name }}</td>
                            <td>{{ $usuario ->email }}</td>
                            <td>{{ $usuario ->cellphone }}</td>
                            <td>{{ $usuario ->address }}</td>
                            <td>
                                @if($usuario->user_status == 1)
                                    <button type="submit" class="btn btn-primary">Habilitado</button>
                                @else
                                    <button type="submit" class="btn btn-danger">Inhabilitado</button>
                                @endif
                            </td>
                            <td>
                                @if($usuario ->tipo_usuario_id == 1)
                                    <button type="submit" class="btn btn-primary">Administrador</button>
                                @elseif($usuario ->tipo_usuario_id == 2)
                                    <button type="submit" class="btn btn-danger">Empleado</button>
                                @else
                                    <button type="submit" class="btn btn-success">Cliente</button>
                                @endif
                                    </td>
                            <td>
                                <div class='d-flex justify-content-evenly'>
                                    <div class='d-flex justify-content-evenly'>
                                        <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#editar_{{$usuario->id}}">
                                            Editar
                                        </button>
                                        <div class="modal fade" id="editar_{{$usuario-> id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header ">
                                                        <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container-fluid">
                                                            <form action="{{route('usuario.update', $usuario-> id)}}" method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                {{method_field('PATCH')}}
                                                                @include('crud.usuario.usuario.form')
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cerrar</button>
                                                        <input type="submit" value="Modificar" class="btn btn-primary">
                                                        </form>
                                                    </div>
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
        <div class="col-2 d-flex flex-column justify-content-center align-items-center">
            <div class="bg-dark text-white text-center p-2 rounded-3 mb-2">
                <p class="text-center fs-5 fw-bolder">Usuarios registrados</p>
                <div class="d-flex justify-content-center align-items-center fs-3 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" heigh="40" fill="currentColor" class="bi bi-person-fill me-1" viewBox="0 0 16 16">
                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                    </svg>
                    <p class="fw-bold m-0">{{ $total }}</p>
                </div>
            </div>
            <a class="btn btn-warning" href="{{ url('admin/report') }}">
                Generar reporte
            </a>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;700&display=swap" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.css"/>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@stop

@section('js')
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.js" defer></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/tablas.js') }}" defer></script>

<input value="el usuario" id="mensajeAlerta" hidden>
<input value="Usuario" id="mensajeAlerta1" hidden>
<input value="El usuario" id="mensajeAlerta2" hidden>
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