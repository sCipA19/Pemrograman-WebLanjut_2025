<?php

namespace App\Http\Controllers\Api;

use App\Models\BarangModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    // Menampilkan semua barang
    public function index()
    {
        $barangs = BarangModel::all();
        
        // Menambahkan URL gambar untuk setiap barang
        $barangs->map(function ($barang) {
            $barang->image_url = $barang->getImageUrlAttribute();
            return $barang;
        });

        return response()->json($barangs);
    }

    // Menyimpan data barang baru
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'barang_kode' => 'required',
            'barang_nama' => 'required',
            'kategori_id' => 'required|exists:m_kategori,kategori_id', // Pastikan kategori_id ada di tabel kategori
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // validasi gambar
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Proses upload gambar
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('barang_images', 'public'); // upload gambar ke storage public
        } else {
            $imagePath = null; // jika tidak ada gambar
        }

        // Simpan data barang ke database
        $barang = BarangModel::create([
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'kategori_id' => $request->kategori_id,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'image' => $imagePath, // simpan path gambar
        ]);

        // Kembalikan response dengan URL gambar
        return response()->json([
            'message' => 'Barang created successfully',
            'data' => [
                'barang' => $barang,
                'image_url' => $barang->getImageUrlAttribute(),
            ],
        ], 201);
    }

    // Menampilkan data barang berdasarkan ID
    public function show($barang_id)
    {
        $barang = BarangModel::find($barang_id);

        if (!$barang) {
            return response()->json(['message' => 'Barang not found'], 404);
        }

        // Menambahkan URL gambar
        $barang->image_url = $barang->getImageUrlAttribute();

        return response()->json($barang);
    }

    // Memperbarui data barang
    public function update(Request $request, $barang_id)
    {
        $barang = BarangModel::find($barang_id);

        if (!$barang) {
            return response()->json(['message' => 'Barang not found'], 404);
        }

        // Validasi input
        $validator = Validator::make($request->all(), [
            'barang_kode' => 'required',
            'barang_nama' => 'required',
            'kategori_id' => 'required|exists:m_kategori,kategori_id', // Pastikan kategori_id ada di tabel kategori
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // validasi gambar
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Proses upload gambar jika ada file
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($barang->image) {
                Storage::disk('public')->delete($barang->image);
            }

            // Upload gambar baru
            $imagePath = $request->file('image')->store('barang_images', 'public');
            $barang->image = $imagePath;
        }

        // Perbarui data barang
        $barang->update([
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'kategori_id' => $request->kategori_id,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
        ]);

        // Kembalikan response
        return response()->json([
            'message' => 'Barang updated successfully',
            'data' => $barang,
            'image_url' => $barang->getImageUrlAttribute(),
        ]);
    }

    // Menghapus data barang
    public function destroy($barang_id)
    {
        $barang = BarangModel::find($barang_id);

        if (!$barang) {
            return response()->json(['message' => 'Barang not found'], 404);
        }

        // Hapus gambar jika ada
        if ($barang->image) {
            Storage::disk('public')->delete($barang->image);
        }

        // Hapus data barang
        $barang->delete();

        // Kembalikan response
        return response()->json(['message' => 'Barang deleted successfully']);
    }
}
