<div class="col-6 mb-2">
    <div class="form-group">
        <label for="street1_id" class="form-label">Documento Domiciliario</label>
        <input value="{{isset($listdomiciliario->documento_domiciliario)?$listdomiciliario->documento_domiciliario:''}}" type="text" class="form-control @error('documento_domiciliario'.$tipo) is-invalid @enderror" id="documento_domiciliario{{$tipo}}" name="documento_domiciliario{{$tipo}}" >
        @error('documento_domiciliario'.$tipo)
        <input value="{{$modo}}" id="tipoAlerta" hidden>
        <p class="text-danger fw-bold">
            * {{$message}}
        </p>
        @enderror
    </div>                      
</div>      
<div class="col-6 mb-2">
    <div class="form-group">
        <label  class="form-label">Nombre</label>
        <input  value="{{isset($listdomiciliario->nombres_domiciliario)?$listdomiciliario->nombres_domiciliario:''}}" required type="text" id="nombres_domiciliario{{$tipo}}" name="nombres_domiciliario{{$tipo}}" class="form-control" aria-describedby="helpId" placeholder="Ingrese el nombre">
    </div>
</div>                            
<div class="col-6 mb-2">
    <div class="form-group"> 
        <label for="" class="form-label">Apellido</label>
        <input value="{{isset($listdomiciliario->apellidos_domiciliario)?$listdomiciliario->apellidos_domiciliario:''}}"  required type="text" id="apellidos_domiciliario{{$tipo}}" name="apellidos_domiciliario{{$tipo}}" class="form-control" aria-describedby="helpId" placeholder="Ingrese el apellido">                   
        @error('apellidos_domiciliario'.$tipo)
        <input value="{{$modo}}" id="tipoAlerta" hidden>
        <p class="text-danger fw-bold">
            * {{$message}}
        </p>
        @enderror
    </div> 
</div>
<div class="col-6 mb-2">
    <div class="form-group"> 
        <label for="" class="form-label">Celular</label>
        <input value="{{isset($listdomiciliario->celular_domiciliario)?$listdomiciliario->celular_domiciliario:''}}" required type="text" id="celular_domiciliario{{$tipo}}" name="celular_domiciliario{{$tipo}}" class="form-control" aria-describedby="helpId" placeholder="Ingrese el celular del domiciliario">                   
        @error('celular_domiciliario'.$tipo)
        <input value="{{$modo}}" id="tipoAlerta" hidden>
        <p class="text-danger fw-bold">
            * {{$message}}
        </p>
        @enderror
    </div> 
</div>
<div class="col-6 mb-2">
    <div class="form-group">
        <label for="estado_domiciliario" class="form-label">Estado Domiciliario</label>
        <select class="form-select" name="estado_domiciliario{{$tipo}}" id="estado_domiciliario{{$tipo}}" class="form-control">
          
                <option selected hidden value="">Seleccione una opción</option>
                <option value="1">Disponible</option>
                <option value="0">No disponible</option>
            
        </select>
        @error('estado_domiciliario'.$tipo)
        <input value="{{$modo}}" id="tipoAlerta" hidden>
        <p class="text-danger fw-bold">
            * {{$message}}
        </p>
        @enderror
    </div>
</div>