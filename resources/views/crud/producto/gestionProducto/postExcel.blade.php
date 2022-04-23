<table>
    <tbody>
        @foreach ($productos as $producto)
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Existencia</th>
            
        </tr>
        <tr>

            <td>{{$producto-> id_producto}}</td>
            <td>{{$producto-> nombre_producto}}</td>
            <td>{{$producto-> precio_producto}}</td>
            <td>{{isset($producto-> existencia_producto)?$producto-> existencia_producto:0}}</td>

        </tr>
        <tr>
            <th>Calificación</th>
            <th>Total_Calificación</th>
        </tr>
        @foreach ($calificaciones as $calificacion)
        <?php if ($producto->id_producto == $calificacion->producto_id) { ?>
            <tr>

                <td>{{$calificacion-> valor_calificacion_producto}}</td>
                <td>{{$calificacion-> total_Calificaciones}}</td>


            </tr>
        <?php
        }
        ?>


        @endforeach
        @endforeach
    </tbody>
</table>