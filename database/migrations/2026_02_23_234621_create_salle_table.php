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
        Schema::create('salle', function (Blueprint $table) {
            $table->id('idSal');
            $table->integer('numSal');
            $table->string('nbPlace');
            $table->foreignId('idCin')->constrained('cinema', 'idCin');
            $table->foreignId('idTyp')->constrained('type_salle', 'idTyp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salle');
    }
};
