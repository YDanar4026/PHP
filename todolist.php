// Manajemen Todolist
<?php
session_start();
if (!isset($_SESSION["sudah_login"])) {
    header("Location: index.php");
}

include('config.php');
$id_pengguna = $_SESSION["id"];

// Tambah TODO
if (isset($_POST["tambah"])) {
    $kegiatan = htmlspecialchars($_POST["kegiatan"]);
    if ($kegiatan) {
        $tambah_todo = "INSERT INTO todolist (id, todo) VALUES ('$id_pengguna', '$kegiatan');";
        $query_tambah = mysqli_query($conn, $tambah_todo);
        // Redirect to avoid form resubmission on page refresh
        header("Location: todolist.php");
        exit();
    }
}

// Update Status TODO
if (isset($_GET["selesai"])) {
    $id_todo = $_GET["selesai"];
    $ubah_status = "UPDATE todolist SET todostatus = 1 WHERE id = $id_todo";
    $query_ubah = mysqli_query($conn, $ubah_status);
    header("Location: todolist.php");
    exit();
}

// Hapus TODO
if (isset($_GET["hapus"])) {
    $id_todo = $_GET["hapus"];
    $hapus_todo = "DELETE FROM todolist WHERE id = $id_todo";
    $query_hapus = mysqli_query($conn, $hapus_todo);
    if ($query_hapus) {
        header("Location: todolist.php");
        exit();
    } else {
        echo "Gagal menghapus TODO dari database.";
    }
}


// Ambil daftar TODO
$query_tampil = "SELECT * FROM todolist WHERE id = $id_pengguna";
$sql_tampil = mysqli_query($conn, $query_tampil);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Todolist</title>
    <link rel="stylesheet" href="style.css">
    <!-- Your CSS and other meta tags -->
</head>
<body>
    <div class="container">
        <!-- Your header content -->

        <p class="lead">Foto profil dan identitas diri</p>
        <img src="fotoku.jpg" class="img-fluid" alt="Foto Mahasiswa">
        <p class="lead">Nama: Yusuf Danar Indra Setiawan<br>NIM: 225314028</p>

        <h1>Daftar Kegiatan</h1>
        <table>
            <tr>
                <th>Kegiatan</th>
                <th>Aksi</th>
            </tr>
            <?php while ($todo = mysqli_fetch_assoc($sql_tampil)) : ?>
                <tr>
                    <td class="<?php echo $todo['todostatus'] ? 'completed' : ''; ?>">
                        <?php echo $todo['todostatus'] ? '<s>' . $todo['todo'] . '</s>' : $todo['todo']; ?>
                    </td>
                    <td>
                        <?php if (!$todo['todostatus']) : ?>
                            <a href="?selesai=<?= $todo['id'] ?>">Selesai</a>
                        <?php endif; ?>
                        <a href="?hapus=<?= $todo['id'] ?>">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>

        <h2>Tambah Kegiatan Baru</h2>
        <form method="post">
            <div class="form-group">
                <input type="text" name="kegiatan">
            </div>
            <div class="form-group">
                <input type="submit" name="tambah" value="Tambah">
            </div>
        </form>

        <!-- Add back button to return to login and registration page -->
        <div class="form-group">
            <a href="index.php" class="back-button">Kembali</a>
        </div>

    </div>
</body>
</html>