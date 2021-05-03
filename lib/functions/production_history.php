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

function getrecentProductionUpdates()
{
    $conn = Connection();

    $returnTopSellers = '';

    $getHistory = "SELECT prd_production_history_tbl.pph_timestamp, prd_production_history_tbl.user_id, emp_tbl.emp_fname, emp_tbl.emp_lname, product_tbl.prod_code, product_tbl.prod_name, product_tbl.prod_motor_capacity, prd_production_history_tbl.prod_pre_qty, prd_production_history_tbl.prod_qty, prd_production_history_tbl.prod_post_qty
                    FROM ((prd_production_history_tbl
                    INNER JOIN emp_tbl
                    ON prd_production_history_tbl.emp_id = emp_tbl.emp_id)
                    INNER JOIN product_tbl
                    ON prd_production_history_tbl.prod_id = product_tbl.prod_id)
                    ORDER BY prd_production_history_tbl.pph_id DESC
                    LIMIT 5;";

    $runQuery = mysqli_query($conn, $getHistory);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $nor = mysqli_num_rows($runQuery);

    if ($nor > 0) {

        $counter = 1;

        while ($rec = mysqli_fetch_assoc($runQuery)) {

            $returnTopSellers .= "<div id='zoom' class='row shadow h-100' style='border: 1px solid #f2f2f2; border-radius: 30px; padding: 10px; background-color: white; margin: 13px;'>
                                        <div class='col-md-12' style='margin-top: 5px;'>
                                            <div class='row'>
                                                <img src='../../../img/list_digits/" . $counter . ".png' style='height: 25px; text-align: left; margin-left: 10px; margin-right: 10px;' alt='Number_One'><h6 style='margin-left: 10px; margin-top: 5px;'>&nbsp;&nbsp;[" . $rec['prod_code'] . "] " . $rec['prod_name'] . " (" . $rec['prod_motor_capacity'] . ") - " . $rec['prod_qty'] . " unit(s)</h6>
                                            </div>
                                        </div>
                                    </div>";

            $counter++;
        }

        echo ($returnTopSellers);
    } else {
        return (" No record found");
    }
}
