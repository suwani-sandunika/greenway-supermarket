<?php
session_start();
require_once "../MySQL.php";

$userEmail = $_SESSION['user'];
$invoiceId = $_POST['invoiceId'];

$invoiceItemsRs = MySQL::search("SELECT *, invoice_item.qty as qty FROM `invoice_item` JOIN product p on invoice_item.product_id = p.id JOIN unit u on p.unit_id = u.id JOIN invoice i on invoice_item.invoice_invoice_id = i.invoice_id WHERE invoice_item.invoice_invoice_id='$invoiceId' AND i.user_email='$userEmail'");
$no = 1;

setlocale(LC_MONETARY, 'si_LK');

while ($invoiceItemData = $invoiceItemsRs->fetch_assoc()) {
    ?>

    <tr>
        <td>
            <p class="mt-0"><?= $no ?></p>
        </td>
        <td>
            <p class="mt-0"><?= $invoiceItemData['title'] ?></p>
        </td>
        <td>
            <p class="mt-0">Rs.<?= $invoiceItemData['unit_price'] ?></p>
        </td>
        <td>
            <p class="mt-0"><?= $invoiceItemData['qty'] . ' ' . strtoupper($invoiceItemData['unit']) ?></p>
        </td>
        <td>
            <p class="mt-0">Rs.<?= $invoiceItemData['unit_price'] * $invoiceItemData['qty'] ?></p>
        </td>
    </tr>

    <?php
    $no++;
}
?>