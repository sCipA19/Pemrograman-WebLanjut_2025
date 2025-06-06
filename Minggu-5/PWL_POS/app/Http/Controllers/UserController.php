<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\LevelModel; // Tambahkan ini agar LevelModel dikenali
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserController extends Controller
{
    // public function index()
    // {
    //     // $user = UserModel::with('level')->get();
    //     // dd($user);
    // }

    // public function tambah()
    // {
    //     // return view('user_tambah');
    // }

    // public function tambah_simpan(Request $request)
    // {
    //     // UserModel::create([
    //     //     'username' => $request->username, // Memperbaiki penggunaan field username
    //     //     'nama' => $request->nama,
    //     //     'password' => Hash::make($request->password), // Menghilangkan tanda kutip di $request->password
    //     //     'level_id' => $request->level_id
    //     // ]);

    //     // return redirect('/user');
    // }

    // public function ubah($id)
    // {
    //     $user = UserModel::find($id);
    //     return view('user_ubah', ['data' => $user]);
    // }

    // public function ubah_simpan($id, Request $request)
    // {
    //     $user = UserModel::find($id);

    //     $user->username = $request->username;
    //     $user->nama = $request->nama;
    //     $user->password = Hash::make($request->password);
    //     $user->level_id = $request->level_id;

    //     $user->save();

    //     return redirect('/user');
    // }

    // public function hapus($id)
    // {
    //     // $user = UserModel::find($id);
    //     // $user->delete();

    //     // return redirect('/user');
    // }

    // public function index()
    // {
    //     $user = UserModel::with('level')->get();
    //     dd($user);
    // }

    public function index()
    {
        $user = UserModel::with('level')->get();
        return view('user', ['data' => $user]);
    }
}
