@extends('layouts.app')

@section('content')

<link href="{{ asset('css/estilo.css') }}" rel="stylesheet">
<section class="container1-card-products">
<div class="card">
<div>
@if (session('status'))
        @if (session('status')==1)
            <div class="alert alert-success">
                Producto eliminado correctamente
            </div>
            @endif
    @endif
</div>
  <div class="card-body">
    <div class="row">
    <div class="col-8">
      <form>
        <table class="table table-sm">
        @foreach($cart as $carts )
          <tr>
            <td><center><img width="100px" height="100px" src="{{ asset('../storage').'/app/public/'.$carts->url_imagen_producto }}"></center></td>
            <td><h5>{{$carts->nombre_producto}}</h5><p>Descripcion corta del producto</p></td>
            <td><input type="number" value="{{$carts->quantity}}" min="1" class="form-control" style="width:100px" name="quantity"></td>
            <td>$ {{$carts->precio_producto}}</td>
            <td>
              <a class="btn-cancel" href="{{url('delete', $carts->cart_id)}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/>
                  <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/>
                </svg>
              </a>  
            </td>
          </tr>
          @endforeach
        </table>
        </form>
        </div>
        <div class="col-4" style="float: right" >  
                    <table class="table table-bordered" >
                        <thead>
                            <tr>
                                <th scope="col"><strong>Resumen</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Subtotal</td>
                                <td><strong>$</strong></td>
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
                                <td><h5><strong>Total</strong></h5></td>
                                <td><h5><strong>$</strong></h5></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>         
        
    <button href="{{url('ordernow')}}" class="btn btn-success" style="float: right;">
          Confirmar pedido
        </button>
      
    </div>
  </div>
</div>
        <br><br><br>
@endsection