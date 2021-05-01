<?php

    include_once("../../functions/rawmaterial.php");

    $result = getsingleRawMat($_GET['id']);

    echo($result);
?>