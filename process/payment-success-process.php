<?php

require "../MySQL.php";
session_start();
$userEmail = $_SESSION['user'];

$cartRs = MySQL::search("SELECT *,cart.qty as cqty, p.qty as pqty, cart.id as cart_id FROM cart JOIN product p on p.id = cart.product_id WHERE user_email='$userEmail'");

$dfeeRs = MySQL::search("SELECT *, c.delivery_fee as dfee FROM address JOIN city c on c.id = address.city_id WHERE user_email='${userEmail}'");
$dfee = $dfeeRs->fetch_assoc();

$total = $dfee['dfee'];
while ($cartData = $cartRs->fetch_assoc()) {
    $total += ($cartData['cqty'] * $cartData['price']);
}

$datetime = new DateTime();
$datetime->setTimezone(new DateTimeZone("Asia/Colombo"));
$date = $datetime->format("Y-m-d H:i:s");

MySQL::iud("INSERT INTO invoice(user_email, date, amount, delivery_fee) VALUES ('$userEmail', '$date', '$total', '${dfee['dfee']}')");
$lastInsertId = MySQL::$connection->insert_id;

mysqli_data_seek($cartRs, 0);
while ($cartData = $cartRs->fetch_assoc()) {
    MySQL::iud("INSERT INTO invoice_item(product_id, qty, invoice_invoice_id, unit_price) VALUE ('${cartData['product_id']}', '${cartData['cqty']}','$lastInsertId', '${cartData['price']}')");

    $newQty = $cartData['pqty'] - $cartData['cqty'];
    MySQL::iud("UPDATE product SET qty='$newQty' WHERE id='${cartData['product_id']}'");

    MySQL::iud("DELETE FROM cart WHERE id='${cartData['cart_id']}'");
}

header("Location: ../order-success.php?order=" . $lastInsertId);

