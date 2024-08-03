<!-- Modal -->
<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TAMBAH DATA AGENDA</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form id="formData" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="control-label">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Deskripsi</label>
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nip"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-email"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Tanggal Selesai</label>
                        <input type="date" class="form-control" id="tgl_selesai" name="tgl_selesai">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-kompetensi"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Tags</label>
                        <input type="text" class="form-control" id="tags" name="tags" placeholder="isi : Mahasiswa | Dosen | PSTRK">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-matkul"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Lokasi</label>
                        <input type="text" class="form-control" id="lokasi" name="lokasi">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-lampiran"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Penyelenggara</label>
                        <input type="text" class="form-control" id="penyelenggara" name="penyelenggara">
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
        data.append('judul', $('#judul').val());
        data.append('deskripsi', $('#deskripsi').val());
        data.append('tgl_mulai', $('#tgl_mulai').val());
        data.append('tgl_selesai', $('#tgl_selesai').val());
        data.append('tags', $('#tags').val());
        data.append('lokasi', $('#lokasi').val());
        data.append('penyelenggara', $('#penyelenggara').val());
        data.append('admin_id', '1');

        $.ajax({
            url: '/api/agendas', // Update the URL to the API endpoint
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
                let rowNumber = $('#table-agendas tr').length;

                let agenda = `
                    <tr id="index_${response.data.id}">
                        <td style="text-align: center">${rowNumber}</td>
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
                $('#table-agendas').prepend(agenda); // Append the new row to the end of the table
                // Update the row numbers
                $('#table-agendas tr').each(function(index) {
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
