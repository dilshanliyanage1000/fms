<?php
date_default_timezone_set('Asia/Colombo');

require_once('../../inc/tcpdf/tcpdf.php');
include_once('../../functions/invoice.php');
include_once('../../functions/customer.php');

$createdate = date("Y-m-d");

$cusid = '';
$cfname = '';
$clname = '';
$cmail = '';
$ccode1 = '';
$ctel1 = '';
$mobileone = '';
$ccode2 = '';
$ctel2 = '';
$mobiletwo = '';
$chouseno = '';
$cstreetone = '';
$cstreettwo = '';
$ccity = '';
$cpcode = '';

$empID = '';

$partID = '';
$itemcode = '';
$partName = '';
$capacity = '';
$motorocapacity = '';
$motorspeed = '';
$currentphase = '';
$unitprice = '';
$unpriceonly = '';
$qty = '';
$totalprice = '';
$totpriceonly = '';

$specialnotes = '';

$paymentmethod = '';
$transactionreceipt = '';
$chequeCode = '';
$chequeDate = '';

$mtotalget = '';
$mastertotal  = '';
$discount     = '';

$ftotalget = '';
$finaltotal   = '';
$addPayment = '';

$tbl = '';
$tblContent = '';
$pdfname = '';

$c = 1;
$invDesc = '';
$pathsend = '';

$empid = '';

$regInvoice = '';

$x = '';
$y = '';
$z = '';

$today = date("Y-m-d h:i:sA");

$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$obj_pdf->SetTitle("UDAYA INDUSTRIES : PART INVOICE");
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


$firstname      = $_GET["firstname"];
$lastname       = $_GET["lastname"];
$email          = $_GET["email"];
$code_phoneone  = $_GET["code_phoneone"];
$telone         = $_GET["telone"];
$code_phonetwo  = $_GET["code_phonetwo"];
$teltwo         = $_GET["teltwo"];
$houseno        = $_GET["houseno"];
$streetone      = $_GET["streetone"];
$streettwo      = $_GET["streettwo"];
$city           = $_GET["city"];
$postalcode     = $_GET["postalcode"];

$cusid = cusRegwithID($firstname, $lastname, $email, $code_phoneone, $telone, $code_phonetwo, $teltwo, $houseno, $streetone, $streettwo, $city, $postalcode, 1);

$empID          = $_GET["cashier_id"];
$loggedusername = $_GET["loggedusername"];
$tbl            = $_GET["partListTbl"];

$mtotalget      = $_GET["master_total"];
$mastertotal    = number_format($mtotalget, 2);

$discount       = $_GET["discount"];

if ($discount == '') {
  $discount = 0;
}

$ftotalget      = $_GET["finaltotal"];
$finaltotal     = number_format($ftotalget, 2);

$paymentmethod  = $_GET["paymentmethod"];
$specialnotes   = $_GET["specialnotes"];

if ($paymentmethod == 'cash') {

  $addPayment = addPayment($paymentmethod, $ftotalget, NULL, NULL, NULL);
} else if ($paymentmethod == 'card') {

  $transactionreceipt = $_GET["transaction_receipt_no"];
  $addPayment = addPayment($paymentmethod, $ftotalget, $transactionreceipt, NULL, NULL);
} else if ($paymentmethod == 'cheque') {

  $chequeCode = $_GET["chequeNo"];
  $chequeDate = $_GET["chequeDate"];
  $addPayment = addPayment($paymentmethod, $ftotalget, NULL, $chequeCode, $chequeDate);
}

$regInvoice = createPartInvoice($cusid, $empID, $mtotalget, $discount, $ftotalget, $addPayment, $createdate, NULL);

$res = getsingleCus($cusid);

$final = json_decode($res);

$final_fname     = $final->cus_first_name;
$final_lname     = $final->cus_last_name;
$final_mail      = $final->cus_email;
$final_codeone   = $final->cus_code_phoneone;
$final_phoneone  = $final->cus_phone_one;
$final_codetwo   = $final->cus_code_phonetwo;
$final_phonetwo  = $final->cus_phone_two;
$final_houseno   = $final->cus_houseno;
$final_streetone = $final->cus_street_one;
$final_streetwo  = $final->cus_street_two;
$final_city      = $final->cus_city;
$final_pcode     = $final->cus_postal_code;

$tbl =  json_decode($tbl);

foreach ($tbl as $row) {

  $partID         = $row->partID;

  $itemcode       = $row->itemcode;

  $partName       = $row->partName;

  $unitprice      = $row->unitprice;
  $unpriceonly    = explode(" ", $unitprice)[1];
  $unpricefinal   = number_format($unpriceonly, 2);

  $qty            = $row->qty;

  $totalprice     = $row->totalprice;
  $totpriceonly   = explode(" ", $totalprice)[1];
  $totpricefinal  = number_format($totpriceonly, 2);

  $invItems = invoicePartItems($regInvoice, $partID, $unpriceonly, $qty, $totpriceonly);

  $tblContent .= '<tr style="text-align:center;">
                    <td>#' . $c . '</td>
                    <td style="text-align:left;">[' . $itemcode . '] ' . $partName . '</td>
                    <td style="text-align:right;">Rs. ' . $unpricefinal . '</td>
                    <td style="text-align:center;">' . $qty . '</td>
                    <td style="text-align:right;">Rs. ' . $totpricefinal . '</td>
                  </tr>';

  $aodContent .= '<tr style="text-align:center;">
                    <td>#' . $c . '</td>
                    <td style="text-align:left;">[' . $itemcode . '] ' . $partName . '</td>
                    <td style="text-align:center;">' . $qty . '</td>
                  </tr>';

  $c++;
}

$pdfname = $regInvoice . "-" . $cusid;

$pathsend = '../../docs/part_invoice/' . $pdfname . '.pdf';

updateInvoicePDF($regInvoice, $pathsend);

if ($final_fname !== '') {
  $cfname      = $final_fname .= "&nbsp;";
} else if ($final_fname == "0") {
  $cfname = NULL;
}

if ($final_lname !== '') {
  $clname      = $final_lname .= "<br>";
} else if ($final_lname == 0) {
  $clname = "<br>";
} else if ($final_lname == '') {
  $clname = "<br>";
}

//----------------------------------------------------------

if ($final_houseno !== '') {
  $chouseno    = $final_houseno;
} else if ($final_houseno == 0) {
  $chouseno    = NULL;
}

if ($final_streetone !== '') {
  $cstreetone  = $final_streetone;
} else if ($final_streetone == 0) {
  $cstreetone = NULL;
}

if ($final_streetwo !== '') {
  $cstreettwo  = $final_streetwo;
} else if ($final_streetwo == 0) {
  $cstreettwo  = NULL;
}

if ($final_city !== '') {
  $ccity       = $final_city;
} else if ($final_city == 0) {
  $ccity = NULL;
}

if ($final_pcode !== '') {
  $cpcode      = $final_pcode;
} else if ($final_pcode == 0) {
  $cpcode = NULL;
}

if ($final_phoneone !== '') {
  $mobileone       = $final_codeone . "&nbsp;" . $final_phoneone;
} else if ($final_phoneone == 0) {
  $mobileone = "<br>";
}

if ($final_phonetwo !== '') {
  $mobiletwo       = "<br>" . $final_codetwo . "&nbsp;" . $final_phonetwo;
} else if ($final_phonetwo == 0) {
  $mobiletwo = NULL;
}

//----------------------------------------------------------

if ($final_mail !== '') {
  $cmail       = $final_mail;
} else if ($final_mail == 0) {
  $cmail = NULL;
}

$content = '';

$content = '<div>';

$content .= '<table style="border: none;">
                <tr>
                  <td style="font-weight: bold; text-align:left;"><img src="../../../img/invimg.png"/></td>
                  <td style="font-weight: bold; text-align:center;"></td>
                  <td style="font-weight: bold; text-align:right;"><h1>INVOICE</h1></td>
                </tr>
                <tr>
                  <td style="width:100%; font-size: 8px; color: #000; text-align:left;">UDA ALUDENIYA, WELIGALLA, KANDY. 20610.<br>Tel: +94 (81) 231 0086 | +94 (81) 231 0831<br>Email: udayaind@sltnet.lk | udaya.industries@yahoo.com</td>
                </tr>
              </table>
              <br><br>';

$content .= '<table style="border: 1px solid #595959; width:100%; padding: 5px;">
              <tr>
                <td style="text-align:left; width: 18%; padding: 2px;">Customer:</td>
                <td style="text-align:left; width: 32%; padding: 2px;">' . $cfname . '&nbsp;' . $clname . '</td>
                <td style="text-align:left; width: 5%; padding: 2px;"></td>
                <td style="text-align:right; width: 15%; padding: 2px;">Date:</td>
                <td style="text-align:right; width: 30%; padding: 2px;">' . $today . '</td>
              </tr>
              <tr>
                <td style="text-align:left; width: 18%; padding: 2px;">Address:</td>
                <td style="text-align:left; width: 32%; padding: 2px;">' . $chouseno . ', ' . $cstreetone . ', ' . $cstreettwo . ', ' . $ccity . '. ' . $cpcode . '.</td>
                <td style="text-align:left; width: 5%; padding: 2px;"></td>
                <td style="text-align:right; width: 15%; padding: 2px;">Invoice:</td>
                <td style="text-align:right; width: 30%; padding: 2px;">' . $regInvoice . '</td>
              </tr>
              <tr style="padding: 8px;">
                <td style="text-align:left; width: 18%; padding: 2px;">Telephone:</td>
                <td style="text-align:left; width: 32%; padding: 2px;">' . $mobileone . '' . $mobiletwo . '</td>
                <td style="text-align:left; width: 5%; padding: 2px;"></td>
                <td style="text-align:right; width: 15%; padding: 2px;">Cashier:</td>
                <td style="text-align:right; width: 30%; padding: 2px;">' . $loggedusername . '</td>
              </tr>
            </table>
            <br><br>';

$content .= '<table border="0" cellspacing="0" cellpadding="3" style="border: 1px solid #595959; width:100%;">
              <tr style="text-align: center; font-weight: bold">
                  <th width="10%" style="text-align:center;">No</th>
                  <th width="40%" style="text-align:center;">Item Description</th>
                  <th width="20%" style="text-align:center;">Unit Price</th>
                  <th width="10%" style="text-align:center;">Qty</th>
                  <th width="20%" style="text-align:center;">Total Price</th>
              </tr>';

$content .= $tblContent;

$content .= '<br>
              <tr>
                <td width="70%" style="text-align:right; font-weight: bold;">Total Amount</td>
                <td width="30%" style="text-align:right;">Rs. ' . $mastertotal . '</td>
              </tr>
              <tr>
                <td width="70%" style="text-align:right; font-weight: bold;">Discount (%)</td>
                <td width="30%" style="text-align:right;">' . $discount . '.00</td>
              </tr>
              <tr>
                <td width="70%" style="text-align:right; font-weight: bold;">Total Price</td>
                <td width="30%" style="text-align:right;">Rs. ' . $finaltotal . '</td>
              </tr>
            </table>
            <br><br>';

if ($paymentmethod == 'cash') {

  $content .= '<table style="border: 1px solid #595959; width:100%; padding: 5px;">
              <tr>
                <td style="text-align:left; width: 25%; padding: 2px;">Payment Type:</td>
                <td style="text-align:left; width: 25%; padding: 2px;">Cash</td>
                <td style="text-align:left; width: 5%; padding: 2px;"></td>
                <td style="text-align:right; width: 15%; padding: 2px;"></td>
                <td style="text-align:right; width: 30%; padding: 2px;"></td>
              </tr>';
} else if ($paymentmethod == 'card') {

  $content .= '<table style="border: 1px solid #595959; width:100%; padding: 5px;">
              <tr>
                <td style="text-align:left; width: 25%; padding: 2px;">Payment Type:</td>
                <td style="text-align:left; width: 25%; padding: 2px;">Card</td>
                <td style="text-align:right; width: 30%; padding: 2px;">Transaction Receipt :</td>
                <td style="text-align:right; width: 20%; padding: 2px;">' . $transactionreceipt . '</td>
              </tr>';
} else if ($paymentmethod == 'cheque') {
  $content .= '<table style="border: 1px solid #595959; width:100%; padding: 5px;">
                  <tr>
                    <td style="text-align:left; width: 25%; padding: 2px;">Payment Type:</td>
                    <td style="text-align:left; width: 25%; padding: 2px;">Cheque</td>
                    <td style="text-align:right; width: 30%; padding: 2px;">Cheque Number:</td>
                    <td style="text-align:right; width: 20%; padding: 2px;">' . $chequeCode . '</td>
                  </tr>
                  <tr>
                    <td style="text-align:left; width: 30%; padding: 2px;"></td>
                    <td style="text-align:left; width: 20%; padding: 2px;"></td>
                    <td style="text-align:right; width: 30%; padding: 2px;">Cheque Date:</td>
                    <td style="text-align:right; width: 20%; padding: 2px;">' . $chequeDate . '</td>
                  </tr>';
}

if ($specialnotes !== "") {
  $content .= '<tr>
                <td width="25%" style="text-align:left;">Special Notes:</td>
                <td width="75%" style="text-align:left;"><b>***' . $specialnotes . '</b></td>
              </tr>';
} else {
}

$content .= '</table><br><br><br><br><br>';

$content .= '<table style="border: none; width:100%; padding: 5px;">
                <tr>
                  <td style="text-align:center; width: 20%; padding: 2px;">.............</td>
                  <td style="text-align:center; width: 20%; padding: 2px;">.............</td>
                  <td style="text-align:center; width: 20%; padding: 2px;">.............</td>
                  <td style="text-align:center; width: 20%; padding: 2px;">.............</td>
                  <td style="text-align:center; width: 20%; padding: 2px;">.............</td>
                </tr>
                <tr>
                  <td style="text-align:center; width: 20%; padding: 2px;">Prepared By</td>
                  <td style="text-align:center; width: 20%; padding: 2px;">Checked By</td>
                  <td style="text-align:center; width: 20%; padding: 2px;">Approved By</td>
                  <td style="text-align:center; width: 20%; padding: 2px;">Authorized for Issue</td>
                  <td style="text-align:center; width: 20%; padding: 2px;">Customer Signature</td>
                </tr>
              </table>';

$content .= '</div>';

$obj_pdf->writeHTML($content);

$pdf_string = $obj_pdf->Output('' . $pdfname . '.pdf', 'S');

file_put_contents('../../docs/part_invoice/' . $pdfname . '.pdf', $pdf_string);

//----------------------------------------------- ADVICE OF DISPATCH NOTE -------------------------------------------------------------------

$pdf_object = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf_object->SetCreator(PDF_CREATOR);
$pdf_object->SetTitle("UDAYA INDUSTRIES : ADVICE OF DISPATCH");
$pdf_object->SetHeaderData('watt.png', '20', PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf_object->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf_object->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf_object->SetDefaultMonospacedFont('times');
$pdf_object->SetFooterMargin(PDF_MARGIN_FOOTER, 5);
$pdf_object->SetMargins(PDF_MARGIN_LEFT, '8', PDF_MARGIN_RIGHT);
$pdf_object->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf_object->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf_object->setPrintHeader(false);
$pdf_object->setPrintFooter(false);
$pdf_object->SetAutoPageBreak(TRUE, 5);
$pdf_object->SetFont('courier', '', 10);
$pdf_object->AddPage();

$aod_id = getPAODID($regInvoice);

$AOD_DATA = '';

$AOD_DATA = '<div>';

$AOD_DATA .= '<table style="border: none;">
                <tr>
                  <td style="font-weight: bold; text-align:left;"><img src="../../../img/invimg.png"/></td>
                  <td style="font-weight: bold; text-align:center;"></td>
                  <td style="font-weight: bold; text-align:right;"><h1>ADVICE OF DISPATCH</h1></td>
                </tr>
                <tr>
                  <td style="width:100%; font-size: 8px; color: #000; text-align:left;">UDA ALUDENIYA, WELIGALLA, KANDY. 20610.<br>Tel: +94 (81) 231 0086 | +94 (81) 231 0831<br>Email: udayaind@sltnet.lk | udaya.industries@yahoo.com</td>
                </tr>
              </table>
              <br><br>';

$AOD_DATA .= '<table style="border: 1px solid #595959; width:100%; padding: 5px;">
              <tr>
                <td style="text-align:left; width: 18%; padding: 2px;">AOD Ref:</td>
                <td style="text-align:left; width: 32%; padding: 2px;">' . $aod_id . '</td>
                <td style="text-align:left; width: 5%; padding: 2px;"></td>
                <td style="text-align:right; width: 15%; padding: 2px;">Date:</td>
                <td style="text-align:right; width: 30%; padding: 2px;">' . $today . '</td>
              </tr>
              <tr>
                <td style="text-align:left; width: 18%; padding: 2px;">Address:</td>
                <td style="text-align:left; width: 82%; padding: 2px;">' . $chouseno . ', ' . $cstreetone . ', ' . $cstreettwo . ', ' . $ccity . '. ' . $cpcode . '.</td>
              </tr>
            </table>
            <br><br>';

$AOD_DATA .= '<table border="0" cellspacing="0" cellpadding="3" style="border: 1px solid #595959; width:100%;">
                <tr style="text-align: center; font-weight: bold">
                    <th width="20%" style="text-align:center;">Item No</th>
                    <th width="60%" style="text-align:center;">Item Description</th>
                    <th width="20%" style="text-align:center;">Quantity</th>
                </tr>';

$AOD_DATA .= $aodContent;

$content .= '</table><br><br><br><br><br>';

$content .= '<table style="border: none; width:100%; padding: 5px;">
                <tr>
                  <td style="text-align:center; width: 33%; padding: 2px;">..................</td>
                  <td style="text-align:center; width: 33%; padding: 2px;">..................</td>
                  <td style="text-align:center; width: 33%; padding: 2px;">..................</td>
                </tr>
                <tr>
                  <td style="text-align:center; width: 33%; padding: 2px;">Prepared By</td>
                  <td style="text-align:center; width: 33%; padding: 2px;">Recieved By</td>
                  <td style="text-align:center; width: 33%; padding: 2px;">Handovered By</td>
                </tr>
              </table>';

$AOD_DATA .= '</div>';

$nameofPDF = $aod_id . "-" . $regInvoice;

$sendPath = '../../docs/parts_aod/' . $nameofPDF . '.pdf';

$conn = Connection();

$updateQuery = "UPDATE invoice_parts_tbl SET p_aod_pdf_path = '$sendPath' WHERE p_inv_id = '$regInvoice';";

$runQuery = mysqli_query($conn, $updateQuery);

$pdf_object->writeHTML($AOD_DATA);

$pdfnamestring = $pdf_object->Output('' . $nameofPDF . '.pdf', 'S');

file_put_contents('../../docs/parts_aod/' . $nameofPDF . '.pdf', $pdfnamestring);

//----------------------------------------------- GOODS ISSUES ORDER NOTE -------------------------------------------------------------------

$objectofPDF = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$objectofPDF->SetCreator(PDF_CREATOR);
$objectofPDF->SetTitle("UDAYA INDUSTRIES : GOODS ISSUES ORDER");
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

$gio_id = getPGIOID($regInvoice);

$GIO_DATA = '';

$GIO_DATA = '<div>';

$GIO_DATA .= '<table style="border: none;">
                <tr>
                  <td style="font-weight: bold; text-align:left;"><img src="../../../img/invimg.png"/></td>
                  <td style="font-weight: bold; text-align:center;"></td>
                  <td style="font-weight: bold; text-align:right;"><h1>GOODS ISSUES ORDER</h1></td>
                </tr>
                <tr>
                  <td style="width:100%; font-size: 8px; color: #000; text-align:left;">UDA ALUDENIYA, WELIGALLA, KANDY. 20610.<br>Tel: +94 (81) 231 0086 | +94 (81) 231 0831<br>Email: udayaind@sltnet.lk | udaya.industries@yahoo.com</td>
                </tr>
              </table>
              <br><br>';

$GIO_DATA .= '<table style="border: 1px solid #595959; width:100%; padding: 5px;">
              <tr>
                <td style="text-align:left; width: 18%; padding: 2px;">GIN Ref:</td>
                <td style="text-align:left; width: 32%; padding: 2px;">' . $gio_id . '</td>
                <td style="text-align:left; width: 5%; padding: 2px;"></td>
                <td style="text-align:right; width: 15%; padding: 2px;">Date:</td>
                <td style="text-align:right; width: 30%; padding: 2px;">' . $today . '</td>
              </tr>
              <tr>
                <td style="text-align:left; width: 18%; padding: 2px;">Address:</td>
                <td style="text-align:left; width: 82%; padding: 2px;">' . $chouseno . ', ' . $cstreetone . ', ' . $cstreettwo . ', ' . $ccity . '. ' . $cpcode . '.</td>
              </tr>
            </table>
            <br><br>';

$GIO_DATA .= '<table border="0" cellspacing="0" cellpadding="3" style="border: 1px solid #595959; width:100%;">
                <tr style="text-align: center; font-weight: bold">
                    <th width="20%" style="text-align:center;">Item No</th>
                    <th width="60%" style="text-align:center;">Item Description</th>
                    <th width="20%" style="text-align:center;">Quantity</th>
                </tr>';

$GIO_DATA .= $aodContent;

$GIO_DATA .= '</table>';

$GIO_DATA .= '</div>';

$PDFText = $gio_id . "-" . $regInvoice;

$pathtoDB = '../../docs/parts_gio/' . $PDFText . '.pdf';

$newQuery = "UPDATE invoice_parts_tbl SET p_gio_pdf_path = '$pathtoDB' WHERE p_inv_id = '$regInvoice';";

$execQuery = mysqli_query($conn, $newQuery);

$objectofPDF->writeHTML($GIO_DATA);

$stringofPDF = $objectofPDF->Output('' . $PDFText . '.pdf', 'S');

file_put_contents('../../docs/parts_gio/' . $PDFText . '.pdf', $stringofPDF);

echo "<script>window.close();</script>";

?>