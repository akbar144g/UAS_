<?php
include "connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_barang = trim($_POST['nama_barang']);
    $harga = trim($_POST['harga']);
    $kategori_id = trim($_POST['kategori_id']);

    if (!empty($nama_barang) && !empty($harga) && !empty($kategori_id)) {
        try {
            $stmt = $dbh->prepare("INSERT INTO barang (nama_barang, harga, kategori_id) VALUES (:nama_barang, :harga, :kategori_id)");
            $stmt->bindParam(':nama_barang', $nama_barang);
            $stmt->bindParam(':harga', $harga);
            $stmt->bindParam(':kategori_id', $kategori_id);
            $stmt->execute();

            header("Location: dashboard.php?success=Barang berhasil ditambahkan");
            exit;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        header("Location: dashboard.php?error=Semua field harus diisi");
        exit;
    }
} else {
    header("Location: dashboard.php");
    exit;
}
?>
