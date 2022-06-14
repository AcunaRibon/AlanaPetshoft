<center>
<div class="form-group mb-2 col-6">
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