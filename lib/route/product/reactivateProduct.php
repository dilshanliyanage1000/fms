<?php
    //include product function
    include_once('../../functions/product.php');

    $result = reactivateProduct($_GET['id']);  
    
    echo($result);
    
?>