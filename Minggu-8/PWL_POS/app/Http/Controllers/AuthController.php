<?php

namespace App\Http\Controllers; 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserModel;
use App\Models\LevelModel;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('auth.login');
    }

    public function postlogin(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $credentials = $request->only('username', 'password');

            if (Auth::attempt($credentials)) { 
                return response()->json([
                    'status' => true,
                    'message' => 'Login Berhasil', 
                    'redirect' => url('/')
                ]);
            }

            return response()->json([ 
                'status' => false, 
                'message' => 'Login Gagal'
            ]);
        }

        return redirect('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken(); 
        return redirect('login');
    }

    public function register()
    {
        // Coba tambahkan dd() untuk cek datanya:
        $level = LevelModel::select('level_id', 'level_nama')->get();

        // Jika kamu mau debugging:
        // dd($level); // <-- Hapus ini nanti setelah cek data keluar

        return view('auth.register', compact('level'));
    }

    public function store_user(Request $request)
    {
        $request->validate([
            'username' => 'required|string|min:3|unique:m_user,username',
            'nama'     => 'required|string|max:100',
            'password' => 'required|min:5',
            'level_id' => 'required|integer',
        ]);
    
        UserModel::create([
            'username' => $request->username,
            'nama'     => $request->nama,
            'password' => bcrypt($request->password),
            'level_id' => $request->level_id,
        ]);
    
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status' => true,
                'message' => 'Registrasi Berhasil',
                'redirect' => url('login')
            ]);
        }
    
        return redirect('/')->with('success', 'Registrasi berhasil');
    }
}
