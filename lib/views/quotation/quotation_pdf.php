<?php
date_default_timezone_set('Asia/Colombo');

require_once('../../inc/tcpdf/tcpdf.php');
include_once('../../functions/customer.php');
include_once('../../functions/quotation.php');

$quotename = date("j-m-Y-H-i");

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
$itemcode = '';
$prodname = '';
$capacity = '';
$motorocapacity = '';
$motorspeed = '';
$currentphase = '';
$unitprice = '';
$unpriceonly = '';
$qty = '';
$totalprice = '';
$totpriceonly = '';
$qwarranty = '';
$motorguarantee = '';
$qvalidity = '';
$qdelivery = '';
$qpayment = '';
$specialnotes = '';
$mastertotal = '';
$tbl = '';
$tblContent = '';
$pdfname = '';
$c = 1;
$quote_description = '';
$pathsend = '';

$x = '';
$y = '';
$z = '';


$today = date("jS \of F\, Y");

$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$obj_pdf->SetTitle("Generate HTML Table Data To PDF From MySQL Database Using TCPDF In PHP");
$obj_pdf->SetHeaderData('watt.png', '20', PDF_HEADER_TITLE, PDF_HEADER_STRING);
$obj_pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->SetDefaultMonospacedFont('times');
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER, 25);
$obj_pdf->SetMargins(PDF_MARGIN_LEFT, '58', PDF_MARGIN_RIGHT);
$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$obj_pdf->SetFooterMargin(25);
$obj_pdf->setPrintHeader(false);
$obj_pdf->setPrintFooter(false);
$obj_pdf->SetAutoPageBreak(TRUE, 32);
$obj_pdf->SetFont('times', '', 11);
$obj_pdf->AddPage();

if (isset($_GET["firstname"])) {

  $cfname      = $_GET["firstname"];
  $clname      = $_GET["lastname"];
  $cmail       = $_GET["email"];
  $ccode1      = $_GET["code_phoneone"];
  $ctel1       = $_GET["telone"];
  $ccode2      = $_GET["code_phonetwo"];
  $ctel2       = $_GET["teltwo"];
  $chouseno    = $_GET["houseno"];
  $cstreetone  = $_GET["streetone"];
  $cstreettwo  = $_GET["streettwo"];
  $ccity       = $_GET["city"];
  $cpcode      = $_GET["postalcode"];

  $tbl         = $_GET["ProdListTbl"];

  $thistotal = $_GET["master_total"];
  $mastertotal = number_format($thistotal, 2);

  $qwarranty      = $_GET["guaranteeperiod"];;
  $qmotorwarranty = $_GET["motorguarantee"];;
  $qvalidity      = $_GET["quotevalidity"];
  $qdelivery      = $_GET["freedelivery"];
  $qpayment       = $_GET["paymentmethod"];
  $qspecialnotes  = $_GET["specialnotes"];;
}

$tbl =  json_decode($tbl);

foreach ($tbl as $row) {

  $itemcode       = $row->itemcode;

  $prodname       = $row->prodname;

  $capacity       = $row->capacity;

  $motorocapacity = $row->motorocapacity;

  if ($motorocapacity == "-") {
    $x = NULL;
  } else if ($motorocapacity == "") {
    $motorocapacity = NULL;
  } else {
    $motorocapacity = $motorocapacity . "&nbsp;E/Motor";
    $x = "<li>" . $motorocapacity . "</li>";
  }

  $motorspeed     = $row->motorspeed;

  if ($motorspeed == "-") {
    $y = NULL;
  } else if ($motorspeed == "") {
    $motorspeed = NULL;
  } else {
    $y = "<li>" . $motorspeed . "</li>";
  }

  $currentphase   = $row->currentphase;

  if ($currentphase == "-") {
    $z = NULL;
  } else if ($currentphase == "") {
    $currentphase = NULL;
  } else {
    $z = "<li>" . $currentphase . "</li>";
  }

  $unitprice      = $row->unitprice;
  $unpriceonly    = explode(" ", $unitprice)[1];
  $finalunitprice = number_format($unpriceonly, 2);

  $qty            = $row->qty;

  $totalprice     = $row->totalprice;
  $totpriceonly   = explode(" ", $totalprice)[1];
  $finaltotalprice = number_format($totpriceonly, 2);

  $quote_description = $quote_description .= '[' . $itemcode . '] ' . $prodname . ' / ';

  $tblContent .= '<tr style="text-align:center;">
                    <td>' . $c . '</td>
                    <td style="text-align:center;">' . $prodname . '</td>
                    <td>
                      <ul>
                        <li>' . $capacity . '</li>
                        ' . $x . '
                        ' . $y . '
                        ' . $z . '
                      </ul>
                    </td>
                    <td style="text-align:right;">Rs. ' . $finalunitprice . '</td>
                    <td style="text-align:center;">' . $qty . '</td>
                    <td style="text-align:right;">Rs. ' . $finaltotalprice . '</td>
                  </tr>';

  $c++;

  $motorocapacity = '';
  $motorspeed = '';
  $currentphase = '';
}

$theuserID = cusRegwithID($cfname, $clname, $cmail, $ccode1, $ctel1, $ccode2, $ctel2, $chouseno, $cstreetone, $cstreettwo, $ccity, $cpcode);

$regQuote = createQuotation($theuserID, $pathsend, date("d-m-Y"), $quote_description);

$pdfname = $regQuote . "-" . $theuserID;

$pathsend = '../../docs/quotation/' . $pdfname . '.pdf';

updateQuotationPath($regQuote, $pathsend);

if ($cfname !== '') {
  $cfname      = $cfname .= "&nbsp;";
} else if ($cfname == 0) {
  $cfname = NULL;
}

if ($clname !== '') {
  $clname      = $clname .= "<br>";
} else if ($clname == 0) {
  $clname = "<br>";
} else if ($clname == '') {
  $clname = "<br>";
} else if ($clname == ' ') {
  $clname = "<br>";
}

//------------------------------------------

if ($chouseno !== '') {
  $chouseno    = $chouseno .= ",<br>";
} else if ($chouseno == 0) {
  $chouseno    = NULL;
}

if ($cstreetone !== '') {
  $cstreetone  = $cstreetone .= ",&nbsp;";
} else if ($cstreetone == 0) {
  $cstreetone = NULL;
}

if ($cstreettwo !== '') {
  $cstreettwo  = $cstreettwo .= ",<br>";
} else if ($cstreettwo == 0) {
  $cstreettwo  = NULL;
}

if ($ccity !== '') {
  $ccity       = $ccity .= ".<br>";
} else if ($ccity == 0) {
  $ccity = NULL;
}

if ($cpcode !== '') {
  $cpcode      = $cpcode .= "<br>";
} else if ($cpcode == 0) {
  $cpcode = NULL;
}

if ($ctel1 !== '') {
  $mobileone       = $ccode1 . "&nbsp;" . $ctel1;
} else if ($ctel1 == 0) {
  $mobileone = NULL;
}

if ($ctel2 !== '') {
  $mobiletwo       = "&nbsp;/&nbsp;" . $ccode2 . "&nbsp;" . $ctel2;
} else if ($ctel2 == 0) {
  $mobiletwo = "<br>";
}

//-----------------------------------------------

if ($cmail !== '') {
  $cmail = "<br>" . $cmail;
} else if ($cmail == 0) {
  $cmail = NULL;
}

$content = '';

$content .= '
      <div>
        <table style="border: none;">
          <tr>';


$content .= '<td>' . $cfname . '' . $clname . '' . $chouseno . '' . $cstreetone . '' . $cstreettwo . '' . $ccity . '' . $cpcode . '' . $mobileone . '' . $mobiletwo . '' . $cmail . '</td>';

$content .= '<td style="text-align: right;">
              Date of Issue:&nbsp;' . $today . '.<br><br><br>
              Ref/No:&nbsp;<b>' . $regQuote . '</b>
             </td>
          </tr>
        </table>
        <br><br>
        <table style="border: none; margin-left:1px;">
          <tr>
            <td style="text-align:left;">Dear Sir/Ma\'am,</td>
          </tr>
          <tr>
            <td style="text-align:center; text-decoration: underline; font-weight: bold;"><u>QUOTATION FOR REQUESTED PRODUCTS</u></td>
          </tr>
        </table>
        <br><br>
        <table border="1" cellspacing="0" cellpadding="3" style="margin-top: 20px;">
          <tr style="text-align: center; font-weight: bold">
            <th width="12%" style="text-align:center;">Item No</th>
            <th width="22%" style="text-align:center;">Name</th>
            <th width="23%" style="text-align:center;">Specifications</th>
            <th width="19%" style="text-align:center;">Unit Price</th>
            <th width="7%" style="text-align:center;">Qty</th>
            <th width="17%" style="text-align:center;">Total Price</th>
          </tr>';

$content .= $tblContent;

$content .= '
          <tr>
            <td width="83%" style="text-align:right; font-weight: bold;">Total Price</td>
            <td width="17%" style="text-align:right;">Rs. ' . $mastertotal . '</td>
          </tr>
        </table>';

$content .= '
        <br><br>
        <table>    
          <tr>
            <td>We hope that this price meets with your expectations and we look forward to hearing from you for your approval. If you require any further assistance with this quotation, please feel free to contact us.</td>
          </tr>
        </table>
        <br><br>
        <table>
          <tr>
            <td style="text-decoration: underline;"><strong>TERMS & CONDITIONS</strong></td>
          </tr>
        </table>
        <br>
        <table>';


if ($qwarranty == "nowar") {
  $content .= '<tr>
                        <td width="30%" style="text-align:left;">Guarantee Period</td>
                        <td width="70%">:&nbsp;&nbsp;No warranty available</td>
                      </tr>';
} else if ($qwarranty == "oneyr") {
  $content .= '<tr>
                        <td width="30%" style="text-align:left;">Guarantee Period</td>
                        <td width="70%">:&nbsp;&nbsp;01-year warranty against manufacturing defects</td>
                      </tr>';
} else if ($qwarranty == "oneyrexm") {
  $content .= '<tr>
                        <td width="30%" style="text-align:left;">Guarantee Period</td>
                        <td width="70%">:&nbsp;&nbsp;01-year warranty against manufacturing defects (Excluding E/Motor)</td>
                      </tr>';
} else if ($qwarranty == "twoyr") {
  $content .= '<tr>
                        <td width="30%" style="text-align:left;">Guarantee Period</td>
                        <td width="70%">:&nbsp;&nbsp;02-year warranty against manufacturing defects</td>
                      </tr>';
} else {
  $content .= '<tr>
                        <td width="30%" style="text-align:left;">Guarantee Period</td>
                        <td width="70%">:&nbsp;&nbsp;02-year warranty against manufacturing defects (Excluding E/Motor)</td>
                      </tr>';
}

if ($motorguarantee == "threem") {
  $content .= '<tr>
                        <td width="30%" style="text-align:left;">Motor Guarantee</td>
                        <td width="70%">:&nbsp;&nbsp;03-months warranty</td>
                      </tr>';
} else if ($motorguarantee == "sixm") {
  $content .= '<tr>
                        <td width="30%" style="text-align:left;">Motor Guarantee</td>
                        <td width="70%">:&nbsp;&nbsp;06-months warranty</td>
                      </tr>';
} else if ($motorguarantee == "ninem") {
  $content .= '<tr>
                        <td width="30%" style="text-align:left;">Motor Guarantee</td>
                        <td width="70%">:&nbsp;&nbsp;09-months warranty</td>
                      </tr>';
} else if ($motorguarantee == "oneymw") {
  $content .= '<tr>
                        <td width="30%" style="text-align:left;">Motor Guarantee</td>
                        <td width="70%">:&nbsp;&nbsp;01-year warranty</td>
                      </tr>';
} else {
}

if ($qvalidity == "30") {

  $content .= '<tr>
                          <td width="30%" style="text-align:left;">Validity</td>
                          <td width="70%">:&nbsp;&nbsp;30 days</td>
                        </tr>';
} else if ($qvalidity == "60") {

  $content .= '<tr>
                          <td width="30%" style="text-align:left;">Validity</td>
                          <td width="70%">:&nbsp;&nbsp;60 days</td>
                        </tr>';
} else {

  $content .= '<tr>
                          <td width="30%" style="text-align:left;">Validity</td>
                          <td width="70%">:&nbsp;&nbsp;90 days</td>
                        </tr>';
}


$content .= '<tr>
                        <td width="30%" style="text-align:left;">Make</td>
                        <td width="70%">:&nbsp;&nbsp;“UDAYA INDUSTRIES”, Sri Lanka.</td>
                      </tr>
                      <tr>
                        <td width="30%" style="text-align:left;">Availability of spares</td>
                        <td width="70%">:&nbsp;&nbsp;At our premises.</td>
                      </tr>
                      <tr>
                        <td width="30%" style="text-align:left;">Machine Standards</td>
                        <td width="70%">:&nbsp;&nbsp;<b>ISO 9001</b>.</td>
                      </tr>';

if ($qpayment == "prior") {
  $content .= '<tr>
                          <td width="30%" style="text-align:left;">Payment</td>
                          <td width="70%">:&nbsp;&nbsp;Full payment prior to delivery.</td>
                        </tr>';
} else if ($qpayment == "30pay") {
  $content .= '<tr>
                          <td width="30%" style="text-align:left;">Payment</td>
                          <td width="70%">:&nbsp;&nbsp;30% advanced payment & remaining balance on delivery.</td>
                        </tr>';
} else if ($qpayment == "50pay") {
  $content .= '<tr>
                          <td width="30%" style="text-align:left;">Payment</td>
                          <td width="70%">:&nbsp;&nbsp;50% advanced payments & remaining balance upon delivery.</td>
                        </tr>';
} else if ($qpayment == "70pay") {
  $content .= '<tr>
                          <td width="30%" style="text-align:left;">Payment</td>
                          <td width="70%">:&nbsp;&nbsp;70% advanced payment & remaining balance on delivery</td>
                        </tr>';
} else {
  $content .= '<tr>
                          <td width="30%" style="text-align:left;">Payment</td>
                          <td width="70%">:&nbsp;&nbsp;Full payment on delivery</td>
                        </tr>';
}

if ($qdelivery !== "undefined") {
  $content .= '<tr>
                          <td width="30%" style="text-align:left;">Delivery Options</td>
                          <td width="70%">:&nbsp;&nbsp;' . $qdelivery . '</td>
                        </tr>';
} else {
}

if ($specialnotes == '') {
} else {
  $content .= '<tr>
                          <td width="30%" style="text-align:left;">Special Notes</td>
                          <td width="70%">:&nbsp;&nbsp;' . $specialnotes . '</td>
                        </tr>';
}

$content .= '</table>
            <br><br>
            <table style="border: none;">
              <tr>
                <td><img src="../../../img/pdf_footer.PNG"/></td>
              </tr>
            </table>
          </div>';

$obj_pdf->writeHTML($content);

$pdf_string = $obj_pdf->Output('' . $pdfname . '.pdf', 'S');

file_put_contents('../../docs/quotation/' . $pdfname . '.pdf', $pdf_string);

echo "<script>window.close();</script>";

?>