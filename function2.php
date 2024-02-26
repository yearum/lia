<?php
require_once 'function.php';

// Membuat koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "kantin_im");

// Pastikan koneksi ke database tersedia
if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// query master diskon
$sqlDiskon = "SELECT COUNT(*) AS total_diskon FROM master_diskon";
$resultDiskon = $conn->query($sqlDiskon);

// query data barang
$sqlBarang = "SELECT COUNT(*) AS total_barang FROM barang"; // Mengganti 'data_barang' dengan 'barang'
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
                        <a href='master_diskon.php'>Tabel Master Diskon</a>
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
                        <a href='data_barang.php'>Tabel Data Barang</a>
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
                        <a href='stok_barang.php'>Tabel Stok Barang</a>
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
                        <a href='data_member.php'>Tabel Data Member</a>
                    </div>
                </div>
                <!--/card -->
            </div>
        </div>
    <?php } ?>
</div>
