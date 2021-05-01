<?php
    //include product function
    include_once('../../functions/product.php');

    $result = updateProductStatus($_GET['id']);  
    
    echo($result);
    
?>