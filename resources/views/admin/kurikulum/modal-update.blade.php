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
                        <label for="kode_mk-edit" class="control-label">Kode Mata Kuliah</label>
                        <input type="text" class="form-control" id="kode_mk-edit" name="kode_mk-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-kode_mk-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="nama_mk-edit" class="control-label">Nama Mata Kuliah</label>
                        <input type="text" class="form-control" id="nama_mk-edit" name="nama_mk-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama_mk-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="smstr-edit" class="control-label">Semester</label>
                        <input type="number" class="form-control" id="smstr-edit" name="smstr-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-smstr-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi-edit" class="control-label">Deskripsi</label>
                        <input type="text" class="form-control" id="deskripsi-edit" name="deskripsi-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-deskripsi-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="sks_teori-edit" class="control-label">SKS Teori</label>
                        <input type="number" class="form-control" id="sks_teori-edit" name="sks_teori-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-sks_teori-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="jam_teori-edit" class="control-label">Jam Teori</label>
                        <input type="number" class="form-control" id="jam_teori-edit" name="jam_teori-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-jam_teori-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="sks_prak-edit" class="control-label">SKS Praktikum</label>
                        <input type="number" class="form-control" id="sks_prak-edit" name="sks_prak-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-sks_prak-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="jam_prak-edit" class="control-label">Jam Praktikum</label>
                        <input type="number" class="form-control" id="jam_prak-edit" name="jam_prak-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-jam_prak-edit"></div>
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
            url: '/api/kurikulums/' + post_id,
            type: "GET",
            cache: false,
            success: function(response){
                var kurikulum = response.data;
                //fill data to form
                $('#post_id').val(kurikulum.id);
                $('#kode_mk-edit').val(kurikulum.kode_mk);
                $('#nama_mk-edit').val(kurikulum.nama_mk);
                $('#smstr-edit').val(kurikulum.smstr);
                $('#deskripsi-edit').val(kurikulum.deskripsi);
                $('#sks_teori-edit').val(kurikulum.sks_teori);
                $('#jam_teori-edit').val(kurikulum.jam_teori);
                $('#sks_prak-edit').val(kurikulum.sks_prak);
                $('#jam_prak-edit').val(kurikulum.jam_prak);

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
        form.append('kode_mk', $('#kode_mk-edit').val());
        form.append('nama_mk', $('#nama_mk-edit').val());
        form.append('smstr', $('#smstr-edit').val());
        form.append('deskripsi', $('#deskripsi-edit').val());
        form.append('sks_teori', $('#sks_teori-edit').val());
        form.append('jam_teori', $('#jam_teori-edit').val());
        form.append('sks_prak', $('#sks_prak-edit').val());
        form.append('jam_prak', $('#jam_prak-edit').val());

        //ajax
        $.ajax({
            url: '/api/kurikulums/' + post_id,
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
                let kurikulum = `
                <tr id="index_${response.data.id}">
                    <td>${response.data.id}</td>
                    <td>${response.data.kode_mk}</td>
                    <td>${response.data.nama_mk}</td>
                    <td>${response.data.smstr}</td>
                    <td>${response.data.deskripsi}</td>
                    <td>${response.data.sks_teori}</td>
                    <td>${response.data.jam_teori}</td>
                    <td>${response.data.sks_prak}</td>
                    <td>${response.data.jam_prak}</td>
                    <td><a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="button-edit btn btn-sm">edit</a></td>
                </tr>
                `;

                //replace updated row
                $(`#index_${response.data.id}`).replaceWith(kurikulum);

                //clear form
                $('#formData')[0].reset();

                //close modal (if not closed automatically)
                $('#modal-edit').modal('hide');
            },
        });
    });
});

</script>
