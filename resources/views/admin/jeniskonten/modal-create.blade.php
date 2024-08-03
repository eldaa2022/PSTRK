<!-- Modal -->
<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TAMBAH JENIS KONTEN</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form id="formData" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="control-label">Nama Jenis</label>
                        <input type="text" class="form-control" id="jenis" name="jenis">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama"></div>
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
        data.append('jenis', $('#jenis').val());

        $.ajax({
            url: '/api/jenis_kontens', // Update the URL to the API endpoint
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
                let rowNumber = $('#table-jenis_kontens tr').length;

                let jenis_konten = `
                    <tr>
                        <td style="text-align: center">${rowNumber}</td>
                        <td style="text-align: center">${response.data.jenis}</td>

                        <td style="text-align: center"><a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="button-edit btn btn-sm">edit</a></td>
                    </tr>
                `;
                $('#table-jenis_kontens').prepend(jenis_konten); // Append the new row to the end of the table
                                // Update the row numbers
                $('#table-jenis_kontens tr').each(function(index) {
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
