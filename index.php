<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pesanan Handphone</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        table {
            width: 100%;
            table-layout: auto;
        }
        th, td {
            word-wrap: break-word;
        }
        .logout-button {
            position: absolute;
            top: 15px;
            right: 15px;
        }
    </style>
</head>
<body class="w3-light-grey">

<div class="w3-container w3-content w3-margin-top" style="max-width: 100%;">
    <div class="w3-card-4">
        <div class="w3-container w3-blue">
            <h2>Daftar Pesanan Handphone</h2>
            <a href="logout.php" class="w3-button w3-red w3-right">Logout</a>
        </div>
        <div class="w3-container">
            <a href="insert.php" class="w3-button w3-green w3-margin-top">Tambah Pesanan</a>
            <table class="w3-table-all w3-margin-top w3-margin-bottom">
                <thead>
                    <tr class="w3-blue">
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Nama Handphone</th>
                        <th>Jumlah</th>
                        <th>Alamat</th>
                        <th>Waktu Pemesanan</th>
                        <th>Metode Pembayaran</th>
                        <th>Negara</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM orders";
                    $result = $koneksi->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['item'] . "</td>";
                            echo "<td>" . $row['quantity'] . "</td>";
                            echo "<td>" . $row['address'] . "</td>";
                            echo "<td>" . $row['order_time'] . "</td>";
                            echo "<td>" . $row['payment'] . "</td>";
                            echo "<td>" . $row['country'] . "</td>";
                            echo "<td>
                                    <a href='update.php?id=" . $row['id'] . "' class='w3-button w3-yellow'>Edit</a>
                                    <a href='delete.php?id=" . $row['id'] . "' class='w3-button w3-red' onclick='return confirmDelete()'>Delete</a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8' class='w3-center'>Tidak ada data</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
function confirmDelete() {
    return confirm("Apakah Anda yakin ingin menghapus pesanan ini?");
}
</script>
</body>
</html>
