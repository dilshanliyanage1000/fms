<?php

//import database connection
include_once('db_conn.php');

//id auto gen
include_once('id_maker.php');


function addNewProdDiag($cusId, $prodId, $cusStat, $initStat, $filename1, $filepath1, $filename2, $filepath2)
{
    if (empty($cusId) or empty($prodId) or empty($cusStat) or empty($initStat)) {
        return ("Please check your inputs ... ");
    }

    $conn = Connection();

    $id = Auto_id("diag_id", "product_diagnosis_tbl", "PDD");

    $imageOne = '';

    if ($filename1 == '' || $filepath1 == '') {
    } else {
        $imageOne = $id . "-" . $filename1;

        mkdir('../../images/product_diagnosis/' . $id);

        move_uploaded_file($filepath1, "../../images/product_diagnosis/$id/$imageOne");

        $imageOne = '../../images/product_diagnosis/' . $id . '/' . $imageOne;
    }

    $imageTwo = '';

    if ($filename2 == '' || $filepath2 == '') {
    } else {
        $imageTwo = $id . "-" . $filename2;

        move_uploaded_file($filepath2, "../../images/product_diagnosis/$id/$imageTwo");

        $imageTwo = '../../images/product_diagnosis/' . $id . '/' . $imageTwo;
    }

    $sql_insert = "INSERT INTO product_diagnosis_tbl (diag_id , cus_id, prod_id, cus_statement, inital_d_statement, img_1, img_2)
                    VALUES ('$id','$cusId','$prodId','$cusStat','$initStat','$imageOne','$imageTwo');";

    $sql_result = mysqli_query($conn, $sql_insert);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    if ($sql_result == 1) {
        return "success";
    } else {
        return "Error, Try again !!";
    }
};

// ------------------------------Customer get details section------------------------------------

function SearchCus($search)
{
    $conn = Connection();

    $searchSql = "SELECT *
                    FROM cus_tbl
                    WHERE cus_id  LIKE '%$search%' OR
                    cus_first_name  LIKE '%$search%' OR
                    cus_last_name LIKE '%$search%' OR
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
            <table class="table table-hover table-striped table-inverse table-responsive" width="100%">
            <tr>
                <th class="th-sm">First Name</th>
                <th class="th-sm">Last Name</th>
                <th class="th-sm">Contact No</th>
                <th class="th-sm">Confirm</th>
            </tr>';

        while ($rec = mysqli_fetch_assoc($searchQuery)) {
            $output .= '
                <tr>
                <td id=' . $rec['cus_first_name'] . '>' . $rec['cus_first_name'] . '</td>
                <td id=' . $rec['cus_last_name'] . '>' . $rec['cus_last_name'] . '</td>
                <td name=' . $rec['cus_phone_one'] . '>' . $rec['cus_code_phoneone'] . $rec['cus_phone_one'] . '</td>
                <td> <button onclick="return false" class="btn btn-info" id=' . $rec['cus_id'] . '>Confirm</td>
                </tr>';
        }

        echo ($output);
    } else {
        echo ("No record found!");
    }
};

function CusData($cusId)
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

// ------------------------------Customer get details section end------------------------------------

// ------------------------------Products get details section------------------------------------

function ProdData($prodId)
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


function SearchProd($search)
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
            <div style="overflow-y: scroll; flex: 1; height: 250px; width: 100%; border: 3px solid #eee;">
        ';

        while ($rec = mysqli_fetch_assoc($searchQuery)) {
            $output .= '
            <div style="margin: 10px;">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-9">
                                <p class="card-text">(' . $rec["prod_code"] . ') ' . $rec["prod_name"] . '</p>
                                <p class="card-text">Capacity: ' . $rec["prod_capacity"] . '</p>
                                <p class="card-text">Motor Capacity: ' . $rec["prod_motor_capacity"] . '</p>
                                <p class="card-text">Current Phase: ' . $rec["prod_phase"] . '</p>
                            </div>
                            <div class="col-md-3">
                                <button style="width:100%; margin-right:5px;" id="' . $rec["prod_id"] . '" type="button" class="btn btn-success btn-selprod btn-sm"><i class="fas fa-check fa-1x"></i></button>
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

function getProdDiag()
{
    $conn = Connection();

    $searchSql = "SELECT product_diagnosis_tbl.diag_id, cus_tbl.cus_first_name, cus_tbl.cus_last_name, product_tbl.prod_name, product_tbl.prod_motor_capacity, product_diagnosis_tbl.diag_uploaded_date
                    FROM ((product_diagnosis_tbl
                    INNER JOIN cus_tbl
                    ON product_diagnosis_tbl.cus_id = cus_tbl.cus_id)
                    INNER JOIN product_tbl
                    ON product_diagnosis_tbl.prod_id = product_tbl.prod_id)
                    WHERE product_diagnosis_tbl.diag_check_status = 'Pending'
                    ORDER BY product_diagnosis_tbl.diag_uploaded_date DESC;";

    $searchQuery = mysqli_query($conn, $searchSql);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    //check no of records
    $nor = mysqli_num_rows($searchQuery);

    if ($nor > 0) {

        while ($rec = mysqli_fetch_assoc($searchQuery)) {

            $datetime = $rec["diag_uploaded_date"];

            $datetime = explode(" ", $datetime);

            $dateOnly = $datetime[0];

            $timeOnly = $datetime[1];

            echo ('<div class="card" style="margin-top:10px;">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted">' . $rec["prod_name"] . ' (' . $rec["prod_motor_capacity"] . ')</h6>
                            <hr class="my-4">
                            <p class="card-text">' . $dateOnly . ' @ ' . $timeOnly . '</br>Customer : ' . $rec["cus_first_name"] . ' ' . $rec["cus_last_name"] . '</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" id="' . $rec["diag_id"] . '" class="btn btn-primary btn-block btn-load-img"><i class="fas fa-folder-plus"></i>&nbsp;&nbsp;Load</button>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" id="' . $rec["diag_id"] . '" class="btn btn-danger btn-block btn-delete-diag""><i class="fas fa-trash"></i>&nbsp;&nbsp;Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>');
        }
    } else {
        echo ("No record found!");
    }
};

function getimglistbyID($id)
{
    $conn = Connection();

    $searchSql = "SELECT img_1, img_2
                    FROM product_diagnosis_tbl
                    WHERE diag_id = '$id';";

    $searchQuery = mysqli_query($conn, $searchSql);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    //check no of records
    $nor = mysqli_num_rows($searchQuery);

    if ($nor > 0) {
        $rec = mysqli_fetch_assoc($searchQuery);
        echo ('<img style="padding: 5px;" class="loaded-img-set" src="' . $rec['img_1'] . '" id="loaded_img_one" alt="DiagnosisImageOne">');
        echo ('<img style="padding: 5px;" class="loaded-img-set" src="' . $rec['img_2'] . '" id="loaded_img_two" alt="DiagnosisImageOne">');
    } else {
        return ('No images found!');
    }
}

function getDiagnosisbyID($id)
{
    $conn = Connection();

    $searchSql = "SELECT * FROM product_diagnosis_tbl WHERE diag_id = '$id';";

    $searchQuery = mysqli_query($conn, $searchSql);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    //check no of records
    $nor = mysqli_num_rows($searchQuery);

    if ($nor > 0) {
        $rec = mysqli_fetch_assoc($searchQuery);
        echo (json_encode($rec));
    } else {
        return ('No images found!');
    }
}

function finalizeDiagnosis($diagid, $warrantyStatus, $prodEligibility, $repaircost, $prodCondition, $finalDiag)
{
    if (empty($diagid) or empty($warrantyStatus) or empty($prodEligibility) or empty($prodCondition) or empty($finalDiag)) {
        return ('Please check your inputs...');
    }

    $conn = Connection();

    $id = Auto_id("pfd_id ", "product_diag_finalized_tbl", "PFD");

    $searchSql = "INSERT INTO product_diag_finalized_tbl(pfd_id,diag_id,pfd_warranty_stt,pfd_eligibility,pfd_repair_cost,pfd_prod_condition,pfd_final_diag,pfd_status)
                    VALUES('$id','$diagid','$warrantyStatus','$prodEligibility','$repaircost','$prodCondition','$finalDiag',1);";

    $searchQuery = mysqli_query($conn, $searchSql);

    $updateSQL = "UPDATE product_diagnosis_tbl SET diag_check_status = 'Checked' WHERE diag_id = '$diagid';";

    $runSQL = mysqli_query($conn, $updateSQL);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    if ($searchQuery > 0 && $runSQL > 0) {
        return ($id);
    } else {
        return ('error');
    }
}

function DiagnosisList()
{
    $conn = Connection();

    $view_sql = "SELECT product_diagnosis_tbl.diag_id, cus_tbl.cus_first_name, cus_tbl.cus_last_name, product_tbl.prod_code, product_tbl.prod_name, product_tbl.prod_motor_capacity, product_diagnosis_tbl.img_1, product_diagnosis_tbl.img_2, product_diag_finalized_tbl.pfd_pdf_path, product_diagnosis_tbl.diag_uploaded_date
                    FROM (((product_diagnosis_tbl
                    INNER JOIN cus_tbl
                    ON product_diagnosis_tbl.cus_id = cus_tbl.cus_id)
                    INNER JOIN product_tbl
                    ON product_diagnosis_tbl.prod_id = product_tbl.prod_id)
                    INNER JOIN product_diag_finalized_tbl
                    ON product_diag_finalized_tbl.diag_id = product_diagnosis_tbl.diag_id);";

    $view_result = mysqli_query($conn, $view_sql);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    //check no of records
    $nor = mysqli_num_rows($view_result);

    if ($nor > 0) {

        while ($rec = mysqli_fetch_assoc($view_result)) {

            echo ("<td>" . $rec['diag_id'] . "</td>");

            $datearr = explode(" ", $rec['diag_uploaded_date']);
            $dateOnly = $datearr[0];

            echo ("<td>" . $dateOnly . "</td>");

            echo ("<td>" . $rec['cus_first_name'] . "&nbsp;" . $rec['cus_last_name'] . "</td>");
            echo ("<td>[" . $rec['prod_code'] . "]&nbsp;" . $rec['prod_name'] . "&nbsp;(" . $rec['prod_motor_capacity'] . ")</td>");
            echo ("<td>
                        <img id='img_1' style='width:80px;' src='" . $rec['img_1'] . "' />
                    </td>");

            echo ("<td>
                        <img id='img_2' style='width:80px;' src='" . $rec['img_2'] . "' />
                    </td>");

            echo ("<td style='text-align: center;'><a href='" . $rec['pfd_pdf_path'] . "' target='_blank'><button class='btn btn-info btn-sm' style='width:100%'><i class='fas fa-file-signature'></i>&nbsp;&nbsp;View</button></a></td>");

            echo ("<td style='text-align:center;'><button id=" . $rec['diag_id'] . " class='btn btn-danger btn-sm'>Delete</button></td>");
            echo ("</tr>");
        }
    } else {
        return (" No record found");
    }
}

// ------------------------------Products get details section end------------------------------------
