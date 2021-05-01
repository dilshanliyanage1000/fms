<?php

    //include warehouse function
    
    include_once('../../functions/warehouse.php');

    //call the function
    $result = whSearch($_GET['values']);

    echo($result);
?>