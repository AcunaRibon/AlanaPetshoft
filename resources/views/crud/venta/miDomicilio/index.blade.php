@extends('adminlte::page')

@section('title', 'Mi Domciilio')

@section('content')
<div class="container pt-5">

    <div class="row">

        <?php foreach ($estadosVentas as $estadoVenta) : ?>
            <div class="col-sm-4 ">
                <div class="card-columns-fluid">
                    <div class="card  bg-light">
                        <div class="card-body">
                            <h5 class="card-text"><b><?php echo $estadoVenta->nombre_estado_venta ?></b></h5>
                            <?php foreach ($Activados as $activos) : ?>
                                <p class="card-text card-title" style="text-align:center;">
                                <h3><?php if ($activos->estado_venta_id == $estadoVenta->id_estado_venta) {

                                    ?>{{$activos->Contador}}<?php } ?></h3>
                                </p>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>

            </div>
        <?php endforeach; ?>
    </div>
    <div class="row">
        <div class="col">

            <div class="table-responsive p-2">
                <div class="d-flex justify-content-between">

                    <h2 class="text-center">Mis Domicilios</h2>

                    <div class="modal fade" id="registrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Registrar Venta</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <table id="tabla" class="table table-ligth table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Id Venta</th>
                            <th>Fecha de Venta</th>

                            <th>Descuento de Venta</th>
                            <th>Precio Total</th>
                            <th>Nombre del Domiciliario</th>
                            <th>Opciones</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($misDomicilios as $domicilio)
                        <tr>
                            <td>{{$domicilio->id_venta}}</td>

                            <td>{{$domicilio->fecha_venta}}</td>

                            <td>{{$domicilio->descuento_venta}}</td>
                            <td>{{$domicilio->total_venta}}</td>
                            <td>{{$domicilio->nombres_domiciliario}}
                                <div class="modal fade" id="ver_{{$domicilio->id_venta}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Editar Venta</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container-fluid">
                                                    <table id="tabla" class="table table-ligth table-striped table-hover">
                                                        <thead class="table-dark">
                                                            <tr>

                                                                <th>Nombre del Producto</th>
                                                                <th>Precio</th>
                                                                <th>Cantidads</th>


                                                            </tr>
                                                        </thead>
                                                        <tbody id="tablaProductos{{isset($venta->id_venta)?$venta->id_venta:0}}">



                                                            @foreach($detalleDomicilio as $key => $detalleD)
                                                            <?php
                                                            if ($domicilio->id_venta == $detalleD->id_venta) {


                                                            ?>
                                                                <tr>


                                                                    <td>{{$detalleD->nombre_producto}}</td>
                                                                    <td>{{$detalleD->precio_producto}}</td>
                                                                    <td>{{$detalleD->cantidad_detalle_venta}}</td>


                                                                </tr>
                                                            <?php
                                                            }
                                                            ?>
                                                            @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-between">

                                    <div class="dropdown">
                                        <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" title="Acciones disponibles">
                                            Acciones
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                            <li> <button type="button" class="dropdown-item fw-bold" data-bs-toggle="modal" data-bs-target="#ver_{{$domicilio->id_venta}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-eye me-1" viewBox="0 0 16 16">
                                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                    </svg>
                                                    ver
                                                </button>
                                            </li>
                                        </ul>
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

    @endsection

    @section('css')
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.css" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/estilo.css') }}" rel="stylesheet">
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