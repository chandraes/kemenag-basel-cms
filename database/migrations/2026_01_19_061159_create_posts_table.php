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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke User (Penulis)
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            
            // Kategori (Nanti Anda buat tabel categories, ini disiapkan dulu)
            // $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();

            $table->string('title');
            $table->string('slug')->unique(); // Untuk URL SEO friendly
            
            // Konten Utama
            $table->longText('content')->nullable();
            $table->text('excerpt')->nullable(); // Ringkasan untuk list berita
            
            // Gambar Utama
            $table->string('featured_image')->nullable();
            
            // Status Workflow
            $table->string('status')->default('draft');
            
            // Opsi Tambahan
            $table->boolean('is_featured')->default(false); // Untuk Headline/Slider
            $table->timestamp('published_at')->nullable(); // Jadwal tayang
            
            // Audit & SEO sederhana
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            
            $table->timestamps();
            
            // INDEXING (Penting untuk performa pencarian database)
            $table->index('status');
            $table->index('published_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
