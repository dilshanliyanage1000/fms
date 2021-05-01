<?php

include_once('../../functions/db_conn.php');

include_once('../../functions/Id_maker.php');

function purchaseOrderList()
{

    $conn = Connection();

    $requestlist = "SELECT t1.rqst_id, t1.rqst_type, t1.requester, t1.rqst_status, t1.notif_body, t1.notif_date, t1.notif_accepted_date, t2.creator
                    FROM (
                    SELECT request_tbl.rqst_id, request_tbl.rqst_type, CONCAT(emp_tbl.emp_fname, ' ', emp_tbl.emp_lname) AS requester, request_tbl.user_id, request_tbl.rqst_status, notification_tbl.notif_body, 								notification_tbl.notif_date, notification_tbl.notif_accepted_date
                    FROM ((request_tbl
                    INNER JOIN emp_tbl
                    ON request_tbl.emp_id = emp_tbl.emp_id)
                    INNER JOIN notification_tbl
                    ON notification_tbl.rqst_id = request_tbl.rqst_id)
                    WHERE request_tbl.rqst_type = 'RM-REQUEST' AND request_tbl.rqst_status = 'Confirmed'
                    ) as t1, (
                    SELECT user_tbl.user_id, CONCAT(emp_tbl.emp_fname,' ',emp_tbl.emp_lname) AS creator
                    FROM user_tbl
                    INNER JOIN emp_tbl
                    ON user_tbl.emp_id = emp_tbl.emp_id
                    ) as t2
                    WHERE t1.user_id = t2.user_id";

    $runQuery = mysqli_query($conn, $requestlist);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $nor = mysqli_num_rows($runQuery);

    if ($nor > 0) {

        while ($rec = mysqli_fetch_assoc($runQuery)) {

            $rqID = $rec["rqst_id"];

            echo ("<td>" . $rec["rqst_id"] . "</td>");

            $supplierName = '';

            $getSuppliier = "SELECT DISTINCT (supplier_tbl.sup_company_name)
                                FROM ((request_tbl
                                INNER JOIN purchase_order_tbl ON purchase_order_tbl.rqst_id = request_tbl.rqst_id)
                                INNER JOIN supplier_tbl ON supplier_tbl.sup_id = purchase_order_tbl.sup_id)
                                WHERE request_tbl.rqst_id = '$rqID';";

            $getQuery = mysqli_query($conn, $getSuppliier);

            if (mysqli_errno($conn)) {
                echo (mysqli_error($conn));
            }

            $nor = mysqli_num_rows($getQuery);

            if ($nor > 0) {

                while ($record = mysqli_fetch_assoc($getQuery)) {

                    $supplierName .= $record['sup_company_name'] . " | ";
                }
            }

            echo ("<td>" . $supplierName . "</td>");

            echo ("<td>" . $rec['notif_date'] . "</td>");

            echo ("<td>" . $rec['requester'] . "</td>");

            echo ("<td>" . $rec['notif_accepted_date'] . "</td>");

            echo ("<td>" . $rec['creator'] . "</td>");

            echo ("<td><button type='button' style='width:100%;' id='" . $rec["rqst_id"] . "' class='btn btn-selectpo btn-info btn-sm' data-toggle='modal' data-target='#po_modal'><i class='fas fa-info-circle'></i>&nbsp;&nbsp;View Purchase Orders</button></td>");

            echo ("</tr>");
        }
    } else {
        return (" No record found");
    }
}

function getallPO($id)
{

    $conn = Connection();

    $requestlist = "SELECT q2.po_id, q2.sup_id, q2.sup_company_name, q2.po_pdf_path, q1.rqst_id, q1.rqst_type, q1.requester, q1.rqst_status, q1.notif_body, q1.notif_date, q1.notif_accepted_date, q1.creator
                    FROM (
                        
                        SELECT t1.rqst_id, t1.rqst_type, t1.requester, t1.rqst_status, t1.notif_body, t1.notif_date, t1.notif_accepted_date, t2.creator
                        FROM (
                            
                        SELECT request_tbl.rqst_id, request_tbl.rqst_type, CONCAT(emp_tbl.emp_fname, ' ', emp_tbl.emp_lname) AS requester, request_tbl.user_id, request_tbl.rqst_status,notification_tbl.notif_body, notification_tbl.notif_date, notification_tbl.notif_accepted_date
                            FROM ((request_tbl
                                INNER JOIN emp_tbl
                                ON request_tbl.emp_id = emp_tbl.emp_id)
                                INNER JOIN notification_tbl
                                ON notification_tbl.rqst_id = request_tbl.rqst_id)
                            WHERE request_tbl.rqst_id = '$id'
                        
                    ) as t1, (
                        
                        SELECT user_tbl.user_id, CONCAT(emp_tbl.emp_fname,' ',emp_tbl.emp_lname) AS creator
                        FROM user_tbl
                        INNER JOIN emp_tbl
                        ON user_tbl.emp_id = emp_tbl.emp_id
                    
                    ) as t2 WHERE t1.user_id = t2.user_id
                        
                    ) as q1, (
                        
                    SELECT purchase_order_tbl.po_id, purchase_order_tbl.rqst_id, purchase_order_tbl.sup_id, supplier_tbl.sup_company_name, purchase_order_tbl.po_pdf_path
                    FROM purchase_order_tbl
                    INNER JOIN supplier_tbl
                    ON purchase_order_tbl.sup_id = supplier_tbl.sup_id
                        
                    ) as q2
                    
                    WHERE q1.rqst_id = q2.rqst_id";

    $runQuery = mysqli_query($conn, $requestlist);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $nor = mysqli_num_rows($runQuery);

    if ($nor > 0) {

        $pdf_paths = '';
        $c = 1;

        $pdf_paths .= "<div class='col-md-12'>
                        <div class='row'>";

        while ($rec = mysqli_fetch_assoc($runQuery)) {
            $pdf_paths .= "<div class='col-md-12' style='margin-top:10px;'>
                                <h6>P/O for " . $rec['sup_company_name'] . "</h6>
                            </div>
                            <div class='col-md-8' style='margin-bottom:20px;'>
                                <button type='button' id='" . $rec['po_pdf_path'] . "' style='width:100%;' class='btn btn-pdf btn-info btn-sm'><i class='fas fa-download'></i>&nbsp;&nbsp;Purchase Order #" . $c . "</button>
                            </div>
                            <div class='col-md-4 style='margin-bottom:20px;'>
                                <button type='button' style='width:100%;' id='" . $id . "|" . $rec['sup_id'] . "' class='btn btn-sendmail btn-dark btn-sm'><i class='fas fa-paper-plane'></i>&nbsp;&nbsp;Send Mail</button>
                            </div>";

            $c++;
        }

        $pdf_paths .= "</div></div>";

        return ($pdf_paths);
    } else {
        return (" No record found");
    }
}
?>