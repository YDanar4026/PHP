// Autentikasi dan Registrasi
<?php
session_start();
include('config.php');

// Proses login
if (isset($_POST['login'])) {
    $nama_pengguna = $_POST['username'];
    $kata_sandi = $_POST['password'];
    $cek_pengguna = "SELECT * FROM users WHERE username = '$nama_pengguna' AND password = '$kata_sandi' ";
    $query_pengguna = mysqli_query($conn, $cek_pengguna);
    $data_pengguna = mysqli_fetch_assoc($query_pengguna);
    if ($data_pengguna) {
        $_SESSION["sudah_login"] = true;
        $_SESSION["id"] = $data_pengguna["id"];
        header("Location: todolist.php");
        exit();
    } else {
        echo '<script>alert("Nama pengguna atau kata sandi salah!");</script>';
    }
}

// Proses registrasi
if (isset($_POST["registrasi"])) {
    $nama_pengguna = htmlspecialchars($_POST["username"]);
    $kata_sandi = $_POST["password"];
    $validasi_pengguna = mysqli_query($conn, "SELECT username FROM users WHERE username = '$nama_pengguna'; ");
    if (mysqli_fetch_assoc($validasi_pengguna)) {
        echo '<script>alert("Akun sudah ada");</script>';
    } else {
        $tambah_pengguna = "INSERT INTO users (username, password) VALUES ('$nama_pengguna', '$kata_sandi')";
        $query_tambah = mysqli_query($conn, $tambah_pengguna);
        header("Location: index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login dan Registrasi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">

        <p class="lead">Foto profil dan identitas diri</p>
        <img src="fotoku.jpg" class="img-fluid" alt="Foto Mahasiswa">
        <p class="lead">Nama: Yusuf Danar Indra Setiawan<br>NIM: 225314028</p>

        <h1>Login</h1>
        <form method="post">
            <div class="form-group">
                <label for="username">Nama Pengguna:</label>
                <input type="text" name="username" id="username">
            </div>
            <div class="form-group">
                <label for="password">Kata Sandi:</label>
                <input type="password" name="password" id="password">
            </div>
            <div class="form-group">
                <input type="submit" name="login" value="Masuk">
            </div>
        </form>

        <h2>____________________________________________</h2>
        <h2>Jika belum memiliki akun, registrasi dibawah</h2>
        <h2>____________________________________________</h2>

        <h1>Registrasi</h1>
        <form method="post">
            <div class="form-group">
                <label for="username">Nama Pengguna:</label>
                <input type="text" id="username" name="username">
            </div>
            <div class="form-group">
                <label for="password">Kata Sandi:</label>
                <input type="password" id="password" name="password">
            </div>
            <div class="form-group">
                <input type="submit" name="registrasi" value="Daftar">
            </div>
        </form>
    </div>
</body>
</html>
