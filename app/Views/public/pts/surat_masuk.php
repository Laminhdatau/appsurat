<?= $this->extend('layout/v_apk/template'); ?>

<?= $this->section('content'); ?>



<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Surat Masuk</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">


                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">

                    <thead>
                        <tr>
                            <th>PENGIRIM</th>
                            <th>PERIHAL</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sumas as $s) : ?>


                            <tr>
                                <td class="col-4">
                                    <p><i class="fas fa-university"></i> <?= $s['dari']; ?></p>
                                </td>
                                <td class="col-5">
                                    <p><i class="fas fa-envelope"></i><?= $s['nomor_surat'] ?><span class="float-right"><i class="fas fa-calendar"></i><?= $s['tgl_surat'] ?></span></p>
                                    <p><?= $s['perihal']; ?></p>
                                </td>
                                <td>
                                    <a type="button" data-toggle="modal" data-target="#detailModal<?= $s['id_surat']; ?>" class="badge btn-success btn-lihat" data-id="<?= $s['id_surat']; ?>"><i class="fas fa-eye"></i> Lihat</a>
                                </td>

                            </tr>
                        <?php endforeach; ?>
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
                    <h5 class="modal-title" id="detailModalLabel">NOMOR SURAT : <?= $s['nomor_surat']; ?></h5>
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



<script>
    $(document).ready(function() {
        // Fungsi untuk menangani klik tombol "Lihat"
        $('.btn-lihat').click(function() {
            var idSurat = $(this).data('id');
            $.ajax({
                url: '<?= base_url('dilihatolehp/'); ?>' + idSurat,
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








<?= $this->endSection(); ?>