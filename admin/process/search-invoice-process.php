<?php

require "../../MySQL.php";

$txt = $_GET["txt"];

$page = $_GET["page"] ?? 1;

$invoiceRs = MySQL::search("SELECT * FROM invoice WHERE invoice_id LIKE '%$txt%' OR user_email LIKE '$txt%'");
$noOfInvoices = $invoiceRs->num_rows;
$resultsPerPage = 10;
$noOfPages = ceil($noOfInvoices / $resultsPerPage);
$viewedCount = ($page - 1) * $resultsPerPage;
$invoiceRs = MySQL::search("SELECT * FROM invoice WHERE invoice_id LIKE '%$txt%' OR user_email LIKE '$txt%' LIMIT $resultsPerPage OFFSET $viewedCount");
?>

<div class="card-body">
    <div>
        <div class="table-responsive table-desi">
            <table class="table table-striped all-package">
                <thead>
                <tr>
                    <th>Invoice ID</th>
                    <th>User Email</th>
                    <th>Date</th>
                    <th>Delivery Status</th>
                    <th>Amount</th>
                    <th>Option</th>
                </tr>
                </thead>

                <tbody>
                <?php

                if ($invoiceRs->num_rows == 0) {
                    ?>
                    <tr>
                        <td colspan="6" class="text-center">Something Went Wrong!</td>
                    </tr>
                    <?php
                } else {

                    while ($invoice = $invoiceRs->fetch_assoc()) {
                        ?>
                        <tr>
                            <td>#<?= $invoice["invoice_id"] ?></td>

                            <td><?= $invoice["user_email"] ?></td>

                            <td><?= date("d M, Y H:i", strtotime($invoice["date"])) ?></td>

                            <?php

                            switch ($invoice["status"]) {
                                case 0:
                                    ?>
                                    <td class="order-pending">
                                        <span>Pending</span>
                                    </td>
                                    <?php
                                    break;
                                case 1:
                                    ?>
                                    <td class="order-success">
                                        <span>Processing</span>
                                    </td>
                                    <?php
                                    break;
                                case 2:
                                    ?>
                                    <td class="order-success">
                                        <span>Completed</span>
                                    </td>
                                    <?php
                                    break;
                                case 3:
                                    ?>
                                    <td class="order-cancle">
                                        <span>Cancelled</span>
                                    </td>
                                    <?php
                                    break;
                                default:
                                    ?>
                                    <td class="order-pending">
                                        <span>Pending</span>
                                    </td>
                                <?php
                            }
                            ?>

                            <td>Rs.<?= $invoice["amount"] ?></td>

                            <td>
                                <ul>
                                    <li>
                                        <a href="order-detail.php?invoice=<?= $invoice["invoice_id"] ?>">
                                            <span class="lnr lnr-eye"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:showStatusUpdateModal('<?= $invoice["invoice_id"] ?>', '<?= $invoice["status"] ?>')">
                                            <span class="lnr lnr-arrow-up-circle"></span>
                                        </a>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Pagination Box Start -->
<div class="pagination-box">
    <nav class="ms-auto me-auto " aria-label="...">
        <ul class="pagination pagination-primary">
            <li class="page-item <?= ($page <= 1) ? "disabled" : "" ?>">
                <a class="page-link"
                   href="javascript:searchInvoice('<?= ($page - 1 > 0) ? $page - 1 : $page ?>')">Previous</a>
            </li>
            <?php

            for ($x = 1; $x <= $noOfPages; $x++) {
                ?>
                <li class="page-item <?= ($x == $page) ? "active" : "" ?>">
                    <a class="page-link" href="javascript:searchInvoice('<?= $x ?>')"><?= $x ?></a>
                </li>
                <?php
            }
            ?>

            <li class="page-item <?= ($page >= $noOfPages) ? "disabled" : "" ?>">
                <a class="page-link"
                   href="javascript:searchInvoice('<?= ($page + 1 <= $noOfPages) ? $page + 1 : $page ?>')">Next</a>
            </li>
        </ul>
    </nav>
</div>
<!-- Pagination Box End -->