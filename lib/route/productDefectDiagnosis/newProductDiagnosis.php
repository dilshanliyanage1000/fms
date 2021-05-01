<?php

include_once("../../functions/productDefectDiagnosis.php");

$allowed = array('gif', 'png', 'jpg', 'jpeg');

//----------------- image one -----------------------------------

$file_path = $_FILES['defect_image']['tmp_name'];

$file_name = $_FILES['defect_image']['name'];

$ext = pathinfo($file_name, PATHINFO_EXTENSION);

//----------------- image two -----------------------------------

$file_path_two = $_FILES['defect_image_two']['tmp_name'];

$file_name_two = $_FILES['defect_image_two']['name'];

$ext_2 = pathinfo($file_name_two, PATHINFO_EXTENSION);

//------------------- end ---------------------------------------

if ($file_path == '' || $file_path_two == '') {
    echo ('no_img');
} else {
    if (!in_array($ext, $allowed) || !in_array($ext_2, $allowed)) {
        echo ("ext_error");
    } else {
        $result = addNewProdDiag($_POST['customer_search'], $_POST['product_search'], $_POST['customer_statement'], $_POST['defect_statement'], $file_name, $file_path, $file_name_two, $file_path_two);
        echo ($result);
    }
}
?>