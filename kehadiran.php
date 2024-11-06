<?php
require 'koneksi.php';

$nama       = $_POST["nama"];
$jumlah     = (int)$_POST["jumlah"];
$kehadiran  = $_POST["kehadiran"];

    if (empty($nama)) {
        echo "Nama tidak boleh kosong";
        exit;
    }
    if ($jumlah <= 0) {
        echo "Jumlah harus lebih dari 0";
        exit;
    }

$query_sql  = "INSERT INTO kehadiran (nama, jumlah, kehadiran) VALUES ('$nama', '$jumlah', '$kehadiran')";

if (mysqli_query($koneksi, $query_sql)) {
    header("Location: index.html");
}else {
    echo "Gagal menambahkan data: " . mysqli_error($koneksi);
}


?>