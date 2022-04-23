@extends('adminlte::page')

@section('title', 'Proveedores')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-10">
            <div class="table-responsive p-2">
                <div class="d-flex justify-content-between">
                    <h2 class="text-center">Proveedor</h2>
                    <button type="button" class="btn btn-dark mb-2" data-bs-toggle="modal" data-bs-target="#registrar">
                        Registrar
                    </button>
                </div>
                <div class="modal fade" id="registrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Registrar Proveedor</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('proveedor.store') }}" method="post">
                                    @csrf
                                    <div class="mb-2">
                                        <label for="nombre_proveedor" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="nombre_proveedor" name="nombre_proveedor" value="{{ old('nombre_proveedor', isset($proveedores -> nombre_proveedor)?$proveedores -> nombre_proveedor:'') }}" required>
                                        @error('nombre_proveedor')
                                            <input value="errorRegistrar" id="tipoAlerta" hidden>
                                            <p class="text-danger fw-bold">
                                                * {{$message}}
                                            </p>
                                        @enderror
                                    </div>
                                    <div class="mb-2">
                                        <label for="celular_proveedor" class="form-label">Celular</label>
                                        <input type="number" class="form-control" id="celular_proveedor" name="celular_proveedor" value="{{ old('celular_proveedor', isset($proveedores -> celular_proveedor)?$proveedores -> celular_proveedor:'') }}" required>
                                        @error('celular_proveedor')
                                            <input value="errorRegistrar" id="tipoAlerta" hidden>
                                            <p class="text-danger fw-bold">
                                                * {{$message}}
                                            </p>
                                        @enderror
                                    </div>
                            </div>
                            <div class="modal-footer">
                                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary registrar">Registrar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <table id="tabla" class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Celular</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($proveedor as $proveedores)
                        <tr>
                            <td>{{ $proveedores -> id_proveedor }}</td>
                            <td>{{ $proveedores -> nombre_proveedor }}</td>
                            <td>{{ $proveedores -> celular_proveedor }}</td>
                            <td>
                                <div class='d-flex justify-content-evenly'>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editar-{{$proveedores -> id_proveedor}}">
                                        Editar
                                    </button>
                                    <div class="modal fade" id="editar-{{$proveedores -> id_proveedor}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered text-black">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Editar Proveedor</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('proveedor.update', $proveedores -> id_proveedor) }}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-2">
                                                            <label for="nombre_proveedor" class="form-label">Nombre</label>
                                                            <input type="text" class="form-control" id="nombre_proveedor" name="nombre_proveedor_m" value="{{ old('nombre_proveedor_m', isset($proveedores -> nombre_proveedor)?$proveedores -> nombre_proveedor:'') }}" required>
                                                            @error('nombre_proveedor_m')
                                                                <input value="errorModificar" id="tipoAlerta" hidden>
                                                                <p class="text-danger fw-bold">
                                                                    * {{$message}}
                                                                </p>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-2">
                                                            <label for="celular_proveedor" class="form-label">Celular</label>
                                                            <input type="number" class="form-control" id="celular_proveedor" name="celular_proveedor_m" value="{{ old('celular_proveedor_m', isset($proveedores -> celular_proveedor)?$proveedores -> celular_proveedor:'') }}" required>
                                                            @error('celular_proveedor_m')
                                                                <input value="errorModificar" id="tipoAlerta" hidden>
                                                                <p class="text-danger fw-bold">
                                                                    * {{$message}}
                                                                </p>
                                                            @enderror
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cerrar</button>
                                                        <button type="submit" class="btn btn-primary actualizar">Modificar</button>
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
        <div class="col-2 d-flex flex-column justify-content-center align-items-center">
            <div class="bg-dark text-white text-center p-2 rounded-3 mb-2">
                <p class="text-center fs-5 fw-bolder">Proveedores registrados</p>
                <div class="d-flex justify-content-center align-items-center fs-3 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" heigh="40" fill="currentColor" class="bi bi-person-fill me-1" viewBox="0 0 16 16">
                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                    </svg>
                    <p class="fw-bold m-0">{{ $total }}</p>
                </div>
            </div>
            <a class="btn btn-warning mb-2" href="{{ url('proveedor/report') }}">
                Generar reporte
            </a>
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

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.css"/>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@stop

@section('js')
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.js" defer></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/tablas.js') }}" defer></script>

<input value="el proveedor" id="mensajeAlerta" hidden>
<input value="Proveedor" id="mensajeAlerta1" hidden>
<input value="El proveedor" id="mensajeAlerta2" hidden>
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