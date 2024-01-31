<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Proses login
    $name = $_POST['name'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];

    // Pastikan untuk menyesuaikan dengan koneksi ke database Anda
    $conn = mysqli_connect("localhost", "root", "", "pemesanan_makanan");

    // Lakukan pengecekan terhadap nama, nomor telepon, dan alamat dalam database
    $query = "SELECT * FROM users WHERE name='$name' AND phone_number='$phone_number' AND address='$address'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['name'] = $name;
        $_SESSION['phone_number'] = $phone_number;
        $_SESSION['address'] = $address;
        header('Location: menu.php');
        exit();
    } else {
        $error_message = "Nama, nomor telepon, atau alamat salah.";
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style_login.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php if (isset($error_message)) { ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php } ?>
        <form method="post">
            <label for="name">Nama:</label>
            <input type="text" name="name" id="name" required><br>
            <label for="phone_number">Nomor Telepon:</label>
            <input type="text" name="phone_number" id="phone_number" required><br>
            <label for="address">Alamat:</label>
            <input type="text" name="address" id="address" required><br>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
