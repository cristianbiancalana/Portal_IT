<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Segmento extends Model
{

    protected $fillable = [
        'name_segmento',
    
    ];

    use HasFactory;
}
