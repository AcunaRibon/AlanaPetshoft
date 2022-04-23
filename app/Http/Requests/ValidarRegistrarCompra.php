<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidarRegistrarCompra extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'fecha_pedido_compra' => 'required',
            'fecha_entrega_compra' => 'required|after_or_equal:fecha_pedido_compra',
            'estado_pedido_compra' => 'required',
            'proveedor_id' => 'required',
            'total_compra' => 'required',
            'producto_id' => 'required',
            'cantidad_detalle_compra' => 'required'
        ];
    }
}
