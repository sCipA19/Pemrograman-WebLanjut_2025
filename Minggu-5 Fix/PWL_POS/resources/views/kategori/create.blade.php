@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', 'Kategori')
@section('content_header_title', 'Kategori')
@section('content_header_subtitle', 'Create')

{{-- Content body: main page content --}}
@section('content')
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Buat Kategori Baru</h3>
            </div>

            {{-- Formulir --}}
            <form method="post" action="{{ route('kategori.store') }}">
                @csrf
                <div class="card-body">
                    {{-- Kode Kategori --}}
                    <div class="form-group">
                        <label for="kategori_kode">Kode Kategori</label>
                        <input type="text" class="form-control @error('kategori_kode') is-invalid @enderror" 
                               id="kategori_kode" name="kategori_kode" 
                               placeholder="Masukkan kode kategori" 
                               value="{{ old('kategori_kode') }}" required>
                        @error('kategori_kode')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Nama Kategori --}}
                    <div class="form-group">
                        <label for="kategori_nama">Nama Kategori</label>
                        <input type="text" class="form-control @error('kategori_nama') is-invalid @enderror" 
                               id="kategori_nama" name="kategori_nama" 
                               placeholder="Masukkan nama kategori" 
                               value="{{ old('kategori_nama') }}" required>
                        @error('kategori_nama')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Tombol Submit --}}
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
