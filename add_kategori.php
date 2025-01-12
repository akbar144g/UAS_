<?php
include "connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_kategori = trim($_POST['nama_kategori']);

    if (!empty($nama_kategori)) {
        try {
            $stmt = $dbh->prepare("INSERT INTO kategori (nama_kategori) VALUES (:nama_kategori)");
            $stmt->bindParam(':nama_kategori', $nama_kategori);
            $stmt->execute();

            header("Location: dashboard.php?success=Kategori berhasil ditambahkan");
            exit;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        header("Location: dashboard.php?error=Nama kategori tidak boleh kosong");
        exit;
    }
} else {
    header("Location: dashboard.php");
    exit;
}
?>
