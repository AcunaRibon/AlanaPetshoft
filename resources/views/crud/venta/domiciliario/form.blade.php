<div class="col-6 mb-2">
    <div class="form-group">
        <label for="street1_id" class="form-label">Documento Domiciliario</label>
        <input value="{{isset($listdomiciliario->documento_domiciliario)?$listdomiciliario->documento_domiciliario:''}}" type="text" class="form-control" id="documento_domiciliario" name="documento_domiciliario" >
    </div>                      
</div>      
<div class="col-6 mb-2">
    <div class="form-group">
        <label  class="form-label">Nombre</label>
        <input  value="{{isset($listdomiciliario->nombres_domiciliario)?$listdomiciliario->nombres_domiciliario:''}}" required type="text" id="nombres_domiciliario" name="nombres_domiciliario" class="form-control" aria-describedby="helpId" placeholder="Ingrese el nombre">
    </div>
</div>                            
<div class="col-6 mb-2">
    <div class="form-group"> 
        <label for="" class="form-label">Apellido</label>
        <input value="{{isset($listdomiciliario->apellidos_domiciliario)?$listdomiciliario->apellidos_domiciliario:''}}"  required type="text" id="apellidos_domiciliario" name="apellidos_domiciliario" class="form-control" aria-describedby="helpId" placeholder="Ingrese el apellido">                   
    </div> 
</div>
<div class="col-6 mb-2">
    <div class="form-group"> 
        <label for="" class="form-label">Celular</label>
        <input value="{{isset($listdomiciliario->celular_domiciliario)?$listdomiciliario->celular_domiciliario:''}}" required type="text" id="celular_domiciliario" name="celular_domiciliario" class="form-control" aria-describedby="helpId" placeholder="Ingrese el celular del domiciliario">                   
    </div> 
</div>
<div class="col-6 mb-2">
    <div class="form-group">
        <label for="estado_domiciliario" class="form-label">Estado Domiciliario</label>
        <select class="form-select" name="estado_domiciliario" id="estado_domiciliario" class="form-control">
            @if($modo == 'Crear')
                <option selected hidden value="">Seleccione una opción</option>
                <option value="1">Disponible</option>
                <option value="0">No disponible</option>
            @else
                @if(isset($listdomiciliario->estado_domiciliario))
                    @if($listdomiciliario->estado_domiciliario == 1)
                        <option selected value="1">Disponible</option>
                        <option value="0">No disponible</option>
                    @else
                        <option value="1">Disponible</option>
                        <option selected value="0">No disponible</option>
                    @endif
                @endif
            @endif
        </select>
    </div>
</div>