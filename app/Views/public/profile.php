<?= $this->extend('layout/v_apk/template'); ?>

<?= $this->section('content'); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper">
            <div id="content">
                <!-- Begin Page Content -->
                <div class="card col-6 p-3 mx-auto mt-5">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 bg-primary text-center">
                            <h2 class="m-0 font-weight-bold text-white">profile</h2>
                        </div>
                        <div class="card-body">
                            <div class="text-center text-black text-bold">

                               <?= dd($users); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Content -->
        </div>
        <!-- End of Content Wrapper -->

     
<?= $this->endSection(); ?>