<?php
// Pastikan koneksi ke database tersedia
require_once 'function.php';
if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Query untuk mengambil data member
$sql = "SELECT id_member, nama_member, alamat, email, telepon FROM data_member";
$result = $conn->query($sql);

// Cek apakah ada data member
if ($result->num_rows > 0) {
    // Tampilkan data
    echo "<table border='1'>
            <tr>
                <th>ID Member</th>
                <th>Nama Member</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>Telepon</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id_member"]. "</td>
                <td>" . $row["nama_member"]. "</td>
                <td>" . $row["alamat"]. "</td>
                <td>" . $row["email"]. "</td>
                <td>" . $row["telepon"]. "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Tidak ada data member.";
}
// Tutup koneksi
$conn->close();
?>
