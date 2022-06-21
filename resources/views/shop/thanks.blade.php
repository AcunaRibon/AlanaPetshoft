@extends('layouts.app')

@section('content')

<section>
    <div style="padding: 10%" width="100%" height="100%">
        <h1 position="fixed">Gracias por comprar en Alana Petshop</h1>
        <br>
        <p><center><small>Si tu pedido es un domicilio te estará llegando en 45 min o menos</small></center></p>
        <p><center><small>Si por el contario tu pedido es para recoger en tienda, puedes acercarte por él antes de que transcurran 3 días en el momento que desees</small></center></p>
        <center><img src="{{ asset('images/alanablack.jpg') }}" ></center>
    </div>
</section>

@endsection

@section('js')

<input value="el carrito" id="mensajeAlerta" hidden>
<input value="Carrito" id="mensajeAlerta1" hidden>
<input value="El carrito" id="mensajeAlerta2" hidden>

@if (session('status'))
@if (session('status') == 'registrado')
<input value="registrado" id="tipoAlerta" hidden>
@elseif (session('status') == 'Producto Agregado')
<input value="Producto Agregado" id="tipoAlerta" hidden>
@elseif (session('status') == 'Cantidad excedida')
<input value="Cantidad excedida" id="tipoAlerta" hidden>
@else

<input value="error" id="tipoAlerta" hidden>
@endif
@endif


@stop