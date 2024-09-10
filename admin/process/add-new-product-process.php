<?php

require "../../MySQL.php";

$title = $_POST['title'];
$price = $_POST['price'];
$desc = $_POST['desc'];
$qty = $_POST['qty'];
$category = $_POST['category'];
$brand = $_POST['brand'];
$unit = $_POST['unit'];

// Check if the form is submitted
if (empty($title)) {
    echo "Please enter a title";
} else if ($price <= 0) {
    echo "Please enter a valid price";
} else if (!is_numeric($price)) {
    echo "Please enter a valid price";
} else if (empty($category)) {
    echo "Please enter a category";
} else if (empty($brand)) {
    echo "Please enter a brand";
} else if (empty($unit)) {
    echo "Please enter a unit";
} else if (!is_numeric($qty)) {
    echo "Please enter a valid quantity";
} else if ($qty <= 0) {
    echo "Please enter a valid quantity";
} else if (empty($desc)) {
    echo "Please enter a description";
} else if (!isset($_FILES['files'])) {
    echo "Please upload an image";
} else if (count($_FILES['files']['name']) > 3) {
    echo "You can only upload 5 images";
} else {

    $productRs = MySQL::search("SELECT * FROM product WHERE title = '$title' AND brand_id = '$brand' AND unit_id = '$unit'");
    if($productRs->num_rows > 0) {
        echo "Sorry, this product already exists";
    }else {
        MySQL::iud("INSERT INTO product (title, price, description, qty, brand_id, unit_id) VALUES ('$title', '$price', '$desc', '$qty', '$brand', '$unit')");
        $files = $_FILES['files'];
        for ($x = 0; $x < count($files['name']); $x++) {
            $fileName = $files['name'][$x];
            $fileTmpName = $files['tmp_name'][$x];
            $fileSize = $files['size'][$x];
            $fileError = $files['error'][$x];
            $fileType = $files['type'][$x];

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('jpg', 'jpeg', 'png');

            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    if ($fileSize < 10000000) {
                        $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                        $fileDestination = '../../assets/images/products/' . $fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);
                        $lastInsertId = MySQL::$connection->insert_id;
                        MySQL::iud("INSERT INTO product_images (product_id, code) VALUES ('$lastInsertId', 'assets/images/products/$fileNameNew')");
                    } else {
                        echo "Your file is too big!";
                    }
                } else {
                    echo "There was an error uploading your file!";
                }
            } else {
                echo "You cannot upload files of this type!";
            }
        }
        echo "Product Added Successfully";
    }
}



