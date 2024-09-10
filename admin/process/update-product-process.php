<?php

require "../../MySQL.php";

$id = $_POST["pid"];
$title = $_POST["title"];
$price = $_POST["price"];
$desc = $_POST["desc"];
$qty = $_POST["qty"];
$category = $_POST["category"];
$brand = $_POST["brand"];
$unit = $_POST["unit"];

if (empty($id)) {
    echo "Product ID is required";
} else if (empty($title)) {
    echo "Product Title is required";
} else if (empty($price)) {
    echo "Product Price is required";
} else if (empty($desc)) {
    echo "Product Description is required";
} else if ($category == 0) {
    echo "Product Category is required";
} else if ($brand == 0) {
    echo "Product Brand is required";
} else if ($unit == 0) {
    echo "Product Unit is required";
} else {
    $prodRs = MySQL::search("SELECT * FROM product WHERE id = '$id'");
    if ($prodRs->num_rows <= 0) {
        echo "Product Not Found";
    }
    MySQL::iud("UPDATE product SET title='$title', price='" . $price . "', description='$desc', qty='$qty', brand_id='$brand', unit_id='$unit' WHERE id='$id'");

    if (isset($_FILES["files"])) {
        MySQL::iud("DELETE FROM product_images WHERE product_id = '$id'");

        $files = $_FILES["files"];
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
                    if ($fileSize < 1000000) {
                        $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                        $fileDestination = '../../assets/images/products/' . $fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);
                        MySQL::iud("INSERT INTO product_images (product_id, code) VALUES ('$id', 'assets/images/products/$fileNameNew')");
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
    } else {
        $prodImgRs = MySQL::search("SELECT * FROM product_images WHERE product_id = '$id'");
        if ($prodImgRs->num_rows == 0) {
            echo "Product Images are required";
        }
    }

    echo "Product Updated Successfully";
}
