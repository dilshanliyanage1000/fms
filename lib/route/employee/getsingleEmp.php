<?php

    //include the function
    
    include_once("../../functions/employee.php");

    $result = getsingleEmp($_GET['id']);

    echo($result);
?>