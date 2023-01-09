<?php

namespace App\Models;

use Illuminate\Database\Eloquent\softDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'documents';
    protected $fillable = [
        'id_RequestTag',
        'carnetfrontal',
        'carnetfrontalempresa',
        'primerainscripcion',
        'compranotarial',
        'padron',
        'cav',
        'tagentregado'
    ];
}
