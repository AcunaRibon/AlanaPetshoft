<table>

    <tbody>
        @foreach($ventas as $venta)
        <tr>

            <th>Fecha de venta</th>
            <th>Costo Total</th>
            <th>Descuento</th>
            <th>Domicilario Documento</th>
            <th>Domicilario</th>
            <th>Cliente</th>
            <th>Estado</th>

        </tr>

        <tr>

            <td>{{$venta-> fecha_venta}}</td>
            <td>{{$venta-> total_venta}}</td>
            <td>{{$venta-> descuento_venta}}</td>
            <td>{{$venta-> domiciliario_documento}}</td>
            <td>{{$venta-> nombres_domiciliario}} {{$venta-> apellidos_domiciliario}}</td>
            <td>{{$venta-> nombres_cliente}} {{$venta-> apellidos_cliente}}</td>
            <td>{{$venta-> nombre_estado_venta}}</td>
        </tr>

        <tr>
            <th>id detalle venta</th>
            <th>Nombre Producto</th>
            <th>Cantidad Producto</th>
            <th>Precio Producto</th>
            <th>Subtotal Producto</th>

        </tr>

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
        @endforeach
    </tbody>
</table>