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
        Schema::create('pokemon', function (Blueprint $table) {
            $table->id();
            $table->String('nombre');
            $table->String('avatar');
            $table->String('descripcion');
            $table->integer('peso');
            $table->integer('altura');
            $table->integer('hp');
            $table->integer('ataque');
            $table->integer('defensa');
            $table->integer('ataque_especial');
            $table->integer('defensa_especial');
            $table->integer('velocidad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokemon');

    }
};
