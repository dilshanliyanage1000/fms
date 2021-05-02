<?php
    //include customer function
    include_once('../../functions/productDefectDiagnosis.php');

    $result = deleteDiagnosis($_GET['id']);  
    
    echo($result);
    
?>