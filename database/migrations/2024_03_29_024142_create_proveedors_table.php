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
        Schema::create('proveedors', function (Blueprint $table) {
            $table->id('id');
            $table->string ('name_proveedor');
            $table->string ('contacto1_proveedor');
            $table->string ('tel1_proveedor');
            $table->string ('contacto2_proveedor');
            $table->string ('tel2_proveedor');
            $table->string ('comentario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedors');
    }
};
