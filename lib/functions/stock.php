<?php
//import database connection
include_once('db_conn.php');

function getRMStock()
{

    $conn = Connection();

    $sqlQuery = "SELECT rawmaterial_tbl.rm_id, rawmaterial_tbl.rm_name, rawmaterial_tbl.rm_reorder_level, stock_rm_tbl.rm_qty, rawmaterial_tbl.rm_status
                    FROM rawmaterial_tbl
                    INNER JOIN stock_rm_tbl
                    ON rawmaterial_tbl.rm_id = stock_rm_tbl.rm_id;";

    $view_result = mysqli_query($conn, $sqlQuery);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    //check no of records
    $nor = mysqli_num_rows($view_result);

    if ($nor > 0) {

        while ($rec = mysqli_fetch_assoc($view_result)) {

            echo ("<td>" . $rec['rm_id'] . "</td>");
            echo ("<td>" . $rec['rm_name'] . "</td>");
            echo ("<td>" . $rec['rm_reorder_level'] . " load(s)</td>");
            echo ("<td>" . $rec['rm_qty'] . " load(s)</td>");

            if ($rec['rm_qty'] > $rec['rm_reorder_level']) {
                echo ("<td><span class='badge badge-pill badge-primary'>Sufficient stock amount available</span></td>");
            } else {
                echo ("<td><span class='badge badge-pill badge-danger'>Restock now!</span></td>");
            }

            if ($rec['rm_status'] == 1) {
                echo ("<td><span class='badge badge-pill badge-primary'>Active</span></td>");
            } else {
                echo ("<td><span class='badge badge-pill badge-danger'>Inactive</span></td>");
            }

            echo ("</tr>");
        }
    } else {
        return (" No record found");
    }
}

function insertRMStock($rmid, $qty)
{

    if (empty($rmid) or empty($qty)) {
        return ("Please check your inputs ... ");
    } else {

        $conn = Connection();

        $rmcheck = "SELECT * FROM stock_rm_tbl WHERE rm_id='$rmid';";

        $checkres = mysqli_query($conn, $rmcheck);

        $nor = mysqli_num_rows($checkres);

        if (mysqli_errno($conn)) {
            echo (mysqli_error($conn));
        }

        if ($nor > 0) {

            $updatestock = "UPDATE stock_rm_tbl SET rm_qty = rm_qty + '$qty' WHERE rm_id = '$rmid';";

            $checkstock = mysqli_query($conn, $updatestock);

            if ($checkstock > 0) {
                return ("success");
            } else {
                return false;
            }
        } else {

            $rmstockID = Auto_id("stock_rm_id", "stock_rm_tbl", "SRM");

            $createstock = "INSERT INTO stock_rm_tbl (stock_rm_id,rm_id,rm_qty,stock_rm_status)
                            VALUES ('$rmstockID','$rmid','$qty',1);";

            $stockresult = mysqli_query($conn, $createstock);

            if ($stockresult > 0) {
                return ("success");
            } else {
                return false;
            }
        }
    }
}

function RMStockLevels($rmid)
{
    if (empty($rmid)) {
        return ("Please check your inputs ... ");
    } else {

        $conn = Connection();

        $rmcheck = "SELECT rm_qty FROM stock_rm_tbl WHERE rm_id='$rmid';";

        $checkres = mysqli_query($conn, $rmcheck);

        $nor = mysqli_num_rows($checkres);

        if (mysqli_errno($conn)) {
            echo (mysqli_error($conn));
        }

        if ($nor > 0) {

            $rec = mysqli_fetch_assoc($checkres);

            $lid = $rec["rm_qty"];

            return ($lid);
        } else {

            return ("Has no exisiting stock!");
        }
    }
}

//--------------------------------------------------------------------------------------------------------------------------

function RMStockList()
{

    $conn = Connection();

    $view_sql = "SELECT rawmaterial_tbl.rm_id, rawmaterial_tbl.rm_name, stock_rm_tbl.rm_qty, rawmaterial_tbl.rm_reorder_level
                FROM rawmaterial_tbl
                INNER JOIN stock_rm_tbl
                ON rawmaterial_tbl.rm_id = stock_rm_tbl.rm_id;";

    $view_result = mysqli_query($conn, $view_sql);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $nor = mysqli_num_rows($view_result);

    if ($nor > 0) {

        while ($rec = mysqli_fetch_assoc($view_result)) {

            $stockpercentage = ($rec['rm_qty'] / 10000) * 100;

            echo ("<td>" . $rec['rm_id'] . "</td>");

            echo ("<td>" . $rec['rm_name'] . "</td>");


            if ($rec["rm_qty"] >= 150) {

                echo ("<td>
                        <div class='progress' style='width:100%;'>
                            <div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar' aria-valuenow='" . $stockpercentage . "' aria-valuemin='0' aria-valuemax='100' style='width: " . $stockpercentage . "%;'></div>
                        </div>
                    </td>");

                echo ("<td style='color:green; text-align:center;'>" . $stockpercentage . "%</td>");

                echo ("<td style='color:green; text-align:center;'>~&nbsp;" . $rec["rm_qty"] . "&nbsp;Kg(s) available</td>");

                echo ("<td style='text-align:center;'><span class='badge badge-pill badge-primary'>Sufficient Stocks Available!</span></td>");
            } else if ($rec["rm_qty"] < 150 && $rec["rm_reorder_level"] < $rec["rm_qty"]) {

                echo ("<td>
                        <div class='progress' style='width:100%;'>
                            <div class='progress-bar progress-bar-striped progress-bar-animated bg-warning' role='progressbar' aria-valuenow='" . $stockpercentage . "' aria-valuemin='0' aria-valuemax='100' style='width: " . $stockpercentage . "%;'></div>
                        </div>
                    </td>");

                echo ("<td style='color:orange; text-align:center;'>" . $stockpercentage . "%</td>");

                echo ("<td style='color:orange; text-align:center;'>~&nbsp;" . $rec["rm_qty"] . "&nbsp;Kg(s) available</td>");

                echo ("<td style='text-align:center;'>
                        <span class='badge badge-pill badge-warning'>
                            <a href='../request_notes/rm_request.php' style='text-decoration:none; color: white;'>Stocks Lowering!</a>
                        </span>
                    </td>");
            } else {

                echo ("<td>
                        <div class='progress' style='width:100%;'>
                            <div class='progress-bar progress-bar-striped progress-bar-animated bg-danger' role='progressbar' aria-valuenow='" . $stockpercentage . "' aria-valuemin='0' aria-valuemax='100' style='width: " . $stockpercentage . "%;'></div>
                        </div>
                    </td>");

                echo ("<td style='color:red; text-align:center;'>" . $stockpercentage . "%</td>");

                echo ("<td style='color:red; text-align:center;'>~&nbsp;" . $rec["rm_qty"] . "&nbsp;Kg(s) available</td>");

                echo ("<td style='text-align:center;'>
                        <span class='badge badge-pill badge-danger'>
                            <a href='../request_notes/rm_request.php' style='text-decoration:none; color: white;'>Restock Now!</a>
                        </span>
                    </td>");
            }

            echo ('</tr>');
        }
    } else {
        return (" No record found");
    }
}

//------------------------------------------- parts stock list -------------------------------------------------------------------------------

function PartsStockList()
{

    $conn = Connection();

    $view_sql = "SELECT stock_part_tbl.stock_part_id, stock_part_tbl.part_id, parts_tbl.part_code, parts_tbl.part_name, parts_tbl.part_reorder_level, stock_part_tbl.part_qty
                    FROM stock_part_tbl
                    INNER JOIN parts_tbl
                    ON stock_part_tbl.part_id = parts_tbl.part_id;";

    $view_result = mysqli_query($conn, $view_sql);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $nor = mysqli_num_rows($view_result);

    if ($nor > 0) {

        while ($rec = mysqli_fetch_assoc($view_result)) {

            $stockpercentage = ($rec['part_qty'] / 50) * 100;

            echo ("<td>" . $rec['part_code'] . "</td>");

            echo ("<td>" . $rec['part_name'] . "</td>");


            if ($rec["part_qty"] >= 35) {

                echo ("<td>
                            <div class='progress' style='width:100%;'>
                                <div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar' aria-valuenow='" . $stockpercentage . "' aria-valuemin='0' aria-valuemax='100' style='width: " . $stockpercentage . "%;'></div>
                            </div>
                        </td>");

                echo ("<td style='color:green; text-align:center;'>" . $stockpercentage . "%</td>");

                echo ("<td style='color:green; text-align:center;'>~&nbsp;" . $rec["part_qty"] . "&nbsp;unit(s) available</td>");

                echo ("<td style='text-align:center;'><span class='badge badge-pill badge-primary'>Sufficient Stocks Available!</span></td>");
            } else if ($rec["part_qty"] < 20 && $rec["part_reorder_level"] < $rec["part_qty"]) {

                echo ("<td>
                        <div class='progress' style='width:100%;'>
                            <div class='progress-bar progress-bar-striped progress-bar-animated bg-warning' role='progressbar' aria-valuenow='" . $stockpercentage . "' aria-valuemin='0' aria-valuemax='100' style='width: " . $stockpercentage . "%;'></div>
                        </div>
                    </td>");

                echo ("<td style='color:orange; text-align:center;'>" . $stockpercentage . "%</td>");

                echo ("<td style='color:orange; text-align:center;'>~&nbsp;" . $rec["part_qty"] . "&nbsp;unit(s) available</td>");

                echo ("<td style='text-align:center;'>
                        <span class='badge badge-pill badge-warning'>
                            <a href='../request_notes/part_production_request.php' style='text-decoration:none; color: white;'>Stocks Lowering!</a>
                        </span>
                    </td>");
            } else {

                echo ("<td>
                        <div class='progress' style='width:100%;'>
                            <div class='progress-bar progress-bar-striped progress-bar-animated bg-danger' role='progressbar' aria-valuenow='" . $stockpercentage . "' aria-valuemin='0' aria-valuemax='100' style='width: " . $stockpercentage . "%;'></div>
                        </div>
                    </td>");

                echo ("<td style='color:red; text-align:center;'>" . $stockpercentage . "%</td>");

                echo ("<td style='color:red; text-align:center;'>~&nbsp;" . $rec["part_qty"] . "&nbsp;unit(s) available</td>");

                echo ("<td style='text-align:center;'>
                        <span class='badge badge-pill badge-danger'>
                            <a href='../request_notes/part_production_request.php' style='text-decoration:none; color: white;'>Restock Now!</a>
                        </span>
                    </td>");
            }

            echo ('</tr>');
        }
    } else {
        return (" No record found");
    }
}

//----------------------------------------- machine stock list ---------------------------------------------------------------------------------

function MachineStockList()
{

    $conn = Connection();

    $view_sql = "SELECT stock_prod_tbl.stock_prod_id, stock_prod_tbl.prod_id, product_tbl.prod_code, product_tbl.prod_name, product_tbl.prod_motor_capacity, product_tbl.prod_reorder_level, stock_prod_tbl.prod_qty
                    FROM stock_prod_tbl
                    INNER JOIN product_tbl
                    ON stock_prod_tbl.prod_id = product_tbl.prod_id;";

    $view_result = mysqli_query($conn, $view_sql);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $nor = mysqli_num_rows($view_result);

    if ($nor > 0) {

        while ($rec = mysqli_fetch_assoc($view_result)) {

            $stockpercentage = ($rec['prod_qty'] / 50) * 100;

            echo ("<td>" . $rec['prod_code'] . "</td>");

            echo ("<td>" . $rec['prod_name'] . " [" . $rec["prod_motor_capacity"] . "]</td>");


            if ($rec["prod_qty"] >= 20) {

                echo ("<td>
                        <div class='progress' style='width:100%;'>
                            <div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar' aria-valuenow='" . $stockpercentage . "' aria-valuemin='0' aria-valuemax='100' style='width: " . $stockpercentage . "%;'></div>
                        </div>
                    </td>");

                echo ("<td style='color:green; text-align:center;'>" . $stockpercentage . "%</td>");

                echo ("<td style='color:green; text-align:center;'>~&nbsp;" . $rec["prod_qty"] . "&nbsp;unit(s) available</td>");

                echo ("<td style='text-align:center;'><span class='badge badge-pill badge-primary'>Sufficient Stocks Available!</span></td>");
            } else if ($rec["prod_qty"] < 20 && $rec["prod_reorder_level"] < $rec["prod_qty"]) {

                echo ("<td>
                        <div class='progress' style='width:100%;'>
                            <div class='progress-bar progress-bar-striped progress-bar-animated bg-warning' role='progressbar' aria-valuenow='" . $stockpercentage . "' aria-valuemin='0' aria-valuemax='100' style='width: " . $stockpercentage . "%;'></div>
                        </div>
                    </td>");

                echo ("<td style='color:orange; text-align:center;'>" . $stockpercentage . "%</td>");

                echo ("<td style='color:orange; text-align:center;'>~&nbsp;" . $rec["prod_qty"] . "&nbsp;unit(s) available</td>");

                echo ("<td style='text-align:center;'>
                        <span class='badge badge-pill badge-warning'>
                            <a href='../request_notes/production_req_form.php' style='text-decoration:none; color: white;'>Stocks Lowering!</a>
                        </span>
                    </td>");
            } else {

                echo ("<td>
                        <div class='progress' style='width:100%;'>
                            <div class='progress-bar progress-bar-striped progress-bar-animated bg-danger' role='progressbar' aria-valuenow='" . $stockpercentage . "' aria-valuemin='0' aria-valuemax='100' style='width: " . $stockpercentage . "%;'></div>
                        </div>
                    </td>");

                echo ("<td style='color:red; text-align:center;'>" . $stockpercentage . "%</td>");

                echo ("<td style='color:red; text-align:center;'>~&nbsp;" . $rec["prod_qty"] . "&nbsp;unit(s) available</td>");

                echo ("<td style='text-align:center;'>
                        <span class='badge badge-pill badge-danger'>
                            <a href='../request_notes/production_req_form.php' style='text-decoration:none; color: white;'>Restock Now!</a>
                        </span>
                    </td>");
            }

            echo ('</tr>');
        }
    } else {
        return (" No record found");
    }
}

//------------------------------------- for dashboard -------------------------------------------------------------------------------------------

function RMLoweringStocks()
{
    $conn = Connection();

    $view_sql = "SELECT rawmaterial_tbl.rm_id, rawmaterial_tbl.rm_name, stock_rm_tbl.rm_qty, rawmaterial_tbl.rm_reorder_level
                FROM rawmaterial_tbl
                INNER JOIN stock_rm_tbl
                ON rawmaterial_tbl.rm_id = stock_rm_tbl.rm_id
                ORDER BY rm_qty ASC
                LIMIT 3;";

    $view_result = mysqli_query($conn, $view_sql);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $nor = mysqli_num_rows($view_result);

    if ($nor > 0) {

        $c = 1;

        while ($rec = mysqli_fetch_assoc($view_result)) {

            $stockpercentage = ($rec['rm_qty'] / 10000) * 100;

            $warnlevel = $rec["rm_reorder_level"] + 200;


            if ($rec["rm_qty"] > $warnlevel) {

                echo ("<div id='zoom' class='row shadow h-100' style='border: 1px solid #f2f2f2; border-radius: 30px; padding: 10px; background-color: white; margin: 10px;'>
                            <div class='col-md-12' style='margin-top: 4px; margin-bottom: 4px;'>
                                <div class='row'>
                                    <div class='col-md-3' style='text-align:left;'>
                                        <h6 style='margin-top: 4px;'>• " . $rec['rm_name'] . "</h6>
                                    </div>
                                    <div class='col-md-6'>
                                        <div class='progress' style='width:100%; margin-top: 5px;'>
                                            <div class='progress progress-bar progress-bar-striped progress-bar-animated bg-primary' role='progressbar' aria-valuenow='" . $stockpercentage . "' aria-valuemin='0' aria-valuemax='100' style='width: " . $stockpercentage . "%;'></div>
                                        </div>
                                    </div>
                                    <div class='col-md-3' style='text-align:left;'>
                                        <h6 style='margin-top: 4px;'>~" . round($stockpercentage, 2) . "% left</h6>
                                    </div>
                                </div>
                            </div>
                        </div>");

                $c++;
            } else if ($rec["rm_qty"] < $warnlevel && $rec["rm_qty"] > $rec["rm_reorder_level"]) {

                echo ("<div id='zoom' class='row shadow h-100' style='border: 1px solid #f2f2f2; border-radius: 30px; padding: 10px; background-color: white; margin: 10px;'>
                            <div class='col-md-12' style='margin-top: 4px; margin-bottom: 4px;'>
                                <div class='row'>
                                    <div class='col-md-3' style='text-align:left;'>
                                        <h6 style='margin-top: 4px;'>• " . $rec['rm_name'] . "</h6>
                                    </div>
                                    <div class='col-md-6'>
                                        <div class='progress' style='width:100%; margin-top: 5px;'>
                                            <div class='progress progress-bar progress-bar-striped progress-bar-animated bg-warning' role='progressbar' aria-valuenow='" . $stockpercentage . "' aria-valuemin='0' aria-valuemax='100' style='width: " . $stockpercentage . "%;'></div>
                                        </div>
                                    </div>
                                    <div class='col-md-3' style='text-align:left;'>
                                        <h6 style='margin-top: 4px;'>~" . round($stockpercentage, 2) . "% left</h6>
                                    </div>
                                </div>
                            </div>
                        </div>");

                $c++;
            } else if ($rec["rm_qty"] < $rec["rm_reorder_level"]) {

                echo ("<div id='zoom' class='row shadow h-100' style='border: 1px solid #f2f2f2; border-radius: 30px; padding: 10px; background-color: white; margin: 10px;'>
                            <div class='col-md-12' style='margin-top: 4px; margin-bottom: 4px;'>
                                <div class='row'>
                                    <div class='col-md-3' style='text-align:left;'>
                                        <h6 style='margin-top: 4px;'>• " . $rec['rm_name'] . "</h6>
                                    </div>
                                    <div class='col-md-6'>
                                        <div class='progress' style='width:100%; margin-top: 5px;'>
                                            <div class='progress progress-bar progress-bar-striped progress-bar-animated bg-danger' role='progressbar' aria-valuenow='" . $stockpercentage . "' aria-valuemin='0' aria-valuemax='100' style='width: " . $stockpercentage . "%;'></div>
                                        </div>
                                    </div>
                                    <div class='col-md-3' style='text-align:left;'>
                                        <h6 style='margin-top: 4px;'>~" . round($stockpercentage, 2) . "% left</h6>
                                    </div>
                                </div>
                            </div>
                        </div>");

                $c++;
            }
        }
    } else {
        return (" No record found");
    }
}


function getTopCustomer()
{

}
?>