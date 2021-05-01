<?php
//import database connection
include_once('db_conn.php');

//id auto gen
include_once('id_maker.php');

//--------------------------------------------------------------------------------------------------------------

function getSupplierforSelect()
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

        echo ('<option value="">-- Select Supplier --</option>');
        while ($rec = mysqli_fetch_assoc($search_result)) {
            echo ("<option value=" . $rec['sup_id'] . ">" . $rec['sup_company_name'] . "</option>");
        }
    } else {
        echo ("No record found");
    }
}

//------------------------------------------------------------------------------------------------------------------

function getWarehouseforSelect()
{
    //connection
    $conn = Connection();

    //search SQL 
    $sql_search = "SELECT * FROM warehouse_tbl;";

    $search_result = mysqli_query($conn, $sql_search);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $nor = mysqli_num_rows($search_result);

    if ($nor > 0) {

        echo ('<option value="">-- Select Warehouse --</option>');
        while ($rec = mysqli_fetch_assoc($search_result)) {
            echo ("<option value=" . $rec['wh_id'] . ">" . $rec['wh_address'] . "</option>");
        }
    } else {
        echo ("No record found");
    }
}


// ------------------------------Customer get details section------------------------------------


function rmSearchonSupplier($search, $supplier)
{
    $conn = Connection();

    $searchSql = "SELECT supplier_rm_tbl.rm_sup_id, supplier_rm_tbl.sup_id, supplier_tbl.sup_company_name, supplier_rm_tbl.rm_id, rawmaterial_tbl.rm_name, rawmaterial_tbl.rm_description
                    FROM ((supplier_rm_tbl
                    INNER JOIN supplier_tbl ON supplier_rm_tbl.sup_id = supplier_tbl.sup_id)
                    INNER JOIN rawmaterial_tbl ON supplier_rm_tbl.rm_id = rawmaterial_tbl.rm_id)
                    WHERE supplier_rm_tbl.sup_id = '$supplier' AND (rawmaterial_tbl.rm_name LIKE '%$search%' OR rawmaterial_tbl.rm_id LIKE '%$search%' OR rawmaterial_tbl.rm_description LIKE '%$search%')";


    $searchQuery = mysqli_query($conn, $searchSql);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $nor = mysqli_num_rows($searchQuery);

    if ($nor > 0) {

        $output = '
            <div class="wrapper" id="wrapper">
            <div style="overflow-y: scroll; flex: 1; height: 250px; width: 100%; border: 1px solid #ccc;">
        ';

        while ($rec = mysqli_fetch_assoc($searchQuery)) {
            $output .= '
            <div style="margin: 5px;">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-10">
                                <p class="card-text">ID :&nbsp;' . $rec["rm_id"] . '</br>
                                Raw Material Name :&nbsp;' . $rec["rm_name"] . '</br>
                                Description :&nbsp;' . $rec["rm_description"] . '</br>
                            </div>
                            <div class="col-md-2">
                                <button style="width:100%; margin-right:5px;" id="' . $rec["rm_id"] . '" type="button" class="btn btn-success"><i class="fas fa-check fa-1x"></i></button>
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

function getRMforGRN($rmId)
{
    $conn = Connection();

    $selectCus = "SELECT * FROM rawmaterial_tbl WHERE rm_id = '$rmId';";

    $cusResult = mysqli_query($conn, $selectCus);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $rec = mysqli_fetch_assoc($cusResult);

    return (json_encode($rec));
};


//-----------------------------------------------------------------------------------------------------


function saveGRN($supplier, $userid, $grnrefno, $paymentstt, $duedate, $whid, $filename, $filepath, $additionalnotes, $totalprice)
{

    if (empty($supplier) or empty($userid) or empty($grnrefno) or empty($paymentstt) or empty($duedate) or empty($whid) or empty($filename) or empty($filepath) or empty($totalprice)) {
        return ("Please check your inputs ... ");
    } else {

        $today = date("Y-m-d");

        $conn = Connection();

        $GRN_ID = Auto_id("grn_id", "goodsrecievednote_tbl", "GRN");

        $grn_img = $GRN_ID . "-" . $filename;

        move_uploaded_file($filepath, "../../docs/grn_recieved_invoice/$grn_img");

        $grn_insert = "INSERT INTO goodsrecievednote_tbl (grn_id ,sup_id,create_date,user_id,wh_id,grn_ref_code,grn_due_date,grn_paid_date,payment_status,grn_scan_path,grn_total_amt,grn_additionalnote,grn_status)
                        VALUES ('$GRN_ID','$supplier','$today','$userid','$whid','$grnrefno','$duedate','$duedate','$paymentstt','../../docs/grn_recieved_invoice/$grn_img','$totalprice','$additionalnotes',1);";

        $grn_result = mysqli_query($conn, $grn_insert);

        if (mysqli_errno($conn)) {
            echo (mysqli_error($conn));
        }

        if ($grn_result > 0) {
            echo ("success");
        } else {
            echo ("Check Your Inputs");
        }
    }
}

//--------------------------------------------------------------------------------------------------------

function getRecentlyAddedGRN()
{

    $conn = Connection();

    $prev_id = "SELECT * FROM goodsrecievednote_tbl ORDER BY grn_id DESC limit 1;";

    $result = mysqli_query($conn, $prev_id);

    //error checking 
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    if (mysqli_num_rows($result) > 0) {

        $rec = mysqli_fetch_assoc($result);

        $lid = $rec["grn_id"];

        return ($lid);
    } else {
        return false;
    }
};

//--------------------------------------------------------------------------------------------------------------------

function addGRNItems($grnid, $rmid, $rmname, $unitprice, $qty, $totprice)
{

    if (empty($grnid) or empty($rmid) or empty($unitprice) or empty($qty) or empty($totprice)) {
        return ("Please check your inputs ... ");
    } else {

        $conn = Connection();

        $itemsID = Auto_id("git_id", "grn_items_tbl", "GIT");

        $grn_insert = "INSERT INTO grn_items_tbl (git_id,grn_id,rm_id,git_rm_name,git_unit_price,git_qty,git_tot_price,git_status)
                        VALUES ('$itemsID','$grnid','$rmid','$rmname','$unitprice','$qty','$totprice',1);";

        $grn_result = mysqli_query($conn, $grn_insert);

        if (mysqli_errno($conn)) {
            echo (mysqli_error($conn));
        }

        if ($grn_result > 0) {
            echo ("success");
        } else {
            echo ("Check Your Inputs");
        }
    }
}

//------------------------------------------------------------------------------------------------------------------------

function getWarehouseName($id)
{

    $conn = Connection();

    $sql_select = "SELECT wh_address FROM warehouse_tbl WHERE wh_id ='$id';";

    $sql_result = mysqli_query($conn, $sql_select);

    //error checking 
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    if (mysqli_num_rows($sql_result) > 0) {

        $rec = mysqli_fetch_assoc($sql_result);

        $lid = $rec["wh_address"];

        return ($lid);
    } else {
        return false;
    }
};

//----------------------------------------------------------------------------------------------------------------------------

function getSupplierName($id)
{

    $conn = Connection();

    $sql_select = "SELECT sup_company_name FROM supplier_tbl WHERE sup_id ='$id';";

    $sql_result = mysqli_query($conn, $sql_select);

    //error checking 
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    if (mysqli_num_rows($sql_result) > 0) {

        $rec = mysqli_fetch_assoc($sql_result);

        $lid = $rec["sup_company_name"];

        return ($lid);
    } else {
        return false;
    }
};

//----------------------------------------------------------------------------------------------------------------------------

function addPathtoGRN($id, $path)
{
    $conn = Connection();

    $sql_select = "UPDATE goodsrecievednote_tbl SET grn_path = '$path' WHERE grn_id ='$id';";

    $sql_result = mysqli_query($conn, $sql_select);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    if ($sql_result > 0) {
        echo ("success");
    } else {
        echo ("Check Your Inputs");
    }
};

//----------------------------------------------------------------------------------------------------------------------------

function GRNlist()
{

    $conn = Connection();

    $view_sql = "SELECT goodsrecievednote_tbl.grn_id, goodsrecievednote_tbl.create_date, supplier_tbl.sup_company_name, goodsrecievednote_tbl.grn_scan_path, goodsrecievednote_tbl.grn_ref_code, goodsrecievednote_tbl.payment_status, goodsrecievednote_tbl.grn_due_date, goodsrecievednote_tbl.grn_paid_date, goodsrecievednote_tbl.grn_total_amt, goodsrecievednote_tbl.grn_path, goodsrecievednote_tbl.grn_status
                 FROM goodsrecievednote_tbl
                 INNER JOIN supplier_tbl
                 ON goodsrecievednote_tbl.sup_id = supplier_tbl.sup_id
                 WHERE goodsrecievednote_tbl.grn_status = 1;";

    $view_result = mysqli_query($conn, $view_sql);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $nor = mysqli_num_rows($view_result);

    if ($nor > 0) {

        while ($rec = mysqli_fetch_assoc($view_result)) {

            echo ("<td>" . $rec['grn_id'] . "</td>");
            echo ("<td>" . $rec['create_date'] . "</td>");
            echo ("<td>" . $rec['sup_company_name'] . "</td>");
            echo ("<td style='text-align:center;'><a href='" . $rec['grn_scan_path'] . "' target='_blank'><button class='btn btn-info btn-sm btn-block'><i class='fas fa-file-import'></i>&nbsp;&nbsp;Scan</button></a></td>");
            echo ("<td>" . $rec['grn_ref_code'] . "</td>");
            echo ("<td>" . $rec['payment_status'] . "</td>");
            echo ("<td>" . $rec['grn_due_date'] . "</td>");
            echo ("<td>" . $rec['grn_paid_date'] . "</td>");
            echo ("<td style='text-align:right;'>Rs. " . number_format($rec['grn_total_amt']) . ".00</td>");
            echo ("<td style='text-align:center;'><a href='" . $rec['grn_path'] . "' target='_blank'><button class='btn btn-info btn-sm btn-block'><i class='fas fa-file-export'></i>&nbsp;&nbsp;GRN</button></a></td>");

            echo ("<td style='text-align:center;'><button class='btn btn-danger btn-delgrn btn-sm' id=" . $rec['grn_id'] . "><i class='fas fa-trash'></i>&nbsp;&nbsp;Delete</button></td>");

            echo ("</tr>");
        }
    } else {
        return (" No record found");
    }
}

//---------------------------------------------------------------------------------------------------------------------------------------------------

function deleteGRN($id)
{
    $conn = Connection();

    $checkSQL = "SELECT * FROM goodsrecievednote_tbl WHERE grn_id = '$id';";

    $runSQL = mysqli_query($conn, $checkSQL);

    $nor = mysqli_num_rows($runSQL);

    if ($nor > 0) {

        $delGRNItems = "SELECT rm_id, git_qty FROM grn_items_tbl WHERE grn_id = '$id';";

        $runItems = mysqli_query($conn, $delGRNItems);

        if (mysqli_num_rows($runItems) > 0) {
            while ($rec = mysqli_fetch_assoc($runItems)) {

                $rmID = $rec['rm_id'];
                $rmQty = $rec['git_qty'];

                $deleteRM = "UPDATE stock_rm_tbl SET rm_qty = rm_qty - $rmQty WHERE rm_id = '$rmID';";
                $rundelRM = mysqli_query($conn, $deleteRM);
            }
        }

        $delItems = "UPDATE grn_items_tbl SET git_status = 0 WHERE grn_id = '$id';";

        $runItemDel = mysqli_query($conn, $delItems);

        $delSQL = "UPDATE goodsrecievednote_tbl SET grn_status = 0 WHERE grn_id = '$id';";

        $runDel = mysqli_query($conn, $delSQL);

        if ($runDel > 0 && $runItemDel > 0) {
            echo ("success");
        } else {
            echo ("error");
        }
    } else {
        echo ("No records found!!!");
    }
}

?>