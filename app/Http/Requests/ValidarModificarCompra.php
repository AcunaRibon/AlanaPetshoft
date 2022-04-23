<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidarModificarCompra extends FormRequest
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
            'fecha_pedido_compra_m' => 'required',
            'fecha_entrega_compra_m' => 'required|after_or_equal:fecha_pedido_compra_m',
            'estado_pedido_compra_m' => 'required',
            'total_compra_m' => 'required'
        ];
    }
}
