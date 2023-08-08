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
                                <form class="user" method="post" action="<?= url_to('login') ?>"><?= csrf_field() ?>

                                    <?php if ($config->validFields === ['email']) : ?>

                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.email') ?>">
                                            <div class="invalid-feedback">
                                                <?= session('errors.login'); ?>
                                            </div>
                                        </div>
                                    <?php else : ?>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.username') ?>">
                                            <div class="invalid-feedback">
                                                <?= session('errors.login'); ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" id="password" name="password" placeholder="<?= lang('Auth.password'); ?>">
                                    </div>

                                    <?php if ($config->allowRemembering) : ?>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" name="remembering" <?php if (old('remember')) : ?> checked <?php endif ?> class="custom-control-input">
                                                <label class="custom-control-label" for="customCheck">Remember Me</label>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        <?php lang('Auth.loginAction') ?> Masuk Aplikasi
                                    </button>

                                </form>
                                <hr>

                                <?php if ($config->activeResetter) : ?>
                                    <div class="text-center">
                                        <a href="<?= route_to('forgot'); ?>" class="small"><?= lang('Auth.forgotYourPassword'); ?></a>
                                    </div>
                                <?php endif; ?>

                                <?php if ($config->allowRegistration) : ?>
                                    <div class="text-center">
                                        <a href="<?= route_to('register'); ?>" class="small"><?= lang('Auth.needAnAccount') ?></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
<?= $this->endSection(); ?>