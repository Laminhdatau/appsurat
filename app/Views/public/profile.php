<?= $this->extend('layout/v_apk/formtemp'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid bg-light py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <form action="<?= base_url('changeProfile/' . idUser() . '/' . idPegawai()); ?>" method="post" enctype="multipart/form-data">
                    <div class="text-center">
                        <label for="user_image">
                            <img class="card-img-top mx-auto mt-4 rounded-circle" id="profileImage" src="<?= base_url('assets/img/' . $users['user_image']); ?>" alt="Profile Image" style="width: 150px; height: 150px; cursor: pointer;">
                            <input type="file" name="user_image" id="user_image" style="display: none;">
                        </label>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="nama_lengkap">Username</label>
                            <input type="text" name="username" class="form-control" value="<?= $users['username']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="nama_lengkap">Email</label>
                            <input type="text" name="email" class="form-control" value="<?= $users['email']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="nama_lengkap">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="form-control" value="<?= $users['nama_lengkap']; ?>">
                        </div>
                        <div class="text-center">
                            <a href="<?= base_url(); ?>" type="button" class="btn btn-dark">Kembali</a>
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </div>
                </form>
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