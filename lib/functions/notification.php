<?php

date_default_timezone_set('Asia/Colombo');

include_once('db_conn.php');

include_once('id_maker.php');

include_once('system_users.php');

function GetNotifications()
{
    $conn = Connection();

    $getNotification = "SELECT * FROM notification_tbl WHERE notif_rqst_stt = 'Pending' ORDER BY notif_id DESC;";

    $search_result = mysqli_query($conn, $getNotification);

    $nor = mysqli_num_rows($search_result);

    if ($nor > 0) {

        while ($rec = mysqli_fetch_assoc($search_result)) {

            $checkType = $rec['rqst_type'];

            if ($checkType == 'RM-REQUEST') {

                $str = $rec['notif_body'];

                $text = explode("Request includes raw materials of ", $str)[1];

                $body = explode(". ", $text);

                $getID = $rec['user_id'];

                $loggedUser =  getUserNamebyID($getID);

                echo ('<div class="card" id="card_' . $rec['rqst_id'] . '">
                        <div class="card-body">
                            <h5 class="card-subtitle mb-2" style="color: #4881db;">' . $rec['notif_title'] . '</h5>
                            <p class="card-text">' . $rec['notif_date'] . ' | Created By : ' . $loggedUser . '</p>
                            <hr>
                            <h6>Request includes raw materials of :</br></br>');

                $bdtext = '';

                foreach ($body as $row) {

                    if ($row == " " || $row == "") {
                    } else {
                        $bdtext .= '#&nbsp;' . $row . '<br><br>';
                    }
                }

                echo ($bdtext);

                echo ('</h6>
                        <hr>
                        <div align="center">
                            <a href="#" class="card-link"><button id="' . $rec['rqst_id'] . '" type="button" class="btn btn-rm-req-accept btn-success btn-sm"><i class="fas fa-check"></i>&nbsp;&nbsp;Confirm Request</button></a>
                            <a href="#" class="card-link"><button id="' . $rec['rqst_id'] . '" type="button" class="btn btn-rm-req-reject btn-danger btn-sm"><i class="fas fa-times"></i>&nbsp;&nbsp;Decline Request</button></a>
                        </div>                            
                    </div>
                </div>');
            } else if ($checkType == 'PRODUCTION-REQUEST') {

                $str = $rec['notif_body'];

                $text = explode("Request includes production request of ", $str)[1];

                $body = explode(". ", $text);

                $getID = $rec['user_id'];

                $loggedUser =  getUserNamebyID($getID);

                echo ('<div class="card" id="card_' . $rec['rqst_id'] . '">
                        <div class="card-body">
                            <h5 class="card-subtitle mb-2" style="color: #4881db;">' . $rec['notif_title'] . '</h5>
                            <p class="card-text">' . $rec['notif_date'] . ' | Created By : ' . $loggedUser . '</p>
                            <hr>
                            <h6>Request includes productions of :</br></br>');

                $bdtext = '';

                foreach ($body as $row) {

                    if ($row == " " || $row == "") {
                    } else {
                        $bdtext .= '#&nbsp;' . $row . '<br><br>';
                    }
                }

                echo ($bdtext);

                echo ('</h6>
                        <hr>
                        <div align="center">
                            <a href="#" class="card-link"><button id="' . $rec['rqst_id'] . '" type="button" class="btn btn-prod-req-accept btn-success btn-sm"><i class="fas fa-eye"></i>&nbsp;&nbsp;View Request</button></a>
                            <a href="#" class="card-link"><button id="' . $rec['rqst_id'] . '" type="button" class="btn btn-prod-req-reject btn-danger btn-sm"><i class="fas fa-times"></i>&nbsp;&nbsp;Decline Request</button></a>
                        </div>                            
                    </div>
                </div>');
            }
            if ($checkType == 'PART-PRODUCTION-REQUEST') {

                $str = $rec['notif_body'];

                $text = explode("Request includes part production request of ", $str)[1];

                $body = explode(". ", $text);

                $getID = $rec['user_id'];

                $loggedUser =  getUserNamebyID($getID);

                echo ('<div class="card" id="card_' . $rec['rqst_id'] . '">
                        <div class="card-body">
                            <h5 class="card-subtitle mb-2" style="color: #4881db;">' . $rec['notif_title'] . '</h5>
                            <p class="card-text">' . $rec['notif_date'] . ' | Created By : ' . $loggedUser . '</p>
                            <hr>
                            <h6>Request includes productions of :</br></br>');

                $bdtext = '';

                foreach ($body as $row) {

                    if ($row == " " || $row == "") {
                    } else {
                        $bdtext .= '#&nbsp;' . $row . '<br><br>';
                    }
                }

                echo ($bdtext);


                echo ('</h6>
                        <hr>
                        <div align="center">
                            <a href="#" class="card-link"><button id="' . $rec['rqst_id'] . '" type="button" class="btn btn-part-prod-req-accept btn-success btn-sm"><i class="fas fa-eye"></i>&nbsp;&nbsp;View Request</button></a>
                            <a href="#" class="card-link"><button id="' . $rec['rqst_id'] . '" type="button" class="btn btn-part-prod-req-reject btn-danger btn-sm"><i class="fas fa-times"></i>&nbsp;&nbsp;Decline Request</button></a>
                        </div>                            
                    </div>
                </div>');
            }

            echo ('<hr class="my-4">');
        }
    } else {
        return false;
    }
}

function ConfirmRMReq($id, $text)
{
    $conn = Connection();

    $accDate = date("Y-m-d @ h:i:sa");

    $thisDate = date("Y-m-d");

    $confirmSQL = "UPDATE notification_tbl SET notif_rqst_stt = '$text', notif_accepted_date= '$accDate', acc_date='$thisDate' WHERE rqst_id='$id';";

    $search_result = mysqli_query($conn, $confirmSQL);

    $confirmSQLTwo = "UPDATE request_tbl SET rqst_status = '$text' WHERE rqst_id='$id';";

    $search_result_two = mysqli_query($conn, $confirmSQLTwo);

    if ($search_result > 0 && $search_result_two > 0) {
        echo ("success");
    } else {
        return false;
    }
}

function getNotificationCount()
{
    $conn = Connection();

    $getNotifCount = "SELECT COUNT(*) AS tot FROM notification_tbl WHERE notif_rqst_stt = 'Pending';";

    $countnotif = mysqli_query($conn, $getNotifCount);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    if (mysqli_num_rows($countnotif) > 0) {

        $rec = mysqli_fetch_assoc($countnotif);

        $tot = $rec["tot"];

        echo ($tot);
    } else {
        return false;
    }
};

function lowStockProdError()
{
    $conn = Connection();

    $lowStock = "SELECT product_tbl.prod_id, product_tbl.prod_code, product_tbl.prod_name, product_tbl.prod_motor_capacity, product_tbl.prod_phase, product_tbl.prod_reorder_level, stock_prod_tbl.prod_qty
                    FROM product_tbl
                    INNER JOIN stock_prod_tbl
                    ON product_tbl.prod_id = stock_prod_tbl.prod_id;";

    $search_result = mysqli_query($conn, $lowStock);

    $nor = mysqli_num_rows($search_result);

    if ($nor > 0) {

        while ($rec = mysqli_fetch_assoc($search_result)) {

            $reorderlevel = $rec['prod_reorder_level'];
            $stockQTY = $rec['prod_qty'];

            if ($stockQTY < $reorderlevel) {
                echo ("<div class='alert alert-dismissible alert-secondary' style='width:95%; margin-left:3%'>
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                            <strong>Low Stocks : [" . $rec['prod_code'] . "] " . $rec['prod_name'] . "!</strong><br>
                            The current stocks of " . $rec['prod_name'] . " (" . $rec['prod_motor_capacity'] . ") (" . $rec['prod_phase'] . ") are at " . $rec['prod_qty'] . " units!
                            <br>
                            <a href='../request_notes/production_req_form.php' class='alert-link'>Click here to request production</a>.
                        </div>");
            }
        }
    } else {

        return false;
    }
}
