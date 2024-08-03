<!-- Modal -->
<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Kabinet </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formData" enctype="multipart/form-data" method="POST">
                    @method('PUT')
                    <input type="hidden" id="post_id">
                    @csrf
                    <div class="form-group">
                        <label for="nama-edit" class="control-label">Nama Anggota</label>
                        <input type="text" class="form-control" id="nama-edit" name="nama-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-kode_mk-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="jabatan-edit" class="control-label">Jabatan</label>
                        <input type="text" class="form-control" id="jabatan-edit" name="jabatan-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-kode_mk-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="departemen-edit" class="control-label">Departemen</label>
                        <input type="text" class="form-control" id="departemen-edit" name="departemen-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-kode_mk-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="tahun-edit" class="control-label">Tahun</label>
                        <input type="text" class="form-control" id="tahun-edit" name="tahun-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-kode_mk-edit"></div>
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
                <button type="submit" class="btn btn-primary" id="update" data-bs-dismiss="modal">UPDATE</button>
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
                url: '/api/kabinets/' + post_id,
                type: "GET",
                cache: false,
                success: function(response){
                    var kabinet = response.data;

                    // Fill form with the fetched data
                    $('#post_id').val(kabinet.id);
                    $('#nama-edit').val(kabinet.nama);
                    $('#jabatan-edit').val(kabinet.jabatan);
                    $('#departemen-edit').val(kabinet.departemen);
                    $('#tahun-edit').val(kabinet.tahun);
                    $('#foto-lampiran').val(kabinet.foto);

                    // Show the modal
                    $('#modal-edit').modal('show');
                }
            });
        });

        // Event handler for update button in the modal
        $('#update').click(function(e) {
            e.preventDefault();
            e.stopPropagation();

            let post_id = $('#post_id').val();
            var formData = new FormData($('#formData')[0]);

            var foto = $('#foto-edit')[0].files[0];
            if (foto) {
                formData.append('foto', foto);
            }
            formData.append('_token', $('input[name=_token]').val());
            formData.append('_method', 'PUT');
            formData.append('nama', $('#nama-edit').val());
            formData.append('jabatan', $('#jabatan-edit').val());
            formData.append('departemen', $('#departemen-edit').val());
            formData.append('tahun', $('#tahun-edit').val());

            // Update data via AJAX
            $.ajax({
                url: '/api/kabinets/' + post_id,
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
                        <td style="text-align: center">${response.data.jabatan}</td>
                        <td style="text-align: center">${response.data.departemen}</td>
                        <td style="text-align: center">${response.data.tahun}</td>
                        <td><img src="{{ url('/storage/foto/') }}/${response.data.foto}" width=100 height=100></td>
                        <td class="text-center" style="padding-right:10px">
                            <a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="button-edit btn btn-sm">edit</a>
                        </td>
                    </tr>
                    `;

                    $(`#index_${response.data.id}`).replaceWith(updatedRow);

                    // Clear form and hide modal
                    $('#formData')[0].reset();
                    $('#modal-edit').modal('hide');
                }
            });
        });
    });
</script>
