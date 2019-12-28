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
            <li class="nav-item active">
                <a class="nav-link" href="./jadwalKereta.php"><b>Jadwal Kereta</b> <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./kelas.php">Kelas <span class="sr-only"></span></a>
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
        <h3 class="display-5 text-lg-center">Tabel Jadwal Kereta</h3>
    </div>
</div>

<!--todo container-->
<div class="container">

    <!--todo tabel kelas-->
    <div class="row">
        <div class="col-lg-12 offset-lg-0" align="center">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#tambah">
                <i class="fa fa-plus"></i> Tambah Jadwal
            </button>
        </div>

        <div class="col-lg-12 offset-lg-0">
            <table class="table table-hover table-bordered table-sm display nowrap" id="tabel">
                <thead class="thead-inverse">
                <tr>
                    <th>No. Kereta</th>
                    <th>Nama Kereta</th>
                    <th>Jadwal Berangkat</th>
                    <th>Jadwal Tiba</th>
                    <th>Stasiun Asal</th>
                    <th>Stasiun Tujuan</th>
                    <th>Kelas (Harga)</th>
                    <th>Options</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $sql = mysqli_query($koneksi, "SELECT * FROM kereta JOIN kelas ON  kereta.id_kelas = kelas.id_kelas");
                while ($row = mysqli_fetch_assoc($sql)) {
                    ?>
                    <tr>
                        <td><?php echo $row['id_KA']; ?></td>
                        <td><?php echo $row['nama_KA']; ?></td>
                        <td><?php echo "Tanggal " . $row['tanggal_berangkat'] . ", Jam " . $row['jam_berangkat']; ?></td>
                        <td><?php echo "Tanggal " . $row['tanggal_tiba'] . ", Jam " . $row['jam_tiba']; ?></td>
                        <td><?php echo $row['stasiun_asal']; ?></td>
                        <td><?php echo $row['stasiun_tujuan']; ?></td>
                        <td><?php echo $row['nama_kelas'] . ", (Rp." . $row['harga'] . ")"; ?></td>
                        <td style="text-align: center;">
                            <a href="./proses.php?hapusJadwal=<?php echo $row['id_KA']; ?>"
                               class="btn btn-danger btn-sm rounded-circle"
                               id="hapusJadwal" name="hapusJadwal"><i class="fa fa-times"></i></a>

                            <a href="./editJadwal.php?id_KA=<?php echo $row['id_KA']; ?>"
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
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Tambah Jadwal</h4>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="noKereta">Nomor Kereta</label>
                        <input type="text" class="form-control" id="noKereta" name="noKereta" required>
                    </div>
                    <div class="form-group">
                        <label for="namaKereta">Nama Kereta</label>
                        <input type="text" class="form-control" id="namaKereta" name="namaKereta" required>
                    </div>
                    <fieldset>
                        <legend class="text-primary">Jadwal Berangkat</legend>
                        <div class="form-group">
                            <label for="tglBerangkat">Tanggal Berangkat</label>
                            <input type="date" class="form-control" id="tglBerangkat" name="tglBerangkat" required>
                        </div>
                        <div class="form-group">
                            <label for="jamBerangkat">Jam Berangkat</label>
                            <input type="text" pattern="(0[0-9]|1[0-9]|2[0-3])(:[0-5][0-9])" class="form-control"
                                   id="jamBerangkat" name="jamBerangkat" placeholder="HH:MM" required>
                        </div>
                    </fieldset>
                    <br>
                    <fieldset>
                        <legend class="text-primary">Jadwal Tiba</legend>
                        <div class="form-group">
                            <label for="tglBerangkat">Tanggal Tiba</label>
                            <input type="date" class="form-control" id="tglTiba" name="tglTiba" required>
                        </div>
                        <div class="form-group">
                            <label for="jamTiba">Jam Tiba</label>
                            <input type="text" pattern="(0[0-9]|1[0-9]|2[0-3])(:[0-5][0-9])" class="form-control"
                                   id="jamTiba" name="jamTiba" placeholder="HH:MM" required>
                        </div>
                    </fieldset>
                    <br>
                    <div class="form-group">
                        <label for="stasiunAsal">Stasiun Asal</label>
                        <input type="text" class="form-control" id="stasiunAsal" name="stasiunAsal" required>
                    </div>
                    <div class="form-group">
                        <label for="stasiunTujuan">Stasiun Tujuan</label>
                        <input type="text" class="form-control" id="stasiunTujuan" name="stasiunTujuan" required>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <select name="kelas" class="form-control" id="kelas">
                            <?php
                            $sql = mysqli_query($koneksi, "SELECT id_kelas, nama_kelas FROM kelas");
                            while ($row = mysqli_fetch_assoc($sql)) {
                                echo "<option value=" . $row['id_kelas'] . ">" . $row['nama_kelas'] . "</option>\n";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="tambahJadwalKereta">Tambah</button>
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
<script>
    $('#tabel').dataTable({
        "sScrollX": "110%",
        "bScrollCollapse": true
    });
</script>

<!--javascript Modal Delete-->
<script>
    $(document).on("click", "#hapusJadwal", function (e) {
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
