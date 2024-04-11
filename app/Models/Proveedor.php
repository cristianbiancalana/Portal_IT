<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'name_proveedor',
        'contacto1_proveedor',
        'tel1_proveedor',
        'contacto2_proveedor',
        'tel2_proveedor',
        'comentario',

    ];
}
