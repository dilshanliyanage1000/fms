<?php
session_start();

date_default_timezone_set('Asia/Colombo');

require_once('../../inc/tcpdf/tcpdf.php');
include_once('../../functions/grn.php');
include_once('../../functions/stock.php');

$username = $_SESSION['userFirstName'] . "&nbsp;" . $_SESSION['userLastName'];

$supplier = '';
$suppliername = '';

$loggeduser = '';
$grnRefNo = '';
$paymentstatus = '';
$issuedate = '';
$paymentduedate = '';

$warehouse = '';
$warehousename = '';

$additionalnotes = '';

$stockLevel = '';

$TableData;
$prodqty = '';

$mastertotal = '';
$tbl = '';
$tblContent = '';
$pdfname = '';
$c = 1;

$today = date("dS \of F\, Y");

$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$obj_pdf->SetTitle("UDAYA INDUSTRIES : GOODS RECIEVED NOTE");
$obj_pdf->SetHeaderData('watt.png', '20', PDF_HEADER_TITLE, PDF_HEADER_STRING);
$obj_pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->SetDefaultMonospacedFont('times');
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER, 10);
$obj_pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);
$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$obj_pdf->setPrintHeader(false);
$obj_pdf->setPrintFooter(false);
$obj_pdf->SetAutoPageBreak(TRUE, 10);
$obj_pdf->SetFont('times', '', 11);
$obj_pdf->AddPage();

if (isset($_GET["grnrefno"])) {
  $paymentstatus    = $_GET["paymentstatus"];
  $warehouse        = $_GET["warehouseid"];
  $supplier         = $_GET["supplierid"];
  $additionalnotes  = $_GET["additionalnotes"];
  $grnRefNo         = $_GET["grnrefno"];
  $tbl              = $_GET["RMListTbl"];
  $mastertotal      = $_GET["master_total"];

  $mastertotal = number_format($mastertotal);
}

$GrnID = getRecentlyAddedGRN();

$suppliername = getSupplierName($supplier);

$warehousename = getWarehouseName($warehouse);

$tbl =  json_decode($tbl);

foreach ($tbl as $row) {

  $rmid         = $row->rawmatID;
  $rmname       = $row->rawmatName;

  $initialRMStock = RMStockLevels($rmid);

  $stockLevel .= '<tr>
                    <td style="width:15%; text-align:left;"><b>' . $rmname . '</b></td>
                    <td style="width:5%; text-align:left;"><b>:</b></td>
                    <td style="width:20%; text-align:right;">Inital Stock Value</td>
                    <td style="width:15%; text-align:left;">:&nbsp;' . $initialRMStock . '&nbsp;Kg(s)</td>';

  $rmunitprice  = $row->rmUnitPrice;
  $unpriceonly  = explode(" ", $rmunitprice)[1];
  $unpriceonly_d  = number_format($unpriceonly);

  $rmqty        = $row->rmQty;
  $rmqty        = explode(" ", $rmqty)[0];

  $rmtotalprice = $row->rmTotalPrice;
  $totpriceonly   = explode(" ", $rmtotalprice)[1];
  $totpriceonly_d   = number_format($totpriceonly);

  $addItems = addGRNItems($GrnID, $rmid, $rmname, $unpriceonly, $rmqty, $totpriceonly);

  $addtostock = insertRMStock($rmid, $rmqty);

  $tblContent .= '<tr style="text-align:center;"><td>' . $c . '</td><td style="text-align:center;">' . $rmname . '</td><td style="text-align:right;">Rs. ' . number_format($unpriceonly_d) . '.00</td><td style="text-align:center;">' . $rmqty . '</td><td style="text-align:right;">Rs. ' . number_format($totpriceonly_d) . '.00</td></tr>';

  $PostRMStock = RMStockLevels($rmid);

  $stockLevel .= '<td style="width:20%; text-align:right;">Post-Stock Value</td>
                  <td style="width:15%; text-align:left;">:&nbsp;' . $PostRMStock . '&nbsp;Kg(s)</td>
                </tr>';

  $c++;
}


$pdfname = $GrnID . "-" . $grnRefNo;

$pathsend = '../../docs/goodsrecievednote/' . $pdfname . '.pdf';

$content = '<div>
              <br><br><br>';

$content .= '<table style="border: none;">
              <tr>
                <td style="font-weight: bold; text-align:center;"><img src="../../../img/pdflogo.png"/>&nbsp;<h1>UDAYA INDUSTRIES : GOODS RECIEVED NOTE</h1></td>
              </tr>
            </table>
            <br>';

$content .= '<br><br>';

$content .= '<table style="border: none; width:100%;">
                <tr>
                  <td style="width:20%; text-align:left;">GRN Ref/No</td>  
                  <td style="width:30%; text-align:left;">:&nbsp;<b>' . $GrnID . '</b></td>
                  <td style="width:25%; text-align:right;">GRN Created Date&nbsp;:</td>
                  <td style="width:25%; text-align:right;">' . $today . '</td>
                </tr>
                <br>
                <tr>
                  <td style="width:20%; text-align:left;">Supplier Name</td>
                  <td style="width:30%; text-align:left;">:&nbsp;<b>' . $suppliername . '</b></td>
                  <td style="width:25%; text-align:right;">GRN Created User&nbsp;:</td>
                  <td style="width:25%; text-align:right;">' . $username . '</td>
                </tr>
                <br>
                <tr>
                  <td style="width:20%; text-align:left;">Recieved Warehouse</td>
                  <td style="width:30%; text-align:left;">:&nbsp;<b>' . $warehousename . '</b></td>
                  <td style="width:25%; text-align:right;">Extra Notes&nbsp;:</td>
                  <td style="width:25%; text-align:right;">' . $additionalnotes . '</td>
                </tr>
                <br>
                <tr>
                  <td style="width:20%; text-align:left;">Payment Status</td>
                  <td style="width:30%; text-align:left;">:&nbsp;<b>' . $paymentstatus . '</b></td>
                  <td style="width:25%; text-align:right;">Invoice Ref/No&nbsp;:</td>
                  <td style="width:25%; text-align:right;"><b>' . $grnRefNo . '</b></td>
                </tr>
              </table>';

$content .= '<br><br><br>';

$content .= '<table style="border: none; margin-left:1px;">
                <tr>
                  <td style="text-decoration: underline; font-weight: bold;"><u>Recieved Items List</h5></td>
                </tr>
              </table>
              <br>';

$content .= '<table border="1" cellspacing="0" cellpadding="3" style="margin-top: 20px;">
              <tr style="text-align: center; font-weight: bold">
                  <th width="15%" style="text-align:center;">Item Code</th>
                  <th width="30%" style="text-align:center;">Raw Material Name</th>
                  <th width="20%" style="text-align:center;">Unit Price</th>
                  <th width="15%" style="text-align:center;">Qty</th>
                  <th width="20%" style="text-align:center;">Total Price</th>
              </tr>';

$content .= $tblContent;

$content .= ' <tr>
                <td width="80%" style="text-align:right;"><b>Total Price</b></td>
                <td width="20%" style="text-align:right;">Rs. ' . $mastertotal . '.00</td>
              </tr>
            </table>';

$content .= '<br><br>';

$content .= '<table style="border: none; margin-left:1px;">
                <tr>
                  <td style="text-decoration: underline; font-weight: bold;">Stock Update Notice&nbsp;&nbsp;[As of&nbsp;' . $today . '&nbsp;]</td>
                </tr>
              </table>';

$content .= '<br><br>';

$content .= '<table style="border: none;" cellspacing="0" cellpadding="3" style="margin-top: 20px;">';

$content .= $stockLevel;

$content .= '</table>';

$content .= '</div>';

$content .= '<div style="margin-bottom:30px;"></div>';

$uigrn = '../../docs/goodsrecievednote/' . $pdfname . '.pdf';

addPathtoGRN($GrnID, $uigrn);

$obj_pdf->writeHTML($content);

$pdf_string = $obj_pdf->Output('' . $pdfname . '.pdf', 'S');

file_put_contents('../../docs/goodsrecievednote/' . $pdfname . '.pdf', $pdf_string);

echo "<script>window.close();</script>";

?>