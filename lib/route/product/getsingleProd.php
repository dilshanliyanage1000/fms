<?php

    //include the function
    include_once("../../functions/product.php");

    $result = getsingleproduct($_GET['id']);

    echo($result);
?>