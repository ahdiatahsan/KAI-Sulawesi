<?php
include "../config/koneksi.php";
session_start();
//cek session
$usernameSession = $_SESSION['login_user'];
$sql = mysqli_query($koneksi, "SELECT username FROM admin WHERE username = '$usernameSession'");
$row = mysqli_fetch_assoc($sql);
$loginSession = $row['username'];
