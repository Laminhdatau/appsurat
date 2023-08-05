<?= $this->extend('layout/v_apk/template'); ?>
<?= $this->section('content'); ?>


<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row align-items-center">
                <div class="col-11">
                    <h6 class="m-0 font-weight-bold text-primary">USER PEGAWAI LLDIKTI</h6>
                </div>

                <div class="col-1">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahUserPegawai">TAMBAH</button>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body bg-white">
        <div class="table-responsive">
            <table class="table table-bordered col-12" id="dataTable" cellspacing="0">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>EMAIL</th>
                        <th>USERNAME</th>
                        <th>NAMA LENGKAP</th>
                        <th>INSTANSI</th>
                        <th>JABATAN</th>
                        <th>WILAYAH</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datadikti as $p) : ?>


                        <tr>
                            <td><?= $p['email'] ?></td>
                            <td><?= $p['username'] ?></td>
                            <td><?= $p['nama_lengkap'] ?></td>
                            <td><?= $p['nm_instansi'] ?></td>
                            <td><?= $p['jabatan'] ?></td>
                            <td><?= $p['wilayah'] ?></td>
                            <td>TOMBOL</td>


                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<div class="modal fade bd-example-modal-lg" id="tambahUserPegawai" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">USER PEGAWAI</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('adduserpegawail'); ?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="user">USER :</label>
                            <select name="user" id="user" class="form-control" required>
                                <option value="">-- PILIH USER --</option>
                                <?php foreach ($users as $u) { ?>
                                    <option value="<?= $u['id']; ?>"><?= $u['username'] .' -- '.$u['email']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="user">PEGAWAI :</label>
                            <select name="pegawai" id="pegawai" class="form-control" required>
                                <option value="">-- PILIH PEGAWAI --</option>
                                <?php foreach ($pegawai as $p) { ?>
                                    <option value="<?= $p['id_pegawai']; ?>"><?= $p['nama_lengkap']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="user">WILAYAH :</label>
                            <select name="wilayah" id="wilayah" class="form-control" required>
                                <option value="">-- PILIH WILAYAH --</option>
                                <?php foreach ($wilayah as $w) { ?>
                                    <option value="<?= $w['id_wilayah']; ?>"><?= $w['wilayah']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>

</div>





<script>
    $(document).ready(function() {
        // Attach a click event handler to the delete button
        $('.delete-level-btn').on('click', function() {
            // Get the permission_id and user_id from the data attributes of the clicked delete button
            var grupId = $(this).data('grup');
            var userId = $(this).data('id');

            // Show a confirmation dialog before proceeding with the delete
            if (confirm('Are you sure you want to delete this level?')) {
                // Perform the AJAX delete request
                $.ajax({
                    url: 'removeuserpegawail/' + userId + '/' + encodeURIComponent(grupId),
                    type: 'POST',
                    success: function(response) {
                        console.log('Grup with ID ' + grupId + ' deleted successfully.');
                        // Reload the page after successful deletion
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        // Handle the error response here (e.g., show error message)
                        console.error('Error deleting permission: ' + error);
                    }
                });
            }
        });
    });
</script>










<?= $this->endSection() ?>