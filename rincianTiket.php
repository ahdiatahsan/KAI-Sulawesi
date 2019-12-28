<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="./img/tab_img.png">
    <link rel="stylesheet" href="./asset/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./asset/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>Reservasi Tiket KAI</title>
</head>
<body>

<!--todo navbar-->
<nav class="navbar navbar-dark bg-primary" id="navbar">
    <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#navbarResponsive"
            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"></button>
    <div class="collapse navbar-toggleable-md" id="navbarResponsive">
        <a class="navbar-brand hidden-sm-down hidden-md-down" href="./index.php"><img src="./img/logo1.png" style="width: 100%;"></a>
        <ul class="nav navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="./index.php"><b>Booking Tiket</b> <span class="sr-only"></span></a>
            </li>
        </ul>
    </div>
</nav>

<!--todo container-->

<div class="container">
    <div class="row">
        <?php
        include "./config/koneksi.php";
        if (!empty($_POST['idTiket'])) {


            $idTiket = $_POST['idTiket'];
            $namaPemesan = $_POST['namaPemesan'];
            $alamat = $_POST['alamat'];
            $nomorTelp = $_POST['nomorTelp'];
            $email = $_POST['email'];
            $jmlDewasa = $_POST['jmlDewasa'];
            $jmlAnak = $_POST['jmlAnak'];
            $idKA = $_POST['idKA'];
            $kodePembayaran = $_POST['kodePembayaran'];
            $harga = $_POST['harga'];

            $namaKA = $_POST['namaKA'];
            $tglBerangkat = $_POST['tglBerangkat'];
            $jamBerangkat = $_POST['jamBerangkat'];
            $tglTiba = $_POST['tglTiba'];
            $jamTiba = $_POST['jamTiba'];
            $stasiunAsal = $_POST['stasiunAsal'];
            $stasiunTujuan = $_POST['stasiunTujuan'];
            $kelas = $_POST['kelas'];
            $harga = $_POST['harga'];

            mysqli_query($koneksi, "INSERT INTO pesan_tiket VALUES ('$idTiket', '$namaPemesan', '$alamat', '$nomorTelp', '$email', '$jmlDewasa', '$jmlAnak', '$idKA','$kodePembayaran',CURRENT_TIMESTAMP ,DEFAULT )");
            $sql = mysqli_query($koneksi, "SELECT * FROM kereta JOIN kelas on kereta.id_kelas = kelas.id_kelas");
            $sqlwaktu = mysqli_query($koneksi, "SELECT DATE_ADD(`waktu_booking`, INTERVAL 1 HOUR ) AS waktuBayar FROM pesan_tiket WHERE `id_tiket` = '$idTiket'");

            $row = mysqli_fetch_assoc($sql);

        } else {
            header("location:./index.php");
        }

        // Delete
        if (isset($_GET['idTiket'])) {
            $idTiket = $_GET['idTiket'];
            $sql = mysqli_query($koneksi, "DELETE FROM pesan_tiket WHERE id_tiket = '$idTiket'");

            if ($koneksi->connect_errno) {
                echo "Koneksi Error";
            } else {
                header("location:./index.php");
            }
        }
        ?>
        <h2 class="text-lg-center text-md-center text-sm-center text-xs-center" style="margin-top: 10px">
            Informasi Reservasi Kereta Api
        </h2>
        <div class="table-responsive">
            <table class="table table-bordered" style="margin-top: 5px; background-color: white">
                <thead>
                <tr>
                    <th class="text-lg-center text-md-center">Kereta</th>
                    <th class="text-lg-center text-md-center">Jadwal Berangkat</th>
                    <th class="text-lg-center text-md-center">Jadwal Tiba</th>
                    <th class="text-lg-center text-md-center">Stasiun Asal</th>
                    <th class="text-lg-center text-md-center">Stasiun Tujuan</th>
                    <th class="text-lg-center text-md-center">Kelas (Harga)</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><i class="fa fa-train"></i> <?php echo $namaKA; ?></td>
                    <td><i class="fa fa-calendar"></i> <?php echo $tglBerangkat; ?></td>
                    <td><i class="fa fa-calendar"></i> <?php echo $tglTiba; ?></td>
                    <td rowspan="2" style="vertical-align: middle" class="text-lg-center"><i
                            class="fa fa-map-marker"></i> <?php echo $stasiunAsal; ?></td>
                    <td rowspan="2" style="vertical-align: middle" class="text-lg-center"><i
                            class="fa fa-arrow-right"></i> <?php echo $stasiunTujuan; ?></td>
                    <td><i class="fa fa-bars"></i> <?php echo $kelas; ?></td>
                </tr>
                <tr>
                    <td><i class="fa fa-angle-double-right" style="margin-right: 10px;"></i>No. Kereta
                        :<b><?php echo $idKA ?></b></td>
                    <td><i class="fa fa-clock-o"></i> <?php echo $jamBerangkat; ?></td>
                    <td><i class="fa fa-clock-o"></i> <?php echo $jamTiba; ?></td>
                    <td><i class="fa fa-money "></i> Rp. <?php echo $harga; ?></td>
                </tr>

                </tbody>
            </table>
        </div>

        <!--Todo Tabel Detail Penumpang-->
        <div class="col-lg-8 offset-lg-2">
            <table class="table table-bordered table-sm table-responsive"
                   style="margin-top: 5px; background-color: white">
                <thead>
                <tr>
                    <th colspan="6" class="text-lg-center text-md-center text-xs-center text-sm-center"><h3>Data
                            Diri</h3></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td align="right" style="width: 50%"><b>Nomor Tiket</b></td>
                    <td align="left"><?php echo $idTiket; ?></td>
                </tr>
                <tr>
                    <td align="right"><b>Nama Pemesan</b></td>
                    <td align="left"><?php echo $namaPemesan; ?></td>
                </tr>
                <tr>
                    <td align="right"><b>Alamat</b></td>
                    <td align="left"><?php echo $alamat; ?></td>
                </tr>
                <tr>
                    <td align="right"><b>Nomor Telepon</b></td>
                    <td align="left"><?php echo $nomorTelp; ?></td>
                </tr>
                <tr>
                    <td align="right"><b>Email</b></td>
                    <td align="left"><?php echo $email; ?></td>
                </tr>
                <tr>
                    <td align="right"><b>Dewasa</b></td>
                    <td align="left"><?php echo $jmlDewasa; ?></td>
                </tr>
                <tr>
                    <td align="right"><b>Bayi</b></td>
                    <td align="left"><?php echo $jmlAnak; ?></td>
                </tr>
                <tr>
                    <td align="right"><b>Biaya</b></td>
                    <td align="left">Rp. <?php echo $harga * $jmlDewasa; ?></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="alert" role="alert">
                            <h4 class="alert-heading"><i class="fa fa-info-circle"></i> Info !</h4>
                            <ul>
                                <li>Pastikan Anda telah mencatat nomor tiket untuk mengecek konfirmasi tiket nantinya.</li>
                                <li>Pastikan Anda telah menerima konfirmasi pembayaran dari PT. Kereta Api Indonesia .
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>

                </tbody>
            </table>
        </div>


    </div>
    <!--end Row [printable]-->

    <div class="row col-lg-8 offset-lg-2">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title"><i class="fa fa-credit-card"></i> Informasi Pembayaran</h4>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Kode Pembayaran : <b><?php echo $kodePembayaran; ?></b></li>
                    <li class="list-group-item">
                        Batas Waktu Pembayaran:
                        <b><?php while ($waktuBayar = mysqli_fetch_assoc($sqlwaktu)) {
                                echo $waktuBayar['waktuBayar'];
                            } ?>
                        </b>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-lg-10 offset-lg-1" align="center">
        <a href="./cekTiket.php" class="btn btn-primary btn-lg">Cek Tiket</a>
        <a href="?idTiket=<?php echo $idTiket; ?>" class="btn btn-danger btn-lg" id="batalPesan">Batalkan
            Booking</a>
    </div>

</div>
<!--end container-->

<footer class="footer">
    <div class="container">
        &copy; Ahdiat Ahsan
    </div>
</footer>

<!-- todo Javascript-->
<script src="./asset/jquery/jquery-3.1.1.min.js"></script>
<script src="./asset/bootstrap/js/tether.min.js"></script>
<script src="./asset/bootstrap/js/bootstrap.min.js"></script>
<script src="./asset/bootbox/bootbox.min.js"></script>

<script>
    $(document).on("click", "#batalPesan", function (e) {
        var link = $(this).attr("href"); // mendapatkan link yang dimaksuk
        e.preventDefault();
        bootbox.confirm("<h4>Batalkan Pemesanan ?<h4>", function (result) {
            if (result) {
                document.location.href = link;  // jika di klik ok maka menuju link pada atribut href
            }
        });
    });
</script>
</body>
</html>
