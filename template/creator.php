<?php
require 'function.php';

// Periksa apakah sesi belum dimulai sebelum memanggil session_start()
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
    header("Location: register.php");
    exit();
}

// Inisialisasi koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "kantin_im");

// Periksa koneksi database
if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iki toko lurrd</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <div class="sidebar bg-primary text-white p-4">
        <h4 class="mb-5">IKI TOKO LURRD</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link text-white" href="index.php">
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="index.php?page=master_diskon">
                    Master Diskon
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="index.php?page=data_barang">
                    Data Barang
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="index.php?page=stok_barang">
                    Stok Barang
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="index.php?page=data_member">
                    Data Member
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="index.php?page=laporan">
                    Laporan
                </a>
            </li>
        </ul>
    </div>
    <div class="container-fluid">
        <div class="content">
            <?php
            // query master diskon
            $sqlDiskon = "SELECT COUNT(*) AS total_diskon FROM master_diskon";
            $resultDiskon = $conn->query($sqlDiskon);

            // query data barang
            $sqlBarang = "SELECT COUNT(*) AS total_barang FROM produk";
            $resultBarang = $conn->query($sqlBarang);

            // query stok barang
            $sqlStok = "SELECT SUM(stok) AS total_stok FROM stok_barang";
            $resultStok = $conn->query($sqlStok);

            // query data member
            $sqlMember = "SELECT COUNT(*) AS total_member FROM data_member";
            $resultMember = $conn->query($sqlMember);
            ?>
            <div class="badan">
                <h2>Dashboard</h2>
                <br>
                <?php if ($resultDiskon && $resultBarang && $resultStok && $resultMember) {
                    $rowDiskon = $resultDiskon->fetch_assoc();
                    $total_diskon = $rowDiskon['total_diskon'];

                    // Ambil nilai total barang
                    $rowBarang = $resultBarang->fetch_assoc();
                    $total_barang = $rowBarang['total_barang'];

                    // Ambil nilai total stok barang
                    $rowStok = $resultStok->fetch_assoc();
                    $totalStok = $rowStok['total_stok'];

                    // Ambil nilai total member
                    $rowMember = $resultMember->fetch_assoc();
                    $totalMember = $rowMember['total_member'];
                    ?>
                    <div class="d-flex flex-row bd-highlight mb-3">
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="pt-2"><i class="bi bi-percent mr-2"></i> Master Diskon</h6>
                                </div>
                                <div class="card-body">
                                    <center>
                                        <h1>
                                            <?= $total_diskon ?>
                                        </h1>
                                    </center>
                                </div>
                                <div class="card-footer">
                                    <a href='index.php?page=master_diskon'>Tabel Master Diskon</a>
                                </div>
                            </div>
                            <!--/card -->
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="pt-2"><i class="bi bi-box mr-2"></i> Data Barang</h6>
                                </div>
                                <div class="card-body">
                                    <center>
                                        <h1>
                                            <?= $total_barang ?>
                                        </h1>
                                    </center>
                                </div>
                                <div class="card-footer">
                                    <a href='index.php?page=data_barang'>Tabel Data Barang</a>
                                </div>
                            </div>
                            <!--/card -->
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="pt-2"><i class="bi bi-archive mr-2"></i> Stok Barang</h6>
                                </div>
                                <div class="card-body">
                                    <center>
                                        <h1>
                                            <?= $totalStok ?>
                                        </h1>
                                    </center>
                                </div>
                                <div class="card-footer">
                                    <a href='index.php?page=stok_barang'>Tabel Stok Barang</a>
                                </div>
                            </div>
                            <!--/card -->
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="pt-2"><i class="bi bi-person-check mr-2"></i> Data Member</h6>
                                </div>
                                <div class="card-body">
                                    <center>
                                        <h1>
                                            <?= $totalMember ?>
                                        </h1>
                                    </center>
                                </div>
                                <div class="card-footer">
                                    <a href='index.php?page=data_member'>Tabel Data Member</a>
                                </div>
                            </div>
                            <!--/card -->
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</body>

</html>
