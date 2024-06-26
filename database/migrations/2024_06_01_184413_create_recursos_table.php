<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('recursos', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_recurso');
            $table->string('tag');
            $table->date('fecha_alta');
            $table->string('marca');
            $table->string('modelo');
            $table->string('serie');
            $table->json('details');
            $table->text('comentario')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('recursos');
    }
};
