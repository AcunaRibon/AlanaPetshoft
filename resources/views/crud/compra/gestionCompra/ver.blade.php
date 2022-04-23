<div class="modal fade" id="ver-{{ $compras -> id_compra }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl text-black">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ver Compra</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-4 mb-2">
                            <label for="id_compra" class="form-label">ID Compra</label>
                            <input type="text" class="form-control" id="id_compra" name="id_compra" value="{{ isset($compras->id_compra)?$compras->id_compra:'' }}" readonly>
                        </div>
                        <div class="col-4 mb-2">
                            <label for="fecha_pedido_compra" class="form-label">Fecha de pedido</label>
                            <input type="date" class="form-control" id="fecha_pedido_compra" name="fecha_pedido_compra" value="{{ isset($compras->fecha_pedido_compra)?$compras->fecha_pedido_compra:'' }}" readonly>
                        </div>
                        <div class="col-4 mb-2">
                            <label for="fecha_entrega_compra" class="form-label">Fecha de entrega</label>
                            <input type="date" class="form-control" id="fecha_entrega_compra" name="fecha_entrega_compra" value="{{ isset($compras->fecha_entrega_compra)?$compras->fecha_entrega_compra:'' }}" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 mb-2">
                            <label for="estado_pedido_compra" class="form-label">Estado</label>
                            @if(isset($compras->estado_pedido_compra))
                                @if($compras->estado_pedido_compra == 'Entregado')
                                    <input type="text" class="form-control" id="estado_pedido_compra" name="estado_pedido_compra" value="Entregado" readonly>
                                @elseif($compras->estado_pedido_compra == 'No entregado')
                                    <input type="text" class="form-control" id="estado_pedido_compra" name="estado_pedido_compra" value="No entregado" readonly>
                                @else
                                    <input type="text" class="form-control" id="estado_pedido_compra" name="estado_pedido_compra" value="Cancelado" readonly>
                                @endif
                            @endif
                        </div>
                        <div class="col-4 mb-2">
                            <label for="proveedor_id" class="form-label">Proveedor</label>
                            <input type="text" class="form-control" id="nombre_proveedor" name="nombre_proveedor" value="{{ isset($compras -> nombre_proveedor)?$compras -> nombre_proveedor:'' }}" readonly>
                        </div>
                        <div class="col-4 mb-2">
                            <label for="total_compra" class="form-label">total</label>
                            <input type="text" class="form-control" id="total_compra" name="total_compra" value="{{ isset($compras->total_compra)?$compras->total_compra:'' }}" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive p-2">
                                <hr>
                                <h5 class="text-center">Detalle de compra</h5>
                                <hr>
                                @if(count($detalleCompra) > 0)
                                    <table class="table table-striped table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID Detalle</th>
                                                <th>ID Producto</th>
                                                <th>Producto</th>
                                                <th>Precio Producto</th>
                                                <th>Cantidad</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($detalleCompra as $valor)
                                                @if($valor -> compra_id == $compras -> id_compra)
                                                <tr>
                                                    <td>{{ $valor->id_detalle_compra }}</td>
                                                    <td>{{ $valor->producto_id }}</td>
                                                    <td>{{ $valor->nombre_producto }}</td>
                                                    <td>{{ $valor->precio_producto }}</td>
                                                    <td>{{ $valor->cantidad_detalle_compra }}</td>
                                                    <td>{{ $valor->precio_detalle_compra }}</td>
                                                </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>