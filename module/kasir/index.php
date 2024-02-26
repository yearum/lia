<?php
// Ambil data produk
$produk = getProduk();

// Fungsi untuk menghitung total harga di keranjang
function hitungTotalHarga($kasir) {
    $totalHarga = 0;

    foreach ($kasir as $row) {
        $totalHarga += $row['total'];
    }

    return $totalHarga;
}

// Fungsi untuk memasukkan barang ke keranjang kasir
function inputBarangKasir($id_barang, $jumlah, $total) {
    global $conn;

    // Query untuk menambahkan barang ke keranjang kasir
    $query = "INSERT INTO kasir (id_barang, jumlah, total) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sii", $id_barang, $jumlah, $total); // Menggunakan 's' untuk string dan 'i' untuk integer
    $stmt->execute();
}

// Proses input barang ke tabel kasir
if (isset($_POST['input_barang'])) {
    $id_barang = $_POST['id_barang'];
    $jumlah = $_POST['jumlah'];

    $produk_data = getProdukById($id_barang);
    $harga_jual = $produk_data['harga_jual'];
    $total = $harga_jual * $jumlah;

    inputBarangKasir($id_barang, $jumlah, $total);
}

// Proses pembayaran
if (isset($_POST['bayar'])) {
    $bayar = $_POST['bayar_input'];

    // Validasi input adalah angka
    if (is_numeric($bayar)) {
        $kasir = getDataKasir();
        $totalHarga = hitungTotalHarga($kasir);

        // Periksa apakah uang yang dibayarkan mencukupi
        if ($bayar >= $totalHarga) {
            $kembalian = $bayar - $totalHarga;

            // Masukkan data ke tabel nota
            masukkanDataNota($kasir);
            kurangiStokBarang(); // Kurangi stok barang
            clearDataKasir(); // Hapus data dari tabel kasir

            echo "<script>alert('Transaksi berhasil. Kembalian: Rp " . number_format($kembalian, 2, ",", ".") . "');</script>";
        } else {
            echo "<script>alert('Jumlah pembayaran tidak mencukupi.');</script>";
        }
    } else {
        echo "<script>alert('Input pembayaran harus berupa angka.');</script>";
    }
}

// Proses menghapus data di tabel kasir
if (isset($_POST['clear'])) {
    clearDataKasir(); // Panggil fungsi untuk menghapus data dari tabel kasir
}

function clearDataKasir() {
    global $conn;

    $query = "DELETE FROM kasir";
    $conn->query($query);
}

// Fungsi untuk memasukkan data dari tabel kasir ke tabel nota
function getLastNotaId() {
    global $conn;

    $query = "SELECT MAX(id_nota) AS last_id FROM nota";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $last_id = $row['last_id'];

    if ($last_id === null) {
        return 'N000';
    } else {
        // Mengambil angka dari ID terakhir, menambahkan 1, dan memformat ulang ke pola yang diinginkan
        $number = intval(substr($last_id, 1)) + 1;
        return 'N' . sprintf('%03d', $number);
    }
}

function masukkanDataNota($kasir) {
    global $conn;

    $id_nota = getLastNotaId();

    foreach ($kasir as $barang) {
        $id_barang = $barang['id_barang'];

        // Periksa apakah id_barang ada dalam tabel produk
        $query_check = "SELECT COUNT(*) AS jumlah FROM produk WHERE id_barang = ?";
        $stmt_check = $conn->prepare($query_check);
        $stmt_check->bind_param("s", $id_barang);
        $stmt_check->execute();
        $result = $stmt_check->get_result();
        $row = $result->fetch_assoc();

        if ($row['jumlah'] > 0) {
            $jumlah = $barang['jumlah'];
            $total = $barang['total'];
            $tgl_input = date('Y-m-d H:i:s');

            $query = "INSERT INTO nota (id_nota, id_barang, jumlah, total, tgl_input) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssiss", $id_nota, $id_barang, $jumlah, $total, $tgl_input);
            $stmt->execute();
        } else {
            // Jika id_barang tidak ada dalam tabel produk, berikan pesan kesalahan atau tindakan lainnya
            echo "<script>alert('Barang dengan ID $id_barang tidak ditemukan.');</script>";
        }
    }

    return $id_nota;
}

?>
<div class="card mt-5">
    <div class='row'>
        <div class='col-md-8 mb-4'>
            <div class='card mb-4'>
                <div class="card-header py-3">
                    <h2 class='mb-0'>Kasir</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="">
                        <div class="form-outline mb-4">
                            <label for="id_barang">Nama Barang:</label>
                            <select name="id_barang" class='form-control'>
                                <?php foreach ($produk as $row): ?>
                                    <option value="<?php echo $row['id_barang']; ?>"><?php echo $row['nama_barang']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-outline mb-4">
                            <label for="jumlah">Jumlah:</label>
                            <input type="number" name="jumlah" required class='form-control'>
                        </div>
                        <br>
                        <input type="submit" name="input_barang" value="Tambahkan ke Kasir"
                            class="btn btn-primary btn-lg btn-block">
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card mb-4">
                <div class="card-header py-3">
                    <?php $kasir = getDataKasir(); ?>
                    <h2 class="mb-0">Keranjang</h2>
                    <div class="card-body">
                        <div class='table-responsive'>
                            <table class='table'>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
                                </tr>
                                <?php foreach ($kasir as $row): ?>
                                    <tr>
                                        <td>
                                            <?php echo getProdukById($row['id_barang'])['nama_barang']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['jumlah']; ?>
                                        </td>
                                        <td>
                                            <?php echo "Rp " . number_format($row['total'], 2, ",", "."); ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                        <p class='text-right'>
                            <?php echo "Total: Rp " . number_format(hitungTotalHarga($kasir), 2, ",", "."); ?>
                        </p>
                    </div>
                    <form method="POST" action="">
                        <br><br>
                        <label for="bayar_input">Bayar:</label>
                        <input type="number" name="bayar_input" required>
                        <br>
                        <input type="submit" name="bayar" value="Bayar" class="btn btn-primary btn-sm">
                        <button type="submit" name="clear" value="Clear" class="btn btn-primary btn-sm">Clear
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
