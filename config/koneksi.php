<?php
$koneksi = mysqli_connect("localhost", "root", "", "reservasi_tiket");

if ($koneksi->connect_error) {
    echo "Koneksi Gagal";
}
