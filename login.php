<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body class="w3-light-grey" style="background-image: url('bg.jpg');">

<div class="w3-container w3-blue-gray header">
    <h1>Selamat Datang di Pemesanan Handphone</h1>
    <p>Silakan login untuk mengelola pemesanan handphone.</p>
</div>


<div class="w3-container w3-content w3-margin-top" style="max-width: 400px;">
    <div class="w3-card-4" style="background-color: rgba(255, 255, 255, 0.9);">
        <div class="w3-container w3-blue">
            <h2>Login </h2>
        </div>

        <form class="w3-container" action="login.php" method="POST">
            <label for="username" class="w3-text-blue"><b>Username:</b></label>
            <input type="text" id="username" name="username" class="w3-input w3-border" required>

            <label for="password" class="w3-text-blue"><b>Password:</b></label>
            <input type="password" id="password" name="password" class="w3-input w3-border" required>

            <div class="w3-margin-top">
                <input type="submit" value="Login" class="w3-button w3-blue">
            </div>
        </form>
    </div>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    include 'config.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin_users WHERE username='$username' AND password='$password'";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['loggedin'] = true;
        header('Location: index.php');
    } else {
        echo "<script>alert('Username atau password salah');</script>";
    }
}
?>

</body>
</html>
