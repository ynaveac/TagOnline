<?php

namespace App\Models;

use Illuminate\Database\Eloquent\softDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestTag extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'RequestTag';
    protected $fillable = [
        'fecha_proceso',
        'local',
        'vendedor',
        'tipo',
        'rut',
        'dv',
        'nombre',
        'apellidos',
        'direccion',
        'telefono',
        'email',
        'patente',
        'marca',
        'modelo',
        'observaciones',
        'tipo',
        'estado',
        'rut_representante',
        'nombre_representante',
        'local_retiro',
        'cod_seguimiento',
        'asociado_retiro',
        'cod_tag'
    ];

    protected $date = ['fecha_proceso'];

}
