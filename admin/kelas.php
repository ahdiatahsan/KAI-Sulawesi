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
            <li class="nav-item active">
                <a class="nav-link" href="./kelas.php"><b>Kelas</b><span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./booking.php">Booking <span class="sr-only"></span></a>
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
        <h3 class="display-5 text-lg-center">Tabel Kelas</h3>
    </div>
</div>

<!--todo container-->
<div class="container">

    <!--todo tabel kelas-->
    <div class="row">
        <div class="col-lg-12 offset-lg-0" align="center">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#tambah">
                <i class="fa fa-plus"></i> Tambah Kelas
            </button>
        </div>

        <div class="col-lg-12 offset-lg-0">
            <table class="table table-hover table-bordered table-sm display" id="tabel">
                <thead class="thead-inverse">
                <tr>
                    <th>Id. Kelas</th>
                    <th>Nama Kelas</th>
                    <th>Harga</th>
                    <th>Options</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $sql = mysqli_query($koneksi, "SELECT * FROM kelas");
                while ($row = mysqli_fetch_assoc($sql)) {
                    ?>
                    <tr>
                        <td align="center"><?php echo $row['id_kelas']; ?></td>
                        <td align="center"><?php echo $row['nama_kelas']; ?></td>
                        <td align="center"><?php echo $row['harga']; ?></td>
                        <td style="text-align: center; width: 50px">
                            <a href="./proses.php?id_kelas=<?php echo $row['id_kelas']; ?>"
                               class="btn btn-danger btn-sm rounded-circle" id="hapus" name="hapus"><i
                                    class="fa fa-times"></i></a>

                            <a href="./editKelas.php?id_kelas=<?php echo $row['id_kelas']; ?>"
                               class="btn btn-primary btn-sm rounded-circle"><i class="fa fa-pencil"></i></a>
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

<!--todo modal-->
<!--modal tambah-->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <!--todo form tambah-->
        <form method="post" action="./proses.php" name="formTambahJadwal">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Tambah Kelas</h4>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="idKelas">Id Kelas</label>
                        <input type="text" class="form-control" id="idKelas" name="idKelas" required>
                    </div>
                    <div class="form-group">
                        <label for="namaKelas">Nama Kelas</label>
                        <input type="text" class="form-control" id="namaKelas" name="namaKelas" required>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="tambahKelas">Tambah</button>
                </div>
            </div>
        </form>
    </div>
</div>

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

<!--javascript Modal Delete-->
<script>
    $(document).on("click", "#hapus", function (e) {
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