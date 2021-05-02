<?php
    //include warehouse function
    include_once('../../functions/warehouse.php');

    $result = deleteWarehouse($_GET['id']);  
    
    echo($result);
    
?>