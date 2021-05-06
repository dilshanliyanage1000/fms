<?php

include_once('db_conn.php');
include_once('id_maker.php');

function getSales($startDate, $endDate)
{
    $conn = Connection();

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    //------------------ display variables -----------------------

    $machinery_invoice_numbers = '';
    $machine_list = '';
    $total_machinery_inv_price = 0;

    $parts_invoice_lists = '';
    $parts_list = '';
    $total_parts_inv_price = 0;

    //---------------------------------------------- get machinery invoice details for PDF ----------------------------------------------------

    $getinvoice = "SELECT * FROM invoice_tbl WHERE invoice_tbl.inv_status = 1 AND (invoice_tbl.inv_date BETWEEN '$startDate' AND '$endDate');";

    $runSQL = mysqli_query($conn, $getinvoice);

    $nor = mysqli_num_rows($runSQL);

    if ($nor > 0) {


        while ($rec = mysqli_fetch_assoc($runSQL)) {

            $invID      = $rec['inv_id'];
            $totalprice = $rec['inv_total_price'];
            $discount   = $rec['inv_discount'];
            $finalprice = $rec['inv_final_price'];

            $total_machinery_inv_price = $total_machinery_inv_price + $finalprice;

            $machinery_invoice_numbers .= "<tr nobr='true'>
                                                <td style='width: 25%; text-align:center!important;'>" . $invID . "</td>
                                                <td style='width: 25%; text-align:right;'>Rs. " . number_format($totalprice) . ".00</td>
                                                <td style='width: 25%; text-align:center!important;'>" . $discount . ".00%</td>
                                                <td style='width: 25%; text-align:right;'>Rs. " . number_format($finalprice) . ".00</td>
                                            </tr>";

            $getProducts = "SELECT invoice_items_tbl.inv_id, product_tbl.prod_id, product_tbl.prod_code, product_tbl.prod_name, product_tbl.prod_motor_capacity, invoice_items_tbl.prod_qty
                            FROM invoice_items_tbl
                            INNER JOIN product_tbl
                            ON invoice_items_tbl.prod_id = product_tbl.prod_id
                            WHERE invoice_items_tbl.inv_id = '$invID';";

            $runQuery = mysqli_query($conn, $getProducts);

            $rows = mysqli_num_rows($runQuery);

            if ($rows > 0) {
                while ($record = mysqli_fetch_assoc($runQuery)) {

                    $prodID     = $record['prod_id'];
                    $prodCode   = $record['prod_code'];
                    $prodName   = $record['prod_name'];
                    $prodMotor  = $record['prod_motor_capacity'];
                    $prodQty    = $record['prod_qty'];

                    $checkTemp = "SELECT * FROM temp_prod_tbl WHERE prod_id = '$prodID';";

                    $runCheck = mysqli_query($conn, $checkTemp);

                    $no_of_rows = mysqli_num_rows($runCheck);

                    if ($no_of_rows > 0) {
                        $updateTemp = "UPDATE temp_prod_tbl SET prod_qty = prod_qty + $prodQty WHERE prod_id = '$prodID';";
                        $updateQuery = mysqli_query($conn, $updateTemp);
                    } else {
                        $insertTemp = "INSERT INTO temp_prod_tbl VALUES('$prodID','$prodCode','$prodName','$prodMotor','$prodQty');";
                        $insertQuery = mysqli_query($conn, $insertTemp);
                    }
                }
            }
        }

        $getALlProds = "SELECT * FROM temp_prod_tbl;";

        $runAllProd = mysqli_query($conn, $getALlProds);

        $no_rows = mysqli_num_rows($runAllProd);

        if ($no_rows > 0) {
            while ($getrec = mysqli_fetch_assoc($runAllProd)) {

                $productCode            = $getrec['prod_code'];
                $productName            = $getrec['prod_name'];
                $productMotorCapacity   = $getrec['prod_motor_capacity'];
                $productQuantity        = $getrec['prod_qty'];

                $machine_list .= "<tr nobr='true'>
                                        <td style='text-align:center; width: 33%'>" . $productCode . "</td>
                                        <td style='text-align:left; width: 33%'>" . $productName . " [" . $productMotorCapacity . "]</td>
                                        <td style='text-align:center; width: 33%;'>" . $productQuantity . "</td>
                                    </tr>";
            }
        }

        $removeData = "TRUNCATE TABLE temp_prod_tbl;";
        $removeQuery = mysqli_query($conn, $removeData);
    } else {

        $machinery_invoice_numbers = "-";
        $machine_list = "-";
    }

    //---------------------------------------------- get parts invoice details for PDF ----------------------------------------------------

    $getpartinvoice = "SELECT * FROM invoice_parts_tbl WHERE invoice_parts_tbl.p_inv_date BETWEEN '$startDate' AND '$endDate';";

    $runSQL = mysqli_query($conn, $getpartinvoice);

    $nor = mysqli_num_rows($runSQL);

    if ($nor > 0) {
        while ($rec = mysqli_fetch_assoc($runSQL)) {

            $partinvID      = $rec['p_inv_id'];
            $parttotalprice = $rec['p_inv_total_price'];
            $partdiscount   = $rec['p_inv_discount'];
            $partfinalprice = $rec['p_inv_final_price'];

            $total_parts_inv_price = $total_parts_inv_price + $partfinalprice;

            $parts_invoice_lists .= "<tr nobr='true'>
                                        <td style='text-align:center;'>" . $partinvID . "</td>
                                        <td style='text-align:right;'>Rs. " . number_format($parttotalprice) . ".00</td>
                                        <td style='text-align:right;'>" . $partdiscount . ".00%</td>
                                        <td style='text-align:right;'>Rs. " . number_format($partfinalprice) . ".00</td>
                                    </tr>";

            $getParts = "SELECT invoice_parts_items_tbl.p_inv_id, parts_tbl.part_id, parts_tbl.part_code, parts_tbl.part_name, parts_tbl.part_weight, parts_tbl.part_w_unit,
                            invoice_parts_items_tbl.part_qty
                            FROM invoice_parts_items_tbl
                            INNER JOIN parts_tbl
                            ON invoice_parts_items_tbl.part_id = parts_tbl.part_id
                            WHERE invoice_parts_items_tbl.p_inv_id = '$partinvID';";

            $runQuery = mysqli_query($conn, $getParts);

            $rows = mysqli_num_rows($runQuery);

            if ($rows > 0) {
                while ($record = mysqli_fetch_assoc($runQuery)) {

                    $partID     = $record['part_id'];
                    $partCode   = $record['part_code'];
                    $partName   = $record['part_name'];
                    $partWeight = $record['part_weight'];
                    $partWUnit  = $record['part_w_unit'];
                    $partQty    = $record['part_qty'];

                    $checkTemp = "SELECT * FROM temp_part_tbl WHERE part_id = '$partID';";

                    $runCheck = mysqli_query($conn, $checkTemp);

                    $no_of_rows = mysqli_num_rows($runCheck);

                    if ($no_of_rows > 0) {
                        $updateTemp = "UPDATE temp_part_tbl SET part_qty = part_qty + $partQty WHERE part_id = '$partID';";
                        $updateQuery = mysqli_query($conn, $updateTemp);
                    } else {
                        $insertTemp = "INSERT INTO temp_part_tbl VALUES('$partID','$partCode','$partName','$partWeight','$partWUnit','$partQty');";
                        $insertQuery = mysqli_query($conn, $insertTemp);
                    }
                }
            }
        }

        $getALlParts = "SELECT * FROM temp_part_tbl;";

        $runAllParts = mysqli_query($conn, $getALlParts);

        $no_rows = mysqli_num_rows($runAllParts);

        if ($no_rows > 0) {
            while ($getrec = mysqli_fetch_assoc($runAllParts)) {

                $partsCode      = $getrec['part_code'];
                $partsName      = $getrec['part_name'];
                $partsWeight    = $getrec['part_weight'];
                $partsWUnit     = $getrec['part_w_unit'];
                $partsQty       = $getrec['part_qty'];

                $parts_list .= "<tr nobr='true'>
                                    <td style='text-align:left;'>" . $partsCode . "</td>
                                    <td style='text-align:left;'>" . $partsName . " [" . $partsWeight . " " . $partsWUnit . "]</td>
                                    <td style='text-align:center;'>" . $partsQty . "</td>
                                </tr>";
            }
        }

        $removeData = "TRUNCATE TABLE temp_part_tbl;";
        $removeQuery = mysqli_query($conn, $removeData);
    } else {

        $parts_invoice_lists = "-";
        $parts_list = "-";
    }

    return ($machinery_invoice_numbers . '|||' . $total_machinery_inv_price . '|||' . $machine_list . '|||' . $parts_invoice_lists . '|||' . $total_parts_inv_price . '|||' . $parts_list);
}

function getMostSelling()
{
    $conn = Connection();

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $returnTopSellers = '';

    $getinvoice = "SELECT * FROM invoice_tbl WHERE invoice_tbl.inv_status = 1;";

    $runSQL = mysqli_query($conn, $getinvoice);

    $nor = mysqli_num_rows($runSQL);

    if ($nor > 0) {

        while ($rec = mysqli_fetch_assoc($runSQL)) {

            $invID      = $rec['inv_id'];

            $getProducts = "SELECT invoice_items_tbl.inv_id, product_tbl.prod_id, product_tbl.prod_code, product_tbl.prod_name, product_tbl.prod_motor_capacity, invoice_items_tbl.prod_qty
                            FROM invoice_items_tbl
                            INNER JOIN product_tbl
                            ON invoice_items_tbl.prod_id = product_tbl.prod_id
                            WHERE invoice_items_tbl.inv_id = '$invID';";

            $runQuery = mysqli_query($conn, $getProducts);

            $rows = mysqli_num_rows($runQuery);

            if ($rows > 0) {
                while ($record = mysqli_fetch_assoc($runQuery)) {

                    $prodID     = $record['prod_id'];
                    $prodCode   = $record['prod_code'];
                    $prodName   = $record['prod_name'];
                    $prodMotor  = $record['prod_motor_capacity'];
                    $prodQty    = $record['prod_qty'];

                    $checkTemp = "SELECT * FROM temp_prod_tbl WHERE prod_id = '$prodID';";

                    $runCheck = mysqli_query($conn, $checkTemp);

                    $no_of_rows = mysqli_num_rows($runCheck);

                    if ($no_of_rows > 0) {
                        $updateTemp = "UPDATE temp_prod_tbl SET prod_qty = prod_qty + $prodQty WHERE prod_id = '$prodID';";
                        $updateQuery = mysqli_query($conn, $updateTemp);
                    } else {
                        $insertTemp = "INSERT INTO temp_prod_tbl VALUES('$prodID','$prodCode','$prodName','$prodMotor','$prodQty');";
                        $insertQuery = mysqli_query($conn, $insertTemp);
                    }
                }
            }
        }

        $getALlProds = "SELECT * FROM temp_prod_tbl ORDER BY prod_qty DESC LIMIT 5;";

        $runAllProd = mysqli_query($conn, $getALlProds);

        $no_rows = mysqli_num_rows($runAllProd);

        if ($no_rows > 0) {

            $counter = 1;

            while ($getrec = mysqli_fetch_assoc($runAllProd)) {

                $productCode            = $getrec['prod_code'];
                $productName            = $getrec['prod_name'];
                $productMotorCapacity   = $getrec['prod_motor_capacity'];
                $productQuantity        = $getrec['prod_qty'];

                $returnTopSellers .= "<div id='zoom' class='row shadow h-100' style='border: 1px solid #f2f2f2; border-radius: 30px; padding: 10px; background-color: white; margin: 13px;'>
                                        <div class='col-md-12' style='margin-top: 5px;'>
                                            <div class='row'>
                                                <img src='../../../img/list_digits/" . $counter . ".png' style='height: 25px; text-align: left; margin-left: 10px; margin-right: 15px;' alt='Number_One'>|<h6 style='margin-left: 10px; margin-top: 5px;'>&nbsp;&nbsp;" . $productName . " [" . $productMotorCapacity . "]</h6>
                                            </div>
                                        </div>
                                    </div>";


                $counter++;
            }
        }

        $removeData = "TRUNCATE TABLE temp_prod_tbl;";
        $removeQuery = mysqli_query($conn, $removeData);

        echo ($returnTopSellers);
    }
}

function getMostSellingReport($startDate, $endDate)
{
    $conn = Connection();

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $returnTopSellers = '';

    $invDetails = '';

    $getinvoice = "SELECT *
                    FROM invoice_tbl
                    WHERE invoice_tbl.inv_status = 1
                    AND inv_date BETWEEN '$startDate' AND '$endDate';";

    $runSQL = mysqli_query($conn, $getinvoice);

    $nor = mysqli_num_rows($runSQL);

    if ($nor > 0) {

        while ($rec = mysqli_fetch_assoc($runSQL)) {

            $invDetails .= "<tr>
                                <td style='width:30%; text-align:center;'>" . $rec['inv_date'] . "</td>
                                <td style='width:30%; text-align:center;'>" . $rec['inv_id'] . "</td>
                                <td style='width:40%; text-align:right;'>Rs. " . number_format($rec['inv_final_price']) . ".00</td>
                            </tr>";

            $invID      = $rec['inv_id'];

            $getProducts = "SELECT invoice_items_tbl.inv_id, product_tbl.prod_id, product_tbl.prod_code, product_tbl.prod_name, product_tbl.prod_motor_capacity, invoice_items_tbl.prod_qty
                            FROM invoice_items_tbl
                            INNER JOIN product_tbl
                            ON invoice_items_tbl.prod_id = product_tbl.prod_id
                            WHERE invoice_items_tbl.inv_id = '$invID';";

            $runQuery = mysqli_query($conn, $getProducts);

            $rows = mysqli_num_rows($runQuery);

            if ($rows > 0) {
                while ($record = mysqli_fetch_assoc($runQuery)) {

                    $prodID     = $record['prod_id'];
                    $prodCode   = $record['prod_code'];
                    $prodName   = $record['prod_name'];
                    $prodMotor  = $record['prod_motor_capacity'];
                    $prodQty    = $record['prod_qty'];

                    $checkTemp = "SELECT * FROM temp_prod_tbl WHERE prod_id = '$prodID';";

                    $runCheck = mysqli_query($conn, $checkTemp);

                    $no_of_rows = mysqli_num_rows($runCheck);

                    if ($no_of_rows > 0) {
                        $updateTemp = "UPDATE temp_prod_tbl SET prod_qty = prod_qty + $prodQty WHERE prod_id = '$prodID';";
                        $updateQuery = mysqli_query($conn, $updateTemp);
                    } else {
                        $insertTemp = "INSERT INTO temp_prod_tbl VALUES('$prodID','$prodCode','$prodName','$prodMotor','$prodQty');";
                        $insertQuery = mysqli_query($conn, $insertTemp);
                    }
                }
            }
        }

        $getALlProds = "SELECT * FROM temp_prod_tbl ORDER BY prod_qty DESC;";

        $runAllProd = mysqli_query($conn, $getALlProds);

        $no_rows = mysqli_num_rows($runAllProd);

        if ($no_rows > 0) {

            $counter = 1;

            while ($getrec = mysqli_fetch_assoc($runAllProd)) {

                $productCode            = $getrec['prod_code'];
                $productName            = $getrec['prod_name'];
                $productMotorCapacity   = $getrec['prod_motor_capacity'];
                $productQuantity        = $getrec['prod_qty'];

                $returnTopSellers .= "<tr>
                                        <td style='width:70%; text-align:left;'>[" . $productCode . "] " . $productName . " (" . $productMotorCapacity . ")</td>
                                        <td style='width:30%; text-align:center;'>" . $productQuantity . "</td>
                                    </tr>";


                $counter++;
            }
        }

        $removeData = "TRUNCATE TABLE temp_prod_tbl;";
        $removeQuery = mysqli_query($conn, $removeData);

        return ($returnTopSellers . "|||" . $invDetails);
    }
}


function returnSales($invoiceID)
{
    $conn = Connection();

    $id = Auto_id("sr_id", "sales_returns_tbl", "SRN");

    $insertSQL = "INSERT INTO sales_returns_tbl (sr_id, inv_id)
                    VALUES('$id','$invoiceID')";

    $runSQL = mysqli_query($conn, $insertSQL);

    $getProductsofInvoice = "SELECT * FROM invoice_items_tbl WHERE inv_id = '$invoiceID';";

    $runQuery = mysqli_query($conn, $getProductsofInvoice);

    $nor = mysqli_num_rows($runQuery);

    if ($nor > 0) {
        while ($rec = mysqli_fetch_assoc($runQuery)) {

            $prodID = $rec['prod_id'];
            $prodQty = $rec['prod_qty'];

            $runReduction = "UPDATE stock_prod_tbl SET prod_qty = prod_qty + $prodQty WHERE prod_id = '$prodID';";

            $reductionquery = mysqli_query($conn, $runReduction);
        }
    } else {
        return false;
    }

    if ($runSQL > 0) {
        echo ("success");
    } else {
        return false;
    }
}


function viewReturns()
{
    $conn = Connection();

    $getall = "SELECT * FROM sales_returns_tbl";

    $runSales = mysqli_query($conn, $getall);

    $nor = mysqli_num_rows($runSales);

    if ($nor > 0) {

        while ($rec = mysqli_fetch_assoc($runSales)) {

            echo ('<td>' . $rec['sr_id'] . '</td>');
            echo ('<td>' . $rec['inv_id'] . '</td>');
            echo ('<td>' . $rec['date'] . '</td>');
            echo ('</tr>');
        }
    } else {
        return("no records found");
    }
}

?>