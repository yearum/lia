<?php
require 'majalah/header.php';
require 'majalah/navbar.php';

if (!empty($_GET['page'])) {
    $page = $_GET['page'];
    if ($page === 'dashboard' || $page === 'data_barang' || $page === 'stok_barang' || $page === 'data_member' || $page === 'laporan') {
        include 'pusat/controller/' . $page . '.php';
    } else {
        include 'pusat/' . $page . '/prapal.php';
    }
} else {
    include 'template/creator.php';
}

include 'template/footer.php';
?>
