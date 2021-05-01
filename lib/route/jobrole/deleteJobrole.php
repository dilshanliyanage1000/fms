<?php
    //include employee function
    include_once('../../functions/jobrole.php');

    $result = deleteJobrole($_GET['id']);  
    
    echo($result);
    
?>