<?= $this->extend('layout/v_auth/template.php'); ?>
<?= $this->section('content'); ?>
<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-lg-7">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900">PETRO<span class="font-weight-bold">DIKTI</span></h1>
                                    <h1 class="h5 text-gray-900 mb-2">Persuratan Elektronik LLDIKTI</h1>
                                    <h1 class="h6 text-gray-900 mb-7">Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi</h1>
                                </div>
                                <?= view('Myth\Auth\Views\_message_block') ?>

                                <p><?= lang('Auth.enterEmailForInstructions') ?></p>

                                <form action="<?= url_to('forgot') ?>" method="post">
                                    <?= csrf_field() ?>




                                    <div class="form-group">
                                        <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>">
                                        <div class="invalid-feedback">
                                            <?= session('errors.email') ?>
                                        </div>
                                    </div>



                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        <?= lang('Auth.resetPassword') ?>
                                    </button>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
<?= $this->endSection(); ?>