<div class="form-group mb-2">
        <label for="nombre_producto">Nombre:</label>
        <input type="text" name="nombre_producto" id="nombre_producto" class="form-control @error('nombre_producto') is-invalid @enderror" value="{{isset($producto->nombre_producto)?$producto->nombre_producto:''}}">
        @error('nombre_producto')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group mb-2">
        <label for="url_imagen_producto">Foto:</label>
        {{isset($producto->url_imagen_producto)?$producto->url_imagen_producto:''}}
        <input type="file" name="url_imagen_producto[]" id="url_imagen_producto[]" class="form-control  @error('url_imagen_producto.*') is-invalid @enderror" value="{{isset($producto->url_imagen_producto)?$producto->url_imagen_producto:''}}" multiple accept="image/*">
        @error('url_imagen_producto.*')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group mb-2">
        <label for="tipo_producto_id">Tipo Producto: </label>
        <select name="tipo_producto_id" id="tipo_producto_id" class="form-control">
            <?php
            if (isset($producto->tipo_producto_id) == false) {
            ?>
                <option selected>Selecciona una opción</option>
            <?php
            }
            ?>
            @foreach($tipoProductos as $tipoProducto)
            <option <?php
                    if (isset($producto->tipo_producto_id)) {
                        if ($tipoProducto->id_tipo_producto == $producto->tipo_producto_id) {
                    ?>selected <?php
                            }
                        }
                                ?>value="{{$tipoProducto->id_tipo_producto}}">{{$tipoProducto->nombre_tipo_producto}}</option>
            @endforeach
        </select>
    </div>
  
    <div class="form-group mb-2">
        <label for="precio_producto">Precio: </label>
        <input type="number" name="precio_producto" id="precio_producto" class="form-control  @error('precio_producto') is-invalid @enderror" value="{{isset($producto->precio_producto)?$producto->precio_producto:''}}">
        @error('precio_producto')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group mb-2">
        <label for="estado_producto">Estado Producto: </label>
        <select name="estado_producto" id="estado_producto" class="form-control">
            <?php
            if (isset($producto->estado_producto) == false) {
            ?>
                <option selected>Selecciona una opción</option>
            <?php
            }
            ?>
            <option <?php
                    if (isset($producto->estado_producto)) {
                        if ($producto->estado_producto == 1) {
                    ?> selected <?php
                            }
                        }
                                ?> value="1">Disponible</option>
            <option <?php
                    if (isset($producto->estado_producto)) {
                        if ($producto->estado_producto == 0) {
                    ?> selected <?php
                            }
                        }
                                ?> value="0"> No Disponible</option>
        </select>
    </div>