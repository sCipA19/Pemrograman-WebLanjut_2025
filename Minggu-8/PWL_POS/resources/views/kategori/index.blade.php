@extends('layouts.template')
  
@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
    </div>

    <div class="card-body">
        {{-- Tombol aksi di pojok kanan atas --}}
        <div class="d-flex justify-content-end mb-3">
            <button onclick="modalAction('{{ url('/kategori/import') }}')" class="btn btn-info btn-lg me-2">
                Import Kategori
            </button>
            <a href="{{ url('kategori/create') }}" class="btn btn-primary btn-lg me-2">
                Tambah Data
            </a>
            <button onclick="modalAction('{{ url('/kategori/create_ajax') }}')" class="btn btn-success btn-lg">
                Tambah Data (Ajax)
            </button>
        </div>

        {{-- Notifikasi --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        {{-- Tabel --}}
        <table class="table table-bordered table-striped table-hover table-sm" id="table_kategori">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

{{-- Modal --}}
<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog"
     data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true">
</div>
@endsection

@push('css')
<style>
    .btn-lg {
        padding: 0.5rem 1rem;
        font-size: 1rem;
    }
    .me-2 {
        margin-right: 0.5rem;
    }
</style>
@endpush

@push('js')
<script>
    function modalAction(url = '') {
        $('#myModal').load(url, function () {
            $('#myModal').modal('show');
        });
    }

    $(document).ready(function () {
        $('#table_kategori').DataTable({
            serverSide: true,
            ajax: {
                url: "{{ url('kategori/list') }}",
                type: "POST"
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "kategori_kode",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "kategori_nama",
                    orderable: true
                },
                {
                    data: "aksi",
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });
</script>
@endpush
