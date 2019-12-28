<?php
include "../config/koneksi.php";
include "./session.php";
if (!isset($_SESSION['login_user'])) {
    header("location:./login.php");
}

if (!isset($_GET['id_KA'])) {
    header("location:./jadwalKereta.php");
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
        <h3 class="display-5 text-lg-center">Edit Jadwal Kereta</h3>
    </div>
</div>

<div class="container ">
    <div class="row col-lg-8 offset-lg-2">
        <div class="card">
            <?php
            $editKA = $_GET['id_KA'];
            $sql = mysqli_query($koneksi, "SELECT * FROM kereta JOIN kelas ON kereta.id_kelas = kelas.id_kelas WHERE id_KA='$editKA'");
            if (mysqli_num_rows($sql) == 0) {
                header("locaion:/jadwalKereta.php");
            } else {
                $row = mysqli_fetch_assoc($sql);
            }
            ?>
            <div class="card-block">
                <form method="post" action="./proses.php" name="formEditJadwal">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="noKereta">Nomor Kereta</label>
                            <input type="text" class="form-control" id="noKereta" name="noKereta"
                                   value="<?php echo $row['id_KA']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="namaKereta">Nama Kereta</label>
                            <input type="text" class="form-control" id="namaKereta" name="namaKereta"
                                   value="<?php echo $row['nama_KA']; ?>" required>
                        </div>
                        <fieldset>
                            <legend class="text-primary">Jadwal Berangkat</legend>
                            <div class="form-group">
                                <label for="tglBerangkat">Tanggal Berangkat</label>
                                <input type="date" class="form-control" id="tglBerangkat" name="tglBerangkat"
                                       value="<?php echo $row['tanggal_berangkat']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="jamBerangkat">Jam Berangkat</label>
                                <input type="text" pattern="(0[0-9]|1[0-9]|2[0-3])(:[0-5][0-9])"
                                       class="form-control"
                                       id="jamBerangkat" name="jamBerangkat" placeholder="HH:MM"
                                       value="<?php echo $row['jam_berangkat']; ?>" required>
                            </div>
                        </fieldset>
                        <br>
                        <fieldset>
                            <legend class="text-primary">Jadwal Tiba</legend>
                            <div class="form-group">
                                <label for="tglBerangkat">Tanggal Tiba</label>
                                <input type="date" class="form-control" id="tglTiba" name="tglTiba"
                                       value="<?php echo $row['tanggal_tiba']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="jamTiba">Jam Tiba</label>
                                <input type="text" pattern="(0[0-9]|1[0-9]|2[0-3])(:[0-5][0-9])"
                                       class="form-control"
                                       id="jamTiba" name="jamTiba" placeholder="HH:MM"
                                       value="<?php echo $row['jam_tiba']; ?>" required>
                            </div>
                        </fieldset>
                        <br>
                        <div class="form-group">
                            <label for="stasiunAsal">Stasiun Asal</label>
                            <input type="text" class="form-control" id="stasiunAsal" name="stasiunAsal"
                                   value="<?php echo $row['stasiun_asal']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="stasiunTujuan">Stasiun Tujuan</label>
                            <input type="text" class="form-control" id="stasiunTujuan" name="stasiunTujuan"
                                   value="<?php echo $row['stasiun_tujuan']; ?>" required>
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
                    <div class="modal-footer text-lg-center">
                        <a href="./jadwalKereta.php" class="btn btn-danger">Kembali</a>
                        <button type="submit" class="btn btn-primary" name="editJadwalKereta">Edit</button>
                    </div>
            </div>
            </form>
        </div>
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
