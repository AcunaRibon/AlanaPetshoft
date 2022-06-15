@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content')

<div class="container pt-5">
    <div class="row">
        <div class="col-12 col-md-10">
            <div class="table-responsive p-2">
                <div class="d-flex justify-content-between">
                    <h2 class="text-center">Usuario</h2>
                    <button type="button" class="btn btn-dark mb-2" data-bs-toggle="modal" data-bs-target="#registrar">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-plus-lg me-1" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                        </svg>
                        Registrar
                    </button>
                </div>
                <div class="modal fade" id="registrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Registrar Usuario</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <form action="{{ route('usuario.store')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @include('crud.usuario.usuario.form')
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <input type="submit" value="Registrar" class="btn btn-success registrar">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <table id="tabla" class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Celular</th>
                            <th>Estado</th>
                            <th>Tipo usuario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $usuario)
                        <tr>
                            <td>{{ $usuario ->name }} {{ $usuario ->last_name }}</td>
                            <td>{{ $usuario ->email }}</td>
                            <td>{{ $usuario ->cellphone }}</td>
                            <td>
                                @if($usuario->user_status == 1)
                                <p class="fw-bold">Habilitado</p>
                                @else
                                <p class="fw-bold">Inhabilitado</p>
                                @endif
                            </td>
                            <td>
                                @if($usuario ->tipo_usuario_id == 1)
                                <p class="fw-bold">Administrador</p>
                                @elseif($usuario ->tipo_usuario_id == 2)
                                <p class="fw-bold">Empleado</p>
                                @else
                                <p class="fw-bold">Cliente</p>
                                @endif
                            </td>
                            <td>

                                <div class="d-flex justify-content-between">

                                    <div class="dropdown">
                                        <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" title="Acciones disponibles">
                                            Acciones
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="dropdownMenuButton1">

                                            <li> <button type="button" class="dropdown-item fw-bold" data-bs-toggle="modal" data-bs-target="#editar_{{$usuario ->id}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-pen me-1" viewBox="0 0 16 16">
                                                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                                    </svg>
                                                    Editar
                                                </button>
                                            </li>
                                            <li>
                                                <form action="{{ route('usuario.destroy', $usuario-> id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item cancelar fw-bold" title="Inhabilitar usuario">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-x-lg me-1" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z" />
                                                            <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z" />
                                                        </svg>
                                                        Inhabilitar
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>

                                        



                                    </div>

                                    <div class="modal fade" id="editar_{{$usuario ->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container-fluid">
                                                        <form action="{{route('usuario.update', $usuario-> id)}}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            {{method_field('PATCH')}}
                                                            @include('crud.usuario.usuario.form')


                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-success actualizar">Actualizar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <div class="col-12 col-md-2  d-flex flex-column justify-content-center align-items-center ">
            <div class="bg-dark text-white text-center p-2 rounded-3 mb-2 mt-5">
                <p class="text-center fs-5 fw-bolder">Usuarios registrados</p>
                <div class="d-flex justify-content-center align-items-center fs-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-cart me-1" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                    </svg>
                    <p class="fw-bold m-0"> {{ $total }}</p>
                </div>
            </div>

            <button type="button" class="btn btn-danger mb-2" data-bs-toggle="modal" data-bs-target="#usuariosInactivos" title="Ver usuarios inhabilitados">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-x-lg me-1" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z" />
                    <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z" />
                </svg>
                Inhabilitados
            </button>
            <div class="modal fade" id="usuariosInactivos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                    <div class="modal-content">
                        <div class="modal-header ">
                            <h5 class="modal-title" id="exampleModalLabel">Usuarios Inhabilitados</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">

                                <table id="tabla" class="table table-ligth table-striped table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                        <th>Nombre</th>
                            <th>Correo</th>
                            <th>Celular</th>
                            <th>Estado</th>
                            <th>Tipo usuario</th>
                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($usuarioscancelados as $usuarioc)
                                        <tr>
                                        <td>{{ $usuarioc ->name }} {{ $usuarioc ->last_name }}</td>
                            <td>{{ $usuarioc ->email }}</td>
                            <td>{{ $usuarioc ->cellphone }}</td>
                            <td>
                                @if($usuarioc->user_status == 1)
                                <p class="fw-bold">Habilitado</p>
                                @else
                                <p class="fw-bold">Inhabilitado</p>
                                @endif
                            </td>
                            <td>
                                @if($usuarioc ->tipo_usuario_id == 1)
                                <p class="fw-bold">Administrador</p>
                                @elseif($usuarioc ->tipo_usuario_id == 2)
                                <p class="fw-bold">Empleado</p>
                                @else
                                <p class="fw-bold">Cliente</p>
                                @endif
                            </td>
                            <td>
                                           
                                                <div class='d-flex justify-content-evenly'>

                                                    <form action="{{ route('usuario.destroy', $usuarioc-> id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger habilitar" title="Habilitar usuario">
                                                            Habilitar
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-dark" data-bs-dismiss="modal" title="Cerrar ventana">Cerrar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
   

            <a class="btn btn-warning mb-2" href="{{ url('admin/report') }}" title="Generar nuevo reporte">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-journal-plus me-1" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5z" />
                    <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                    <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                </svg>
                Nuevo reporte
            </a>

        </div>
    </div>
</div>
</div>
@stop
@section('css')
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.css" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stop

    @section('js')
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.js" defer></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/tablas.js') }}" defer></script>

    <input value="el usuario" id="mensajeAlerta" hidden>
    <input value="Usuario" id="mensajeAlerta1" hidden>
    <input value="El usuario" id="mensajeAlerta2" hidden>
    @if (session('status'))
    @if (session('status') == 'registrado')
    <input value="registrado" id="tipoAlerta" hidden>
    @elseif (session('status') == 'actualizado')
    <input value="actualizado" id="tipoAlerta" hidden>
    @elseif (session('status') == 'cancelado')
    <input value="cancelado" id="tipoAlerta" hidden>
    @elseif (session('status') == 'restaurado')
    <input value="restaurado" id="tipoAlerta" hidden>
    @else
    <input value="error" id="tipoAlerta" hidden>
    @endif
    @endif
    <script src="{{ asset('js/alertas.js') }}"></script>
    @stop