<?php

    //include the function
    
    include_once("../../functions/customer.php");

    $result = getsingleCus($_GET['id']);

    echo($result);
?>