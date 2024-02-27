<?php
include 'majalah/header.php';
include 'majalah/navbar.php';


if (!empty($_GET['page'])) {
        include 'pusat/' . $_GET['page'] . '/index.php';
} else {
    // Jika parameter 'page' tidak diberikan, tampilkan konten pusat
    include 'template/creator.php';
}

include 'template/footer.php';
?>
