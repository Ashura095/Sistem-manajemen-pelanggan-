<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])) {
    $id = $_POST['id'];
    $menu_makanan = $_POST['menu_makanan'];
    $menu_minuman = $_POST['menu_minuman'];
    $jumlah_makanan = $_POST['jumlah_makanan'];
    $jumlah_minuman = $_POST['jumlah_minuman'];

    // Koneksi ke database
    $conn = mysqli_connect("localhost", "root", "", "pemesanan_makanan");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    
    // Proses pengeditan pesanan
    $sql = "UPDATE pesanan SET menu_makanan='$menu_makanan', menu_minuman='$menu_minuman', 
            jumlah_makanan=$jumlah_makanan, jumlah_minuman=$jumlah_minuman WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("Pesanan berhasil diperbarui."); window.location.href = "menu.php";</script>';
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    
    mysqli_close($conn);
}
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
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
            <label for="menu_makanan">Menu Makanan:</label>
            <select name="menu_makanan" id="menu_makanan">
                <option value="Nasi Goreng">Nasi Goreng - Rp. 15000</option>
                <option value="Mie Goreng">Mie Goreng - Rp. 12000</option>
                <option value="Ayam Goreng">Ayam Goreng - Rp. 20000</option>
            </select><br>
            <label for="menu_minuman">Menu Minuman:</label>
            <select name="menu_minuman" id="menu_minuman">
                <option value="Es Teh">Es Teh - Rp. 5000</option>
                <option value="Es Jeruk">Es Jeruk - Rp. 6000</option>
                <option value="Jus Alpukat">Jus Alpukat - Rp. 10000</option>
            </select><br>
            <label for="jumlah_makanan">Jumlah Makanan:</label>
            <input type="number" name="jumlah_makanan" id="jumlah_makanan" value="1"><br>
            <label for="jumlah_minuman">Jumlah Minuman:</label>
            <input type="number" name="jumlah_minuman" id="jumlah_minuman" value="1"><br>
            <input type="submit" name="edit" value="Edit">
        </form>
        <br>
        <a href="menu.php">Kembali ke Menu</a>
    </div>
</body>
</html>
 