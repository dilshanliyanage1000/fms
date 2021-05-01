<?php

//import database connection
include_once('db_conn.php');

//id auto gen
include_once('id_maker.php');

function Registration($uName, $uMail, $uPwd, $uRole){

    //validation
    if(empty($uName) && empty($uMail) && empty($uPwd) && empty($uRole)){
        return ("Please check your inputs ... ");
    }

    //call the connection

    $conn = Connection();

    //check user is exists or not
    $sqlCheck = "SELECT * FROM user_tbl WHERE user_email = '$uMail';";
    
    //SQL result
    $checkResult = mysqli_query($conn,$sqlCheck);

    //validate the command
    if(mysqli_errno($conn)){
        echo(mysqli_error($conn));
    }

    $rec = mysqli_fetch_assoc($checkResult);

    //validate email address with database record
    if($rec['user_email'] == $uMail){
        return "user Exists";
    }
    else{

        //call auto id function
        $Uid = Auto_id("user_id","user_tbl","User");

        //encript the pwd
        $encpwd = md5($uPwd);

        //insert data into tables 
        $sqlInsert = "INSERT INTO user_tbl (user_id,user_name,user_email,user_pwd,user_role)
                        VALUES ('$Uid','$uName','$uMail','$encpwd','$uRole');";

        $loginInsert = "INSERT INTO admin_tbl (admin_id,admin_name,admin_mail,admin_pwd,admin_role)
                        VALUES ('$Uid','$uName','$uMail','$encpwd','$uRole');";

        //sql result 

        $userTABLE = mysqli_query($conn,$sqlInsert);
        $loginTABLE = mysqli_query($conn,$loginInsert);

        //validate the command
        if(mysqli_errno($conn)){
            echo(mysqli_error($conn));
        }

        if($userTABLE>0 && $loginTABLE>0){
            return("Success, Your Registration Email has been sent, Please validate it");
        }
    }

}
?>