@extends('layouts.app')

@section('content')

<link href="{{ asset('css/estilo.css') }}" rel="stylesheet">

<section class="detail-ordernow">
    <h1>Detalle de pedido</h1>
        <br><br>
            <div class="row table-pago">
                <div class="col-8">
                    <form class="form-envio" action="orderplace" method="POST">
                        @csrf
                        <div style="float: left" class="form-group mb-2 col-5">
                            <label for="">Dirección:</label>
                            <input type="text" name="address" id="address" class="form-control" value="{{isset($usuario->address)?$usuario->address:''}}">
                        </div>
                        <div style="float: right" class="form-group mb-2 col-6">
                            <label for="">Celular:</label>
                            <input type="number" name="cellphone" id="cellphone" class="form-control" value="{{isset($usuario->cellphone)?$usuario->cellphone:''}}">
                        </div>
                        <p style="padding-top: 15%;">Tipo de entrega:</p>
                        <div class="form-check">
                            <tr>
                                <td>
                                    <input class="form-check-input" type="radio" name="Recoger en tienda" id="flexRadioDefault1">                           
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Recoger en tienda
                                    </label>
                                </td>
                            </tr>
                         </div>
                        <div class="form-check">
                            <tr>
                                <td>
                                    <input class="form-check-input" type="radio" name="Domicilio" id="flexRadioDefault2" checked>                            
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Domicilio
                                    </label>
                                </td>
                            </tr>
                        </div>
                        <button href="{{url('ordernow')}}" class="btn btn-success" style="float: right;">
                            Finalizar compra
                        </button>
                    </form> 
                </div>
                <div class="col-4" style="">
                    <table class="table table-bordered" >
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
                                <td><h5><strong>Total</strong></h5></td>
                                <td><h5><strong>${{$total}}</strong></h5></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>         
</section>


@endsection