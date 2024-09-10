<?php

require "../../MySQL.php";

$userSearchTxt = $_POST['userSearchTxt'];

$page = $_POST['page'] ?? 1;

$adminsRs = MySQL::search("SELECT fname, lname, email, mobile, create_time, status_id, s.status FROM admin JOIN status s on admin.status_id = s.id WHERE fname LIKE '%$userSearchTxt%' OR lname LIKE '%$userSearchTxt%' OR email LIKE '%$userSearchTxt%' OR mobile LIKE '%$userSearchTxt%'");
$noOfAdmins = $adminsRs->num_rows;
$resultsPerPage = 10;
$noOfPages = ceil($noOfAdmins / $resultsPerPage);
$viewedPages = ($page - 1) * $resultsPerPage;

$adminsRs = MySQL::search("SELECT fname, lname, email, mobile, create_time, status_id, s.status FROM admin JOIN status s on admin.status_id = s.id WHERE fname LIKE '%$userSearchTxt%' OR lname LIKE '%$userSearchTxt%' OR email LIKE '%$userSearchTxt%' OR mobile LIKE '%$userSearchTxt%' LIMIT $resultsPerPage OFFSET $viewedPages");
?>

<div class="card-body">
    <div>
        <div class="table-responsive table-desi">
            <table class="table table-striped all-package">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Created At</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if ($adminsRs->num_rows == 0) {
                    ?>
                    <tr>
                        <td colspan="6" class="text-center">Something Went Wrong!</td>
                    </tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>

                    <?php
                } else {
                    while ($admin = $adminsRs->fetch_assoc()) {
                        ?>
                        <tr>
                            <td>
                                                        <span class="d-flex align-items-center justify-content-center">
                                                            <div class="form-check form-switch"
                                                                 style="width: fit-content">
                                                                <input type="checkbox" class="form-check-input"
                                                                       role="switch" <?= (strtolower($admin["status"]) == "active") ? "checked" : "" ?>>
                                                            </div>
                                                        </span>
                            </td>

                            <td class="d-flex align-items-center justify-content-center">
                                <a href="javascript:void(0)">
                                    <span class="d-block "><?= $admin['fname'] . ' ' . $admin['lname'] ?></span>
                                    <span>USER</span>
                                </a>
                            </td>

                            <td><?= $admin['mobile'] ?></td>

                            <td><?= $admin['email'] ?></td>

                            <td><?= date("d M, Y H:i ", strtotime($admin["create_time"])) ?></td>
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

<div class="pagination-box">
    <nav class="ms-auto me-auto " aria-label="...">

        <ul class="pagination pagination-primary">
            <li class="page-item <?= ($page <= 1) ? "disabled" : "" ?>">
                <a class="page-link"
                   href="?page=<?= ($page - 1 > 0) ? $page - 1 : $page ?>">Previous</a>
            </li>
            <?php

            for ($x = 1; $x <= $noOfPages; $x++) {
                ?>
                <li class="page-item <?= ($x == $page) ? "active" : "" ?>">
                    <a class="page-link" href="?page=<?= $x ?>"><?= $x ?></a>
                </li>
                <?php
            }
            ?>

            <li class="page-item <?= ($page >= $noOfPages) ? "disabled" : "" ?>">
                <a class="page-link"
                   href="?page=<?= ($page + 1 <= $noOfPages) ? $page + 1 : $page ?>">Next</a>
            </li>
        </ul>
    </nav>
</div>
