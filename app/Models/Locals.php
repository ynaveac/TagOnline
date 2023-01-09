<?php

namespace App\Models;

use Illuminate\Database\Eloquent\softDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locals extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'Locals';
    protected $fillable = [
        'rut',
        'nombre',
        'direccion',
        'maquina',
        'kiosko'
    ];

}
