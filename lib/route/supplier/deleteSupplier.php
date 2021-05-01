<?php
    //include supplier function
    include_once('../../functions/supplier.php');

    $result = deleteSupplier($_GET['id']);  
    
    echo($result);
    
?>