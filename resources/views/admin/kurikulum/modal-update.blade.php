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
                <button type="submit" class="btn btn-primary" id="update">UPDATE</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        // Event handler for edit button
        $('body').on('click', '#btn-edit-post', function () {
            let post_id = $(this).data('id');

            // Fetch data for the selected post
            $.ajax({
                url: '/api/kurikulums/' + post_id,
                type: "GET",
                cache: false,
                success: function(response){
                var kurikulum = response.data;

                    // Fill form with the fetched data
                $('#post_id').val(kurikulum.id);
                $('#kode_mk-edit').val(kurikulum.kode_mk);
                $('#nama_mk-edit').val(kurikulum.nama_mk);
                $('#smstr-edit').val(kurikulum.smstr);
                $('#sks_teori-edit').val(kurikulum.sks_teori);
                $('#jam_teori-edit').val(kurikulum.jam_teori);
                $('#sks_prak-edit').val(kurikulum.sks_prak);
                $('#jam_prak-edit').val(kurikulum.jam_prak);

                    // Show the modal
                    $('#modal-edit').modal('show');
                }
            });
        });

        // Action update post
        $('#update').click(function(e) {
            e.preventDefault();
            e.stopPropagation();

            // Clear previous alerts
            $('.alert').addClass('d-none').html('');

            var isValid = true;

            // Validate each input
            if ($('#kode_mk-edit').val() === '') {
                $('#alert-kode_mk-edit').removeClass('d-none').html('Kode mata kuliah tidak boleh kosong.');
                isValid = false;
            }
            if ($('#nama_mk-edit').val() === '') {
                $('#alert-nama_mk-edit').removeClass('d-none').html('Nama mata kuliah tidak boleh kosong.');
                isValid = false;
            }
            if ($('#smstr-edit').val() === '') {
                $('#alert-smstr-edit').removeClass('d-none').html('Semester tidak boleh kosong.');
                isValid = false;
            }
            if ($('#sks_teori-edit').val() === '') {
                $('#alert-sks_teori-edit').removeClass('d-none').html('SKS teori tidak boleh kosong.');
                isValid = false;
            }
            if ($('#jam_teori-edit').val() === '') {
                $('#alert-jam_teori-edit').removeClass('d-none').html('Jam teori tidak boleh kosong.');
                isValid = false;
            }
            if ($('#sks_prak-edit').val() === '') {
                $('#alert-sks_prak-edit').removeClass('d-none').html('SKS praktikum tidak boleh kosong.');
                isValid = false;
            }
            if ($('#jam_prak-edit').val() === '') {
                $('#alert-jam_prak-edit').removeClass('d-none').html('Jam praktikum tidak boleh kosong.');
                isValid = false;
            }

            if (!isValid) {
                return; // Stop execution if validation fails
            }

            let post_id = $('#post_id').val();
            var form = new FormData();

            form.append('_token', $('input[name=_token]').val());
            form.append('_method', 'PUT');
            form.append('kode_mk', $('#kode_mk-edit').val());
            form.append('nama_mk', $('#nama_mk-edit').val());
            form.append('smstr', $('#smstr-edit').val());
            form.append('sks_teori', $('#sks_teori-edit').val());
            form.append('jam_teori', $('#jam_teori-edit').val());
            form.append('sks_prak', $('#sks_prak-edit').val());
            form.append('jam_prak', $('#jam_prak-edit').val());



            // Ajax
            $.ajax({
                url: '/api/kurikulums/' + post_id,
                type: "POST",
                data: form,
                processData: false,
                contentType: false,
                success: function(response){
                    // Show success message
                    Swal.fire({
                        type: 'success',
                        icon: 'success',
                        title: `${response.message}`,
                        showConfirmButton: false,
                        timer: 3000
                    });

                    // Update the corresponding row in the table
                    let updatedRow = `
                    <tr id="index_${response.data.id}">
                        <td>${response.data.id}</td>
                        <td>${response.data.kode_mk}</td>
                        <td>${response.data.nama_mk}</td>
                        <td>${response.data.smstr}</td>
                        <td>${response.data.sks_teori}</td>
                        <td>${response.data.jam_teori}</td>
                        <td>${response.data.sks_prak}</td>
                        <td>${response.data.jam_prak}</td>
                        <td><a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="button-edit btn btn-sm">edit</a></td>
                    </tr>
                    `;

                    // Replace updated row
                    $(`#index_${response.data.id}`).replaceWith(updatedRow);

                    // Clear form
                    $('#formData')[0].reset();

                    // Close modal (if not closed automatically)
                    $('#modal-edit').modal('hide');
                },
                error: function(error) {
                    // Handle server-side validation errors
                    if (error.responseJSON.errors) {
                        // Validate each field and display error messages
                        if (error.responseJSON.errors.kode_mk) {
                            $('#alert-kode_mk-edit').removeClass('d-none').html(error.responseJSON.errors.kode_mk[0]);
                        }
                        if (error.responseJSON.errors.nama_mk) {
                            $('#alert-nama_mk-edit').removeClass('d-none').html(error.responseJSON.errors.nama_mk[0]);
                        }
                        if (error.responseJSON.errors.smstr) {
                            $('#alert-smstr-edit').removeClass('d-none').html(error.responseJSON.errors.smstr[0]);
                        }
                        if (error.responseJSON.errors.sks_teori) {
                            $('#alert-sks_teori-edit').removeClass('d-none').html(error.responseJSON.errors.sks_teori[0]);
                        }
                        if (error.responseJSON.errors.jam_teori) {
                            $('#alert-jam_teori-edit').removeClass('d-none').html(error.responseJSON.errors.jam_teori[0]);
                        }
                        if (error.responseJSON.errors.sks_prak) {
                            $('#alert-sks_prak-edit').removeClass('d-none').html(error.responseJSON.errors.sks_prak[0]);
                        }
                        if (error.responseJSON.errors.jam_prak) {
                            $('#alert-jam_prak-edit').removeClass('d-none').html(error.responseJSON.errors.jam_prak[0]);
                        }
                    }
                }
            });
        });

        // Remove alert messages when typing
        $('#kode_mk-edit, #nama_mk-edit, #smstr-edit, #sks_teori-edit, #jam_teori-edit, #sks_prak-edit, #jam_prak-edit').on('input change', function() {
            $(this).siblings('.alert').addClass('d-none').html('');
        });
    });
</script>
