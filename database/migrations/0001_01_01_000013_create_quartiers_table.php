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
        Schema::create('quartiers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nom_quartier');
            $table->uuid('arrondissement_id');
            $table->foreign('arrondissement_id')->references('id')->on('arrondissements')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quartiers');
    }
};
