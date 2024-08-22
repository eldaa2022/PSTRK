<!-- Modal Edit -->
<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Kurikulum</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEditData" enctype="multipart/form-data" method="POST">
                    @method('PUT')
                    <input type="hidden" id="post_id" name="post_id">
                    @csrf
                    <div class="form-group">
                        <label for="nama-edit" class="control-label">Nama Alumni</label>
                        <input type="text" class="form-control" id="nama-edit" name="nama">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="generasi-edit" class="control-label">Generasi</label>
                        <input type="text" class="form-control" id="generasi-edit" name="generasi">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-generasi-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="pekerjaan-edit" class="control-label">Pekerjaan</label>
                        <input type="text" class="form-control" id="pekerjaan-edit" name="pekerjaan">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-pekerjaan-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi-edit" class="control-label">Deskripsi</label>
                        <input type="text" class="form-control" id="deskripsi-edit" name="deskripsi">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-deskripsi-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="kompetensi-edit" class="control-label">Kompetensi</label>
                        <input type="text" class="form-control" id="kompetensi-edit" name="kompetensi">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-kompetensi-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="foto-edit" class="control-label">Foto</label>
                        <input type="text" class="form-control mb-2" id="foto-lampiran" name="foto-lampiran" readonly>
                        <input type="file" class="form-control" id="foto-edit" name="foto">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-foto-edit"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">TUTUP</button>
                <button type="button" class="btn btn-primary" id="update">UPDATE</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function(){
        // Event handler for edit button
        $('body').on('click', '#btn-edit-post', function () {
            let post_id = $(this).data('id');
            console.log("Fetching data for post ID:", post_id);

            // Fetch data for the selected post
            $.ajax({
                url: '/api/alumnis/' + post_id,
                type: "GET",
                cache: false,
                success: function(response){
                    console.log("Response received:", response);
                    var alumni = response.data;

                    // Periksa apakah data alumni ada
                    if (alumni) {
                        // Fill form with the fetched data
                        $('#post_id').val(alumni.id);
                        $('#nama-edit').val(alumni.nama);
                        $('#generasi-edit').val(alumni.generasi);
                        $('#pekerjaan-edit').val(alumni.pekerjaan);
                        $('#deskripsi-edit').val(alumni.deskripsi);
                        $('#kompetensi-edit').val(alumni.kompetensi);
                        $('#foto-lampiran').val(alumni.foto);

                        // Show the modal
                        $('#modal-edit').modal('show');
                    } else {
                        console.log("Data not found for post ID:", post_id);
                    }
                },
                error: function(xhr, status, error) {
                    console.log("Error fetching data:", error);
                    console.log(xhr.responseText);
                }
            });
        });

        // Event handler for update button in the modal
        $('#update').click(function(e) {
            e.preventDefault();
            e.stopPropagation();

            // Reset error messages
            $('.alert-danger').addClass('d-none').html('');

            let isValid = true;

            // Validate form fields
            if ($('#nama-edit').val().trim() === '') {
                $('#alert-nama-edit').removeClass('d-none').html('Kolom Nama tidak boleh kosong.');
                isValid = false;
            }
            if ($('#generasi-edit').val().trim() === '') {
                $('#alert-generasi-edit').removeClass('d-none').html('Kolom Generasi tidak boleh kosong.');
                isValid = false;
            }
            if ($('#pekerjaan-edit').val().trim() === '') {
                $('#alert-pekerjaan-edit').removeClass('d-none').html('Kolom Pekerjaan tidak boleh kosong.');
                isValid = false;
            }
            if ($('#deskripsi-edit').val().trim() === '') {
                $('#alert-deskripsi-edit').removeClass('d-none').html('Kolom Deskripsi tidak boleh kosong.');
                isValid = false;
            }
            if ($('#kompetensi-edit').val().trim() === '') {
                $('#alert-kompetensi-edit').removeClass('d-none').html('Kolom Kompetensi tidak boleh kosong.');
                isValid = false;
            }
            if ($('#foto-edit').get(0).files.length === 0 && $('#foto-lampiran').val().trim() === '') {
                $('#alert-foto-edit').removeClass('d-none').html('Kolom Foto tidak boleh kosong.');
                isValid = false;
            }

            // Jika validasi gagal, hentikan pengiriman formulir
            if (!isValid) {
                return;
            }

            let post_id = $('#post_id').val();
            console.log("Updating post ID:", post_id);
            var formData = new FormData($('#formEditData')[0]);

            // Update data via AJAX
            $.ajax({
                url: '/api/alumnis/' + post_id,
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response){
                    Swal.fire({
                        icon: 'success',
                        title: `${response.message}`,
                        showConfirmButton: false,
                        timer: 3000
                    });

                    // Update the corresponding row in the table
                    let updatedRow = `
                    <tr id="index_${response.data.id}">
                        <td style="text-align: center">${response.data.id}</td>
                        <td style="text-align: center">${response.data.nama}</td>
                        <td style="text-align: center">${response.data.generasi}</td>
                        <td style="text-align: center">${response.data.pekerjaan}</td>
                        <td style="text-align: center">${response.data.deskripsi}</td>
                        <td style="text-align: center">${response.data.kompetensi}</td>
                        <td><img src="{{ url('/storage/foto/') }}/${response.data.foto}" width=100 height=100></td>
                        <td class="text-center" style="padding-right:10px">
                            <a href="javascript:void(0)" data-id="${response.data.id}" class="button-edit btn btn-sm" id="btn-edit-post">edit</a>
                        </td>
                    </tr>
                    `;

                    $(`#index_${response.data.id}`).replaceWith(updatedRow);

                    // Clear form and hide modal
                    $('#formEditData')[0].reset();
                    $('#modal-edit').modal('hide');
                },
                error: function(xhr, status, error) {
                    console.log("Error updating data:", error);
                    var err = JSON.parse(xhr.responseText);
                    console.log(err);
                }
            });
        });

        // Hide alert when user starts typing or selecting a file
        $('#nama-edit, #generasi-edit, #pekerjaan-edit, #deskripsi-edit, #kompetensi-edit').on('input', function() {
            $(this).next('.alert-danger').addClass('d-none').html('');
        });

        $('#foto-edit').on('change', function() {
            $('#alert-foto-edit').addClass('d-none').html('');
        });
    });
    </script>

