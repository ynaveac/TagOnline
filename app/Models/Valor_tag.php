<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Valor_tag extends Model
{
    use HasFactory;

    protected $table = 'valor_tag';
    protected $fillable = [
        'valor'
    ];
}
