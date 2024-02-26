<?php
// Inisialisasi variabel
$result = null;
$totalKeuntungan = 0;

// Cek jika terdapat parameter tanggal pada URL
if (isset($_GET['tanggal'])) {
    $tanggal = $_GET['tanggal'];

    // Query untuk mencari nota berdasarkan tanggal input
    $sql = "SELECT * FROM nota WHERE tgl_input = '$tanggal'";
    $result = $conn->query($sql);

    // Menghitung total keuntungan per tanggal
    $totalKeuntungan = 0;
    foreach ($result as $row) {
        $totalKeuntungan += $row['total'];
    }
}
?>
<div class="card mt-5">
    <div class="card-header">
        <h2>Tabel Laporan</h2>
    </div>
    <div class="card-body">
        <p>Cari laporan berdasarkan tanggal input:</p>
        <!-- Form input tanggal -->
        <form method="GET" action="index.php" class="row g-3">
            <input type="hidden" name="page" value="laporan">
            <div class="col-auto">
                <input type="date" name="tanggal" id="tanggal" class="form-control" required>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </form>
        <br>
        <?php if (isset($_GET['tanggal']) && $result && $result->num_rows > 0): ?>
            <h5 class='text-right'>
                <?= $tanggal ?>
            </h5>
        <?php endif; ?>

        <table class="table table-hover table-dark">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">ID Nota</th>
                    <th scope="col">ID Barang</th>
                    <th scope="col">Nama Kasir</th>
                    <th scope="col">Total</th>
                    <th scope="col">Tanggal Input</th>
                </tr>
            </thead>
            <?php $i = 1; ?>
            <tbody>
                <?php if (is_array($result) || is_object($result)): ?>
                    <?php foreach ($result as $row): ?>
                        <tr>
                            <td>
                                <?= $i ?>
                            </td>
                            <td>
                                <?= $row['id_nota'] ?>
                            </td>
                            <td>
                                <?= $row['id_barang'] ?>
                            </td>
                            <td>
                                <?= $row['nama_kasir'] ?>
                            </td>
                            <td>
                                <?= $row['total'] ?>
                            </td>
                            <td>
                                <?= $row['tgl_input'] ?>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
                <tr>
                    <td colspan="4"></td>
                    <th>Total Keuntungan</th>
                    <td><?= $totalKeuntungan ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
