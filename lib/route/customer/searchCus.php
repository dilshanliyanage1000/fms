<?php

    //include customer function
    
    include_once('../../functions/customer.php');

    //call the function
    $result = cusSearch($_GET['values']);

    echo($result);
?>