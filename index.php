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
                <a class="nav-link" href="./cekTiket.php"><b>Cek Tiket</b> <span class="sr-only">(current)</span></a>
            </li>
        </ul>

        <ul class="nav navbar-nav">
            <li class="nav-item active float-lg-right">
            </li>
        </ul>
    </div>
</nav>

<!--todo jumbroton-->
<div class="jumbotron">
    <div class="container">
        <h1 class="display-4 text-lg-center text-primary">Selamat Datang</h1>
    </div>
</div>

<!--todo container-->
<div class="container">

    <!--todo daftar jadwal-->
    <?php
    include "./config/koneksi.php";
    $sql = mysqli_query($koneksi, "SELECT * FROM kereta JOIN kelas ON  kereta.id_kelas = kelas.id_kelas");
    while ($row = mysqli_fetch_assoc($sql)) {
        ?>
        <form action="./pesanTiket.php" method="post">
            <div class="row col-lg-4 offset-lg-0">
                <div class="card">
                    <div class="card-block card-header">
                        <h4 class="card-title">
                            <div class="input-group">
                                <div class="input-group-addon inputHeader" style="padding-left: 0; padding-right: 0;"><i
                                        class="fa fa-train"></i></div>
                                <input type="text" class="form-control inputHeader" id="namaKA" name="namaKA"
                                       value=" <?php echo $row['nama_KA']; ?>" readonly>
                            </div>
                        </h4>
                        <div class="input-group">
                            <div class="input-group-addon inputHeader" style="padding-left: 0; padding-right: 10px;"><i
                                    class="fa fa-angle-double-right"></i></div>
                            <input type="text" class="form-control inputHeader" id="idKA" name="idKA"
                                   value="<?php echo $row['id_KA']; ?>" readonly>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <i class="fa fa-arrow-circle-right"></i><b> Jadwal Berangkat</b>
                            <div style="padding-left: 15px;">
                                <input type="text" class="form-control inputDetail" id="tglBerangkat"
                                       name="tglBerangkat"
                                       value=" <?php echo $row['tanggal_berangkat']; ?>" readonly>
                                <input type="text" class="form-control inputDetail" id="jamBerangkat"
                                       name="jamBerangkat"
                                       value=" <?php echo $row['jam_berangkat']; ?>" readonly>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-arrow-circle-left"></i><b> Jadwal Tiba</b>
                            <div style="padding-left: 15px;">
                                <input type="text" class="form-control inputDetail" id="tglTiba"
                                       name="tglTiba"
                                       value=" <?php echo $row['tanggal_tiba']; ?>" readonly>
                                <input type="text" class="form-control inputDetail" id="jamTiba"
                                       name="jamTiba"
                                       value=" <?php echo $row['jam_tiba']; ?>" readonly>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-map-marker"></i><b> Stasiun Asal</b>
                            <br>
                            <div style="padding-left: 15px;">
                                <input type="text" class="form-control inputDetail" id="stasiunAsal"
                                       name="stasiunAsal"
                                       value=" <?php echo $row['stasiun_asal']; ?>" readonly>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-arrow-right"></i><b> Stasiun Tujuan</b>
                            <br>
                            <div style="padding-left: 15px;">
                                <input type="text" class="form-control inputDetail" id="stasiunTujuan"
                                       name="stasiunTujuan"
                                       value=" <?php echo $row['stasiun_tujuan']; ?>" readonly>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-bars"></i><b> Kelas (Harga) </b>
                            <br>
                            <div style="padding-left: 15px;">
                                <input type="text" class="form-control inputDetail" id="kelas"
                                       name="kelas"
                                       value=" <?php echo $row['nama_kelas']; ?>" readonly>
                                <input type="text" class="form-control inputDetail" id="Dharga"
                                       name="Dharga"
                                       value=" <?php echo "Rp." . $row['harga']; ?>" readonly>
                                <input type="hidden" class="form-control inputDetail" id="harga"
                                       name="harga"
                                       value=" <?php echo $row['harga']; ?>" readonly>
                            </div>
                        </li>
                    </ul>
                    <div class="card-block">
                        <input type="submit" class="btn btn-primary btn-block" value="Pilih" name="book">
                    </div>
                </div>
            </div>
        </form>
        <?php
    }
    ?>
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
</body>
</html>
