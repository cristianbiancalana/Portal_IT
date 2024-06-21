<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comodato extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'fecha_alta',
        'user',
        'puesto',
        'tipo_recurso',
        'marca',
        'modelo',
        'serie',
        'detalles',
        'observacion'

    ];
}
