<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
    // Jika belum login, redirect ke halaman login
    header("Location: login.php");
    exit;
}

// Cek apakah pengguna adalah admin
if ($_SESSION['user'] == 'admin') {
    // Jika admin, tampilkan halaman admin
    include 'template/header.php';
    include 'template/navbar.php';

    if (!empty($_GET['page'])) {
        include 'module/' . $_GET['page'] . '/index.php';
    } else {
        include 'template/content.php';
    }

    include 'template/footer.php';
} else {
    // Jika bukan admin, tampilkan halaman non-admin
    include 'majalah/header.php';
    include 'majalah/navbar.php';

    if (!empty($_GET['page'])) {
        include 'pusat/' . $_GET['page'] . '/index.php';
    } else {
        include 'template/creator.php';
    }

    include 'template/footer.php';
}
?>
