@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-primary mt-1" href="{{ url('user/create') }}">Tambah Data</a>
            <button onclick="modalAction('{{ url('user/create_ajax') }}')" class="btn btn-sm btn-success mt-1">Tambah Data (Ajax)</button>
            <button class="btn btn-sm btn-info mt-1" onclick="$('#modalImportUser').modal('show')">Import User</button>
        </div>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Filter berdasarkan Level Pengguna -->
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Filter:</label>
                    <div class="col-3">
                        <select class="form-control" id="level_id" name="level_id">
                            <option value="">- Semua -</option>
                            @foreach ($level as $item)
                                <option value="{{ $item->level_id }}">{{ $item->level_nama }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Level Pengguna</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Data User -->
        <table class="table table-bordered table-striped table-hover table-sm" id="table_user">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Level Pengguna</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<!-- Modal Ajax Create -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false"></div>

<!-- Modal Import User -->
<div class="modal fade" id="modalImportUser" tabindex="-1" aria-labelledby="modalImportUserLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="form-import-user" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalImportUserLabel">Import Data User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label">Download Template</label><br>
                    <a href="{{ asset('template/user_template.xlsx') }}" class="btn btn-sm btn-success mb-3">Download</a>

                    <div class="mb-3">
                        <label for="file_user" class="form-label">Pilih File Excel</label>
                        <input type="file" name="file_user" id="file_user" class="form-control" accept=".xlsx" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('css')
<style>
    .card-tools .btn {
        font-size: 0.95rem;
        padding: 0.5rem 0.8rem;
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

    var dataUser;
    $(document).ready(function () {
        dataUser = $('#table_user').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('user/list') }}",
                type: "POST",
                data: function (d) {
                    d.level_id = $('#level_id').val();
                }
            },
            columns: [
                { data: "DT_RowIndex", className: "text-center", orderable: false, searchable: false },
                { data: "username" },
                { data: "nama" },
                { data: "level.level_nama", orderable: false, searchable: false },
                { data: "aksi", orderable: false, searchable: false }
            ]
        });

        $('#level_id').on('change', function () {
            dataUser.ajax.reload();
        });

        $('#form-import-user').on('submit', function (e) {
            e.preventDefault();
            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('user.import_ajax') }}",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (res) {
                    if (res.status) {
                        alert(res.message);
                        $('#modalImportUser').modal('hide');
                        dataUser.ajax.reload();
                    } else {
                        alert(res.message);
                    }
                },
                error: function (xhr) {
                    let message = 'Terjadi kesalahan saat mengimpor data.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        message += '\n' + xhr.responseJSON.message;
                    }
                    alert(message);
                }
            });
        });
    });
</script>
@endpush
