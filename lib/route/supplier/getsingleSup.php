<?php

    //include the function
    
    include_once("../../functions/supplier.php");

    $result = getsingleSup($_GET['id']);

    echo($result);
?>