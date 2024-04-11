<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Gerencia extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'nombre_gerencia',
        'gerente_acargo',

    ];


    public function user(): BelongsTo
    {

        return $this->belongsTo(User::class);
    
    }
}
