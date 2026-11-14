<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Admin</title>
</head>
<body>
    <h1>Buat Akun Admin</h1>

    <?php if (isset($_GET['error'])): ?>
        <p style="color: red;">
            <?php
            $error = $_GET['error'];
            if ($error === 'empty') echo 'Semua field wajib diisi.';
            elseif ($error === 'match') echo 'Konfirmasi password tidak cocok.';
            elseif ($error === 'exists') echo 'Username sudah digunakan. Pilih username lain.';
            else echo 'Registrasi gagal.';
            ?>
        </p>
    <?php endif; ?>

    <form action="proses_register.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="confirm_password">Konfirmasi Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required><br><br>

        <input type="submit" value="Daftar">
    </form>
        <p><a href="login_admin.php">kembali</a></p>
</body>
</html>
