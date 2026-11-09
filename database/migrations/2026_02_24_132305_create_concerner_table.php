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
        Schema::create('concerner', function (Blueprint $table) {
            $table->string('nbPer');
            $table->foreignId('idRes')->constrained('reservation','idRes');
            $table->foreignId('idTar')->constrained('tarif','idTar');
            $table->foreignId('idSea')->constrained('seance','idSea');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('concerner');
    }
};
