<?php
    //include warehouse function
    include_once('../../functions/warehouse.php');

    $result = updateStatus($_GET['id']);  
    
    echo($result);
    
?>