<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?= $title; ?></title>


    <!-- Custom fonts for this template -->
    <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="<?= base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- <link rel="icon" href="<= base_url('favicon.ico'); ?>" sizes="32x32" /> -->


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>



    <link rel="stylesheet" href="<?= base_url('assets/library/'); ?>multi-select-tag.css">
    <script src="<?= base_url('assets/library/'); ?>multi-select-tag.js"></script>
    <script src="<?= base_url('assets/library/ckeditor5/ckeditor.js'); ?>"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <?php $verifikator = verifikator();
                    if ($verifikator) {
                        $url = base_url('surattugas/');
                        $jumlah = $verifikator->jum_surat;
                    } else {
                        $url = '#';
                        $jumlah = null;
                    }
                    ?>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="far fa-bell"></i>
                                <span class="badge badge-danger navbar-badge"><?= $jumlah; ?></span>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">


                                <span class="dropdown-item dropdown-header">2 Pemberitahuan</span>
                                <!-- <div class="dropdown-divider"></div> -->
                                <!-- <a href="<= $url; ?>" class="dropdown-item">
                                    <i class="fas fa-envelope mr-2"></i> 1 Surat Masuk
                                    <span class="float-right text-muted text-sm">3 mins</span>
                                </a> -->

                                <?php if ($jumlah != null) { ?>
                                    <div class="dropdown-divider"></div>
                                    <a href="" class="dropdown-item">
                                        <i class="fas fa-users mr-2"></i> <?= $jumlah; ?> Meminta Verifikasi SPT
                                        <span class="float-right text-muted text-sm">12 hours</span>
                                    </a>
                                <?php } ?>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item dropdown-footer">Lihat Semua</a>
                            </div>
                        </li>


                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?php
                                    if (empty(dataPersonal()->nama_lengkap)) {
                                        $nama = user()->username;
                                    } else {
                                        $nama = dataPersonal()->nama_lengkap;
                                    }
                                    ?>
                                    <?= $nama; ?>
                                </span>
                                <img class="img-profile rounded-circle" src="<?= base_url('assets/img/'); ?><?= user()->user_image; ?>" width="50%">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?= base_url('profile'); ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>

                                <div class="dropdown-divider"></div>
                                <?php if (logged_in()) : ?>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                <?php else : ?>
                                    <a class="dropdown-item" href="<?= base_url('login'); ?>">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Login
                                    </a>
                                <?php endif; ?>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->


                <?= $this->renderSection('content'); ?>

            </div>
            <!-- End of Main Content -->
            <!-- footer -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <b>Created by the internship team at Poltekgo.</b>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="<?= base_url('assets/'); ?>#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Dengan Memilih Ya Anda Akan Keluar Dari Aplikasi</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-danger" href="<?= base_url('logout'); ?>">Ya</a>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Profile</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="row">
                            INI PROFILE
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <button class="btn btn-secondary" type="submit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
    </div>







    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>


    <!-- Tambahkan JavaScript untuk mengirim permintaan Ajax dan memperbarui angka notifikasi -->
    <script>
        function getCountNotifikasi() {
            $.ajax({
                url: '<?= base_url('notif'); ?>',
                type: 'GET',
                success: function(response) {
                    console.log(response);
                    $('#countsumasp').text(response);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }



        $(document).ready(function() {
            getCountNotifikasi();

            $('#countsumasp').click(function() {
                resetNotifikasi();
            });
        });
    </script>


</body>

</html>