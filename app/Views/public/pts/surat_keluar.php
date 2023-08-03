<?= $this->extend('layout/v_apk/template'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Surat Keluar</h6>
                <a href="<?= base_url('formTambahSukerp'); ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah
                </a>
            </div>
        </div>

        <div class="card-body">


            <div class="table-responsive">

                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">

                    <thead>
                        <tr class="bg-dark text-white">
                            <th>PENERIMA & SIFAT</th>
                            <th>PERIHAL/TANGGAL</th>
                            <th>STATUS</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($suker as $s) : ?>
                            <?php
                            $status = $s['id_status'];
                            if ($status) {
                                $statusArray = explode(',', $status);
                            } else {
                                $statusArray = [];
                            }
                            ?>


                            <tr>
                                <td class="col-3">
                                    <p><?= $s['lldikti']; ?>
                                        <?php if (empty($status)) : ?>
                                            <span class="float-right text-primary">
                                                <i class="fas fa-random"></i> Diproses
                                            </span>
                                        <?php elseif (in_array('4', $statusArray) && in_array('8', $statusArray)) : ?>
                                            <span class="float-right text-success">
                                                <i class="fas fa-check"></i> Terkirim
                                            </span>
                                        <?php elseif (in_array('4', $statusArray)) : ?>
                                            <span class="float-right text-danger">
                                                <i class="fas fa-clock"></i> Dipending
                                            </span>
                                        <?php endif; ?>

                                    </p>
                                    <p><?= $s['sifat']; ?></p>
                                </td>
                                <td class="col-4">
                                    <p><i class="fas fa-envelope"></i> <?= $s['nomor_surat'] ?><span class="float-right"><i class="fas fa-calendar"></i><?= $s['tgl_surat'] ?></span></p>
                                    <p><?= $s['perihal']; ?></p>
                                </td>
                                <td class="col-4 text-center">
                                    <ul id="progressbar">
                                        <li id="proses" data-id="<?= $s['id_surat']; ?>" data-toggle="tooltip" title="Proses"><a></a></li>
                                        <li id="terkirim" data-id="<?= $s['id_surat']; ?>" data-toggle="tooltip" title="Terkirim"><a></a></li>
                                        <li id="dilihat" data-id="<?= $s['id_surat']; ?>" data-toggle="tooltip" title="Dilihat"><a></a></li>

                                    </ul>
                                </td>

                                <td class="col-1">
                                    <a type="button" data-toggle="modal" class="badge btn-success" data-target="#detailModal<?= $s['id_surat']; ?>"><i class="fas fa-eye"></i> Lihat</a>
                                    <?php if ($s['is_active'] == '0') : ?>
                                        <a href="<?= base_url('formUbahSukerp/' . $s['id_surat']); ?>" class="badge badge-warning"><i class="fas fa-edit"></i> Ubah Surat</a>
                                        <a type="button" data-toggle="modal" class="badge btn-info" data-target="#konfirmasiKirim<?= $s['id_surat']; ?>">
                                            <i class="fas fa-clock"></i> Konfirmasi Kirim
                                        </a>
                                    <?php endif; ?>

                                    <?php if (!in_array('8', $statusArray)) : ?>
                                        <button class="badge badge-danger" data-toggle="modal" data-target="#deleteSurat<?= $s['id_surat']; ?>"><i class="fas fa-trash"></i> Hapus</button>
                                    <?php endif ?>
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





<?php foreach ($suker as $s) : ?>
    <!-- Modal Tambah Menu -->
    <div class="modal fade" id="konfirmasiKirim<?= $s['id_surat']; ?>" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Konfirmasi Kirim :<span> <i class="fas fa-envelope"></i><?= $s['nomor_surat']; ?></span></h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-auto">
                    <form action="<?= base_url('validasiKirim/' . $s['id_surat']); ?>" method="post">
                        <div class="">
                            <button name="stts" value="2" class="btn btn-danger">Batal</button>
                            <button name="stts" value="1" class="btn btn-success">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php endforeach; ?>





<?php foreach ($suker as $s) : ?>
    <!-- Modal Tambah Menu -->
    <div class="modal fade" id="deleteSurat<?= $s['id_surat']; ?>" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel"><b class="text-danger"><i class="fas fa-info"></i> Apakah anda yakin ingin menghapus?</b></h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-auto">
                    <form action="<?= base_url('hapusSuratp/' . $s['id_surat']); ?>" method="post">
                        <div class="">
                            <button type="button" class="btn btn-secondary">Batal</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php endforeach; ?>










<script>
    <?php foreach ($suker as $s) : ?>
        <?php
        $status = $s['id_status'];
        if ($status) {
            $statusArray = explode(',', $status);
        } else {
            $statusArray = [];
        }
        ?>
        $(document).ready(function() {
            $("#progressbar").each(function() {
                var idSurat = "<?= $s['id_surat']; ?>";
                var curStep = <?= json_encode($statusArray); ?>;
                var active = <?= $s['is_active']; ?>;
                setProgressBar(curStep, idSurat, active);
            });

            function setProgressBar(curStep, idSurat, active) {

                if (active === 0 || active === 1 || curStep.includes('4')) {
                    $("#proses[data-id='" + idSurat + "']").addClass("active");
                }
                if (curStep.includes('8')) {
                    $("#terkirim[data-id='" + idSurat + "']").addClass("active");
                }
                if (curStep.includes('5')) {
                    $("#dilihat[data-id='" + idSurat + "']").addClass("active");
                }
            }

        });
    <?php endforeach; ?>
</script>


<?= $this->endSection(); ?>