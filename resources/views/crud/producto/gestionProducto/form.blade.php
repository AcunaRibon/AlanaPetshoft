<div class="form-group mb-2">
    <label for="nombre_producto">Nombre:</label>
    <input type="text" name="nombre_producto{{$tipo}}" id="nombre_producto{{$tipo}}" class="form-control @error('nombre_producto'.$tipo) is-invalid @enderror" value="{{isset($producto->nombre_producto)?$producto->nombre_producto:old('nombre_producto'.$tipo)}}">
    @error('nombre_producto'.$tipo)
    <input value="{{$modo}}" id="tipoAlerta" hidden>
    <p class="text-danger fw-bold">
        * {{$message}}
    </p>
    @enderror
</div>
<div class="form-group mb-2">
    <label for="url_imagen_producto">Foto:</label>
    {{isset($producto->url_imagen_producto)?$producto->url_imagen_producto:''}}
    <input type="file" name="url_imagen_producto{{$tipo}}[]" id="url_imagen_producto{{$tipo}}[]" class="form-control  @error('url_imagen_producto'.$tipo.'.*') is-invalid @enderror" value="{{isset($producto->url_imagen_producto)?$producto->url_imagen_producto:''}}" multiple accept="image/*">
    @error('url_imagen_producto'.$tipo.'.*')
    <input value="{{$modo}}" id="tipoAlerta" hidden>
    <p class="text-danger fw-bold">
        * {{$message}}
    </p>
    @enderror
</div>
<div class="form-group mb-2">
    <label for="tipo_producto_id">Tipo Producto: </label>
    <select name="tipo_producto_id{{$tipo}}" id="tipo_producto_id{{$tipo}}" class="form-control  @error('tipo_producto_id'.$tipo) is-invalid @enderror">
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
    @error('tipo_producto_id'.$tipo)
    <input value="{{$modo}}" id="tipoAlerta" hidden>
    <p class="text-danger fw-bold">
        * {{$message}}
    </p>
    @enderror
</div>

<div class="form-group mb-2">
    <label for="precio_producto">Precio: </label>
    <input type="number" name="precio_producto{{$tipo}}" id="precio_producto{{$tipo}}" class="form-control  @error('precio_producto'.$tipo) is-invalid @enderror" value="{{isset($producto->precio_producto)?$producto->precio_producto:''}}">
    @error('precio_producto'.$tipo)
    <input value="{{$modo}}" id="tipoAlerta" hidden>
    <p class="text-danger fw-bold">
        * {{$message}}
    </p>
    @enderror
</div>
<div class="form-group mb-2">
    <label for="estado_producto">Estado Producto: </label>
    <select name="estado_producto{{$tipo}}" id="estado_producto{{$tipo}}" class="form-control @error('estado_producto'.$tipo) is-invalid @enderror">
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
    @error('estado_producto'.$tipo)
    <input value="{{$modo}}" id="tipoAlerta" hidden>
    <p class="text-danger fw-bold">
        * {{$message}}
    </p>
    @enderror
</div>