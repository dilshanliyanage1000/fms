<?php

session_start();

date_default_timezone_set('Asia/Colombo');

include_once("../../functions/db_conn.php");
include_once("../../functions/sales.php");

require_once('../../inc/tcpdf/tcpdf.php');

$today = date("Y-m-d h:i:sA");

$userName = $_SESSION['userFirstName'] . '&nbsp;' . $_SESSION['userLastName'];

$startDate                  = $_GET["startDate"];
$endDate                    = $_GET["endDate"];

$result = getMostSellingReport($startDate, $endDate);

$result = explode("|||", $result);

$TopSellers  = $result[0];

$InvoiceNumbers  = $result[1];

$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$obj_pdf->SetTitle("UDAYA INDUSTRIES : MOST-SELLING PRODUCTS REPORT");
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
                  <td style="font-weight: bold; text-align:right;"><h1>MOST-SELLING PRODUCTS REPORT</h1></td>
                </tr>
                <tr>
                  <td style="width:100%; font-size: 8px; color: #000; text-align:left;">UDA ALUDENIYA, WELIGALLA, KANDY. 20610.<br>Tel: +94 (81) 231 0086 | +94 (81) 231 0831<br>Email: udayaind@sltnet.lk | udaya.industries@yahoo.com</td>
                </tr>
              </table>
              <br><br>';


$content .= '<table style="border: 1px solid #595959; width:100%; padding: 5px;">
              <tr>
                <td style="text-align:left; width: 18%; padding: 2px;">Created By :</td>
                <td style="text-align:left; width: 32%; padding: 2px;">' . $userName . '</td>
                <td style="text-align:left; width: 5%; padding: 2px;"></td>
                <td style="text-align:right; width: 15%; padding: 2px;">Date:</td>
                <td style="text-align:right; width: 30%; padding: 2px;">' . $today . '</td>
              </tr>
            </table>
            <br><br>';

$content .= '<table style="border: 1px solid #595959; width:100%; padding: 3px;">
              <tr>
                <td style="text-align:center;"><h2><b>MOST-SELLING PRODUCTS REPORT</b></h2></td>
              </tr>
              <tr>
                <td style="text-align:center;"><b>' . $startDate . ' TO ' . $endDate . '</b></td>
              </tr>
            </table>
            <br><br>';

$content .= '<table border="0" cellspacing="0" cellpadding="3" style="border: 1px solid #595959; width:100%;">';

$content .= '</table><br><br>';

$content .= '<table border="0" cellspacing="0" cellpadding="3" style="border: 1px solid #595959; width:100%; text-align:center;">
                <tr>
                    <th style="text-align:center;"><b>MOST SELLINGS PRODUCTS</b></th>
                </tr>
                <tr style="text-align:center;">
                    <th width="70%"><b>Product Details</b></th>
                    <th width="30%"><b>Total Price</b></th>
                </tr>';

$content .= $TopSellers;

$content .= '</table><br><br>';

$content .= '<table border="0" cellspacing="0" cellpadding="3" style="border: 1px solid #595959; width:100%; text-align:center;">
                <tr>
                    <th style="text-align:center;"><b>RESPECTIVE INVOICE NUMBERS</b></th>
                </tr>
                <tr style="text-align:center;">
                    <th style="text-align:center; width: 30%"><b>Invoice Date</b></th>
                    <th style="text-align:center; width: 30%"><b>Invoice Code</b></th>
                    <th style="text-align:center; width: 40%"><b>Invoice Price</b></th>
                </tr>';

$content .= $InvoiceNumbers;

$content .= '</table><br><br>';

$content .= '</div>';

$obj_pdf->writeHTML($content);

$obj_pdf->Output('Most Selling Products Report.pdf', 'I');

?>