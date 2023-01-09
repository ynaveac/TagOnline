<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class LogMensajes extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'logmensajes';
    protected $fillable = [
        'id_RequestTag',
        'mensaje'
    ]; 
}
