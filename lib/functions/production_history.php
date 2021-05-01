<?php

include_once('db_conn.php');

include_once('id_maker.php');

function getProductionHistory()
{
    $conn = Connection();

    $getHistory = "SELECT prd_production_history_tbl.pph_timestamp, prd_production_history_tbl.user_id, emp_tbl.emp_fname, emp_tbl.emp_lname, product_tbl.prod_code, product_tbl.prod_name, product_tbl.prod_motor_capacity, prd_production_history_tbl.prod_pre_qty, prd_production_history_tbl.prod_qty, prd_production_history_tbl.prod_post_qty
                    FROM ((prd_production_history_tbl
                    INNER JOIN emp_tbl
                    ON prd_production_history_tbl.emp_id = emp_tbl.emp_id)
                    INNER JOIN product_tbl
                    ON prd_production_history_tbl.prod_id = product_tbl.prod_id);";

    $runQuery = mysqli_query($conn, $getHistory);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $nor = mysqli_num_rows($runQuery);

    if ($nor > 0) {

        while ($rec = mysqli_fetch_assoc($runQuery)) {

            //get username into employee name -------------------------------------

            $userID = $rec['user_id'];

            $getCreator = "SELECT emp_tbl.emp_fname, emp_tbl.emp_lname
                            FROM user_tbl
                            INNER JOIN emp_tbl
                            ON user_tbl.emp_id = emp_tbl.emp_id
                            WHERE user_tbl.user_id = '$userID';";

            $getQuery = mysqli_query($conn, $getCreator);

            $record = mysqli_fetch_assoc($getQuery);

            $creator = $record['emp_fname'] . "&nbsp;" . $record['emp_lname'];

            //----------- username created ----------------------------------------

            $timeStamp = $rec['pph_timestamp'];

            $timeone = explode(" ", $timeStamp);

            $originTime = $timeone[0] . ' @ ' . $timeone[1];

            echo ("<td>" . $originTime . "</td>");
            echo ("<td>" . $creator . "</td>");
            echo ("<td>" . $rec['emp_fname'] . "&nbsp;" . $rec['emp_lname'] . "</td>");
            echo ("<td>[" . $rec['prod_code'] . "] " . $rec['prod_name'] . " (" . $rec['prod_motor_capacity'] . ")</td>");
            echo ("<td>" . $rec['prod_pre_qty'] . "</td>");
            echo ("<td>" . $rec['prod_qty'] . "</td>");
            echo ("<td>" . $rec['prod_post_qty'] . "</td>");
            echo ("</tr>");
        }
    } else {
        return (" No record found");
    }
}

function getPartProductionHistory()
{
    $conn = Connection();

    $getHistory = "SELECT prt_production_history_tbl.ptph_timestamp, prt_production_history_tbl.user_id, emp_tbl.emp_fname, emp_tbl.emp_lname, parts_tbl.part_code, parts_tbl.part_name, prt_production_history_tbl.part_pre_qty, prt_production_history_tbl.part_qty, prt_production_history_tbl.post_part_qty
                    FROM ((prt_production_history_tbl
                    INNER JOIN emp_tbl
                    ON prt_production_history_tbl.emp_id = emp_tbl.emp_id)
                    INNER JOIN parts_tbl
                    ON prt_production_history_tbl.part_id = parts_tbl.part_id);";

    $runQuery = mysqli_query($conn, $getHistory);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $nor = mysqli_num_rows($runQuery);

    if ($nor > 0) {

        while ($rec = mysqli_fetch_assoc($runQuery)) {

            //get username into employee name -------------------------------------

            $userID = $rec['user_id'];

            $getCreator = "SELECT emp_tbl.emp_fname, emp_tbl.emp_lname
                            FROM user_tbl
                            INNER JOIN emp_tbl
                            ON user_tbl.emp_id = emp_tbl.emp_id
                            WHERE user_tbl.user_id = '$userID';";

            $getQuery = mysqli_query($conn, $getCreator);

            $record = mysqli_fetch_assoc($getQuery);

            $creator = $record['emp_fname'] . "&nbsp;" . $record['emp_lname'];

            //----------- username created ----------------------------------------

            $timeStamp = $rec['ptph_timestamp'];

            $timeone = explode(" ", $timeStamp);

            $originTime = $timeone[0] . ' @ ' . $timeone[1];

            echo ("<td>" . $originTime . "</td>");
            echo ("<td>" . $creator . "</td>");
            echo ("<td>" . $rec['emp_fname'] . "&nbsp;" . $rec['emp_lname'] . "</td>");
            echo ("<td>[" . $rec['part_code'] . "] " . $rec['part_name'] . "</td>");
            echo ("<td>" . $rec['part_pre_qty'] . "</td>");
            echo ("<td>" . $rec['part_qty'] . "</td>");
            echo ("<td>" . $rec['post_part_qty'] . "</td>");
            echo ("</tr>");
        }
    } else {
        return (" No record found");
    }
}
