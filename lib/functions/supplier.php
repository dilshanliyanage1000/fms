<?php
//import database connection
include_once('db_conn.php');

//id auto gen
include_once('id_maker.php');


function regSupplier($name, $phoneone, $phonetwo, $fax, $address, $email, $suppRM)
{
    if (empty($name) or empty($phoneone) or empty($address) or empty($email)) {
        return ("Please check your inputs ... ");
    }

    $conn = Connection();

    $supID = Auto_id("sup_id", "supplier_tbl", "SUP");


    $sql_insert = "INSERT INTO supplier_tbl (sup_id, sup_company_name, sup_phone, sup_phone_two, sup_fax_number, sup_address, sup_email, sup_status)
                       VALUES ('$supID','$name','$phoneone','$phonetwo','$fax','$address','$email', 1);";

    $sql_result = mysqli_query($conn, $sql_insert);

    foreach ($suppRM as $rawMat) {

        $rmsID = Auto_id("rm_sup_id", "supplier_rm_tbl", "RMS");

        $runSQL = "INSERT INTO supplier_rm_tbl (rm_sup_id , sup_id, rm_id, row_stt)
                    VALUES ('$rmsID','$supID','$rawMat',1);";

        $result = mysqli_query($conn, $runSQL);
    }

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    if ($sql_result > 0) {
        return "Success";
    } else {
        return "Error, Try again !!";
    }
}


//view supplier details 
function ViewSupplier()
{

    $conn = Connection();

    $view_sql = "SELECT * FROM supplier_tbl WHERE sup_status = 1 ORDER BY sup_id DESC;";

    $view_result = mysqli_query($conn, $view_sql);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    //check no of records
    $nor = mysqli_num_rows($view_result);

    if ($nor > 0) {

        while ($rec = mysqli_fetch_assoc($view_result)) {

            $supID = $rec["sup_id"];

            $getRMSQL = "SELECT supplier_tbl.sup_id, rawmaterial_tbl.rm_name, supplier_tbl.sup_status
                            FROM ((supplier_rm_tbl
                            INNER JOIN supplier_tbl
                            ON supplier_rm_tbl.sup_id = supplier_tbl.sup_id)
                            INNER JOIN rawmaterial_tbl
                            ON supplier_rm_tbl.rm_id = rawmaterial_tbl.rm_id)
                            WHERE supplier_tbl.sup_id = '$supID';";

            $getResult = mysqli_query($conn, $getRMSQL);

            $rows = mysqli_num_rows($getResult);

            $description = '';

            if ($rows > 0) {
                while ($record = mysqli_fetch_assoc($getResult)) {

                    $description .= $record['rm_name'] . "</br>";
                }
            }

            echo ("<td>" . $rec['sup_id'] . "</td>");

            echo ("<td>" . $rec['sup_company_name'] . "</td>");

            echo ("<td>" . $rec['sup_email'] . "</td>");

            if ($rec['sup_fax_number'] == '') {
                echo ("<td>" . $rec['sup_phone'] . "<br>" . $rec['sup_phone_two'] . "</td>");
            } else {
                echo ("<td>" . $rec['sup_phone'] . "<br>" . $rec['sup_phone_two'] . "<br>" . $rec['sup_fax_number'] . "</td>");
            }

            echo ("<td>" . $rec['sup_address'] . "</td>");

            echo ("<td>" . $description . "</td>");

            if ($rec['sup_status'] == 1) {
                echo ("<td style='text-align:center;'><span class='badge badge-pill badge-primary'>Active</span></td>");
            } else {
                echo ("<td style='text-align:center;'><span class='badge badge-pill badge-danger'>Deactive</span></td>");
            }

            echo ("<td style='text-align:center;'><button id=" . $rec['sup_id'] . " class='btn btn-primary btn-sm' data-toggle='modal' data-target='#editModal'>Edit</button></td>");
            echo ("<td style='text-align:center;'><button id=" . $rec['sup_id'] . " class='btn btn-danger btn-sm'>Delete</button></td>");
            echo ("</tr>");
        }
    } else {
        return false;
    }
}

//view supplier details 
function ViewDeletedSupplier()
{
    $conn = Connection();

    $view_sql = "SELECT * FROM supplier_tbl WHERE sup_status = 0 ORDER BY sup_id DESC;";

    $view_result = mysqli_query($conn, $view_sql);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    //check no of records
    $nor = mysqli_num_rows($view_result);

    if ($nor > 0) {

        while ($rec = mysqli_fetch_assoc($view_result)) {

            $supID = $rec["sup_id"];

            $getRMSQL = "SELECT supplier_tbl.sup_id, rawmaterial_tbl.rm_name, supplier_tbl.sup_status
                            FROM ((supplier_rm_tbl
                            INNER JOIN supplier_tbl
                            ON supplier_rm_tbl.sup_id = supplier_tbl.sup_id)
                            INNER JOIN rawmaterial_tbl
                            ON supplier_rm_tbl.rm_id = rawmaterial_tbl.rm_id)
                            WHERE supplier_tbl.sup_id = '$supID';";

            $getResult = mysqli_query($conn, $getRMSQL);

            $rows = mysqli_num_rows($getResult);

            $description = '';

            if ($rows > 0) {
                while ($record = mysqli_fetch_assoc($getResult)) {

                    $description .= $record['rm_name'] . "</br>";
                }
            }

            echo ("<td>" . $rec['sup_id'] . "</td>");

            echo ("<td>" . $rec['sup_company_name'] . "</td>");

            echo ("<td>" . $rec['sup_email'] . "</td>");

            if ($rec['sup_fax_number'] == '') {
                echo ("<td>" . $rec['sup_phone'] . "<br>" . $rec['sup_phone_two'] . "</td>");
            } else {
                echo ("<td>" . $rec['sup_phone'] . "<br>" . $rec['sup_phone_two'] . "<br>" . $rec['sup_fax_number'] . "</td>");
            }

            echo ("<td>" . $rec['sup_address'] . "</td>");

            echo ("<td>" . $description . "</td>");

            if ($rec['sup_status'] == 1) {
                echo ("<td style='text-align:center;'><span class='badge badge-pill badge-primary'>Active</span></td>");
            } else {
                echo ("<td style='text-align:center;'><span class='badge badge-pill badge-danger'>Deactive</span></td>");
            }

            echo ("<td style='text-align:center;'><button id=" . $rec['sup_id'] . " class='btn btn-secondary btn-reactivate btn-sm'><i class='fas fa-sync'></i>Reactivate</button></td>");
            echo ("</tr>");
        }
    } else {
        return false;
    }
}

//edit supplier details
function editSupplier($id, $name, $phoneone, $phonetwo, $fax, $address, $email, $supRM)
{

    if (empty($name) or empty($phoneone) or empty($address) or empty($email)) {
        return ("Please check your inputs ... ");
    }

    if($phonetwo == '') {
        $phonetwo = NULL;
    }

    $conn = Connection();

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $sql_update = "UPDATE supplier_tbl SET sup_company_name = '$name', sup_phone = '$phoneone', sup_phone_two = '$phonetwo', sup_fax_number = '$fax', sup_address = '$address', sup_email = '$email' WHERE sup_id = '$id';";

    $update_result = mysqli_query($conn, $sql_update);


    if ($supRM == NULL) {
    } else {
        $delSQL = "DELETE FROM supplier_rm_tbl WHERE sup_id = '$id';";

        $runDel = mysqli_query($conn, $delSQL);

        foreach ($supRM as $rawMat) {

            $rmsID = Auto_id("rm_sup_id", "supplier_rm_tbl", "RMS");

            $runSQL = "INSERT INTO supplier_rm_tbl (rm_sup_id , sup_id, rm_id, row_stt)
                    VALUES ('$rmsID','$id','$rawMat',1);";

            $result = mysqli_query($conn, $runSQL);
        }

        if ($update_result > 0 && $runDel > 0 && $result > 0) {
            return ("success");
        } else {
            return false;
        }
    }

    if ($update_result > 0) {
        return ("success");
    } else {
        return false;
    }
}

//update the supplier status from 1 to 0
function deleteSupplier($supId)
{
    //connection
    $conn = Connection();

    //update sql
    $sql_update = "UPDATE supplier_tbl SET sup_status = 0 WHERE sup_id = '$supId';";

    $update_result = mysqli_query($conn, $sql_update);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    if ($update_result > 0) {
        return ("Deleted");
    } else {
        return false;
    }
}

//update the supplier status from 1 to 0
function reactivateSupplier($supId)
{
    //connection
    $conn = Connection();

    //update sql
    $sql_update = "UPDATE supplier_tbl SET sup_status = 1 WHERE sup_id = '$supId';";

    $update_result = mysqli_query($conn, $sql_update);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    if ($update_result > 0) {
        return ("reactivated");
    } else {
        return false;
    }
}

function getSupplier()
{
    //connection
    $conn = Connection();

    //search SQL 
    $sql_search = "SELECT * FROM supplier_tbl;";

    $search_result = mysqli_query($conn, $sql_search);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $nor = mysqli_num_rows($search_result);

    if ($nor > 0) {

        echo ('<option value="">--Select Supplier --</option>');
        while ($rec = mysqli_fetch_assoc($search_result)) {
            // select HTML view
            echo ("<option value=" . $rec['sup_id'] . ">" . $rec['sup_company_name'] . "</option>");
        }
    } else {
        echo ("No record found");
    }
}


//search section for customer
function supSearch($searchData)
{

    //connection
    $conn = Connection();

    //search SQL 
    $sql_search = "SELECT * FROM supplier_tbl
                    WHERE sup_company_name LIKE '%$searchData%' OR
                    WHERE sup_phone LIKE '%$searchData%' OR
                    WHERE sup_phone_two LIKE '%$searchData%' OR
                    WHERE sup_fax_number LIKE '%$searchData%' OR
                    WHERE sup_address LIKE '%$searchData%'
                    ORDER BY sup_id DESC;";

    $search_result = mysqli_query($conn, $sql_search);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $nor = mysqli_num_rows($search_result);

    if ($nor > 0) {

        while ($rec = mysqli_fetch_assoc($search_result)) {
            if ($rec['sup_status'] == 0) {
                echo ("<tr id=tr_" . $rec['sup_id'] . " style='background-color: #fff0cf;'>");
            } else {
                echo ("<tr id=tr_" . $rec['sup_id'] . " style='background-color: #ffffff;'>");
            }

            echo ("<td>" . $rec['sup_id'] . "</td>");
            echo ("<td>" . $rec['sup_company_name'] . "</td>");
            echo ("<td>" . $rec['sup_email'] . "</td>");
            echo ("<td>" . $rec['sup_phone'] . "</td>");
            echo ("<td>" . $rec['sup_phone_two'] . "</td>");
            echo ("<td>" . $rec['sup_fax_number'] . "</td>");
            echo ("<td>" . $rec['sup_address'] . "</td>");

            if ($rec['sup_status'] == 1) {
                echo ("<td><span class='badge badge-pill badge-primary'>Active</span></td>");
            } else {
                echo ("<td><span class='badge badge-pill badge-danger'>Deactive</span></td>");
            }

            echo ("<td><button id=" . $rec['sup_id'] . " class='btn btn-primary btn-sm' style='margin-top:10px;margin-right:10px' data-toggle='modal' data-target='#editModal'><i class='fas fa-user-edit'></i></button></td>");
            echo ("<td><button id=" . $rec['sup_id'] . " class='btn btn-warning' style='margin-left:10px;margin-bottom:10px;margin-top:10px;margin-right:10px'><i class='far fa-trash-alt'></i></button></td>");
            echo ("</tr>");
        }
    } else {
        echo (" No record found");
    }
}

function getsingleSup($id)
{
    $conn = Connection();

    $sql_select = "SELECT * FROM supplier_tbl WHERE sup_id ='$id';";

    $sql_result = mysqli_query($conn, $sql_select);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $nor = mysqli_num_rows($sql_result);

    if ($nor > 0) {

        $supRM = '';

        $rec = mysqli_fetch_assoc($sql_result);

        $getRMbySUP = "SELECT supplier_tbl.sup_id, supplier_rm_tbl.rm_id, rawmaterial_tbl.rm_name
                        FROM ((supplier_rm_tbl
                        INNER JOIN supplier_tbl
                        ON supplier_rm_tbl.sup_id = supplier_tbl.sup_id)
                        INNER JOIN rawmaterial_tbl
                        ON supplier_rm_tbl.rm_id = rawmaterial_tbl.rm_id)
                        WHERE supplier_tbl.sup_id = '$id';";

        $runQuery = mysqli_query($conn, $getRMbySUP);

        $rows = mysqli_num_rows($runQuery);

        if ($rows > 0) {
            while ($record = mysqli_fetch_assoc($runQuery)) {

                $supRM .= $record['rm_name'] . ', ';
            }
        }

        $supRMSend = rtrim($supRM, ", ");

        $supRMSend = '<i class="fas fa-check"></i>&nbsp;&nbsp;This supplier supplies ' . $supRMSend . '. If you wish to change or add a new item, please re-add all the materials supplied by the relevant supplier';

        $sendText = array($rec, $supRMSend);

        return (json_encode($sendText));
    } else {
        return false;
    }
};
