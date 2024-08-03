<!-- Modal -->
<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TAMBAH DOSEN</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('dosens.store', $dosen->id) }}" id="formData" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="control-label">Nama Dosen</label>
                        <input type="text" class="form-control" id="nama" name="nama">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Nip</label>
                        <input type="text" class="form-control" id="nip" name="nip">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nip"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-email"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Kompetensi</label>
                        <input type="text" class="form-control" id="kompetensi" name="kompetensi">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-kompetensi"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Mata Kuliah</label>
                        <input type="text" class="form-control" id="matkul" name="matkul">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-matkul"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Status</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="" selected disabled>Pilih Status</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-status"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Lampiran</label>
                        <input type="text" class="form-control" id="lampiran" name="lampiran">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-lampiran"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Foto</label>
                        <input type="file" class="form-control" id="foto" name="foto">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-foto"></div>
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
        data.append('nama', $('#nama').val());
        data.append('nip', $('#nip').val());
        data.append('email', $('#email').val());
        data.append('kompetensi', $('#kompetensi').val());
        data.append('matkul', $('#matkul').val());
        data.append('status', $('#status').val());
        data.append('lampiran', $('#lampiran').val());
        data.append('foto', $('#foto')[0].files[0]);
        data.append('admin_id', '1'); // Assume '1' is the admin_id. Change as necessary.

        $.ajax({
            url: '{{url('api/dosens')}}', // Update the URL to the API endpoint
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
                let rowNumber = $('#table-dosens tr').length;

                let dosen = `
                    <tr>
                        <td>${rowNumber}</td>
                        <td>${response.data.nama}</td>
                        <td>${response.data.nip}</td>
                        <td>${response.data.email}</td>
                        <td>${response.data.kompetensi}</td>
                        <td><a href="javascript:void(0)" id="btn-detail" data-id="${response.data.id}" class="button-detail btn btn-sm">detail</a></td>
                    </tr>
                `;
                $('#table-dosens').prepend(dosen); // Append the new row to the end of the table
                // Update the row numbers
                $('#table-dosens tr').each(function(index) {
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
