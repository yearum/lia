<?php

// Definisi fungsi add_diskon
function add_diskon($conn, $data) {
    // Disini Anda harus menulis logika untuk menambahkan data diskon ke dalam database
    // Misalnya:
    $query = "INSERT INTO master_diskon (id_barang, nama_diskon, besar_diskon, tgl_mulai, tgl_akhir, produk_diskon, target_diskon) VALUES ('".$data['id_barang']."', '".$data['nama_diskon']."', '".$data['besar_diskon']."', '".$data['tgl_mulai']."', '".$data['tgl_akhir']."', '".$data['produk_diskon_target']."', '".$data['diskon']."')";
    $result = mysqli_query($conn, $query);
    if ($result) {
        return mysqli_affected_rows($conn);
    } else {
        return 0;
    }

    // Untuk contoh sederhana, saya akan mengembalikan 1
    return 1;
}

// Fungsi untuk memperbarui status diskon pada tabel produk
function update_produk_diskon_status($conn, $id_barang) {
    // Cek apakah ada data dengan id_barang yang sama di tabel master_diskon
    $query_check = "SELECT * FROM master_diskon WHERE id_barang = '".$id_barang."'";
    $result_check = mysqli_query($conn, $query_check);
    
    // Jika ada data, maka status_diskon menjadi 1, jika tidak, maka status_diskon menjadi 0
    $status_diskon = mysqli_num_rows($result_check) > 0 ? 1 : 0;

    // Update status_diskon pada tabel produk
    $query_update = "UPDATE produk SET status_diskon = '".$status_diskon."' WHERE id_barang = '".$id_barang."'";
    mysqli_query($conn, $query_update);
}

// Fungsi untuk mengurangi total produk sesuai dengan diskon jika status_diskon bernilai 1
function kurangi_total_dengan_diskon($conn, $id_barang, $total, $jumlah) {
    $produk_data = getProdukById($id_barang);
    $status_diskon = $produk_data['status_diskon'];

    if ($status_diskon == 1) {
        // Ambil besar_diskon dari tabel master_diskon sesuai id_barang
        $query_diskon = "SELECT besar_diskon FROM master_diskon WHERE id_barang = '".$id_barang."'";
        $result_diskon = mysqli_query($conn, $query_diskon);
        $diskon_row = mysqli_fetch_assoc($result_diskon);
        $besar_diskon = $diskon_row['besar_diskon'];

        // Kurangi total dengan besar_diskon dikalikan dengan jumlah
        $total -= $besar_diskon * $jumlah;
    }

    return $total;
}

// Ambil data produk
$produk = getProduk();

// Fungsi pengecekan dan pembaruan status diskon pada tabel produk saat halaman dibuka
foreach ($produk as $row) {
    update_produk_diskon_status($conn, $row['id_barang']);
}

// Proses input barang ke tabel kasir
if (isset($_POST['input_barang'])) {
    $id_barang = $_POST['id_barang'];
    $jumlah = $_POST['jumlah'];

    $produk_data = getProdukById($id_barang);
    $harga_jual = $produk_data['harga_jual'];
    $total = $harga_jual * $jumlah;

    // Kurangi total dengan diskon jika status_diskon bernilai 1, dikalikan dengan jumlah
    $total = kurangi_total_dengan_diskon($conn, $id_barang, $total, $jumlah);

    inputBarangKasir($id_barang, $jumlah, $total);
}

// Proses pembayaran
if (isset($_POST['bayar'])) {
    $bayar = $_POST['bayar'];

    // Validasi input adalah angka
    if (is_numeric($bayar)) {
        $kembalian = hitungKembalian($bayar);

        if (is_numeric($kembalian)) {
            if ($kembalian >= 0) {
                // Masukkan data ke tabel nota
                masukkanDataNota();
                kurangiStokBarang(); // Kurangi stok barang
                clearDataKasir(); // Hapus data dari tabel kasir

                // Pembaruan status diskon pada tabel produk
                if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $item) {
                        update_produk_diskon_status($conn, $item['id_barang']);
                    }
                }

                echo "<script>alert('Kembalian: Rp " . number_format($kembalian, 2, ",", ".") . "');</script>";
            } else {
                echo "<script>alert('Jumlah pembayaran tidak mencukupi.');</script>";
            }
        } else {
            // Jika kembalian bukan angka, tampilkan pesan kesalahan
            echo "<script>alert('$kembalian');</script>";
        }
    }
}

// Proses menghapus data di tabel kasir
if (isset($_POST["clear"])) {
    clearDataKasir();

    echo '<script>
    alert("Data berhasil dihapus");
    </script>';
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
                                            <?php echo $row['total']; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                        <p class='text-right'>
                            <?php echo "Rp " . number_format(hitungTotalHarga(), 2, ",", "."); ?>
                        </p>
                    </div>
                    <form method="POST" action="">
                        <br><br>
                        <label for="bayar">Bayar:</label>
                        <input type="number" name="bayar">
                        <br>
                        <input type="submit" name="beli" value="Bayar" class="btn btn-primary btn-sm">
                        <button name="clear" value="Clear" class="btn btn-primary btn-sm">Clear
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
