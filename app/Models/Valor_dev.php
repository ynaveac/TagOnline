<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Valor_dev extends Model
{
    use HasFactory;

    protected $table = 'valor_dev';
    protected $fillable = [
        'valor'
    ];
}
