<?php
// Periksa apakah ada parameter ID yang diterima
if (isset($_GET['id_member'])) {
    // Ambil ID member dari URL
    $id_member = $_GET['id_member'];

    // Query SQL untuk menghapus data member berdasarkan ID
    $sql = "DELETE FROM member WHERE id_member = '$id_member'";
    
    // Eksekusi query
    $result = mysqli_query($conn, $sql);

    // Periksa apakah query berhasil dijalankan
    if ($result) {
        // Redirect ke halaman member setelah menghapus data
        echo "<script>window.location.href= 'index.php?page=member';</script>";
    } else {
        // Tampilkan pesan kesalahan jika query gagal
        echo "Error: " . mysqli_error($conn);
    }
}
?>
