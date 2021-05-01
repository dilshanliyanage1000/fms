<?php
    //include raw material function
    include_once('../../functions/rawmaterial.php');

    $result = updateStatus($_GET['id']);  
    
    echo($result);
    
?>