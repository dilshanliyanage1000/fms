<?php
    //include the raw material function
    include_once("../../functions/rawmaterial.php");

    $result = editRawMaterial($_POST['rmID'], $_POST['rmName'], $_POST['rmDesc'], $_POST['rmReorderLevel']);

    echo($result);
    ?>