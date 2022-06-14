
<div class="row">
    <div class="form-group mb-2 col-4">
        <label for="">Nombres:</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ Auth::user()->name }}">
    </div>
    <div class="form-group mb-2 col-4">
        <label for="">Apellidos:</label>
        <input type="text" name="last_name" id="last_name" class="form-control" value="{{ Auth::user()->last_name }}">
    </div>
    <div class="form-group mb-2 col-4">
        <label for="">Correo electrónico:</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ Auth::user()->email }}">
    </div>
    <div class="form-group mb-2 col-4">
        <label for="">Celular:</label>
        <input type="number" name="cellphone" id="cellphone" class="form-control" value="{{ Auth::user()->cellphone }}">
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
        <input type="text" name="address" id="address" class="form-control" value="{{ Auth::user()->address }}">
    </div>


</div>