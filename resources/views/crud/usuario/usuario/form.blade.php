<div class="row">
    <div class="form-group mb-2 col-4">
        <label for="">Nombres:</label>
        <input type="text" name="name" id="name" class="form-control" value="{{isset($usuario->name)?$usuario->name:''}}">
    </div>
    <div class="form-group mb-2 col-4">
        <label for="">Apellidos:</label>
        <input type="text" name="last_name" id="last_name" class="form-control" value="{{isset($usuario->last_name)?$usuario->last_name:''}}">
    </div>
    <div class="form-group mb-2 col-4">
        <label for="">Correo electrónico:</label>
        <input type="email" name="email" id="email" class="form-control" value="{{isset($usuario->email)?$usuario->email:''}}">
    </div>
    <div class="form-group mb-2 col-4">
        <label for="">Celular:</label>
        <input type="number" name="cellphone" id="cellphone" class="form-control" value="{{isset($usuario->cellphone)?$usuario->cellphone:''}}">
    </div>
    <div class="form-group mb-2 col-4">
        <label for="">Contraseña:</label>
        <input type="password" name="password" id="password" class="form-control" value="">
    </div>
    <div class="form-group mb-2 col-4">
        <label for="">Confirmar contraseña:</label>
        <input type="password" name="password" id="password" class="form-control" value="">
    </div>
    <div class="form-group mb-2 col-6">
        <label for="">Dirección:</label>
        <input type="text" name="address" id="address" class="form-control" value="{{isset($usuario->address)?$usuario->address:''}}">
    </div>
   
    <div class="form-group mb-2 col-3">
        <label for="">Estado: </label>
        <select name="user_status" id="user_status" class="form-select">
            <?php
            if (isset($usuario->user_status) == false) {
            ?>
                <option selected>Selecciona una opción</option>
            <?php
            }
            ?>
            <option <?php
                    if (isset($usuario->user_status)) {
                        if ($usuario->user_status== 1) {
                    ?> selected <?php
                            }
                        }
                                ?> value="1">Habilitado</option>
            <option <?php
                    if (isset($usuario->user_status)) {
                        if ($usuario->user_status == 0) {
                    ?> selected <?php
                            }
                        }
                                ?> value="0">Inhabilitado</option>
        </select>
    </div>

    <div class="form-group mb-2 col-3">
        <label for="">Tipo Usuario: </label>
        <select name="tipo_usuario_id" id="tipo_usuario_id" class="form-select">
            <?php
            if (isset($usuario->tipo_usuario_id) == false) {
            ?>
                <option selected>Selecciona una opción</option>
            <?php
            }
            ?>
            <option <?php
                    if (isset($usuario->tipo_usuario_id)) {
                        if ($usuario->tipo_usuario_id == 1) {
                    ?> selected <?php
                            }
                        }
                                ?> value="1">Administrador</option>
            <option <?php
                    if (isset($usuario->tipo_usuario_id)) {
                        if ($usuario->tipo_usuario_id == 2) {
                    ?> selected <?php
                            }
                        }
                                ?> value="2"> Empleado </option>
            <option <?php
                    if (isset($usuario->tipo_usuario_id)) {
                        if ($usuario->tipo_usuario_id == 3) {
                        ?> selected <?php
                                        }
                        }
                                    ?> value="3"> Cliente</option>
        </select>
    </div>
</div>