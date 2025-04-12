<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/level', [LevelController::class, 'index']);
Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/user', [UserController::class, 'index']);

Route::get('/user/tambah', [UserController::class, 'tambah']);
Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);
Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);
Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);
Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);

// Jobsheet 5
// Route::get('/', [WelcomeController::class, 'index']);

Route::group(['prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/list', [UserController::class, 'list']);
    Route::get('/create', [UserController::class, 'create']);
    Route::post('/', [UserController::class, 'store']);
    Route::get('/create_ajax', [UserController::class, 'create_ajax']);
    Route::post('/ajax', [UserController::class, 'store_ajax']);
    Route::get('/{id}/show_ajax', [UserController::class, 'show_ajax']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::get('/{id}/edit', [UserController::class, 'edit']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']);
    Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']);
    Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']);
    Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']);
    Route::delete('/{id}', [UserController::class, 'destroy']);
    Route::get('/import', [UserController::class, 'import']);
    Route::post('/import_ajax', [UserController::class, 'import_ajax'])->name('user.import_ajax');
});

Route::group(['prefix' => 'level'], function () {
    // Route::middleware(['authorize:ADM,MNG'])->group(function () {
        Route::get('/', [LevelController::class, 'index'])->name('level.index');
        Route::post('/list', [LevelController::class, 'list'])->name('level.list');
        Route::get('/create', [LevelController::class, 'create'])->name('level.create');
        Route::get('/create_ajax', [LevelController::class, 'create_ajax']); // form tambah level ajax
        Route::get('/{id}', [LevelController::class, 'show']);
        Route::get('/{id}/show_ajax', [LevelController::class, 'show_ajax']); // detail ajax
        Route::post('/', [LevelController::class, 'store']);
        Route::post('/ajax', [LevelController::class, 'store_ajax']);        // simpan ajax
        Route::get('/{id}/edit', [LevelController::class, 'edit'])->name('level.edit');
        Route::put('/{id}', [LevelController::class, 'update']);
        Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']); // form edit ajax
        Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']);  // update ajax
        Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']); // konfirmasi delete ajax
        Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']); // hapus ajax
        Route::delete('/{id}', [LevelController::class, 'destroy']);
        Route::get('/import', [LevelController::class, 'import']);
        Route::post('/import_ajax', [LevelController::class, 'import_ajax']);
    });

Route::group(['prefix'=>'kategori'],function(){
    Route::get('/',[KategoriController::class,'index'])->name('kategori.index');
    Route::post('/list',[KategoriController::class,'list'])->name('kategori.list');
    Route::get('/create',[KategoriController::class,'create'])->name('kategori.create');
    Route::get('/create_ajax', [KategoriController::class, 'create_ajax']); // menampilkan halaman form tambah kategori ajax
    Route::post('/',[KategoriController::class,'store']);
    Route::post('/ajax', [KategoriController::class, 'store_ajax']);        // menyimpan data kategori baru ajax
    Route::get('/{id}/edit', [KategoriController::class,'edit'])->name('kategori.edit');
    Route::put('/{id}', [KategoriController::class,'update']);
    Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']); // menampilkan halaman form edit kategori Ajax
    Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']);  // menyimpan perubahan data kategori Ajax
    Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']); // untuk tampilkan form confirm  delete kategori Ajax
    Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']); // untuk menghapus data kategori Ajax
    Route::get('/import', [KategoriController::class, 'import']);
    Route::post('/import_ajax', [KategoriController::class, 'import_ajax']);
    Route::delete('/{id}',[KategoriController::class,'destroy']);
});

Route::group(['prefix' => 'barang'], function () {
    Route::get('/', [BarangController::class, 'index']);
    Route::post('/list', [BarangController::class, 'list']);
    Route::get('/create', [BarangController::class, 'create']);
    Route::get('/create_ajax', [BarangController::class, 'create_ajax']);
    Route::post('/', [BarangController::class, 'store']);
    Route::post('/ajax', [BarangController::class, 'store_ajax']);
    Route::get('/{id}/edit', [BarangController::class, 'edit']);
    Route::put('/{id}', [BarangController::class, 'update']);
    Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']);
    Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax']);
    Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']);
    Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax']);
    Route::get('/import', [BarangController::class, 'import']);
    Route::post('/import_ajax', [BarangController::class, 'importAjax']);
    Route::get('/export_excel', [BarangController::class, 'export_excel']);
    Route::delete('/{id}', [BarangController::class, 'destroy']);
});



Route::group(['prefix' => 'supplier'], function(){
    Route::get('/', [SupplierController::class, 'index']);
    Route::post('/list', [SupplierController::class, 'list']);
    Route::get('/create', [SupplierController::class, 'create']);
    Route::post('/', [SupplierController::class, 'store']);
    Route::get('/{id}/edit', [SupplierController::class, 'edit']);
    Route::put('/{id}', [SupplierController::class, 'update']);
    Route::get('/create_ajax', [SupplierController::class, 'create_ajax']);
    Route::post('/ajax', [SupplierController::class, 'store_ajax']);
    Route::get('/{id}', [SupplierController::class, 'show']);
    Route::get('/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']); // menampilkan halaman form edit Supplier Ajax
    Route::put('/{id}/update_ajax', [SupplierController::class, 'update_ajax']);  // menyimpan perubahan data Supplier Ajax
    Route::get('/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']); // untuk tampilkan form confirm  delete Supplier Ajax
    Route::delete('/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']); // untuk menghapus data Supplier Ajax
    Route::get('/supplier/import', [SupplierController::class, 'import']);
    Route::post('/supplier/import_ajax', [SupplierController::class, 'import_ajax']);
    Route::delete('/{id}', [SupplierController::class, 'destroy']);
});

Route::group(['prefix'=>'stok'],function(){
    Route::get('/',[StokController::class,'index']);
    Route::post('/list',[StokController::class,'list']);
    Route::get('/create',[StokController::class,'create']);
    Route::post('/',[StokController::class,'store']);
    Route::get('/{id}',[StokController::class,'show']);
    Route::get('/{id}/edit', [StokController::class,'edit']);
    Route::put('/{id}', [StokController::class,'update']);
    Route::get('/{id}/edit_ajax', [StokController::class, 'edit_ajax']); // menampilkan halaman form edit Stok Ajax
    Route::put('/{id}/update_ajax', [StokController::class, 'update_ajax']);  // menyimpan perubahan data Stok Ajax
    Route::get('/{id}/delete_ajax', [StokController::class, 'confirm_ajax']); // untuk tampilkan form confirm  delete Stok Ajax
    Route::delete('/{id}/delete_ajax', [StokController::class, 'delete_ajax']); // untuk menghapus data Stok Ajax
    Route::delete('/{id}',[StokController::class,'destroy']);
});

// Route::group(['prefix'=>'penjualan'],function(){
//     Route::get('/',[penjualanController::class,'index']);
//     Route::post('/list',[penjualanController::class,'list']);
//     Route::post('/',[penjualanController::class,'store']);
//     Route::get('/{id}',[penjualanController::class,'show']);
//     Route::delete('/{id}',[penjualanController::class,'destroy']);
//     Route::get('/{id}/edit', [penjualanController::class,'edit']);
// });

// Jobsheet 7
Route::pattern('id', '[0-9]+'); //artinya ketika parameter {id}, maka harus berupa angka
 
 Route::get('login', [AuthController::class, 'login'])->name('login');
 Route::post('login', [AuthController::class, 'postLogin']);
 Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');
 Route::get('/register', [AuthController::class, 'register'])->name('register');
 Route::post('/register', [AuthController::class, 'store_user'])->name('store_user');
 
 Route::middleware(['auth', 'authorize.user:ADM,MNG'])->group(function () {
});

