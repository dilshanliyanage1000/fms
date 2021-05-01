<?php
session_start();

date_default_timezone_set('Asia/Colombo');

require_once('../../inc/tcpdf/tcpdf.php');
include_once('../../functions/db_conn.php');

$today = date("Y-m-d h:i:sA");

$id               = $_GET['id'];
$prod_diag_id     = $_GET['diagid'];

if ($_GET['warranty_status'] == 'yes') {
  $warranty_status  = 'Yes';
} else if ($_GET['warranty_status'] == 'yes') {
  $warranty_status  = 'No';
}

if ($_GET['prod_eligibility'] == 'repair') {
  $prod_eligibility = 'Eligible for Repairs';
} else if ($_GET['prod_eligibility'] == 'onetonereplacement') {
  $prod_eligibility = 'Eligible for One-to-One Replacement';
}

if (isset($_GET['repaircost'])) {
  $repaircost     = $_GET['repaircost'];
} else {
  $repaircost     = '';
}

if ($_GET['prod_condition'] == 'weak') {
  $prod_condition   = 'Weak Condition';
} else if ($_GET['prod_condition'] == 'moderate') {
  $prod_condition   = 'Moderate Condition';
} else if ($_GET['prod_condition'] == 'excellent') {
  $prod_condition   = 'Excellent Condition';
}

$final_diagnosis  = $_GET['final_diagnosis'];

$inital_diagnosis_statement = $_GET['inital_diagnosis_statement'];
$initial_customer_statement = $_GET['initial_customer_statement'];

$customername = '';
$productname = '';

$conn = Connection();

$getSQL = "SELECT cus_tbl.cus_first_name, cus_tbl.cus_last_name, product_tbl.prod_name, product_tbl.prod_motor_capacity
            FROM(( product_diagnosis_tbl
            INNER JOIN cus_tbl
            ON product_diagnosis_tbl.cus_id = cus_tbl.cus_id)
            INNER JOIN product_tbl
            ON product_diagnosis_tbl.prod_id = product_tbl.prod_id)
            WHERE product_diagnosis_tbl.diag_id = '$prod_diag_id';";

$runSQL = mysqli_query($conn, $getSQL);

$nor = mysqli_num_rows($runSQL);

if ($nor > 0) {
  while ($rec = mysqli_fetch_assoc($runSQL)) {
    $customername = $rec['cus_first_name'] . '&nbsp;' . $rec['cus_last_name'];
    $productname = $rec['prod_name'] . '&nbsp;(' . $rec['prod_motor_capacity'] . ')';
  }
}

$objectofPDF = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$objectofPDF->SetCreator(PDF_CREATOR);
$objectofPDF->SetTitle("UDAYA INDUSTRIES : PRODUCT DIAGNOSIS RESULT");
$objectofPDF->SetHeaderData('watt.png', '20', PDF_HEADER_TITLE, PDF_HEADER_STRING);
$objectofPDF->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$objectofPDF->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$objectofPDF->SetDefaultMonospacedFont('times');
$objectofPDF->SetFooterMargin(PDF_MARGIN_FOOTER, 5);
$objectofPDF->SetMargins(PDF_MARGIN_LEFT, '8', PDF_MARGIN_RIGHT);
$objectofPDF->SetHeaderMargin(PDF_MARGIN_HEADER);
$objectofPDF->SetFooterMargin(PDF_MARGIN_FOOTER);
$objectofPDF->setPrintHeader(false);
$objectofPDF->setPrintFooter(false);
$objectofPDF->SetAutoPageBreak(TRUE, 5);
$objectofPDF->SetFont('courier', '', 10);
$objectofPDF->AddPage();

$content = '';

$content = '<div>';

$content .= '<table style="border: none;">
                <tr>
                  <td style="font-weight: bold; text-align:left;"><img src="../../../img/invimg.png"/></td>
                  <td style="font-weight: bold; text-align:center;"></td>
                  <td style="font-weight: bold; text-align:right;"><h1>DEFECT DIAGNOSIS TERMINAL</h1></td>
                </tr>
                <tr>
                  <td style="width:100%; font-size: 8px; color: #000; text-align:left;">UDA ALUDENIYA, WELIGALLA, KANDY. 20610.<br>Tel: +94 (81) 231 0086 | +94 (81) 231 0831<br>Email: udayaind@sltnet.lk | udaya.industries@yahoo.com</td>
                </tr>
              </table>
              <br><br><br>';

$content .= '<table style="border: 1px solid #595959; width:100%; padding: 5px;">
              <tr>
                <td style="text-align:left; width: 20%; padding: 2px;">Customer Name&nbsp;:</td>
                <td style="text-align:left; width: 30%; padding: 2px;">' . $customername . '</td>
                <td style="text-align:left; width: 5%; padding: 2px;"></td>
                <td style="text-align:right; width: 15%; padding: 2px;">Date :</td>
                <td style="text-align:right; width: 30%; padding: 2px;">' . $today . '</td>
              </tr>
              <tr>
                <td style="text-align:left; width: 20%; padding: 2px;">Product Name&nbsp;&nbsp;:</td>
                <td style="text-align:left; width: 30%; padding: 2px;">' . $productname . '</td>
                <td style="text-align:left; width: 5%; padding: 2px;"></td>
                <td style="text-align:right; width: 15%; padding: 2px;">Ref/No :</td>
                <td style="text-align:right; width: 30%; padding: 2px;"><b>' . $id  . '</b></td>
              </tr>
            </table>
            <br><br>';

$content .= '<table style="border: 1px solid #595959; width:100%; padding: 5px;">
                <tr style="text-align: center;">
                    <td width="50%" style="text-align:left;">Initial Customer Statement</td>
                    <td width="50%" style="text-align:left;">:&nbsp;' . $initial_customer_statement . '</td>
                </tr>
                <tr style="text-align: center;">
                    <td width="50%" style="text-align:left;">Initial Defective Product Statement</td>
                    <td width="50%" style="text-align:left;">:&nbsp;' . $inital_diagnosis_statement . '</td>
                </tr>
                <tr style="text-align: center;">
                    <td width="50%" style="text-align:left;">Final Diagnosis</td>
                    <td width="50%" style="text-align:left;">:&nbsp;' . $final_diagnosis . '</td>
                </tr>
              </table>
              <br><br>';

$content .= '<table style="border: 1px solid #595959; width:100%; padding: 5px;">
                <tr style="text-align: center;">
                    <td width="50%" style="text-align:left;">Is product still under warranty?</td>
                    <td width="50%" style="text-align:left;">:&nbsp;' . $warranty_status . '</td>
                </tr>
                <tr style="text-align: center;">
                    <td width="50%" style="text-align:left;">Eligible for....</td>
                    <td width="50%" style="text-align:left;">:&nbsp;' . $prod_eligibility . '</td>
                </tr>
                <tr style="text-align: center;">
                    <td width="50%" style="text-align:left;">Product Condition</td>
                    <td width="50%" style="text-align:left;">:&nbsp;' . $prod_condition . '</td>
                </tr>
              </table>
              <br><br>';

if ($prod_eligibility == 'repair') {

  $newcost = number_format($repaircost);

  $content .= '<table style="border: 1px solid #595959; width:100%; padding: 5px;">
                <tr style="text-align: center;">
                  <td width="50%" style="text-align:left;">Repair Cost :</td>
                  <td width="50%" style="text-align:left;">Rs. ' . $newcost . '.00</td>
                </tr>
              </table>';
}

$content .= '<div style="margin-top:200px;"></div><br><br>';

$content .= '<table style="width:100%; padding: 5px;">
                <tr>
                  <td style="text-align:center; width: 33%; padding: 2px;">......................</td>
                  <td style="text-align:center; width: 33%; padding: 2px;">......................</td>
                  <td style="text-align:center; width: 33%; padding: 2px;">......................</td>
                </tr>
                <tr>
                  <td style="text-align:center; width: 33%; padding: 2px;">Prepared By</td>
                  <td style="text-align:center; width: 33%; padding: 2px;">Approved By</td>
                  <td style="text-align:center; width: 33%; padding: 2px;">Customer Signature</td>
                </tr>
              </table>';

$content .= '</div>';

$PDFText = $id . "-" . $prod_diag_id;

$pathtoDB = '../../docs/product_defect_diagnosis/' . $PDFText . '.pdf';

$newQuery = "UPDATE product_diag_finalized_tbl SET pfd_pdf_path = '$pathtoDB' WHERE pfd_id = '$id';";

$execQuery = mysqli_query($conn, $newQuery);

$objectofPDF->writeHTML($content);

$stringofPDF = $objectofPDF->Output('' . $PDFText . '.pdf', 'S');

file_put_contents('../../docs/product_defect_diagnosis/' . $PDFText . '.pdf', $stringofPDF);

echo "<script>window.close();</script>";

?>