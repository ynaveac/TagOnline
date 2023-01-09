<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Empleados extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'Empleados';
    protected $fillable = [
        'rut',
        'pasaporte',
        'nombre',
        'apellidos',
        'password',
        'direccion',
        'local_id'
    ];
}
