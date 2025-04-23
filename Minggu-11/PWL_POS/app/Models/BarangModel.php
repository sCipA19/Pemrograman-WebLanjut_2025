<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangModel extends Model
{
    use HasFactory;

    protected $table = 'm_barang'; // Nama tabel di database
    protected $primaryKey = 'barang_id'; // Primary Key
    public $timestamps = true; // Menggunakan timestamps

    protected $fillable = [
        'barang_kode',
        'barang_nama',
        'kategori_id',
        'harga_beli',
        'harga_jual',
        'image', // Menambahkan kolom 'image' ke fillable
    ];

    // Relasi ke tabel kategori (m_kategori)
    public function kategori()
    {
        return $this->belongsTo(KategoriModel::class, 'kategori_id', 'kategori_id');
    }

    // Relasi ke detail penjualan
    public function detail_penjualan()
    {
        return $this->hasMany(PenjualanDetailModel::class, 'barang_id');
    }

    // Accessor untuk mendapatkan URL gambar
    public function getImageUrlAttribute()
    {
        return $this->image ? url('storage/' . $this->image) : null; // Menghasilkan URL gambar jika ada
    }
}
