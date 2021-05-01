<?php

include_once('db_conn.php');

include_once('id_maker.php');

function registerPart($file_name, $file_path, $name, $partcode, $part_prod, $weight, $w_unit, $description, $unitprice, $reorder)
{
    if (empty($name) or empty($part_prod) or empty($unitprice) or empty($reorder)) {
        return ("Please check your inputs ... ");
    }

    $conn = Connection();

    $id = Auto_id("part_id", "parts_tbl", "PRT");

    $part_image = '';

    if ($file_name == '' || $file_path == '') {
    } else {
        $part_image = $id . "-" . $file_name;

        move_uploaded_file($file_path, "../../images/part/$part_image");

        $part_image = '../../images/part/' . $part_image;
    }

    //Create parts for products

    $sql_insert = "INSERT INTO parts_tbl (part_id, part_code, part_name, prod_id, part_weight, part_w_unit, part_desc, part_unit_price, part_reorder_level, part_img_path, part_status)
                       VALUES ('$id','$partcode','$name','$part_prod','$weight','$w_unit','$description','$unitprice','$reorder','$part_image', 1);";

    $sql_result = mysqli_query($conn, $sql_insert);

    //Create stock for parts

    $pstockid = Auto_id("stock_part_id", "stock_part_tbl", "PTS");

    $sql_insert_stock = "INSERT INTO stock_part_tbl (stock_part_id,part_id,part_qty,stock_part_status)
                            VALUES('$pstockid','$id',0,1);";

    $stocksql_result = mysqli_query($conn, $sql_insert_stock);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    if ($sql_result > 0 && $stocksql_result > 0) {
        return "Success";
    } else {
        return "Error, Try again !!";
    }
}


//view product parts details

function ViewPart()
{

    $conn = Connection();

    $view_sql = "SELECT parts_tbl.part_id, parts_tbl.part_code, parts_tbl.part_name, product_tbl.prod_name, product_tbl.prod_motor_capacity, parts_tbl.part_weight, parts_tbl.part_w_unit, parts_tbl.part_unit_price, parts_tbl.part_reorder_level, parts_tbl.part_img_path, parts_tbl.part_status
                FROM parts_tbl
                INNER JOIN product_tbl
                ON parts_tbl.prod_id = product_tbl.prod_id;";

    $view_result = mysqli_query($conn, $view_sql);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    //check no of records
    $nor = mysqli_num_rows($view_result);

    if ($nor > 0) {

        while ($rec = mysqli_fetch_assoc($view_result)) {

            echo ("<td>" . $rec['part_code'] . "</td>");

            echo ("<td style='text-align: center'>
                        <img id='zoom' src='" . $rec['part_img_path'] . "' alt='Part Image' class='responsive' style='height:80px; width:80px; margin-left:1px; margin-bottom:1px; margin-top:1px; margin-right:1px; border: 1px solid #eee;'>
                    </td>");

            echo ("<td>" . $rec['part_name'] . "</td>");

            echo ("<td>" . $rec['prod_name'] . " (" . $rec['prod_motor_capacity'] . ")</td>");

            echo ("<td style='text-align: center'>" . $rec['part_weight'] . $rec['part_w_unit'] . "</td>");

            echo ("<td style='text-align: right'><b>Rs. " . number_format($rec['part_unit_price']) . ".00</b></td>");

            echo ("<td style='text-align: center'>" . $rec['part_reorder_level'] . " unit(s)</td>");

            if ($rec['part_status'] == 1) {
                echo ("<td style='text-align:center;'><span class='badge badge-pill badge-primary'>Active</span></td>");
            } else {
                echo ("<td style='text-align:center;'><span class='badge badge-pill badge-danger'>Removed</span></td>");
            }

            echo ("<td style='text-align:center;'><button id=" . $rec['part_id'] . " class='btn btn-primary btn-sm' data-toggle='modal' data-target='#editModal'>Edit</button></td>");
            echo ("<td style='text-align:center;'><button id=" . $rec['part_id'] . " class='btn btn-danger btn-sm'>Delete</button></td>");
            echo ("</tr>");
        }
    } else {
        return (" No record found");
    }
}

//edit product part details

function editPart($file_name, $file_path, $id, $name, $partcode, $weight, $w_unit, $description, $prodid, $unitprice, $reorder)
{

    if (empty($file_name) || empty($file_path)) {

        $conn = Connection();

        $sql_update = "UPDATE parts_tbl SET part_name = '$name', prod_id = '$prodid', part_code = '$partcode', part_weight = '$weight', part_w_unit = '$w_unit', part_desc = '$description', 
                    part_unit_price = '$unitprice', part_reorder_level = '$reorder' WHERE part_id = '$id';";

        $update_result = mysqli_query($conn, $sql_update);

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

        $part_image = $id . "-" . $file_name;

        move_uploaded_file($file_path, "../../images/part/$part_image");

        $sql_update = "UPDATE parts_tbl SET part_name = '$name', prod_id = '$prodid', part_code = '$partcode', part_weight = '$weight', part_w_unit = '$w_unit', part_desc = '$description', 
                    part_unit_price = '$unitprice', part_reorder_level = '$reorder', part_img_path='../../images/part/$part_image' WHERE part_id = '$id';";

        $update_result = mysqli_query($conn, $sql_update);

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

//update the part status from 1 to 0
function updatePartStatus($partID)
{

    //connection
    $conn = Connection();

    //update sql
    $sql_update = "UPDATE parts_tbl SET part_status = 0 WHERE part_id = '$partID';";

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

function getsinglePart($id)
{

    $conn = Connection();

    $sql_select = "SELECT * FROM parts_tbl WHERE part_id='$id';";
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

function searchPart($searchData)
{
    //connection
    $conn = Connection();

    //search SQL 
    $sql_search = "SELECT * 
                    FROM parts_tbl 
                    WHERE part_id  LIKE '%$searchData%' OR 
                    part_code LIKE '%$searchData%' OR 
                    part_name LIKE '%$searchData%' OR
                    prod_id LIKE '%$searchData%' OR
                    part_weight LIKE '%$searchData%' OR
                    part_desc LIKE '%$searchData%' OR
                    part_unit_price LIKE '%$searchData%' OR
                    part_reorder_level LIKE '%$searchData%';";

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
                                <h5 class='card-text' style='color:coral;'>(" . $rec["part_code"] . ")</h5>
                                <h5 class='card-text' style='color:coral;'>" . $rec["part_name"] . "</h5>
                                <hr class='my-4'>
                                <h6 class='card-text'>Weight&nbsp;:&nbsp;" . $rec["part_weight"] . $rec["part_w_unit"] . "</h6>
                                <h6 class='card-text'>Unit Price&nbsp;:&nbsp;Rs.&nbsp;" . $rec["part_unit_price"] . ".00</h6>
                                <h6 class='card-text'>Reorder Level&nbsp;:&nbsp;" . $rec["part_reorder_level"] . "&nbsp;unit(s)</h6>
                                <br>
                                <button style='width:75%; margin-top:5px;' id=" . $rec["part_id"] . " type='button' class='btn btn-info btn-sm'><i class='fas fa-check fa-1x'></i>&nbsp;Select Part</button>
                            </div>
                        </div>
                    </div>");
        }
    } else {
        echo ("No records found!");
    }
};
?>