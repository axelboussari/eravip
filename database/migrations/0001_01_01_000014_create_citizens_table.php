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
        Schema::create('citizens', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('numero')->unique();
            $table->string('nom');
            $table->string('prenom');
            $table->date('date_naissance');
            $table->string('lieu_naissance');
            $table->string('nationalite');
            $table->string('photo');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('adresse');
            $table->date('date_dexpire');
            $table->json('filiation');

            $table->uuid('commune_id');
            $table->uuid('quartier_id');
            $table->uuid('arrondissement_id');
            $table->foreign('commune_id')->references('id')->on('communes')->onDelete('cascade');
            $table->foreign('quartier_id')->references('id')->on('quartiers')->onDelete('cascade');
            $table->foreign('arrondissement_id')->references('id')->on('arrondissements')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citizens');
    }
};
