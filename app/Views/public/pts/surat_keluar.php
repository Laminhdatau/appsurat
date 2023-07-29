<?= $this->extend('layout/v_apk/template'); ?>

<?= $this->section('content'); ?>

<?php


?>


<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Surat Keluar</h6>
                <a type="button" data-toggle="modal" class="btn btn-primary" data-target="#addModal">
                    <i class="fas fa-plus"></i> Tambah
                </a>
            </div>
        </div>

        <div class="card-body">


            <div class="table-responsive">

                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">

                    <thead>
                        <tr>
                            <th>Send To & Sifat</th>
                            <th>Nomor Surat/Tgl/perihal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($suker as $s) : ?>


                            <tr>
                                <td class="col-4">
                                    <p><?= $s['lldikti']; ?></p>
                                    <p><?= $s['sifat']; ?></p>
                                </td>
                                <td class="col-5">
                                    <p><?= $s['nomor_surat'] ?><span class="float-right"><?= $s['tgl_surat'] ?></span></p>
                                    <p><?= $s['perihal']; ?></p>
                                </td>
                                <td class="col-5">
                                    <?php if ($s['id_status'] == 0 || $s['id_status'] == 8) { ?>
                                        <a type="button" class="badge badge-primary"><i class="fas fa-check"> </i> Terkirim</a>
                                    <?php } elseif ($s['id_status'] == 5 || $s['id_status'] == 11) { ?>
                                        <a type="button" class="badge badge-success"><i class="fas fa-check"></i><i class="fas fa-check"> </i> Dibaca</a>
                                    <?php } elseif ($s['id_status'] == 10) { ?>
                                        <a type="button" class="badge badge-dark"><i class="fas fa-check"></i><i class="fas fa-check"> </i> Terkonfirmasi</a>
                                    <?php } ?>

                                </td>

                                <td>
                                    <a type="button" data-toggle="modal" class="badge btn-success" data-target="#detailModal<?= $s['id_surat']; ?>"><i class="fas fa-eye"></i> Lihat</a>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>


<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add Surat Keluar</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('savesukerp'); ?>" method="post" enctype="multipart/form-data">

                    <div class="row form-group">
                        <label for="">Nomor Surat</label>

                        <input type="hidden" name="id_instansi" id="" value="<?= idInstansi(); ?>" class="form-control">
                        <input type="text" name="nomor_surat" id="" class="form-control">
                    </div>
                    <div class="row form-group">
                        <label for="">perihal</label>
                        <input type="text" name="perihal" id="" class="form-control">
                    </div>

                    <div class="row form-group">
                        <label for="">Tembusan</label>
                        <input type="text" name="tembusan" id="" class="form-control">
                    </div>
                    <div class="row form-group">
                        <label for="">Sifat</label>
                        <select name="id_sifat" id="" class="form-control">
                            <option value="">--PILIH--</option>
                            <?php foreach ($sifat as $si) { ?>
                                <option value="<?= $si['id_sifat']; ?>"><?= $si['sifat']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="row form-group">
                        <label for="">Dokumen</label>
                        <input type="hidden" name="id_surat" id="">
                        <input type="file" name="filex" id="" class="form-control-file">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>



            </div>
        </div>
    </div>
</div>


<?php foreach ($suker as $s) : ?>
    <!-- Modal Tambah Menu -->
    <div class="modal fade" id="detailModal<?= $s['id_surat']; ?>" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Nomor Surat : <?= $s['nomor_surat']; ?></h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- views/surat/detail.php -->


                    <?php if ($s['filex']) : ?>
                        <div class="embed-responsive embed-responsive-16by9">
                            <?php if ($s['filex']) : ?>
                                <iframe class="embed-responsive-item" src="assets/document/<?= $s['filex'] ?>"></iframe>
                            <?php else : ?>
                                <p>Tidak ada file terlampir.</p>
                            <?php endif; ?>
                        </div>
                    <?php else : ?>
                        <p>Surat tidak ditemukan.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?= $this->endSection(); ?>