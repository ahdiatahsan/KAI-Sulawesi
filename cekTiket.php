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
        <a class="navbar-brand" href="#"><img src="./img/logo1.png" style="width: 100%;"></a>

        <ul class="nav navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="./index.php"><b>Booking Tiket</b> <span class="sr-only">(current)</span></a>
            </li>
        </ul>

        <ul class="nav navbar-nav">
            <li class="nav-item active float-lg-right">
            </li>
        </ul>
    </div>
</nav>


<!--todo container-->
<div class="container">
    <div class="row" style="margin-top: 20px">
        <div class="col-lg-8 offset-lg-2 text-lg-center">
            <form method="post" class="form-inline">
                <div class="form-group">
                    <input type="search" name="cari" id="cari" class="form-control form-control-lg"
                           placeholder="Cari Nomor Tiket">
                </div>
                <button type="submit" name="search" class="btn btn-primary btn-lg"><i
                        class="fa fa-search"></i></button>
            </form>
        </div>
    </div>

    <?php
    include "./config/koneksi.php";
    if (isset($_POST['search'])) {

        $cari = $_POST['cari'];
        $sql = mysqli_query($koneksi, "SELECT * FROM kereta JOIN pesan_tiket ON pesan_tiket.id_KA = kereta.id_KA JOIN kelas ON kereta.id_kelas = kelas.id_kelas WHERE id_tiket = '$cari' AND status='Disetujui'");
        $row = mysqli_fetch_assoc($sql);
        $count = mysqli_num_rows($sql);
        if ($count == 1) {

            echo '

        <div class="row">
        <div class="col-lg-10 offset-lg-1" id="printAble">
        <div class="table-responsive">
            <table class="table table-bordered table-sm" style="margin-top: 20px; background-color: white;">
                <thead>
                <tr>
                    <td align="center" colspan="2">
                        <img src="./img/KAI-logo.png" alt="logo_kai" width="400">
                    </td>
                </tr>
                <tr>
                    <td class="align-middle" align="center" style="padding-right: 30px">
                    <h5>No.Tiket : ' . $row['id_tiket'] . ' </h5>
                    </td>
                    <td align="center">
                        <h5>Kelas ' . $row['nama_kelas'] . ' </h5>
                    </td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td width="50%" align="center">
                        Kereta <br> <b>' . $row['nama_KA'] . ', Nomor Kereta ' . $row['id_KA'] . '</b>
                    </td>
                    <td align="center">
                        Rute Perjalanan <br>' . '<b>' . $row['stasiun_asal'] . ' <i class="fa fa-arrow-right"></i> ' . $row['stasiun_tujuan'] . '</b>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        Jadwal Berangkat <br>
                        <b>Tanggal ' . $row['tanggal_berangkat'] . ', Jam ' . $row['jam_berangkat'] . '</b>
                    </td>
                    <td align="center">
                        Jadwal Tiba <br>
                        <b>Tanggal ' . $row['tanggal_tiba'] . ', Jam ' . $row['jam_tiba'] . '</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><h4>Informasi Penumpang</h4></td>
                </tr>
                <tr>
                    <td align="right">Nama Pemesan</td>
                    <td><b>' . $row['nama_pemesan'] . '</b></td>
                </tr>
                <tr>
                    <td align="right">Dewasa</td>
                    <td><b>' . $row['jml_dewasa'] . ' Orang </b></td>
                </tr>
                <tr>
                    <td align="right">Bayi (< 3 Tahun)</td>
                    <td><b>' . $row['jml_bayi'] . ' Orang </b></td>
                </tr>
                </tbody>
            </table>
            </div>
        </div>

        <div class="col-lg-10 offset-lg-1" align="center">
            <button type="button" class="btn btn-primary btn-lg" onclick="cetak(\'printAble\')"><i
                    class="fa fa-print"></i> Cetak Tiket
            </button>
        </div>
    </div>
        ';

        } else {
            echo '
    <br>
    <div class="alert alert-danger alert-dismissible fade in col-lg-8 offset-lg-2" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="alert-heading"><i class="fa fa-times"></i> Tiket yang Anda cari tidak ada.</h4>
        <div style="padding-left: 25px">Cek kembali <b>nomor tiket</b> dan pastikan anda telah mendapatkan konfirmasi.
        </div>
    </div>
    ';
        }
    }
    ?>


</div>
<!--end container-->

<!--todo footer-->
<footer class="footer">
    <div class="container">
        &copy; Ahdiat Ahsan
    </div>
</footer>

<!-- todo Javascript-->
<script src="./asset/jquery/jquery-3.1.1.min.js"></script>
<script src="./asset/bootstrap/js/tether.min.js"></script>
<script src="./asset/bootstrap/js/bootstrap.min.js"></script>
<script>
    function cetak(divID) {
        //mengambil tag div
        var divelement = document.getElementById(divID).innerHTML;
        //menngambil semua halaman html
        var halamanAwal = document.body.innerHTML;
        //reset halaman html dengan, untuk memuat div
        document.body.innerHTML = "<html><head><title></title></head><body>" + divelement + "<body>";
        //print halaman
        window.print();
        //mengembalikan halaman seperti semula
        document.body.innerHTML = halamanAwal;
    }
</script>
<script>
    document.getElementById('cari').value = "<?php echo $cari; ?>"
</script>
</body>
</html>
