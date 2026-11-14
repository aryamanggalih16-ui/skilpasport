<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
</head>
<body>
    <h1>Login Admin</h1>

    <?php if (isset($_GET['error'])): ?>
        <p style="color: red;">
            <?php
            $error = $_GET['error'];
            if ($error === 'empty') echo 'Username dan password wajib diisi.';
            elseif ($error === 'invalid') echo 'Username atau password salah.';
            elseif ($error === 'login_required') echo 'Silakan login terlebih dahulu.';
            else echo 'Login gagal.';
            ?>
        </p>
    <?php endif; ?>

    <?php if (isset($_GET['success'])): ?>
        <p style="color: green;">
            <?php echo 'Akun berhasil dibuat, silakan login.'; ?>
        </p>
    <?php endif; ?>

    <form action="proses_login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Login">
    </form>

    <p>Belum punya akun? <a href="register_admin.php">Buat akun baru</a></p>
</body>
</html>