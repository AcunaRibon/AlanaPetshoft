@extends('layouts.app')

@section('title', 'Mi perfil')

@section('content') 


<div class="container pt-5">
<h2>Mi perfil</h2>

<br>
<br>

<br>

<div class="row">

    <div class="form-group mb-2 col-6">
        <label for="">Nombres:</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ Auth::user()->name }}" readonly title="Mis nombres">
    </div>
    <div class="form-group mb-2 col-6">
        <label for="">Apellidos:</label>
        <input type="text" name="last_name" id="last_name" class="form-control" value="{{ Auth::user()->last_name }}" readonly title="Mis apellidos">
    </div>
    <div class="form-group mb-2 col-6">
        <label for="">Correo electrónico:</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ Auth::user()->email }}" readonly title="Mi correo">
    </div>
    <div class="form-group mb-2 col-6">
        <label for="">Celular:</label>
        <input type="number" name="cellphone" id="cellphone" class="form-control" value="{{ Auth::user()->cellphone }}" readonly title="Mi celular">
    </div>
    <div class="form-group mb-2 col-4">
        <label for="">Contraseña:</label>
        <input type="password" name="password" id="password" class="form-control" value="" readonly>
    </div>

    <div class="form-group mb-2 col-8">
        <label for="">Dirección:</label>
        <input type="text" name="address" id="address" class="form-control" value="{{ Auth::user()->address }}" readonly title="Mi dirección">
    </div>
    
</div>
</div>

<br>
<br>
<br>

<center>

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editarprofile_{{ Auth::user()->id }}" title="Editar mis datos">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-pen me-1" viewBox="0 0 16 16">
                                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                        </svg>
                                        Editar
                                    </button>
                                    <div class="modal fade" id="editarprofile_{{ Auth::user()->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header ">
                                                    <h5 class="modal-title" id="exampleModalLabel">Editar Perfil</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container-fluid">
                                                        <form action="{{route('profile.update', Auth::user()->id)}}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            {{method_field('PATCH')}}
                                                            @include('crud.usuario.profile.form')
                                                    </div>
                                                
                                                </div>
                                                
                                                <div class="modal-footer">
                                                    
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" title="Cancelar edición">Cerrar</button>
                                                    <input type="submit" value="Modificar" class="btn btn-success actualizar" title="Guardar nuevos datos">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                </div>
                            
                       
<br>



<br>
<br>

<br>
@endsection

@section('js')

<input value="el usuario" id="mensajeAlerta" hidden>
<input value="Usuario" id="mensajeAlerta1" hidden>
<input value="El usuario" id="mensajeAlerta2" hidden>
@if (session('status'))
    @if (session('status') == 'registrado')
        <input value="registrado" id="tipoAlerta" hidden>
    @elseif (session('status') == 'actualizado')
        <input value="actualizado" id="tipoAlerta" hidden>
    @elseif (session('status') == 'listado')
        <input value="listado" id="tipoAlerta" hidden>
    @else
        <input value="error" id="tipoAlerta" hidden>
    @endif
@endif
<script src="{{ asset('js/alertas.js') }}"></script>
@stop