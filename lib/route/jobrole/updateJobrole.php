<?php
    //include the employee function
    include_once("../../functions/jobrole.php");

    $result = editJobrole($_POST['jobrole_id'], $_POST['jobrole_name'], $_POST['jobrole_basicsal'], $_POST["jobrole_maxsal"]);

    echo($result);
?>