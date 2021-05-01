<?php

    //include raw material function

    include_once('../../functions/rawmaterial.php');

    //call the function
    $result = rawmatSearch($_GET['data']);

    echo($result);
?>