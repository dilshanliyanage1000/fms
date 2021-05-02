<?php
    //include warehouse function
    include_once('../../functions/warehouse.php');

    $result = reactivateWarehouse($_GET['id']);  
    
    echo($result);
    
?>