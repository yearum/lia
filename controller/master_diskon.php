<?php
// Pastikan koneksi ke database tersedia
require_once 'function.php';
if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Query untuk mengambil data master diskon
$sql = "SELECT * FROM master_diskon";
$result = $conn->query($sql);

// Cek apakah ada data master diskon
if ($result->num_rows > 0) {
    // Tampilkan data
    while($row = $result->fetch_assoc()) {
        echo "ID Barang: " . $row["id_barang"]. "<br>";
        echo "Nama Diskon: " . $row["nama_diskon"]. "<br>";
        echo "Diskon Besar: " . $row["besar_diskon"]. "<br>";
        echo "Tanggal Mulai: " . $row["tgl_mulai"]. "<br>";
        echo "Tanggal Akhir: " . $row["tgl_akhir"]. "<br>";
        echo "Produk Diskon: " . $row["produk_diskon"]. "<br>";
        echo "Diskon Target: " . $row["target_diskon"]. "<br>";
        echo "<hr>";
    }
} else {
    echo "Tidak ada data master diskon.";
}
// Tutup koneksi
$conn->close();
?>
