<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devoluciones extends Model
{
    use HasFactory;

    protected $table = 'devoluciones';
    protected $fillable = [
        'rut',
        'nombre',
        'apellidos',
        'telefono',
        'email',
        'patente',
        'marca',
        'modelo',
        'carnetfrontal',
        'cod_tag',
        'asociado_recepcion',
        'estado',
        'tag',
        'rutempresa',
        'nombreempresa'
    ]; 

}
