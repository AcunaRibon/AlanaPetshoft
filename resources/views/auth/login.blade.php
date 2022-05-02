@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-5 border border-primary rounded-3 p-3 mx-2 bg-primary" style="--bs-bg-opacity: .23;">
            <h4 class="text-center fw-bold mb-4">Iniciar Sesión</h4>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="col-12 mb-2">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-12 mb-2">
                    <label for="password" class="form-label">Contraseña</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-12 mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            Recuérdame
                        </label>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <center>
                        <button type="submit" class="btn btn-success">
                            Iniciar sesión
                        </button>
                    </center>
                </div>
                @if (Route::has('password.request'))
                    <div class="col-12 mb-3">
                        <center>
                            <a class="text-secondary fw-bold" href="{{ route('password.request') }}">
                                ¿Olvidaste tu contraseña?
                            </a>
                        </center>
                    </div>
                @endif
            </form>
            <div class="col-12 mb-3">
                <center>
                    <span class="text-dark fw-bold">¿No tienes cuenta? </span>
                    <a class="text-secondary fw-bold" href="{{ url('/register') }}">
                        Crea tu cuenta
                    </a>
                </center>
            </div>
        </div>
    </div>
</div>
@endsection
