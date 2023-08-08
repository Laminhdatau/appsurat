<?= $this->extend('layout/v_apk/template'); ?>
<?= $this->section('content'); ?>
<!-- Begin Page Content -->



<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Daftar User</h6>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>#</th>
                    <th class="col-1">USERNAME</th>
                    <th>EMAIL</th>
                    <th>STATUS</th>
                    <th>
                        AKSI

                    </th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($users as $u) {
                    $status = $u['active'];
                    if ($status == '1') {
                        $color = "success";
                    } else {
                        $color = "danger";
                    }
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $u['username']; ?></td>
                        <td><?= $u['email']; ?></td>
                        <td>
                            <button class="change-status-btn badge badge-<?= $color; ?>" data-id="<?= $u['id']; ?>">
                                <?= ($u['active'] == 1) ? 'On' : 'Off'; ?>
                            </button>
                        </td>
                        <td>
                            <button class="badge badge-danger" data-toggle="modal" data-target="#delete<?= $u['id']; ?>">
                                Hapus
                            </button>

                            <button class="badge badge-warning" data-toggle="modal" data-target="#update<?= $u['id']; ?>">
                                Update
                            </button>


                            </button>
                        </td>

                    </tr>

                <?php } ?>
            </tbody>
        </table>


        <?php foreach ($users as $u) { ?>
            <!-- Modal Tambah Menu -->
            <div class="modal fade" id="update<?= $u['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="createUserLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createUserLabel">Update User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= base_url('updatepeople/' . $u['id']); ?>" method="post">

                                <div class="form-group">
                                    <label for="menu">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" value="<?= $u['username']; ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="menu">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?= $u['email']; ?>" required>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>


        <?php foreach ($users as $u) { ?>
            <!-- Modal Tambah Menu -->
            <div class="modal fade" id="delete<?= $u['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="createUserLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createUserLabel">Tambah User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?= base_url('deletepeople/' . $u['id']); ?>" method="post">

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>
</div>


<!-- Di bawah konten tabel -->
<script>
    $(document).ready(function() {
        // Tangkap klik pada tombol dengan class change-status-btn
        $('.change-status-btn').on('click', function(event) {
            event.preventDefault(); // Menonaktifkan aksi default dari tombol (mencegah halaman me-refresh)

            var userId = $(this).data('id'); // Ambil nilai ID pengguna dari atribut data

            // Simpan tombol dalam variabel
            var button = $(this);

            // Kirim permintaan AJAX ke server
            $.ajax({
                url: 'change-status/' + userId, // Perbarui URL untuk menyertakan ID pengguna
                method: 'POST',
                success: function(response) {
                    // Tangani respons dari server
                    if (response.success) {
                        // Ubah tampilan status di tombol
                        if (response.new_status == 1) {
                            button.text('On').removeClass('badge-danger').addClass('badge-success');
                        } else {
                            button.text('Off').removeClass('badge-success').addClass('badge-danger');
                        }

                        // Jika Anda ingin memberikan umpan balik berupa notifikasi atau sesuatu yang lain, Anda bisa menambahkannya di sini
                    } else {
                        alert('Gagal mengubah status pengguna.');
                    }
                }.bind(this), // <-- Perhatikan penambahan bind(this) di sini
                error: function() {
                    alert('Terjadi kesalahan saat mengirim permintaan AJAX.');
                }
            });
        });
    });
</script>







<?= $this->endSection() ?>