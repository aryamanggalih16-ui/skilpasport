<?php
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: tambah_barang.php?error=invalid');
    exit;
}

$nama_barang = trim($_POST['nama_barang'] ?? '');
$harga_barang = filter_input(INPUT_POST, 'harga_barang', FILTER_VALIDATE_INT);
$stock_barang = filter_input(INPUT_POST, 'stock_barang', FILTER_VALIDATE_INT);

if ($nama_barang === '' || $harga_barang === false || $harga_barang === null || $stock_barang === false || $stock_barang === null) {
    header('Location: tambah_barang.php?error=empty');
    exit;
}

$createTableSQL = "
    CREATE TABLE IF NOT EXISTS barang (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nama_barang VARCHAR(100) NOT NULL,
        harga_barang INT NOT NULL,
        stock_barang INT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )
";

if (!mysqli_query($conn, $createTableSQL)) {
    die('Gagal membuat tabel barang: ' . mysqli_error($conn));
}

$sql = "INSERT INTO barang (nama_barang, harga_barang, stock_barang) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    header('Location: tambah_barang.php?error=invalid');
    exit;
}

mysqli_stmt_bind_param($stmt, 'sii', $nama_barang, $harga_barang, $stock_barang);

if (mysqli_stmt_execute($stmt)) {
    header('Location: stock_barang.php?success=added');
    exit;
}

header('Location: tambah_barang.php?error=invalid');
exit;
