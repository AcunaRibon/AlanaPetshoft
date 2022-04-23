<table>
    <thead>
        <tr>
            <th>ID Compra</th>
            <th>Costo total</th>
            <th>Fecha de pedido</th>
            <th>Fecha de entrega</th>
            <th>Proveedor</th>
            <th>ID Detalle Compra</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Producto</th>
        </tr>
    </thead>
    <tbody>
        @foreach($compra as $posicion => $compras)
            @if($posicion >= 1)
                <tr>
                    @if($compra[$posicion] -> id_compra == $compra[$posicion - 1] -> id_compra)
                        <td colspan="5"></td>
                        <td>{{ $compras -> id_detalle_compra }}</td>
                        <td>{{ $compras -> cantidad_detalle_compra }}</td>
                        <td>{{ $compras -> precio_detalle_compra }}</td>
                        <td>{{ $compras -> nombre_producto }}</td>
                    @else
                        <td>{{ $compras -> id_compra }}</td>
                        <td>{{ $compras -> total_compra}}</td>
                        <td>{{ $compras -> fecha_pedido_compra }}</td>
                        <td>{{ $compras -> fecha_entrega_compra }}</td>
                        <td>{{ $compras -> nombre_proveedor}}</td>
                        <td>{{ $compras -> id_detalle_compra }}</td>
                        <td>{{ $compras -> cantidad_detalle_compra }}</td>
                        <td>{{ $compras -> precio_detalle_compra }}</td>
                        <td>{{ $compras -> nombre_producto }}</td>
                    @endif
                </tr>
            @else
                <tr>
                    <td>{{ $compras -> id_compra }}</td>
                    <td>{{ $compras -> total_compra}}</td>
                    <td>{{ $compras -> fecha_pedido_compra }}</td>
                    <td>{{ $compras -> fecha_entrega_compra }}</td>
                    <td>{{ $compras -> nombre_proveedor}}</td>
                    <td>{{ $compras -> id_detalle_compra }}</td>
                    <td>{{ $compras -> cantidad_detalle_compra }}</td>
                    <td>{{ $compras -> precio_detalle_compra }}</td>
                    <td>{{ $compras -> nombre_producto }}</td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>