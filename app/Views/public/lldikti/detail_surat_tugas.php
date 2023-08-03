<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <style>
        /* Add custom table style */
        .table {
            border-collapse: collapse;
            width: 100%;
        }

        .table th,
        .table td {
            border: 1px solid black;
            padding: 8px;
        }


        body {
            /* border: 3px solid #000; */
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo {
            width: 100px;
            height: 100px;

        }


        .kementerian {
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
        }

        .sidebar-divider {
            border-top: 3px solid #000;
            margin-bottom: 20px;
        }

        .content {
            margin-bottom: 40px;
        }

        .judul-surat {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .tabel {
            width: 100%;
            border-collapse: collapse;
        }

        .tabel th,
        .tabel td {
            border: 2px solid black;
            padding: 8px;
        }

        .penanda-tangan {
            margin-top: 40px;
            text-align: right;
        }



        .footer {
            text-align: center;
            font-size: 12px;
            color: #777;
        }

        .text-center {
            text-align: center;
        }

        .no-margin {
            margin: 0;
        }

        .rangkasurat {
            width: auto;
            margin: 0 auto;
            background-color: #fff;
            padding: 1px;
        }

        .tengah {
            text-align: center;
            line-height: 20px;
        }

        .penanda-tangan {
            position: absolute;
            right: 55;
            text-align: left;
        }

        .penanda-tangan .gambar-qrcode {
            right: 55;
            text-align: left;
            position: absolute;

        }


        .tembusan {
            bottom: 2%;
            position: absolute;
        }

        .gambar-qrcode img {
            width: 40%;
        }

        .gambar-qrcode img {
            z-index: -1;
        }

        .gambar-qrcode img {
            position: relative;
            right: 5;
            padding-bottom: 50%;
        }

        .text-kecil {
            font-size: small;
        }

        .text-kecill {
            font-size: xx-small;
        }

        li {
            list-style-type: decimal;
        }

        .huruf-arial {
            font-family: 'Times New Roman';
            font-weight: normal;
        }




        /* 



        th>#dasar {
            position: absolute;
            top: 0;
            left: 0;
            text-align: left;
            border: 1px solid black;
            width: 60px;

            padding: 0px 5px 0px;
        }
        td>#dasar {
            position: absolute;
            top: 0;
            left: 0;
            text-align: left;
            border: 1px solid black;
            width: 60px;

            padding: 0px 5px 0px;
        } */
    </style>


</head>

<body id="page-top">
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div class="container-fluid">

                    <div class="rangkasurat">
                        <table width="100%">
                            <tr>
                                <td> <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 130px;" src="<?= $kopgambar; ?>"></td>
                                <td class="tengah">
                                    <h2 class="mb-4 no-margin huruf-arial"><?= $kopr['head']; ?></h2>
                                    <h2 class="mb-4 no-margin"><b><?= $kopr['sub_head']; ?></b></h2>
                                    <p class="no-margin text-kecil"><?= $kopr['lokasi']; ?></p>
                                    <p class="no-margin text-kecil"><?= $kopr['alamat_jl']; ?></p>
                                    <p class="no-margin text-kecill">Laman: <a href="<?= $kopr['laman']; ?>"><?= $kopr['laman']; ?></a> Email: <a href="<?= $kopr['email']; ?>"><?= $kopr['email']; ?></a> - Helpdesk WA: <?= $kopr['helpdesk_wa']; ?></p>
                                </td>
                            </tr>
                        </table>
                        <hr class="sidebar-divider">
                    </div>

                    <div class="content">


                        <h3 class="text-gray-800 text-center no-margin">Surat Perintah Tugas</h3>
                        <p class="text-gray-800 text-center no-margin">Nomor <?= $surgas->id_nomor_surat; ?></p>

                        <?php
                        $dasarText = $surgas->dasar;
                        $dasarArray = explode("<br>", $dasarText);
                        ?>
                        <!-- <table class="table-bordered kolom10">
                            <thead>
                                <th id="dasar">Dasar : </th>
                                <td id="isidasar"> -->
                        <div class=""> Dasar : <?php if (count($dasarArray) > 1) : ?>
                                <ul>
                                    <?php foreach ($dasarArray as $item) : ?>
                                        <li>
                                            <?= $item; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else : ?>
                                <?= $surgas->dasar; ?>
                            <?php endif; ?>
                        </div>

                        <!-- </td>
                            </thead>
                        </table> -->


                        <p>Kepala Lembaga Layanan Pendidikan Tinggi (LLDIKTI) Wilayah XVI menugaskan kepada: </p>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama,NIP</th>
                                        <th>Pangkat / Gol.</th>
                                        <th>Jabatan</th>
                                        <th>Ket</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($tpegawai as $p) { ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $p['namap']; ?><br><?= $p['nipp']; ?></td>
                                            <td><?= $p['pangkatp']; ?> , <?= $p['golonganp']; ?></td>
                                            <td><?= $p['jabatanp']; ?></td>
                                            <td></td>
                                        </tr>
                                    <?php } ?>
                                    <!-- Add more rows as needed -->
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <p>Dalam rangka <?= $surgas->tujuan_surat; ?> tanggal <?= $tglmulai; ?> - <?= $tglselesai; ?> di <?= $surgas->tempat_pelaksanaan; ?></p>
                        <p>Demikian surat tugas ini diberikan kepada yang bersangkutan untuk dilaksanakan dengan penuh
                            rasa tanggung jawab.</p>
                        <div class="penanda-tangan">
                            <p class="no-margin">Gorontalo, <?= $tglttd; ?></p>
                            <p class="no-margin"><b>Kepala,</b></p><br>
                            <p class="gambar-qrcode no-margin"><img src="<?= $ttel; ?>"></p>
                            <br>
                            <br>
                            <br>
                            <br>
                            <p class="no-margin"><b><?= $tte->nama_penanda; ?></b></p>
                            <p class="no-margin">NIP. <?= $tte->np; ?></p>
                        </div>
                        <?php if (!empty($surgas->tembusan)) { ?>
                            <div class="tembusan">
                                Tembusan:
                                <ul>
                                    <li><?= $surgas->tembusan; ?></li>
                                </ul>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Content Wrapper -->


    </div>
    <!-- End of Wrapper -->



</body>

</html>