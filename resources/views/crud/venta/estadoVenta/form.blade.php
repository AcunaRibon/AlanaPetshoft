<div class="form-group">
    <label class="form-label">Nombre</label>
    <input value="{{isset($estadoV->nombre_estado_venta)?$estadoV->nombre_estado_venta:''}}" required type="text" id="nombre_estado_venta{{$tipo}}" class="form-control" name="nombre_estado_venta{{$tipo}}" class="form-control" aria-describedby="helpId">
    @error('nombre_estado_venta'.$tipo)
        <input value="{{$modo}}" id="tipoAlerta" hidden>
        <p class="text-danger fw-bold">
            * {{$message}}
        </p>
        @enderror
</div>   