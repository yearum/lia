<?php
// Periksa apakah ada parameter ID yang diterima
if (isset($_GET['id_diskon'])) {
    $id_diskon = $_GET['id_diskon'];

    // Query SQL untuk menghapus data diskon berdasarkan id_diskon
    $sql = "DELETE FROM master_diskon WHERE id_diskon = '$id_diskon'";
    
    // Eksekusi query
    if ($conn->query($sql) === TRUE) {
        // Jika penghapusan berhasil, redirect ke halaman master_diskon
        echo "<script>
        window.location.href = 'index.php?page=master_diskon';
        </script>";
    } else {
        // Jika terjadi kesalahan, tampilkan pesan kesalahan
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
