<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    public function run()
    {
        DB::table('m_level')->insert([
            ['level_kode' => 'ADM', 'level_nama' => 'Admin', 'created_at' => now(), 'updated_at' => now()],
            ['level_kode' => 'MHS', 'level_nama' => 'Mahasiswa', 'created_at' => now(), 'updated_at' => now()],
            ['level_kode' => 'DOS', 'level_nama' => 'Dosen', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
