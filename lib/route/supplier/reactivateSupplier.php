<?php
    //include supplier function
    include_once('../../functions/supplier.php');

    $result = reactivateSupplier($_GET['id']);  
    
    echo($result);
    
?>