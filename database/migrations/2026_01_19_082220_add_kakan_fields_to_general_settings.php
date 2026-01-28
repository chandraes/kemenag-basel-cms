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
            $table->string('kakan_name')->nullable(); // Nama Kepala
            $table->string('kakan_photo')->nullable(); // Foto Beliau
            $table->text('kakan_message')->nullable(); // Isi Sambutan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('general_settings', function (Blueprint $table) {
            $table->dropColumn('kakan_name');
            $table->dropColumn('kakan_photo');
            $table->dropColumn('kakan_message');
        });
    }
};
