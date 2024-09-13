<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pemesanan_handphone";

// Create connection
$koneksi = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($koneksi->connect_error) {
    die("Connection failed: " . $koneksi->connect_error);
}
?>
