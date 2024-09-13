<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $item = $_POST['item'];
    $quantity = $_POST['quantity'];
    $address = $_POST['address'];
    $order_time = $_POST['order_time'];
    $payment = $_POST['payment'];
    $country = $_POST['country'];

    $sql = "INSERT INTO orders (name, email, item, quantity, address, order_time, payment, country)
            VALUES ('$name', '$email', '$item', '$quantity', '$address','$order_time', '$payment', '$country')";

    if ($koneksi->query($sql) === TRUE) {
        $message = 'Data berhasil dimasukkan';
    } else {
        $message = 'Data gagal dimasukkan';
    }

    $koneksi->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Formulir Pemesanan Handphone</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<script>
        // Fungsi untuk menampilkan alert dan mengarahkan ke index.php setelah menutup alert
    function showAlertAndRedirect(message) {
        alert(message);
        window.location.href = 'index.php';
    }
</script>
<body class="w3-light-grey">

<div class="w3-container w3-content w3-margin-top" style="max-width: 600px;">
    <div class="w3-card-4">
        <div class="w3-container w3-blue">
            <h2>Formulir Pemesanan Handphone</h2>
        </div>

        <form class="w3-container" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="name" class="w3-text-blue"><b>Nama:</b></label>
            <input type="text" id="name" name="name" class="w3-input w3-border" required>

            <label for="email" class="w3-text-blue"><b>Email:</b></label>
            <input type="email" id="email" name="email" class="w3-input w3-border" required>

            <label for="item" class="w3-text-blue"><b>Nama Handphone:</b></label>
            <input type="text" id="item" name="item" class="w3-input w3-border" required>

            <label for="quantity" class="w3-text-blue"><b>Jumlah:</b></label>
            <input type="number" id="quantity" name="quantity" class="w3-input w3-border" required min="1">

            <label for="address" class="w3-text-blue"><b>Alamat:</b></label>
            <textarea id="address" name="address" class="w3-input w3-border" rows="4" required></textarea>

            <label for="order_time" class="w3-text-blue"><b>Waktu Pemesanan:</b></label>
            <input type="datetime-local" id="order_time" name="order_time" class="w3-input w3-border" required>

            <label for="payment" class="w3-text-blue"><b>Metode Pembayaran:</b></label><br>
            <input type="radio" id="credit" name="payment" value="credit" class="w3-radio" required>
            <label for="credit">Kartu Kredit</label><br>
            <input type="radio" id="debit" name="payment" value="debit" class="w3-radio">
            <label for="debit">Kartu Debit</label><br>
            <input type="radio" id="paypal" name="payment" value="paypal" class="w3-radio">
            <label for="paypal">PayPal</label><br><br>

            <label for="country" class="w3-text-blue"><b>Negara:</b></label>
            <select id="country" name="country" class="w3-select w3-border" required>
                <option value="">Pilih negara</option>
                <option value="indonesia">Indonesia</option>
                <option value="malaysia">Malaysia</option>
                <option value="singapore">Singapura</option>
                <option value="thailand">Thailand</option>
                <option value="vietnam">Vietnam</option>
                <option value="philippines">Filipina</option>
            </select>

            <div class="w3-margin-top">
                <input type="submit" value="Simpan" class="w3-button w3-blue">
                <a href="index.php" class="w3-button w3-grey">Kembali</a>
            </div>
        </form>
    </div>
</div>

<script>
    // Memanggil fungsi showAlertAndRedirect dengan pesan yang sesuai
    <?php
    if (!empty($message)) {
        echo "showAlertAndRedirect('$message');";
    }
    ?>
</script>

</body>
</html>
