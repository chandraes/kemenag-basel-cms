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
        Schema::create('statistics', function (Blueprint $table) {
            $table->id();
            $table->string('label'); // Contoh: Jumlah Madrasah
            $table->string('value'); // Contoh: 150 (String agar bisa pakai tanda + atau %)
            $table->string('icon'); // Nama Icon
            $table->string('color')->default('blue'); // Warna tema (blue, green, red, yellow)
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistics');
    }
};
