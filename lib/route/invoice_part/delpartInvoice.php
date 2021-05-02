<?php
    //include employee function
    include_once('../../functions/invoice.php');

    $result = deletePartsInvoice($_GET['id']);  
    
    echo($result);
    
?>