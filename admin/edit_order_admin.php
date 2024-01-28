<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php');
    exit();
}

// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "pemesanan_makanan");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Jika ID pesanan tidak diberikan, redirect ke halaman admin
if (!isset($_GET['id'])) {
    header('Location: admin.php');
    exit();
}

$id = $_GET['id'];

// Proses form jika data dikirimkan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jumlah_makanan = $_POST['jumlah_makanan'];
    $jumlah_minuman = $_POST['jumlah_minuman'];

    // Update pesanan dengan ID yang sesuai
    $sql = "UPDATE pesanan SET jumlah_makanan=$jumlah_makanan, jumlah_minuman=$jumlah_minuman WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        header('Location: admin.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Ambil data pesanan berdasarkan ID
$sql = "SELECT * FROM pesanan WHERE id=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pesanan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Edit Pesanan</h2>
        <form method="post">
            <label for="jumlah_makanan">Jumlah Makanan:</label>
            <input type="number" name="jumlah_makanan" id="jumlah_makanan" value="<?php echo $row['jumlah_makanan']; ?>" required><br>
            <label for="jumlah_minuman">Jumlah Minuman:</label>
            <input type="number" name="jumlah_minuman" id="jumlah_minuman" value="<?php echo $row['jumlah_minuman']; ?>" required><br>
            <input type="submit" value="Simpan">
        </form>
        <br>
        <a href="admin.php">Kembali</a>
    </div>
</body>
</html>
