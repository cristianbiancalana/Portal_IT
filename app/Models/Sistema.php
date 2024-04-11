<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sistema extends Model
{   

    protected $fillable = [
        'name_sistema',
    
    ];

    use HasFactory;
}
