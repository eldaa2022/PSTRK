<!-- Modal -->
<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Kontak</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formData" enctype="multipart/form-data" method="POST">
                    @method('PUT')
                    <input type="hidden" id="post_id">
                    @csrf
                    <div class="form-group">
                        <label for="email-edit" class="control-label">Email</label>
                        <input type="email" class="form-control" id="email-edit" name="email-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-email-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="alamat-edit" class="control-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat-edit" name="alamat-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-alamat-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="no_tlp-edit" class="control-label">No Telpon</label>
                        <input type="text" class="form-control" id="no_tlp-edit" name="no_tlp-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-no_tlp-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="instagram-edit" class="control-label">Instagram</label>
                        <input type="text" class="form-control" id="instagram-edit" name="instagram-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-instagram-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="youtube-edit" class="control-label">Youtube</label>
                        <input type="text" class="form-control" id="youtube-edit" name="youtube-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-youtube-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="whatsapp-edit" class="control-label">Whatsapp</label>
                        <input type="text" class="form-control" id="whatsapp-edit" name="whatsapp-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-whatsapp-edit"></div>
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
    //button create post event
    $('body').on('click', '#btn-edit-post', function () {
        let post_id = $(this).data('id');

        //fetch detail post with ajax
        $.ajax({
            url: '/api/kontaks/' + post_id,
            type: "GET",
            cache: false,
            success: function(response){
                var kontak = response.data;
                //fill data to form
                $('#post_id').val(kontak.id);
                $('#email-edit').val(kontak.email);
                $('#alamat-edit').val(kontak.alamat);
                $('#no_tlp-edit').val(kontak.no_tlp);
                $('#instagram-edit').val(kontak.instagram);
                $('#youtube-edit').val(kontak.youtube);
                $('#whatsapp-edit').val(kontak.whatsapp);

                //open modal
                $('#modal-edit').modal('show');
            }
        });
    });

    //action update post
    $('#update').click(function(e) {
        e.preventDefault();
        let post_id = $('#post_id').val();
        var form = new FormData();

        form.append('_token', $('input[name=_token]').val());
        form.append('_method', 'PUT');
        form.append('email', $('#email-edit').val());
        form.append('alamat', $('#alamat-edit').val());
        form.append('no_tlp', $('#no_tlp-edit').val());
        form.append('instagram', $('#instagram-edit').val());
        form.append('youtube', $('#youtube-edit').val());
        form.append('whatsapp', $('#whatsapp-edit').val());

        //ajax
        $.ajax({
            url: '/api/kontaks/' + post_id,
            type: "POST",
            data: form,
            processData: false,
            contentType: false,
            success: function(response){
                Swal.fire({
                    icon: 'success',
                    title: `${response.message}`,
                    showConfirmButton: false,
                    timer: 3000
                });

                //update table row
                let kontak = `
                <tr id="index_${response.data.id}">
                    <td>${response.data.id}</td>
                    <td>${response.data.email}</td>
                    <td>${response.data.alamat}</td>
                    <td>${response.data.no_tlp}</td>
                    <td>${response.data.instagram}</td>
                    <td>${response.data.youtube}</td>
                    <td>${response.data.whatsapp}</td>
                    <td><a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="button-edit btn btn-sm">edit</a></td>
                </tr>
                `;

                //replace updated row
                $(`#index_${response.data.id}`).replaceWith(kontak);

                //clear form
                $('#formData')[0].reset();

                //close modal
                $('#modal-edit').modal('hide');
            },
            error: function(xhr, status, error){
                console.log(xhr.responseText); // Log the error response
            }
        });
    });
});
</script>
