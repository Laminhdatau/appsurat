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
            <h6 class="m-0 font-weight-bold text-primary">Surat Masuk Disposisi</h6>
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
                            <th>Sifat</th>
                            <th>Nomor Surat/Tgl/Tembusan</th>
                            <th>Instruksi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sumas as $s) : ?>


                            <tr>
                                <td class="col-4">
                                    <p><?= $s['sifat']; ?></p>
                                </td>
                                <td class="col-5">
                                    <p><?= $s['nomor_surat'] ?><span class="float-right"><?= $s['tgl_surat'] ?></span></p>
                                    <p><?= $s['tembusan']; ?></p>
                                </td>
                                <td class="col-5">

                                    <p><?= $s['instruksi']; ?></p>
                                </td>

                                <td>
                                    <?php if ($s['id_status'] == '11') : ?>
                                        <a type="button" class="badge btn-success btn-konfirmasi" data-id="<?= $s['id_surat']; ?>"><i class="fas fa-check"></i> Konfirmasi</a>
                                    <?php elseif ($s['id_status'] == '10') : ?>
                                        <a type="button" class="badge btn-dark"><i class="fas fa-check"></i> Terkonfirmasi</a>
                                    <?php endif; ?>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>



            </div>
        </div>
    </div>

</div>


<script>
    $(document).ready(function() {
        // Fungsi untuk menangani klik tombol konfirmasi
        $('.btn-konfirmasi').click(function() {
            var idSurat = $(this).data('id');
            var button = $(this);

            // Kirim permintaan AJAX ke server
            $.ajax({
                url: '<?= base_url('konfirmasidis/') ?>',
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
                    console.log('Terjadi kesalahan. Silakan coba lagi.');
                }

            });
            location.reload();
        });
    });
</script>

<?= $this->endSection(); ?>