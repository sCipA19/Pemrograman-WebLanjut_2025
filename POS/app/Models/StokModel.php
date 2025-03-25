<?php
   
   namespace App\Models;

   use Illuminate\Database\Eloquent\Factories\HasFactory;
   use Illuminate\Database\Eloquent\Model;
   
   class StokModel extends Model
   {
       use HasFactory;
   
       protected $table = 't_stok'; // Sesuaikan dengan nama tabel di database
   
       protected $primaryKey = 'stok_id'; // Pastikan primary key sesuai
   
       protected $fillable = ['barang_id', 'user_id', 'jumlah']; // Sesuaikan dengan kolom yang ada di database
   
       public function barang()
       {
           return $this->belongsTo(BarangModel::class, 'barang_id', 'barang_id');
       }
   
       public function user()
       {
           return $this->belongsTo(User::class, 'user_id', 'id'); // Sesuaikan dengan primary key tabel users
       }
   }
   