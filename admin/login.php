<?php
session_start();
if (isset($_SESSION['login_user'])){
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
    <title>Reservasi Tiket KAI</title>
</head>
<body>

<!--todo container-->
<div class="container">

    <!-- todo card login-->
    <div class="row col-lg-6 offset-lg-3 marginatas">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title text-lg-center"><i class="fa fa-sign-in"></i> Login Admin</h4>
                <hr>
                <form method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" autocomplete="off" required>
                    </div>
                    <?php
                    include "../config/koneksi.php";

                    if (isset($_POST['kirim'])) {
                        $username = $_POST['username'];
                        $password = $_POST['password'];

                        $sql = mysqli_query($koneksi, "SELECT id_user FROM admin WHERE username = '$username' AND password = '$password'");
                        $row = mysqli_fetch_assoc($sql);
                        $count = mysqli_num_rows($sql);

                        if ($count == 1) {
                            session_start();
                            $_SESSION['login_user'] = $username;
                            header("location:./jadwalKereta.php");
                        } else {
                            echo "<div class='row'>
                                     <div class='alert alert-danger alert-dismissible fade in col-lg-6 offset-lg-3' role='alert'>
                                     <button type='button' class='close' data-dismisss='alert' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                     </button>
                                  <strong class='text-lg-center'><i class='fa fa-times'></i> Password Salah</strong>
                                  </div>
                                  </div>";
                        }
                    }
                    ?>
                    <div class="text-lg-center text-md-center">
                        <input type="submit" value="Login" class="btn btn-primary" name="kirim">
                        <input type="reset" value="Reset" class="btn btn-danger">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end container-->

<!-- todo Javascript-->
<script src="../asset/jquery/jquery-3.1.1.min.js"></script>
<script src="../asset/bootstrap/js/tether.min.js"></script>
<script src="../asset/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
