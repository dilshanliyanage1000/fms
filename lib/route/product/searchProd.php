<?php
    //include product function    
    include_once('../../functions/product.php');

    //call the function
    $result = prodSearch($_GET['values']);

    echo($result);
?>