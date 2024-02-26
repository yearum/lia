<?php
// Koneksi ke database
$conn = new mysqli("localhost", "username", "password", "kantin_im");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Fungsi untuk menambahkan member ke dalam database
function add_member($data) {
    global $conn;
    
    $nama = $data['nama'];
    $alamat = $data['alamat'];
    $nomor_handphone = $data['nomor_handphone'];

    $sql = "INSERT INTO member (nama, alamat, nomor_handphone) VALUES ('$nama', '$alamat', '$nomor_handphone')";
    
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Periksa apakah tombol submit sudah ditekan
if (isset($_POST['submit'])) {
    // Panggil fungsi add_member jika tombol submit ditekan
    if (add_member($_POST)) {
        echo "<script>
        alert('Berhasil menambahkan member!');
        window.location.href = 'index.php?page=member';
        </script>";
    } else {
        echo "<script>
        alert('Gagal menambahkan member!');
        window.location.href = 'index.php?page=member';
        </script>";
    }
}
?>

<a href="index.php?page=member" class="btn btn-primary mb-3"><i class="bi bi-chevron-left"></i> Kembali</a>
<div class="card card-body">
    <div class="table-responsive">
        <table class="table table-striped">
            <h2>Tambah Member</h2>
            <form action="" method="POST">
                <tr>
                    <td><label for="nama">Nama</label></td>
                    <td><input type="text" name="nama" class="form-control"></td>
                </tr>
                <tr>
                    <td><label for="alamat">Alamat</label></td>
                    <td><input type="text" name="alamat" class="form-control"></td>
                </tr>
                <tr>
                    <td><label for="nomor_handphone">Nomor Handphone</label></td>
                    <td><input type="text" name="nomor_handphone" class="form-control"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="submit" value="Tambah" class="btn btn-primary"></td>
                </tr>
            </form>
        </table>
    </div>
</div>

<?php
// Tutup koneksi database
$conn->close();
?>
