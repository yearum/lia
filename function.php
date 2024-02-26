<?php
// Definisikan koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$database = "kantin_im";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Fungsi query
function query($sql) {
    global $conn;
    return $conn->query($sql);
}

// Fungsi untuk mendapatkan data kategori
function getKategori() {
    $sql = "SELECT * FROM kategori";
    return query($sql);
}

// Fungsi untuk menambahkan produk
function add_produk($add_produk)
{
    global $conn;

    // Isi fungsi add_produk di sini

    // Gunakan prepared statement untuk mencegah SQL Injection
    $query = "INSERT INTO produk (id_kategori, nama_barang, stok, harga_jual, harga_beli) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isiii", $add_produk["id_kategori"], $add_produk["nama_barang"], $add_produk["stok"], $add_produk["harga_jual"], $add_produk["harga_beli"]);
    $stmt->execute();

    return $stmt->affected_rows;
}

// Fungsi untuk menambahkan kategori
function add_kategori($add_kategori)
{
    global $conn;

    // Isi fungsi add_kategori di sini

    // Gunakan prepared statement untuk mencegah SQL Injection
    $query = "INSERT INTO kategori (nama_kategori, tanggal_input) VALUES (?, NOW())";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $add_kategori["nama_kategori"]);
    $stmt->execute();

    return $stmt->affected_rows;
}

// Fungsi untuk mendapatkan data kasir
function getDataKasir()
{
    global $conn;

    $query = "SELECT * FROM kasir";
    return query($query);
}

// Fungsi untuk mendapatkan data produk
function getProduk()
{
    global $conn;

    $query = "SELECT * FROM produk";
    return query($query);
}

// Fungsi untuk mendapatkan data produk berdasarkan ID barang
function getProdukById($id_barang)
{
    global $conn;

    $query = "SELECT * FROM produk WHERE id_barang = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_barang);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_assoc();
}

// Fungsi untuk mengupdate stok produk setelah transaksi pembelian
function kurangiStokBarang()
{
    global $conn;

    // Ambil data dari tabel kasir
    $kasir = getDataKasir();

    // Loop melalui setiap barang di kasir dan kurangi stok produk
    foreach ($kasir as $barang) {
        $id_barang = $barang['id_barang'];
        $jumlah = $barang['jumlah'];

        // Gunakan prepared statement untuk mencegah SQL Injection
        $query = "UPDATE produk SET stok = stok - ? WHERE id_barang = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $jumlah, $id_barang);
        $stmt->execute();
    }
}
?>