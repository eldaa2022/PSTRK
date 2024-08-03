<!-- Modal -->
<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TAMBAH ALUMNI</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form id="formData" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="control-label">Nama Alumni</label>
                        <input type="text" class="form-control" id="nama" name="nama">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Generasi</label>
                        <input type="text" class="form-control" id="generasi" name="generasi">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-generasi"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Pekerjaan</label>
                        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-pekerjaan"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Deskripsi</label>
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-deskripsi"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Kompetensi</label>
                        <input type="text" class="form-control" id="kompetensi" name="kompetensi">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-kompetensi"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Foto</label>
                        <input type="file" class="form-control" id="foto" name="foto">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-foto"></div>
                    </div>
                    <div class="form-group">
                        <label for="admin_id" class="control-label">Admin</label>
                        <select name="admin_id" id="admin_id" class="form-select" required>
                            @foreach($users as $user)
                             <option value="{{$user->id}}">{{$user->name}}</option>
                             @endforeach
                         </select>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-admin_id"></div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">TUTUP</button>
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
        data.append('generasi', $('#generasi').val());
        data.append('pekerjaan', $('#pekerjaan').val());
        data.append('deskripsi', $('#deskripsi').val());
        data.append('kompetensi', $('#kompetensi').val());
        data.append('foto', $('#foto')[0].files[0]);
        data.append('admin_id', $('#admin_id').val());

        $.ajax({
            url: '/api/alumnis', // Update the URL to the API endpoint
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

                let alumni = `
                    <tr>
                        <td style="text-align: center">${response.data.id}</td>
                        <td style="text-align: center">${response.data.nama}</td>
                        <td style="text-align: center">${response.data.generasi}</td>
                        <td style="text-align: center">${response.data.pekerjaan}</td>
                        <td style="text-align: center">${response.data.deskripsi}</td>
                        <td style="text-align: center">${response.data.kompetensi}</td>
                        <td style="text-align: center"><img src="/storage/foto/${response.data.foto}" width="100" height="100"></td>
                        <td class="text-center" style="padding-right:10px">
                            <a href="javascript:void(0)" data-id="${response.data.id}" class="button-edit btn btn-sm">edit</a>
                        </td>
                    </tr>
                `;
                $('#table-alumnis').prepend(alumni); // Append the new row to the end of the table
                // Update the row numbers
                $('#table-alumnis tr').each(function(index) {
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
                if (error.responseJSON.generasi) {
                    $('#alert-generasi').removeClass('d-none').html(error.responseJSON.generasi[0]);
                }
                if (error.responseJSON.pekerjaan) {
                    $('#alert-pekerjaan').removeClass('d-none').html(error.responseJSON.pekerjaan[0]);
                }
                if (error.responseJSON.deskripsi) {
                    $('#alert-deskripsi').removeClass('d-none').html(error.responseJSON.deskripsi[0]);
                }
                if (error.responseJSON.kompetensi) {
                    $('#alert-kompetensi').removeClass('d-none').html(error.responseJSON.kompetensi[0]);
                }
                if (error.responseJSON.foto) {
                    $('#alert-foto').removeClass('d-none').html(error.responseJSON.foto[0]);
                }
                if (error.responseJSON.admin_id) {
                    $('#alert-admin_id').removeClass('d-none').html(error.responseJSON.admin_id[0]);
                }
            }
        });
    });
</script>
