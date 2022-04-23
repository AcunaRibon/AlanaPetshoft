@extends('adminlte::page')

@section('title', 'Compras')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <div class="table-responsive p-2">
                <div class="d-flex justify-content-between">
                    <h2 class="text-center">Compras</h2>
                    <button type="button" class="btn btn-dark mb-2" data-bs-toggle="modal" data-bs-target="#registrar">
                        Registrar
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-cart-plus ms-1" viewBox="0 0 16 16">
                            <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/>
                            <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                        </svg>
                    </button>
                </div>
                <div class="modal fade" id="registrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Registrar Compra</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <form action="{{ route('compra.store') }}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-3 mb-2">
                                                <label for="fecha_pedido_compra" class="form-label">Fecha de pedido</label>
                                                <input type="date" class="form-control" id="fecha_pedido_compra" name="fecha_pedido_compra" value="{{ old('fecha_pedido_compra') }}" required>
                                                @error('fecha_pedido_compra')
                                                    <input value="errorRegistrar" id="tipoAlerta" hidden>
                                                    <p class="text-danger fw-bold">
                                                        * {{$message}}
                                                    </p>
                                                @enderror
                                            </div>
                                            <div class="col-3 mb-2">
                                                <label for="fecha_entrega_compra" class="form-label">Fecha de entrega</label>
                                                <input type="date" class="form-control" id="fecha_entrega_compra" name="fecha_entrega_compra" value="{{ old('fecha_entrega_compra') }}" required>
                                                @error('fecha_entrega_compra')
                                                    <input value="errorRegistrar" id="tipoAlerta" hidden>
                                                    <p class="text-danger fw-bold">
                                                        * {{$message}}
                                                    </p>
                                                @enderror
                                            </div>
                                            <div class="col-3 mb-2">
                                                <label for="estado_pedido_compra" class="form-label">Estado</label>
                                                <select class="form-select" name="estado_pedido_compra" id="estado_pedido_compra" required>
                                                    <option hidden value="">Seleccione un estado</option>
                                                    <option value="Entregado" {{ old('estado_pedido_compra') == 'Entregado' ? 'selected' : '' }}>Entregado</option>
                                                    <option value="No entregado" {{ old('estado_pedido_compra') == 'No entregado' ? 'selected' : '' }}>No entregado</option>
                                                </select>
                                                @error('estado_pedido_compra')
                                                    <input value="errorRegistrar" id="tipoAlerta" hidden>
                                                    <p class="text-danger fw-bold">
                                                        * {{$message}}
                                                    </p>
                                                @enderror
                                            </div>
                                            <div class="col-3 mb-2">
                                                <label for="proveedor_id " class="form-label">Proveedor</label>
                                                <select class="form-select" name="proveedor_id" id="proveedor_id" required>
                                                    <option hidden value="">Seleccione un proveedor</option>
                                                    @foreach ($proveedor as $proveedores)
                                                        <option value="{{ $proveedores->id_proveedor }}" {{ old('proveedor_id') == $proveedores->id_proveedor ? 'selected' : '' }}>{{ $proveedores->nombre_proveedor }}</option>
                                                    @endforeach
                                                </select>
                                                @error('proveedor_id')
                                                    <input value="errorRegistrar" id="tipoAlerta" hidden>
                                                    <p class="text-danger fw-bold">
                                                        * {{$message}}
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5 mb-2">
                                                <label for="producto_id " class="form-label">Productos</label>
                                                <select class="form-select" name="producto_id " id="producto_id" onchange="agregarPrecioProducto()" required>
                                                    <option hidden value="">Seleccione los productos</option>
                                                    @foreach ($producto as $productos)
                                                        <option precio="{{ $productos->precio_producto }}" value="{{ $productos->id_producto }}">{{ $productos->nombre_producto }}</option>
                                                    @endforeach
                                                </select>
                                                @error('producto_id')
                                                    <input value="errorRegistrar" id="tipoAlerta" hidden>
                                                    <p class="text-danger fw-bold">
                                                        * {{$message}}
                                                    </p>
                                                @enderror
                                            </div>
                                            <div class="col-3 mb-2">
                                                <label for="precio_producto" class="form-label">Precio producto</label>
                                                <input type="number" class="form-control" id="precio_producto" required readonly>
                                                @error('precio_producto')
                                                    <input value="errorRegistrar" id="tipoAlerta" hidden>
                                                    <p class="text-danger fw-bold">
                                                        * {{$message}}
                                                    </p>
                                                @enderror
                                            </div>
                                            <div class="col-2 mb-2">
                                                <label for="cantidad_detalle_compra" class="form-label">Cantidad</label>
                                                <input type="text" class="form-control" id="cantidad_detalle_compra" required>
                                                @error('cantidad_detalle_compra')
                                                    <input value="errorRegistrar" id="tipoAlerta" hidden>
                                                    <p class="text-danger fw-bold">
                                                        * {{$message}}
                                                    </p>
                                                @enderror
                                            </div>
                                            <div class="col-2 mb-2 text-white">
                                                <label class="form-label">Agregar producto</label>
                                                <input type="button" onclick="agregarProducto()" class="form-control btn btn-success" value="Agregar" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-9 mb-2">
                                                <label class="form-label">Lista de productos</label>
                                                <table class="table table-striped table-hover table-bordered">
                                                    <thead class="table-dark">
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Nombre</th>
                                                            <th>Cantidad</th>
                                                            <th>Precio</th>
                                                            <th>Subtotal</th>
                                                            <th>Opciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tablaProductos">
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-3 mb-2">
                                                <label for="total_compra" class="form-label">Costo total</label>
                                                <input type="text" class="form-control" id="total_compra" name="total_compra" required readonly>
                                                @error('total_compra')
                                                    <input value="errorRegistrar" id="tipoAlerta" hidden>
                                                    <p class="text-danger fw-bold">
                                                        * {{$message}}
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-success registrar">Registrar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <table id="tabla" class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Costo total</th>
                            <th>Fecha de pedido</th>
                            <th>Fecha de entrega</th>
                            <th>Proveedor</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($compra as $compras)
                        <tr>
                            <td>{{ $compras -> id_compra }}</td>
                            <td>{{ $compras -> total_compra}}</td>
                            <td>{{ $compras -> fecha_pedido_compra }}</td>
                            <td>{{ $compras -> fecha_entrega_compra }}</td>
                            <td>{{ $compras -> nombre_proveedor}}</td>
                            <td>
                                <div class='d-flex justify-content-evenly'>
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ver-{{ $compras -> id_compra }}">
                                        Ver
                                    </button>
                                    @include('crud.compra.gestionCompra.ver')
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editar-{{ $compras -> id_compra }}">
                                        Editar
                                    </button>
                                    @include('crud.compra.gestionCompra.editar')
                                    <form action="{{ route('compra.destroy', $compras->id_compra) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger cancelar">
                                            Cancelar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-4 d-flex justify-content-center">
            <div class="d-flex d-inline-flex flex-column justify-content-center align-items-center p-2">
                <div class="bg-dark text-white text-center p-2 rounded-3 mb-2">
                    <p class="text-center fs-5 fw-bolder">Compras registradas</p>
                    <div class="d-flex justify-content-center align-items-center fs-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-cart me-1" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </svg>
                        <p class="fw-bold m-0">{{ $totalCompra }} </p>
                    </div>
                </div>
                <a class="btn btn-warning mb-2" href="{{ url('compra/report') }}">
                    Generar reporte
                </a>
            </div>
            <div class="d-flex d-inline-flex flex-column justify-content-center align-items-center p-2">
                <div class="bg-dark text-white text-center p-2 rounded-3 mb-2">
                    <p class="text-center fs-5 fw-bolder">Compras canceladas</p>
                    <div class="d-flex justify-content-center align-items-center fs-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-cart-x me-1" viewBox="0 0 16 16">
                        <path d="M7.354 5.646a.5.5 0 1 0-.708.708L7.793 7.5 6.646 8.646a.5.5 0 1 0 .708.708L8.5 8.207l1.146 1.147a.5.5 0 0 0 .708-.708L9.207 7.5l1.147-1.146a.5.5 0 0 0-.708-.708L8.5 6.793 7.354 5.646z"/>
                        <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                    </svg>
                        <p class="fw-bold m-0">{{ $totalCompraCancelada }} </p>
                    </div>
                </div>
                <button class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#comprasCanceladas">
                    Compras canceladas
                </button>
            </div>
        </div>
        <div class="modal fade" id="comprasCanceladas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Compras canceladas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive p-2">
                            <table id="tabla" class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Costo total</th>
                                        <th>Fecha de pedido</th>
                                        <th>Fecha de entrega</th>
                                        <th>Proveedor</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($compraCancelada as $compras)
                                    <tr>
                                        <td>{{ $compras -> id_compra }}</td>
                                        <td>{{ $compras -> total_compra}}</td>
                                        <td>{{ $compras -> fecha_pedido_compra }}</td>
                                        <td>{{ $compras -> fecha_entrega_compra }}</td>
                                        <td>{{ $compras -> nombre_proveedor}}</td>
                                        <td>
                                            <div class='d-flex justify-content-evenly'>
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ver-{{ $compras -> id_compra }}">
                                                    Ver
                                                </button>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#restablecer-{{ $compras -> id_compra }}">
                                                    Restablecer
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success registrar">Registrar</button>
                    </div>
                </div>
            </div>
        </div>
        @foreach($compraCancelada as $compras)
            @include('crud.compra.gestionCompra.ver')
            <div class="modal fade" id="restablecer-{{ $compras -> id_compra }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable text-black">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Restablecer Compra</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('compra.restore', $compras->id_compra) }}" method="post">
                                @csrf
                                @method('PUT')
                                <center>
                                <div class="col-6 mb-2">
                                    <label for="estado_pedido_compra" class="form-label">Restablecer con estado...</label>
                                    <select class="form-select" name="estado_pedido_compra_{{ $compras->id_compra }}" required>
                                        @if(isset($compras->estado_pedido_compra))
                                            <option value="Entregado">Entregado</option>
                                            <option value="No entregado" selected>No entregado</option>
                                        @endif
                                    </select>
                                </div>
                                </center>
                        </div>
                        <div class="modal-footer">
                                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Restablecer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
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
<script src="{{ asset('js/compras.js') }}"></script>

<input value="la compra" id="mensajeAlerta" hidden>
<input value="Compra" id="mensajeAlerta1" hidden>
<input value="La compra" id="mensajeAlerta2" hidden>
@if (session('status'))
    @if (session('status') == 'registrado')
        <input value="registrado" id="tipoAlerta" hidden>
    @elseif (session('status') == 'actualizado')
        <input value="actualizado" id="tipoAlerta" hidden>
    @elseif (session('status') == 'cancelado')
        <input value="cancelado" id="tipoAlerta" hidden>
    @elseif (session('status') == 'restaurado')
        <input value="restaurado" id="tipoAlerta" hidden>
    @elseif (session('status') == 'listado')
        <input value="listado" id="tipoAlerta" hidden>
    @else
        <input value="error" id="tipoAlerta" hidden>
    @endif
@endif
<script src="{{ asset('js/alertas.js') }}"></script>
@stop