<?php
// Pastikan koneksi ke database tersedia
require_once 'function.php';
if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Query untuk mengambil data barang
$sql = "SELECT id_barang, nama_barang, harga, stok FROM barang";
$result = $conn->query($sql);

// Cek apakah ada data barang
if ($result->num_rows > 0) {
    // Tampilkan data
    echo "<table border='1'>
            <tr>
                <th>ID Barang</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Stok</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id_barang"]. "</td>
                <td>" . $row["nama_barang"]. "</td>
                <td>" . $row["harga"]. "</td>
                <td>" . $row["stok"]. "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Tidak ada data barang.";
}
// Tutup koneksi
$conn->close();
?>
