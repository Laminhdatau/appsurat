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
                        <?php foreach ($suker as $s) {

                            $status = $s['id_status'];
                            $stArray = explode(',', $status);


                        ?>
                            <tr>
                                <td class="col-4">


                                    <?php if ($s['id_sur'] !== $s['id_surat'] || $s['id_sur'] === null | $s['stts_confirm'] === '2') : ?>
                                        <p>
                                            <button class="badge btn-primary" data-toggle="modal" data-target="#id_sendtoarray<?= $s['id_surat'] ?>"><i class="fas fa-share"></i> Kirim Ke Instansi <i class="fas fa-university"></i></button>
                                        </p>
                                        <p>
                                            <button class="badge btn-primary" data-toggle="modal" data-target="#id_sendtogrup<?= $s['id_surat'] ?>"><i class="fas fa-share"></i> Kirim Ke Wilayah PTS <i class="fas fa-map-marker"></i></button>
                                        </p>

                                    <?php elseif ($s['id_sur'] === $s['id_surat'] && !empty($s['id_template_wil'])) : ?>
                                        <?php if ($s['stts_confirm'] == '1') : ?>
                                            <a type="button" class="badge badge-success"><i class="fas fa-check"></i> Dikirim Ke PTS</a> <span class="float-right"><a type="button" data-toggle="modal" class="badge btn-info" data-target="#detailKirim<?= $s['id_surat']; ?>"><i class="fas fa-info"></i> Info</a></span>
                                        <?php elseif ($s['stts_confirm'] == '0') : ?>
                                            <a type="button" class="badge badge-info"><i class="fas fa-clock"></i> Proses Dikirim Ke PTS</a>
                                        <?php endif; ?>


                                    <?php elseif ($s['id_sur'] === $s['id_surat'] && !empty($s['id_wilayah'])) : ?>
                                        <?php if ($s['stts_confirm'] == '1') : ?>
                                            <a type="button" class="badge badge-success"><i class="fas fa-check"></i> Dikirim Ke Wilayah PTS</a> <span class="float-right"><a type="button" data-toggle="modal" class="badge btn-info" data-target="#detailKirim<?= $s['id_surat']; ?>"><i class="fas fa-info"></i> Info</a></span>
                                        <?php elseif ($s['stts_confirm'] == '0') : ?>
                                            <a type="button" class="badge badge-info"><i class="fas fa-clock"></i> Proses Dikirim Ke Wilayah</a>
                                        <?php endif; ?>
                                    <?php endif ?>


                                </td>

                                <td class="col-5">
                                    <p><i class="fas fa-envelope"></i> <?= $s['nomor_surat'] ?><span class="float-right"><?= $s['tgl_surat'] ?></span></p>
                                    <p><?= $s['perihal']; ?>

                                    </p>
                                </td>

                                <td class="col-5 text-center">
                                    <ul id="progressbar">
                                        <li id="proses" data-id="<?= $s['id_surat']; ?>" data-toggle="tooltip" title="Proses"><a></a></li>
                                        <li id="terkirim" data-id="<?= $s['id_surat']; ?>" data-toggle="tooltip" title="Terkirim"><a></a></li>
                                        <li id="dilihat" data-id="<?= $s['id_surat']; ?>" data-toggle="tooltip" title="Dilihat"><a></a></li>

                                    </ul>
                                </td>

                                <td>
                                    <?php if ($s['created_by'] != idUser()) { ?>
                                        <a type="button" data-toggle="modal" class="badge btn-success btn-lihat" data-target="#detailModal<?= $s['id_surat']; ?>" data-id="<?= $s['id_surat']; ?>"><i class="fas fa-eye"></i> Lihat</a>
                                    <?php } else { ?>
                                        <a type="button" data-toggle="modal" class="badge btn-success" data-target="#detailModal<?= $s['id_surat']; ?>"><i class="fas fa-eye"></i> Lihat</a>
                                        <?php if ($stArray == null) : ?>
                                            <a href="<?= base_url('formUbahSukerl/' . $s['id_surat']); ?>" class="badge badge-warning"><i class="fas fa-edit"></i> Ubah Surat</a>
                                            <button class="badge badge-danger" data-toggle="modal" data-target="#deleteSurat<?= $s['id_surat']; ?>"><i class="fas fa-trash"></i> Hapus</button>
                                        <?php endif ?>


                                        <?php if (!in_array('8',$stArray)) : ?>
                                            <a href="<?= base_url('formUbahSukerl/' . $s['id_surat']); ?>" class="badge badge-warning"><i class="fas fa-edit"></i> Ubah Surat</a>
                                            <button class="badge badge-danger" data-toggle="modal" data-target="#deleteSurat<?= $s['id_surat']; ?>"><i class="fas fa-trash"></i> Hapus</button>
                                        <?php endif ?>
                                    <?php } ?>


                                    <?php if ($s['id_sur'] && $s['stts_confirm'] == '0') : ?>
                                        <a type="button" data-toggle="modal" class="badge btn-info" data-target="#konfirmasiKirim<?= $s['id_surat']; ?>">
                                            <i class="fas fa-clock"></i> Konfirmasi Kirim
                                        </a>
                                    <?php endif; ?>


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
                    <form action="<?= base_url('hapusSuratl/' . $s['id_surat']); ?>" method="post">
                        <div class="">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
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