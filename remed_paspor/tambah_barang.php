<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Barang</title>
</head>
<body>
    <h1>Tambah Barang</h1>

    <?php if (isset($_GET['error'])): ?>
        <p style="color: red;">
            <?php
            $error = $_GET['error'];
            if ($error === 'empty') echo 'Nama barang, harga, dan jumlah wajib diisi.';
            else echo 'Tambah barang gagal.';
            ?>
        </p>
    <?php endif; ?>

    <form action="proses_tambah_barang.php" method="post">
        <label for="nama_barang">Nama Barang:</label>
        <input type="text" id="nama_barang" name="nama_barang" required><br><br>

        <label for="harga_barang">Harga:</label>
        <input type="number" id="harga_barang" name="harga_barang" min="0" required><br><br>

        <label for="stock_barang">Stock:</label>
        <input type="number" id="stock_barang" name="stock_barang" min="0" required><br><br>

        <input type="submit" value="Tambah Barang">
    </form>

    <p><a href="stock_barang.php">Lihat Stock Barang</a></p>
</body>
</html>