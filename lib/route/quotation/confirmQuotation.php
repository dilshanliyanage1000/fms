<?php

    include_once('../../functions/quotation.php');

    $result = confirmQuotation($_GET['id']);  
    
    echo($result);
    
?>