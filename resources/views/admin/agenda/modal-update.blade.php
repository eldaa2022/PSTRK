<!-- Modal -->
<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Kurikulum</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formData" enctype="multipart/form-data" method="POST">
                    @method('PUT')
                    <input type="hidden" id="post_id">
                    @csrf
                    <div class="form-group">
                        <label for="judul-edit" class="control-label">Judul Agenda</label>
                        <input type="text" class="form-control" id="judul-edit" name="judul-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-judul-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi-edit" class="control-label">Deskripsi</label>
                        <input type="text" class="form-control" id="deskripsi-edit" name="deskripsi-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-deskripsi-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="tgl_mulai-edit" class="control-label">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="tgl_mulai-edit" name="tgl_mulai-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-tgl_mulai-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="tgl_selesai-edit" class="control-label">Tanggal Selesai</label>
                        <input type="date" class="form-control" id="tgl_selesai-edit" name="tgl_selesai-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-tgl_selesai-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="tags-edit" class="control-label">Tags</label>
                        <input type="text" class="form-control" id="tags-edit" name="tags-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-tags-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="lokasi-edit" class="control-label">Lokasi</label>
                        <input type="text" class="form-control" id="lokasi-edit" name="lokasi-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-lokasi-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="penyelenggara-edit" class="control-label">Penyelenggara</label>
                        <input type="text" class="form-control" id="penyelenggara-edit" name="penyelenggara-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-penyelenggara-edit"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">TUTUP</button>
                <button type="submit" class="btn btn-primary" id="update" data-bs-dismiss="modal">UPDATE</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    //button create post event
    $('body').on('click', '#btn-edit-post', function () {
        let post_id = $(this).data('id');

        //fetch detail post with ajax
        $.ajax({
            url: '/api/agendas/' + post_id,
            type: "GET",
            cache: false,
            success: function(response){
                var agenda = response.data;
                //fill data to form
                $('#post_id').val(agenda.id);
                $('#judul-edit').val(agenda.judul);
                $('#deskripsi-edit').val(agenda.deskripsi);
                $('#tgl_mulai-edit').val(agenda.tgl_mulai);
                $('#tgl_selesai-edit').val(agenda.tgl_selesai);
                $('#tags-edit').val(agenda.tags);
                $('#lokasi-edit').val(agenda.lokasi);
                $('#penyelenggara-edit').val(agenda.penyelenggara);

                //open modal
                $('#modal-edit').modal('show');
            }
        });
    });

    //action update post
    $('#update').click(function(e) {
        e.preventDefault();
        e.stopPropagation();
        let post_id = $('#post_id').val();
        var form = new FormData();

        form.append('_token', $('input[name=_token]').val());
        form.append('_method', 'PUT');
        form.append('judul', $('#judul-edit').val());
        form.append('deskripsi', $('#deskripsi-edit').val());
        form.append('tgl_mulai', $('#tgl_mulai-edit').val());
        form.append('tgl_selesai', $('#tgl_selesai-edit').val());
        form.append('tags', $('#tags-edit').val());
        form.append('lokasi', $('#lokasi-edit').val());
        form.append('penyelenggara', $('#penyelenggara-edit').val());

        //ajax
        $.ajax({
            url: '/api/agendas/' + post_id,
            type: "POST",
            data: form,
            processData: false,
            contentType: false,
            success: function(response){
                //show success message
                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: `${response.message}`,
                    showConfirmButton: false,
                    timer: 3000
                });

                //update table row
                let agenda = `
                <tr id="index_${response.data.id}">
                    <td>${response.data.id}</td>
                    <td>${response.data.judul}</td>
                    <td>${response.data.deskripsi}</td>
                    <td>${response.data.tgl_mulai}</td>
                    <td>${response.data.tgl_selesai}</td>
                    <td>${response.data.tags}</td>
                    <td>${response.data.lokasi}</td>
                    <td>${response.data.penyelenggara}</td>
                    <td><a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="button-edit btn btn-sm">edit</a></td>
                </tr>
                `;

                //replace updated row
                $(`#index_${response.data.id}`).replaceWith(agenda);

                //clear form
                $('#formData')[0].reset();

                //close modal (if not closed automatically)
                $('#modal-edit').modal('hide');
            },
        });
    });
});

</script>
