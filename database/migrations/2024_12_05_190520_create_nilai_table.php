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
        // database/migrations/xxxx_xx_xx_create_nilai_table.php
Schema::create('nilai', function (Blueprint $table) {
    $table->id();
    $table->foreignId('siswa_id')->constrained('siswa')->cascadeOnDelete();
    $table->foreignId('pelajaran_id')->constrained('pelajaran')->cascadeOnDelete();
    $table->integer('nilai');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai');
    }
};
