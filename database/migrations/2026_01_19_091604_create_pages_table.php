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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Judul Halaman (e.g., Sejarah)
            $table->string('slug')->unique(); // URL (e.g., sejarah)
            $table->longText('content')->nullable(); // Isi lengkap (Rich Text)
            $table->string('image')->nullable(); // Gambar Header opsional
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
