<?php
    //include raw material function
    include_once('../../functions/rawmaterial.php');

    $result = reactivateRawMaterial($_GET['id']);  
    
    echo($result);
    
?>