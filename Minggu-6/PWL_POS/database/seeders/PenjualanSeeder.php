<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        for ($i = 1; $i <= 10; $i++) {
            $data[] = [
                'tanggal' => Carbon::now()->subDays(rand(1, 30)),
                'customer' => 'Customer ' . $i,
            ];
        }
        DB::table('t_penjualan')->insert($data);
    }
}
