<?php

include_once("../../functions/grn.php");

$file_path = $_FILES['grn_note']['tmp_name'];

$allowed = array('pdf');

$file_name = $_FILES['grn_note']['name'];

$ext = pathinfo($file_name, PATHINFO_EXTENSION);

if ($file_path == '') {
    $result = saveGRN($_POST['grn_supplier'], $_POST['userID'], $_POST['grn_refno'], $_POST['payment_stt'], $_POST['due_date'], $_POST['warehouse'], NULL, NULL, $_POST['additionalnotes'], $_POST['totalmprice']);
    echo ($result);
} else {
    if (!in_array($ext, $allowed)) {
        echo ("ext_error");
    } else {
        $result = saveGRN($_POST['grn_supplier'], $_POST['userID'], $_POST['grn_refno'], $_POST['payment_stt'], $_POST['due_date'], $_POST['warehouse'], $file_name, $file_path, $_POST['additionalnotes'], $_POST['totalmprice']);
        echo ($result);
    }
}
?>