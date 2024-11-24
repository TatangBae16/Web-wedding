<?php
require 'koneksi.php'; // Memanggil koneksi ke database

// Cek apakah form dikirim menggunakan metode POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ambil data dari form
    $nama = isset($_POST["nama"]) ? mysqli_real_escape_string($koneksi, $_POST["nama"]) : null;
    $jumlah = isset($_POST["jumlah"]) ? (int)$_POST["jumlah"] : null;
    $kehadiran = isset($_POST["kehadiran"]) ? mysqli_real_escape_string($koneksi, $_POST["kehadiran"]) : null;

    // Validasi data
    if (empty($nama)) {
        echo "Nama tidak boleh kosong.";
        exit;
    }
    if ($jumlah <= 0) {
        echo "Jumlah kehadiran harus lebih dari 0.";
        exit;
    }
    if ($kehadiran !== "Hadir" && $kehadiran !== "Tidak Hadir") {
        echo "Konfirmasi kehadiran tidak valid.";
        exit;
    }

    // Masukkan data ke tabel `rsvp`
    $query_sql = "INSERT INTO rsvp (nama, jumlah, kehadiran) VALUES ('$nama', $jumlah, '$kehadiran')";
    
    if (mysqli_query($koneksi, $query_sql)) {
        echo "Data berhasil disimpan.";
        header("Location: sukses.html"); // Alihkan ke halaman sukses
        exit;
    } else {
        echo "Gagal menyimpan data: " . mysqli_error($koneksi);
    }
} else {
    echo "Metode pengiriman tidak valid.";
    exit;
}
?>
