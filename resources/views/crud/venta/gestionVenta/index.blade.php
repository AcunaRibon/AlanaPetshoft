@extends('adminlte::page')

@section('title', 'Ventas')

@section('content')

<div class="container pt-5">
    <div class="row">
        <div class="col-12 col-md-10">
            <div class="table-responsive p-2">
                <div class="d-flex justify-content-between">
                    <h2 class="text-center">Venta</h2>
                    <button type="button" class="btn btn-dark mb-2" data-bs-toggle="modal" data-bs-target="#registrar" title="Registrar Venta">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-plus-lg me-1" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                        </svg>
                        Registrar
                    </button>
                </div>
                <div class="modal fade" id="registrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Registrar Venta</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <form action="{{route('venta.store')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @include('crud.venta.gestionVenta.form',['modo'=>'errorRegistrar','tipo'=>'1'])

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" title="Cerrar ventana">Cerrar</button>
                                <button type="submit" class="btn btn-success registrar" title="Enviar formulario">Registrar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <table id="tabla" class="table table-ligth table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Fecha de venta</th>
                            <th>Costo Total</th>
                            <th>Descuento</th>
                            <th>Domicilario</th>
                            <th>Cliente</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ventas as $venta)
                        <tr>
                            <td>{{$venta-> id_venta}}</td>
                            <td>{{$venta-> fecha_venta}}</td>
                            <td>{{$venta-> total_venta}}</td>
                            <td>{{$venta-> descuento_venta}}</td>
                            <td>{{$venta-> nombres_domiciliario}} {{$venta-> apellidos_domiciliario}}</td>
                            <td>{{$venta-> nombres_cliente}} {{$venta-> apellidos_cliente}}</td>
                            <td>{{$venta-> nombre_estado_venta}}

                                <div class="modal fade" id="ver_{{$venta->id_venta}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Detalle Venta</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container-fluid">
                                                    <table id="tabla" class="table table-ligth table-striped table-hover">
                                                        <thead class="table-dark">
                                                            <tr>
                                                                <th>id</th>
                                                                <th>Nombre</th>
                                                                <th>Cantidad</th>
                                                                <th>Precio</th>
                                                                <th>Subtotal</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody id="tablaProductos{{isset($venta->id_venta)?$venta->id_venta:0}}">



                                                            @foreach($detalles as $key => $detalle)
                                                            <?php
                                                            if ($venta->id_venta == $detalle->venta_id) {


                                                                ?>
                                                                <tr>
                                                                    <td>{{$detalle->producto_id}}</td>
                                                                    <td>{{$detalle->nombre_producto}} </td>
                                                                    <td>{{$detalle->cantidad_detalle_venta}}</td>
                                                                    <td>{{$detalle->precio_producto}}</td>
                                                                    <td>{{$detalle->precio_producto*$detalle->cantidad_detalle_venta}}</td>

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
                                            <li> <button type="button" class="dropdown-item fw-bold" data-bs-toggle="modal" data-bs-target="#ver_{{$venta->id_venta}}" title="Ver detalle de venta">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-eye me-1" viewBox="0 0 16 16">
                                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                    </svg>
                                                    ver
                                                </button>
                                            </li>
                                            <li> <button type="button" class="dropdown-item fw-bold" data-bs-toggle="modal" data-bs-target="#editar_{{$venta->id_venta}}" title="Editar venta">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-pen me-1" viewBox="0 0 16 16">
                                                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                                    </svg>
                                                    Editar
                                                </button>
                                            </li>
                                            <li>
                                                <form action="{{ route('venta.destroy', $venta->id_venta) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item fw-bold cancelar" title="Cancelar la venta">
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

                                    <div class="modal fade" id="editar_{{$venta->id_venta}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Editar Venta</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container-fluid">
                                                        <form action="{{route('venta.update',$venta->id_venta)}}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            {{method_field('PATCH')}}
                                                            @include('crud.venta.gestionVenta.form',['modo'=>'errorModificar','tipo'=>'2'])


                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" title="Cerra ventana" data-bs-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-success actualizar" title="Actualizar venta">Actualizar</button>
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
        
        <div class="col-12 col-md-2  d-flex flex-column justify-content-center align-items-center ">
            <div class="bg-dark text-white text-center p-2 rounded-3 mb-2 mt-5">
                <p class="text-center fs-5 fw-bolder">Ventas registradas</p>
                <div class="d-flex justify-content-center align-items-center fs-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-cart me-1" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                    </svg>
                    <p class="fw-bold m-0"> {{$totalventa}}</p>
                </div>
            </div>

            <button class="btn btn-warning mb-2" title="Generar nuevo reporte de ventas" data-bs-toggle="modal" data-bs-target="#informe" title="Generar un nuervo reporte">
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
                            <form action="{{ route('venta.export') }}" method="get">
                                @csrf
                                <div class="row">
                                    <p class="mb-4">Complete el siguiente formulario para la generación del reporte:</p>

                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mb-2">
                                        <label for="fecha_inicio" class="form-label">Fecha de inicio</label>
                                        <input type="date" class="form-control" name="fecha_inicio" required title="Ingresar fecha de inicio" value="{{ old('fecha_inicio') }}">
                                        @error('fecha_inicio')
                                        <input value="errorInforme" id="tipoAlerta" hidden>
                                        <p class="text-danger fw-bold">
                                            * {{$message}}
                                        </p>
                                        @enderror
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mb-2">
                                        <label for="fecha_fin" class="form-label">Fecha de fin</label>
                                        <input type="date" class="form-control" name="fecha_fin" required title="Ingresar fecha de fin" value="{{ old('fecha_fin') }}">
                                        @error('fecha_fin')
                                        <input value="errorInforme" id="tipoAlerta" hidden>
                                        <p class="text-danger fw-bold">
                                            * {{$message}}
                                        </p>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-2">
                                        <label for="columna" class="form-label">Ordenar por columna:</label>
                                        <select name="columna" class="form-select" title="Seleccionar columna para ordenar los registros">
                                            <option value="venta.id_venta" {{ old('columna') == 'venta.id_venta' ? 'selected' : '' }}>ID de venta</option>
                                            <option value="venta.fecha_venta" {{ old('columna') == 'venta.fecha_venta' ? 'selected' : '' }}>Fecha</option>
                                            <option value="venta.descuento_venta" {{ old('columna') == 'venta.descuento_venta' ? 'selected' : '' }}>Descuento</option>
                                            <option value="venta.total_venta" {{ old('columna') == 'venta.total_venta' ? 'selected' : '' }}>Total de la venta</option>
                                            <option value="venta.calificacion_servicio_venta" {{ old('columna') == 'venta.calificacion_servicio_venta' ? 'selected' : '' }}>Calificación</option>
                                            <option value="cliente.nombres_cliente" {{ old('columna') == 'cliente.nombres_cliente' ? 'selected' : '' }}>Cliente</option>
                                            <option value="domiciliario.nombres_domiciliario" {{ old('columna') == 'domiciliario.nombres_domiciliario' ? 'selected' : '' }}>Domiciliario</option>
                                            <option value="estado_venta.nombre_estado_venta" {{ old('columna') == 'estado_venta.nombre_estado_venta' ? 'selected' : '' }}>Estado</option>
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


            <button type="button" class="btn btn-danger mb-2" data-bs-toggle="modal" data-bs-target="#ventasInactivos" title="Ventas canceladas">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-x-lg me-1" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z" />
                    <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z" />
                </svg>
                canceladas
            </button>
            <div class="modal fade" id="ventasInactivos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                    <div class="modal-content">
                        <div class="modal-header ">
                            <h5 class="modal-title" id="exampleModalLabel">Ventas canceladas</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">

                                <table id="tabla" class="table table-ligth table-striped table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>ID</th>
                                            <th>Fecha de venta</th>
                                            <th>Costo Total</th>
                                            <th>Domicilario</th>
                                            <th>Cliente</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($ventasCanceladas as $venta)
                                        <tr>
                                            <td>{{$venta-> id_venta}}</td>
                                            <td>{{$venta-> fecha_venta}}</td>
                                            <td>{{$venta-> total_venta}}</td>
                                            <td>{{$venta-> nombres_domiciliario}} {{$venta-> apellidos_domiciliario}}</td>
                                            <td>{{$venta-> nombres_cliente}} {{$venta-> apellidos_cliente}}</td>
                                            <td>{{$venta-> nombre_estado_venta}}</td>
                                            <td>
                                                <div class="d-flex justify-content-between">

                                                    <button type="button" class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#verventaInactiva_{{$venta->id_venta}}" title="Ver el detalle de la venta cancelada">
                                                        ver
                                                    </button>
                                                    <form action="{{ route('venta.destroy', $venta->id_venta) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger habilitar" title="Restablecer venta">
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
                                <button type="button" class="btn btn-dark" title="Cerrar ventana" data-bs-dismiss="modal">Cerrar</button>
                                
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            @foreach($ventasCanceladas as $venta)
            <div class="modal fade" id="verventaInactiva_{{$venta->id_venta}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detalle de venta cancelada</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <table id="tabla" class="table table-ligth table-striped table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>id</th>
                                            <th>Nombre</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                            <th>Subtotal</th>

                                        </tr>
                                    </thead>
                                    <tbody id="tablaProductos{{isset($venta->id_venta)?$venta->id_venta:0}}">



                                        @foreach($detalles as $key => $detalle)
                                        <?php
                                        if ($venta->id_venta == $detalle->venta_id) {


                                            ?>
                                            <tr>
                                                <td>{{$detalle->producto_id}}</td>
                                                <td>{{$detalle->nombre_producto}} </td>
                                                <td>{{$detalle->cantidad_detalle_venta}}</td>
                                                <td>{{$detalle->precio_producto}}</td>
                                                <td>{{$detalle->precio_producto*$detalle->cantidad_detalle_venta}}</td>

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
            @endforeach
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
<script src="{{ asset('js/ventas.js') }}" defer></script>

<input value="la venta" id="mensajeAlerta" hidden>
<input value="Venta" id="mensajeAlerta1" hidden>
<input value="La venta" id="mensajeAlerta2" hidden>

@if (session('status'))
@if (session('status') == 'registrado')
<input value="registrado" id="tipoAlerta" hidden>
@elseif (session('status') == 'actualizado')
<input value="actualizado" id="tipoAlerta" hidden>
@elseif (session('status') == 'cancelado')
<input value="cancelado" id="tipoAlerta" hidden>
@elseif (session('status') == 'restaurado')
<input value="restaurado" id="tipoAlerta" hidden>
@elseif (session('status') == 'Cantidad excedida')
<input value="Cantidad excedida" id="tipoAlerta" hidden>
@else
<input value="error" id="tipoAlerta" hidden>
@endif
@endif
<script src="{{ asset('js/alertas.js') }}"></script>
@stop