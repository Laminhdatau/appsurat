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
                                   
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>



            </div>
        </div>
    </div>

</div>



<?= $this->endSection(); ?>