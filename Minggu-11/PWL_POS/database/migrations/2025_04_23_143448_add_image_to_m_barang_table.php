<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        // Menambahkan kolom 'image' ke tabel 'm_barang'
        Schema::table('m_barang', function (Blueprint $table) {
            $table->string('image')->nullable(); // Kolom image dapat menyimpan path gambar, nullable jika tidak ada gambar
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        // Menghapus kolom 'image' saat rollback migrasi
        Schema::table('m_barang', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
};
