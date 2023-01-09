<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Valor_delivery extends Model
{
    use HasFactory;

    protected $table = 'valor_delivery';
    protected $fillable = [
        'valor'
    ];
}
