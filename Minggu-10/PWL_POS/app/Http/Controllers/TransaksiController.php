<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenjualanModel;
use Yajra\DataTables\Facades\DataTables;

class TransaksiController extends Controller
{
    public function index()
    {
        $page = (object)[
            'title' => 'Data Transaksi'
        ];

        $breadcrumb = (object)[
            'title' => 'Transaksi',
            'list' => ['Home', 'Transaksi']
        ];

        $activeMenu = 'transaksi';
        return view('transaksi.index', compact('page', 'breadcrumb', 'activeMenu'));
    }

    public function getPenjualan(Request $request)
    {
        if ($request->ajax()) {
            $data = PenjualanModel::orderBy('penjualan_tanggal', 'desc');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('aksi', function ($transaksi) {
                    $btn  = '<button onclick="modalAction(\''.url('/transaksi/'.$transaksi->penjualan_id.'/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button>';
                    $btn .= ' <button onclick="modalAction(\''.url('/transaksi/'.$transaksi->penjualan_id.'/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button>';
                    $btn .= ' <button onclick="modalAction(\''.url('/transaksi/'.$transaksi->penjualan_id.'/delete_ajax').'\')" class="btn btn-danger btn-sm">Hapus</button>';
                    return $btn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
    }

    public function show_ajax($id)
    {
        $transaksi = PenjualanModel::with(['user', 'details.barang'])->findOrFail($id);

        $page = (object)[
            'title' => 'Detail Transaksi'
        ];

        return view('transaksi.show_ajax', compact('transaksi', 'page'));
    }

    public function edit_ajax($id)
    {
        $transaksi = PenjualanModel::findOrFail($id);

        $page = (object)[
            'title' => 'Edit Transaksi'
        ];

        return view('transaksi.edit_ajax', compact('transaksi', 'page'));
    }

    public function update(Request $request, $id)
    {
        $transaksi = PenjualanModel::findOrFail($id);

        // Validasi data; tambahkan field lain jika perlu
        $validatedData = $request->validate([
            'penjualan_tanggal' => 'required|date',
            // tambahkan validasi field lain sesuai kebutuhan
        ]);

        $transaksi->update($validatedData);

        return redirect()->back()->with('success', 'Transaksi berhasil diupdate');
    }

    // Menampilkan view konfirmasi delete via AJAX
    public function delete_ajax($id)
    {
        $transaksi = PenjualanModel::findOrFail($id);

        $page = (object)[
            'title' => 'Hapus Transaksi'
        ];

        return view('transaksi.delete_ajax', compact('transaksi', 'page'));
    }

    // Proses penghapusan data
    public function destroy(Request $request, $id)
    {
        $transaksi = PenjualanModel::findOrFail($id);
        $transaksi->delete();

        // Jika menggunakan AJAX, kirim response berupa JSON
        if ($request->ajax()) {
            return response()->json(['success' => 'Transaksi berhasil dihapus']);
        }

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus');
    }

    public function list(Request $request)
    {
        $transactions = PenjualanModel::query();
        return DataTables::of($transactions)
            ->addIndexColumn()
            ->addColumn('aksi', function($row) {
                // Action buttons dapat ditambahkan di sini jika diperlukan
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }
}
