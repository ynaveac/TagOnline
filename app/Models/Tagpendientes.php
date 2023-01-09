<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Tagpendientes extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'tagpendientes';
    protected $fillable = [
        'requesttag_id',
        'estado',
        'datos',
        'documentos',
        'firma'
    ];

}
