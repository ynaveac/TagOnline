<?php

namespace App\Models;

use Illuminate\Database\Eloquent\softDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Firmas extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'firmas';
    protected $fillable = [
        'id_RequestTag',
        'firma',
        'firmaok'
    ];

   // protected $date = ['id_RequestTag'];
}
