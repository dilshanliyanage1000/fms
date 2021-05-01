<?php
session_start();

date_default_timezone_set('Asia/Colombo');

require_once('../../inc/tcpdf/tcpdf.php');
include_once('../../functions/miscellaneous.php');
include_once('../../functions/db_conn.php');

$conn = Connection();

$requestID = $_GET['requestID'];

$tblValuesOne = $_GET['ProdListTbl'];

$tblValuesTwo = $_GET['FinalPartReqList'];

$username = $_SESSION['userFirstName'] . "&nbsp;" . $_SESSION['userLastName'];

$c = 1;
$d = 1;

$today = date("dS \of F\, Y");

//----------------------- Total products required -------------------------------------

$tbl =  json_decode($tblValuesOne);

$displayTable = '';

foreach ($tbl as $row) {

  $prodID     = $row->prodID;
  $prodCode   = $row->prodCode;
  $prodName   = $row->prodName;
  $prodQty    = $row->prodQty;

  $displayTable .= '<tr>
                          <td style="text-align:center;">' . $d . '</td>
                          <td style="text-align:center;">' . $prodCode . '</td>
                          <td style="text-align:left;">' . $prodName . '</td>
                          <td style="text-align:right;">' . $prodQty . ' unit(s)</td>
                      </tr>';

  $d++;
}

//------------------------- Required part list --------------------------------------------

$tbl_2 =  json_decode($tblValuesTwo);

$displayTable_2 = '';

foreach ($tbl_2 as $row_2) {

  $partID     = $row_2->partID;
  $partCode   = $row_2->partCode;
  $partName   = $row_2->partName;
  $partQty    = $row_2->partQty;

  $reduceStockQuery = "UPDATE stock_part_tbl SET part_qty = part_qty - $partQty WHERE part_id = '$partID';";

  $runReduceQuery = mysqli_query($conn, $reduceStockQuery);

  $displayTable_2 .= '<tr>
                          <td style="text-align:center;">' . $c . '</td>
                          <td style="text-align:center;">' . $partCode . '</td>
                          <td style="text-align:left;">' . $partName . '</td>
                          <td style="text-align:right;">' . $partQty . ' unit(s)</td>
                      </tr>';

  $c++;
}

//-------------------------------------------------- end --------------------------------------


$getCreator = "SELECT emp_tbl.emp_fname, emp_tbl.emp_lname
                FROM emp_tbl
                INNER JOIN request_tbl
                ON emp_tbl.emp_id = request_tbl.emp_id
                WHERE request_tbl.rqst_id = '$requestID'";

$getCreatorResult = mysqli_query($conn, $getCreator);

$rec = mysqli_fetch_assoc($getCreatorResult);

$requestedBy = $rec['emp_fname'] . '&nbsp;' . $rec['emp_lname'];


//----------------------------------------------------------------------------------------------

$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf = $obj_pdf->rollbackTransaction(false);
$obj_pdf->SetCreator(PDF_CREATOR);
$obj_pdf->SetTitle("UDAYA INDUSTRIES : PART PRODUCTION NOTICE");
$obj_pdf->SetHeaderData('watt.png', '20', PDF_HEADER_TITLE, PDF_HEADER_STRING);
$obj_pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->SetDefaultMonospacedFont('times');
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER, 5);
$obj_pdf->SetMargins(PDF_MARGIN_LEFT, '8', PDF_MARGIN_RIGHT);
$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$obj_pdf->setPrintHeader(false);
$obj_pdf->setPrintFooter(false);
$obj_pdf->SetAutoPageBreak(TRUE, 5);
$obj_pdf->SetFont('courier', '', 10);
$obj_pdf->AddPage();

$content = '';

$content = '<div>';

$content .= '<table style="border: none;">
                <tr>
                  <td style="font-weight: bold; text-align:left;"><img src="../../../img/invimg.png"/></td>
                  <td style="font-weight: bold; text-align:center;"></td>
                  <td style="font-weight: bold; text-align:right;"><h1>PRODUCTION NOTICE</h1></td>
                </tr>
                <tr>
                  <td style="width:100%; font-size: 8px; color: #000; text-align:left;">UDA ALUDENIYA, WELIGALLA, KANDY. 20610.<br>Tel: +94 (81) 231 0086 | +94 (81) 231 0831<br>Email: udayaind@sltnet.lk | udaya.industries@yahoo.com</td>
                </tr>
              </table>
              <br><br><br><br>';

$content .= '<table style="border: 1px solid #8c8c8c; width:100%; padding: 7px;">
              <tr>
                <td style="text-align:left; width: 18%; padding: 2px;font-weight: bold;">Requester:</td>
                <td style="text-align:left; width: 32%; padding: 2px;">' . $requestedBy . '</td>
                <td style="text-align:left; width: 5%; padding: 2px;"></td>
                <td style="text-align:right; width: 15%; padding: 2px;font-weight: bold;">Date:</td>
                <td style="text-align:right; width: 30%; padding: 2px;">' . $today . '</td>
              </tr>
              <tr>
                <td style="text-align:left; width: 18%; padding: 2px;font-weight: bold;">Created By:</td>
                <td style="text-align:left; width: 32%; padding: 2px;">' . $username . '</td>
                <td style="text-align:left; width: 5%; padding: 2px;"></td>
                <td style="text-align:right; width: 15%; padding: 2px;font-weight: bold;">Req. Ref:</td>
                <td style="text-align:right; width: 30%; padding: 2px;">' . $requestID . '</td>
              </tr>
            </table>
            <br><br>';

$content .= '<h4>Required Products,</h4>
             <table border="0" cellspacing="0" cellpadding="3" style="border: 1px solid #8c8c8c; width:100%;">
                <tr style="text-align: center; font-weight: bold;">
                    <th width="10%" style="text-align:center;">Item No</th>
                    <th width="30%" style="text-align:center;">Product Code</th>
                    <th width="45%" style="text-align:center;">Product Name</th>
                    <th width="15%" style="text-align:center;">Quantity</th>
                </tr>';

$content .= $displayTable;

$content .= '</table><br><br>';

$content .= '<h4>Total quantity of parts required for production,</h4>
              <table border="0" cellspacing="0" cellpadding="3" style="border: 1px solid #8c8c8c; width:100%;">
                        <tr style="text-align: center; font-weight: bold;">
                            <th width="10%" style="text-align:center;">Item No</th>
                            <th width="30%" style="text-align:center;">Part Code</th>
                            <th width="45%" style="text-align:center;">Part Name</th>
                            <th width="15%" style="text-align:center;">Quantity</th>
                        </tr>';

$content .= $displayTable_2;

$content .= '</table><br><br><br><br><br>';

$content .= '<table border="0" cellspacing="0" cellpadding="3" style="border: none; width:100%;">
                <tr>
                  <td width="30%" style="text-align:left;">......................</td>
                  <th width="10%" style="text-align:center;"></th>
                  <td width="30%" style="text-align:left;">......................</td>
                  <th width="30%" style="text-align:center;"></th>
                </tr>
                <tr>
                  <td width="30%" style="text-align:center; padding: 2px;">Approved By</td>
                  <th width="10%" style="text-align:center;"></th>
                  <td width="30%" style="text-align:center; padding: 2px;">Accepted By</td>
                  <th width="30%" style="text-align:center;"></th>
                </tr>
              </table>';

$content .= '</div>';

$pdfname = $requestID . '-PROD-PRODUCTION-NOTE';

$obj_pdf->writeHTML($content);

$pdf_string = $obj_pdf->Output('' . $pdfname . '.pdf', 'S');

file_put_contents('../../docs/prod_production_notice/' . $pdfname . '.pdf', $pdf_string);

$realpath = '../../docs/prod_production_notice/' . $pdfname . '.pdf';

//------------------ run all confirm sqls ----------------------------------------------

$updateQuery = "UPDATE request_tbl
                SET rqst_pdf = '$realpath', rqst_status = 'Confirmed'
                WHERE rqst_id='$requestID';";

$runQuery = mysqli_query($conn, $updateQuery);

//-------------------------------------------------------------------------------------

$accDate = date("Y-m-d @ h:i:sa");

$thisDate = date("Y-m-d");

$confirmSQL = "UPDATE notification_tbl
                SET notif_rqst_stt = 'Confirmed', notif_accepted_date= '$accDate', acc_date='$thisDate'
                WHERE rqst_id='$requestID';";

$confirmResult = mysqli_query($conn, $confirmSQL);

//-------------------------------------------------------------------------------------

echo ("<script>window.close();</script>");
