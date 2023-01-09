<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Despachos extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'Despachos';
    protected $fillable = [
        'id_RequestTag',
        'rut',
        'telefono',
        'nomapell',
        'direccion'
    ]; 
}
