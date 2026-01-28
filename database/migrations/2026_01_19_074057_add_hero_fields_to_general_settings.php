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
        Schema::table('general_settings', function (Blueprint $table) {
            $table->string('hero_title')->nullable(); // Judul Besar
            $table->text('hero_description')->nullable(); // Deskripsi di bawah judul
            $table->string('hero_bg_image')->nullable(); // Gambar Background khusus
            $table->string('hero_cta_text')->nullable()->default('Selengkapnya'); // Teks Tombol
            $table->string('hero_cta_url')->nullable(); // Link Tombol
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('general_settings', function (Blueprint $table) {
            $table->dropColumn(['hero_title', 'hero_description', 'hero_bg_image', 'hero_cta_text', 'hero_cta_url']);
        });
    }
};
