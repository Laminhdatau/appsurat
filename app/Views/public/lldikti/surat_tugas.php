<?= $this->extend('layout/v_apk/template'); ?>

<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Surat Tugas</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover col-12" id="dataTable" cellspacing="0">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>PERIHAL</th>
                            <th>DASAR</th>
                            <th>PENERIMA</th>
                            <th>TUJUAN</th>
                            <th>LOKASI</th>
                            <th>TANDA TANGAN</th>
                            <th>
                                <?php
                                if (in_groups('leadl')) { ?>
                                    Aksi
                                <?php } else { ?>
                                    <button class="badge badge-primary" data-target="#addModal" data-toggle="modal"><i class="fas fa-plus"></i> BUAT SURAT</button>
                                    <button class="badge badge-primary" data-target="#booking" data-toggle="modal"><i class="fas fa-plus"></i> BOOKING NOMOR</button>
                                <?php } ?>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($surgas as $s) { ?>
                            <?php $status = $s['id_status'];
                            $starray = explode(',', $status);


                            $verifikator = $s['verifikator'];
                            $verray = explode(',', $verifikator);
                            $jumlahverif = count($verray);

                            $tverif = verifikasisetuju();
                            if (!empty($tverif && $tverif->id_surat == $s['id_surat_tugas'])) {
                                $limit = verifikasisetuju()->jumlah_verifikator;
                                $ada = verifikasisetuju()->id_user;
                            } else {
                                $limit = null;
                                $ada = null;
                            }

                            // d($tverif);
                            // d($limit);
                            // dd($jumlahverif);

                            $idArray = explode(',', $ada);




                            if (in_array('1', $starray)) {
                                $status = '1';
                            } elseif (in_array('2', $starray)) {
                                $status = '2';
                            } elseif (in_array('3', $starray)) {
                                $status = '3';
                            } else {
                                if ($limit == null) {
                                    $status = 'process'; // Set status in_process jika limit masih null
                                } elseif ($limit < $jumlahverif) {
                                    $status = 'in_process'; // Set status in_process jika limit kurang dari jumlah verifikator
                                } else {
                                    $status = 'verified';
                                }
                            }

                            switch ($status) {
                                case '1':
                                    $class = 'success';
                                    $icon = 'check';
                                    $ket = 'Tertanda';
                                    break;
                                case '2':
                                    $class = 'warning';
                                    $icon = 'clock';
                                    $ket = 'Perlu Direvisi';
                                    break;
                                case '3':
                                    $class = 'danger';
                                    $icon = 'times';
                                    $ket = 'Tertolak';
                                    break;

                                case 'in_process':
                                    $class = 'info';
                                    $icon = 'clock';
                                    $ket = 'Proses Verifikasi';
                                    break;
                                case 'verified':
                                    $class = 'success';
                                    $icon = 'check';
                                    $ket = 'Terverifikasi';
                                    break;
                                case 'process':
                                    $class = 'warning';
                                    $icon = 'refresh';
                                    $ket = 'Proses';
                                    break;
                                default:
                                    $class = 'warning';
                                    $icon = 'refresh';
                                    $ket = 'Proses';
                                    break;
                            }
                            ?>




                            <tr>
                                <td class="col-4">

                                    <p class="text-<?= $class; ?>"><?= $s['id_nomor_surat']; ?> <i class="fas fa-<?= $icon; ?>"></i><?= $ket; ?></p>

                                    <p>
                                        <?php
                                        $peri = $s['perihal'];
                                        $words = explode(' ', $peri);
                                        $max_words = 3;
                                        $perite = implode(' ', array_slice($words, 0, $max_words));
                                        if (count($words) > $max_words) {
                                            $perite .= ' .....';
                                        }
                                        echo $perite;
                                        ?></p>
                                </td>

                                <td class="col-5">

                                    <?php
                                    $dasar = $s['dasar'];

                                    $explodedDasar = explode(',', $dasar);
                                    if (count($explodedDasar) > 1) {
                                        foreach ($explodedDasar as $item) {
                                            $words = explode(' ', $item);

                                            $shortenedItem = implode(' ', array_slice($words, 0, 4));

                                            echo '<li>' . $shortenedItem . '</li>';
                                        }
                                    } else {
                                        $words = explode(' ', $dasar);

                                        $shortenedDasar = implode(' ', array_slice($words, 0, 4));

                                        echo $shortenedDasar;
                                    }
                                    ?>

                                    <?php if (empty($s['verifikator'])) : ?>
                                        <form class="saveDasar" data-id="<?= $s['id_surat_tugas']; ?>">
                                            <div>
                                                <input type="hidden" name="id_surat_tugas" value="<?= $s['id_surat_tugas']; ?>">
                                                <div id="input-container" data-id="<?= $s['id_surat_tugas']; ?>"></div>
                                                <?php if (empty($s['qr_code_image_path'])) { ?>
                                                    <button type="button" class="badge badge-secondary tbh add-input" data-id="<?= $s['id_surat_tugas']; ?>"><i class="fas fa-plus"></i> Input Dasar</button>
                                                    <button type="submit" class="badge badge-primary" id="bt-simpan">Simpan Dasar</button>
                                                <?php } ?>
                                            </div>
                                        </form>
                                    <?php endif; ?>

                                </td>

                                <td class="col-5">
                                    <p>
                                        <?php if ($s['nama_pegawai']) { ?>
                                            <?= $s['nama_pegawai']; ?>
                                        <?php } else { ?>
                                            Belum Diinput
                                        <?php } ?>
                                    </p>
                                    <?php if (!empty($s['dasar'])) : ?>
                                        <?php if (empty($s['qr_code_image_path'])) { ?>
                                            <?php if (!empty($s['nama_pegawai'])) { ?>
                                                <?php
                                                if ($status != 'verified') {
                                                    $veri = verifikator();
                                                    $verify = ($veri) ? $veri->verifikator : null;

                                                    if ($verify !== idPegawai()) {
                                                        echo '<button class="badge badge-secondary" data-toggle="modal" data-target="#updatePegawaiSpt' . $s['id_surat_tugas'] . '"><i class="fas fa-edit"></i> Update Penerima SPT</button>';
                                                    }
                                                }
                                                ?>


                                            <?php } else { ?>
                                                <button class="badge badge-primary" data-toggle="modal" data-target="#tambahPegawaiSpt<?= $s['id_surat_tugas']; ?>"><i class="fas fa-plus"></i> Tambah Penerima SPT</button>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <?php
                                    $tujuan_surat = $s['tujuan_surat'];
                                    $words = explode(' ', $tujuan_surat);
                                    $max_words = 5;
                                    $short_text = implode(' ', array_slice($words, 0, $max_words));
                                    if (count($words) > $max_words) {
                                        $short_text .= ' .....';
                                    }
                                    echo $short_text;
                                    ?>
                                </td>

                                <td>
                                    <?= $s['tempat_pelaksanaan']; ?>
                                </td>

                                <td>
                                    <?php if ($status == '1') { ?>
                                        <img src="<?= base_url($s['qr_code_image_path']); ?>" alt="">
                                    <?php } elseif ($status == 'in_process') { ?>
                                        <div style="display: flex; align-items: center;">
                                            <a>Proses Verifikasi</a>
                                        </div>
                                    <?php } elseif ($status == 'verified') { ?>
                                        <div style="display: flex; align-items: center;">
                                            <a>Menunggu Persetujuan</a>
                                        </div>
                                        <?php } elseif ($status == '3') { ?>
                                        <div style="display: flex; align-items: center;">
                                            <a>Surat Di Tolak</a>
                                        </div>
                                    <?php } else { ?>
                                        <div style="display: flex; align-items: center;">
                                            <a>Belum Terverifikasi</a>
                                        </div>
                                    <?php } ?>
                                </td>

                                <td>

                                    <?php if (!empty($s['qr_code_image_path'])) { ?>
                                        <a class="badge badge-primary btn-dtl" target="_blank" href="<?= base_url('DetailSuratPdf/' . $s['id_surat_tugas']); ?>"><i class="fas fa-book"></i> Lihat Surat</a><br>
                                    <?php } ?>

                                    <?php if (idUser() !== '16') { ?>
                                        <?php if (empty($s['qr_code_image_path'])) { ?>
                                            <?php


                                            if ($status != '1' && $status != 'verified' && $status != '3' && $s['created_by'] == idUser()) { ?>
                                                <button class="badge badge-primary" data-toggle="modal" data-target="#updateModal<?= $s['id_surat_tugas']; ?>"><i class="fas fa-edit"></i> Ubah Data</button><br>
                                            <?php } ?>

                                        <?php } ?>
                                    <?php } ?>


                                    <?php if (!empty($s['nama_pegawai'])) { ?>

                                        <?php if (

                                            !empty($s['nama_pegawai']) &&
                                            !empty($s['tgl_mulai']) &&
                                            !empty($s['verifikator']) &&
                                            !empty($s['tgl_selesai']) &&
                                            !empty($s['tujuan_surat']) &&
                                            !empty($s['tempat_pelaksanaan']) &&
                                            !empty($s['dasar'])

                                        ) {


                                        ?>

                                            <?php if (idUser() == '16') { ?>

                                                <?php if (empty($s['qr_code_image_path']) && $status == 'verified') : ?>
                                                    <button class="badge badge-primary" data-toggle="modal" data-target="#tandaTangan<?= $s['id_surat_tugas']; ?>"><i class="fas fa-book"></i> Tanda Tangan</button>
                                                <?php endif; ?>
                                            <?php } ?>
                                        <?php } ?>

                                        <!-- <php if (in_array(idPegawai(), $verray)) { ?> -->


                                        <?php if (

                                            !in_array(
                                                idUser(),
                                                $idArray
                                            ) &&
                                            in_array(idPegawai(), $verray) &&
                                            $status != '3' && $status != '2'
                                        ) { ?>
                                            <button class="badge badge-primary" data-toggle="modal" data-target="#verifikasi<?= $s['id_surat_tugas']; ?>"><i class="fas fa-book"></i> Verifikasi</button>
                                        <?php } ?>



                                        <?php if (
                                            !empty($s['nama_pegawai']) &&
                                            !empty($s['tgl_mulai']) &&
                                            !empty($s['tgl_selesai']) &&
                                            !empty($s['tujuan_surat']) &&
                                            !empty($s['tempat_pelaksanaan']) &&
                                            !empty($s['dasar']) &&
                                            empty($s['qr_code_image_path']) &&
                                            empty($s['verifikator'])
                                        ) { ?>
                                            <button class="badge badge-primary" data-toggle="modal" data-target="#addverifikator<?= $s['id_surat_tugas']; ?>"><i class="fas fa-plus"></i> Tambah Verifikator</button>
                                        <?php } ?>



                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php foreach ($surgas as $s) { ?>
    <!-- Modal Tambah Menu -->
    <div class="modal fade" id="detailModal<?= $s['id_surat_tugas']; ?>" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Details Surat Tugas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="assets/surgas/"></iframe>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php } ?>





<!-- ============================================================ -->


<!-- =============================================== -->


<!-- Modal Tambah Menu -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Buat Surat Tugas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('addSurgas'); ?>" method="post">
                    <div class="col">

                        <div class="row form-group">
                            <label for="">Kode Surat</label>
                            <select name="kodesurat" id="kodurat" class="form-control" required multiple>
                                <?php foreach ($kodeSurat as $k) { ?>
                                    <option value="<?= $k['nomor_surat']; ?>"><?= $k['perihal']; ?> --( <?= $k['nomor_surat']; ?> )</option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="row form-group">
                            <label for="">Tujuan Surat</label>
                            <input name="tujuan" id="tujuan" class="form-control" placeholder="Kegiatan apa...." required>
                        </div>
                        <div class="row form-group">
                            <label for="lokasi">Lokasi Pelaksanaan</label>
                            <input type="text" name="lokasi" id="" class="form-control" placeholder="Dimana ....." required>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tgl_mulai">Tanggal Mulai</label>
                                    <input type="date" name="tgl_mulai" id="tgl_mulai" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tgl_selesai">Tanggal Selesai</label>
                                    <input type="date" name="tgl_selesai" id="tgl_selesai" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="tembus">Tembusan <span>(boleh dikosongkan)</span></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <textarea name="tembusan" id="tembus" cols="100" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="booking" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Booking Nomor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('BookingNum'); ?>" method="post">
                    <div class="col">
                        <div class="row form-group kajax">
                            <label for="kodeajax">Kode Surat</label>
                            <select name="kodesurat" id="kodeajax" class="form-control" required multiple>
                                <?php
                                foreach ($kodeSurat as $k) {
                                ?>
                                    <option value="<?= $k['nomor_surat']; ?>"><?= $k['perihal']; ?> --( <?= $k['nomor_surat']; ?> )</option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<?php foreach ($surgas as $s) { ?>

    <div class="modal fade" id="updateModal<?= $s['id_surat_tugas']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Update Surat Tugas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('ubahSurgas/' . $s['id_surat_tugas']); ?>" method="post">
                        <div class="col">

                            <div class="row form-group">
                                <label for="">Kode Surat</label>
                                <select name="kodesurat" id="upkodurat" class="form-control" required>
                                    <option value="">--PILIH KODE SURAT--</option>
                                    <?php
                                    $parts = explode('/', $s['id_nomor_surat']);
                                    foreach ($kodeSurat as $k) {
                                        $bagianSurat = isset($parts[2]) ? $parts[2] : '';
                                        $selected = ($bagianSurat == $k['nomor_surat']) ? 'selected' : '';
                                    ?>
                                        <option value="<?= $k['nomor_surat']; ?>" <?= $selected ?>><?= $k['nomor_surat']; ?> -- <?= $k['perihal']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="row form-group">
                                <label for="">Tujuan Surat</label>
                                <input name="tujuan" id="tujuan" class="form-control" value="<?= $s['tujuan_surat']; ?>" required>
                            </div>

                            <div class="row form-group">
                                <label for="lokasi">Lokasi Pelaksanaan</label>
                                <input type="text" name="lokasi" id="" value="<?= $s['tempat_pelaksanaan']; ?>" class="form-control" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_pegawai">Tanggal Mulai</label>
                                        <input type="date" name="tgl_mulai" id="" class="form-control" value="<?= $s['tgl_mulai']; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_pegawai">Tanggal Selesai</label>
                                        <input type="date" name="tgl_selesai" id="" class="form-control" value="<?= $s['tgl_selesai']; ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="tembus">Tembusan <span>( boleh dikosongkan )</span></label>
                                <input type="text" name="tembusan" id="" value="<?= $s['tembusan']; ?>" class="form-control">
                            </div>
                        </div>
                        <br>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php foreach ($surgas as $s) { ?>
    <div class="modal fade" id="tambahPegawaiSpt<?= $s['id_surat_tugas']; ?>" tabindex="-1" role="dialog" aria-labelledby="tambahPegawaiModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahPegawaiModalLabel">Tambah Pegawai SPT</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('/addSurgasPegawai'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="id_pegawai">Pilih Pegawai</label>
                            <input type="hidden" name="id_surat_tugas" value="<?= $s['id_surat_tugas']; ?>">

                            <select name="pegawai[]" id="pegawai<?= $s['id_surat_tugas'] ?>" class="form-control" multiple required>
                                <?php foreach ($pegawai as $p) { ?>
                                    <option value="<?= $p['id_pegawai']; ?>"><?= $p['nama_lengkap']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>

<?php foreach ($surgas as $s) { ?>
    <div class="modal fade" id="updatePegawaiSpt<?= $s['id_surat_tugas']; ?>" tabindex="-1" role="dialog" aria-labelledby="updatePegawaiModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updatePegawaiModalLabel">Tambah Penerima SPT</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('/updateSurgasPegawai'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="id_pegawai">Pilih Pegawai</label>
                            <input type="hidden" name="id_surat_tugas" value="<?= $s['id_surat_tugas']; ?>">

                            <select name="pegawai[]" id="pegawais<?= $s['id_surat_tugas'] ?>" class="form-control" multiple required>
                                <?php foreach ($pegawai as $p) { ?>
                                    <option value="<?= $p['id_pegawai']; ?>"><?= $p['nama_lengkap']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>


<?php foreach ($surgas as $s) { ?>
    <div class="modal fade" id="verifikasi<?= $s['id_surat_tugas']; ?>" tabindex="-1" role="dialog" aria-labelledby="verifModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verifModalLabel">Silahkan Verifikasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('/verify'); ?>" method="post">
                    <div class="modal-body mx-auto">
                        <div class="form-group">
                            <input type="hidden" name="id_surat_tugas" value="<?= $s['id_surat_tugas']; ?>">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button class="btn btn-success" name="uprov" value="12">Setujui</button>
                            <button class="btn btn-danger" name="uprov" value="3">Tolak</button>
                            <button class="btn btn-warning" name="uprov" value="2">Revisi</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>

<?php foreach ($surgas as $s) { ?>
    <div class="modal fade" id="tandaTangan<?= $s['id_surat_tugas']; ?>" tabindex="-1" role="dialog" aria-labelledby="tandaTanganModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tandaTanganModalLabel">Silahkan Tandatangani</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('/Tte'); ?>" method="post">
                    <div class="modal-body mx-auto">
                        <div class="form-group">
                            <input type="hidden" name="id_surat_tugas" value="<?= $s['id_surat_tugas']; ?>">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button class="btn btn-success" name="status" value="1">Setujui</button>
                            <button class="btn btn-danger" name="uprov" value="3">Tolak</button>
                            <button class="btn btn-warning" name="uprov" value="2">Revisi</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>

<?php foreach ($surgas as $s) { ?>
    <div class="modal fade" id="addverifikator<?= $s['id_surat_tugas']; ?>" tabindex="-1" role="dialog" aria-labelledby="pilihPenandaTanganModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pilihPenandaTanganModalLabel">Pilih Verifikator</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="uprovment" method="post">
                    <div class="modal-body mx-auto">
                        <div class="form-group">
                            <input type="hidden" name="id_surat_tugas" value="<?= $s['id_surat_tugas']; ?>">

                            <select name="verify[]" id="verify<?= $s['id_surat_tugas'] ?>" multiple>
                                <?php foreach ($pegawaiverif as $v) {
                                ?>

                                    <option value="<?= $v['id_pegawai']; ?>"><?= $v['nama_lengkap']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary" name="sve">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>

<script>
    <?php foreach ($surgas as $s) { ?>
        new MultiSelectTag('pegawai<?= $s['id_surat_tugas'] ?>', {
            rounded: true,
            shadow: true,
            placeholder: 'Cari Pegawai',
            onChange: function(values) {
                console.log(values);
            }
        });
    <?php } ?>
    <?php foreach ($surgas as $s) { ?>
        new MultiSelectTag('pegawais<?= $s['id_surat_tugas'] ?>', {
            rounded: true,
            shadow: true,
            placeholder: 'Cari Pegawai',
            onChange: function(values) {
                console.log(values);
            }
        });
    <?php } ?>


    new MultiSelectTag('kodeajax', {
        rounded: true,
        shadow: true,
        placeholder: 'Pilih 1 Kode Surat',
        onChange: function(values) {
            console.log(values);
        }
    });

    new MultiSelectTag('kodurat', {
        rounded: true,
        shadow: true,
        placeholder: 'Pilih 1 Kode Surat',
        onChange: function(values) {
            console.log(values);
        }
    });

    <?php foreach ($surgas as $s) { ?>

        $('#tambahPegawaiSpt button[name="simpan"]').click(function(e) {
            e.preventDefault();
            var pegawai = $('#pegawai<?= $s['id_surat_tugas']; ?>').val();

            $.ajax({
                url: 'addSurgasPegawai',
                type: 'POST',
                data: {
                    pegawai: pegawai
                },
                success: function(response) {
                    console.log(response.pegawai);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    <?php } ?>
</script>

<script>
    <?php foreach ($surgas as $s) { ?>
        new MultiSelectTag('verify<?= $s['id_surat_tugas'] ?>', {
            rounded: true,
            shadow: true,
            placeholder: 'Cari Penanda Tangan',
            onChange: function(values) {
                console.log(values);
            }
        });
    <?php } ?>



    <?php foreach ($surgas as $s) { ?>

        $('#verifikator button[name="sve"]').click(function(e) {
            e.preventDefault();
            var verify = $('#verify<?= $s['id_surat_tugas']; ?>').val();

            $.ajax({
                url: 'uprovment',
                type: 'POST',
                data: {
                    verify: verify
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    <?php } ?>
</script>


<script>
    ClassicEditor
        .create(document.querySelector('#tembus'))
        .catch(error => {
            console.error(error);
        });
</script>





<script>
    $(document).ready(function() {
        // Fungsi untuk menangani klik tombol "Lihat"
        $('.btn-dtl').click(function() {
            var idSurat = $(this).data('id');
            $.ajax({
                url: 'SeeTo/' + idSurat,
                type: 'POST',
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    // Tampilkan pesan kesalahan jika ada
                    console.log('Terjadi kesalahan. Silakan coba lagi.');
                }
            });
        });
    });
</script>



<script>
    $(document).ready(function() {
        $(".saveDasar").each(function(index, element) {
            var idSuratTugas = $(element).data("id");
            var container = $("#input-container[data-id='" + idSuratTugas + "']");
            var addInputButton = $(".add-input[data-id='" + idSuratTugas + "']");
            var btSimpan = $("#bt-simpan");

            // Ketika tombol "Add More" diklik
            addInputButton.click(function() {
                var newInput = '<div class="form-group">' +
                    '<input type="text" name="dasar[]" class="form-control" placeholder="ex. Keputusan ..." required>' +
                    '</div>';
                container.append(newInput);
                btSimpan.show();
            });

            // Ajax request untuk mengirim data form tanpa reload halaman
            $(element).submit(function(event) {
                event.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "saveDasar", // Ganti dengan URL ke fungsi save_data di controller Anda
                    data: $(this).serialize(),
                    success: function(response) {
                        location.reload();
                    }
                });
            });
        });

        $("#bt-simpan").hide();
    });
</script>

<?= $this->endSection(); ?>