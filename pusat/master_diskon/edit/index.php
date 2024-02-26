<?php

// Fungsi untuk mengupdate data diskon dalam database
function edit_diskon($data) {
    // Menggunakan koneksi database yang telah tersedia
    global $conn;
    
    // Mengekstrak data dari array POST
    $id_diskon = $data['id_diskon'];
    $id_barang = $data['id_barang'];
    $nama_diskon = $data['nama_diskon'];
    $besar_diskon = $data['besar_diskon'];
    $tgl_mulai = $data['tgl_mulai'];
    $tgl_akhir = $data['tgl_akhir'];
    $produk_diskon_target = $data['produk_diskon_target'];
    $diskon = $data['diskon'];
    
    // Query SQL untuk mengupdate data diskon
    $query = "UPDATE master_diskon SET 
                id_barang = '$id_barang',
                nama_diskon = '$nama_diskon',
                besar_diskon = '$besar_diskon',
                tgl_mulai = '$tgl_mulai',
                tgl_akhir = '$tgl_akhir',
                produk_diskon_target = '$produk_diskon_target',
                diskon = '$diskon'
              WHERE id_diskon = '$id_diskon'";
    
    // Menjalankan query SQL
    $result = mysqli_query($conn, $query);
    
    // Mengembalikan jumlah baris yang terpengaruh
    if ($result) {
        return mysqli_affected_rows($conn);
    } else {
        return 0; // Mengembalikan 0 jika terjadi kesalahan
    }
}

// Cek apakah tombol submit sudah ditekan
if (isset($_POST["submit"])) {
    // Panggil fungsi edit_diskon dan cek hasilnya
    $result_edit = edit_diskon($_POST);
    if ($result_edit > 0) {
        echo "<script>
        alert('Berhasil mengupdate diskon!');
        window.location.href = 'index.php?page=master_diskon';
        </script>";
    } else {
        echo "<script>
        alert('Gagal mengupdate diskon!');
        window.location.href = 'index.php?page=master_diskon';
        </script>";
    }
}

?>

<a href="index.php?page=master_diskon" class="btn btn-primary mb-3"><i class="bi bi-chevron-left"></i> Kembali</a>
<div class="card card-body">
    <div class="table-responsive">
        <table class="table table-striped">
            <h2>Edit Diskon</h2>
            <form action="" method="POST">
                <tr>
                    <td><label for="id_diskon">ID Diskon</label></td>
                    <td><input type="text" name="id_diskon" value="<?php echo $diskon['id_diskon']; ?>" readonly class="form-control"></td>
                </tr>
                <!-- Isi form dengan data diskon yang ingin diupdate -->
                <tr>
                    <td><label for="id_barang">ID Barang:</label></td>
                    <td><input type="text" name="id_barang" value="<?php echo $diskon['id_barang']; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td><label for="nama_diskon">Nama Diskon:</label></td>
                    <td><input type="text" name="nama_diskon" value="<?php echo $diskon['nama_diskon']; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td><label for="besar_diskon">Besar Diskon:</label></td>
                    <td><input type="text" name="besar_diskon" value="<?php echo $diskon['besar_diskon']; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td><label for="tgl_mulai">Tanggal Mulai:</label></td>
                    <td><input type="date" name="tgl_mulai" value="<?php echo $diskon['tgl_mulai']; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td><label for="tgl_akhir">Tanggal Akhir:</label></td>
                    <td><input type="date" name="tgl_akhir" value="<?php echo $diskon['tgl_akhir']; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td><label for="produk_diskon_target">Produk Diskon Target:</label></td>
                    <td><input type="text" name="produk_diskon_target" value="<?php echo $diskon['produk_diskon_target']; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td><label for="diskon">Diskon:</label></td>
                    <td><input type="text" name="diskon" value="<?php echo $diskon['diskon']; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name='submit' value="Update" class="btn btn-primary"></td>
                </tr>
            </form>
        </table>
    </div>
</div>
