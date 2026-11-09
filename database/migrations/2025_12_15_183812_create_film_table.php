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
        Schema::create('film', function (Blueprint $table) {
            $table->id('idFil');
            $table->string('titreFil');
            $table->text('descFil');
            $table->string('imgFil');
            $table->integer ('dureFil');
            $table->date('dateSortie');
            $table->foreignId('idGenre')->constrained('genre', 'idGenre');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('film');
    }
};
