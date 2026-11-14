<?php
require_once 'koneksi.php';

$pesan = '';

if (isset($_GET['success']) && $_GET['success'] === 'added') {
    $pesan = 'Barang berhasil ditambahkan.';
}

$data_barang = mysqli_query($conn, 'SELECT nama_barang, harga_barang, stock_barang FROM barang ORDER BY nama_barang ASC');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Stock Barang</title>
</head>
<body>
    <h1>Stock Barang</h1>

    <?php if ($pesan !== ''): ?>
        <p style="color: green;"><?= htmlspecialchars($pesan, ENT_QUOTES, 'UTF-8') ?></p>
    <?php endif; ?>

    <p><a href="tambah_barang.php">Tambah Barang Baru</a></p>

    <table border="1">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Harga Barang</th>
                <th>Stock Barang</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($data_barang && mysqli_num_rows($data_barang) > 0): ?>
                <?php while ($barang = mysqli_fetch_assoc($data_barang)): ?>
                    <tr>
                        <td><?= htmlspecialchars($barang['nama_barang'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= number_format((int) $barang['harga_barang'], 0, ',', '.') ?></td>
                        <td><?= (int) $barang['stock_barang'] ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">Tidak ada data barang</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>