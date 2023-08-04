<?= $this->extend('layout/v_apk/formtemp'); ?>

<?= $this->section('content'); ?>

    <div class="container d-flex justify-content-center">
        <h1 class="display-4">Edit Profile</h1>
        <form action="<?= base_url('profile/update'); ?>" method="post">
            <div class="card" style="width: 50rem;">
                <img class="card-img-top" src="<?= base_url('assets/img/' . user()->user_image); ?>" alt="image" style="width: 200px;">
                <div class="card-body">
                    <h5 class="card-title">My Profile</h5>
                    <input type="text" name="nama_lengkap" class="form-control" value="<?= $users->nama_lengkap; ?>">
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><?= $users->username; ?></li>
                    <li class="list-group-item"><?= $users->ket_level; ?></li>
                    <li class="list-group-item">Vestibulum at eros</li>
                </ul>
                <div class="card-body">
                    <a href="#" class="card-link">Card link</a>
                    <a href="#" class="card-link">Another link</a>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>

<?= $this->endSection(); ?>
