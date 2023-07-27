<?= $this->extend('layout/v_apk/template'); ?>
<?= $this->section('content'); ?>
<!-- Begin Page Content -->

<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar User</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="col-1">Foto</th>
                            <th>Nama Lengkap</th>
                            <th>Jabatan</th>
                            <th>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createUser">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($users as $u) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><img src="<?= base_url('assets/img/' . $u['foto']); ?>" alt="" width="50%"></td>
                                <td><?= $u['nama_lengkap']; ?></td>
                                <td><?= $u['jabatan']; ?></td>
                                <td>

                                </td>
                            </tr>

                        <?php } ?>
                    </tbody>
                </table>



                <!-- Modal Tambah Menu -->
                <div class="modal fade" id="createUser" tabindex="-1" role="dialog" aria-labelledby="createUserLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="createUserLabel">Tambah User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('/createUser'); ?>" method="post">
                                    <div class="form-group">
                                        <label for="menu">Email</label>
                                        <input type="hidden" class="form-control" id="id_user" name="id_user" required>
                                        <input type="text" class="form-control" id="email" name="email" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="menu">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="menu">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
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





            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>