<?php
    //include employee function
    include_once('../../functions/invoice.php');

    $result = deleteInvoice($_GET['id']);  
    
    echo($result);
    
?>