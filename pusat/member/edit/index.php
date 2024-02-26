<?php
// Function to establish database connection
$conn = mysqli_connect("localhost", "username", "password", "kantin_im");

// Function to execute SQL query
function query($sql) {
    global $conn;
    $result = mysqli_query($conn, $sql);

    // Check for errors
    if (!$result) {
        echo "Error: " . mysqli_error($conn);
    }

    // Fetch data
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    // Free result set
    mysqli_free_result($result);

    return $rows;
}

// Function to edit member
function edit_member($data) {
    global $conn;
    $id_member = $data['id_member'];
    $nama = $data['nama'];
    $alamat = $data['alamat'];
    $nomor_handphone = $data['nomor_handphone'];

    $sql = "UPDATE member SET nama='$nama', alamat='$alamat', nomor_handphone='$nomor_handphone' WHERE id_member='$id_member'";
    $result = mysqli_query($conn, $sql);

    // Check for errors
    if (!$result) {
        echo "Error: " . mysqli_error($conn);
        return 0;
    }

    // Return the number of affected rows
    return mysqli_affected_rows($conn);
}

// Mendapatkan ID member dari URL
$id_member = $_GET["id_member"];

// Melakukan query untuk mendapatkan data member berdasarkan ID
$member = query("SELECT * FROM member WHERE id_member = '$id_member'")[0];

// Jika tombol submit ditekan
if (isset($_POST["submit"])) {
    if (edit_member($_POST) > 0) {
        echo "<script>
        alert('Berhasil mengupdate member!');
        window.location.href = 'index.php?page=member';
        </script>";
    } else {
        echo "<script>
        alert('Gagal mengupdate member!');
        window.location.href = 'index.php?page=member';
        </script>";
    }
}
?>

<a href="index.php?page=member" class="btn btn-primary mb-3"><i class="bi bi-chevron-left"></i> Kembali</a>
<div class="card card-body">
    <div class="table-responsive">
        <table class="table table-striped">
            <h2>Edit Member</h2>
            <form action="" method="POST">
                <tr>
                    <td><label for="id_member">ID Member</label></td>
                    <td><input type="text" name="id_member" value="<?php echo $member['id_member']; ?>" readonly class="form-control"></td>
                </tr>
                <tr>
                    <td><label for="nama">Nama:</label></td>
                    <td><input type="text" name="nama" value="<?php echo $member['nama']; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td><label for="alamat">Alamat:</label></td>
                    <td><input type="text" name="alamat" value="<?php echo $member['alamat']; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td><label for="nomor_handphone">Nomor Handphone:</label></td>
                    <td><input type="text" name="nomor_handphone" value="<?php echo $member['nomor_handphone']; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="submit" value="Update" class="btn btn-primary"></td>
                </tr>
            </form>
        </table>
    </div>
</div>
