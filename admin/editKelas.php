<?php
include "../config/koneksi.php";
include "./session.php";
if (!isset($_SESSION['login_user'])) {
    header("location:./login.php");
}

if (!isset($_GET['id_kelas'])) {
    header("location:./kelas.php");
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
        <h3 class="display-5 text-lg-center">Edit Kelas</h3>
    </div>
</div>

<div class="container ">
    <div class="row col-lg-8 offset-lg-2">
        <div class="card">
            <?php
            $editKelas = $_GET['id_kelas'];
            $sql = mysqli_query($koneksi, "SELECT * FROM kelas WHERE id_kelas='$editKelas'");
            if (mysqli_num_rows($sql) == 0) {
                header("locaion:/kelas.php");
            } else {
                $row = mysqli_fetch_assoc($sql);
            }
            ?>
            <div class="card-block">
                <form method="post" action="./proses.php" name="formEditJadwal">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="idKelas">Id Kelas</label>
                            <input type="text" class="form-control" id="idKelas" name="idKelas"
                                   value="<?php echo $row['id_kelas']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="namaKelas">Nama Kelas</label>
                            <input type="text" class="form-control" id="namaKelas" name="namaKelas"
                                   value="<?php echo $row['nama_kelas']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="number" class="form-control" id="harga" name="harga"
                                   value="<?php echo $row['harga']; ?>" required>
                        </div>
                    </div>
                    <div class="modal-footer text-lg-center">
                        <a href="./kelas.php" class="btn btn-danger">Kembali</a>
                        <button type="submit" class="btn btn-primary" name="editKelas">Edit</button>
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