<div class="modal fade" id="editar-{{ $compras -> id_compra }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl text-black">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Compra</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" title="Cerrar ventana"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form action="{{ route('compra.update', $compras->id_compra) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-4 mb-2">
                                <label for="id_compra" class="form-label">ID Compra</label>
                                <input type="text" class="form-control" id="id_compra" name="id_compra" value="{{ old('id_compra_m', $compras->id_compra) }}" readonly required title="ID de la compra">
                            </div>
                            <div class="col-4 mb-2">
                                <label for="fecha_pedido_compra" class="form-label">Fecha de pedido</label>
                                <input type="date" class="form-control" id="fecha_pedido_compra" name="fecha_pedido_compra_m" value="{{ old('fecha_pedido_compra_m', $compras->fecha_pedido_compra) }}" required title="Fecha de pedido">
                                @error('fecha_pedido_compra_m')
                                    <input value="errorModificar" id="tipoAlerta" hidden>
                                    <p class="text-danger fw-bold">
                                        * {{$message}}
                                    </p>
                                @enderror
                            </div>
                            <div class="col-4 mb-2">
                                <label for="fecha_entrega_compra" class="form-label">Fecha de entrega</label>
                                <input type="date" class="form-control" id="fecha_entrega_compra" name="fecha_entrega_compra_m" value="{{ old('fecha_entrega_compra_m', $compras->fecha_entrega_compra) }}" required title="Fecha de entrega">
                                @error('fecha_entrega_compra_m')
                                    <input value="errorModificar" id="tipoAlerta" hidden>
                                    <p class="text-danger fw-bold">
                                        * {{$message}}
                                    </p>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4 mb-2">
                                <label for="estado_pedido_compra" class="form-label">Estado</label>
                                <select class="form-select" name="estado_pedido_compra_m" id="estado_pedido_compra" required title="Estado de la compra">
                                    @if(isset($compras->estado_pedido_compra))
                                        @if($compras->estado_pedido_compra == 'Entregado')
                                            <option value="Entregado" {{ old('estado_pedido_compra_m') == 'Entregado' ? 'selected' : '' }}>Entregado</option>
                                            <option value="No entregado" {{ old('estado_pedido_compra_m') == 'No entregado' ? 'selected' : '' }}>No entregado</option>
                                            <option value="Cancelado" {{ old('estado_pedido_compra_m') == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                                        @elseif($compras->estado_pedido_compra == 'No entregado')
                                            <option value="No entregado" {{ old('estado_pedido_compra_m') == 'No entregado' ? 'selected' : '' }}>No entregado</option>
                                            <option value="Entregado" {{ old('estado_pedido_compra_m') == 'Entregado' ? 'selected' : '' }}>Entregado</option>
                                            <option value="Cancelado" {{ old('estado_pedido_compra_m') == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                                        @else
                                            <option value="Cancelado" {{ old('estado_pedido_compra_m') == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                                            <option value="Entregado" {{ old('estado_pedido_compra_m') == 'Entregado' ? 'selected' : '' }}>Entregado</option>
                                            <option value="No entregado" {{ old('estado_pedido_compra_m') == 'No entregado' ? 'selected' : '' }}>No entregado</option>
                                        @endif
                                    @endif
                                </select>
                                @error('estado_pedido_compra_m')
                                    <input value="errorModificar" id="tipoAlerta" hidden>
                                    <p class="text-danger fw-bold">
                                        * {{$message}}
                                    </p>
                                @enderror
                            </div>
                            <div class="col-4 mb-2">
                                <label for="proveedor_id " class="form-label">Proveedor</label>
                                <select class="form-select" name="proveedor_id_{{ $compras->id_compra }}" id="proveedor_id" required title="Proveedor">
                                    @if(isset($compras->proveedor_id))
                                        @foreach ($proveedor as $proveedores)
                                            @if($proveedores->id_proveedor == $compras->proveedor_id)
                                                <option selected value="{{ $proveedores->id_proveedor }}">{{ $proveedores->nombre_proveedor }}</option>
                                            @else
                                                <option value="{{ $proveedores->id_proveedor }}">{{ $proveedores->nombre_proveedor }}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-4 mb-2">
                                <label for="total_compra" class="form-label">Costo total</label>
                                <input type="text" class="form-control" id="total_compra_{{ $compras->id_compra }}" name="total_compra_m" value="{{ isset($compras->total_compra)?$compras->total_compra:'' }}" readonly required title="Costo total de la compra">
                                @error('total_compra_m')
                                    <input value="errorModificar" id="tipoAlerta" hidden>
                                    <p class="text-danger fw-bold">
                                        * {{$message}}
                                    </p>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <hr>
                                <h5 class="text-center" title="Productos comprados">Detalle de compra</h5>
                                <hr>
                                <div class="table-responsive p-2">
                                    @if(count($detalleCompra) > 0)
                                        <table class="table table-striped table-hover">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>ID Detalle</th>
                                                    <th>ID Producto</th>
                                                    <th>Producto</th>
                                                    <th>Precio Producto</th>
                                                    <th>Cantidad</th>
                                                    <th>Subtotal</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($detalleCompra as $valor)
                                                    @if($valor -> compra_id == $compras -> id_compra)
                                                    <tr id="productoEditar-{{ $valor->id_detalle_compra }}">
                                                        <td>
                                                            {{ $valor->id_detalle_compra }}
                                                            <input type="hidden" name="id_detalle_compra[]" value="{{ $valor->id_detalle_compra }}"></input>
                                                            <input type="hidden" id="cantidad_detalle_compra_{{ $valor->id_detalle_compra }}" name="cantidad_detalle_compra[]" value="{{ $valor->cantidad_detalle_compra }}"></input>
                                                            <input type="hidden" id="precio_detalle_compra_{{ $valor->id_detalle_compra }}" name="precio_detalle_compra[]" value="{{ $valor->precio_detalle_compra }}"></input>
                                                            <input type="hidden" name="compra_id[]" value="{{ $valor->compra_id }}"></input>
                                                            <input type="hidden" id="llave_detalle_compra_{{ $valor->id_detalle_compra }}" name="llave_eliminar[]" value="true"></input>
                                                        </td>
                                                        <td>{{ $valor->producto_id }}</td>
                                                        <td>{{ $valor->nombre_producto }}</td>
                                                        <td>{{ $valor->precio_producto }}</td>
                                                        <td>
                                                            <div class="d-flex justify-content-between">
                                                                <p class="m-0" id="cantidadDetalle{{ $valor->id_detalle_compra }}">
                                                                    {{ $valor->cantidad_detalle_compra }}
                                                                </p>
                                                                <div class="d-flex justify-content-between">
                                                                    <button type="button" class="btn btn-secondary btn-sm m-1 p-1" onclick="agregarCantidadEditar({{ $valor->cantidad_detalle_compra }}, {{ $valor->precio_producto }}, {{ $valor->id_detalle_compra }}, {{ $compras->id_compra }})">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                                                        </svg>
                                                                    </button>
                                                                    <button type="button" class="btn btn-secondary btn-sm m-1 p-1" onclick="quitarCantidadEditar({{ $valor->cantidad_detalle_compra }}, {{ $valor->precio_producto }}, {{ $valor->id_detalle_compra }}, {{ $compras->id_compra }})">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                                                                            <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                                                                        </svg>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td id="precioDetalle{{ $valor->id_detalle_compra }}">
                                                            {{ $valor->precio_detalle_compra }}
                                                        </td>
                                                        <td class="text-center">
                                                            <button type="button" class="btn btn-danger" onclick="eliminarProductoEditar({{ $valor->id_detalle_compra }}, {{ $compras->id_compra }})">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-x-lg me-1" viewBox="0 0 16 16">
                                                                    <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/>
                                                                    <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/>
                                                                </svg>
                                                                Eliminar
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12">
                                <hr>
                                <h5 class="text-center" title="Agregar más productos a la compra">Registrar más productos</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-5 mb-2">
                                        <label for="producto_id" class="form-label">Productos</label>
                                        <select title="Seleccionar productos" class="form-select" name="producto_id" id="producto_id_{{ $compras->id_compra }}" onchange="agregarPrecioProductoDetalle({{ $compras->id_compra }})">
                                            <option hidden>Seleccione los productos</option>
                                            @foreach ($producto as $productos)
                                                <option precio="{{ $productos->precio_producto }}" value="{{ $productos->id_producto }}">{{ $productos->nombre_producto }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-3 mb-2">
                                        <label for="precio_producto" class="form-label">Precio producto</label>
                                        <input type="number" class="form-control" id="precio_producto_{{ $compras->id_compra }}" readonly title="Precio del producto seleccionado">
                                    </div>
                                    <div class="col-2 mb-2">
                                        <label for="cantidad_detalle_compra" class="form-label">Cantidad</label>
                                        <input type="text" class="form-control" id="nueva_cantidad_detalle_compra_{{ $compras->id_compra }}" title="Ingresar cantidad de productos">
                                    </div>
                                    <div class="col-2 mb-2 text-white">
                                        <label class="form-label">Agregar producto</label>
                                        <button type="button" onclick="agregarProductoDetalle({{ $compras->id_compra }})" class="form-control btn btn-success" title="Agregar producto ingresado">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-plus-lg me-1" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                                            </svg>
                                            Agregar
                                        </button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-9 mb-2">
                                        <label class="form-label" title="Tabla de productos a comprar">Lista de productos</label>
                                        <div class="table-responsive">
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
                                                <tbody id="tablaProductosEditar{{ $compras->id_compra }}">
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-3 mb-2">
                                        <label for="total_compra" class="form-label">Costo total</label>
                                        <input type="text" class="form-control" id="total_compra_{{ $compras->id_compra }}" value="{{ $compras->total_compra }}" readonly required title="Costo total de todos los productos (incluye los productos ya comprados)">
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" title="Cerrar ventana">Cerrar</button>
                        <button type="submit" class="btn btn-success actualizar" title="Modificar la venta">Modificar</button>
                    </form>
            </div>
        </div>
    </div>
</div>