<?php
    //include customer function
    include_once('../../functions/customer.php');

    $result = reactivateCustomer($_GET['id']);  
    
    echo($result);
    
?>