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

// Tampilkan daftar pesanan
$sql = "SELECT * FROM pesanan";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Admin Panel</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Makanan</th>
                    <th>Jumlah Makanan</th>
                    <th>Minuman</th>
                    <th>Jumlah Minuman</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['menu_makanan'] . "</td>";
                        echo "<td>" . $row['jumlah_makanan'] . "</td>";
                        echo "<td>" . $row['menu_minuman'] . "</td>";
                        echo "<td>" . $row['jumlah_minuman'] . "</td>";
                        echo "<td><a href='edit_order_admin.php?id=" . $row['id'] . "'>Edit</a> | <a href='delete_order_admin.php?id=" . $row['id'] . "'>Delete</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Belum ada pesanan.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <br>
        <a href="admin_logout.php">Logout</a>
    </div>
</body>
</html>
