<?php
    //include employee function
    include_once('../../functions/jobrole.php');

    $result = reactivateJobrole($_GET['id']);  
    
    echo($result);
    
?>