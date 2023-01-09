<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpleadoRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'rut'           => 'required_without_all:pasaporte',
            'pasaporte'     => 'required_without_all:rut',
            'nombre'        => 'required',
            'apellidos'     => 'required',
            'direccion'     => 'required',
            'local_id'      => 'required|numeric',
            'password'      => 'required'
            
        ];
    }
}
