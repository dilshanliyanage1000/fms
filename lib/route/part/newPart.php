<?php

include_once("../../functions/part.php");

$file_path = $_FILES['part_image']['tmp_name'];

$allowed = array('gif', 'png', 'jpg', 'jpeg');

$file_name = $_FILES['part_image']['name'];

$ext = pathinfo($file_name, PATHINFO_EXTENSION);

if ($file_path == '') {
    $result = registerPart(NULL, NULL, $_POST['name'], $_POST['partcode'], $_POST['pt_product'], $_POST['weight'], $_POST['unit'], $_POST['description'], $_POST['unitprice'], $_POST['reorderlevel']);
    echo ($result);
} else {
    if (!in_array($ext, $allowed)) {
        echo ("ext_error");
    } else {
        $result = registerPart($file_name, $file_path, $_POST['name'], $_POST['partcode'], $_POST['pt_product'], $_POST['weight'], $_POST['unit'], $_POST['description'], $_POST['unitprice'], $_POST['reorderlevel']);
        echo ($result);
    }
}
?>