<?php
    //include part function

    include_once('../../functions/part.php');

    $result = updatePartStatus($_GET['id']);  
    
    echo($result);
    
?>