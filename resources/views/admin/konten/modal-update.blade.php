<!-- Modal -->
<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Konten</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formData" enctype="multipart/form-data" method="POST">
                    @method('PUT')
                    <input type="hidden" id="post_id" name="post_id">
                    @csrf
                    <div class="form-group">
                        <label for="judul-edit" class="control-label">Judul Konten</label>
                        <input type="text" class="form-control" id="judul-edit" name="judul">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-judul-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi-edit" class="control-label">Deskripsi</label>
                        <input type="text" class="form-control" id="deskripsi-edit" name="deskripsi">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-deskripsi-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="tags-edit" class="control-label">Tags</label>
                        <input type="text" class="form-control" id="tags-edit" name="tags">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-tags-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="tgl_publish-edit" class="control-label">Tanggal Publish</label>
                        <input type="date" class="form-control" id="tgl_publish-edit" name="tgl_publish">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-tgl_publish-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="status-edit" class="control-label">Status</label>
                        <input type="text" class="form-control" id="status-edit" name="status">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-status-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="jenis-edit" class="control-label">Jenis Konten</label>
                        <select name="jenis" id="jenis-edit" class="form-select" required>
                            @foreach($jenis_kontens as $jenis_konten)
                                <option value="{{ $jenis_konten->id }}">{{ $jenis_konten->jenis }}</option>
                            @endforeach
                        </select>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-jenis-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="lampiran-edit" class="control-label">Lampiran</label>
                        <input type="text" class="form-control mb-2" id="lampiran-edit" name="lampiran">
                        <input type="file" class="form-control" id="editFoto" name="foto">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-lampiran-edit"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">TUTUP</button>
                <button type="submit" class="btn btn-primary" id="update">UPDATE</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
    // Event handler for edit button
    $('body').on('click', '.button-edit', function () {
        let post_id = $(this).data('id');

        // Fetch data for the selected post
        $.ajax({
            url: '/api/kontens/' + post_id,
            type: "GET",
            cache: false,
            success: function(response){
                var konten = response.data;

                // Fill form with the fetched data
                $('#post_id').val(konten.id);
                $('#judul-edit').val(konten.judul);
                $('#deskripsi-edit').val(konten.deskripsi);
                $('#tags-edit').val(konten.tags);
                $('#tgl_publish-edit').val(konten.tgl_publish);
                $('#status-edit').val(konten.status);
                $('#jenis-edit').val(konten.jenis_id); // Pastikan value ini sesuai dengan id dari jenis konten
                $('#lampiran-edit').val(konten.lampiran);

                // Show the modal
                $('#modal-edit').modal('show');
            }
        });
    });

    // Event handler for update button in the modal
    $('#update').click(function(e) {
        e.preventDefault();
        e.stopPropagation();

        let post_id = $('#post_id').val();
        var formData = new FormData($('#formEditData')[0]);

        var lampiran = $('#editFoto')[0].files[0];
        if (lampiran) {
            formData.append('lampiran', lampiran);
        }

        // Append additional data
        formData.append('_token', $('input[name=_token]').val());
        formData.append('_method', 'PUT');
        formData.append('judul', $('#judul-edit').val());
        formData.append('deskripsi', $('#deskripsi-edit').val());
        formData.append('tags', $('#tags-edit').val());
        formData.append('tgl_publish', $('#tgl_publish-edit').val());
        formData.append('status', $('#status-edit').val());
        formData.append('jenis_id', $('#jenis-edit').val());

        // Update data via AJAX
        $.ajax({
            url: '/api/kontens/' + post_id,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response){
                Swal.fire({
                    icon: 'success',
                    title: 'Data berhasil diperbarui',
                    showConfirmButton: false,
                    timer: 1500
                });

                // Update the corresponding row in the table
                var lampiranHtml = '';
                var fileType = response.data.lampiran.split('.').pop().toLowerCase();
                if (fileType === 'mp4' || fileType === 'webm' || fileType === 'ogg') {
                    lampiranHtml = `<video width="100" height="100" controls><source src="/storage/video/${response.data.lampiran}" type="video/${fileType}"></video>`;
                } else {
                    lampiranHtml = `<img src="/storage/foto/${response.data.lampiran}" width="100" height="100">`;
                }

                let row = $(`.button-edit[data-id="${post_id}"]`).closest('tr');
                row.find('td:eq(1)').text(response.data.judul);
                row.find('td:eq(2)').text(response.data.deskripsi);
                row.find('td:eq(3)').text(response.data.tags);
                row.find('td:eq(4)').text(response.data.tgl_publish);
                row.find('td:eq(5)').html(lampiranHtml);

                $('#modal-edit').modal('hide');
                $('#formEditData')[0].reset();
            },
            error: function(error) {
                // Handle error
                if (error.responseJSON.judul) {
                    $('#alert-judul-edit').removeClass('d-none').html(error.responseJSON.judul[0]);
                }
                if (error.responseJSON.deskripsi) {
                    $('#alert-deskripsi-edit').removeClass('d-none').html(error.responseJSON.deskripsi[0]);
                }
                if (error.responseJSON.tags) {
                    $('#alert-tags-edit').removeClass('d-none').html(error.responseJSON.tags[0]);
                }
                if (error.responseJSON.tgl_publish) {
                    $('#alert-tgl_publish-edit').removeClass('d-none').html(error.responseJSON.tgl_publish[0]);
                }
                if (error.responseJSON.status) {
                    $('#alert-status-edit').removeClass('d-none').html(error.responseJSON.status[0]);
                }
                if (error.responseJSON.lampiran) {
                    $('#alert-lampiran-edit').removeClass('d-none').html(error.responseJSON.lampiran[0]);
                }
                if (error.responseJSON.jenis_id) {
                    $('#alert-jenis-edit').removeClass('d-none').html(error.responseJSON.jenis_id[0]);
                }
            }
        });
    });
});

</script>
