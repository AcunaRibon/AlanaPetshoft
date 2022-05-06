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
                        <input type="text" class="form-control @error('total_compra') is-invalid @enderror" id="total_compra" name="total_compra" id="total_compra" required readonly title="Costo total de todos los productos">
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