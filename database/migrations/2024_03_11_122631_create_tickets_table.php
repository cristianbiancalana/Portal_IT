<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id('id');
            $table->string ('prioridad');
            $table->string ('proveedor');
            $table->string ('segmento');
            $table->string ('sistema');
            $table->foreignId ('user_id')->constrained();
            $table->string ('tipoproblema');
            $table->string ('gerencia');
            $table->date ('fecha_origen');
            $table->string ('estado');
            $table->string ('asunto_ticket');
            $table->string ('comentario_ticket');
            $table->string ('resolucion_ticket')->nullable();
            $table->date ('fecha_resolucion')->nullable();
            $table->string ('archivo_adjunto')->nullable();
            $table->string ('ruta_adjunto')->nullable();
            $table->string ('adjunto_final')->nullable();
            $table->string ('ruta_resolucion')->nullable();
            $table->string ('tecnico')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
