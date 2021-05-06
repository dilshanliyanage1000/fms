<?php
session_start();

include_once('db_conn.php');

// user authentication module with the given username and password

function Auth($userEmail, $pwd)
{
    $conn = Connection();

    //query to check whether the email provided, exists in the database
    $sqlUser = "SELECT * FROM emp_tbl INNER JOIN user_tbl ON emp_tbl.emp_id = user_tbl.emp_id WHERE emp_tbl.emp_email = '$userEmail';";

    $sqlResult = mysqli_query($conn, $sqlUser);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    //hashing the provided password to MD5
    $newPwd = md5($pwd);

    $nor = mysqli_num_rows($sqlResult);

    $rec = mysqli_fetch_assoc($sqlResult);


    if ($nor > 0) {

        // check whether the provided password matches with the hashed password in the database
        if ($newPwd == $rec['user_pwd']) {

            //check whether the user is given access
            if ($rec['user_status'] == 1) {

                //if all data provided, matches with the database

                $_SESSION['userId']         = $rec['user_id'];
                $_SESSION['userFirstName']  = $rec['emp_fname'];
                $_SESSION['userLastName']   = $rec['emp_lname'];
                $_SESSION['userEmail']      = $rec['emp_email'];
                $_SESSION['user_role']      = $rec['user_role'];
                $_SESSION['userImage']      = $rec['emp_img_path'];

                if ($rec['user_role'] == 1) {
                    // if the user role is 1, redirect user to admin dashboard
                    header("location:lib/views/dashboard/admin.php");
                }

                if ($rec['user_role'] == 2) {
                    // if the user role is 2, redirect user to manager dashboard
                    header("location:lib/views/dashboard/manager.php");
                }

                if ($rec['user_role'] == 3) {
                    // if the user role is 3, redirect user to supervisor dashboard
                    header("location:lib/views/dashboard/supervisor.php");
                }

                if ($rec['user_role'] == 4) {
                    // if the user role is 4, redirect user to in office dashboard
                    header("location:lib/views/dashboard/inoffice.php");
                }

            } else {

                //alert the user that the login is deactivated
                echo ("Your account has been deactivated.. Please contact Administrator!");
            }

        } else {

            //display that the username or password is incorrect
            echo ('Incorrect Username or Password!');
        }

    } else {

        // if the user does not exist in the database
        echo ("No user record found");
    }
}
?>