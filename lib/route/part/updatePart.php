<?php

include_once("../../functions/part.php");

$file_path = $_FILES['part_pic']['tmp_name'];

$allowed = array('gif', 'png', 'jpg', 'jpeg');

$file_name = $_FILES['part_pic']['name'];

$ext = pathinfo($file_name, PATHINFO_EXTENSION);

if (empty($file_path) || empty($file_name)) {


    $result = editPart(
        $file_name,
        $file_path,
        $_POST['part_id'],
        $_POST['pname'],
        $_POST['pcode'],
        $_POST['pweight'],
        $_POST['punit'],
        $_POST['pdesc'],
        $_POST['ptedproduct'],
        $_POST['punitprice'],
        $_POST['prlevel']
    );

    echo ($result);
} else {

    if (!in_array($ext, $allowed)) {
        echo ("ext_error");
    } else {

        $result = editPart(
            $file_name,
            $file_path,
            $_POST['part_id'],
            $_POST['pname'],
            $_POST['pcode'],
            $_POST['pweight'],
            $_POST['punit'],
            $_POST['pdesc'],
            $_POST['ptedproduct'],
            $_POST['punitprice'],
            $_POST['prlevel']
        );

        echo ($result);
    }
}
?>