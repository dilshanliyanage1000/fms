<?php
    //include part function

    include_once('../../functions/part.php');

    $result = reactivatePart($_GET['id']);  
    
    echo($result);
    
?>