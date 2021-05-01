<?php
    //include the function
    include_once("../../functions/jobrole.php");

    $result = getsingleJobrole($_GET['id']);

    echo($result);
?>