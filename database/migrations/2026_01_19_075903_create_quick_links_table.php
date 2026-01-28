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
        Schema::create('quick_links', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Contoh: E-Buku Tamu
            $table->string('url'); // Contoh: https://ptsp.kemenag.go.id
            $table->string('icon_name'); // Contoh: book, support_agent (Nama Material Icons)
            $table->string('color')->default('#2563eb'); // Warna background ikon (Hex code)
            $table->string('target')->default('_self'); // _self atau _blank (tab baru)
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0); // Untuk urutan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quick_links');
    }
};
