<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barangIds = DB::table('m_barang')->pluck('barang_id'); // Ambil semua ID barang
        $userIds = DB::table('users')->pluck('id'); // Ambil semua ID user dari 'users'

        if ($userIds->isEmpty()) {
            $userIds = collect([null]); // Pastikan tidak error jika users kosong
        }

        $data = [];
        foreach ($barangIds as $barang_id) {
            $data[] = [
                'barang_id' => $barang_id,
                'user_id' => $userIds->random(), // Ambil user secara random
                'jumlah' => rand(10, 100),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('t_stok')->insert($data);
    }
}
