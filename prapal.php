<?php
include 'majalah/header.php';
include 'majalah/navbar.php';

if (!empty($_GET['page'])) {
    $page = $_GET['page'];
    if ($page === 'dashboard' || $page === 'data_barang' || $page === 'stok_barang' || $page === 'data_member' || $page === 'laporan') {
        include 'pusat/controller/' . $page . '.php';
    } else {
        // Jika parameter 'page' tidak sesuai dengan yang ada di pusat, tampilkan konten pusat
        include 'template/creator.php';
    }
} else {
    // Jika parameter 'page' tidak diberikan, tampilkan konten pusat
    include 'template/creator.php';
}

include 'template/footer.php';
?>
