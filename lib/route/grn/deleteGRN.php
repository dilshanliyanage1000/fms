<?php
    //include employee function
    include_once('../../functions/grn.php');

    $result = deleteGRN($_GET['id']);  
    
    echo($result);
    
?>