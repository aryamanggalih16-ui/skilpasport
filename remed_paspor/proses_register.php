<?php
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: register_admin.php?error=invalid');
    exit;
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';
$confirmPassword = $_POST['confirm_password'] ?? '';

if ($username === '' || $password === '' || $confirmPassword === '') {
    header('Location: register_admin.php?error=empty');
    exit;
}

if ($password !== $confirmPassword) {
    header('Location: register_admin.php?error=match');
    exit;
}

$createTableSQL = "
    CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )
";

if (!mysqli_query($conn, $createTableSQL)) {
    die('Gagal membuat tabel users: ' . mysqli_error($conn));
}

$checkSql = "SELECT id FROM users WHERE username = ? LIMIT 1";
$checkStmt = mysqli_prepare($conn, $checkSql);

if (!$checkStmt) {
    die('Gagal menyiapkan query cek username: ' . mysqli_error($conn));
}

mysqli_stmt_bind_param($checkStmt, 's', $username);
mysqli_stmt_execute($checkStmt);
mysqli_stmt_store_result($checkStmt);

if (mysqli_stmt_num_rows($checkStmt) > 0) {
    header('Location: register_admin.php?error=exists');
    exit;
}

$passwordHash = password_hash($password, PASSWORD_DEFAULT);
$insertSql = "INSERT INTO users (username, password) VALUES (?, ?)";
$insertStmt = mysqli_prepare($conn, $insertSql);

if (!$insertStmt) {
    die('Gagal menyiapkan query insert: ' . mysqli_error($conn));
}

mysqli_stmt_bind_param($insertStmt, 'ss', $username, $passwordHash);

if (mysqli_stmt_execute($insertStmt)) {
    header('Location: login_admin.php?success=registered');
    exit;
}

header('Location: register_admin.php?error=invalid');
exit;
