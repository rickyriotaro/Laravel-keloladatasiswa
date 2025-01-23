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
       // database/migrations/xxxx_xx_xx_create_walikelas_table.php
Schema::create('walikelas', function (Blueprint $table) {
    $table->id();
    $table->foreignId('guru_id')->constrained('guru')->cascadeOnDelete();
    $table->foreignId('kelas_id')->constrained('kelas')->cascadeOnDelete();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('walikelas');
    }
};
