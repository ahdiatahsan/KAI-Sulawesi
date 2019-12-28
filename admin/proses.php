<?php
include "../config/koneksi.php";

//todo tambah jadwal kereta
if (isset($_POST['tambahJadwalKereta'])) {

    $noKereta = $_POST['noKereta'];
    $namaKereta = $_POST['namaKereta'];
    $tglBerangkat = $_POST['tglBerangkat'];
    $jamBerangkat = $_POST['jamBerangkat'];
    $tglTiba = $_POST['tglTiba'];
    $jamTiba = $_POST['jamTiba'];
    $stasiunAsal = $_POST['stasiunAsal'];
    $stasiunTujuan = $_POST['stasiunTujuan'];
    $kelas = $_POST['kelas'];

    $sql = "INSERT INTO kereta VALUES ('$noKereta', '$namaKereta', '$tglBerangkat', '$tglTiba', '$jamBerangkat', '$jamTiba', '$stasiunAsal', '$stasiunTujuan', '$kelas')";

    if ($koneksi->query($sql) == true) {
        header("location:./jadwalKereta.php");
    } else {
        echo "error !";
    }

// todo delete kereta
} else if (isset($_GET['hapusJadwal'])) {
    $id_KA = $_GET['hapusJadwal'];
    $sql = "DELETE FROM kereta WHERE id_KA = '$id_KA'";

    if ($koneksi->query($sql) == true) {
        header("location:./jadwalKereta.php");
    } else {
        echo "error !";
    }

//   todo edit kereta
} else if (isset($_POST['editJadwalKereta'])) {

    $noKereta = $_POST['noKereta'];
    $namaKereta = $_POST['namaKereta'];
    $tglBerangkat = $_POST['tglBerangkat'];
    $jamBerangkat = $_POST['jamBerangkat'];
    $tglTiba = $_POST['tglTiba'];
    $jamTiba = $_POST['jamTiba'];
    $stasiunAsal = $_POST['stasiunAsal'];
    $stasiunTujuan = $_POST['stasiunTujuan'];
    $kelas = $_POST['kelas'];

    $sql = "UPDATE kereta SET id_KA='$noKereta', nama_KA = '$namaKereta', tanggal_berangkat = '$tglBerangkat', tanggal_tiba = '$tglTiba',
            jam_berangkat = '$jamBerangkat', jam_tiba = '$jamTiba', stasiun_asal = '$stasiunAsal',
            stasiun_tujuan = '$stasiunTujuan', id_kelas = '$kelas' WHERE id_KA ='$noKereta'";

    if ($koneksi->query($sql) == true) {
        header("location:./jadwalKereta.php");
    } else {
        echo "error !";
    }

//    todo tambah kelas
} else if (isset($_POST['tambahKelas'])) {

    $idKelas = $_POST['idKelas'];
    $namaKelas = $_POST['namaKelas'];
    $harga = $_POST['harga'];

    $sql = "INSERT INTO kelas VALUES ('$idKelas', '$namaKelas', '$harga')";

    if ($koneksi->query($sql) == true) {
        header("location:./kelas.php");
    } else {
        echo "error !";
    }
//    todo hapus kelas
} else if (isset($_GET['id_kelas'])) {

    $idKelas = $_GET['id_kelas'];
    $sql = "DELETE FROM kelas WHERE id_kelas = '$idKelas'";

    if ($koneksi->query($sql) == true) {
        header("location:./kelas.php");
    } else {
        echo "error !";
    }

//  todo edit kelas
} else if (isset($_POST['editKelas'])) {
    $idKelas = $_POST['idKelas'];
    $namaKelas = $_POST['namaKelas'];
    $harga = $_POST['harga'];

    $sql = "UPDATE kelas SET nama_kelas = '$namaKelas', harga = '$harga' WHERE id_kelas = '$idKelas'";

    if ($koneksi->query($sql) == true) {
        header("location:./kelas.php");
    } else {
        echo "error !";
    }

//  todo konfirmasi
} else if (isset($_POST['konfirmasi'])) {
    $idTiket = $_POST['idTiket'];
    $status = $_POST['statusTiket'];

    $sql = "UPDATE pesan_tiket SET status = '$status' WHERE id_tiket = '$idTiket'";

    if ($koneksi->query($sql) == true) {
        header("location:./booking.php");
    } else {
        echo "error !";
    }

} else if (isset($_GET['hapusBooking'])) {
    $hapusBooking = $_GET['hapusBooking'];

    $sql = "DELETE FROM pesan_tiket WHERE id_tiket = '$hapusBooking'";
    if ($koneksi->query($sql) == true) {
        header("location:./booking.php");
    } else {
        echo "error !";
    }
} else {
    header("location:./login.php");
}
