<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('recepti', function (Blueprint $table) {
            $table->id();
            $table->string('recept_ime');
            $table->text('opis');
            $table->integer('trajanje_pripreme');
            $table->integer('porcije');
            $table->enum('tezina', ['lako', 'osrednje', 'tesko']);
            $table->string('slika_recepta')->nullable();
            $table->json('sastojci'); // cuva kao json
            $table->json('instrukcije'); // cuva kao json
            $table->string('napravio'); // fk za korisniak
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recepti');
    }
};
