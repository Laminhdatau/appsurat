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

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #11009E;">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SISURAT</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="<?= base_url(); ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>


            <?php if (logged_in()) : ?>

                <?php if (in_groups('admdikti') || in_groups('pegl') || in_groups('sumin')) : ?>

                    <div class="sidebar-heading">Surat</div>
                    <hr class="sidebar-divider my-0">

                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('suratkeluarl'); ?>">
                            <i class="fas fa-fw fa-envelope"></i>
                            <span>Surat Keluar</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('suratmasukdis'); ?>">
                            <i class="fas fa-fw fa-envelope"></i>
                            <span>Disposisi Masuk</span>
                            <!-- <span class="badge float-right badge-danger" id="countDisposisi"></span> -->
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('surattugas'); ?>">
                            <i class="fas fa-fw fa-envelope"></i>
                            <span>Surat Tugas</span>
                            <!-- <span class="badge float-right badge-danger" id="countsurgas"></span> -->
                        </a>
                    </li>
                  
                <?php endif; ?>


                <?php if (in_groups('leadl')) : ?>
                    <div class="sidebar-heading">Surat</div>
                    <hr class="sidebar-divider my-0">

                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('suratmasukl'); ?>">
                            <i class="fas fa-fw fa-envelope"></i>
                            <span>Surat Masuk</span>
                            <!-- <span class="badge float-right badge-danger" id="countsumasl"></span> -->
                        </a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('surattugas'); ?>">
                            <i class="fas fa-fw fa-envelope"></i>
                            <span>Surat Tugas</span>
                            <!-- <span class="badge float-right badge-danger" id="countsurgas"></span> -->
                        </a>
                    </li>
                   
                <?php endif; ?>


                <?php if (in_groups('leadp')) : ?>
                    <div class="sidebar-heading">Surat</div>
                    <hr class="sidebar-divider my-0">

                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('suratmasukp'); ?>">
                            <i class="fas fa-fw fa-envelope"></i>
                            <span>Surat Masuk</span>
                            <!-- <span class="badge float-right badge-danger" id="countsumasp"></span> -->
                        </a>
                    </li>
                   
                <?php endif; ?>


                <?php if (in_groups('admpts')) : ?>
                    <div class="sidebar-heading">Surat</div>
                    <hr class="sidebar-divider my-0">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('suratmasukp'); ?>">
                            <i class="fas fa-fw fa-envelope"></i>
                            <span>Surat Masuk</span>
                            <!-- <span class="badge float-right badge-danger" id="countsumasp"></span> -->
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('suratkeluarp'); ?>">
                            <i class="fas fa-fw fa-envelope"></i>
                            <span>Surat Keluar</span>
                        </a>
                    </li>

                 
                <?php endif; ?>

                <div class="sidebar-heading">Logout</div>
                    <hr class="sidebar-divider my-0">

                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('logout'); ?>">
                            <i class="fas fa-fw fa-sign-out-alt"></i>
                            <span>Keluar</span>
                        </a>
                    </li>

            <?php endif; ?>
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

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
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>


    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script> -->
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->

    <!-- Page level plugins -->
    <!-- <script src="<?= base_url('assets/'); ?>vendor/datatables/jquery.dataTables.min.js"></script> -->
    <!-- <script src="<?= base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.min.js"></script> -->

    <!-- Page level custom scripts -->
    <!-- <script src="<?= base_url('assets/'); ?>js/demo/datatables-demo.js"></script> -->




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



    <!-- <script>
    $(document).ready(function() {
        $('#kodeajax').ready(function() {
            var kode = $(this).val();
            $.ajax({
                url: '<= base_url('getKodeSurat'); ?>', // Ganti dengan URL ke fungsi searchKodeSurat() di Controller Anda
                method: 'GET', // Metode permintaan harus sesuai dengan fungsi di Controller Anda
                dataType: 'json',
                data: {
                    keyword: kode
                },
                success: function(response) {
                    // Berikan data yang diterima ke elemen select yang sesuai
                    $('#kodeajax').empty(); // Kosongkan elemen select sebelum mengisi dengan opsi baru
                    $('#kodeajax').append('<option value="">--PILIH KODE SURAT--</option>');
                    $.each(response, function(index, data) {
                        $('#kodeajax').append('<option value="' + data.nomor_surat + '">' + data.nomor_surat + ' - ' + data.perihal + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); // Tampilkan pesan error jika permintaan gagal
                }
            });
        });

    });
    // Inisialisasi Select2 pada elemen select
    $('#kodeajax').select2({
        placeholder: "PILIH CARI",
        theme: "bootstrap-4"
    })
</script> -->

    <!-- <script>
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });



        $('.form-check-input').on('click', function() {
            const id_menu = $(this).data('menu');
            const id_level = $(this).data('level');

            $.ajax({
                url: "<= base_url('ubahAkses'); ?>",
                type: 'post',
                data: {
                    id_menu: id_menu,
                    id_level: id_level
                },
                success: function() {
                    document.location.href = "<= base_url('Akses'); ?>" + id_level;
                }
            });

        });
    </script> -->


    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->




</body>

</html>