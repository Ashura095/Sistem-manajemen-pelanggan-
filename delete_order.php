<?php
session_start();
if (!isset($_SESSION['name'])) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Koneksi ke database
    $conn = mysqli_connect("localhost", "root", "", "pemesanan_makanan");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Proses penghapusan pesanan
    $sql = "DELETE FROM pesanan WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("Pesanan berhasil dihapus.");</script>';
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
    
    // Redirect kembali ke halaman menu setelah penghapusan
    header('Location: menu.php');
    exit();
} else {
    header('Location: menu.php');
    exit();
}
?>
