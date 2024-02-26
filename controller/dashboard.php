<?php
require_once 'function.php'; // Sertakan file function.php di sini

// Membuat koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "kantin_im");

// Pastikan koneksi ke database tersedia
if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Query master diskon
$sqlDiskon = "SELECT COUNT(*) AS total_diskon FROM master_diskon";
$resultDiskon = $conn->query($sqlDiskon);

// Query data barang
$sqlBarang = "SELECT COUNT(*) AS total_barang FROM barang"; // Mengganti 'data_barang' dengan 'barang'
$resultBarang = $conn->query($sqlBarang);

// Query stok barang
$sqlStok = "SELECT SUM(stok) AS total_stok FROM stok_barang";
$resultStok = $conn->query($sqlStok);

// Query data member
$sqlMember = "SELECT COUNT(*) AS total_member FROM data_member";
$resultMember = $conn->query($sqlMember);
?>
