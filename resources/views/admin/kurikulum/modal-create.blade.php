<!-- Modal -->
<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TAMBAH DATA KURIKULUM</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form id="formData" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="control-label">Kode Mata Kuliah</label>
                        <input type="text" class="form-control" id="kode_mk" name="kode_mk">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Nama Mata Kuliah</label>
                        <input type="text" class="form-control" id="nama_mk" name="nama_mk">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nip"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Semester</label>
                        <input type="text" class="form-control" id="smstr" name="smstr">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-email"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">SKS Teori</label>
                        <input type="text" class="form-control" id="sks_teori" name="sks_teori">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-kompetensi"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Jam Teori</label>
                        <input type="text" class="form-control" id="jam_teori" name="jam_teori">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-matkul"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">SKS Praktikum</label>
                        <input type="text" class="form-control" id="sks_prak" name="sks_prak">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-lampiran"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Jam Praktikum</label>
                        <input type="text" class="form-control" id="jam_prak" name="jam_prak">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-lampiran"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Deskripsi</label>
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-lampiran"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                        <button type="submit" class="btn btn-primary" id="store">SIMPAN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    // Show modal on button click
    $('#btn-create-post').on('click', function() {
        $('#modal-create').modal('show');
    });

    // Handle form submission
    $('#formData').on('submit', function(e) {
        e.preventDefault();
        e.stopPropagation();

        var data = new FormData(this);
        data.append('kode_mk', $('#kode_mk').val());
        data.append('nama_mk', $('#nama_mk').val());
        data.append('smstr', $('#smstr').val());
        data.append('sks_teori', $('#sks_teori').val());
        data.append('jam_teori', $('#jam_teori').val());
        data.append('sks_prak', $('#sks_prak').val());
        data.append('jam_prak', $('#jam_prak').val());
        data.append('deskripsi', $('#deskripsi').val());

        $.ajax({
            url: '/api/kurikulums', // Update the URL to the API endpoint
            type: 'POST',
            data: data,
            cache: false,
            processData: false,
            contentType: false,
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Data berhasil disimpan',
                    showConfirmButton: false,
                    timer: 1500
                });

                // Calculate the new row number
                let rowNumber = $('#table-kurikulums tr').length;

                let kurikulum = `
                    <tr>
                        <td>${rowNumber}</td>
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
                $('#table-kurikulums').prepend(kurikulum); // Append the new row to the end of the table
                $('#table-kurikulums tr').each(function(index) {
                    $(this).find('td:first').text(index + 1);
                });
                $('#modal-create').modal('hide');
                $('#formData')[0].reset();
            },
            error: function(error) {
                // Handle error
                if (error.responseJSON.nama) {
                    $('#alert-nama').removeClass('d-none').html(error.responseJSON.nama[0]);
                }
                if (error.responseJSON.nip) {
                    $('#alert-nip').removeClass('d-none').html(error.responseJSON.nip[0]);
                }
                if (error.responseJSON.email) {
                    $('#alert-email').removeClass('d-none').html(error.responseJSON.email[0]);
                }
                if (error.responseJSON.kompetensi) {
                    $('#alert-kompetensi').removeClass('d-none').html(error.responseJSON.kompetensi[0]);
                }
                if (error.responseJSON.matkul) {
                    $('#alert-matkul').removeClass('d-none').html(error.responseJSON.matkul[0]);
                }
                if (error.responseJSON.status) {
                    $('#alert-status').removeClass('d-none').html(error.responseJSON.status[0]);
                }
                if (error.responseJSON.lampiran) {
                    $('#alert-lampiran').removeClass('d-none').html(error.responseJSON.lampiran[0]);
                }
                if (error.responseJSON.foto) {
                    $('#alert-foto').removeClass('d-none').html(error.responseJSON.foto[0]);
                }
            }
        });
    });
</script>
