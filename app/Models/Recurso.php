<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{
    use HasFactory;
    protected $table = 'recursos';

    protected $fillable = [
        'tipo_recurso',
        'fecha_alta',
        'marca',
        'modelo',
        'serie',
        'details',
        'comentario',
    ];

    protected $casts = [
        'details' => 'array',
    ];
}
