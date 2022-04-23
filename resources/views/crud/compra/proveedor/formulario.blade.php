<div class="mb-2">
    <label for="nombre_proveedor" class="form-label">Nombre</label>
    <input type="text" class="form-control" id="nombre_proveedor" name="nombre_proveedor" value="{{ isset($proveedores -> nombre_proveedor)?$proveedores -> nombre_proveedor:'' }}" required>
</div>
<div class="mb-2">
    <label for="celular_proveedor" class="form-label">Celular</label>
    <input type="text" class="form-control" id="celular_proveedor" name="celular_proveedor" value="{{ isset($proveedores -> celular_proveedor)?$proveedores -> celular_proveedor:'' }}" required>
</div>