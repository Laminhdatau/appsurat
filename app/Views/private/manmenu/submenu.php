<?= $this->extend('layout/v_apk/template'); ?>

<?= $this->section('content'); ?>
<!-- Begin Page Content -->

<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Sub Menu</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Menu</th>
                            <th>Title</th>
                            <th>Icon</th>
                            <th>Url</th>
                            <th>Status</th>
                            <th>
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#createModal">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($submenu as $m) {
                            if ($m['is_active'] == 1) {
                                $button = "<span class='text-success'>Aktif</>";
                            } else {

                                $utton = "<span class='text-danger'>Tidak Aktif</>";
                            }

                        ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $m['menu']; ?></td>
                                <td><?= $m['title']; ?></td>
                                <td><?= $m['icon']; ?></td>
                                <td><?= $m['url']; ?></td>
                                <td><?= $button; ?></td>
                                <td>
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editModal<?= $m['id_sub_menu'] ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    ||
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?= $m['id_sub_menu'] ?>">
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
                                <form action="<?= base_url('/createSubMenu'); ?>" method="post">
                                    <div class="form-group">
                                        <label for="menu">Menu</label>
                                        <input type="hidden" class="form-control" id="id_sub_menu" name="id_sub_menu" required>
                                        <select class="form-control" name="id_menu" id="id_menu">
                                            <option value="">Pilih Menu</option>
                                            <?php foreach ($menu as $m) { ?>
                                                <option value="<?= $m['id_menu']; ?>"><?= $m['menu']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="menu">Title</label>
                                        <input type="text" name="title" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="menu">Icon</label>
                                        <input type="text" name="icon" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="menu">Url</label>
                                        <input type="text" name="url" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="menu">Status</label>
                                        <select name="is_active" id="" class="form-control">
                                            <option value="">Pilih Status</option>
                                            <option value="0"><span class="text-danger">Tidak Aktif</span></option>
                                            <option value="1"><span class="text-danger">Aktif</span></option>
                                        </select>
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
                <?php foreach ($submenu as $sm) { ?>
                    <div class="modal fade" id="editModal<?= $sm['id_sub_menu'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Edit Menu</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?= base_url('/updateSubMenu'); ?>" method="post">
                                        <div class="form-group">
                                            <label for="menu">Menu</label>
                                            <input type="hidden" class="form-control" id="id_sub_menu" name="id_sub_menu" value="<?= $sm['id_sub_menu']; ?>">
                                            <select class="form-control" name="id_menu" id="id_menu">
                                                <option value="">Piih Menu</option>
                                                <?php foreach ($menu as $m) { ?>
                                                    <option value="<?= $m['id_menu']; ?>" <?= ($m['id_menu'] == $sm['id_menu']) ? 'selected' : ''; ?>><?= $m['menu']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="menu">Title</label>
                                            <input type="text" name="title" class="form-control" value="<?= $sm['title']; ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="menu">Icon</label>
                                            <input type="text" name="icon" class="form-control" value="<?= $sm['icon']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="menu">Url</label>
                                            <input type="text" name="url" class="form-control" value="<?= $sm['url']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="menu">Status</label>
                                            <select name="is_active" id="" class="form-control">
                                                <option value="">Pilih Status</option>
                                                <option value="0" <?= ($sm['is_active'] == 0) ? 'selected' : ''; ?>><span class="text-danger">Tidak Aktif</span></option>
                                                <option value="1" <?= ($sm['is_active'] == 1) ? 'selected' : ''; ?>><span class="text-danger">Aktif</span></option>
                                            </select>

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

                <?php foreach ($submenu as $m) { ?>

                    <div class="modal fade" id="deleteModal<?= $m['id_sub_menu'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Hapus Menu</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="<?= base_url('/deleteSubMenu') ?>" method="post">
                                    <div class="modal-body">
                                        <input type="hidden" class="form-control" id="editMenu" name="id_sub_menu" value="<?= $m['id_sub_menu']; ?>" required>

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