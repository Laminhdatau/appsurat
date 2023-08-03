<?= $this->extend('layout/v_apk/template'); ?>

<?= $this->section('content'); ?>
<style>
    .row {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .form-check {
        flex-basis: 24%;
        /* Atur lebar checkbox di sini */
        padding: 1px;
        /* Atur jarak antar checkbox di sini */
    }
</style>


<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Surat Masuk</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">


                <?php


                if (session()->has('success')) : ?>
                    <div class="success">
                        <?= session()->get('success') ?>
                    </div>
                <?php endif; ?>

                <?php if (session()->has('error')) : ?>
                    <div class="error">
                        <?= session()->get('error') ?>
                    </div>
                <?php endif; ?>

                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">

                    <thead>
                        <tr>
                            <th>PENGIRIM</th>
                            <th>NOMOR SURAT/TANGGAL</th>
                            <th>DISPOSISI</th>
                            <th class="col-3">STATUS</th>
                            <th class="col-1">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sumas as $s) {

                            $status = $s['id_status'];
                            if ($status) {
                                $statusArray = explode(',', $status);
                            } else {
                                $statusArray = [];
                            }
                        ?>

                            <tr>
                                <td class="col-2">
                                    <p><?= $s['dari']; ?></p>
                                </td>

                                <td class="col-3">
                                    <p><?= $s['nomor_surat'] ?><span class="float-right"><?= $s['tgl_surat'] ?></span></p>

                                </td>
                                <td class="col-3">
                                    <div>
                                        <?php
                                        $disposisiFound = false;
                                        if (!empty($disposll)) {
                                            foreach ($disposll as $dis) {
                                                if ($s['id_surat'] == $dis['id_surat_dispos']) {
                                                    echo "<p>" . $dis['nama_lengkap'] . "</p>";
                                                    echo "<p class='text-success'>" . $dis['tanggal_disposisi'] . "</p>";
                                                    $disposisiFound = true;
                                                    break;
                                                }
                                            }
                                        }
                                        if (!$disposisiFound) {
                                            echo "<p>Tidak Di disposisi</p>";
                                        }
                                        ?>

                                    </div>
                                </td>
                                <td class="col-3 text-center">
                                    <ul id="progressbar">
                                        <li id="proses" data-id="<?= $s['id_surat']; ?>" data-toggle="tooltip" title="Proses"><a></a></li>
                                        <li id="disposisi" data-id="<?= $s['id_surat']; ?>" data-toggle="tooltip" title="Disposisi"><a></a></li>
                                        <li id="diteruskan" data-id="<?= $s['id_surat']; ?>" data-toggle="tooltip" title="Diteruskan"><a></a></li>
                                        <li id="dilaporkan" data-id="<?= $s['id_surat']; ?>" data-toggle="tooltip" title="Dilaporkan"><a></a></li>
                                    </ul>
                                </td>

                                <td class="col-1">
                                    <?php if (in_array('8', $statusArray)) : ?>
                                        <a type="button" data-toggle="modal" data-target="#detailModal<?= $s['id_surat']; ?>" class="badge btn-success btn-lihat" data-id="<?= $s['id_surat']; ?>"><i class="fas fa-eye"></i> Lihat</a>
                                        <?php if (!$disposisiFound) { ?>
                                                <a type="button" class="badge btn-success btn-konfirmasi" data-id="<?= $s['id_surat']; ?>"><i class="fas fa-check"></i> Konfirmasi</a>
                                            <a type="button" id="btn-disposisi" class="badge badge-primary" data-target="#disposisi<?= $s['id_surat']; ?>" data-toggle="modal"><i class="fas fa-share"></i> Disposisi</a>
                                        <?php }  ?>
                                    <?php elseif (in_array('10', $statusArray)) : ?>
                                        <a type="button" data-toggle="modal" class="badge btn-success btn-lihat" data-target="#detailModal<?= $s['id_surat']; ?>" data-id="<?= $s['id_surat']; ?>"><i class="fas fa-eye"></i> Lihat</a>
                                    <?php elseif (in_array('11', $statusArray)) : ?>
                                        <a type="button" data-toggle="modal" class="badge btn-success btn-lihat" data-target="#detailModal<?= $s['id_surat']; ?>" data-id="<?= $s['id_surat']; ?>"><i class="fas fa-eye"></i> Lihat</a>

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


<?php foreach ($sumas as $s) : ?>
    <!-- Modal Tambah Menu -->
    <div class="modal fade" id="detailModal<?= $s['id_surat']; ?>" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">From : <?= $s['dari']; ?></h5> <br>||
                    <h5 class="modal-title" id="detailModalLabel">Nomor : <?= $s['nomor_surat']; ?></h5>
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




<?php foreach ($sumas as $s) : ?>
    <!-- Modal Tambah Menu -->
    <div class="modal fade" id="disposisi<?= $s['id_surat']; ?>" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content p-5">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Disposisi Surat Nomor: <?= $s['nomor_surat']; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <?php echo form_open('disposisill'); ?>
                        <input type="hidden" name="id_surat" id="idku" value="<?= $s['id_surat']; ?>">
                        <div class="row">
                            <select name="daftarpegawai[]" id="daftarpegawai<?= $s['id_surat']; ?>" multiple>
                                <?php foreach ($daftarPegawai as $p) { ?>
                                    <option value="<?= $p['id_pegawai']; ?>"><?= $p['nama_lengkap']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="row mx-auto ml-7">
                            <?php $counter = 0; ?>
                            <?php foreach ($instruksi as $in) { ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="instruksi[]" value="<?= $in['id_instruksi']; ?>" id="<?= $in['id_instruksi']; ?>">
                                    <label class="form-check-label" for="<?= $in['id_instruksi']; ?>">
                                        <?= $in['instruksi']; ?>
                                    </label>
                                </div>
                                <?php $counter++; ?>
                                <?php if ($counter % 3 == 0) { ?>
                        </div>
                        <div class="row mx-auto ml-6">
                        <?php } ?>
                    <?php } ?>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit" name="simpan">Disposisi</button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>




<script>
    <?php foreach ($sumas as $s) : ?>

        new MultiSelectTag('daftarpegawai<?= $s['id_surat']; ?>', {
            rounded: true,
            shadow: true,
            placeholder: 'Search',
            onChange: function(values) {
                console.log(values);
            }
        });
    <?php endforeach; ?>

    $('#disposisi button[name="simpan"]').click(function(e) {
        e.preventDefault();
        var daftarpegawai = $('#daftarpegawai').val();
        var instruksi = $('input[name="instruksi[]"]:checked').map(function() {
            return $(this).val();
        }).get();


        $.ajax({
            url: '<?= base_url('disposisill'); ?>',
            type: 'POST',
            data: {
                daftarpegawai: daftarpegawai,
                instruksi: instruksi
            },
            success: function(response) {
                console.log(response.daftarpegawai);
                console.log(response.instruksi);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
        location.reload();
    });
</script>



<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script>
    $(document).ready(function() {
        // Fungsi untuk menangani klik tombol konfirmasi
        $('.btn-konfirmasi').click(function() {
            var idSurat = $(this).data('id');
            var button = $(this);

            // Kirim permintaan AJAX ke server
            $.ajax({
                url: '<?= base_url('konfirmasi/') ?>',
                type: 'post',
                data: {
                    id_surat: idSurat
                },
                success: function(response) {
                    console.log(response);
                    button.removeClass('badge btn-success').addClass('badge btn-dark');
                    button.html('<i class="fas fa-check"></i> Terkonfirmasi');
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    // Tampilkan pesan kesalahan jika ada
                    console.log('Terjadi kesalahan. Silakan coba lagi.');
                }

            });
            location.reload();

        });
    });
</script>



<script>
    $(document).ready(function() {
        // Fungsi untuk menangani klik tombol "Lihat"
        $('.btn-lihat').click(function() {
            var idSurat = $(this).data('id');
            $.ajax({
                url: '<?= base_url('dilihatolehl/'); ?>' + idSurat,
                type: 'POST',
                success: function(response) {
                    console.log(idSurat); // Tampilkan pesan sukses pada konsol

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
    <?php foreach ($sumas as $s) : ?>
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
                var idSurat = "<?= $s['id_surat'] ?>";
                var curStep = <?= json_encode($statusArray); ?>;
                var active = <?= $s['is_active'] ?>;

                console.log(idSurat);
                console.log(curStep);
                console.log(active);
                setProgressBar(curStep, idSurat, active);
            });

            function setProgressBar(curStep, idSurat, active) {

                if (active === 0 || active === 1 || curStep.includes('4')) {
                    $("#proses[data-id='" + idSurat + "']").addClass("active");
                }
                if (curStep.includes('11')) {
                    $("#disposisi[data-id='" + idSurat + "']").addClass("active");
                }
                if (curStep.includes('6')) {
                    $("#diteruskan[data-id='" + idSurat + "']").addClass("active");
                }
                if (curStep.includes('7')) {
                    $("#dilaporkan[data-id='" + idSurat + "']").addClass("active");
                }
            }

        });
    <?php endforeach; ?>
</script>




<?= $this->endSection(); ?>