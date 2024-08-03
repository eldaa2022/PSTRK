<!-- Modal -->
<div class="modal fade" id="dosenDetailModal" tabindex="-1" role="dialog" aria-labelledby="dosenDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dosenDetailModalLabel">Kelola Dosen</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="dosenDetailForm" enctype="multipart/form-data" method="POST" action="{{ route('dosens.update', $dosen->id) }}">
                    @method('PUT')
                    <input type="hidden" id="post_id">
                    @csrf
                <div class="row">
                    <div class="col-md-3">
                        <img id="dosenFoto" src="" class="img-fluid rounded" alt="Foto Dosen">
                        <div class="form-group">
                            <label for="editFoto" class="mb-1 mt-2">Foto</label>
                            <input type="text" class="form-control mb-2" id="Fotodosen" readonly>
                            <input type="file" class="form-control d-none" id="editFoto" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                            <div class="form-group">
                                <label for="editNama" class="mb-1">Nama</label>
                                <input type="text" class="form-control" id="dosenNama" readonly>
                            </div>
                            <div class="form-group">
                                <label for="editNip" class="mb-1">NIP</label>
                                <input type="text" class="form-control" id="dosenNip" readonly>
                            </div>
                            <div class="form-group">
                                <label for="editEmail" class="mb-1">Email</label>
                                <input type="email" class="form-control" id="dosenEmail" readonly>
                            </div>
                            <div class="form-group">
                                <label for="editLampiran" class="mb-1">Link PDDIKTI</label>
                                <input type="text" class="form-control" id="dosenLampiran" readonly>
                            </div>
                            {{-- <div class="form-group">
                                <input type="hidden" class="form-control" id="dosenAdmin_id" readonly>
                            </div> --}}
                    </div>
                    <div class="col-md-4">
                            <div class="form-group">
                                <label for="editKompetensi" class="mb-1">Kompetensi</label>
                                <textarea type="text" class="form-control" id="dosenKompetensi" rows="3" readonly></textarea>
                            </div>
                            <div class="form-group">
                                <label for="editMatkul" class="mb-1">Mata Kuliah</label>
                                <textarea type="text" class="form-control" id="dosenMatkul" rows="3" readonly></textarea>
                            </div>
                            {{-- <div class="form-group">
                                <label for="name" class="control-label">Status</label>
                                <input type="text" class="form-control" id="dosenStatus" readonly>
                            </div> --}}

                        <button type="button" class="btn btn-success mt-4 float-end" id="editButton">Edit</button>
                        <button type="button" class="btn btn-primary mt-4 float-end me-2 d-none" id="updateButton">Save</button>
                    </div>
                </div>
            </form>
            </div>

        </div>
    </div>
</div>

<script>
$(document).on('click', '.button-detail', function() {
    var dosenId = $(this).data('id');

    // Fetch dosen data from server
    $.ajax({
        url: '/api/dosens/' + dosenId,
        type: 'GET',
        success: function(response) {
            var dosen = response.data;
            $('#post_id').val(dosen.id);  // Set the post_id with dosen.id
            $('#dosenNama').val(dosen.nama);
            $('#dosenNip').val(dosen.nip);
            $('#dosenEmail').val(dosen.email);
            $('#dosenKompetensi').val(dosen.kompetensi);
            $('#dosenMatkul').val(dosen.matkul);
            $('#dosenLampiran').val(dosen.lampiran);
            $('#Fotodosen').val(dosen.foto);
            // $('#dosenAdmin_id').val(dosen.admin_id);
            $('#dosenFoto').attr('src', '/storage/foto/' + dosen.foto);

            $('#dosenDetailModal').modal('show');
        }
    });
});

$('#editButton').click(function() {
    // Enable input fields for editing
    $('#dosenNama, #dosenNip, #dosenEmail, #dosenKompetensi, #dosenMatkul, #editFoto').prop('readonly', false);
    $('#updateButton').removeClass('d-none');
    $('#editFoto').removeClass('d-none');
    $(this).addClass('d-none');
});

$('#updateButton').click(function(e) {
    e.preventDefault();
    e.stopPropagation();
    var dosenId = $('#post_id').val();  // Get the post_id value
    var formData = new FormData();

    var foto = $('#editFoto')[0].files[0];
    if (foto) {
        formData.append('foto', foto);
    }
    formData.append('_token', $('input[name=_token]').val());
    formData.append('_method', 'PUT');  // Indicate that this is a PUT request
    formData.append('nama', $('#dosenNama').val());
    formData.append('nip', $('#dosenNip').val());
    formData.append('email', $('#dosenEmail').val());
    formData.append('kompetensi', $('#dosenKompetensi').val());
    formData.append('matkul', $('#dosenMatkul').val());
    formData.append('lampiran', $('#dosenLampiran').val());
    // formData.append('status', $('#dosenStatus').val());
    // formData.append('admin_id', '1');

    $.ajax({
        url: '/api/dosens/' + dosenId,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            Swal.fire({
                icon: 'success',
                title: `${response.message}`,
                showConfirmButton: false,
                timer: 3000
            });

            // Update the table row with new data
            let dosen = `
                <tr id="index_${response.data.id}">
                    <td>${response.data.id}</td>
                    <td>${response.data.nama}</td>
                    <td>${response.data.nip}</td>
                    <td>${response.data.email}</td>
                    <td>${response.data.kompetensi}</td>
                    <td><a href="javascript:void(0)" class="button-detail btn btn-sm" data-id="${response.data.id}">detail</a></td>
                </tr>
            `;

            $(`#index_${response.data.id}`).replaceWith(dosen);

            $('#dosenNama, #dosenNip, #dosenEmail, #dosenKompetensi, #dosenMatkul').prop('readonly', true);
            $('#editFoto').addClass('d-none').val('');
            $('#Fotodosen').val(response.data.foto);
            $('#editButton').removeClass('d-none');
            $('#updateButton').addClass('d-none');

            // Close modal
            $('#dosenDetailModal').modal('hide');
        }
    });
});
</script>
