<div class="form-group mb-2">
    <label for="nombre_tipo_producto" class="form-label">Nombre</label>
    <input type="text" name="nombre_tipo_producto{{$tipo}}" id="nombre_tipo_producto{{$tipo}}" class="form-control" value="{{isset($tp-> nombre_tipo_producto)?$tp-> nombre_tipo_producto:''}}" >
    @error('nombre_tipo_producto'.$tipo)
        <input value="{{$modo}}" id="tipoAlerta" hidden>
        <p class="text-danger fw-bold">
            * {{$message}}
        </p>
        @enderror
</div>