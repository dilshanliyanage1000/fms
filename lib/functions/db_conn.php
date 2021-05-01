<?php

//create a connection function

function Connection(){
    
    $server = "127.0.0.1";
    $user = "root";
    $pwd = "";
    $database = "fms_db";


    $conn = mysqli_connect($server,$user,$pwd,$database);

    //validating the  database connection

    if(mysqli_connect_errno($conn)){
        return("Connection Error");
    }
    else{
        return($conn);
    }
}

?>