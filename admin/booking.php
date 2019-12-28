<?php
include "../config/koneksi.php";
include "./session.php";
if (!isset($_SESSION['login_user'])) {
    header("location:./login.php");
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="../img/tab_img.png">
    <link rel="stylesheet" href="../asset/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../asset/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../asset/datatable/media/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../asset/datatable/extensions/Responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../asset/datatable/extensions/Scroller/css/scroller.bootstrap4.min.css">
    <title>Reservasi Tiket KAI</title>
</head>
<body>

<!--todo navbar-->
<nav class="navbar navbar-dark bg-inverse" id="navbar">
    <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#navbarResponsive"
            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"></button>
    <div class="collapse navbar-toggleable-md" id="navbarResponsive">
        <a class="navbar-brand hidden-sm-down hidden-md-down" href="#"><img src="../img/navbar_logo.png"
                                                                            style="width: 70%;"></a>

        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="./jadwalKereta.php">Jadwal Kereta <span class="sr-only"></span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./kelas.php">Kelas<span class="sr-only"></span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="./booking.php"><b>Booking</b> <span class="sr-only">(current)</span></a>
            </li>
        </ul>

        <span class="navbar-text float-xs-right">
        <a href="./logout.php" class="text-white btn btn-danger btn-sm" style="margin-left: 20px;" id="logout"><i
                class="fa fa-sign-out"></i> Logout</a>
        </span>

        <span class="navbar-text float-xs-right text-white">
            Welcome <b><?php echo $usernameSession; ?></b>
        </span>

    </div>
</nav>

<!--todo jumbroton-->
<div class="jumbotron">
    <div class="container">
        <h3 class="display-5 text-lg-center">Tabel Pesan Tiket</h3>
    </div>
</div>

<!--todo container-->
<div class="container-fluid">

    <!--todo tabel kelas-->
    <div class="row">
        <div class="col-lg-12 offset-lg-0">
            <table class="table table-hover table-bordered table-sm display nowrap" id="tabel">
                <thead class="thead-inverse">
                <tr>
                    <th>Id Tiket</th>
                    <th>Nama Pemesan</th>
                    <th>Alamat</th>
                    <th>Nomor Telp.</th>
                    <th>Email</th>
                    <th>Penumpang Dewasa</th>
                    <th>Penumpang Anak</th>
                    <th>Kereta</th>
                    <th>Kode Pembayaran</th>
                    <th>Waktu Booking</th>
                    <th>Status</th>
                    <th>Option</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $sql = mysqli_query($koneksi, "SELECT * FROM pesan_tiket JOIN kereta ON kereta.id_KA = pesan_tiket.id_KA");
                while ($row = mysqli_fetch_assoc($sql)) {
                    ?>
                    <tr>
                        <td align="center"><?php echo $row['id_tiket']; ?></td>
                        <td><?php echo $row['nama_pemesan']; ?></td>
                        <td><?php echo $row['alamat']; ?></td>
                        <td align="center"><?php echo $row['no_telp']; ?></td>
                        <td align="center"><?php echo $row['email']; ?></td>
                        <td align="center"><?php echo $row['jml_dewasa']; ?></td>
                        <td align="center"><?php echo $row['jml_bayi']; ?></td>
                        <td><?php echo $row['nama_KA']; ?></td>
                        <td align="center"><?php echo $row['kode_pembayaran']; ?></td>
                        <td align="center"><?php echo $row['waktu_booking']; ?></td>
                        <td align="center"><?php echo $row['status']; ?></td>
                        <td style="text-align: center;">
                            <a href="./proses.php?hapusBooking=<?php echo $row['id_tiket']; ?>"
                               class="btn btn-danger btn-sm" id="hapusBooking" name="hapusBooking"><i
                                    class="fa fa-trash"></i></a>
                            <a href=" ./konfirmasi.php?id_tiket=<?php echo $row['id_tiket']; ?>"
                               class="btn btn-primary btn-sm"><i class="fa fa-check"></i> Konfirmasi</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>

            </table>
        </div>

    </div>
</div>

<!--end container-->

<!--todo footer-->
<footer class="footer bg-inverse">
    <div class="container">
        &copy; Ahdiat Ahsan
    </div>
</footer>

<!-- todo Javascript-->
<script src="../asset/jquery/jquery-3.1.1.min.js"></script>
<script src="../asset/bootstrap/js/tether.min.js"></script>
<script src="../asset/bootstrap/js/bootstrap.min.js"></script>
<script src="../asset/datatable/media/js/jquery.dataTables.js"></script>
<script src="../asset/datatable/media/js/dataTables.bootstrap4.min.js"></script>
<script src="../asset/datatable/extensions/Responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../asset/datatable/extensions/Scroller/js/dataTables.scroller.min.js"></script>
<script src="../asset/bootbox/bootbox.min.js"></script>

<!--data table-->
<script>
    $(document).ready(function () {
        $('#tabel').DataTable();
    });
</script>
<script>
    $('#tabel').dataTable({
        "sScrollX": "110%",
        "bScrollCollapse": true
    });
</script>

<!--javascript Modal Delete-->
<script>
    $(document).on("click", "#hapusBooking", function (e) {
        var link = $(this).attr("href"); // mendapatkan link yang dimaksud
        e.preventDefault();
        bootbox.confirm("<h4 class='text-danger'><i class='fa fa-times'></i> Hapus data ini ?<h4>", function (result) {
            if (result) {
                document.location.href = link;  // jika di klik ok maka menuju link pada atribut href
            }
        });
    });
</script>
<!--javascript Modal logout-->
<script>
    $(document).on("click", "#logout", function (e) {
        var link = $(this).attr("href"); // mendapatkan link yang dimaksud
        e.preventDefault();
        bootbox.confirm("<h4><i class='fa fa-sign-out'></i> Logout ?<h4>", function (result) {
            if (result) {
                document.location.href = link;  // jika di klik ok maka menuju link pada atribut href
            }
        });
    });
</script>

</body>
</html>
