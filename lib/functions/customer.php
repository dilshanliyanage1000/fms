<?php
//import database connection
include_once('db_conn.php');

//id auto gen
include_once('id_maker.php');


function customerReg($firstname, $lastname, $mail, $codephoneone, $phoneone, $codephonetwo, $phonetwo, $houseno, $street1, $street2, $city, $pcode)
{

    //validation
    if (empty($firstname) or empty($phoneone) or empty($city)) {
        return ("Please check your inputs ... ");
    }

    //call the connection
    $conn = Connection();

    $user_validation = "SELECT cus_email, cus_phone_one, cus_phone_two 
                        FROM cus_tbl 
                        WHERE cus_email LIKE '%$mail%' OR 
                        cus_phone_one LIKE '%$phoneone%' OR 
                        cus_phone_two LIKE '%$phonetwo%';";

    $search_result = mysqli_query($conn, $user_validation);

    $nor = mysqli_num_rows($search_result);

    if ($nor > 0) {
        $error_msg = "This email or phone number(s) already exists!";
        return ($error_msg);
    } else {
        //call the Auto_id function
        $id = Auto_id("cus_id", "cus_tbl", "CUS");

        //if optional phone number is not included - run this query
        if (empty($phonetwo)) {
            //insert data into customer table 

            $sql_insert = "INSERT INTO cus_tbl (cus_id, cus_first_name, cus_last_name, cus_email, cus_code_phoneone, cus_phone_one, cus_houseno, cus_street_one, 
                            cus_street_two, cus_city, cus_postal_code, cus_status)
                            VALUES ('$id','$firstname','$lastname','$mail','$codephoneone','$phoneone','$houseno','$street1','$street2','$city','$pcode',1);";
        } else {
            //insert data into customer table 

            $sql_insert = "INSERT INTO cus_tbl (cus_id, cus_first_name, cus_last_name, cus_email, cus_code_phoneone, cus_phone_one, cus_code_phonetwo, cus_phone_two,
                            cus_houseno, cus_street_one, cus_street_two, cus_city, cus_postal_code, cus_status)
                            VALUES ('$id','$firstname','$lastname','$mail','$codephoneone','$phoneone','$codephonetwo','$phonetwo','$houseno','$street1','$street2','$city','$pcode',1);";
        }

        $sql_result = mysqli_query($conn, $sql_insert);

        //validate the command
        if (mysqli_errno($conn)) {
            echo (mysqli_error($conn));
        }

        if ($sql_result > 0) {
            return "success";
        } else {
            return "Error, Try again !!";
        }
    }
}

function cusRegwithID($firstname, $lastname, $mail, $codephoneone, $phoneone, $codephonetwo, $phonetwo, $houseno, $street1, $street2, $city, $pcode)
{
    if (empty($firstname)) {
        return ("Please check your inputs ... ");
    }

    $conn = Connection();

    $id = Auto_id("cus_id", "cus_tbl", "CUS");

    $sql_insert = "INSERT INTO cus_tbl (cus_id, cus_first_name, cus_last_name, cus_email, cus_code_phoneone, cus_phone_one, cus_code_phonetwo, cus_phone_two,
                                cus_houseno, cus_street_one, cus_street_two, cus_city, cus_postal_code, cus_status)
                                VALUES ('$id','$firstname','$lastname','$mail','$codephoneone','$phoneone','$codephonetwo','$phonetwo','$houseno','$street1','$street2','$city','$pcode',1);";

    $sql_result = mysqli_query($conn, $sql_insert);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    if ($sql_result > 0) {
        return ($id);
    } else {
        return "Error, Try again !!";
    }
}


//edit customer details
function editcustomer($id, $firstname, $lastname, $mail, $codephoneone, $phoneone, $codephonetwo, $phonetwo, $houseno, $street1, $street2, $city, $pcode)
{
    //validation
    if (empty($firstname) or empty($lastname) or empty($mail) or empty($phoneone) or empty($houseno) or empty($street1) or empty($street2) or empty($city) or empty($pcode)) {
        return ("Please check your inputs ... ");
    }

    $conn = Connection();

    if (empty($phonetwo)) {
        $sql_update = "UPDATE cus_tbl SET cus_first_name = '$firstname', cus_last_name = '$lastname', cus_email = '$mail', cus_code_phoneone = '$codephoneone', cus_phone_one = '$phoneone',
                                cus_houseno = '$houseno', cus_street_one = '$street1', cus_street_two = '$street2', cus_city = '$city', cus_postal_code = '$pcode' WHERE cus_id = '$id';";
    } else {
        $sql_update = "UPDATE cus_tbl SET cus_first_name = '$firstname', cus_last_name = '$lastname', cus_email = '$mail', cus_code_phoneone = '$codephoneone', cus_phone_one = '$phoneone',
                                cus_code_phonetwo = '$codephonetwo', cus_phone_two = '$phonetwo', cus_houseno = '$houseno', cus_street_one = '$street1', cus_street_two = '$street2',
                                cus_city = '$city', cus_postal_code = '$pcode' WHERE cus_id = '$id';";
    }

    $update_result = mysqli_query($conn, $sql_update);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    if ($update_result > 0) {
        return ("success");
    } else {
        return false;
    }
}


//view customer details 
function ViewCustomer()
{
    $conn = Connection();

    $view_sql = "SELECT * FROM cus_tbl WHERE cus_status = 1 ORDER BY cus_id DESC;";

    $view_result = mysqli_query($conn, $view_sql);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    //check no of records
    $nor = mysqli_num_rows($view_result);

    if ($nor > 0) {

        while ($rec = mysqli_fetch_assoc($view_result)) {

            echo ("<td>" . $rec['cus_id'] . "</td>");
            echo ("<td>" . $rec['cus_first_name'] . "</td>");
            echo ("<td>" . $rec['cus_last_name'] . "</td>");
            echo ("<td>" . $rec['cus_email'] . "</td>");
            echo ("<td>(" . $rec['cus_code_phoneone'] . ") " . $rec['cus_phone_one'] . "</td>");
            echo ("<td>(" . $rec['cus_code_phonetwo'] . ") " . $rec['cus_phone_two'] . "</td>");
            echo ("<td>" . $rec['cus_houseno'] . ", " . $rec['cus_street_one'] . ", " . $rec['cus_street_two'] . ", " . $rec['cus_city'] . ". " . $rec['cus_postal_code'] . "</td>");

            if ($rec['cus_status'] == 1) {
                echo ("<td><span class='badge badge-pill badge-primary'>Active</span></td>");
            } else {
                echo ("<td><span class='badge badge-pill badge-danger'>Deactive</span></td>");
            }

            echo ("<td style='text-align:center;'><button id=" . $rec['cus_id'] . " class='btn btn-primary btn-sm' data-toggle='modal' data-target='#editModal'>Edit</button></td>");
            echo ("<td style='text-align:center;'><button id=" . $rec['cus_id'] . " class='btn btn-danger btn-sm'>Delete</button></td>");
            echo ("</tr>");
        }
    } else {
        return (" No record found");
    }
}

function DeletedCustomer()
{
    $conn = Connection();

    $view_sql = "SELECT * FROM cus_tbl WHERE cus_status = 0 ORDER BY cus_id DESC;";

    $view_result = mysqli_query($conn, $view_sql);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    //check no of records
    $nor = mysqli_num_rows($view_result);

    if ($nor > 0) {

        while ($rec = mysqli_fetch_assoc($view_result)) {

            echo ("<td>" . $rec['cus_id'] . "</td>");
            echo ("<td>" . $rec['cus_first_name'] . "</td>");
            echo ("<td>" . $rec['cus_last_name'] . "</td>");
            echo ("<td>" . $rec['cus_email'] . "</td>");
            echo ("<td>(" . $rec['cus_code_phoneone'] . ") " . $rec['cus_phone_one'] . "</td>");
            echo ("<td>(" . $rec['cus_code_phonetwo'] . ") " . $rec['cus_phone_two'] . "</td>");
            echo ("<td>" . $rec['cus_houseno'] . ", " . $rec['cus_street_one'] . ", " . $rec['cus_street_two'] . ", " . $rec['cus_city'] . ". " . $rec['cus_postal_code'] . "</td>");

            if ($rec['cus_status'] == 1) {
                echo ("<td><span class='badge badge-pill badge-primary'>Active</span></td>");
            } else {
                echo ("<td><span class='badge badge-pill badge-danger'>Deactive</span></td>");
            }

            echo ("<td style='text-align:center;'><button id=" . $rec['cus_id'] . " class='btn btn-secondary btn-reactivate btn-sm'><i class='fas fa-sync'></i>&nbsp;Reactivate</button></td>");
            echo ("</tr>");
        }
    } else {
        return (" No record found");
    }
}

//update the customer status from 1 to 0
function delCustomer($cusId)
{
    //connection
    $conn = Connection();

    //update sql
    $sql_update = "UPDATE cus_tbl SET cus_status = 0 WHERE cus_id = '$cusId';";

    $update_result = mysqli_query($conn, $sql_update);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    if ($update_result == 1) {
        return ("success");
    } else {
        return false;
    }
}

//update the customer status from 1 to 0
function reactivateCustomer($cusId)
{
    //connection
    $conn = Connection();

    //update sql
    $sql_update = "UPDATE cus_tbl SET cus_status = 1 WHERE cus_id = '$cusId';";

    $update_result = mysqli_query($conn, $sql_update);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    if ($update_result == 1) {
        return ("success");
    } else {
        return false;
    }
}

function verifyMail($search)
{
    // call the connection
    $conn = Connection();

    $searchSql = "SELECT * FROM cus_tbl WHERE cus_email = '$search';";

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

function getsingleCus($id)
{
    $conn = Connection();

    $sql_select = "SELECT * FROM cus_tbl WHERE cus_id = '$id';";
    $sql_result = mysqli_query($conn, $sql_select);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $nor = mysqli_num_rows($sql_result);

    if ($nor > 0) {
        $rec = mysqli_fetch_assoc($sql_result);

        return json_encode($rec);
    } else {
        return false;
    }
};

function getRecentlyAddedCust()
{

    $conn = Connection();

    $prev_id = "SELECT cus_id FROM cus_tbl WHERE cus_status = 1 ORDER BY cus_id DESC limit 1;";

    $result = mysqli_query($conn, $prev_id);

    //error checking 
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    if (mysqli_num_rows($result) > 0) {

        $rec = mysqli_fetch_assoc($result);

        $lid = $rec["cus_id"];

        return ($lid);
    } else {
        return false;
    }
};
