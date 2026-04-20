<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $status = $_POST['status'];
    $komentar = $_POST['komentar'];
    $bintang = $_POST['bintang'];

    // 1. Logika Foto (Cek apakah ada file yang diunggah)
    if (!empty($_FILES['foto']['name'])) {
        $foto_nama = $_FILES['foto']['name'];
        $foto_tmp = $_FILES['foto']['tmp_name'];
        $foto_baru = time() . "_" . $foto_nama;
        $path = "assets/img/" . $foto_baru;

        // Pindahkan file
        if (!move_uploaded_file($foto_tmp, $path)) {
            die("Gagal upload foto! Cek folder assets/img sudah dibuat belum?");
        }
    } else {
        // Jika tidak ada foto, gunakan default
        $foto_baru = "default.jpg";
    }

    // 2. Query Simpan (Pastikan pakai $konek sesuai file koneksi.php kamu)
    $query = "INSERT INTO testimoni (nama, status, komentar, foto, bintang) 
              VALUES ('$nama', '$status', '$komentar', '$foto_baru', '$bintang')";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Testimoni terkirim!'); window.location='index.php#testimoni';</script>";
    } else {
        echo "Gagal simpan data: " . mysqli_error($koneksi);
    }
}
?>