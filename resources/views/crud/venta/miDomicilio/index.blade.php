@extends('layouts.app')

@section('content')


<div class="container mt-6">
    <div class="row">
        <!-- my php code which uses x-path to get results from xml query. -->
        <?php foreach ($estadosVentas as $estadoVenta) : ?>
            <div class="col-sm-4 ">
                <div class="card-columns-fluid">
                    <div class="card  bg-light">
                        <div class="card-body">
                            <h5 class="card-text"><b><?php echo $estadoVenta->nombre_estado_venta ?></b></h5>
                            <?php foreach ($Activados as $activos) : ?>
                                <p class="card-text card-title"><b><?php if ($activos->estado_venta_id == $estadoVenta->id_estado_venta) {

                                                                    ?>{{$activos->Contador}}<?php } ?></b></p>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>

            </div>
        <?php endforeach; ?>
    </div>

    <div class="col">
        <div class="row">
            <div class="table-responsive p-2">
                <h2 class="text-center" style="text-align:center;">Mis Domicilios</h2>
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
                                <button type="button" class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#ver_{{$domicilio->id_venta}}">
                                    ver
                                </button>

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