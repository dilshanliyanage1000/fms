<?php
    //include raw material function
    include_once('../../functions/rawmaterial.php');

    $result = deleteRawMaterial($_GET['id']);  
    
    echo($result);
    
?>