@extends('adminlte::page')

@section('title', 'Productos')

@section('content')
<div class="container pt-5">

    <div class="row">
        <div class="col-10">
            <div class="table-responsive p-2">
                <div class="d-flex justify-content-between">
                    <h2 class="text-center">Productos</h2>
                    <button type="button" class="btn btn-dark mb-2" data-bs-toggle="modal" data-bs-target="#registrar">
                        Registrar
                    </button>
                </div>
                <div class="modal fade" id="registrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Registrar Producto</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <form action="{{route('producto.store')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @include('crud.producto.gestionProducto.form')
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
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Existencia</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $producto)
                        <tr>
                            <td>{{$producto-> id_producto}}</td>
                            <td>{{$producto-> nombre_producto}}</td>
                            <td>{{$producto-> precio_producto}}</td>
                            <td>{{isset($producto-> existencia_producto)?$producto-> existencia_producto:0}}</td>
                            <td>
                                <div class='d-flex justify-content-evenly'>
                                    <div class='d-flex justify-content-evenly'>
                                        <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#editar_{{$producto->id_producto}}">
                                            editar
                                        </button>
                                        <div class="modal fade" id="editar_{{$producto-> id_producto}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header ">
                                                        <h5 class="modal-title" id="exampleModalLabel">Editar Producto</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container-fluid">
                                                            <form action="{{route('producto.update', $producto-> id_producto)}}" method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                {{method_field('PATCH')}}
                                                                @include('crud.producto.gestionProducto.form')
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
                                        <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#ver_{{$producto->id_producto}}">
                                            ver
                                        </button>
                                        <div class="modal fade" id="ver_{{$producto-> id_producto}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header ">
                                                        <h5 class="modal-title" id="exampleModalLabel">Editar Producto</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table table-ligth table-striped table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>Imagenes</th>
                                                                    <th>Acciones</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($imagenes as $imagen)
                                                                <?php
                                                                if ($producto->id_producto == $imagen->producto_id) {
                                                                ?>
                                                                    <tr>
                                                                        <td><img src="{{asset('../storage').'/app/public/'.$imagen->url_imagen_producto}}" width="100px" height="100px"></td>
                                                                        <td>
                                                                            <div class='d-flex justify-content-evenly'>
                                                                                <form action="{{ route('producto.destroyImg', $imagen->id_imagen_producto)}}" method="post">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <button type="submit" class="btn btn-danger">
                                                                                        Eliminar
                                                                                    </button>
                                                                                </form>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                <?php
                                                                }
                                                                ?>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cerrar</button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <form action="{{ route('producto.destroy', $producto-> id_producto)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                Cancelar
                                            </button>
                                        </form>
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
                <p class="text-center fs-5 fw-bolder">Productos registrados</p>
                <div class="d-flex justify-content-center align-items-center fs-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-cart me-1" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                    </svg>
                    <p class="fw-bold m-0">{{$Existencia}} </p>
                </div>
            </div>
            <button class="btn btn-warning mb-2" title="Generar nuevo reporte de compras" data-bs-toggle="modal" data-bs-target="#informe">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-journal-plus me-1" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5z" />
                    <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                    <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
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
                            <form action="{{ route('producto.export') }}" method="get">
                                @csrf
                                <div class="row">
                                    <p class="mb-4">Complete el siguiente formulario para la generación del reporte:</p>

                                    <div class="col-6 mb-2">
                                        <label for="columna" class="form-label">Ordenar por columna:</label>
                                        <select name="columna" class="form-select" title="Seleccionar columna para ordenar los registros">
                                            <option value="producto.id_producto" {{ old('columna') == 'producto.id_producto' ? 'selected' : '' }}>ID del producto</option>
                                            <option value="producto.nombre_producto" {{ old('columna') == 'producto.nombre_producto' ? 'selected' : '' }}>Nombre</option>
                                            <option value="producto.existencia_producto" {{ old('columna') == 'producto.existencia_producto' ? 'selected' : '' }}>Existencias</option>
                                            <option value="producto.precio_producto" {{ old('columna') == 'producto.precio_producto' ? 'selected' : '' }}>Precio</option>
                                            <option value="producto.estado_producto" {{ old('columna') == 'producto.estado_producto' ? 'selected' : '' }}>Estado del Producto</option>
                                            <option value="producto.tipo_producto_id" {{ old('columna') == 'producto.tipo_producto_id' ? 'selected' : '' }}>Tipo</option>
                                        </select>

                                    </div>
                                    <div class="col-6 mb-2">
                                        <label for="orden" class="form-label">Orden de los registros:</label>
                                        <select name="orden" class="form-select " title="Seleccionar el orden en el que se van a mostrar los registros">
                                            <option value="asc" {{ old('orden') == 'asc' ? 'selected' : '' }}>Ascendente</option>
                                            <option value="desc" {{ old('orden') == 'desc' ? 'selected' : '' }}>Descendente</option>
                                        </select>

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

            <button type="button" class="btn btn-danger mb-2" data-bs-toggle="modal" data-bs-target="#productosInactivos">
                productos cancelados
            </button>
            <div class="modal fade" id="productosInactivos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                    <div class="modal-content">
                        <div class="modal-header ">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Producto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">

                                <table id="tabla" class="table table-ligth table-striped table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Precio</th>
                                            <th>Existencia</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($productosInactivos as $producto)
                                        <tr>
                                            <td>{{$producto-> id_producto}}</td>
                                            <td>{{$producto-> nombre_producto}}</td>
                                            <td>{{$producto-> precio_producto}}</td>
                                            <td>{{isset($producto-> existencia_producto)?$producto-> existencia_producto:0}}</td>
                                            <td>
                                                <div class='d-flex justify-content-evenly'>

                                                    <form action="{{ route('producto.destroy', $producto-> id_producto)}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">
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
                                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cerrar</button>
                                <input type="submit" value="Modificar" class="btn btn-primary">
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

    <input value="el producto" id="mensajeAlerta" hidden>
    <input value="Producto" id="mensajeAlerta1" hidden>
    <input value="El producto" id="mensajeAlerta2" hidden>
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