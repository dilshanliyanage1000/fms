<?php

    include_once('../../functions/quotation.php');

    $result = deleteQuotation($_GET['id']);  
    
    echo($result);
    
?>