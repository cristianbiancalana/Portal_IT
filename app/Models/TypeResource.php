<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeResource extends Model
{
    use HasFactory;
    protected $fillable = [
        
        'name_tiposderecursos',

    ];

    protected $table = 'typeresources';
}
