<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelModel extends Model
{
    use HasFactory;

    protected $table = 'm_level'; // Sesuaikan dengan nama tabel
    protected $primaryKey = 'level_id'; // Sesuaikan dengan primary key
    // public $timestamps = false; // Jika tabel tidak memiliki kolom `created_at` dan `updated_at`
    // Tambahkan kolom yang ingin diisi secara massal ke dalam $fillable
    protected $fillable = [
        'level_id',
        'level_kode',
        'level_nama'
    ];
}
