<?= $this->extend('layout/v_apk/template'); ?>

<?= $this->section('content'); ?>
<!-- Begin Page Content -->

<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Menu</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Menu</th>
                            <th><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                                    <i class="fas fa-plus"></i>
                                </button></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($menu as $m) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $m['menu']; ?></td>
                                <td>
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editModal<?= $m['id_menu'] ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    ||
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?= $m['id_menu'] ?>">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>

                        <?php } ?>
                    </tbody>
                </table>



                <!-- Modal Tambah Menu -->
                <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="createModalLabel">Tambah Menu</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('/createMenu'); ?>" method="post">
                                    <div class="form-group">
                                        <label for="menu">Menu</label>
                                        <input type="hidden" class="form-control" id="id_menu" name="id_menu" required>
                                        <input type="text" class="form-control" id="menu" name="menu" required>
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

                <!-- Modal Edit Menu -->
                <?php foreach ($menu as $m) { ?>
                    <div class="modal fade" id="editModal<?= $m['id_menu'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Edit Menu</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?= base_url('/updateMenu'); ?>" method="post">
                                        <input type="hidden" id="editId" name="id">
                                        <div class="form-group">
                                            <label for="editMenu">Menu</label>
                                            <input type="hidden" class="form-control" id="editMenu" name="id_menu" value="<?= $m['id_menu']; ?>" required>
                                            <input type="text" class="form-control" id="editMenu" name="menu" value="<?= $m['menu']; ?>" required>
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

                <!-- Modal Konfirmasi Hapus Menu -->

                <?php foreach ($menu as $m) { ?>

                    <div class="modal fade" id="deleteModal<?= $m['id_menu'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Hapus Menu</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="<?= base_url('/deleteMenu') ?>" method="post">
                                    <div class="modal-body">
                                        <input type="hidden" class="form-control" id="editMenu" name="id_menu" value="<?= $m['id_menu']; ?>" required>

                                        <p>Apakah Anda yakin ingin menghapus menu ini?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } ?>



            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>