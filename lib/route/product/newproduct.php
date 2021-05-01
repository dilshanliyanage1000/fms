<?php

include_once("../../functions/product.php");

$file_path = $_FILES['product_image']['tmp_name'];

$allowed = array('gif', 'png', 'jpg', 'jpeg');

$file_name = $_FILES['product_image']['name'];

$ext = pathinfo($file_name, PATHINFO_EXTENSION);

if ($file_path == '') {
    $result = regProduct($_POST['prodname'], $_POST['prodcode'], NULL, NULL, $_POST['proddesc'], $_POST['prodcapacity'], $_POST['prodmotorcapacity'], $_POST['prodmotorspeed'], $_POST['prodphase'], $_POST['unitprice'], $_POST['reorderlevel']);
    echo ($result);
} else {
    if (!in_array($ext, $allowed)) {
        echo ("ext_error");
    } else {
        $result = regProduct($_POST['prodname'], $_POST['prodcode'], $file_name, $file_path, $_POST['proddesc'], $_POST['prodcapacity'], $_POST['prodmotorcapacity'], $_POST['prodmotorspeed'], $_POST['prodphase'], $_POST['unitprice'], $_POST['reorderlevel']);
        echo ($result);
    }
}
?>