<!-- Modal -->
<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Agenda</h5>
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
                url: '/api/agendas/' + post_id,
                type: "GET",
                cache: false,
                success: function(response){
                    var agenda = response.data;

                    // Fill form with the fetched data
                    $('#post_id').val(agenda.id);
                    $('#judul-edit').val(agenda.judul);
                    $('#deskripsi-edit').val(agenda.deskripsi);
                    $('#tgl_mulai-edit').val(agenda.tgl_mulai);
                    $('#tgl_selesai-edit').val(agenda.tgl_selesai);
                    $('#tags-edit').val(agenda.tags);
                    $('#lokasi-edit').val(agenda.lokasi);
                    $('#penyelenggara-edit').val(agenda.penyelenggara);

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
            if ($('#judul-edit').val().trim() === '') {
                $('#alert-judul-edit').removeClass('d-none').html('Judul tidak boleh kosong.');
                isValid = false;
            }
            if ($('#deskripsi-edit').val().trim() === '') {
                $('#alert-deskripsi-edit').removeClass('d-none').html('Deskripsi tidak boleh kosong.');
                isValid = false;
            }
            if ($('#tgl_mulai-edit').val() === '') {
                $('#alert-tgl_mulai-edit').removeClass('d-none').html('Tanggal mulai tidak boleh kosong.');
                isValid = false;
            }
            if ($('#tgl_selesai-edit').val() === '') {
                $('#alert-tgl_selesai-edit').removeClass('d-none').html('Tanggal selesai tidak boleh kosong.');
                isValid = false;
            }
            if ($('#tags-edit').val().trim() === '') {
                $('#alert-tags-edit').removeClass('d-none').html('Tags tidak boleh kosong.');
                isValid = false;
            }
            if ($('#lokasi-edit').val().trim() === '') {
                $('#alert-lokasi-edit').removeClass('d-none').html('Lokasi tidak boleh kosong.');
                isValid = false;
            }
            if ($('#penyelenggara-edit').val().trim() === '') {
                $('#alert-penyelenggara-edit').removeClass('d-none').html('Penyelenggara tidak boleh kosong.');
                isValid = false;
            }

            if (!isValid) {
                return; // Stop execution if validation fails
            }

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

            // Ajax
            $.ajax({
                url: '/api/agendas/' + post_id,
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
                        if (error.responseJSON.errors.judul) {
                            $('#alert-judul-edit').removeClass('d-none').html(error.responseJSON.errors.judul[0]);
                        }
                        if (error.responseJSON.errors.deskripsi) {
                            $('#alert-deskripsi-edit').removeClass('d-none').html(error.responseJSON.errors.deskripsi[0]);
                        }
                        if (error.responseJSON.errors.tgl_mulai) {
                            $('#alert-tgl_mulai-edit').removeClass('d-none').html(error.responseJSON.errors.tgl_mulai[0]);
                        }
                        if (error.responseJSON.errors.tgl_selesai) {
                            $('#alert-tgl_selesai-edit').removeClass('d-none').html(error.responseJSON.errors.tgl_selesai[0]);
                        }
                        if (error.responseJSON.errors.tags) {
                            $('#alert-tags-edit').removeClass('d-none').html(error.responseJSON.errors.tags[0]);
                        }
                        if (error.responseJSON.errors.lokasi) {
                            $('#alert-lokasi-edit').removeClass('d-none').html(error.responseJSON.errors.lokasi[0]);
                        }
                        if (error.responseJSON.errors.penyelenggara) {
                            $('#alert-penyelenggara-edit').removeClass('d-none').html(error.responseJSON.errors.penyelenggara[0]);
                        }
                    }
                }
            });
        });

        // Remove alert messages when typing
        $('#judul-edit, #deskripsi-edit, #tgl_mulai-edit, #tgl_selesai-edit, #tags-edit, #lokasi-edit, #penyelenggara-edit').on('input change', function() {
            $(this).siblings('.alert').addClass('d-none').html('');
        });
    });
</script>
