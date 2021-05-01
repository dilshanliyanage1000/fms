<?php
    //include employee function
    include_once('../../functions/employee.php');

    $result = updateStatus($_GET['id']);  
    
    echo($result);
    
?>