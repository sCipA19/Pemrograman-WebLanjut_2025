@extends('layouts.template')
  
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @empty($supplier)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5> Data yang Anda cari tidak ditemukan.
                </div>
                <a href="{{ url('supplier') }}" class="btn btn-sm btn-default mt- 2">Kembali</a>
            @else
                <form method="POST" action="{{ url('/supplier/' . $supplier->supplier_id) }}" class="form-horizontal">
                    @csrf
                    {!! method_field('PUT') !!} <!-- tambahkan baris ini untuk proses edit yang butuh method PUT -->
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">ID Supplier</label>
                        <div class="col-11">
                            <input type="text" class="form-control" id="supplier_ID" name="supplier_ID"
                                value="{{ old('supplier_ID', $supplier->supplier_ID) }}" required>
                            @error('supplier_ID')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Kode</label>
                        <div class="col-11">
                            <input type="text" class="form-control" id="kode" name="kode"
                                value="{{ old('kode', $supplier->kode) }}" required>
                            @error('kode')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Nama</label>
                        <div class="col-11">
                            <input type="text" class="form-control" id="nama" name="nama"
                                value="{{ old('nama', $supplier->supplier_nama) }}" required>
                            @error('nama')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Alamat</label>
                        <div class="col-11">
                            <input type="text" class="form-control" id="alamat" name="alamat"
                                value="{{ old('alamat', $supplier->supplier_beli) }}" required>
                            @error('alamat')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label"></label>
                        <div class="col-11">
                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                            <a class="btn btn-sm btn-default ml-1" href="{{ url('supplier') }}">Kembali</a>
                        </div>
                    </div>
                </form>
            @endempty
        </div>
    </div>
@endsection
@push('css')
@endpush
@push('js')
@endpush