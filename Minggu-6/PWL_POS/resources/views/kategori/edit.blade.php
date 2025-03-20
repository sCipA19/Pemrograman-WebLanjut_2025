@extends('layouts.app')

@section('subtitle', 'Edit Kategori')
@section('content_header_title', 'Edit Kategori')

@section('content')
<div class="container">
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Edit Kategori</h3>
        </div>

        <form method="post" action="{{ route('kategori.update', ['kategori' => $kategori->kategori_id]) }}">
            @csrf
            @method('PUT')

            <div class="card-body">
                <div class="form-group">
                    <label for="kodeKategori">Kode Kategori</label>
                    <input type="text" class="form-control" id="kodeKategori" name="kodeKategori"
                        value="{{ old('kodeKategori', $kategori->kategori_kode) }}" required>
                </div>
                <div class="form-group">
                    <label for="namaKategori">Nama Kategori</label>
                    <input type="text" class="form-control" id="namaKategori" name="namaKategori"
                        value="{{ old('namaKategori', $kategori->kategori_nama) }}" required>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-warning">Update</button>
                <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
