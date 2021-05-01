<?php

    //include employee function

    include_once('../../functions/employee.php');

    //call the function
    $result = empSearch($_GET['values']);

    echo($result);
?>