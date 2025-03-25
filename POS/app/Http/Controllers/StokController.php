<?php

namespace App\Http\Controllers;

use App\Models\StokModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StokController extends Controller {
    public function index(){
        $breadcrumb = (object) [
            'title' => 'Stok',
            'list' => ['Home', 'Stok']
        ];

        $page = (object) [
            'title' => 'Stok barang yang tersisa'
        ];

        $activeMenu = 'stok';

        return view('stok.index', compact('breadcrumb', 'page', 'activeMenu'));
    }

    public function list(Request $request) {
        $stok = StokModel::with(['barang', 'user']);
    
        return DataTables::of($stok)
            ->addIndexColumn()
            ->addColumn('barang_nama', function ($stok) {
                return $stok->barang ? $stok->barang->barang_nama : '-';
            })
            ->addColumn('user_nama', function ($stok) {
                return $stok->user ? $stok->user->name : '-';
            })
            ->addColumn('jumlah', function ($stok) { // Ubah stok_jumlah menjadi jumlah
                return $stok->jumlah;
            })
            ->addColumn('aksi', function ($stok) {
                $btn = '<a href="' . url('/stok/' . $stok->stok_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/stok/' . $stok->stok_id) . '">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    
    public function store(Request $request){
        $request->validate([
            'barang_id' => 'required|integer',
            'jumlah' => 'required|integer', // Ubah stok_jumlah menjadi jumlah
        ]);
    
        StokModel::create([
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah, // Pastikan gunakan jumlah, bukan stok_jumlah
        ]);
    
        return redirect('/stok')->with('success', 'Data barang berhasil disimpan');
    }
    
    public function update(Request $request, $id) {
        $request->validate([
            'barang_id' => 'required|integer',
            'jumlah' => 'required|integer', // Ubah stok_jumlah menjadi jumlah
        ]);
    
        $stok = StokModel::findOrFail($id);
        $stok->update([
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah, // Pastikan gunakan jumlah, bukan stok_jumlah
        ]);
    
        return redirect('/stok')->with('success', 'Data stok berhasil diperbarui');
    }
    

    public function destroy($id){
        $stok = StokModel::findOrFail($id);

        try {
            $stok->delete();
            return redirect('/stok')->with('success', 'Data barang berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/stok')->with('error', 'Data barang gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
