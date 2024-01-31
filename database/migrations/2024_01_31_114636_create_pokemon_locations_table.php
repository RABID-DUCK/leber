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
        Schema::create('pokemon_locations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pokemon_id')->unsigned();
            $table->bigInteger('location_id')->unsigned();
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
            $table->foreign('pokemon_id')->references('id')->on('pokemons')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pokemon_locations', function (Blueprint $table) {
            $table->dropForeign(['pokemon_id']);
            $table->dropForeign(['location_id']);
            $table->dropColumn('pokemon_id');
            $table->dropColumn('location_id');
        });
        Schema::dropIfExists('pokemon_locations');
    }
};
