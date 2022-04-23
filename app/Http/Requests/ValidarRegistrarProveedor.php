<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidarRegistrarProveedor extends FormRequest
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
            'nombre_proveedor' => 'required|unique:proveedor,nombre_proveedor,'.$this->proveedor.',id_proveedor|max:30|min:3',
            'celular_proveedor' => 'required|unique:proveedor,celular_proveedor,'.$this->proveedor.',id_proveedor|max:10|min:10'
        ];
    }
}
