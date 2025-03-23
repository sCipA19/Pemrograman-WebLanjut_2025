<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Models\LevelModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class LevelController extends Controller
{
    // Menampilkan halaman daftar level.
    public function index(): View {
        $breadcrumb = (object)[
            'title' => 'Daftar Level',
            'list'  => ['Home', 'Level']
        ];

        $page = (object)[
            'title' => 'Daftar level yang terdaftar dalam sistem'
        ];

        $activeMenu = 'level';
        $level = LevelModel::all();

        return view('level.index', compact('breadcrumb', 'page', 'level', 'activeMenu'));
    }

    // Mengambil data level untuk DataTables.
    public function list(Request $request)
    {
        $levels = LevelModel::select('level_id', 'level_kode', 'level_nama');

        return DataTables::of($levels)
            ->addIndexColumn()
            ->addColumn('aksi', function ($level) {
                $detailUrl = url('level/' . $level->level_id);
                $editUrl   = url('level/' . $level->level_id . '/edit');
                $deleteUrl = url('level/' . $level->level_id);

                $btn  = '<a href="' . $detailUrl . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . $editUrl . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . $deleteUrl . '">'
                        . csrf_field() . method_field('DELETE')
                        . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button>'
                        . '</form>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    // Menampilkan detail level.
    public function show(string $id): View {
        $level = LevelModel::findOrFail($id);

        $breadcrumb = (object)[
            'title' => 'Detail Level',
            'list'  => ['Home', 'Level', 'Detail']
        ];

        $page = (object)[
            'title' => 'Detail Level'
        ];

        $activeMenu = 'level';

        return view('level.show', compact('breadcrumb', 'level', 'page', 'activeMenu'));
    }

    // Menampilkan form untuk menambahkan level baru.
    public function create(): View {
        $breadcrumb = (object)[
            'title' => 'Tambah Level',
            'list'  => ['Home', 'Level']
        ];

        $page = (object)[
            'title' => 'Tambah level baru'
        ];

        $activeMenu = 'level';

        return view('level.create', compact('breadcrumb', 'page', 'activeMenu'));
    }

    // Menyimpan data level baru.
    public function store(Request $request): RedirectResponse {
        $validatedData = $request->validate([
            'level_nama' => 'required|string',
            'level_kode' => 'required|string|unique:m_level,level_kode',
        ], [
            'level_nama.required' => 'Nama Level harus diisi.',
            'level_kode.required' => 'Kode Level harus diisi.',
            'level_kode.unique'   => 'Kode Level sudah digunakan.',
        ]);

        LevelModel::create($validatedData);

        return redirect('/level')->with('success', 'Data Level berhasil ditambahkan');
    }

    // Menampilkan form edit level.
    public function edit($id): View {
        $level = LevelModel::findOrFail($id);

        $breadcrumb = (object)[
            'title' => 'Edit Level',
            'list'  => ['Home', 'Level', 'Edit']
        ];

        $page = (object)[
            'title' => 'Edit Level'
        ];

        $activeMenu = 'level';

        return view('level.edit', compact('breadcrumb', 'page', 'level', 'activeMenu'));
    }

    // Memperbarui data level.
    public function update(Request $request, $id): RedirectResponse {
        $validated = $request->validate([
            'level_nama' => 'required|string',
            'level_kode' => 'required|string|unique:m_level,level_kode,' . $id . ',level_id',
        ]);

        $level = LevelModel::findOrFail($id);
        $level->update($validated);

        return redirect('/level')->with('success', 'Data Level berhasil diperbarui');
    }

    // Menghapus data level.
    public function destroy($id): RedirectResponse {
        $level = LevelModel::findOrFail($id);
        $level->delete();

        return redirect('/level')->with('success', 'Data Level berhasil dihapus');
    }
}
