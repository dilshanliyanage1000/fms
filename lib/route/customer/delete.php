<?php
    //include customer function
    include_once('../../functions/customer.php');

    $result = delCustomer($_GET['id']);  
    
    echo($result);
    
?>