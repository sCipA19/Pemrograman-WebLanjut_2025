<form action="{{ url('/user/import_ajax') }}" method="POST" id="form-import-user" enctype="multipart/form-data">
    @csrf
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Import Data Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Download Template</label><br>
                    <a href="{{ asset('template/template_user.xlsx') }}" class="btn btn-info btn-sm" download>
                        <i class="fa fa-file-excel"></i> Download
                    </a>
                </div>
                <div class="form-group">
                    <label>Pilih File Excel</label>
                    <input type="file" name="file_user" id="file_user" class="form-control" required accept=".xlsx">
                    <small id="error-file_user" class="text-danger"></small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </div>
    </div>
</form>

@push('js')
<script>
    // Validasi dan Submit AJAX
    $("#form-import-user").validate({
        rules: {
            file_user: {
                required: true,
                extension: "xlsx"
            }
        },
        messages: {
            file_user: {
                required: "Silakan pilih file Excel.",
                extension: "File harus berformat .xlsx"
            }
        },
        errorPlacement: function(error, element) {
            $('#error-' + element.attr('name')).text(error.text());
        },
        success: function(label, element) {
            $('#error-' + $(element).attr('name')).text('');
        },
        submitHandler: function(form) {
            let formData = new FormData(form);

            $.ajax({
                url: form.action,
                method: form.method,
                data: formData,
                processData: false,
                contentType: false,
                success: function (res) {
                    if (res.status) {
                        $('#myModal').modal('hide');
                        Swal.fire('Berhasil', res.message, 'success');
                        dataUser.ajax.reload();
                    } else {
                        // Tampilkan error field
                        $.each(res.msgField ?? {}, function (field, msg) {
                            $('#error-' + field).text(msg[0]);
                        });
                        Swal.fire('Gagal', res.message, 'error');
                    }
                },
                error: function (xhr) {
                    Swal.fire('Error', 'Terjadi kesalahan pada server.', 'error');
                }
            });

            return false;
        }
    });
</script>
@endpush
