<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            LevelSeeder::class,          // Level harus ada sebelum User
            UserSeeder::class,           // User butuh Level
            KategoriSeeder::class,       // Kategori harus ada sebelum Barang
            BarangSeeder::class,         // Barang butuh Kategori
            StokSeeder::class,           // Stok butuh Barang
            PenjualanSeeder::class,      // Penjualan dibuat dulu
            PenjualanDetailSeeder::class,// Detail butuh Penjualan
            SupplierSeeder::class,       // Supplier bisa di akhir
        ]);
    }
}
