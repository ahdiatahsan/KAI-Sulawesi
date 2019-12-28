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
        <a class="navbar-brand hidden-lg-down" href="#"><img src="./img/logo1.png" style="width: 100%;"></a>
        <ul class="nav navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="./cekTiket.php"><b>Cek Tiket</b> <span class="sr-only"></span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="./index.php"><b>Booking Tiket</b> <span class="sr-only"></span></a>
            </li>
        </ul>
    </div>
</nav>

<!--todo jumbroton-->
<div class="jumbotron">
    <div class="container">
        <h4 class="text-lg-center text-primary">Registrasi Tiket</h4>
    </div>
</div>


<!--todo container-->

<div class="container">
    <div class="row">
        <!--todo card-->
        <?php
        include "./config/koneksi.php";
        if (!empty($_POST['idKA'])) {

            $idKA = $_POST['idKA'];
            $namaKA = $_POST['namaKA'];
            $tglBerangkat = $_POST['tglBerangkat'];
            $jamBerangkat = $_POST['jamBerangkat'];
            $tglTiba = $_POST['tglTiba'];
            $jamTiba = $_POST['jamTiba'];
            $stasiunAsal = $_POST['stasiunAsal'];
            $stasiunTujuan = $_POST['stasiunTujuan'];
            $kelas = $_POST['kelas'];
            $harga = $_POST['harga'];

            $sql = mysqli_query($koneksi, "SELECT * FROM kereta JOIN kelas ON  kereta.id_kelas = kelas.id_kelas");
            $row = mysqli_fetch_assoc($sql);

        } else {
            header("location:./index.php");
        }
        ?>
        <div class="row col-lg-12 offset-lg-0">
            <div class="card">
                <div class="card-block card-header">
                    <h4 class="card-title">
                        <div class="input-group">
                            <i class="fa fa-train"></i><?php echo $namaKA; ?>
                        </div>
                    </h4>
                    <div class="input-group">
                        <i class="fa fa-angle-double-right" style="margin-right: 18px"></i>Nomor Kereta
                        : <?php echo $idKA; ?>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="text-lg-center text-md-center">Jadwal Berangkat</th>
                            <th class="text-lg-center text-md-center">Jadwal Tiba</th>
                            <th class="text-lg-center text-md-center">Stasiun Asal</th>
                            <th class="text-lg-center text-md-center">Stasiun Tujuan</th>
                            <th class="text-lg-center text-md-center">Kelas (Harga)</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><i class="fa fa-calendar"></i> <?php echo $tglBerangkat; ?></td>
                            <td><i class="fa fa-calendar"></i> <?php echo $tglTiba; ?></td>
                            <td rowspan="2" style="vertical-align: middle"
                                class="text-lg-center"><i
                                    class="fa fa-map-marker"></i> <?php echo $stasiunAsal; ?></td>
                            <td rowspan="2" style="vertical-align: middle"
                                class="text-lg-center"><i
                                    class="fa fa-arrow-right"></i> <?php echo $stasiunTujuan; ?></td>
                            <td><i class="fa fa-bars"></i> <?php echo $kelas; ?></td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-clock-o"></i> <?php echo $jamBerangkat; ?></td>
                            <td><i class="fa fa-clock-o"></i> <?php echo $jamTiba; ?></td>
                            <td><i class="fa fa-money "></i> Rp. <?php echo $harga; ?></td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--end card-->
    </div>
    <!--end row-->

    <!--todo form isi-->
    <div class="row col-lg-8 offset-lg-2">
        <div class="card padding15px">

            <form action="./rincianTiket.php" method="post">
                <input type="hidden" id="idTiket" name="idTiket" value="<?php echo $idKA . rand(1000, 9999); ?>"
                       readonly>
                <div class="form-group">
                    <label for="namaPemesan">Nama Pemesan<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="namaPemesan" name="namaPemesan" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat<span class="text-danger">*</span></label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="nomorTelp">Nomor Telepon<span class="text-danger">*</span></label>
                    <input type="tel" class="form-control" id="nomorTelp" name="nomorTelp"
                           min="12" placeholder="Yang dapat dihubungi saat ini" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" autocomplete="off" name="email">
                </div>
                <div class="form-group">
                    <label for="jmlDewasa">Dewasa (>=3tahun)</label>
                    <select class="form-control" id="jmlDewasa" name="jmlDewasa">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="jmlAnak">Bayi (< 3 Tahun)</label>
                    <select class="form-control" id="jmlAnak" name="jmlAnak">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>
                <span class="text-danger">*<small>= Wajib Diisi</small></span>
                <hr>
                <input type="hidden" id="idKA" name="idKA" value="<?php echo $idKA; ?>">
                <input type="hidden" id="kodePembayaran" name="kodePembayaran"
                       value="<?php echo rand(10000000, 99999999) ?>" readonly>
                <input type="hidden" id="harga" name="harga" value="<?php echo $harga; ?>">

                <div class="form-check text-justify">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" required>
                        Dengan ini saya setuju dan mematuhi persyaratan dan ketentuan Reservasi dari PT.Kereta Api
                        Indonesia (Persero), termasuk pembayaran dan mematuhi semua aturan dan pembatasan mengenai
                        ketersediaan tarif atau jasa.
                    </label>
                </div>
                <hr>
                <input type="hidden" id="namaKA" name="namaKA" value="<?php echo $namaKA; ?>">
                <input type="hidden" id="tglBerangkat" name="tglBerangkat" value="<?php echo $tglBerangkat; ?>">
                <input type="hidden" id="jamBerangkat" name="jamBerangkat" value="<?php echo $jamBerangkat; ?>">
                <input type="hidden" id="tglTiba" name="tglTiba" value="<?php echo $tglTiba; ?>">
                <input type="hidden" id="jamTiba" name="jamTiba" value="<?php echo $jamTiba; ?>">
                <input type="hidden" id="stasiunAsal" name="stasiunAsal" value="<?php echo $stasiunAsal; ?>">
                <input type="hidden" id="stasiunTujuan" name="stasiunTujuan" value="<?php echo $stasiunTujuan; ?>">
                <input type="hidden" id="kelas" name="kelas" value="<?php echo $kelas; ?>">
                <input type="hidden" id="harga" name="harga" value="<?php echo $harga; ?>">

                <div class="text-lg-center text-md-center text-sm-center text-xs-center">
                    <input type="submit" class="btn btn-primary btn-lg" value="Pesan">
                    <input type="reset" class="btn btn-danger btn-lg">
                </div>
            </form>

        </div>
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
</body>
</html>
