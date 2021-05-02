<?php
session_start();

include_once('db_conn.php');

function Auth($userEmail, $pwd)
{
    $conn = Connection();

    $sqlUser = "SELECT * FROM emp_tbl INNER JOIN user_tbl ON emp_tbl.emp_id = user_tbl.emp_id WHERE emp_tbl.emp_email = '$userEmail';";

    $sqlResult = mysqli_query($conn, $sqlUser);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $newPwd = md5($pwd);

    $nor = mysqli_num_rows($sqlResult);

    $rec = mysqli_fetch_assoc($sqlResult);

    if ($nor > 0) {

        if ($newPwd == $rec['user_pwd']) {

            if ($rec['user_status'] == 1) {

                $_SESSION['userId']         = $rec['user_id'];
                $_SESSION['userFirstName']  = $rec['emp_fname'];
                $_SESSION['userLastName']   = $rec['emp_lname'];
                $_SESSION['userEmail']      = $rec['emp_email'];
                $_SESSION['user_role']      = $rec['user_role'];
                $_SESSION['userImage']      = $rec['emp_img_path'];

                if ($rec['user_role'] == 1) {
                    header("location:lib/views/dashboard/admin.php");
                }

                if ($rec['user_role'] == 2) {
                    header("location:lib/views/dashboard/manager.php");
                }

                if ($rec['user_role'] == 3) {
                    header("location:lib/views/dashboard/supervisor.php");
                }

                if ($rec['user_role'] == 4) {
                    header("location:lib/views/dashboard/inoffice.php");
                }
            } else {
                echo ("Your account has been deactivated.. Please contact Administrator!");
            }
        } else {
            echo ('Incorrect Username or Password!');
        }
    } else {
        echo ("No user record found");
    }
}

function SearchUser($search)
{
    // call the connection
    $conn = Connection();

    $searchSql = "SELECT * FROM emp_tbl INNER JOIN user_tbl ON emp_tbl.emp_id = user_tbl.emp_id WHERE emp_tbl.emp_email = '$search';";

    $searchQuery = mysqli_query($conn, $searchSql);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $nor = mysqli_num_rows($searchQuery);

    if ($nor > 0) {
        echo ("success");
    } else {
        echo ("No record found!");
    }
};

?>