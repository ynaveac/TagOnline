<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDocumentsRequest extends FormRequest
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
            'carnetfrontal'         => 'required',
            //'carnetfrontalempresa'  => 'required',
            'primerainscripcion'    => 'required_without_all:compranotarial,padron,cav,carnetfrontal',
            'compranotarial'        => 'required_without_all:primerainscripcion,padron,cav,carnetfrontalempresa',
            'padron'                => 'required_without_all:primerainscripcion,compranotarial,cav,carnetfrontalempresa',
            'cav'                   => 'required_without_all:primerainscripcion,compranotarial,padron,carnetfrontalempresa',
            'img.*'                 => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];

    }
}
