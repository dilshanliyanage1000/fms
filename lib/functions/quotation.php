<?php

include_once("db_conn.php");

include_once("id_maker.php");

//----------------------------------------------------------------------------------------------------

function createQuotation($cus_id, $pdfpath, $date, $desc)
{
    $conn = Connection();

    $id = Auto_id("qt_id", "quotation_tbl", "UIQ");

    $sql_insert = "INSERT INTO quotation_tbl (qt_id,cus_id,qt_pdf_path,qt_form_status,qt_desc,qt_date,qt_status) VALUES ('$id','$cus_id','$pdfpath','Pending','$desc','$date',1);";

    $sql_result = mysqli_query($conn, $sql_insert);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    if ($sql_result > 0) {
        return $id;
    } else {
        return "Error, Try again !!";
    }
}

//------------------------------------------------------------------------------------------------------

function updateQuotationPath($id, $pdfpath)
{
    $conn = Connection();

    $sql_insert = "UPDATE quotation_tbl SET qt_pdf_path = '$pdfpath' WHERE qt_id = '$id';";

    $sql_result = mysqli_query($conn, $sql_insert);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    if ($sql_result > 0) {
        return ("success");
    } else {
        return false;
    }
}


//----------------------------------List of all quotations------------------------------------------

function QuotationList()
{
    $conn = Connection();

    $view_sql = "SELECT cus_tbl.cus_first_name,
                        cus_tbl.cus_last_name,
                        cus_tbl.cus_email,
                        cus_tbl.cus_code_phoneone,
                        cus_tbl.cus_phone_one,
                        cus_tbl.cus_code_phonetwo,
                        cus_tbl.cus_phone_two,
                        cus_tbl.cus_houseno,
                        cus_tbl.cus_street_one,
                        cus_tbl.cus_street_two,
                        cus_tbl.cus_city,
                        cus_tbl.cus_postal_code,
                        quotation_tbl.qt_id,
                        quotation_tbl.qt_pdf_path,
                        quotation_tbl.qt_date,
                        quotation_tbl.qt_form_status,
                        quotation_tbl.qt_desc
                FROM cus_tbl
                INNER JOIN quotation_tbl
                ON cus_tbl.cus_id = quotation_tbl.cus_id
                WHERE qt_status = 1;";

    $view_result = mysqli_query($conn, $view_sql);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $nor = mysqli_num_rows($view_result);

    if ($nor > 0) {

        while ($rec = mysqli_fetch_assoc($view_result)) {

            echo ("<td>" . $rec['qt_id'] . "</td>");

            echo ("<td>" . $rec['qt_date'] . "</td>");

            echo ("<td><a href='" . $rec['qt_pdf_path'] . "' target='_blank'><button class='btn btn-primary'><i class='fas fa-file-signature'></i>&nbsp;&nbsp;View</button></a></td>");

            echo ("<td>" . $rec['cus_first_name'] . "&nbsp;" . $rec['cus_last_name'] . "</br>" . $rec['cus_code_phoneone'] . "&nbsp;" . $rec['cus_phone_one'] . "</br>" . $rec['cus_email'] . "</br>" . $rec['cus_houseno'] . ", " . $rec['cus_street_one'] . ", " . $rec['cus_street_two'] . ", " . $rec['cus_city'] . "</td>");

            echo ("<td>" . $rec["qt_desc"] . "</td>");

            if ($rec["qt_form_status"] == "Pending") {

                echo ("<td><span class='badge badge-pill badge-primary'>" . $rec["qt_form_status"] . "</span></td>");
            } else if ($rec["qt_form_status"] == "Confirmed") {

                echo ("<td><span class='badge badge-pill badge-success'>" . $rec["qt_form_status"] . "</span></td>");
            }

            if ($rec["qt_form_status"] == "Pending") {

                echo ("<td><button style='width:100%;' type='button' class='btn btn-success btn-sm btn-confirm-quotation' id='" . $rec['qt_id'] . "'><i class='icon-checkmark3'></i>Confirm</button></td>");
                echo ("<td><button style='width:100%;' type='button' class='btn btn-danger btn-sm btn-delete-quotation' id='" . $rec['qt_id'] . "'><i class='icon-spinner11'></i>Delete</button></td>");
            } else if ($rec["qt_form_status"] == "Confirmed") {

                echo ("<td><button style='width:100%;' type='button' class='btn btn-warning btn-sm btn-pending-quotation' id='" . $rec['qt_id'] . "'><i class='icon-checkmark3'></i>Change</button></td>");
                echo ("<td><button style='width:100%;' type='button' class='btn btn-danger btn-sm btn-delete-quotation' id='" . $rec['qt_id'] . "'><i class='icon-spinner11'></i>Delete</button></td>");
            }

            echo ("</tr>");
        }
    } else {
        return (" No record found");
    }
}

// ------------------------------Customer search details section------------------------------------

function cusSearchQuotation($search)
{
    // call the connection
    $conn = Connection();

    $searchSql = "SELECT *
                    FROM cus_tbl 
                    WHERE cus_id LIKE '%$search%' OR
                    cus_first_name LIKE '%$search%' OR
                    cus_last_name LIKE '%$search%' OR
                    cus_email LIKE '%$search%' OR
                    cus_phone_one LIKE '%$search%' OR
                    cus_phone_two LIKE '%$search%' OR
                    cus_houseno LIKE '%$search%' OR
                    cus_street_one LIKE '%$search%' OR
                    cus_street_two LIKE '%$search%' OR
                    cus_city LIKE '%$search%' OR
                    cus_postal_code LIKE '%$search%';";

    $searchQuery = mysqli_query($conn, $searchSql);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    //check no of records
    $nor = mysqli_num_rows($searchQuery);

    if ($nor > 0) {

        $output = '
            <div class="wrapper" id="wrapper">
            <div style="overflow-y: scroll; flex: 1; height: 250px; width: 100%; border: 1px solid #ccc;">
        ';

        while ($rec = mysqli_fetch_assoc($searchQuery)) {
            $output .= '
            <div style="margin: 10px;">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-10" style="font-size: 15px;">
                                <p>' . $rec["cus_first_name"] . ' ' . $rec["cus_last_name"] . ' (' . $rec["cus_email"] . ')<br><br>
                                (' . $rec["cus_code_phoneone"] . '' . $rec["cus_phone_one"] . ') / (' . $rec["cus_code_phonetwo"] . '' . $rec["cus_phone_two"] . ')<br>
                                ' . $rec["cus_houseno"] . ', ' . $rec["cus_street_one"] . ', ' . $rec["cus_street_two"] . ', ' . $rec["cus_city"] . '. ' . $rec["cus_postal_code"] . '</p>
                            </div>
                            <div class="col-md-2">
                                <button style="width:100%;" id="' . $rec["cus_id"] . '" type="button" class="btn btn-info btn-sm"><i class="fas fa-check"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        }

        $output .= '</div></div>';

        echo ($output);
    } else {
        echo ("No record found!");
    }
};

// ------------------------------Customer get details section------------------------------------


function getCusQuotation($cusId)
{
    // call the connection
    $conn = Connection();

    $selectCus = "SELECT * FROM cus_tbl WHERE cus_id = '$cusId';";

    $cusResult = mysqli_query($conn, $selectCus);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $rec = mysqli_fetch_assoc($cusResult);

    return (json_encode($rec));
};


// ------------------------------Customer search details section------------------------------------

function prodSearchQuotation($search)
{
    // call the connection
    $conn = Connection();

    if ($search == '') {
        $search = ' ';
    }

    $searchSql = "SELECT *
                    FROM product_tbl 
                    WHERE prod_id  LIKE '%$search%' OR
                    prod_name LIKE '%$search%' OR
                    prod_code LIKE '%$search%' OR
                    prod_description LIKE '%$search%' OR
                    prod_capacity LIKE '%$search%' OR
                    prod_motor_capacity LIKE '%$search%' OR
                    prod_motor_speed LIKE '%$search%' OR
                    prod_phase LIKE '%$search%';";

    $searchQuery = mysqli_query($conn, $searchSql);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    //check no of records
    $nor = mysqli_num_rows($searchQuery);

    if ($nor > 0) {

        $output = '
            <div class="wrapper" id="wrapper">
            <div style="overflow-y: scroll; flex: 1; height: 250px; width: 100%; border: 1px solid #ccc;">
        ';

        while ($rec = mysqli_fetch_assoc($searchQuery)) {
            $output .= '
            <div style="margin: 10px;">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-9" style="font-size: 15px;">
                                <p>(' . $rec["prod_code"] . ') ' . $rec["prod_name"] . '<br><br>
                                Capacity: ' . $rec["prod_capacity"] . '</br>
                                Motor Capacity: ' . $rec["prod_motor_capacity"] . '<br>
                                Motor Speed : ' . $rec["prod_motor_speed"] . '<br>
                                Current Phase: ' . $rec["prod_phase"] . '</p>
                            </div>
                            <div class="col-md-3">
                                <button style="width:100%;" id="' . $rec["prod_id"] . '" type="button" class="btn btn-success btn-sm"><i class="fas fa-check fa-1x"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        }

        $output .= '</div></div>';

        echo ($output);
    } else {
        echo ("No record found!");
    }
};

// ------------------------------Product get details section------------------------------------

function getProdQuotation($prodId)
{
    // call the connection
    $conn = Connection();

    $selectCus = "SELECT * FROM product_tbl WHERE prod_id = '$prodId';";

    $cusResult = mysqli_query($conn, $selectCus);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $rec = mysqli_fetch_assoc($cusResult);

    return (json_encode($rec));
};


//--------------------------------------------------------------------------------------------------

function getPartQuotation($partId)
{
    // call the connection
    $conn = Connection();

    $selectCus = "SELECT * FROM parts_tbl WHERE part_id = '$partId';";

    $cusResult = mysqli_query($conn, $selectCus);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $rec = mysqli_fetch_assoc($cusResult);

    return (json_encode($rec));
};

//-----------------------------------------------------------------------------------------------------

function deleteQuotation($qtId)
{
    //connection
    $conn = Connection();

    $sqlQuery = "SELECT * FROM quotation_tbl WHERE qt_id = '$qtId';";

    $checkresult = mysqli_query($conn, $sqlQuery);

    $nor = mysqli_num_rows($checkresult);

    if ($nor > 0) {
        while ($rec = mysqli_fetch_assoc($checkresult)) {
            if ($rec['qt_status'] == 1) {

                $sql_update = "UPDATE quotation_tbl SET qt_status = 0 WHERE qt_id = '$qtId';";

                $update_result = mysqli_query($conn, $sql_update);

                if ($update_result > 0) {
                    return ("success");
                } else {
                    return false;
                }
            } else {

                $sql_update = "UPDATE quotation_tbl SET qt_status = 1 WHERE qt_id = '$qtId';";

                $update_result = mysqli_query($conn, $sql_update);

                if ($update_result > 0) {
                    return ("success");
                } else {
                    return false;
                }
            }
        }
    }

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }
}


//--------------------------------------------------------------------------------------------------------------------------

function confirmQuotation($qtId)
{
    //connection
    $conn = Connection();

    $sqlQuery = "SELECT * FROM quotation_tbl WHERE qt_id = '$qtId';";

    $checkresult = mysqli_query($conn, $sqlQuery);

    $nor = mysqli_num_rows($checkresult);

    if ($nor > 0) {
        while ($rec = mysqli_fetch_assoc($checkresult)) {
            if ($rec['qt_form_status'] == "Pending") {

                $sql_update = "UPDATE quotation_tbl SET qt_form_status = 'Confirmed' WHERE qt_id = '$qtId';";

                $update_result = mysqli_query($conn, $sql_update);

                if ($update_result > 0) {
                    return ("success");
                } else {
                    return false;
                }
            } else if ($rec['qt_form_status'] == "Confirmed") {

                $sql_update = "UPDATE quotation_tbl SET qt_form_status ='Pending' WHERE qt_id = '$qtId';";

                $update_result = mysqli_query($conn, $sql_update);

                if ($update_result > 0) {
                    return ("success");
                } else {
                    return false;
                }
            }
        }
    }

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }
}
