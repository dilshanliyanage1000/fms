<?php

    //include supplier function

    include_once('../../functions/supplier.php');

    //call the function
    $result = supSearch($_GET['values']);

    echo($result);
?>