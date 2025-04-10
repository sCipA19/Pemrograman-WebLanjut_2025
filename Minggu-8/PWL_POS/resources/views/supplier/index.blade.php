@extends('layouts.template')
  
@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Daftar Supplier</h3>
        <div class="card-tools">
            <button onclick="modalAction('{{ url('/supplier/import') }}')" class="btn btn-info">Import Supplier</button>
            <a href="{{ url('/supplier/create') }}" class="btn btn-primary">Tambah Supplier</a>
            <button onclick="modalAction('{{ url('/supplier/create_ajax') }}')" class="btn btn-success">Tambah Supplier (Ajax)</button>
        </div>
    </div>

    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table table-bordered table-striped table-hover table-sm" id="table_supplier">
            <thead>
                <tr>
                    <th>ID Supplier</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" 
    data-backdrop="static" data-keyboard="false" aria-hidden="true"></div>
@endsection
     
@push('js')
<script>
    function modalAction(url = '') {
        $('#myModal').load(url, function () {
            $('#myModal').modal('show');
        });
    }

    var dataSupplier;
    $(document).ready(function () {
        dataSupplier = $('#table_supplier').DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                url: "{{ url('supplier/list') }}",
                type: "POST",
                dataType: "json",
                data: function (d) {
                    d.supplier_id = $('#supplier_id').val();
                }
            },
            columns: [
                { data: "DT_RowIndex", className: "text-center", orderable: false, searchable: false },
                { data: "supplier_kode" },
                { data: "supplier_nama" },
                { data: "supplier_alamat" },
                { data: "aksi", orderable: false, searchable: false }
            ]
        });
    });

    // Import Supplier AJAX
    $(document).on('submit', '#form-import', function (e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: "{{ url('/supplier/import_ajax') }}",
            type: "POST",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function (res) {
                if (res.status) {
                    Swal.fire('Sukses', res.message, 'success');
                    $('#myModal').modal('hide');
                    dataSupplier.ajax.reload();
                } else {
                    Swal.fire('Gagal', res.message, 'error');
                }
            },
            error: function (xhr) {
                Swal.fire('Error', 'Terjadi kesalahan saat mengimport', 'error');
            }
        });
    });
</script>
@endpush
