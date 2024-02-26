<?php
// Pastikan koneksi ke database tersedia
require_once 'function.php';
if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Query untuk mengambil data laporan
$sql = "SELECT l.id_laporan, l.id_nota, l.id_barang, b.nama_barang, l.id_kasir, l.total, l.tgl_input 
        FROM laporan l
        INNER JOIN barang b ON l.id_barang = b.id_barang";
$result = $conn->query($sql);

// Cek apakah ada data laporan
if ($result->num_rows > 0) {
    // Tampilkan data
    echo "<table border='1'>
            <tr>
                <th>ID Laporan</th>
                <th>ID Nota</th>
                <th>ID Barang</th>
                <th>Nama Barang</th>
                <th>ID Kasir</th>
                <th>Total</th>
                <th>Tanggal Input</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id_laporan"]. "</td>
                <td>" . $row["id_nota"]. "</td>
                <td>" . $row["id_barang"]. "</td>
                <td>" . $row["nama_barang"]. "</td>
                <td>" . $row["id_kasir"]. "</td>
                <td>" . $row["total"]. "</td>
                <td>" . $row["tgl_input"]. "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Tidak ada data laporan.";
}
// Tutup koneksi
$conn->close();
?>
