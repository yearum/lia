<?php
session_start();

// Proses form registrasi hanya ketika metode POST digunakan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $nama = $_POST['fullname'];
    $jenis_kelamin = $_POST['gender'];
    $tempat_lahir = $_POST['place_of_birth'];
    $tanggal_lahir = $_POST['birthdate'];
    $alamat = $_POST['address'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $nomor_telepon = $_POST['phone_number'];

    // Validasi dan sanitasi data
    // Validasi jenis kelamin
    $jenis_kelamin_values = array("Laki-laki", "Perempuan");
    if (!in_array($jenis_kelamin, $jenis_kelamin_values)) {
        echo "Jenis kelamin tidak valid.";
        exit;
    }

    // Sanitasi data
    $nama = htmlspecialchars($nama);
    $tempat_lahir = htmlspecialchars($tempat_lahir);
    $alamat = htmlspecialchars($alamat);
    $password = htmlspecialchars($password);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $nomor_telepon = preg_replace('/[^0-9]/', '', $nomor_telepon); // Hapus karakter selain angka

    // Simpan data ke database atau lakukan operasi lainnya
    // Misalnya, Anda bisa menggunakan fungsi koneksi database dan menjalankan query INSERT di sini.

    // Setelah berhasil mendaftar, arahkan pengguna ke halaman lain (misalnya index2.php)
    header("Location: prapal.php");
    exit;}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link rel="stylesheet" href="css/login2.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</head>

<body style="background-color: #17a2b8;">
    <div id="login">
        <h3 class="text-center text-white pt-5">Registrasi Pengguna</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                            <div class="form-group">
                                <label for="fullname" class="text-info">Nama Lengkap:</label><br>
                                <input type="text" id="fullname" name="fullname" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="gender" class="text-info">Jenis Kelamin:</label><br>
                                <select id="gender" name="gender" class="form-control" required>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="place_of_birth" class="text-info">Tempat Lahir:</label><br>
                                <input type="text" id="place_of_birth" name="place_of_birth" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="birthdate" class="text-info">Tanggal Lahir:</label><br>
                                <input type="date" id="birthdate" name="birthdate" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="address" class="text-info">Alamat:</label><br>
                                <textarea id="address" name="address" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="text-info">Email:</label><br>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="phone_number" class="text-info">Nomor Telepon:</label><br>
                                <input type="tel" id="phone_number" name="phone_number" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="Daftar">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
