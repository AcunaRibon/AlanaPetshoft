@extends('layouts.app')

@section('title','Registrar Usuario')

@section('content')

<br>
<a href="{{ url('/emp' ) }}" method="post" style="text-decoration:none" class="btn btn-warning text-center font-semibold">
      Regresar
      </a>

<div class="block mx-auto my-12 p-8 bg-white w-1/3 border border-white-200 rounded-lg shadow-lg">

<h1 class="text-3xl text-center font-semibold">Registro de Usuarios</h1>

<form class="mt-4" method="POST" action="{{ url('/admin') }}">
@csrf
<input type="text" class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-400 p-2 my-2 focus-bg-white"
placeholder="Nombre" id="name" name="name">

<input type="text" class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-400 p-2 my-2 focus-bg-white"
placeholder="Apellido" id="last_name" name="last_name">

<input type="email" class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-400 p-2 my-2 focus-bg-white"
placeholder="Correo electrónico" id="email" name="email">

<input type="password" class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-400 p-2 my-2 focus-bg-white"
placeholder="Contraseña" id="password" name="password">

<input type="phone" class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-400 p-2 my-2 focus-bg-white"
placeholder="Celular" id="cellphone" name="cellphone">

<input type="text" class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-400 p-2 my-2 focus-bg-white"
placeholder="Dirección" id="address" name="address">

<select name="tipo_usuario_id" class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-400 p-2 my-2 focus-bg-white"
placeholder="Tipo de Usuario" id="tipo_usuario_id" >

 <option value="0"></option>
  <option value="2">2. Empleado</option>
  <option value="3">3.Cliente</option>
</select>


<button type="submit" class="rounded-md bg-pink-500 w-full text-lg text-white font-semibold p-2 my-3
hover:bg-pink-600">Registrar</button>

</form>
</div>

@endsection   


