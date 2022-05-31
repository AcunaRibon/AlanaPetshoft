@extends('layouts.app')

@section('content')

<link href="{{ asset('css/estilo.css') }}" rel="stylesheet">
<script src="{{ asset('js/shop.js') }}" defer></script>

<section class="detail-ordernow">
    <h2 style="padding-left: 15%; padding-top: 3%;">Detalle de pedido</h2>
        <br><br>
            <div class="row table-pago" style="float: center;">
                <div style="padding-left: 15%" class="col-4">
                    <form class="form-envio" action="{{url('envioOrden')}}" method="POST">
                        @csrf
                        <p style=" border-collapse: collapse;">Tipo de entrega:</p>

                        <div class="form-check">
                            <tr>
                                <td>
                                    <input onclick="ocultarform();" class="form-check-input" type="radio" name="typeSend" id="typeSend" value="RecogerEnTienda">                          
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Recoger en tienda
                                    </label>
                                </td>
                            </tr>
                         </div>
                        <div class="form-check">
                            <tr>
                                <td>
                                    <input onclick="mostrarform();" class="form-check-input" type="radio" name="typeSend" id="typeSend" value="Domicilio">                            
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Domicilio
                                    </label>
                                </td>
                            </tr>
                        </div>
                        <br>
                </div>
                        <div  id="form-send" class="col-6" style="float: left; padding-left: 10%">
                            
                        <div style="float: left" class="form-group mb-2 col-5">
                            <label for="">Dirección:</label>
                            <input type="text" name="address" id="address" class="form-control" value="{{ old('address')}}">
                            {!! $errors->first('address', '<small style="color: red">:message</small>') !!}
                        </div>
                        <br>
                        <div style="float: right" class="form-group mb-2 col-6">
                            <label for="">Celular:</label>
                            <input type="number" name="cellphone" id="cellphone" class="form-control" value="{{ old('cellphone')}}">
                            {!! $errors->first('cellphone', '<small style="color: red">:message</small>') !!}
                        </div>

                        <div style="float: left" class="form-group mb-2 col-5">
                            <label for="">Calificación:</label>
                            <input type="number" min="1" max="5" name="rate" id="rate" class="form-control" value="{{ old('rate')}}">
                            {!! $errors->first('rate', '<small style="color: red">:message</small>') !!}
                        </div>
                        </div>
                        <div id="btn-send" style=" padding: 15%; padding-top: 2%">
                        <button class="btn btn-success finalizarbtn" style="float:right;">
                            Finalizar compra
                        </button>
                        </div>
                        
                        
                    </form> 
            </div>   
                
</section>


@endsection

