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

// cek apakah tombol submit sudah ditekan
if (isset($_POST['submit'])) {
    // membuat koneksi database
    $conn = mysqli_connect("localhost", "root", "", "kantin_im");

    // cek apakah data diskon berhasil ditambahkan
    if (add_diskon($conn, $_POST) > 0) {
        echo "<script>
        alert('Berhasil menambahkan diskon!');
        window.location.href = 'index.php?page=master_diskon';
        </script>";
    } else {
        echo "<script>
        alert('Gagal menambahkan diskon!');
        window.location.href = 'index.php?page=master_diskon';
        </script>";
    }

    // menutup koneksi database
    mysqli_close($conn);
}

?>

<a href="index.php?page=master_diskon" class="btn btn-primary mb-3"><i class="bi bi-chevron-left"></i> Kembali</a>
<div class="card card-body">
    <div class="table-responsive">
        <table class="table table-striped">
            <h2>Tambah Diskon</h2>
            <form action="" method="POST">
                <tr>
                    <td><label for="id_barang">ID Barang:</label></td>
                    <td><input type="text" name="id_barang" class="form-control"></td>
                </tr>
                <td><label for="nama_diskon">Nama Diskon:</label></td>
                    <td><input type="text" name="nama_diskon" class="form-control"></td>
                </tr>
                <tr>
                    <td><label for="besar_diskon">Besar Diskon:</label></td>
                    <td><input type="text" name="besar_diskon" class="form-control"></td>
                </tr>
                <tr>
                    <td><label for="tgl_mulai">Tanggal Mulai:</label></td>
                    <td><input type="date" name="tgl_mulai" class="form-control"></td>
                </tr>
                <tr>
                    <td><label for="tgl_akhir">Tanggal Akhir:</label></td>
                    <td><input type="date" name="tgl_akhir" class="form-control"></td>
                </tr>
                <tr>
                    <td><label for="produk_diskon_target">Produk Diskon:</label></td>
                    <td><input type="text" name="produk_diskon_target" class="form-control"></td>
                </tr>
                <tr>
                    <td><label for="diskon">Target Diskon:</label></td>
                    <td><input type="text" name="diskon" class="form-control"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name='submit' value="Tambah" class="btn btn-primary"></td>
                </tr>
            </form>
        </table>
    </div>
</div>
