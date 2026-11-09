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
        Schema::create('participe', function (Blueprint $table) {
            $table->foreignId('idPer')->constrained('personne', 'idPer');
            $table->foreignId('idRolePer')->constrained('role_personne', 'idRolePer');
            $table->foreignId('idFil')->constrained('film', 'idFil');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participe');
    }
};
