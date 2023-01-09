<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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
            'tipo'                  => 'nullable',
            'rut_representante'     => 'required_unless:tipo,1',
            'nombre_representante'  => 'required_unless:tipo,1',     
            //'rol'                   => 'required_unless:tipo,1',        
            'fecha_proceso'         => 'required|date_format:Y-m-d\TH:i',
            'rut'                   => 'required',
            'nombre'                => 'required',
            'apellidos'             => 'nullable',
            'direccion'             => 'required_unless:tipo,1', 
            'telefono'              => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:12',
            'email'                 => 'required',
            'patente'               => 'required',
            'marca'                 => 'required',
            'modelo'                => 'required',
            'observaciones'         => 'nullable|max:250'
            //'natural'               => 'required_unless:empresa,2',
            //'empresa'               => 'required_unless:natural,1',
        ];
    }
}
