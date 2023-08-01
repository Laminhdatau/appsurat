<?= $this->extend('layout/v_apk/template'); ?>

<?= $this->section('content'); ?>
<style>
    /*The background card*/
    .card {
        z-index: 0;
        border: none;
        position: relative;
    }


    /*Icon progressbar*/
    #progressbar {
        margin-bottom: 30px;
        overflow: hidden;
        color: lightgrey;
    }

    #progressbar .active {
        color: #673AB7;
    }

    #progressbar li {
        list-style-type: none;
        font-size: 15px;
        width: 25%;
        float: left;
        position: relative;
        font-weight: 400;
    }

    /*Icons in the ProgressBar*/
    #progressbar #proses:before {
        font-family: FontAwesome;
        content: "\f13e";
    }

    #progressbar #disposisi:before {
        font-family: FontAwesome;
        content: "\f007";
    }

    #progressbar #diteruskan:before {
        font-family: FontAwesome;
        content: "\f030";
    }

    #progressbar #dilaporkan:before {
        font-family: FontAwesome;
        content: "\f00c";
    }

    /*Icon ProgressBar before any progress*/
    #progressbar li:before {
        width: 50px;
        height: 50px;
        line-height: 45px;
        display: block;
        font-size: 20px;
        color: #ffffff;
        background: lightgray;
        border-radius: 50%;
        margin: 0 auto 10px auto;
        padding: 2px;
    }

    /*ProgressBar connectors*/
    #progressbar li:after {
        content: '';
        width: 100%;
        height: 2px;
        background: lightgray;
        position: absolute;
        left: 0;
        top: 25px;
        z-index: -1;
    }

    /*Color number of the step and the connector before it*/
    #progressbar li.active:before,
    #progressbar li.active:after {
        background: #673AB7;
    }

    /*Animated Progress Bar*/
    .progress {
        height: 20px;
    }

    .progress-bar {
        background-color: #673AB7;
    }
</style>

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


                            <tr>
                                <td class="col-3">
                                    <p><?= $s['lldikti']; ?>
                                        <?php if (empty($s['id_status'])) { ?>
                                            <span class="float-right text-primary">

                                                <i class="fas fa-random"></i> Diproses
                                            <?php } elseif ($s['id_status'] == 4) { ?>
                                                <span class="float-right text-danger">
                                                    <i class="fas fa-clock"></i> Dipending

                                                <?php } elseif ($s['id_status'] == 8) { ?>
                                                    <span class="float-right text-success">

                                                        <i class="fas fa-check"></i><i class="fas fa-check"></i> Terkirim
                                                    <?php } ?>
                                                    </span>
                                    </p>
                                    <p><?= $s['sifat']; ?></p>
                                </td>
                                <td class="col-5">
                                    <p><i class="fas fa-envelope"></i> <?= $s['nomor_surat'] ?><span class="float-right"><?= $s['tgl_surat'] ?></span></p>
                                    <p><?= $s['perihal']; ?></p>
                                </td>
                                <td class="col-5">
                                    <ul id="progressbar">
                                        <li class="active" id="proses"><strong>Account</strong></li>
                                        <li id="disposisi"><strong>Personal</strong></li>
                                        <li id="diteruskan"><strong>Image</strong></li>
                                        <li id="dilaporkan"><strong>Finish</strong></li>
                                    </ul>
                                </td>

                                <td>
                                    <a type="button" data-toggle="modal" class="badge btn-success" data-target="#detailModal<?= $s['id_surat']; ?>"><i class="fas fa-eye"></i> Lihat</a>

                                    <a href="<?= base_url('formUbahSukerp/' . $s['id_surat']); ?>" class="badge badge-warning"><i class="fas fa-edit"></i> Ubah Surat</a>


                                    <a type="button" data-toggle="modal" class="badge btn-info" data-target="#konfirmasiKirim<?= $s['id_surat']; ?>">
                                        <i class="fas fa-clock"></i> Konfirmasi Kirim
                                    </a>

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









<script>
    $(document).ready(function() {
        var steps = $("fieldset").length;
        var curStep = <?= $s['id_status']; ?>; // Ganti dengan nilai id_status yang sesuai

        // setProgressBar(current);

        function setProgressBar(curStep) {
            if (empty(curStep)) {
                // Jika id_status adalah 0, aktifkan langkah "DIPROSES"
                $("#proses").addClass("active");
                $(".progress-bar").css("width", "25%");
            } else if (curStep === '8') {
                // Jika id_status adalah 11, aktifkan langkah "DIPROSES" dan "DILAPORKAN"
                $("#proses, #dilaporkan").addClass("active");
                $(".progress-bar").css("width", "100%");
            } else {
                // Jika id_status adalah selain 0 atau 11, aktifkan langkah sesuai nilai id_status
                $("#progressbar li").removeClass("active");
                $("#progressbar li:lt(" + curStep + ")").addClass("active");

                var percent = parseFloat(100 / steps) * curStep;
                percent = percent.toFixed();
                $(".progress-bar").css("width", percent + "%");

                showStep(curStep);
            }
        }

        function showStep(step) {
            $("fieldset").hide();
            $("fieldset:eq(" + (step - 1) + ")").show();
        }
    });
</script>




<?= $this->endSection(); ?>