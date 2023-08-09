<?= $this->extend('layout/v_apk/formtemp'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid bg-light py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <?= form_open('change-password') ?>



                <div class="card-body">

                    <?= view('Myth\Auth\Views\_message_block') ?>

                    <div>
                        <?= form_label('Old Password', 'old_password') ?>
                        <?= form_password('old_password', set_value('old_password'), ['class' => 'form-control']) ?>
                    </div>

                    <div>
                        <?= form_label('New Password', 'new_password') ?>
                        <?= form_password('new_password', set_value('new_password'), ['class' => 'form-control']) ?>
                    </div>

                    <div>
                        <?= form_label('Confirm Password', 'confirm_password') ?>
                        <?= form_password('confirm_password', set_value('confirm_password'), ['class' => 'form-control']) ?>
                    </div>

                    <button type="submit">Change Password</button>

                </div>
            </div>
        </div>
    </div>
</div>


<script>
    // Attach click event to the profile image to trigger file input click
    document.getElementById('profileImage').addEventListener('click', function() {
        document.getElementById('user_image').click();
    });
</script>

<?= $this->endSection(); ?>