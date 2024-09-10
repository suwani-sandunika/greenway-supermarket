<?php

require "../../MySQL.php";

if (isset($_GET["invId"]) && !empty($_GET["invId"]) && isset($_GET["status"])) {
    $invId = $_GET["invId"];
    $status = $_GET["status"];

    $invoiceRs = MySQL::search("SELECT * FROM invoice WHERE invoice_id = '$invId'");
    if ($invoiceRs->num_rows > 0) {
        MySQL::iud("UPDATE invoice SET status = '$status' WHERE invoice_id = '$invId'");
        echo "Invoice status updated";
    } else {
        echo "Invoice not found";
    }
}