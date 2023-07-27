<?= $this->extend('layout/v_apk/template'); ?>

<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h2 mb-4 text-gray-800">INI NOTA DINAS</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Nota Dinas</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Pengirim</th>
                            <th>Perihal</th>
                            <th>Penerima</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr width="2%">
                            <td class="col-4">
                                <p>Munawir Sadzali Razak</p>
                                <p>Kepala Lembaga Layanan Pendidikan Tinggi Wilayah XVI
                                    <span><button class="badge badge-success float-right">Proses Kirim</button></span>
                                </p>
                            </td>
                            <td class="col-5">
                                <p>0802/LL16/KL00.01/2023 <span class="float-right"><?= date('d-Y-m'); ?></span></p>
                                <p>SPT MONEV BERSAMA TIM EKA PT STISIP SWADAYA DAN STIE SWADAYA</p>
                            </td>
                            <td class="col-5">
                                <p>Fatra JDP Dano</p>
                                <p>Putri,SH.M.I.Kom</p>
                                <p><button class="badge badge-primary">Konfirmasi</button></p>
                            </td>
                            <td><span class="text-success">Disetujui</span></td>

                        </tr>
                        <tr>
                            <td class="col-4">
                                <p>Munawir Sadzali Razak</p>
                                <p>Kepala Lembaga Layanan Pendidikan Tinggi Wilayah XVI
                                    <span><button class="badge badge-success float-right">Proses Kirim</button></span>
                                </p>
                            </td>
                            <td class="col-5">
                                <p>0802/LL16/KL00.01/2023 <span class="float-right"><?= date('d-Y-m'); ?></span></p>
                                <p>SPT MONEV BERSAMA TIM EKA PT STISIP SWADAYA DAN STIE SWADAYA</p>
                            </td>
                            <td class="col-5">
                                <p>Fatra JDP Dano</p>
                                <p>Putri,SH.M.I.Kom</p>
                                <p><button class="badge badge-primary">Konfirmasi</button></p>
                            </td>
                            <td><span class="text-danger">Ditolak</span></td>

                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?= $this->endSection(); ?>