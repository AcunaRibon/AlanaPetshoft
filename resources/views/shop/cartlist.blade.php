@extends('layouts.app')

@section('content')

<link href="{{ asset('css/estilo.css') }}" rel="stylesheet">
<section class="container1-card-products">
  <div class="card">

    <form action="{{route('shop.export')}}" method="post">
      @csrf
      <div class="card-body" id="form-send-cartlist">
        <div class="row">
          <div class="col-12 col-md-6">


            <table class="table table-sm">
              @foreach($cart as $carts )
              <tr>

                <td>

                  <center>
                    @foreach($imagenes as $imagen)
                    <?php if ($imagen->producto_id == $carts->id_producto) { ?>
                      <img src="{{ asset('../storage').'/app/public/'.$imagen->url_imagen_producto }}" width="100px" height="100px" title="Imagen del producto '{{$carts->nombre_producto}}'">
                    <?php
                    }
                    ?>
                    @endforeach
                  </center>
                </td>
                <td>
                  <h5>{{$carts->nombre_producto}}</h5>
                  <p>Descripcion corta del producto</p>
                </td>
                <td><input type="number" value="{{$carts->quantity}}" min="1" max="{{$carts->existencia_producto}}" class="form-control" style="width:100px" name="quantity[]">
                  <input type="hidden" value="{{$carts->id_producto}}" name="id_productos[]">
                </td>
                <td>$ {{$carts->precio_producto}}</td>
                <td>
                  <a class="btn-cancel" href="{{url('delete', $carts->cart_id)}}" title="Eliminar producto del carrito">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16" >
                      <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z" />
                      <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z" />
                    </svg>
                  </a>
                </td>
              </tr>
              @endforeach
            </table>

          </div>
         
          <div class="col-12 col-md-6" style="float: right">


            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col"><strong>Resumen</strong></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Subtotal</td>
                  <td><strong>${{$total}}</strong></td>
                </tr>
                <tr>
                  <td>Descuento</td>
                  <td>-$0</td>
                </tr>
                <tr>
                  <td>Costo de domicilio</td>
                  <td style="color: green;">¡Gratis!</td>
                </tr>
                <tr>
                  <td>
                    <h5><strong>Total</strong></h5>
                  </td>
                  <td>
                    <h5><strong>${{$total}}</strong></h5>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <button type="submit" class="btn btn-success registrar confirmarbtn" title="Enviar formulario"> Confirmar pedido</button>

        </div>
    </form>
  </div>
  </div>

</section>
<br><br><br>
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
