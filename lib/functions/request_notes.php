<?php

date_default_timezone_set('Asia/Colombo');

include_once("db_conn.php");

include_once("employee.php");

include_once("id_maker.php");

//----------------------------------------------------------------------------------------------------

function getRMRQST($searchData)
{
    //connection
    $conn = Connection();

    //search SQL 
    $sql_search = "SELECT supplier_rm_tbl.rm_sup_id, supplier_rm_tbl.sup_id, supplier_tbl.sup_company_name, supplier_rm_tbl.rm_id, rawmaterial_tbl.rm_name, rawmaterial_tbl.rm_description
                    FROM ((supplier_rm_tbl
                    INNER JOIN supplier_tbl ON supplier_rm_tbl.sup_id = supplier_tbl.sup_id)
                    INNER JOIN rawmaterial_tbl ON supplier_rm_tbl.rm_id = rawmaterial_tbl.rm_id)
                    WHERE rm_sup_id LIKE '%$searchData%' OR 
                    supplier_rm_tbl.sup_id LIKE '%$searchData%' OR 
                    sup_company_name LIKE '%$searchData%' OR 
                    supplier_rm_tbl.rm_id LIKE '%$searchData%' OR 
                    rm_name LIKE '%$searchData%';";

    $search_result = mysqli_query($conn, $sql_search);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $nor = mysqli_num_rows($search_result);

    if ($nor > 0) {

        while ($rec = mysqli_fetch_assoc($search_result)) {

            echo ("<div style='display: inline-block; margin: 10px; text-align:center;'>
                        <div class='card' style='width: 100%;'>
                            <div class='card-body'>
                                <h5 class='card-text' style='color:coral;'><b>" . $rec["sup_company_name"] . "</b></h5>
                                <hr class='my-4'>
                                <h6 class='card-text'>Raw Material:&nbsp;<b>" . $rec["rm_name"] . "</b></h6>
                                <br>
                                <button style='width:75%; margin-top:5px;' id=" . $rec["rm_sup_id"] . " type='button' class='btn btn-info btn-sm'><i class='fas fa-check fa-1x'></i></button>
                            </div>
                        </div>
                    </div>");
        }
    } else {
        echo ("No records found!");
    }
};

// ------------------------------Customer get details section------------------------------------

function getRMSUP($id)
{
    // call the connection
    $conn = Connection();

    $sql_search = "SELECT supplier_rm_tbl.rm_sup_id, supplier_rm_tbl.sup_id, supplier_tbl.sup_company_name, supplier_rm_tbl.rm_id, rawmaterial_tbl.rm_name, rawmaterial_tbl.rm_description
                    FROM ((supplier_rm_tbl
                    INNER JOIN supplier_tbl ON supplier_rm_tbl.sup_id = supplier_tbl.sup_id)
                    INNER JOIN rawmaterial_tbl ON supplier_rm_tbl.rm_id = rawmaterial_tbl.rm_id)
                    WHERE supplier_rm_tbl.rm_sup_id = '$id';";

    $cusResult = mysqli_query($conn, $sql_search);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $rec = mysqli_fetch_assoc($cusResult);

    return (json_encode($rec));
};

//----------------------------------------------------------------------------------------------------------------------


function getSupplierRQST()
{
    //connection
    $conn = Connection();

    //search SQL 
    $sql_search = "SELECT supplier_rm_tbl.rm_sup_id, supplier_rm_tbl.sup_id, supplier_tbl.sup_company_name, supplier_rm_tbl.rm_id, rawmaterial_tbl.rm_name, rawmaterial_tbl.rm_description
                    FROM ((  supplier_rm_tbl
                    INNER JOIN supplier_tbl ON supplier_rm_tbl.sup_id = supplier_tbl.sup_id)
                    INNER JOIN rawmaterial_tbl ON supplier_rm_tbl.rm_id = rawmaterial_tbl.rm_id);";

    $search_result = mysqli_query($conn, $sql_search);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $nor = mysqli_num_rows($search_result);

    if ($nor > 0) {

        while ($rec = mysqli_fetch_assoc($search_result)) {

            echo ("<div class='card mb-3' style='text-align:center; display: inline-block; width:200px; min-height:200px;'>
                        <div class='card-body'>
                            <h6 class='card-title' style='color:green;'>" . $rec["sup_company_name"] . "</h6>
                        </div>
                        <ul class='list-group list-group-flush'>
                            <li class='list-group-item'><h6 class='card-title'>" . $rec["rm_name"] . "</h6></li>
                            <li class='list-group-item'><h6 class='card-title'>" . $rec["rm_description"] . "</h6></li>
                            <li class='list-group-item'><button id=" . $rec['rm_sup_id'] . " class='btn btn-info' style='margin-top:10px;margin-right:10px'><i class='fas fa-check'></i></li>
                        </ul>
                    </div>");
        }
    } else {
        echo ("No record found");
    }
};

//-------------------------------------------------------------------------------------------------------------------------------------

function prodSearchRQ($search)
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

        while ($rec = mysqli_fetch_assoc($searchQuery)) {

            echo ("<div style='display: inline-block; margin-top:5px; margin-bottom: 10px; margin-right: 15px; text-align:center; max-width: 300px; background-color: white; border-radius: 10px;'>
                        <div>
                            <div class='container' style='padding-top: 10px; padding-bottom: 10px;'>
                                <div class='row'>
                                    <div class='col-md-1'></div>
                                    <div class='col-md-10'>
                                        <div>
                                        <h5 style='color:coral;'><b>" . $rec["prod_code"] . "</b></h5> 
                                        </div>
                                        <img src='" . $rec["prod_img_path"] . "' style='width:90%;'/>
                                        </br>
                                        <p>" . $rec["prod_name"] . "</p>
                                        <p>" . $rec["prod_capacity"] . "</br>" . $rec["prod_motor_capacity"] . "&nbsp;E/Motor</br>" . $rec["prod_motor_speed"] . "</br>" . $rec["prod_phase"] . "</p>
                                        <button style='width:75%; margin-top:5px;' id=" . $rec["prod_id"] . " type='button' class='btn btn-info btn-sm'><i class='fas fa-check fa-1x'></i>&nbsp;&nbsp;Select</button>
                                        </br>
                                    </div>
                                    <div class='col-md-1'></div>
                                </div>
                            </div>
                        </div>
                    </div>");
        }
    } else {
        echo ("No record found!");
    }
};

//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------

function partSearchRQ($search)
{
    $conn = Connection();

    if ($search == '') {
        $search = ' ';
    }

    $searchSql = "SELECT *, product_tbl.prod_id, product_tbl.prod_name
                    FROM parts_tbl
                    INNER JOIN product_tbl
                    ON parts_tbl.prod_id = product_tbl.prod_id 
                    WHERE part_id LIKE '%$search%' OR
                    part_code LIKE '%$search%' OR
                    part_name LIKE '%$search%' OR
                    prod_name LIKE '%$search%' OR
                    part_weight LIKE '%$search%' OR
                    part_w_unit LIKE '%$search%' OR
                    part_desc LIKE '%$search%' OR
                    part_unit_price LIKE '%$search%';";

    $searchQuery = mysqli_query($conn, $searchSql);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    //check no of records
    $nor = mysqli_num_rows($searchQuery);

    if ($nor > 0) {

        while ($rec = mysqli_fetch_assoc($searchQuery)) {

            echo ("<div style='display: inline-block; margin-top:5px; margin-bottom: 10px; margin-right: 15px; text-align:center; max-width: 300px; background-color: white; border-radius: 10px;'>
                        <div>
                            <div class='container' style='padding-top: 10px; padding-bottom: 10px;'>
                                <div class='row'>
                                    <div class='col-md-1'></div>
                                    <div class='col-md-10'>
                                        <div>
                                        <h5 style='color:coral;'><b>" . $rec["part_code"] . "</b></h5>
                                        <h6>" . $rec["prod_name"] . "</h6>
                                        </div>
                                        <img src='" . $rec["part_img_path"] . "' style='width:90%;'/>
                                        </br>
                                        <h6>" . $rec["part_name"] . "</h6>
                                        <p>" . $rec["part_weight"] . "&nbsp;" . $rec["part_w_unit"] . "</p>
                                        <button style='width:75%; margin-top:5px;' id=" . $rec["part_id"] . " type='button' class='btn btn-info btn-sm'><i class='fas fa-check fa-1x'></i>&nbsp;&nbsp;Select</button>
                                        </br>
                                    </div>
                                    <div class='col-md-1'></div>
                                </div>
                            </div>
                        </div>
                    </div>");
        }
    } else {
        echo ("No record found!");
    }
};

//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------

function saveRequest($type, $requester, $date, $user, $usersname, $tabledata)
{
    if (empty($requester)) {
        return ("Please check your inputs...");
        $date;
    } else {

        //---------------- IF RM REQUEST ------------------------------------------------------------------------------------------

        if ($type == 'RM-REQUEST') {

            $thisdate = date("Y-m-d");

            $accDate = date("Y-m-d @ h:i:sa");

            $conn = Connection();

            $req_id = Auto_id("rqst_id", "request_tbl", "RQS");

            $placeRQST = "INSERT INTO request_tbl (rqst_id, rqst_type, emp_id, user_id, rqst_date, rqst_status)
                        VALUES ('$req_id','$type','$requester','$user','$thisdate','Pending');";

            $rqst_result = mysqli_query($conn, $placeRQST);

            if (mysqli_errno($conn)) {
                echo (mysqli_error($conn));
            }

            if ($rqst_result > 0) {

                $allTableData = json_decode($tabledata);

                $description = 'Request includes raw materials of ';

                foreach ($allTableData as $row) {

                    $rmId           = $row->rmID;
                    $rmName         = $row->rmName;
                    $supID          = $row->rmSupID;
                    $rmSupplier     = $row->rmSupplier;
                    $rmQty          = $row->rmQty;
                    $rmUrgency      = $row->rmUrgency;
                    $rmNotes        = $row->rmNotes;

                    if (empty($rmNotes)) {
                        $description    .= $rmName . " from " . $rmSupplier . " with a quantity of " . $rmQty . ", with " . $rmUrgency . " urgency level. ";
                    } else {
                        $description    .= $rmName . " from " . $rmSupplier . " with a quantity of " . $rmQty . ", with " . $rmUrgency . " urgency level, Additional Notes include " . $rmNotes . ". ";
                    }

                    $reqitems_id = Auto_id("rqit_id", "rqst_items_tbl", "RQI");

                    $rqstitms = "INSERT INTO rqst_items_tbl (rqit_id,rqst_id,sup_id,rm_id,rm_qty,rm_urgency,rm_notes,rqit_status)
                                        VALUES ('$reqitems_id','$req_id','$supID','$rmId','$rmQty','$rmUrgency','$rmNotes',1);";

                    $rqstitems = mysqli_query($conn, $rqstitms);

                    if ($rqstitems > 0) {
                    } else {
                    }
                }

                $notifID = Auto_id("notif_id", "notification_tbl", "NTF");

                $supervisor = getEmpNamebyID($requester);

                $insert_notification = "INSERT INTO notification_tbl (notif_id,rqst_id,user_id,rqst_type,notif_title,notif_body,notif_date,set_date,notif_status)
                                        VALUES ('$notifID','$req_id','$user','$type','New Raw Material Request From $supervisor','$description','$accDate','$thisdate',1);";

                $notif_result = mysqli_query($conn, $insert_notification);

                if ($notif_result > 0) {
                    echo ("success");
                } else {
                    echo ("Check Your Inputs");
                }
            } else {
                echo ("Check Your Inputs");
            }
        }

        //---------------- IF PRODUCTION-REQUEST ------------------------------------------------------------------------------------------

        else if ($type == 'PRODUCTION-REQUEST') {

            $thisdate = date("Y-m-d");

            $accDate = date("Y-m-d @ h:i:sa");

            $conn = Connection();

            $req_id = Auto_id("rqst_id", "request_tbl", "RQS");

            $placeRQST = "INSERT INTO request_tbl (rqst_id, rqst_type, emp_id, user_id, rqst_date, rqst_status)
                            VALUES ('$req_id','$type','$requester','$user','$thisdate','Pending');";

            $rqst_result = mysqli_query($conn, $placeRQST);

            if (mysqli_errno($conn)) {
                echo (mysqli_error($conn));
            }

            if ($rqst_result > 0) {

                $allTableData = json_decode($tabledata);

                $description = 'Request includes production request of ';

                foreach ($allTableData as $row) {
                    $prodID         = $row->prodID;
                    $prodcode       = $row->prodcode;
                    $prodcode       = $row->prodcode;
                    $prodname       = $row->prodname;
                    $proddetails    = $row->proddetails;
                    $prodQty        = $row->prodQty;
                    $prodUrgency    = $row->prodUrgency;

                    $description    .= "(" . $prodcode . ") " . $prodname . "</br> Specifications :</br>" . $proddetails . " E/Motor</br>A quantity of " . $prodQty . ", with " . $prodUrgency . " urgency level. ";

                    $reqitems_id = Auto_id("rqpr_id", "rqst_production_tbl", "RQP");

                    $rqstitms = "INSERT INTO rqst_production_tbl (rqpr_id,rqst_id,prod_id,rqpr_qty,rqpr_urgency,rqpr_status)
                                VALUES ('$reqitems_id','$req_id','$prodID','$prodQty','$prodUrgency',1);";

                    $rqstitems = mysqli_query($conn, $rqstitms);
                }

                $notifID = Auto_id("notif_id", "notification_tbl", "NTF");

                $supervisor = getEmpNamebyID($requester);

                $insert_notification = "INSERT INTO notification_tbl (notif_id,rqst_id,user_id,rqst_type,notif_title,notif_body,notif_date,set_date, notif_status)
                                        VALUES ('$notifID','$req_id','$user','$type','New Production Request From $supervisor','$description','$accDate','$thisdate',1);";

                $notif_result = mysqli_query($conn, $insert_notification);

                if ($notif_result > 0) {
                    echo ("success");
                } else {
                    echo ("Check Your Inputs");
                }
            } else {
                echo ("Check Your Inputs");
            }
        }

        //---------------- IF PART-PRODUCTION-REQUEST ------------------------------------------------------------------------------------------

        else if ($type == 'PART-PRODUCTION-REQUEST') {

            $thisdate = date("Y-m-d");

            $accDate = date("Y-m-d @ h:i:sa");

            $conn = Connection();

            $req_id = Auto_id("rqst_id", "request_tbl", "RQS");

            $placeRQST = "INSERT INTO request_tbl (rqst_id, rqst_type, emp_id, user_id, rqst_date, rqst_status)
                            VALUES ('$req_id','$type','$requester','$user','$thisdate','Pending');";

            $rqst_result = mysqli_query($conn, $placeRQST);

            if (mysqli_errno($conn)) {
                echo (mysqli_error($conn));
            }

            if ($rqst_result > 0) {

                $allTableData = json_decode($tabledata);

                $description = 'Request includes part production request of ';

                foreach ($allTableData as $row) {
                    $partID         = $row->partID;
                    $partCode       = $row->partCode;
                    $partName       = $row->partName;
                    $partQty        = $row->partQty;
                    $partUrgency    = $row->partUrgency;

                    $getprodbypart = "SELECT prod_name, prod_motor_capacity from product_tbl INNER JOIN parts_tbl ON parts_tbl.prod_id = product_tbl.prod_id WHERE parts_tbl.part_id = '$partID';";

                    $getresult = mysqli_query($conn, $getprodbypart);

                    $nor = mysqli_num_rows($getresult);

                    $rec = mysqli_fetch_assoc($getresult);

                    $prod_name = $rec['prod_name'];
                    $prod_motor = $rec['prod_motor_capacity'];

                    $description    .= "(" . $partCode . ") " . $partName . " of " . $prod_name . " (" . $prod_motor . ") with a quantity of " . $partQty . ", with " . $partUrgency . " urgency level. ";

                    $reqitems_id = Auto_id("rqpt_id", "rqst_part_production_tbl", "RPT");

                    $rqstitms = "INSERT INTO rqst_part_production_tbl (rqpt_id,rqst_id,part_id,rqpt_qty,rqpt_urgency,rqpt_status)
                                VALUES ('$reqitems_id','$req_id','$partID','$partQty','$partUrgency',1);";

                    $rqstitems = mysqli_query($conn, $rqstitms);
                }

                $notifID = Auto_id("notif_id", "notification_tbl", "NTF");

                $supervisor = getEmpNamebyID($requester);

                $insert_notification = "INSERT INTO notification_tbl (notif_id,rqst_id,user_id,rqst_type,notif_title,notif_body,notif_date,set_date,notif_status)
                                        VALUES ('$notifID','$req_id','$user','$type','New Part Production Request From $supervisor','$description','$accDate','$thisdate',1);";

                $notif_result = mysqli_query($conn, $insert_notification);

                if ($notif_result > 0) {
                    echo ("success");
                } else {
                    echo ("Check Your Inputs");
                }
            } else {
                echo ("Check Your Inputs");
            }
        }
    }
};

//------------------------------------------------- UPDATE machineries stock by daily productions -----------------------------------------------------------

function updateMachineProduction($requester, $date, $userID, $prodList)
{
    $conn = Connection();

    $TableData = json_decode($prodList);

    $msg = NULL;

    $error = NULL;

    foreach ($TableData as $row) {

        $prodID         = $row->prodID;
        $prodQTY        = $row->prodQty;

        $getQTY = "SELECT prod_qty FROM stock_prod_tbl WHERE prod_id = '$prodID';";

        $sqlResult = mysqli_query($conn, $getQTY);

        //validate the command
        if (mysqli_errno($conn)) {
            echo (mysqli_error($conn));
        }

        $rec = mysqli_fetch_assoc($sqlResult);

        $pre_qty = $rec["prod_qty"];

        $postQTY = $prodQTY + $pre_qty;

        if ($postQTY <= 50) {

            //add to stock updations history records

            $stockhistoryID = Auto_id("pph_id", "prd_production_history_tbl", "PPH");

            $placeRQST = "INSERT INTO prd_production_history_tbl (pph_id, emp_id, user_id, prod_id, prod_pre_qty, prod_qty, prod_post_qty, pph_date, pph_status) 
                            VALUES ('$stockhistoryID','$requester','$userID','$prodID','$pre_qty','$prodQTY','$postQTY','$date',1);";

            $sqlResult = mysqli_query($conn, $placeRQST);

            //update real time stock quantity

            $placeRQST = "UPDATE stock_prod_tbl SET prod_qty = prod_qty + $prodQTY WHERE prod_id='$prodID';";

            $sqlResult2 = mysqli_query($conn, $placeRQST);

            // reduce from part stock since production of machineries require parts

            $prodpartSQL = " SELECT part_prod_tbl.part_id, (part_prod_tbl.part_qty * $prodQTY) AS totqty FROM part_prod_tbl WHERE prod_id = '$prodID';";

            $runprodpartSQL = mysqli_query($conn, $prodpartSQL);

            $nor = mysqli_num_rows($runprodpartSQL);

            if ($nor > 0) {

                while ($rec = mysqli_fetch_assoc($runprodpartSQL)) {

                    $part_id = $rec['part_id'];

                    $part_qty = $rec['totqty'];

                    $reducepartstockSQL = "UPDATE stock_part_tbl SET part_qty = part_qty - $part_qty WHERE part_id = '$part_id';";

                    $runptreduceQuery = mysqli_query($conn, $reducepartstockSQL);
                }
            } else {
            }

            $msg = "success";
        } else {

            $getProdName = "SELECT * FROM product_tbl WHERE prod_id = '$prodID';";

            $sqlResult = mysqli_query($conn, $getProdName);

            $rec = mysqli_fetch_assoc($sqlResult);

            $error .= '#(' . $rec['prod_code'] . ') ' . $rec['prod_name'] . ' [' . $rec['prod_motor_capacity'] . ']';
        }
    }

    if ($error == '') {
        return ($msg);
    } else {
        return ($error);
    }
}

//------------------------------------------------- UPDATE part stock by daily productions -----------------------------------------------------------


function updatePartProduction($requester, $date, $userID, $prodList)
{
    $conn = Connection();

    $TableData = json_decode($prodList);

    $msg = NULL;

    $error = NULL;

    foreach ($TableData as $row) {

        $partID         = $row->partID;
        $partQty        = $row->partQty;

        $getQTY = "SELECT part_qty FROM stock_part_tbl WHERE part_id = '$partID';";

        $sqlResult = mysqli_query($conn, $getQTY);

        //validate the command
        if (mysqli_errno($conn)) {
            echo (mysqli_error($conn));
        }

        $rec = mysqli_fetch_assoc($sqlResult);

        $pre_qty = $rec["part_qty"];

        $postQTY = $partQty + $pre_qty;

        if ($postQTY <= 50) {

            //add to stock updations history records

            $stockhistoryID = Auto_id("ptph_id", "prt_production_history_tbl", "PTH");

            $placeRQST = "INSERT INTO prt_production_history_tbl(ptph_id , emp_id, user_id, part_id, part_pre_qty, part_qty, post_part_qty, ptph_date, ptph_status) 
                            VALUES ('$stockhistoryID','$requester','$userID','$partID','$pre_qty','$partQty','$postQTY','$date',1);";

            $sqlResult = mysqli_query($conn, $placeRQST);

            //update real time stock quantity

            $placeRQST = "UPDATE stock_part_tbl SET part_qty = part_qty + $partQty WHERE part_id='$partID';";

            $sqlResult2 = mysqli_query($conn, $placeRQST);

            // reduce from part stock since production of machineries require parts

            $partrmSQL = "SELECT rm_part_tbl.rm_id, (rm_part_tbl.rm_qty * $partQty) AS totqty, rm_part_tbl.rm_w_unit FROM rm_part_tbl WHERE part_id = '$partID';";

            $runprodpartSQL = mysqli_query($conn, $partrmSQL);

            $nor = mysqli_num_rows($runprodpartSQL);

            if ($nor > 0) {

                while ($rec = mysqli_fetch_assoc($runprodpartSQL)) {

                    $rm_id = $rec['rm_id'];

                    $rm_qty = $rec['totqty'];

                    $rm_w_unit = $rec['rm_w_unit'];

                    if ($rm_w_unit == 'mg') {
                        $finalQty = ($rm_qty / 1000) / 1000;
                    } else if ($rm_w_unit == 'g') {
                        $finalQty = ($rm_qty / 1000);
                    } else {
                        $finalQty = $rm_qty;
                    }

                    $reducepartstockSQL = "UPDATE stock_rm_tbl SET rm_qty = rm_qty - $finalQty WHERE rm_id = '$rm_id';";

                    $runptreduceQuery = mysqli_query($conn, $reducepartstockSQL);
                }
            } else {
            }

            $msg = "success";
        } else {

            $getProdName = "SELECT * FROM parts_tbl WHERE part_id = '$partID';";

            $sqlResult = mysqli_query($conn, $getProdName);

            $rec = mysqli_fetch_assoc($sqlResult);

            $error .= '#(' . $rec['part_code'] . ') ' . $rec['part_name'];
        }
    }

    if ($error == '') {
        return ($msg);
    } else {
        return ($error);
    }
}

//------------------------------------------------ updating production by request Notice -----------------------------------------------------------

function updateProductionbyRQST($requestID, $date, $loggedUser)
{
    $conn = Connection();

    $getSQL = "SELECT * FROM request_tbl WHERE rqst_id = '$requestID';";

    $runSQL = mysqli_query($conn, $getSQL);

    $nor = mysqli_num_rows($runSQL);

    if ($nor > 0) {

        $rec = mysqli_fetch_assoc($runSQL);

        $empID = $rec['emp_id'];

        if ($rec['rqst_type'] == 'PART-PRODUCTION-REQUEST') {

            $getPartListSQL = "SELECT rqst_part_production_tbl.part_id, rqst_part_production_tbl.rqpt_qty
                                FROM request_tbl
                                INNER JOIN rqst_part_production_tbl
                                ON request_tbl.rqst_id = rqst_part_production_tbl.rqst_id
                                WHERE request_tbl.rqst_id = '$requestID';";

            $runListQuery = mysqli_query($conn, $getPartListSQL);

            $nofrows = mysqli_num_rows($runListQuery);

            if ($nofrows > 0) {
                while ($record = mysqli_fetch_assoc($runListQuery)) {

                    $partID = $record['part_id'];
                    $partQty = $record['rqpt_qty'];

                    $getprestockQty = "SELECT part_qty FROM stock_part_tbl WHERE part_id = '$partID';";

                    $runpartquery = mysqli_query($conn, $getprestockQty);

                    $recievedData = mysqli_fetch_assoc($runpartquery);

                    $preQty = $recievedData['part_qty'];

                    $postQty = $preQty + $partQty;

                    $date = date("Y-m-d");

                    $newID = Auto_id("ptph_id", "prt_production_history_tbl", "PTH");

                    $insertSQL = "INSERT INTO prt_production_history_tbl
                                    VALUES ('$newID','$requestID','$empID','$loggedUser','$partID','$preQty','$partQty','$postQty','$date','',1);";

                    $runfinalQuery = mysqli_query($conn, $insertSQL);

                    if ($runfinalQuery > 0) {
                        echo ("success");
                    } else {
                        return ("error");
                    }
                }
            }
        } else if ($rec['rqst_type'] == 'PRODUCTION-REQUEST') {

            $getProdListSQL = "SELECT rqst_production_tbl.prod_id, rqst_production_tbl.rqpr_qty
                                FROM request_tbl
                                INNER JOIN rqst_production_tbl
                                ON request_tbl.rqst_id = rqst_production_tbl.rqst_id
                                WHERE request_tbl.rqst_id = '$requestID';";

            $runListQuery = mysqli_query($conn, $getProdListSQL);

            $nofrows = mysqli_num_rows($runListQuery);

            if ($nofrows > 0) {
                while ($record = mysqli_fetch_assoc($runListQuery)) {

                    $prodID = $record['prod_id'];
                    $prodQty = $record['rqpr_qty'];

                    $getprestockQty = "SELECT prod_qty FROM stock_prod_tbl WHERE prod_id = '$prodID';";

                    $runpartquery = mysqli_query($conn, $getprestockQty);

                    $recievedData = mysqli_fetch_assoc($runpartquery);

                    $preQty = $recievedData['prod_qty'];

                    $postQty = $preQty + $prodQty;

                    $date = date("Y-m-d");

                    $newID = Auto_id("pph_id", "prd_production_history_tbl", "PPH");

                    $insertSQL = "INSERT INTO prd_production_history_tbl
                                    VALUES ('$newID','$requestID','$empID','$loggedUser','$prodID','$preQty','$prodQty','$postQty','$date','',1);";

                    $runfinalQuery = mysqli_query($conn, $insertSQL);

                    if ($runfinalQuery > 0) {
                        echo ("success");
                    } else {
                        return ("error");
                    }
                }
            }
        }
    } else {
        return ('no records found!');
    }
}

//-----------------------------------------------------------------------------------------------------------------------------------------------------------------

function requestList()
{
    $conn = Connection();

    $requestlist = "SELECT t1.rqst_id, t1.rqst_type, t1.requester, t1.rqst_pdf, t1.rqst_status, t1.notif_body, t1.notif_date, t1.notif_accepted_date, t2.creator
                    FROM (
                    SELECT request_tbl.rqst_id, request_tbl.rqst_type, CONCAT(emp_tbl.emp_fname, ' ', emp_tbl.emp_lname) AS requester, request_tbl.user_id, request_tbl.rqst_status, request_tbl.rqst_pdf, notification_tbl.notif_body, notification_tbl.notif_date, notification_tbl.notif_accepted_date
                    FROM ((request_tbl
                    INNER JOIN emp_tbl
                    ON request_tbl.emp_id = emp_tbl.emp_id)
                    INNER JOIN notification_tbl
                    ON notification_tbl.rqst_id = request_tbl.rqst_id)
                    ) as t1, (
                    SELECT user_tbl.user_id, CONCAT(emp_tbl.emp_fname,' ',emp_tbl.emp_lname) AS creator
                    FROM user_tbl
                    INNER JOIN emp_tbl
                    ON user_tbl.emp_id = emp_tbl.emp_id
                    ) as t2
                    WHERE t1.user_id = t2.user_id;";

    $runQuery = mysqli_query($conn, $requestlist);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $nor = mysqli_num_rows($runQuery);

    if ($nor > 0) {

        while ($rec = mysqli_fetch_assoc($runQuery)) {

            echo ("<td>" . $rec["rqst_id"] . "</td>");

            if ($rec['rqst_type'] == 'RM-REQUEST') {

                echo ("<td>Raw Material Request</td>");

                echo ("<td style='text-align:center;'>" . $rec['requester'] . "</td>");

                $str = $rec['notif_body'];

                $text = explode("Request includes raw materials of ", $str)[1];

                $body = explode(". ", $text);

                $bdtext = '';

                foreach ($body as $row) {

                    if ($row == " " || $row == "") {
                    } else {
                        $bdtext .= '#&nbsp;' . $row . '<br><br>';
                    }
                }

                echo ("<td>" . $bdtext . "</td>");
            } else if ($rec['rqst_type'] == 'PRODUCTION-REQUEST') {

                echo ("<td>Production Request</td>");

                echo ("<td style='text-align:center;'>" . $rec['requester'] . "</td>");

                $str = $rec['notif_body'];

                $text = explode("Request includes production request of ", $str)[1];

                $body = explode(". ", $text);

                $bdtext = '';

                foreach ($body as $row) {

                    if ($row == " " || $row == "") {
                    } else {
                        $bdtext .= '#&nbsp;' . $row . '<br><br>';
                    }
                }

                echo ("<td>" . $bdtext . "</td>");
            } else if ($rec['rqst_type'] == 'PART-PRODUCTION-REQUEST') {

                echo ("<td>Part Production Request</td>");

                echo ("<td style='text-align:center;'>" . $rec['requester'] . "</td>");

                $str = $rec['notif_body'];

                $text = explode("Request includes part production request of ", $str)[1];

                $body = explode(". ", $text);

                $bdtext = '';

                foreach ($body as $row) {

                    if ($row == " " || $row == "") {
                    } else {
                        $bdtext .= '#&nbsp;' . $row . '<br><br>';
                    }
                }

                echo ("<td>" . $bdtext . "</td>");
            }

            echo ("<td style='text-align:center;'>" . $rec['creator'] . "</td>");

            echo ("<td style='text-align:center;'>" . $rec['notif_date'] . "</td>");

            echo ("<td style='text-align:center;'>" . $rec['notif_accepted_date'] . "</td>");

            if ($rec['rqst_pdf'] !== '') {
                echo ("<td style='text-align:center;'>
                        <a href='" . $rec['rqst_pdf'] . "' target='_blank'><button class='btn btn-info btn-sm' style='width:100%;'><i class='fas fa-file-signature'></i></button></a>
                    </td>");
            } else {
                echo ("<td style='text-align:center;'>-</td>");
            }

            if ($rec['rqst_status'] == 'Pending') {
                echo ("<td style='text-align:center;'><span class='badge badge-pill badge-warning'>Pending</span></td>");
            } else if ($rec['rqst_status'] == 'Confirmed') {
                echo ("<td style='text-align:center;'><span class='badge badge-pill badge-success'>Confirmed</span></td>");
            } else {
                echo ("<td style='text-align:center;'><span class='badge badge-pill badge-danger'>Declined</span></td>");
            }

            echo ("</tr>");
        }
    } else {
        return (" No record found");
    }
}

function validateProductionbyReq($value)
{
    $conn = Connection();

    $searchSQL = "SELECT * FROM request_tbl
                    WHERE rqst_id = '$value' AND (rqst_type = 'PRODUCTION-REQUEST' OR rqst_type = 'PART-PRODUCTION-REQUEST');";

    $runvalidation = mysqli_query($conn, $searchSQL);

    $nofrowa = mysqli_num_rows($runvalidation);

    if ($nofrowa > 0) {

        $getSQL = "SELECT prd_production_history_tbl.rqst_id, prt_production_history_tbl.rqst_id
                    FROM prd_production_history_tbl, prt_production_history_tbl
                    WHERE prd_production_history_tbl.rqst_id = '$value' OR prt_production_history_tbl.rqst_id = '$value';";

        $runSQL = mysqli_query($conn, $getSQL);

        $nor = mysqli_num_rows($runSQL);

        if ($nor > 0) {
            echo ('rec_exists');
        } else {
            echo ('success');
        }
    } else {
        echo ('no_records_found');
    }
}

function getRQSTdetailsbyID($value)
{
    $conn = Connection();

    $searchSQL = "SELECT *
                    FROM request_tbl
                    WHERE rqst_id = '$value';";

    $runvalidation = mysqli_query($conn, $searchSQL);

    $nofrowa = mysqli_num_rows($runvalidation);

    if ($nofrowa > 0) {

        while ($rec = mysqli_fetch_assoc($runvalidation)) {

            $rqstType = $rec['rqst_type'];

            if ($rqstType == 'PRODUCTION-REQUEST' || $rqstType == 'PART-PRODUCTION-REQUEST') {

                $getSQL = "SELECT t1.rqst_id, t1.rqst_type, t1.requester, t1.rqst_pdf, t1.rqst_status, t1.notif_body, t1.notif_date, t1.notif_accepted_date, t2.creator
                            FROM (
                            SELECT request_tbl.rqst_id, request_tbl.rqst_type, CONCAT(emp_tbl.emp_fname, ' ', emp_tbl.emp_lname) AS requester, request_tbl.user_id, request_tbl.rqst_status, request_tbl.rqst_pdf, notification_tbl.notif_body, notification_tbl.notif_date, notification_tbl.notif_accepted_date
                            FROM ((request_tbl
                            INNER JOIN emp_tbl
                            ON request_tbl.emp_id = emp_tbl.emp_id)
                            INNER JOIN notification_tbl
                            ON notification_tbl.rqst_id = request_tbl.rqst_id)
                            ) as t1, (
                            SELECT user_tbl.user_id, CONCAT(emp_tbl.emp_fname,' ',emp_tbl.emp_lname) AS creator
                            FROM user_tbl
                            INNER JOIN emp_tbl
                            ON user_tbl.emp_id = emp_tbl.emp_id
                            ) as t2
                            WHERE t1.user_id = t2.user_id AND t1.rqst_id = '$value';";

                $runThisSQL = mysqli_query($conn, $getSQL);

                $nor = mysqli_num_rows($runThisSQL);

                $content = "";

                if ($nor > 0) {

                    $record = mysqli_fetch_assoc($runThisSQL);

                    $text = str_replace("</br>", "&#13;&#10;", $record['notif_body']);

                    $content .= "<div class='row form-group'>
                                    <div class='col-md-12' style='margin-bottom:20px;'>
                                        <h5 style='text-align: center;'>Request Note Details</h5>
                                    </div>
                                    <hr class='display-4'>
                                    <div class='col-md-6' style='margin-bottom:20px;'>
                                        <label>Request ID :</label>
                                        <input type='text' id='loggedusername' name='loggedusername' value='" . $record['rqst_id'] . "' class='form-control' disabled>
                                    </div>
                                    <div class='col-md-6' style='margin-bottom:20px;'>
                                        <label>Request Type :</label>
                                        <input type='text' id='rqstType' name='rqstType' value='" . $record['rqst_type'] . "' class='form-control' disabled>
                                    </div>
                                    <div class='col-md-6' style='margin-bottom:20px;'>
                                        <label>Requested By :</label>
                                        <input type='text' id='requestedBy' name='requestedBy' value='" . $record['requester'] . "' class='form-control' disabled>
                                    </div>
                                    <div class='col-md-6' style='margin-bottom:20px;'>
                                        <label>Created By :</label>
                                        <input type='text' id='creator' name='creator' value='" . $record['creator'] . "' class='form-control' disabled>
                                    </div>
                                    <div class='col-md-6' style='margin-bottom:20px;'>
                                        <label>Requested Date :</label>
                                        <input type='text' id='requestedDate' name='requestedDate' value='" . $record['notif_date'] . "' class='form-control' disabled>
                                    </div>
                                    <div class='col-md-12' style='margin-bottom:20px;'>
                                        <label>Requested Items info :</label>
                                        <textarea class='form-control' id='body' name='body' rows='10' disabled>" . $text . "</textarea>
                                    </div>
                                </div>
                                <div class='row form-group'>
                                    <div class='col-md-4'></div>
                                    <div class='col-md-4'>
                                        <button type='button' style='width:100%;' id='" . $record['rqst_id'] . "' class='btn btn-success btn-finalize'><i class='fas fa-check-double'></i>&nbsp;&nbsp;Update Production by Request</button>
                                    </div>
                                    <div class='col-md-4'></div>
                                </div>";
                }

                echo ($content);
            }
        }
    }
}

?>