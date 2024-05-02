<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        
            'prioridad',
            'proveedor',
            'segmento',
            'sistema',
            'tipoproblema',
            'gerencia',
            'fecha_origen',
            'estado',
            'asunto_ticket',
            'comentario_ticket',
            'resolucion_ticket',
            'fecha_resolucion',
            'archivo_adjunto',
            'ruta_adjunto',
            'adjunto_final',
            'ruta_resolucion',
            'tecnico'

    ];
    public function user(): BelongsTo
    {

        return $this->belongsTo(User::class);
    
    }

}


