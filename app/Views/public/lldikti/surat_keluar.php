<?= $this->extend('layout/v_apk/template'); ?>

<?= $this->section('content'); ?>



<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Surat Keluar</h6>
                <a href="<?= base_url('formTambahSukerl'); ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah
                </a>
             
            </div>
        </div>

        <div class="card-body">


            <div class="table-responsive">

                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">

                    <thead>
                        <tr class="bg-dark text-white">
                            <th>KEPADA</th>
                            <th>NOMOR SURAT/TANGGAL/PERIHAL</th>
                            <th>STATUS</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($suker as $s) { ?>
                            <tr>
                                <td class="col-4">

                                    <?php if ($s['id_sur'] !== $s['id_surat']) { ?>
                                        <p>
                                            <span><button class="badge btn-primary" data-toggle="modal" data-target="#id_sendtoarray<?= $s['id_surat'] ?>"><i class="fas fa-share"></i> Kirim Ke PTS</button></span>
                                        </p>
                                        <p>
                                            <button class="badge btn-primary" data-toggle="modal" data-target="#id_sendtogrup<?= $s['id_surat'] ?>"><i class="fas fa-share"></i> Kirim Ke Wilayah PTS</button>
                                        </p>

                                    <?php } elseif ($s['id_sur'] === $s['id_surat'] && !empty($s['id_template_wil'])) { ?>
                                        <a type="button" class="badge badge-success"><i class="fas fa-check"></i><i class="fas fa-check"></i> Dikirim Ke PTS</a>
                                    <?php } elseif ($s['id_sur'] === $s['id_surat'] && !empty($s['id_wilayah'])) { ?>
                                        <a type="button" class="badge badge-success"><i class="fas fa-check"></i><i class="fas fa-check"></i> Dikirim Ke Wilayah PTS</a>
                                    <?php } ?>
                                </td>

                                <td class="col-5">
                                    <p><i class="fas fa-envelope"></i> <?= $s['nomor_surat'] ?><span class="float-right"><?= $s['tgl_surat'] ?></span></p>
                                    <p><?= $s['perihal']; ?>
                                        <span class="float-right">
                                            <?php if ($s['stts_confirm'] == 1) { ?>
                                                <a type="button" class="badge btn-success">
                                                    <i class="fas fa-success"></i> Terkirim
                                                </a>
                                            <?php } else { ?>
                                                <a type="button" class="badge btn-danger">
                                                    <i class="fas fa-times"></i> Dipending
                                                </a>
                                            <?php } ?>
                                        </span>
                                    </p>
                                </td>

                                <td class="col-5">
                                    <div class="progress">
                                        <?php if (!empty($s['dilihat_oleh'])) { ?>
                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" data-toggle="tooltip" data-placement="top" data-original-title="DIBACA" style="width: 100%">
                                                <i class="fa fa-eye"></i>
                                            </div>
                                        <?php } elseif ($s['stts_confirm'] == '2') { ?>
                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" data-toggle="tooltip" data-placement="top" data-original-title="PENDING" style="width: 25%">
                                                <i class="fa fa-clock"></i>
                                            </div>
                                        <?php } else { ?>
                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" data-toggle="tooltip" data-placement="top" data-original-title="Proses" style="width: 10%">
                                                <i class="fa fa-random"></i>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </td>

                                <td>
                                    <?php if ($s['created_by'] != idUser()) { ?>
                                        <a type="button" data-toggle="modal" class="badge btn-success btn-lihat" data-target="#detailModal<?= $s['id_surat']; ?>" data-id="<?= $s['id_surat']; ?>"><i class="fas fa-eye"></i> Lihat</a>

                                    <?php } else { ?>
                                        <a type="button" data-toggle="modal" class="badge btn-success" data-target="#detailModal<?= $s['id_surat']; ?>"><i class="fas fa-eye"></i> Lihat</a>
                                        <?php if ($s['id_status'] == 0) : ?>
                                            <a href="<?= base_url('formUbahSukerl/' . $s['id_surat']); ?>" class="badge badge-warning"><i class="fas fa-edit"></i> Ubah Surat</a>
                                        <?php endif ?>
                                    <?php } ?>

                                    <a type="button" data-toggle="modal" class="badge btn-success" data-target="#detailKirim<?= $s['id_surat']; ?>"><i class="fas fa-eye"></i> Lihat Riwayat Kirim</a>



                                    <?php if ($s['stts_confirm'] == 0) { ?>
                                        <?php if ($s['id_sur']) : ?>
                                            <a type="button" data-toggle="modal" class="badge btn-info" data-target="#konfirmasiKirim<?= $s['id_surat']; ?>">
                                                <i class="fas fa-clock"></i> Konfirmasi Kirim
                                            </a>
                                            <a href="<?= base_url('formUbahSukerl/' . $s['id_surat']); ?>" class="badge badge-warning"><i class="fas fa-edit"></i> Ubah Surat</a>
                                        <?php endif; ?>
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



<?php foreach ($suker as $s) : ?>
    <!-- Modal Tambah Menu -->
    <div class="modal fade" id="detailModal<?= $s['id_surat']; ?>" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Nomor Surat : <i class="fas fa-envelope"></i> <?= $s['nomor_surat']; ?></h5>

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
    <div class="modal fade" id="detailKirim<?= $s['id_surat']; ?>" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">PEMBACA : <i class="fas fa-envelope"></i> <?= $s['nomor_surat']; ?></h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">

                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">

                            <thead>
                                <tr>
                                    <th>PERIHAL</th>
                                    <th>DIBACA OLEH</th>
                                </tr>
                            </thead>
                            <tbody>



                                <tr>
                                    <td class="col-5">
                                        <p><?= $s['perihal']; ?></p>
                                    </td>
                                    <td class="col-5">
                                        <?php
                                        $dilihatOleh = json_decode($s['dilihat_oleh'], true); // Mengubah JSON menjadi array

                                        if (!empty($dilihatOleh)) {
                                            $uniquePengguna = array_unique($dilihatOleh);
                                            foreach ($uniquePengguna as $pengguna) {

                                                if ($pengguna) {
                                                    // Tampilkan nama_lengkap pengguna
                                                    echo '<i class="fas fa-eye"></i> ' . $pengguna;
                                                    echo '<br>';
                                                }
                                            }
                                        }
                                        ?>
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>


<?php foreach ($suker as $s) : ?>
    <!-- Modal Tambah Menu -->
    <div class="modal fade" id="id_sendtoarray<?= $s['id_surat']; ?>" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Surat Nomor: <i class="fas fa-envelope"></i> <?= $s['nomor_surat']; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <?php echo form_open('sendtoinst'); ?>
                        <input type="hidden" name="id_surat" id="idku" value="<?= $s['id_surat']; ?>">
                        <div class="row from-group">

                            <select name="daftarInstansi[]" id="daftarInstansi<?= $s['id_surat']; ?>" multiple>
                                <?php foreach ($instansii as $p) { ?>
                                    <option value="<?= $p['id_instansi']; ?>"><?= $p['nm_instansi']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row form-group">
                        <button class="btn btn-primary" type="submit" name="simpan">Kirim</button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>


<?php foreach ($suker as $s) : ?>
    <!-- Modal Tambah Menu -->
    <div class="modal fade" id="id_sendtogrup<?= $s['id_surat']; ?>" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Surat Nomor: <?= $s['nomor_surat']; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <?php echo form_open('sendtogrup'); ?>
                        <input type="hidden" name="id_surat" id="idku" value="<?= $s['id_surat']; ?>">
                        <div class="row from-group">
                            <select name="daftarWilayah[]" id="daftarWilayah<?= $s['id_surat']; ?>" multiple>
                                <?php foreach ($wilayah as $p) { ?>
                                    <option value="<?= $p['id_wilayah']; ?>"><?= $p['wilayah']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row form-group">
                        <button class="btn btn-primary" type="submit" name="simpan">Kirim</button>
                    </div>
                    <?php echo form_close(); ?>
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
                    <form action="<?= base_url('konfirKirim/' . $s['id_surat']); ?>" method="post">
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
    <?php foreach ($suker as $s) : ?>

        new MultiSelectTag('daftarInstansi<?= $s['id_surat']; ?>', {
            rounded: true,
            shadow: true,
            placeholder: 'Cari PTS',
            onChange: function(values) {
                console.log(values);
            }
        });
    <?php endforeach; ?>



    <?php foreach ($suker as $s) : ?>

        new MultiSelectTag('daftarWilayah<?= $s['id_surat']; ?>', {
            rounded: true,
            shadow: true,
            placeholder: 'Cari Wilayah',
            onChange: function(values) {
                console.log(values);
            }
        });
    <?php endforeach; ?>



    <?php foreach ($suker as $s) : ?>
        $('#id_sendtoarray button[name="simpan"]').click(function(e) {
            e.preventDefault();
            var daftarInstansi = $('#daftarInstansi<?= $s['id_surat']; ?>').val();

            $.ajax({
                url: 'sendtoinst',
                type: 'POST',
                data: {
                    daftarInstansi: daftarInstansi
                },
                success: function(response) {
                    console.log(response.daftarInstansi);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
            // location.reload();
        });
    <?php endforeach; ?>


    <?php foreach ($suker as $s) : ?>
        $('#ubah_sendtoarray button[name="simpan"]').click(function(e) {
            e.preventDefault();
            var daftarInstansi = $('#daftarInstansi<?= $s['id_surat']; ?>').val();

            $.ajax({
                url: 'ubahtoinst',
                type: 'POST',
                data: {
                    daftarInstansi: daftarInstansi
                },
                success: function(response) {
                    console.log(response.daftarInstansi);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
            // location.reload();
        });
    <?php endforeach; ?>


    <?php foreach ($suker as $s) : ?>
        $('#id_sendtogrup button[name="simpan"]').click(function(e) {
            e.preventDefault();
            var daftarWilayah = $('#daftarWilayah<?= $s['id_surat']; ?>').val();
            $.ajax({
                url: 'sendtogrup',
                type: 'POST',
                data: {
                    daftarWilayah: daftarWilayah
                },
                success: function(response) {},
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
            // location.reload();
        });
    <?php endforeach; ?>

    <?php foreach ($suker as $s) : ?>
        $('#ubah_sendtogrup button[name="simpan"]').click(function(e) {
            e.preventDefault();
            var daftarWilayah = $('#daftarWilayah<?= $s['id_surat']; ?>').val();
            $.ajax({
                url: 'ubahtogrup',
                type: 'POST',
                data: {
                    daftarWilayah: daftarWilayah
                },
                success: function(response) {},
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
            // location.reload();
        });
    <?php endforeach; ?>
</script>



<script>
    $(document).ready(function() {
        $('.btn-lihat').click(function() {
            var idSurat = $(this).data('id');
            $.ajax({
                url: '<?= base_url('dilihatoleh/'); ?>' + idSurat,
                type: 'POST',
                success: function(response) {

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




<?= $this->endSection(); ?>