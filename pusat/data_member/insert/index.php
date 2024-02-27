<?php
// Definisi fungsi add_member
function add_member($conn, $data) {
    // Disini Anda harus menulis logika untuk menambahkan data member ke dalam database
    // Misalnya:
    $query = "INSERT INTO data_member (nama_member, alamat, email, telepon) VALUES ('".$data['nama_member']."', '".$data['alamat']."', '".$data['email']."', '".$data['telepon']."')";
    $result = mysqli_query($conn, $query);
    if ($result) {
        return mysqli_affected_rows($conn);
    } else {
        return 0;
    }
}

// cek apakah tombol submit sudah ditekan
if (isset($_POST['submit'])) {
    // membuat koneksi database
    $conn = mysqli_connect("localhost", "root", "", "kantin_im");

    // cek apakah data member berhasil ditambahkan
    if (add_member($conn, $_POST) > 0) {
        echo "<script>
        alert('Berhasil menambahkan member!');
        window.location.href = 'index.php?page=data_member'; // Ganti sesuai kebutuhan
        </script>";
    } else {
        echo "<script>
        alert('Gagal menambahkan member!');
        window.location.href = 'index.php?page=data_member'; // Ganti sesuai kebutuhan
        </script>";
    }

    // menutup koneksi database
    mysqli_close($conn);
}
?>

<a href="index.php" class="btn btn-primary mb-3"><i class="bi bi-chevron-left"></i> Kembali</a>
<div class="card card-body">
    <div class="table-responsive">
        <table class="table table-striped">
            <h2>Tambah Member</h2>
            <form action="" method="POST">
                <tr>
                    <td><label for="nama_member">Nama Member:</label></td>
                    <td><input type="text" name="nama_member" class="form-control" required></td>
                </tr>
                <td><label for="alamat">Alamat:</label></td>
                    <td><input type="text" name="alamat" class="form-control" required></td>
                </tr>
                <tr>
                    <td><label for="email">Email:</label></td>
                    <td><input type="email" name="email" class="form-control" required></td>
                </tr>
                <tr>
                    <td><label for="telepon">Telepon:</label></td>
                    <td><input type="tel" name="telepon" class="form-control" required></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name='submit' value="Tambah" class="btn btn-primary"></td>
                </tr>
            </form>
        </table>
    </div>
</div>
