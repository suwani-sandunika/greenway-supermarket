<?php
require "../MySQL.php";
session_start();
$userEmail = $_SESSION['user'];

require '../vendor/autoload.php';
$stripe = new \Stripe\StripeClient("sk_test_51MUjz8SJHvYF50NIXO95kdkyOYfB9eZcHv7JQuf7zKScRyg8aix7RmvBkBWeMx7JqemqNHZjshEjFDSVusKGfK7g00OX0OT3XF");

$cartRs = MySQL::search("SELECT *, cart.qty as qty FROM cart JOIN product p on p.id = cart.product_id WHERE user_email = '$userEmail'");

$items = [];
while ($cartData = $cartRs->fetch_assoc()) {
    $stripePrice = $stripe->prices->create(
        [
            'product' => $stripe->products->create([
                "name" => $cartData['title'],
            ])->id,
            'unit_amount' => ($cartData["price"] * 100),
            'currency' => 'lkr',
        ]
    );
    $items[] = ['price' => $stripePrice->id, 'quantity' => $cartData['qty']];
}

$addressRs = MySQL::search("SELECT *, c.delivery_fee as dfee FROM address JOIN city c on c.id = address.city_id WHERE user_email='$userEmail'");
if ($addressRs->num_rows > 0) {
    $address = $addressRs->fetch_assoc();

    $stripePrice = $stripe->prices->create(
        [
            'product' => $stripe->products->create([
                "name" => 'Delivery Fee',
            ])->id,
            'unit_amount' => ($address['dfee'] * 100),
            'currency' => 'lkr',
        ]
    );

    $items[] = ['price' => $stripePrice->id, 'quantity' => 1];
}

$checkout_session = $stripe->checkout->sessions->create([
    'mode' => 'payment',
    'line_items' => $items,
    'success_url' => 'http://localhost/greenway-supermarket/process/payment-success-process.php',
    'cancel_url' => 'http://localhost/greenway-supermarket/cart.php',
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);