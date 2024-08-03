<!-- Modal -->
<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TAMBAH DATA KONTAK</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formData" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="control-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-email"></div>
                    </div>
                    <div class="form-group">
                        <label for="alamat" class="control-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-alamat"></div>
                    </div>
                    <div class="form-group">
                        <label for="no_tlp" class="control-label">No Telpon</label>
                        <input type="text" class="form-control" id="no_tlp" name="no_tlp">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-no_tlp"></div>
                    </div>
                    <div class="form-group">
                        <label for="instagram" class="control-label">Instagram</label>
                        <input type="text" class="form-control" id="instagram" name="instagram">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-instagram"></div>
                    </div>
                    <div class="form-group">
                        <label for="youtube" class="control-label">Youtube</label>
                        <input type="text" class="form-control" id="youtube" name="youtube">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-youtube"></div>
                    </div>
                    <div class="form-group">
                        <label for="whatsapp" class="control-label">Whatsapp</label>
                        <input type="text" class="form-control" id="whatsapp" name="whatsapp">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-whatsapp"></div>
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

        var data = new FormData(this);

        $.ajax({
            url: '/api/kontaks', // Update the URL to the API endpoint
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
                let rowNumber = $('#table-kontaks tr').length;

                let kontak = `
                    <tr>
                        <td>${rowNumber}</td>
                        <td>${response.data.email}</td>
                        <td>${response.data.alamat}</td>
                        <td>${response.data.no_tlp}</td>
                        <td>${response.data.instagram}</td>
                        <td>${response.data.youtube}</td>
                        <td>${response.data.whatsapp}</td>
                        <td><a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="button-edit btn btn-sm">edit</a></td>
                    </tr>
                `;

                $('#table-kontaks').prepend(kontak); // Append the new row to the end of the table

                // Update the row numbers
                $('#table-kontaks tr').each(function(index) {
                    $(this).find('td:first').text(index + 1);
                });

                $('#modal-create').modal('hide');
                $('#formData')[0].reset();
            },
            error: function(error) {
                // Handle error
                const errorFields = ['email', 'alamat', 'no_tlp', 'instagram', 'youtube', 'whatsapp'];
                errorFields.forEach(field => {
                    if (error.responseJSON[field]) {
                        $(`#alert-${field}`).removeClass('d-none').html(error.responseJSON[field][0]);
                    } else {
                        $(`#alert-${field}`).addClass('d-none');
                    }
                });
            }
        });
    });
</script>
