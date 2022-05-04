@extends('layouts.app')

@section('content')

<link href="{{ asset('css/estilo.css') }}" rel="stylesheet">

<section class="detail-ordernow">
        <h1>Detalle de pedido</h1>
        <br><br>
            <div class="table table-pago">
                <div class="row">
                    <form class="form-envio">
                    <h5>TU PEDIDO</h5>
                        <table class="table">
                            <tr>
                                <td><b>TOTAL</b></td>
                            </tr>
                            <tr>
                                <td><p>${{$total}}</p></td>
                            </tr>
                        </table>
                        <div class="form-check">
                            <tr>
                                <td>
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">                            <label class="form-check-label" for="flexRadioDefault1">
                               Recoger en tienda
                        </label>
                                </td>
                         </div>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>                            <label class="form-check-label" for="flexRadioDefault2">
                              Domicilio
                        </label>
                        </tr>
                    </div>
                    <a href="{{url('ordernow')}}" class="btn btn-success" style="float: right;">
                        Finalizar compra
                        </a>
                    </form>
                    </div>  
                </div>
                    
                
           
            
</section>


@endsection