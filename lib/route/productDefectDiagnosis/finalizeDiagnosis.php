<?php
//call the function
include_once("../../functions/productDefectDiagnosis.php");

if ($_POST['prod_eligibility'] == 'repair') {

    $result = finalizeDiagnosis($_POST['id'], $_POST['warranty_status'], $_POST['prod_eligibility'], $_POST['repaircost'], $_POST['prod_condition'], $_POST['final_diagnosis']);
    echo ($result);
} else {

    $result = finalizeDiagnosis($_POST['id'], $_POST['warranty_status'], $_POST['prod_eligibility'], NULL, $_POST['prod_condition'], $_POST['final_diagnosis']);
    echo ($result);
}
?>