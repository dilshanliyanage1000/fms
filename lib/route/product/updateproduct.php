<?php

include_once("../../functions/product.php");

$file_path = $_FILES['product_pic']['tmp_name'];

$allowed = array('gif', 'png', 'jpg', 'jpeg');

$file_name = $_FILES['product_pic']['name'];

$ext = pathinfo($file_name, PATHINFO_EXTENSION);

if (empty($file_path) || empty($file_name)) {

    $result = editProduct(
        $file_name,
        $file_path,
        $_POST['ed_prodid'],
        $_POST['ed_prodname'],
        $_POST['ed_prodcode'],
        $_POST['ed_desc'],
        $_POST['ed_prodcapacity'],
        $_POST['ed_motorcapacity'],
        $_POST['ed_motorspeed'],
        $_POST['ed_prodphase'],
        $_POST['ed_unitprice'],
        $_POST['ed_reorderlevel']
    );

    echo ($result);
} else {

    if (!in_array($ext, $allowed)) {
        echo ("ext_error");
    } else {

        $result = editProduct(
            $file_name,
            $file_path,
            $_POST['ed_prodid'],
            $_POST['ed_prodname'],
            $_POST['ed_prodcode'],
            $_POST['ed_desc'],
            $_POST['ed_prodcapacity'],
            $_POST['ed_motorcapacity'],
            $_POST['ed_motorspeed'],
            $_POST['ed_prodphase'],
            $_POST['ed_unitprice'],
            $_POST['ed_reorderlevel']
        );

        echo ($result);
    }
}
?>