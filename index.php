<?php
include 'template/header.php';
include 'template/navbar.php';

if (!empty($_GET['page'])) {
    include 'module/' . $_GET['page'] . '/index.php';
} else {
    include 'template/content.php';
}

include 'template/footer.php';
?>
