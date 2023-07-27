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
</head>

<body id="page-top">
    <div id="wrapper" style="height: 100%; display: flex; flex-direction: column;">

        <!-- Content Wrapper -->
        <div id="content-wrapper">
            <div id="content">
                <!-- Begin Page Content -->
                <div class="card col-6 p-3 mx-auto mt-5">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 bg-primary text-center">
                            <h2 class="m-0 font-weight-bold text-white">Surat Perintah Tugas</h2>
                        </div>
                        <div class="card-body">
                            <div class="text-center text-black text-bold">

                                <?php if ($surgas) { ?>
                                    <p><span style="font-weight: bold;color: black;">Nomor Surat :</span> <?= $surgas->id_nomor_surat; ?></p>
                                    <p><span style="font-weight: bold;color: black;">Tanggal Surat :</span> <?= $tglterbit; ?></p>
                                    <p><span style="font-weight: bold;color: black;">Penanda Tangan :</span> <?= $surgas->penandatangan; ?> - <?= $surgas->jabatan; ?></p>
                                    <p><span style="font-weight: bold;color: black;">Perihal :</span> SPT - <span><?= $surgas->pegawaistring; ?> - <?= $surgas->tempat_pelaksanaan; ?></p></span>
                                    <p><span style="font-weight: bold;color: black;">Unit Kerja :</span> Lembaga Layanan Pendidikan Tinggi Wilayah XVI</p>
                                <?php } else { ?>
                                    <p><span style="font-weight: bold;color: black;">Nomor Surat :</span> </p>
                                    <p><span style="font-weight: bold;color: black;">Tanggal Surat :</span> </p>
                                    <p><span style="font-weight: bold;color: black;">Penanda Tanganan :</span> </p>
                                    <p><span style="font-weight: bold;color: black;">Perihal :</span> </p>
                                    <p><span style="font-weight: bold;color: black;">Unit Kerja :</span> Lembaga Layanan Pendidikan Tinggi WIlayah XVI</p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Content -->
        </div>
        <!-- End of Content Wrapper -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white my-auto">
            <div class="container text-center">
                <b>Created by the internship team at Poltekgo. @Since 2023</b>
            </div>
        </footer>
        <!-- End of Footer -->
    </div>
    <!-- End of Wrapper -->

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?= base_url('assets/'); ?>vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?= base_url('assets/'); ?>js/demo/datatables-demo.js"></script>
</body>

</html>