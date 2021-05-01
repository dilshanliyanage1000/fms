<?php

    //include part function

    include_once('../../functions/part.php');

    //call the function
    $result = partSearch($_GET['values']);

    echo($result);
?>