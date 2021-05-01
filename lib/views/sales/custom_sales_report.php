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

$result = getSales($startDate, $endDate);

$result = explode("|||", $result);

$machinery_invoice_numbers  = $result[0];
$total_machinery_inv_price  = $result[1];
$machine_list               = $result[2];

$parts_invoice_numbers      = $result[3];
$total_parts_inv_price      = $result[4];
$parts_list                 = $result[5];

$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$obj_pdf->SetTitle("UDAYA INDUSTRIES : CUSTOM SALES REPORT");
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
                  <td style="font-weight: bold; text-align:right;"><h1>CUSTOM SALES REPORT</h1></td>
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
                <td style="text-align:center;"><h2><b>FULL SALES REPORT</b></h2></td>
              </tr>
              <tr>
                <td style="text-align:center;"><b>' . $startDate . ' TO ' . $endDate . '</b></td>
              </tr>
            </table>
            <br><br>';

$content .= '<table border="0" cellspacing="0" cellpadding="3" style="border: 1px solid #595959; width:100%;">';

$content .= '<tr style="background-color: #f8ffb0;">
                          <td style="width:50%; text-align: right;">(' . $startDate . ' - ' . $endDate . ') : Total Sales</td>
                          <td style="width:5%">&nbsp;</td>
                          <td style="width:41%; text-align: right;">Rs. ' . number_format($total_machinery_inv_price + $total_parts_inv_price) . '.00</td>
                          <td style="width:4%">&nbsp;</td>
                        </tr>';

$content .= '</table><br><br>';

// =========== IF MACHINE INVOICE  NUMBERS OUTPUT IS NULL ==========================================================================

if ($machinery_invoice_numbers == "-") {

  $content .= '<table border="0" cellspacing="0" cellpadding="3" style="border: 1px solid #595959; width:100%; text-align:center;">
                <tr>
                    <th style="text-align:center;"><b>INVOICE NUMBERS (MACHINES)</b></th>
                </tr>';

  $content .= '<tr style="text-align:center;">
                  <td>No Records to Display</td>
                </tr>';

  $content .= '</table><br><br>';
}

// =========== IF MACHINE INVOICE  NUMBERS OUTPUT IS NOT NULL ==========================================================================


else {

  $content .= '<table border="0" cellspacing="0" cellpadding="3" style="border: 1px solid #595959; width:100%; text-align:center;">
                <tr>
                    <th style="text-align:center;"><b>INVOICE NUMBERS (MACHINES)</b></th>
                </tr>
                <tr style="text-align:center;">
                    <th width="25%"><b>Ref/Code</b></th>
                    <th width="25%"><b>Total Price</b></th>
                    <th width="25%"><b>Discount</b></th>
                    <th width="25%"><b>Final Price</b></th>
                </tr>';

  $content .= $machinery_invoice_numbers;

  $content .= '</table><br><br>';

  // =========== TOTAL SALES AMOUNT OF ALL MACHINERY INVOICES ==========================================================================

  $content .= '<table border="0" cellspacing="0" cellpadding="3" style="border: 1px solid #595959; width:100%;">';

  $content .= '<tr style="background-color: #f8ffb0;">
                <td style="width:15%">&nbsp;</td>
                <td style="width:30%; text-align: right;">Total Machinery Sales</td>
                <td style="width:15%">&nbsp;</td>
                <td style="width:36%; text-align: right;">Rs. ' . number_format($total_machinery_inv_price) . '.00</td>
                <td style="width:4%">&nbsp;</td>
              </tr>';

  $content .= '</table><br><br>';

  $content .= '<table border="0" cellspacing="0" cellpadding="3" style="border: 1px solid #595959; width:100%; text-align:center;">
                <tr>
                    <th style="text-align:center;"><b>SOLD MACHINES & QUANTITIES</b></th>
                </tr>
                <tr style="text-align:center;">
                    <th style="text-align:center; width: 25%"><b>Machine Code</b></th>
                    <th style="text-align:center; width: 50%"><b>Machine Name</b></th>
                    <th style="text-align:center; width: 25%"><b>Total Qty</b></th>
                </tr>';

  $content .= $machine_list;

  $content .= '</table><br><br>';
}


// =========== IF PARTS INVOICE  NUMBERS OUTPUT IS NULL ==========================================================================


if ($parts_invoice_numbers == '-') {

  $content .= '<table border="0" cellspacing="0" cellpadding="3" style="border: 1px solid #595959; width:100%; text-align:center;">
                <tr>
                    <th style="text-align:center;"><b>INVOICE NUMBERS (PARTS)</b></th>
                </tr>';

  $content .= '<tr style="text-align:center;">
                  <td>No Records to Display</td>
                </tr>';

  $content .= '</table><br><br>';
}

// =========== IF MACHINE INVOICE  NUMBERS OUTPUT IS NOT NULL ==========================================================================

else {

  $content .= '<table border="0" cellspacing="0" cellpadding="3" style="border: 1px solid #595959; width:100%; text-align:center;">
                <tr>
                    <th style="text-align:center;"><b>INVOICE NUMBERS (PARTS)</b></th>
                </tr>
                <tr style="text-align:center;">
                    <th width="25%"><b>Ref/Code</b></th>
                    <th width="25%"><b>Total Price</b></th>
                    <th width="25%"><b>Discount</b></th>
                    <th width="25%"><b>Final Price</b></th>
                </tr>';

  $content .= $parts_invoice_numbers;

  $content .= '</table><br><br>';

  // =========== TOTAL SALES AMOUNT OF ALL PARTS INVOICES ==========================================================================

  $content .= '<table border="0" cellspacing="0" cellpadding="3" style="border: 1px solid #595959; width:100%;">';

  $content .= '<tr style="background-color: #f8ffb0;">
                <td style="width:15%">&nbsp;</td>
                <td style="width:30%; text-align: right;">Total Parts Sales</td>
                <td style="width:15%">&nbsp;</td>
                <td style="width:36%; text-align: right;">Rs. ' . number_format($total_parts_inv_price) . '.00</td>
                <td style="width:4%">&nbsp;</td>
              </tr>';

  $content .= '</table><br><br>';

  $content .= '<table border="0" cellspacing="0" cellpadding="3" style="border: 1px solid #595959; width:100%; text-align:center;">
                <tr>
                  <th style="text-align:center;"><b>SOLD PARTS & QUANTITIES</b></th>
                </tr>
                <tr style="text-align:center;">
                    <th style="text-align:center; width: 25%"><b>Parts Code</b></th>
                    <th style="text-align:center; width: 50%"><b>Parts Name</b></th>
                    <th style="text-align:center; width: 25%"><b>Total Qty</b></th>
                </tr>';

  $content .= $parts_list;

  $content .= '</table>';
}

$content .= '</div>';

$obj_pdf->writeHTML($content);

$obj_pdf->Output('Customized Sales Report.pdf', 'I');
