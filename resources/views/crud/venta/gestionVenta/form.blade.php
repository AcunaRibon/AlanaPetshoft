<div class="row">
    <div class="col-4 mb-2">
        <label for="fecha_venta" class="form-label">Fecha de la venta:</label>
        <input type="date" id="fecha_venta{{$tipo}}" name="fecha_venta{{$tipo}}" class="form-control @error('fecha_venta'.$tipo) is-invalid @enderror" value="{{isset($venta->fecha_venta)?$venta->fecha_venta:old('fecha_venta'.$tipo)}}" autocomplete="fecha_venta" autofocus title="Fecha en que se hace la venta">
        @error('fecha_venta'.$tipo)
        <input value="{{$modo}}" id="tipoAlerta" hidden>
        <p class="text-danger fw-bold">
            * {{$message}}
        </p>
        @enderror
    </div>
    <div class="col-4 mb-2">
        <label for="cliente_id" class="form-label">Cliente: </label>
        <select name="cliente_id{{$tipo}}" id="cliente_id{{$tipo}}" class="form-select @error('cliente_id'.$tipo) is-invalid @enderror" autocomplete="cliente_id" autofocus title="Cliente que hace la venta">

            <?php
            if (isset($venta->cliente_id) == false) {
            ?>
                <option selected disabled>Selecciona una opción</option>

            <?php
            }
            ?>

            @foreach($Clientes as $cliente)
            <option <?php
                    if (isset($venta->cliente_id)) {
                        if ($cliente->id_cliente == $venta->cliente_id) {
                    ?> selected <?php
                                    }
                                } else if (old('cliente_id'.$tipo) == $cliente->id_cliente) {
                                        ?> selected <?php
                                        }
                                            ?> value="{{$cliente->id_cliente}}">{{$cliente->nombres_cliente}} {{$cliente->apellidos_cliente}}</option>
            @endforeach
        </select>
        @error('cliente_id'.$tipo)
        <input value="{{$modo}}" id="tipoAlerta" hidden>
        <p class="text-danger fw-bold">
            * {{$message}}
        </p>
        @enderror
    </div>
    <div class="col-4 mb-2">
        <label for="domiciliario_documento" class="form-label">Domiciliario: </label>
        <select name="domiciliario_documento{{$tipo}}" id="domiciliario_documento{{$tipo}}" class="form-select  @error('domiciliario_documento'.$tipo) is-invalid @enderror" autocomplete="domiciliario_documento" autofocus title="Domiciliario que entregará la venta">
            <?php
            if (isset($venta->domiciliario_documento) == false) {
            ?>
                <option selected disabled>Selecciona una opción</option>
            <?php
            }
            ?>
            @foreach($Domiciliarios as $Domiciliario)
            <option <?php
                    if (isset($venta->domiciliario_documento)) {
                        if ($Domiciliario->documento_domiciliario == $venta->domiciliario_documento) {
                    ?>selected <?php
                                    }
                                } else if (old('domiciliario_documento'.$tipo) == $Domiciliario->documento_domiciliario) {
                                        ?> selected <?php
                                        }
                                            ?> value="{{$Domiciliario->documento_domiciliario }}">{{$Domiciliario->nombres_domiciliario}} {{$Domiciliario->apellidos_domiciliario}}</option>
            @endforeach
        </select>
        @error('domiciliario_documento'.$tipo)
        <input value="{{$modo}}" id="tipoAlerta" hidden>
        <p class="text-danger fw-bold">
            * {{$message}}
        </p>
        @enderror
    </div>
</div>
<div class="row">
    <div class="col-3 mb-2">
        <label for="producto_id{{isset($venta->id_venta)?$venta->id_venta:0}}" class="form-label">Producto: </label>
        <select name="producto_id" id="producto_id{{isset($venta->id_venta)?$venta->id_venta:0}}" class="form-select" onchange="colocar_precio(<?php echo isset($venta->id_venta) ? $venta->id_venta : 0 ?>)" title="Producto a agregar">
            <option value="">Seleccione una opción</option>
            @foreach($Productos as $Producto)
            <option precio="{{$Producto->precio_producto}}" value="{{$Producto->id_producto}}">{{$Producto->nombre_producto}}</option>
            @endforeach
        </select>

    </div>
    <div class="col-3 mb-2">
        <label for="cantidad_detalle_venta{{isset($venta->id_venta)?$venta->id_venta:0}}" class="form-label">Cantidad: </label>
        <input type="number" id="cantidad_detalle_venta{{isset($venta->id_venta)?$venta->id_venta:0}}" name="cantidad_detalle_venta" class="form-control" title="Cantidad del producto seleccionado" min=0>
    </div>
    <div class="col-3 mb-2">
        <label for="precio_detalle_venta{{isset($venta->id_venta)?$venta->id_venta:0}}" class="form-label">Precio: </label>
        <input type="number" id="precio_detalle_venta{{isset($venta->id_venta)?$venta->id_venta:0}}" name="precio_detalle_venta" class="form-control" readonly title="Precio del producto por unidad">
    </div>
    <div class="col-3 mb-2 text-white">
        <label class="form-label" for="agregarbtn">Agregar producto</label>
        <input type="button" onclick="agregar_producto(<?php echo isset($venta->id_venta) ? $venta->id_venta : 0 ?>)" id="agregarbtn" name="" value="Agregar" class="form-control btn btn-success" title="Agregar el producto a la tabla">
    </div>
</div>
<div class="row">
    <div class="col-3 mb-2">
        <label for="estado_venta_id" class="form-label">Estado:</label>
        <select name="estado_venta_id{{$tipo}}" id="estado_venta_id{{$tipo}}" class="form-select @error('estado_venta_id'.$tipo) is-invalid @enderror" autocomplete="estado_venta_id" autofocus title="Estado que va a tener la venta">
            <?php
            if (isset($venta->estado_venta_id) == false) {
            ?>
                <option selected disabled >Selecciona una opción</option>
            <?php
            }
            ?>
            @foreach($estados as $estado)
            <option <?php
                    if (isset($venta->estado_venta_id)) {
                        if ($estado->id_estado_venta == $venta->estado_venta_id) {
                    ?>selected <?php
                                    }
                                } else if (old('estado_venta_id'.$tipo) == $estado->id_estado_venta) {
                                        ?> selected <?php
                                        }
                                            ?>value="{{$estado->id_estado_venta}}">{{$estado->nombre_estado_venta}}</option>
            @endforeach
            )
        </select>
        @error('estado_venta_id'.$tipo)
        <input value="{{$modo}}" id="tipoAlerta" hidden>
        <p class="text-danger fw-bold">
            * {{$message}}
        </p>
        @enderror
    </div>
    <div class="col-3 mb-2">
        <label for="calificacion_servicio_venta{{$tipo}}" class="form-label">Calificación Servicio:</label>
        <select name="calificacion_servicio_venta{{$tipo}}" id="calificacion_servicio_venta{{$tipo}}" class="form-select @error('calificacion_servicio_venta'.$tipo) is-invalid @enderror" autofocus  autocomplete="calificacion_servicio_venta" title="Calificación del servicio que da el cliente">
            <?php
            if (isset($venta->calificacion_servicio_venta) == false) {
            ?>
                 <option selected disabled >Selecciona una opción</option>
            <?php
            }
            ?>
            <option  <?php
                    if (isset($venta->calificacion_servicio_venta)) {
                        if ($venta->calificacion_servicio_venta==1) {
                    ?> selected <?php
                                    }
                                 else if (old('calificacion_servicio_venta'.$tipo) == 1) {
                                        ?>selected <?php }}?>value="1"> Pésima</option>
            <option <?php
                    if (isset($venta->calificacion_servicio_venta)) {
                        if ($venta->calificacion_servicio_venta == 2) {
                    ?> selected <?php
                                    }
                                 else if (old('calificacion_servicio_venta'.$tipo) == 2) {
                                    ?>selected <?php }}?> value="2"> mala</option>
            <option <?php
                    if (isset($venta->calificacion_servicio_venta)) {
                        if ($venta->calificacion_servicio_venta == 3) {
                    ?> selected <?php
                                    }
                                 else if (old('calificacion_servicio_venta'.$tipo) == 3) {
                                    ?>selected <?php }}?> value="3"> regular</option>
            <option <?php
                    if (isset($venta->calificacion_servicio_venta)) {
                        if ($venta->calificacion_servicio_venta == 3) {
                    ?> selected <?php
                                    }
                                else if (old('calificacion_servicio_venta'.$tipo) == 4) {
                                    ?>selected <?php }}?> value="4"> buena</option>
            <option <?php
                    if (isset($venta->calificacion_servicio_venta)) {
                        if ($venta->calificacion_servicio_venta == 5) {
                    ?> selected <?php
                                    }
                                 else if (old('calificacion_servicio_venta'.$tipo) == 5) {
                                    ?>selected <?php }}?> value="5"> excelente</option>
        </select>
        @error('calificacion_servicio_venta'.$tipo)
        <input value="{{$modo}}" id="tipoAlerta" hidden>
        <p class="text-danger fw-bold">
            * {{$message}}
        </p>
        @enderror
    </div>
    <div class="col-3 mb-2">
        <label for="descuento_venta" class="form-label">Descuento: </label>
        <input type="number" id="descuento_venta{{$tipo}}" name="descuento_venta{{$tipo}}" class="form-control @error('descuento_venta'.$tipo) is-invalid @enderror" autocomplete="descuento_venta" autofocus placeholder="00%" value="{{isset($venta->descuento_venta)?$venta->descuento_venta:old('descuento_venta'.$tipo)}}" title="Descuento que va a tener la venta">
        @error('descuento_venta'.$tipo)
        <input value="{{$modo}}" id="tipoAlerta" hidden>
        <p class="text-danger fw-bold">
            * {{$message}}
        </p>
        @enderror
    </div>
    <div class="col-3 mb-2">
        <label for="total_venta{{isset($venta->id_venta)?$venta->id_venta:0}}" class="form-label">Total:</label>
        <input type="number" id="total_venta{{isset($venta->id_venta)?$venta->id_venta:0}}" name="total_venta" class="form-control" value="{{isset($venta->total_venta)?$venta->total_venta:''}}" readonly title="Suma de todos lo subtotales de los productos">
    </div>

</div>
<div class="row">
    <div class="col-12 mb-2">
        <label class="form-label">Lista de productos</label>
        <table class="table table-striped table-hover table-bordered" id="tablaP{{isset($venta->id_venta)?$venta->id_venta:0}}">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Subtotal</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody id="tablaPP{{isset($venta->id_venta)?$venta->id_venta:0}}">


                <?php
                if (isset($venta->id_venta)) {


                ?>
                    @foreach($detalles as $key => $detalle)
                    <?php
                    if ($venta->id_venta == $detalle->venta_id) {


                    ?>
                        <tr id="tr{{isset($venta->id_venta) ? $venta->id_venta : 0}}_{{$detalle->producto_id}}">
                            <td>
                                <input type="hidden" name="productos_id[]" value="{{$detalle->producto_id}}" />
                                <input type="hidden" name="cantidades[]" id="cantidadDetalle{{isset($venta->id_venta) ? $venta->id_venta : 0}}_{{$detalle->producto_id}}" value="{{$detalle->cantidad_detalle_venta}}" />
                                {{$detalle->producto_id}}
                            </td>
                            <td>
                                {{$detalle->nombre_producto}}
                            </td>
                            <td id="cd{{isset($venta->id_venta) ? $venta->id_venta : 0}}_{{$detalle->producto_id}}">{{$detalle->cantidad_detalle_venta}}</td>
                            <td id="st{{isset($venta->id_venta) ? $venta->id_venta : 0}}_{{$detalle->producto_id}}">{{$detalle->precio_producto}}</td>
                            <td>{{$detalle->precio_producto*$detalle->cantidad_detalle_venta}}</td>
                            <td>

                                <button type="button" title="Quitar producto" class="btn btn-danger" onclick="eliminar_producto(<?php echo $detalle->producto_id  ?>,<?php echo $detalle->precio_producto * $detalle->cantidad_detalle_venta  ?>, <?php echo isset($venta->id_venta) ? $venta->id_venta : 0 ?>)" >
                                    x
                                </button>



                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    @endforeach
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

