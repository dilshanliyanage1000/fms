<?php

include_once('db_conn.php');

include_once('id_maker.php');

function addRMPART($ptid, $tblvalues)
{
    if (empty($ptid) or empty($tblvalues)) {
        return ("Please check your inputs ... ");
    }

    $conn = Connection();

    $tbl =  json_decode($tblvalues);

    $sql_insert = '';

    foreach ($tbl as $row) {

        $rmID       = $row->rmID;
        $rmName     = $row->rmName;
        $rmQty      = $row->rmQty;
        $rmUnit     = $row->rmUnit;

        $id = Auto_id("rmpt_id", "rm_part_tbl", "PRM");

        $sql_insert = "INSERT INTO rm_part_tbl (rmpt_id,part_id,rm_id,rm_qty,rm_w_unit,rmpt_status)
                    VALUES ('$id','$ptid','$rmID','$rmQty','$rmUnit',1);";

        $sql_result = mysqli_query($conn, $sql_insert);
    }

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    if ($sql_result > 0) {
        return ("success");
    } else {
        return "Error, Try again !!";
    }
}

function validatePart($partID)
{
    $conn = Connection();

    $sql_insert = "SELECT * FROM rm_part_tbl WHERE part_id = '$partID';";

    $sql_result = mysqli_query($conn, $sql_insert);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $nor = mysqli_num_rows($sql_result);

    if ($nor > 0) {
        return ("success");
    } else {
        return ("Error, Try again !!");
    }
}

function validateProduct($prodID)
{
    $conn = Connection();

    $sql_insert = "SELECT * FROM part_prod_tbl WHERE prod_id = '$prodID';";

    $sql_result = mysqli_query($conn, $sql_insert);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $nor = mysqli_num_rows($sql_result);

    if ($nor > 0) {
        return ("success");
    } else {
        return ("Error, Try again !!");
    }
}

function getAllRmParts()
{
    $conn = Connection();

    $view_sql = "SELECT * FROM parts_tbl;";

    $view_result = mysqli_query($conn, $view_sql);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $nor = mysqli_num_rows($view_result);

    if ($nor > 0) {
        while ($rec = mysqli_fetch_assoc($view_result)) {

            $partID = $rec['part_id'];
            $partImg = $rec['part_img_path'];


            $getSQL = "SELECT rm_part_tbl.rmpt_id, rawmaterial_tbl.rm_id, rawmaterial_tbl.rm_name, rm_part_tbl.rm_qty, rm_part_tbl.rm_w_unit 
                        FROM ((rm_part_tbl
                        INNER JOIN parts_tbl ON rm_part_tbl.part_id = parts_tbl.part_id)
                        INNER JOIN rawmaterial_tbl ON rm_part_tbl.rm_id = rawmaterial_tbl.rm_id)
                        WHERE rm_part_tbl.part_id = '$partID';";

            $getResult = mysqli_query($conn, $getSQL);

            $rows = mysqli_num_rows($getResult);

            $description = 'This part consists of :</br>';

            $rowID = '';

            if ($rows > 0) {
                while ($record = mysqli_fetch_assoc($getResult)) {

                    $rowID = $record['rmpt_id'];

                    $description .= $record['rm_name'] . ", with a quantity of " . $record['rm_qty'] . $record['rm_w_unit'] . "</br>";
                }

                echo ("<td>" . $rec['part_id'] . "</td>");

                echo ("<td style='text-align: center'>
                        <img id='zoom' src='" . $partImg . "' alt='Part Image' class='responsive' style='height:80px; width:80px; margin-left:1px; margin-bottom:1px; margin-top:1px; margin-right:1px; border: 2px solid #eee;'>
                    </td>");

                echo ("<td>" . $rec['part_name'] . "</td>");

                echo ("<td>" . $description . "</td>");

                echo ("<td style='text-align:center;'><button id=" . $partID . " class='btn btn-danger btn-sm btn-del-rmpart'>Delete</button></td>");

                echo ("</tr>");
            }
        };
    } else {
        return ("No record found");
    }
}

function getPartsbyProd($id)
{
    $conn = Connection();

    $view_sql = "SELECT * FROM parts_tbl WHERE prod_id = '$id';";

    $view_result = mysqli_query($conn, $view_sql);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $nor = mysqli_num_rows($view_result);

    $tablebody = "";

    if ($nor > 0) {

        while ($rec = mysqli_fetch_assoc($view_result)) {

            $tablebody .= "<tr>";

            $tablebody .= "<td style='text-align: center;'>
                            <img id='zoom' src='" . $rec['part_img_path'] . "' style='width: 80px; height: 80px;' alt='" . $rec['part_code'] . "' />
                           </td>";

            $tablebody .= "<td style='text-align: center;'>" . $rec['part_id'] . "</td>";

            if ($rec['part_code'] == '') {
                $tablebody .= "<td style='text-align: center;'>-</td>";
            } else {
                $tablebody .= "<td style='text-align: center;'>" . $rec['part_code'] . "</td>";
            }

            $tablebody .= "<td style='text-align: center;'>" . $rec['part_name'] . "</td>";

            $tablebody .= "<td style='text-align: center;'>
                            <div class='form-group'>
                                <div class='input-group mb-3'>
                                    <div class='input-group-prepend'>
                                        <button type='button' class='btn btn-qtyremove btn-light btn-sm' id='REM" . $rec["part_id"] . "' style='border: 1px solid #d6d6d6; width:100%;'>
                                        <i class='fas fa-minus'></i>
                                        </button>
                                    </div>
                                    <input type='number' style='text-align:center;' name='TXT" . $rec["part_id"] . "' id='TXT" . $rec["part_id"] . "' class='form-control' value='1' disabled>
                                    <div class='input-group-append'>
                                        <button type='button' class='btn btn-qtyadd btn-light btn-sm' id='ADD" . $rec["part_id"] . "' style='border: 1px solid #d6d6d6; width:100%;'>
                                        <i class='fas fa-plus'></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </td>";

            $tablebody .= "</tr>";
        }

        echo ($tablebody);
    } else {
        return false;
    }
}

function getAllPartProduct()
{
    $conn = Connection();

    $view_sql = "SELECT * FROM product_tbl;";

    $view_result = mysqli_query($conn, $view_sql);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $nor = mysqli_num_rows($view_result);

    if ($nor > 0) {
        while ($rec = mysqli_fetch_assoc($view_result)) {

            $productID = $rec['prod_id'];
            $productImg = $rec['prod_img_path'];


            $getSQL = "SELECT product_tbl.prod_name, product_tbl.prod_code, product_tbl.prod_motor_capacity, product_tbl.prod_phase, part_prod_tbl.part_qty, parts_tbl.part_code, parts_tbl.part_name, parts_tbl.part_weight, parts_tbl.part_w_unit 
                        FROM ((part_prod_tbl
                        INNER JOIN product_tbl ON part_prod_tbl.prod_id = product_tbl.prod_id)
                        INNER JOIN parts_tbl ON part_prod_tbl.part_id = parts_tbl.part_id)
                        WHERE part_prod_tbl.prod_id = '$productID';";

            $getResult = mysqli_query($conn, $getSQL);

            $rows = mysqli_num_rows($getResult);

            $description = 'This product is made up of :</br>';

            $rowID = '';

            if ($rows > 0) {
                while ($record = mysqli_fetch_assoc($getResult)) {

                    $description .= $record['part_qty'] . " x " . $record['part_name'] . " (" . $record['part_weight'] . $record['part_w_unit'] . ")</br>";
                }

                echo ("<td style='text-align:center;'>" . $productID . "</td>");

                echo ("<td style='text-align:center;'>" . $rec['prod_code'] . "</td>");

                echo ("<td style='text-align: center'>
                        <img id='zoom' src='" . $productImg . "' alt='Product Image' class='responsive' style='width:100px;'>
                    </td>");

                echo ("<td>[" . $rec['prod_code'] . "] " . $rec['prod_name'] . " (" . $rec["prod_motor_capacity"] . ")</td>");

                echo ("<td>" . $description . "</td>");

                echo ("<td style='text-align:center;'><button id=" . $productID . " class='btn btn-danger btn-sm btn-del'>Delete</button></td>");

                echo ("</tr>");
            }
        };
    } else {
        return ("No record found");
    }
}

function getPartsCount($id)
{
    $conn = Connection();

    $view_sql = "SELECT COUNT(*) AS partcount FROM parts_tbl WHERE prod_id='$id';";

    $view_result = mysqli_query($conn, $view_sql);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $nor = mysqli_num_rows($view_result);

    if ($nor > 0) {
        $rec = mysqli_fetch_assoc($view_result);
        $count = $rec['partcount'];

        echo ($count);
    } else {
        return false;
    }
}

function addPartProd($prodID, $tblvalues)
{
    if (empty($prodID) or empty($tblvalues)) {
        return ("Please check your inputs ... ");
    }

    $conn = Connection();

    $tbl =  json_decode($tblvalues);

    $sql_insert = '';

    foreach ($tbl as $row) {

        $partID       = $row->partID;
        $partQty      = $row->partQty;

        $id = Auto_id("ptpr_id", "part_prod_tbl", "PPR");

        $sql_insert = "INSERT INTO part_prod_tbl (ptpr_id,prod_id,part_id,part_qty,ptpr_status)
                        VALUES ('$id','$prodID','$partID','$partQty',1);";

        $sql_result = mysqli_query($conn, $sql_insert);
    }

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    if ($sql_result > 0) {
        return ("success");
    } else {
        return "Error, Try again !!";
    }
}

function getRequestDetails($id)
{
    $conn = Connection();

    $getRequest = "SELECT * FROM request_tbl WHERE rqst_id = '$id';";

    $search_result = mysqli_query($conn, $getRequest);

    $nor = mysqli_num_rows($search_result);

    if ($nor > 0) {

        while ($rec = mysqli_fetch_assoc($search_result)) {

            if ($rec['rqst_type'] == 'PRODUCTION-REQUEST') {

                $outputText = '<thead class="thead-inverse">
                                    <tr>
                                        <th style="min-width: 150px;">Request ID</th>
                                        <th style="min-width: 150px;">Product ID</th>
                                        <th style="min-width: 150px;">Product Code</th>
                                        <th style="min-width: 150px;">Product Name</th>
                                        <th style="min-width: 150px;">Required Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>';

                $getDetails = "SELECT request_tbl.rqst_id, rqst_production_tbl.prod_id, product_tbl.prod_code, product_tbl.prod_name, product_tbl.prod_motor_capacity, rqst_production_tbl.rqpr_qty
                                FROM ((rqst_production_tbl
                                INNER JOIN product_tbl
                                ON rqst_production_tbl.prod_id = product_tbl.prod_id)
                                INNER JOIN request_tbl
                                ON rqst_production_tbl.rqst_id = request_tbl.rqst_id)
                                WHERE request_tbl.rqst_id = '$id'
                                ORDER BY product_tbl.prod_id ASC;";

                $search_result_2 = mysqli_query($conn, $getDetails);

                $nor_2 = mysqli_num_rows($search_result_2);

                if ($nor_2 > 0) {

                    while ($rec_2 = mysqli_fetch_assoc($search_result_2)) {

                        $outputText .= '<td>' . $rec_2['rqst_id'] . '</td>
                                        <td>' . $rec_2['prod_id'] . '</td>
                                        <td>' . $rec_2['prod_code'] . '</td>
                                        <td>' . $rec_2['prod_name'] . ' (' . $rec_2['prod_motor_capacity'] . ')</td>
                                        <td style="text-align:center;">' . $rec_2['rqpr_qty'] . '</td>';

                        $outputText .= '</tr>';
                    }
                }

                $outputText .= '</tbody>';

                echo ($outputText);
            } else if ($rec['rqst_type'] == 'PART-PRODUCTION-REQUEST') {

                $outputText = '<thead class="thead-inverse">
                                    <tr>
                                        <th style="min-width: 150px;">Request ID</th>
                                        <th style="min-width: 150px;">Part ID</th>
                                        <th style="min-width: 150px;">Part Code</th>
                                        <th style="min-width: 150px;">Part Name</th>
                                        <th style="min-width: 150px;">Required Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>';

                $getDetails = "SELECT request_tbl.rqst_id, rqst_part_production_tbl.part_id, parts_tbl.part_code, parts_tbl.part_name, rqst_part_production_tbl.rqpt_qty
                                FROM ((rqst_part_production_tbl
                                INNER JOIN parts_tbl
                                ON rqst_part_production_tbl.part_id = parts_tbl.part_id)
                                INNER JOIN request_tbl
                                ON rqst_part_production_tbl.rqst_id = request_tbl.rqst_id)
                                WHERE request_tbl.rqst_id = '$id'
                                ORDER BY parts_tbl.part_id ASC;";

                $search_result_2 = mysqli_query($conn, $getDetails);

                $nor_2 = mysqli_num_rows($search_result_2);

                if ($nor_2 > 0) {

                    while ($rec_2 = mysqli_fetch_assoc($search_result_2)) {

                        $outputText .= '<td>' . $rec_2['rqst_id'] . '</td>
                                        <td>' . $rec_2['part_id'] . '</td>
                                        <td>' . $rec_2['part_code'] . '</td>
                                        <td>' . $rec_2['part_name'] . '</td>
                                        <td style="text-align:center;">' . $rec_2['rqpt_qty'] . '</td>';

                        $outputText .= '</tr>';
                    }
                }

                $outputText .= '</tbody>';

                echo ($outputText);
            }
        }
    }
}

function getEachPartoRMonReq($tableData)
{
    $conn = Connection();

    $tbl =  json_decode($tableData);

    $outputText = '';

    $finalRMandQTY = '';

    foreach ($tbl as $row) {

        $partID     = $row->partID;
        $partName   = $row->partName;
        $partQty    = $row->partQty;

        $outputText .= '<div class="col-md-6">
                            <h6 style="color:#4a914e; margin-top: 15px;"><b>' . $partName . '</b> </h6>
                            <table id="TBL' . $partID . '" class="table table-inverse table-responsive" border="0" style="font-size: 15px; background-color: #ffffdb;">
                            <thead>
                                <tr>
                                    <th style="min-width: 120px;">For 1 No(s)</th>
                                    <th style="min-width: 60px;">&nbsp;</th>
                                    <th style="min-width: 60px;">&nbsp;</th>
                                    <th style="min-width: 120px;">&nbsp;&nbsp;&nbsp;For ' . $partQty . ' No(s)</th>
                                </tr>
                            </thead>
                            <tbody>';

        $getpartwithRM = "SELECT parts_tbl.part_id, rawmaterial_tbl.rm_id, rawmaterial_tbl.rm_name, rm_part_tbl.rm_qty, rm_part_tbl.rm_w_unit
                            FROM ((rm_part_tbl
                            INNER JOIN parts_tbl
                            ON rm_part_tbl.part_id = parts_tbl.part_id)
                            INNER JOIN rawmaterial_tbl
                            ON rm_part_tbl.rm_id = rawmaterial_tbl.rm_id)
                            WHERE parts_tbl.part_id = '$partID';";

        $search_result = mysqli_query($conn, $getpartwithRM);

        $nor = mysqli_num_rows($search_result);

        if ($nor > 0) {

            while ($rec = mysqli_fetch_assoc($search_result)) {

                $rmID = $rec["rm_id"];

                $rmName = $rec["rm_name"];

                $rmQty = $rec["rm_qty"];

                $rmUnit = $rec["rm_w_unit"];

                //-------------------------------------------

                $rmQty = $rec["rm_qty"];

                $rmUnit = $rec["rm_w_unit"];

                if ($rmUnit == 'mg') {

                    $rmQty = ($rec["rm_qty"] / 1000) / 1000;

                } else if ($rmUnit == 'g') {

                    $rmQty = ($rec["rm_qty"] / 1000);

                } else if ($rmUnit == 'kg') {

                    $rmQty = $rec["rm_qty"];
                }

                //-----------------------------------------------

                $outputText .= '<td>' . $rmName . '</td>';

                $outputText .= '<td>~&nbsp;&nbsp;' . $rmQty . 'kg</td>';

                $outputText .= '<td style="text-align:center;">&nbsp;<i class="fas fa-long-arrow-alt-right"></i>&nbsp;</td>';

                $newQty = $rmQty * $partQty;

                $outputText .= '<td>' . $rmName . '</td>';

                $outputText .= '<td>~&nbsp;&nbsp;' . $newQty . 'kg</td>';

                $outputText .= '</tr>';

                $checkexist = "SELECT * FROM temp_rawmat_qty_tbl WHERE rm_id = '$rmID';";

                $checkResult = mysqli_query($conn, $checkexist);

                $no_of_rows = mysqli_num_rows($checkResult);

                if ($no_of_rows > 0) {
                    $sqlupdate = "UPDATE temp_rawmat_qty_tbl SET rm_qty = rm_qty + $newQty WHERE rm_id = '$rmID';";
                    $updateResult = mysqli_query($conn, $sqlupdate);
                } else {
                    $sqlinsert = "INSERT INTO temp_rawmat_qty_tbl VALUES ('$rmID','$newQty','kg');";
                    $insertResult = mysqli_query($conn, $sqlinsert);
                }
            }
        }

        $outputText .= '</tbody>
                        </table>
                        </div>';
    }

    $outputText .= '<div>';

    $outputText .= '<h5 style="margin-top: 30px;">The total quantity of raw material required for the part production request includes, </h5>
                    </br>
                    <div class="row">';

    $getTempData = "SELECT temp_rawmat_qty_tbl.rm_id, rawmaterial_tbl.rm_name, temp_rawmat_qty_tbl.rm_qty, temp_rawmat_qty_tbl.rm_w_unit
                        FROM temp_rawmat_qty_tbl
                        INNER JOIN rawmaterial_tbl
                        ON temp_rawmat_qty_tbl.rm_id = rawmaterial_tbl.rm_id";

    $getResult = mysqli_query($conn, $getTempData);

    $rowCount = mysqli_num_rows($getResult);

    $outputText .= '<div class="col-md-6">
                        <table id="final_result" border="0" style="font-size: 17px;">
                            <thead></thead>
                            <tbody style="padding: 10px;">';

    if ($rowCount > 0) {

        while ($singleRec = mysqli_fetch_assoc($getResult)) {

            $rawmatID = $singleRec['rm_id'];

            $requestRMQty = $singleRec['rm_qty'];

            if ($singleRec['rm_w_unit'] == 'mg') {
                $requestRMQty = ($requestRMQty / 1000) / 1000;
            } else if ($singleRec['rm_w_unit'] == 'g') {
                $requestRMQty = ($requestRMQty / 1000);
            }

            // -------------------------------------------

            $getAvaiableStock = "SELECT rm_qty FROM stock_rm_tbl WHERE rm_id = '$rawmatID';";

            $checkAvailability = mysqli_query($conn, $getAvaiableStock);

            $record_set = mysqli_fetch_assoc($checkAvailability);

            $rmStockQty = $record_set['rm_qty'];

            if ($requestRMQty > $rmStockQty) {

                $outputText .= '<tr style="color: #e39697;">
                                    <td style="min-width: 100px;">[' . $singleRec["rm_id"] . ']</td>
                                    <td style="min-width: 100px;">&nbsp;' . $singleRec["rm_name"] . '</td>
                                    <td style="min-width: 60px; text-align: center;"><i class="fas fa-long-arrow-alt-right"></i></td>
                                    <td style="min-width: 80px; text-align: right;">' . $singleRec["rm_qty"] . '</td>
                                    <td style="min-width: 50px; text-align: left;">' . $singleRec["rm_w_unit"] . '</td>
                                    <td style="min-width: 550px;">
                                        <div style="background-color: #e39697; color: white; padding: 10px; margin: 5px; border-radius: 10px;">
                                            &nbsp;<i class="fas fa-exclamation-circle"></i>&nbsp;&nbsp;Not enough stocks ( Only ~' . $rmStockQty . ' Kg(s) available )
                                        </div>
                                    </td>
                                </tr>';

                $finalRMandQTY .= $singleRec["rm_id"] . '_' . $requestRMQty . '_' . $singleRec["rm_w_unit"] . '_' . $rmStockQty . '_error/';
            } else {

                $outputText .= '<tr style="color: #6cbd71;">
                                    <td style="min-width: 100px;">[' . $singleRec["rm_id"] . ']</td>
                                    <td style="min-width: 100px;">&nbsp;' . $singleRec["rm_name"] . '</td>
                                    <td style="min-width: 60px; text-align: center;"><i class="fas fa-long-arrow-alt-right"></i></td>
                                    <td style="min-width: 80px; text-align: right;">' . $singleRec["rm_qty"] . '</td>
                                    <td style="min-width: 50px; text-align: left;">' . $singleRec["rm_w_unit"] . '</td>
                                    <td style="min-width: 550px;">
                                        <div style="background-color: #6cbd71; color: white; padding: 10px; margin: 5px; border-radius: 10px;">
                                            &nbsp;<i class="fas fa-check"></i>&nbsp;&nbsp;Sufficient Stocks available ( ~' . $rmStockQty . ' Kg(s) available )
                                        </div>
                                    </td>
                                </tr>';

                $finalRMandQTY .= $singleRec["rm_id"] . '_' . $requestRMQty . '_' . $singleRec["rm_w_unit"] . '_' . $rmStockQty . '_success/';
            }
        }
    }

    $outputText .= '</tbody></table></div>';

    $sendText = array($outputText, $finalRMandQTY);

    $clearData = "TRUNCATE TABLE temp_rawmat_qty_tbl;";

    $runClearSQL = mysqli_query($conn, $clearData);

    return (json_encode($sendText));
}

//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

function getEachProdtoPartReq($tableData)
{
    $conn = Connection();

    $tbl =  json_decode($tableData);

    $outputText = '';

    $finalPartandQTY = '';

    foreach ($tbl as $row) {

        $prodID     = $row->prodID;
        $prodCode   = $row->prodCode;
        $prodName   = $row->prodName;
        $prodQty    = $row->prodQty;

        $outputText .= '<div class="col-md-6">
                            <h6 style="color:#4a914e; margin-top: 15px;"><b>[' . $prodCode . '] ' . $prodName . '</b></h6>
                            <table id="TBL' . $prodID . '" class="table table-inverse table-responsive" border="0" style="font-size: 15px; background-color: #ffffdb;">
                            <thead>
                                <tr>
                                    <th style="min-width: 120px;">For 1 No(s)</th>
                                    <th style="min-width: 60px;">&nbsp;</th>
                                    <th style="min-width: 60px;">&nbsp;</th>
                                    <th style="min-width: 120px;">&nbsp;&nbsp;&nbsp;For ' . $prodQty . ' No(s)</th>
                                </tr>
                            </thead>
                            <tbody>';

        $getProdwithPart = "SELECT product_tbl.prod_id, parts_tbl.part_id, parts_tbl.part_code, parts_tbl.part_name, part_prod_tbl.part_qty
                            FROM ((part_prod_tbl
                            INNER JOIN product_tbl
                            ON part_prod_tbl.prod_id = product_tbl.prod_id)
                            INNER JOIN parts_tbl
                            ON part_prod_tbl.part_id = parts_tbl.part_id)
                            WHERE product_tbl.prod_id = '$prodID';";

        $search_result = mysqli_query($conn, $getProdwithPart);

        $nor = mysqli_num_rows($search_result);

        if ($nor > 0) {

            while ($rec = mysqli_fetch_assoc($search_result)) {

                $partID = $rec["part_id"];

                $partCode = $rec["part_code"];

                $partName = $rec["part_name"];

                $partQty = $rec["part_qty"];

                $outputText .= '<td>' . $partName . '</td>';

                $outputText .= '<td>&nbsp;&nbsp;' . $partQty . ' unit(s)</td>';

                $outputText .= '<td style="text-align:center;">&nbsp;<i class="fas fa-long-arrow-alt-right"></i>&nbsp;</td>';

                $newQty = $partQty * $prodQty;

                $outputText .= '<td style="text-align:right;">' . $newQty . ' unit(s)&nbsp;&nbsp;</td>';

                $outputText .= '</tr>';

                $checkexist = "SELECT * FROM temp_part_qty_tbl WHERE part_id = '$partID';";

                $checkResult = mysqli_query($conn, $checkexist);

                $no_of_rows = mysqli_num_rows($checkResult);

                if ($no_of_rows > 0) {
                    $sqlupdate = "UPDATE temp_part_qty_tbl SET part_qty = part_qty + $newQty WHERE part_id = '$partID';";
                    $updateResult = mysqli_query($conn, $sqlupdate);
                } else {
                    $sqlinsert = "INSERT INTO temp_part_qty_tbl VALUES ('$partID','$newQty');";
                    $insertResult = mysqli_query($conn, $sqlinsert);
                }
            }
        }

        $outputText .= '</tbody>
                        </table>
                        </div>';
    }

    $outputText .= '<div>';

    $outputText .= '<h5 style="margin-top: 30px;">The total quantity of raw material required for the part production request includes, </h5>
                    </br>
                    <div class="row">';

    $getTempData = "SELECT temp_part_qty_tbl.part_id, parts_tbl.part_code, parts_tbl.part_name, temp_part_qty_tbl.part_qty
                        FROM temp_part_qty_tbl
                        INNER JOIN parts_tbl
                        ON temp_part_qty_tbl.part_id = parts_tbl.part_id";

    $getResult = mysqli_query($conn, $getTempData);

    $rowCount = mysqli_num_rows($getResult);

    $outputText .= '<div class="col-md-12">
                        <table id="final_result" border="0" style="font-size: 17px;">
                            <thead></thead>
                            <tbody style="padding: 10px;">';

    if ($rowCount > 0) {

        while ($singleRec = mysqli_fetch_assoc($getResult)) {

            $part_ID = $singleRec['part_id'];

            $requestedPartQty = $singleRec['part_qty'];

            // -------------------------------------------

            $getAvaiableStock = "SELECT part_qty FROM stock_part_tbl WHERE part_id = '$part_ID';";

            $checkAvailability = mysqli_query($conn, $getAvaiableStock);

            $record_set = mysqli_fetch_assoc($checkAvailability);

            $partStockQty = $record_set['part_qty'];

            if ($requestedPartQty > $partStockQty) {

                $outputText .= '<tr style="color: #e39697;">
                                    <td style="min-width: 100px; display:none;">' . $singleRec["part_id"] . '</td>
                                    <td style="min-width: 100px;">' . $singleRec["part_code"] . '</td>
                                    <td style="min-width: 300px;">&nbsp;' . $singleRec["part_name"] . '</td>
                                    <td style="min-width: 60px; text-align: left;"><i class="fas fa-long-arrow-alt-right"></i></td>
                                    <td style="min-width: 80px; text-align: right;">' . $singleRec["part_qty"] . '</td>
                                    <td style="min-width: 30px; text-align: left;">&nbsp;unit(s)</td>
                                    <td style="min-width: 40px;">&nbsp;</td>
                                    <td style="min-width: 450px;">
                                        <div style="background-color: #e39697; color: white; padding: 10px; margin: 5px; border-radius: 10px;">
                                            &nbsp;<i class="fas fa-exclamation-circle"></i>&nbsp;&nbsp;Not enough stocks ( Only ~' . $partStockQty . ' unit(s) available )
                                        </div>
                                    </td>
                                </tr>';

                $finalPartandQTY .= $singleRec["part_id"] . '_' . $requestedPartQty . '_' . $partStockQty . '_error/';
            } else {

                $outputText .= '<tr style="color: #6cbd71;">
                                    <td style="min-width: 100px; display:none;">' . $singleRec["part_id"] . '</td>
                                    <td style="min-width: 100px;">' . $singleRec["part_code"] . '</td>
                                    <td style="min-width: 300px;">&nbsp;' . $singleRec["part_name"] . '</td>
                                    <td style="min-width: 60px; text-align: left;"><i class="fas fa-long-arrow-alt-right"></i></td>
                                    <td style="min-width: 80px; text-align: right;">' . $singleRec["part_qty"] . '</td>
                                    <td style="min-width: 30px; text-align: left;">&nbsp;unit(s)</td>
                                    <td style="min-width: 40px;">&nbsp;</td>
                                    <td style="min-width: 450px;">
                                        <div style="background-color: #6cbd71; color: white; padding: 10px; margin: 5px; border-radius: 10px;">
                                            &nbsp;<i class="fas fa-check"></i>&nbsp;&nbsp;Sufficient Stocks available ( ~' . $partStockQty . ' unit(s) available )
                                        </div>
                                    </td>
                                </tr>';

                $finalPartandQTY .= $singleRec["part_id"] . '_' . $requestedPartQty . '_' . $partStockQty . '_success/';
            }
        }
    }

    $outputText .= '</tbody></table></div>';

    $sendText = array($outputText, $finalPartandQTY);

    $clearData = "TRUNCATE TABLE temp_part_qty_tbl;";

    $runClearSQL = mysqli_query($conn, $clearData);

    return (json_encode($sendText));
}

function DelProdtoPart($id)
{
    $conn = Connection();

    $deleteSQL = "UPDATE part_prod_tbl SET ptpr_status = 0 WHERE prod_id = '$id';";

    $runSQL = mysqli_query($conn, $deleteSQL);

    $nor = mysqli_num_rows($runSQL);

    if ($nor > 0) {
        echo ('success');
    } else {
        return ('error');
    }
}

function DelParttoRM($id)
{
    $conn = Connection();

    $deleteSQL = "UPDATE rm_part_tbl SET rmpt_status = 0 WHERE part_id = '$id';";

    $runSQL = mysqli_query($conn, $deleteSQL);

    $nor = mysqli_num_rows($runSQL);

    if ($nor > 0) {
        echo ('success');
    } else {
        return ('error');
    }
}
