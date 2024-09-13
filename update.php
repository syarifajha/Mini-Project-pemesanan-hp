<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

include 'config.php';

$id = $_GET['id'];

// Ambil data pesanan dari database berdasarkan ID
$sql = "SELECT * FROM orders WHERE id = $id";
$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $email = $row['email'];
    $item = $row['item'];
    $quantity = $row['quantity'];
    $address = $row['address'];
    $payment = $row['payment'];
    $country = $row['country'];
    $order_time = $row['order_time'];
} else {
    echo "Data tidak ditemukan";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $item = $_POST['item'];
    $quantity = $_POST['quantity'];
    $address = $_POST['address'];
    $order_time = $_POST['order_time'];
    $payment = $_POST['payment'];
    $country = $_POST['country'];

    // Query untuk update data pesanan
    $sql_update = "UPDATE orders SET 
                    name = '$name',
                    email = '$email',
                    item = '$item',
                    quantity = '$quantity',
                    address = '$address',
                    order_time = '$order_time',
                    payment = '$payment',
                    country = '$country'
                   WHERE id = $id";

    if ($koneksi->query($sql_update) === TRUE) {
        echo "<script>alert('Data berhasil diperbarui'); window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data');</script>";
    }

    $koneksi->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Pesanan Handphone</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body class="w3-light-grey">

<div class="w3-container w3-content w3-margin-top" style="max-width: 600px;">
    <div class="w3-card-4">
        <div class="w3-container w3-blue">
            <h2>Update Pesanan Handphone</h2>
        </div>

        <form class="w3-container" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>" method="POST">
            <label for="name" class="w3-text-blue"><b>Nama:</b></label>
            <input type="text" id="name" name="name" class="w3-input w3-border" required value="<?php echo $name; ?>">

            <label for="email" class="w3-text-blue"><b>Email:</b></label>
            <input type="email" id="email" name="email" class="w3-input w3-border" required value="<?php echo $email; ?>">

            <label for="item" class="w3-text-blue"><b>Nama Handphone:</b></label>
            <input type="text" id="item" name="item" class="w3-input w3-border" required value="<?php echo $item; ?>">

            <label for="quantity" class="w3-text-blue"><b>Jumlah:</b></label>
            <input type="number" id="quantity" name="quantity" class="w3-input w3-border" required min="1" value="<?php echo $quantity; ?>">

            <label for="address" class="w3-text-blue"><b>Alamat:</b></label>
            <textarea id="address" name="address" class="w3-input w3-border" rows="4" required><?php echo $address; ?></textarea>

            <label for="order_time" class="w3-text-blue"><b>Waktu Pemesanan:</b></label>
            <input type="datetime-local" id="order_time" name="order_time" class="w3-input w3-border" required value="<?php echo date('Y-m-d\TH:i', strtotime($order_time)); ?>">

            <label for="payment" class="w3-text-blue"><b>Metode Pembayaran:</b></label><br>
            <input type="radio" id="credit" name="payment" value="credit" class="w3-radio" <?php echo ($payment == 'credit') ? 'checked' : ''; ?> required>
            <label for="credit">Kartu Kredit</label><br>
            <input type="radio" id="debit" name="payment" value="debit" class="w3-radio" <?php echo ($payment == 'debit') ? 'checked' : ''; ?>>
            <label for="debit">Kartu Debit</label><br>
            <input type="radio" id="paypal" name="payment" value="paypal" class="w3-radio" <?php echo ($payment == 'paypal') ? 'checked' : ''; ?>>
            <label for="paypal">PayPal</label><br><br>

            <label for="country" class="w3-text-blue"><b>Negara:</b></label>
            <select id="country" name="country" class="w3-select w3-border" required>
                <option value="">Pilih negara</option>
                <option value="indonesia" <?php echo ($country == 'indonesia') ? 'selected' : ''; ?>>Indonesia</option>
                <option value="malaysia" <?php echo ($country == 'malaysia') ? 'selected' : ''; ?>>Malaysia</option>
                <option value="singapore" <?php echo ($country == 'singapore') ? 'selected' : ''; ?>>Singapura</option>
                <option value="thailand" <?php echo ($country == 'thailand') ? 'selected' : ''; ?>>Thailand</option>
                <option value="vietnam" <?php echo ($country == 'vietnam') ? 'selected' : ''; ?>>Vietnam</option>
                <option value="philippines" <?php echo ($country == 'philippines') ? 'selected' : ''; ?>>Filipina</option>
            </select>

            <div class="w3-margin-top">
                <input type="submit" value="Update" class="w3-button w3-blue">
                <a href="index.php" class="w3-button w3-grey">Kembali</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
