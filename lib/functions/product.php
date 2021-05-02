<?php

include_once('db_conn.php');

include_once('id_maker.php');

function regProduct($name, $itemcode, $file_name, $file_path, $desc, $capacity, $motorcapacity, $motorspeed, $phase, $unitprice, $reorderlevel)
{
    if (empty($name) or empty($itemcode) or empty($unitprice) or empty($reorderlevel)) {
        return ("Please check your inputs ... ");
    }

    $conn = Connection();

    $id = Auto_id("prod_id", "product_tbl", "PRD");

    $product_image = '';

    if ($file_name == '' || $file_path == '') {
    } else {
        $product_image = $id . "-" . $file_name;

        move_uploaded_file($file_path, "../../images/product/$product_image");

        $product_image = '../../images/product/' . $product_image;
    }

    $sql_insert = "INSERT INTO product_tbl (prod_id, prod_name, prod_code, prod_description, prod_capacity, prod_motor_capacity, prod_motor_speed, prod_phase, prod_unit_price, prod_reorder_level, prod_img_path, prod_status)
                    VALUES ('$id','$name','$itemcode','$desc','$capacity','$motorcapacity','$motorspeed','$phase','$unitprice','$reorderlevel','$product_image', 1);";

    $sql_result = mysqli_query($conn, $sql_insert);

    //Create stock for product

    $pstockid = Auto_id("stock_prod_id", "stock_prod_tbl", "PRS");

    $sql_insert_stock = "INSERT INTO stock_prod_tbl (stock_prod_id,prod_id,prod_qty,stock_prod_status)
                            VALUES('$pstockid','$id',0,1);";

    $stocksql_result = mysqli_query($conn, $sql_insert_stock);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    if ($sql_result > 0 && $stocksql_result > 0) {
        return "Success";
    } else {
        return "Error, Try again !!";
    }
}

//view product details 
function ViewProduct()
{
    $conn = Connection();

    $view_sql = "SELECT * FROM product_tbl WHERE prod_status = 1;";

    $view_result = mysqli_query($conn, $view_sql);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    //check no of records
    $nor = mysqli_num_rows($view_result);

    if ($nor > 0) {

        while ($rec = mysqli_fetch_assoc($view_result)) {

            echo ("<td style='text-align: center;'>" . $rec['prod_code'] . "</td>");

            if ($rec['prod_img_path'] == '') {
                echo ("<td>
                        <img src='../../../img/noimage.png' alt='No Image' class='responsive' style='height:80px; width:80px; margin-left:1px; margin-bottom:1px; margin-top:1px; margin-right:1px;'>
                    </td>");
            } else {
                echo ("<td>
                        <img id='zoom' src='" . $rec['prod_img_path'] . "' alt='Product Image' class='responsive' style='height:80px; width:80px; margin-left:1px; margin-bottom:1px; margin-top:1px; margin-right:1px;'>
                    </td>");
            }

            echo ("<td>" . $rec['prod_name'] . "</td>");
            echo ("<td style='text-align: center;'>" . $rec['prod_capacity'] . "</td>");
            echo ("<td style='text-align: center;'><b>" . $rec['prod_motor_capacity'] . "</b><br>" . $rec['prod_motor_speed'] . "</td>");

            if ($rec['prod_phase'] == "Single Phase") {
                echo ("<td><span class='badge badge-pill badge-primary'>Single Phase</span></td>");
            } else if ($rec['prod_phase'] == "Three Phase") {
                echo ("<td><span class='badge badge-pill badge-danger'>Three Phase</span></td>");
            } else {
            }

            echo ("<td style='text-align: right;'>Rs. " . number_format($rec['prod_unit_price']) . ".00</td>");
            echo ("<td style='text-align: center;'>" . $rec['prod_reorder_level'] . " unit(s)</td>");
            echo ("<td style='text-align: center;'><button id=" . $rec['prod_id'] . " class='btn btn-info btn-sm btn-block'><i class='fas fa-qrcode'></i>&nbsp;QR</button></td>");
            echo ("<td style='text-align: center;'><button id=" . $rec['prod_id'] . " class='btn btn-primary btn-sm btn-block' data-toggle='modal' data-target='#editModal'>Edit</button></td>");
            echo ("<td style='text-align: center;'><button id=" . $rec['prod_id'] . " class='btn btn-danger btn-sm btn-block'><i class='fas fa-trash'></i>&nbsp;&nbsp;Delete</button></td>");

            echo ("</tr>");
        }
    } else {
        return (" No record found");
    }
}

//view product details 
function deletedProducts()
{
    $conn = Connection();

    $view_sql = "SELECT * FROM product_tbl WHERE prod_status = 0;";

    $view_result = mysqli_query($conn, $view_sql);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    //check no of records
    $nor = mysqli_num_rows($view_result);

    if ($nor > 0) {

        while ($rec = mysqli_fetch_assoc($view_result)) {

            echo ("<td style='text-align: center;'>" . $rec['prod_code'] . "</td>");

            if ($rec['prod_img_path'] == '') {
                echo ("<td>
                        <img src='../../../img/noimage.png' alt='No Image' class='responsive' style='height:80px; width:80px; margin-left:1px; margin-bottom:1px; margin-top:1px; margin-right:1px;'>
                    </td>");
            } else {
                echo ("<td>
                        <img id='zoom' src='" . $rec['prod_img_path'] . "' alt='Product Image' class='responsive' style='height:80px; width:80px; margin-left:1px; margin-bottom:1px; margin-top:1px; margin-right:1px;'>
                    </td>");
            }

            echo ("<td>" . $rec['prod_name'] . "</td>");
            echo ("<td style='text-align: center;'>" . $rec['prod_capacity'] . "</td>");
            echo ("<td style='text-align: center;'><b>" . $rec['prod_motor_capacity'] . "</b><br>" . $rec['prod_motor_speed'] . "</td>");

            if ($rec['prod_phase'] == "Single Phase") {
                echo ("<td><span class='badge badge-pill badge-primary'>Single Phase</span></td>");
            } else if ($rec['prod_phase'] == "Three Phase") {
                echo ("<td><span class='badge badge-pill badge-danger'>Three Phase</span></td>");
            } else {
            }

            echo ("<td style='text-align: right;'>Rs. " . number_format($rec['prod_unit_price']) . ".00</td>");
            echo ("<td style='text-align: center;'>" . $rec['prod_reorder_level'] . " unit(s)</td>");
            echo ("<td style='text-align: center;'><button id=" . $rec['prod_id'] . " class='btn btn-info btn-sm btn-block'><i class='fas fa-qrcode'></i>&nbsp;QR</button></td>");
            echo ("<td style='text-align: center;'><button id=" . $rec['prod_id'] . " class='btn btn-secondary btn-reactivate btn-sm btn-block'><i class='fas fa-sync'></i>&nbsp;&nbsp;Reactivate</button></td>");

            echo ("</tr>");
        }
    } else {
        return (" No record found");
    }
}

//edit product details
function editProduct($file_name, $file_path, $id, $name, $code, $desc, $capacity, $motorcapacity, $motorspeed, $phase, $unitprice, $reorderlevel)
{

    if (empty($file_name) || empty($file_path)) {

        $conn = Connection();

        $sql_update = "UPDATE product_tbl SET prod_name='$name', prod_code='$code', prod_description='$desc', prod_capacity='$capacity', prod_motor_capacity='$motorcapacity', prod_motor_speed='$motorspeed', prod_phase='$phase', prod_unit_price='$unitprice',
                    prod_reorder_level='$reorderlevel' WHERE prod_id = '$id';";

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
    } else {

        $conn = Connection();

        $product_img = $id . $file_name;

        move_uploaded_file($file_path, "../../images/product/$product_img");

        $sql_update = "UPDATE product_tbl SET prod_name='$name', prod_code='$code', prod_description='$desc', prod_capacity='$capacity', prod_motor_capacity='$motorcapacity', prod_motor_speed='$motorspeed', prod_phase='$phase', prod_unit_price='$unitprice',
                    prod_reorder_level='$reorderlevel', prod_img_path='images/product/$product_img' WHERE prod_id = '$id';";

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
}

function getsingleproduct($id)
{

    //call the connection
    $conn = Connection();

    $sql_select = "SELECT * FROM product_tbl WHERE prod_id='$id';";

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
}

//update the product status from 1 to 0
function updateProductStatus($prodId)
{
    //connection
    $conn = Connection();

    //update sql
    $sql_update = "UPDATE product_tbl SET prod_status = 0 WHERE prod_id = '$prodId';";

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

//update the product status from 1 to 0
function reactivateProduct($prodId)
{
    //connection
    $conn = Connection();

    //update sql
    $sql_update = "UPDATE product_tbl SET prod_status = 1 WHERE prod_id = '$prodId';";

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

function fetchProducts()
{
    //connection
    $conn = Connection();

    //search SQL 
    $sql_view = "SELECT * FROM product_tbl;";

    $search_result = mysqli_query($conn, $sql_view);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $nor = mysqli_num_rows($search_result);

    if ($nor > 0) {
        while ($rec = mysqli_fetch_assoc($search_result)) {
            echo ("
                <option value=" . $rec['prod_id'] . ">" . $rec['prod_name'] . " (" . $rec['prod_motor_capacity'] . ")</option>
           ");
        }
    } else {
        return "No record found";
    }
}

function getProducts()
{
    //connection
    $conn = Connection();

    //search SQL 
    $sql_view = "SELECT * FROM product_tbl;";

    $search_result = mysqli_query($conn, $sql_view);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $nor = mysqli_num_rows($search_result);

    if ($nor > 0) {

        echo ('<option value="">-- Select Product --</option>');

        while ($rec = mysqli_fetch_assoc($search_result)) {
            echo ("<option value=" . $rec['prod_id'] . ">" . $rec['prod_name'] . " (" . $rec['prod_motor_capacity'] . ")</option>");
        }
    } else {
        return "No record found";
    }
}
