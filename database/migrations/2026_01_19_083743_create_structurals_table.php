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
        Schema::create('structurals', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama Pejabat
            $table->string('position'); // Jabatan (misal: Kasubbag TU)
            $table->string('photo')->nullable(); // Foto
            $table->integer('sort_order')->default(0); // Untuk mengatur urutan tampil
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('structurals');
    }
};
