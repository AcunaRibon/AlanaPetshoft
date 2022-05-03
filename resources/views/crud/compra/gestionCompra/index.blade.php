@extends('adminlte::page')

@section('title', 'Compras')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between px-2">
                <h2 class="text-center" title="Compras registradas">Compras</h2>
                <button type="button" class="btn btn-dark mb-2" data-bs-toggle="modal" data-bs-target="#registrar" title="Registrar compra">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-plus-lg me-1" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                    </svg>
                    Registrar
                </button>
            </div>
            <div class="modal fade" id="registrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Registrar Compra</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" title="Cerrar ventana"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <form action="{{ route('compra.store') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 col-xxl-3 mb-2">
                                            <label for="fecha_pedido_compra" class="form-label">Fecha de pedido</label>
                                            <input type="date" class="form-control @error('fecha_pedido_compra') is-invalid @enderror" id="fecha_pedido_compra" name="fecha_pedido_compra" value="{{ old('fecha_pedido_compra') }}" required title="Ingresar fecha de pedido">
                                            @error('fecha_pedido_compra')
                                                <input value="errorRegistrar" id="tipoAlerta" hidden>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 col-xxl-3 mb-2">
                                            <label for="fecha_entrega_compra" class="form-label">Fecha de entrega</label>
                                            <input type="date" class="form-control @error('fecha_entrega_compra') is-invalid @enderror" id="fecha_entrega_compra" name="fecha_entrega_compra" value="{{ old('fecha_entrega_compra') }}" required title="Ingresar fecha de entrega">
                                            @error('fecha_entrega_compra')
                                                <input value="errorRegistrar" id="tipoAlerta" hidden>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 col-xxl-3 mb-2">
                                            <label for="estado_pedido_compra" class="form-label">Estado</label>
                                            <select class="form-select @error('estado_pedido_compra') is-invalid @enderror" name="estado_pedido_compra" id="estado_pedido_compra" required title="Seleccionar estado de la compra">
                                                <option hidden value="">Seleccione un estado</option>
                                                <option value="Entregado" {{ old('estado_pedido_compra') == 'Entregado' ? 'selected' : '' }}>Entregado</option>
                                                <option value="No entregado" {{ old('estado_pedido_compra') == 'No entregado' ? 'selected' : '' }}>No entregado</option>
                                            </select>
                                            @error('estado_pedido_compra')
                                                <input value="errorRegistrar" id="tipoAlerta" hidden>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 col-xxl-3 mb-2">
                                            <label for="proveedor_id " class="form-label">Proveedor</label>
                                            <select class="form-select @error('proveedor_id') is-invalid @enderror" name="proveedor_id" id="proveedor_id" required title="Seleccionar proveedor">
                                                <option hidden value="">Seleccione un proveedor</option>
                                                @foreach ($proveedor as $proveedores)
                                                    <option value="{{ $proveedores->id_proveedor }}" {{ old('proveedor_id') == $proveedores->id_proveedor ? 'selected' : '' }}>{{ $proveedores->nombre_proveedor }}</option>
                                                @endforeach
                                            </select>
                                            @error('proveedor_id')
                                                <input value="errorRegistrar" id="tipoAlerta" hidden>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 col-xxl-4 mb-2">
                                            <label for="producto_id " class="form-label">Productos</label>
                                            <select class="form-select @error('producto_id') is-invalid @enderror" name="producto_id" id="producto_id" onchange="agregarPrecioProducto()" required title="Seleccionar productos">
                                                <option hidden value="">Seleccione los productos</option>
                                                @foreach ($producto as $productos)
                                                    <option precio="{{ $productos->precio_producto }}" value="{{ $productos->id_producto }}">{{ $productos->nombre_producto }}</option>
                                                @endforeach
                                            </select>
                                            @error('producto_id')
                                                <input value="errorRegistrar" id="tipoAlerta" hidden>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-3 col-xl-3 col-xxl-3 mb-2">
                                            <label for="precio_producto" class="form-label">Precio producto</label>
                                            <input type="number" class="form-control @error('precio_producto') is-invalid @enderror" id="precio_producto" required readonly title="Precio del producto seleccionado">
                                            @error('precio_producto')
                                                <input value="errorRegistrar" id="tipoAlerta" hidden>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-2 col-xl-2 col-xxl-2 mb-2">
                                            <label for="cantidad_detalle_compra" class="form-label">Cantidad</label>
                                            <input type="text" class="form-control @error('cantidad_detalle_compra') is-invalid @enderror" id="cantidad_detalle_compra" required title="Ingresar cantidad de productos">
                                            @error('cantidad_detalle_compra')
                                                <input value="errorRegistrar" id="tipoAlerta" hidden>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 col-xxl-3 mb-2 text-white">
                                            <label class="form-label">Agregar producto</label>
                                            <button type="button" onclick="agregarProducto()" class="form-control btn btn-success" title="Agregar producto ingresado">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-plus-lg me-1" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                                                </svg>
                                                Agregar
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9 col-xl-9 col-xxl-9 mb-2 table-responsive">
                                            <label class="form-label" title="Tabla de productos a comprar">Lista de productos</label>
                                            <table class="table table-striped table-hover">
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
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 col-xxl-3 mb-2">
                                            <label for="total_compra" class="form-label">Costo total</label>
                                            <input type="text" class="form-control @error('total_compra') is-invalid @enderror" id="total_compra" name="total_compra" required readonly title="Costo total de todos los productos">
                                            @error('total_compra')
                                                <input value="errorRegistrar" id="tipoAlerta" hidden>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" title="Cerrar ventana">
                                    Cerrar
                                </button>
                                <button type="submit" class="btn btn-success registrar" title="Registrar la compra">
                                    Registrar
                                </button>
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
                                    <div class="dropdown">
                                        <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" title="Acciones disponibles">
                                            Acciones
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                            <li>
                                                <button class="dropdown-item fw-bold" data-bs-toggle="modal" data-bs-target="#ver-{{ $compras -> id_compra }}" title="Ver compra">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-eye me-1" viewBox="0 0 16 16">
                                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                                    </svg>
                                                    Ver
                                                </button>
                                            </li>
                                            <li>
                                                <button class="dropdown-item fw-bold" data-bs-toggle="modal" data-bs-target="#editar-{{ $compras -> id_compra }}" title="Editar compra">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-pen me-1" viewBox="0 0 16 16">
                                                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                                    </svg>
                                                    Editar
                                                </button>
                                            </li>
                                            <li>
                                                <form action="{{ route('compra.destroy', $compras->id_compra) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item cancelar fw-bold" type="submit" title="Cancelar compra">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-x-lg me-1" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/>
                                                            <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/>
                                                        </svg>
                                                        Cancelar
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                    @include('crud.compra.gestionCompra.ver')
                                    @include('crud.compra.gestionCompra.editar')
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
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-truck me-1" viewBox="0 0 16 16">
                        <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                    </svg>
                        <p class="fw-bold m-0">{{ $totalCompra }} </p>
                    </div>
                </div>
                <button class="btn btn-warning mb-2" title="Generar nuevo reporte de compras" data-bs-toggle="modal" data-bs-target="#informe">
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
                                <form action="{{ route('compra.report') }}" method="get">
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
                                                <option value="compra.id_compra" {{ old('columna') == 'compra.id_compra' ? 'selected' : '' }}>ID de la compra</option>
                                                <option value="compra.total_compra" {{ old('columna') == 'compra.total_compra' ? 'selected' : '' }}>Costo total</option>
                                                <option value="compra.fecha_pedido_compra" {{ old('columna') == 'compra.fecha_pedido_compra' ? 'selected' : '' }}>Fecha de pedido</option>
                                                <option value="compra.fecha_entrega_compra" {{ old('columna') == 'compra.fecha_entrega_compra' ? 'selected' : '' }}>Fecha de entrega</option>
                                                <option value="compra.estado_pedido_compra" {{ old('columna') == 'compra.estado_pedido_compra' ? 'selected' : '' }}>Estado de la compra</option>
                                                <option value="compra.proveedor_id" {{ old('columna') == 'compra.proveedor_id' ? 'selected' : '' }}>Proveedor</option>
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
            <div class="d-flex d-inline-flex flex-column justify-content-center align-items-center p-2">
                <div class="bg-dark text-white text-center p-2 rounded-3 mb-2">
                    <p class="text-center fs-5 fw-bolder">Compras canceladas</p>
                    <div class="d-flex justify-content-center align-items-center fs-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-dash-circle me-1" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                    </svg>
                        <p class="fw-bold m-0">{{ $totalCompraCancelada }} </p>
                    </div>
                </div>
                <button class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#comprasCanceladas" title="Ver compras canceladas">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-x-lg me-1" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/>
                        <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/>
                    </svg>
                    Compras canceladas
                </button>
            </div>
        </div>
        <div class="modal fade" id="comprasCanceladas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Compras canceladas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" title="Cerrar ventana"></button>
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
                                            <div class="dropdown">
                                                <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" title="Acciones disponibles">
                                                    Acciones
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                                    <li>
                                                        <button class="dropdown-item fw-bold" data-bs-toggle="modal" data-bs-target="#ver-{{ $compras -> id_compra }}" title="Ver compra">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-eye me-1" viewBox="0 0 16 16">
                                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                                            </svg>
                                                            Ver
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button class="dropdown-item fw-bold" data-bs-toggle="modal" data-bs-target="#restablecer-{{ $compras -> id_compra }}" title="Restablecer compra">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-counterclockwise me-1" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z"/>
                                                            <path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z"/>
                                                        </svg>
                                                            Restablecer
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" title="Cerrar ventana">Cerrar</button>
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
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" title="Cerrar ventana"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('compra.restore', $compras->id_compra) }}" method="post">
                                @csrf
                                @method('PUT')
                                <center>
                                <div class="col-6 mb-2">
                                    <label for="estado_pedido_compra" class="form-label">Restablecer con estado...</label>
                                    <select class="form-select" name="estado_pedido_compra_{{ $compras->id_compra }}" required title="Estado de la compra">
                                        @if(isset($compras->estado_pedido_compra))
                                            <option value="Entregado">Entregado</option>
                                            <option value="No entregado" selected>No entregado</option>
                                        @endif
                                    </select>
                                </div>
                                </center>
                        </div>
                        <div class="modal-footer">
                                <button type="button" class="btn btn-dark" data-bs-dismiss="modal" title="Cerrar ventana">Cerrar</button>
                                <button type="submit" class="btn btn-primary" title="Restablecer compra">Restablecer</button>
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