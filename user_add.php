<?php
// Menggunakan koneksi database yang sudah tersedia
require 'function.php';

// Username dan password untuk admin

// Username dan password untuk user biasa
$userUsername = 'user';
$userPassword = 'user';

// Hash password menggunakan md5
$hashedUserPassword = md5($userPassword);


// Query untuk menambahkan user biasa ke dalam tabel login
$queryUser = "INSERT INTO `login` (`user`, `pass`) VALUES ('$userUsername', '$hashedUserPassword')";


// Jalankan query untuk menambahkan user biasa
if ($conn->query($queryUser) === TRUE) {
    echo "User account created successfully.<br>";
} else {
    echo "Error creating user account: " . $conn->error . "<br>";
}

// Tutup koneksi database
$conn->close();
?>
