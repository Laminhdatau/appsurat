<?= $this->extend('layout/v_apk/template'); ?>

<?= $this->section('content'); ?>

<div class="container float-left">
    
    <div class="card" style="width: 20rem; ">
        <img class="card-img-top" src="<?= base_url('assets/img/'.$users->user_image); ?>" alt="image" style="width: 200px;">
        <div class="card-body">
            <h5 class="card-title">My Profile</h5>
            <p class="card-text"><?= $users->nama_lengkap; ?></p>
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
    </div>
</div>



<?= $this->endSection(); ?>