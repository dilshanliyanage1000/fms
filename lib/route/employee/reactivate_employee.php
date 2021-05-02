
<?php
    //include employee function
    include_once('../../functions/employee.php');

    $result = reactivateEmployee($_GET['id']);  
    
    echo($result);
    
?>