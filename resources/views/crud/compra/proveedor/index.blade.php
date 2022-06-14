@extends('adminlte::page')

@section('title', 'Proveedores')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-9 col-xxl-10">
            <div class="d-flex justify-content-between px-2">
                <h2 class="text-center" title="Proveedores registrados">Proveedores</h2>
                <button type="button" class="btn btn-dark mb-2" data-bs-toggle="modal" data-bs-target="#registrar" title="Registrar proveedor">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-plus-lg me-1" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                    </svg>
                    Registrar
                </button>
            </div>
            <div class="modal fade" id="registrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Registrar Proveedor</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" title="Cerrar ventana"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('proveedor.store') }}" method="post">
                                @csrf
                                <div class="mb-2">
                                    <label for="nombre_proveedor" class="form-label">Nombre</label>
                                    <input type="text" class="form-control @error('nombre_proveedor') is-invalid @enderror" id="nombre_proveedor" name="nombre_proveedor" value="{{ old('nombre_proveedor', isset($proveedores -> nombre_proveedor)?$proveedores -> nombre_proveedor:'') }}" required title="Ingresar nombre">
                                    @error('nombre_proveedor')
                                        <input value="errorRegistrar" id="tipoAlerta" hidden>
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="celular_proveedor" class="form-label">Celular</label>
                                    <input type="number" class="form-control @error('celular_proveedor') is-invalid @enderror" id="celular_proveedor" name="celular_proveedor" value="{{ old('celular_proveedor', isset($proveedores -> celular_proveedor)?$proveedores -> celular_proveedor:'') }}" required title="Ingresar celular">
                                    @error('celular_proveedor')
                                        <input value="errorRegistrar" id="tipoAlerta" hidden>
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                        </div>
                        <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" title="Cerrar ventana">Cerrar</button>
                                <button type="submit" class="btn btn-success registrar" title="Registrar proveedor">Registrar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive p-2">
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
                                <div class="dropdown">
                                    <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" title="Acciones disponibles">
                                        Acciones
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                        <li>
                                            <button class="dropdown-item fw-bold" data-bs-toggle="modal" data-bs-target="#editar-{{$proveedores -> id_proveedor}}" title="Editar proveedor">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-pen me-1" viewBox="0 0 16 16">
                                                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                                </svg>
                                                Editar
                                            </button>
                                        </li>
                                    </ul>
                                    <div class="modal fade" id="editar-{{$proveedores -> id_proveedor}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered text-black">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Editar Proveedor</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" title="Cerrar ventana"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('proveedor.update', $proveedores -> id_proveedor) }}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-2">
                                                            <label for="nombre_proveedor" class="form-label">Nombre</label>
                                                            <input type="text" class="form-control @error('nombre_proveedor_m') is-invalid @enderror" id="nombre_proveedor" name="nombre_proveedor_m" value="{{ old('nombre_proveedor_m', isset($proveedores -> nombre_proveedor)?$proveedores -> nombre_proveedor:'') }}" required title="Editar nombre">
                                                            @error('nombre_proveedor_m')
                                                                <input value="errorModificar" id="tipoAlerta" hidden>
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-2">
                                                            <label for="celular_proveedor" class="form-label">Celular</label>
                                                            <input type="number" class="form-control @error('celular_proveedor_m') is-invalid @enderror" id="celular_proveedor" name="celular_proveedor_m" value="{{ old('celular_proveedor_m', isset($proveedores -> celular_proveedor)?$proveedores -> celular_proveedor:'') }}" required title="Editar celular">
                                                            @error('celular_proveedor_m')
                                                                <input value="errorModificar" id="tipoAlerta" hidden>
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" title="Cerrar ventana">Cerrar</button>
                                                        <button type="submit" class="btn btn-success actualizar" title="Modificar proveedor">Modificar</button>
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
        <div class="mt-4 d-flex justify-content-center col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-3 col-xxl-2">
            <div class="d-flex d-inline-flex flex-column justify-content-center align-items-center p-2">
                <div class="bg-dark text-white text-center p-2 rounded-3 mb-2">
                    <p class="text-center fs-5 fw-bolder">Proveedores registrados</p>
                    <div class="d-flex justify-content-center align-items-center fs-3 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-shop me-1" viewBox="0 0 16 16">
                            <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z"/>
                        </svg>
                        <p class="fw-bold m-0">{{ $total }}</p>
                    </div>
                </div>
                <button class="btn btn-warning mb-2" data-bs-toggle="modal" data-bs-target="#informe" title="Generar nuevo reporte de proveedores">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-journal-plus me-1" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5z"/>
                        <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
                        <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
                    </svg>
                    Nuevo reporte
                </button>
                <div class="modal fade" id="informe" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Generar reporte</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" title="Cerrar ventana"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('proveedor.report') }}" method="get">
                                    @csrf
                                    <div class="row">
                                        <p class="mb-4">Complete el siguiente formulario para la generación del reporte:</p>
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mb-2">
                                            <label for="fecha_inicio" class="form-label">Fecha de inicio</label>
                                            <input type="date" class="form-control @error('fecha_inicio') is-invalid @enderror" name="fecha_inicio" required title="Ingresar fecha de inicio" value="{{ old('fecha_inicio') }}">
                                            @error('fecha_inicio')
                                                <input value="errorInforme" id="tipoAlerta" hidden>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mb-2">
                                            <label for="fecha_fin" class="form-label">Fecha de fin</label>
                                            <input type="date" class="form-control @error('fecha_fin') is-invalid @enderror" name="fecha_fin" required title="Ingresar fecha de fin" value="{{ old('fecha_fin') }}">
                                            @error('fecha_fin')
                                                <input value="errorInforme" id="tipoAlerta" hidden>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mb-2">
                                            <label for="columna" class="form-label">Ordenar por columna:</label>
                                            <select name="columna" class="form-select @error('columna') is-invalid @enderror" title="Seleccionar columna para ordenar los registros">
                                                <option value="proveedor.id_proveedor" {{ old('columna') == 'proveedor.id_proveedor' ? 'selected' : '' }}>ID del proveedor</option>
                                                <option value="proveedor.nombre_proveedor" {{ old('columna') == 'proveedor.nombre_proveedor' ? 'selected' : '' }}>Nombre</option>
                                                <option value="proveedor.celular_proveedor" {{ old('columna') == 'proveedor.celular_proveedor' ? 'selected' : '' }}>Celular</option>
                                                <option value="proveedor.created_at" {{ old('columna') == 'proveedor.created_at' ? 'selected' : '' }}>Fecha de creación</option>
                                                <option value="proveedor.updated_at" {{ old('columna') == 'proveedor.updated_at' ? 'selected' : '' }}>Fecha de última actualización de datos</option>
                                            </select>
                                            @error('columna')
                                                <input value="errorInforme" id="tipoAlerta" hidden>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mb-2">
                                            <label for="orden" class="form-label">Orden de los registros:</label>
                                            <select name="orden" class="form-select @error('orden') is-invalid @enderror" title="Seleccionar el orden en el que se van a mostrar los registros">
                                                <option value="asc" {{ old('orden') == 'asc' ? 'selected' : '' }}>Ascendente</option>
                                                <option value="desc" {{ old('orden') == 'desc' ? 'selected' : '' }}>Descendente</option>
                                            </select>
                                            @error('orden')
                                                <input value="errorInforme" id="tipoAlerta" hidden>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" title="Cerrar ventana">Cerrar</button>
                                <button type="submit" class="btn btn-success reporte" title="Generar y descargar el reporte">Generar reporte</button>
                                </form>
                            </div>
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