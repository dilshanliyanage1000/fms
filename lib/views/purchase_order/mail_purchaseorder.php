<?php

session_start();

include_once("../../inc/PHPMailer/src/PHPMailer.php");
include_once("../../inc/PHPMailer/src/SMTP.php");
include_once("../../inc/PHPMailer/src/Exception.php");

include_once("../../functions/db_conn.php");
include_once("../../functions/Id_maker.php");

use PHPMailer\PHPMailer\PHPMailer;

$success = array();

$getID = $_POST['id'];

$getID = explode("|", $getID);

$requestID = $getID[0];

$supplierID = $getID[1];

$userID = $_SESSION['userId'];

//-----------------------------------------------------------------------------------------------------------------

$conn = Connection();

$getRequestSQL = "SELECT purchase_order_tbl.po_id, purchase_order_tbl.rqst_id, purchase_order_tbl.po_pdf_path, supplier_tbl.sup_email
                    FROM purchase_order_tbl
                    INNER JOIN supplier_tbl
                    ON purchase_order_tbl.sup_id = supplier_tbl.sup_id
                    WHERE purchase_order_tbl.rqst_id = '$requestID' AND supplier_tbl.sup_id = '$supplierID';";

$runSQL = mysqli_query($conn, $getRequestSQL);

$nor = mysqli_num_rows($runSQL);

if ($nor > 0) {

    $runQuery = 0;

    while ($rec = mysqli_fetch_array($runSQL)) {

        $poID               = $rec['po_id'];
        $supplier_mail      = $rec['sup_email'];
        $pdf_path           = $rec['po_pdf_path'];

        $mail = new PHPMailer();

        //////////////////////////////////////////////////////////////
        /////////                                           //////////
        /////////    udaya.industries.official@gmail.com    //////////
        /////////          udaya.industries.2020            //////////
        /////////             15 - 10 - 1995                //////////
        /////////                                           //////////
        //////////////////////////////////////////////////////////////

        //SMTP Settings
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "udaya.industries.official@gmail.com";
        $mail->Password = "udaya.industries.2020";
        $mail->Port = 465;
        $mail->SMTPSecure = "ssl";

        //Receiever Details
        $mail->isHtml = true;
        $mail->setFrom("udaya.industries.official@gmail.com");
        $mail->addAddress($supplier_mail);
        $mail->Subject = "Purchase Order From Udaya Industries";
        $mail->Body = "Dear Sir,
        Please find the purchase order attached below.
        Thank You.";

        $mail->AddAttachment($pdf_path);

        if ($mail->send()) {
            array_push($success, "sucess");
        } else {
            array_push($success, "failed");
        }

        $mailID = Auto_id("mail_id", "mail_log", "MLT");

        $mailsendQuery = "INSERT INTO mail_log VALUES ('$mailID','$poID','$userID','$supplierID','$supplier_mail','$pdf_path',1);";

        $runQuery = mysqli_query($conn, $mailsendQuery);
    }

    if (in_array("error", $success) && $runQuery < 1) {
        echo ("error");
    } else {
        echo ("sucess");
    }
}
?>