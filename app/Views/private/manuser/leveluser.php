<?= $this->extend('layout/v_apk/template'); ?>
<?= $this->section('content'); ?>


<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row align-items-center">
                <div class="col-11">
                    <h6 class="m-0 font-weight-bold text-primary">LEVEL USER</h6>
                </div>
               
                    <div class="col-1">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahLevel">TAMBAH</button>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body bg-white">
        <div class="table-responsive">
            <table class="table table-bordered col-12" id="dataTable" cellspacing="0">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>USERNAME</th>
                        <th>EMAIL</th>
                        <th>LEVEL</th>
                        <th>KETERANGAN</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($level as $p) : ?>
                        <?php
                        $id_grup = $p['id_grup'];
                        $grup = $p['grup'];
                        $ketgrup = $p['ket_grup'];

                        $idArr = explode(',', $id_grup);
                        $grArr = explode(',', $grup);
                        $ketArr = explode(',', $ketgrup);

                        ?>
                        <tr>
                            <td><?= $p['username'] ?></td>
                            <td><?= $p['email'] ?></td>
                            <td>
                                <?php
                                foreach ($grArr as $a) {
                                    echo '<p>' . $a . '</p>';
                                } ?>
                            </td>
                            <td>
                                <?php foreach ($ketArr as $a) {
                                    echo '<p>' . $a . '</p>';
                                } ?>
                            </td>
                            <td>
                                <?php
                                $no = 1;
                                foreach ($idArr as $i) { ?>
                                    <p>
                                        <button type="button" class="badge badge-danger delete-level-btn" data-grup="<?= $i ?>" data-id="<?= $p['id_user']; ?>"><i class="fas fa-trash"></i></button>
                                    </p>

                                <?php } ?>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" data-permission="<= $p['id_akses']; ?>">
                                </div>
                            </td> -->

<div class="modal fade bd-example-modal-lg" id="tambahLevel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">LEVEL USER</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('adduserlevel'); ?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="user">USER :</label>
                            <select name="user" id="user" class="form-control" required>
                                <option value="">-- PILIH USER --</option>
                                <?php foreach ($users as $u) { ?>
                                    <option value="<?= $u['id']; ?>"><?= $u['username']; ?></option>
                                <?php } ?>
                            </select>
                        </div>


                        <div class="col-md-6">
                            <label for="user">LEVEL :</label>
                            <select name="grup" id="grup" class="form-control" required>
                                <option value="">-- PILIH LEVEL --</option>
                                <?php foreach ($grups as $g) { ?>
                                    <option value="<?= $g['id']; ?>"><?= $g['name'] . ' -- ' . $g['description']; ?></option>
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
                    url: 'removeuserlevel/' + userId + '/' + encodeURIComponent(grupId),
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