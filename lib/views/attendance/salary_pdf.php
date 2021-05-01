<?php
date_default_timezone_set('Asia/Colombo');

require_once('../../inc/tcpdf/tcpdf.php');
include_once('../../functions/attendance.php');

$today = date("Y-m-d h:i:sA");

$empSalID = $_GET['empSalID'];
$employeeID = $_GET['employeeID'];
$employeeName = $_GET['employeeName'];
$employeeNIC = $_GET['employeeNIC'];
$monthandyear = $_GET['monthandyear'];

$empTotWorkhours = $_GET['empTotWorkhours'];

$empWorkHours = $_GET['empWorkHours'];
$empCurrentSal = $_GET['empCurrentSal'];

$empOTHours = $_GET['empOTHours'];
$empOTSalary = $_GET['empOTSalary'];

$FinalWorkSal = $_GET['FinalWorkSal'];
$FinalOTSal = $_GET['FinalOTSal'];
$FinalSalarySum = $_GET['FinalSalarySum'];

$monthandyear = explode("-", $_GET['monthandyear']);

$properdate = $monthandyear[1] . '-' . $monthandyear[0];

$displaymonth = '';

if ($monthandyear[0] == '01') {
    $displaymonth = 'January';
} else if ($monthandyear[0] == '02') {
    $displaymonth = 'February';
} else if ($monthandyear[0] == '03') {
    $displaymonth = 'March';
} else if ($monthandyear[0] == '04') {
    $displaymonth = 'April';
} else if ($monthandyear[0] == '05') {
    $displaymonth = 'May';
} else if ($monthandyear[0] == '06') {
    $displaymonth = 'June';
} else if ($monthandyear[0] == '07') {
    $displaymonth = 'July';
} else if ($monthandyear[0] == '08') {
    $displaymonth = 'August';
} else if ($monthandyear[0] == '09') {
    $displaymonth = 'September';
} else if ($monthandyear[0] == '10') {
    $displaymonth = 'October';
} else if ($monthandyear[0] == '11') {
    $displaymonth = 'November';
} else if ($monthandyear[0] == '12') {
    $displaymonth = 'December';
}

$pdf_object = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf_object->SetCreator(PDF_CREATOR);
$pdf_object->SetTitle("UDAYA INDUSTRIES : SALARY REPORT");
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

$content = '';

$content .= '<div>';

$content .= '<table style="border: none;">
                <tr>
                  <td style="font-weight: bold; text-align:left;"><img src="../../../img/invimg.png"/></td>
                  <td style="font-weight: bold; text-align:center;"></td>
                  <td style="font-weight: bold; text-align:right;"><h1>SALARY REPORT</h1></td>
                </tr>
                <tr>
                  <td style="width:100%; font-size: 8px; color: #000; text-align:left;">UDA ALUDENIYA, WELIGALLA, KANDY. 20610.<br>Tel: +94 (81) 231 0086 | +94 (81) 231 0831<br>Email: udayaind@sltnet.lk | udaya.industries@yahoo.com</td>
                </tr>
              </table>
              <br><br>';

$content .= '<table style="border: 1px solid #595959; width:100%; padding: 5px;">
              <tr>
                <td style="text-align:left; width: 20%; padding: 2px;">Employee Name :</td>
                <td style="text-align:left; width: 30%; padding: 2px;">' . $employeeName . '</td>
                <td style="text-align:left; width: 5%; padding: 2px;"></td>
                <td style="text-align:right; width: 15%; padding: 2px;">Date :</td>
                <td style="text-align:right; width: 30%; padding: 2px;">' . $today . '</td>
              </tr>
              <tr>
                <td style="text-align:left; width: 20%; padding: 2px;">Employee NIC :</td>
                <td style="text-align:left; width: 30%; padding: 2px;">' . $employeeNIC . '</td>
                <td style="text-align:left; width: 5%; padding: 2px;"></td>
                <td style="text-align:right; width: 15%; padding: 2px;">Ref/No :</td>
                <td style="text-align:right; width: 30%; padding: 2px;">' . $empSalID . '</td>
              </tr>
            </table>
            <br><br>';

$content .= '<table style="border: 1px solid #595959; width:100%; padding: 5px;">
                <tr>
                    <td style="text-align:center; padding: 2px;"><b>Salary Sheet for ' . $displaymonth . ', ' . $monthandyear[1] . '</b></td>
                </tr>
            </table>
            <br><br>';

$content .= '<table style="border: 1px solid #595959; width:100%; padding: 5px;">
                <tr>
                    <td style="text-align:left; width: 10%; padding: 2px;"></td>
                    <td style="text-align:left; width: 40%; padding: 2px;">Total Current Work Hours :</td>
                    <td style="text-align:right; width: 30%; padding: 2px;">' . $empWorkHours . ' hour(s)</td>
                    <td style="text-align:left; width: 20%; padding: 2px;"></td>
                </tr>
                <tr>
                    <td style="text-align:left; width: 10%; padding: 2px;"></td>
                    <td style="text-align:left; width: 40%; padding: 2px;">Current Salary :</td>
                    <td style="text-align:right; width: 30%; padding: 2px;">Rs.' . number_format($empCurrentSal) . '.00</td>
                    <td style="text-align:left; width: 20%; padding: 2px;"></td>
                </tr>
                <tr>
                    <td style="text-align:left; width: 10%; padding: 2px;"></td>
                    <td style="text-align:left; width: 40%; padding: 2px;">Total OT Work Hours :</td>
                    <td style="text-align:right; width: 30%; padding: 2px;">' . $empOTHours . ' hour(s)</td>
                    <td style="text-align:left; width: 20%; padding: 2px;"></td>
                </tr>
                <tr>
                    <td style="text-align:left; width: 10%; padding: 2px;"></td>
                    <td style="text-align:left; width: 40%; padding: 2px;">OT Salary :</td>
                    <td style="text-align:right; width: 30%; padding: 2px;">Rs.' . number_format($empOTSalary) . '.00</td>
                    <td style="text-align:left; width: 20%; padding: 2px;"></td>
                </tr>
            </table>
            <br><br>';

$content .= '<table style="border: 1px solid #595959; width:100%; padding: 5px;">
                <tr>
                    <td style="text-align:left; width: 10%; padding: 2px;"></td>
                    <td style="text-align:left; width: 40%; padding: 2px;">Total Hours Worked :</td>
                    <td style="text-align:right; width: 30%; padding: 2px;">' . $empTotWorkhours . ' hour(s)</td>
                    <td style="text-align:left; width: 20%; padding: 2px;"></td>
                </tr>
                <tr>
                    <td style="text-align:left; width: 10%; padding: 2px;"></td>
                    <td style="text-align:left; width: 40%; padding: 2px;">Total Current Salary :</td>
                    <td style="text-align:right; width: 30%; padding: 2px;">Rs. ' . number_format($FinalWorkSal) . '.00</td>
                    <td style="text-align:left; width: 20%; padding: 2px;"></td>
                </tr>
                <tr>
                    <td style="text-align:left; width: 10%; padding: 2px;"></td>
                    <td style="text-align:left; width: 40%; padding: 2px;">Total OT Salary :</td>
                    <td style="text-align:right; width: 30%; padding: 2px;">Rs. ' . number_format($FinalOTSal) . '.00</td>
                    <td style="text-align:left; width: 20%; padding: 2px;"></td>
                </tr>
            </table>
            <br><br>';

$content .= '<table style="border: 1px solid #595959; width:100%; padding: 5px;">
                <tr>
                    <td style="text-align:left; width: 10%; padding: 2px;"></td>
                    <td style="text-align:left; width: 50%; padding: 2px;">Total Salary for  ' . $displaymonth . ', ' . $monthandyear[1] . ' :</td>
                    <td style="text-align:right; width: 20%; padding: 2px;">Rs. ' . number_format($FinalSalarySum) . '.00</td>
                    <td style="text-align:left; width: 20%; padding: 2px;"></td>
                </tr>
            </table>
            <br><br><br><br><br><br>';

$content .= '<table style="border: none; width:100%; padding: 5px;">
                <tr>
                  <td style="text-align:center; width: 33%; padding: 2px;">.....................</td>
                  <td style="text-align:center; width: 33%; padding: 2px;">.....................</td>
                  <td style="text-align:center; width: 33%; padding: 2px;">.....................</td>
                </tr>
                <tr>
                  <td style="text-align:center; width: 33%; padding: 2px;">Managing Director</td>
                  <td style="text-align:center; width: 33%; padding: 2px;">Handed By</td>
                  <td style="text-align:center; width: 33%; padding: 2px;">Employee Signature</td>
                </tr>
              </table>';

$content .= '</div>';

$nameofPDF = $empSalID . "-" . $employeeID;

$sendPath = '../../docs/salary_report/' . $nameofPDF . '.pdf';

$conn = Connection();

addSalaryPDF($empSalID, $sendPath);

$pdf_object->writeHTML($content);

$pdfnamestring = $pdf_object->Output('' . $nameofPDF . '.pdf', 'S');

file_put_contents('../../docs/salary_report/' . $nameofPDF . '.pdf', $pdfnamestring);

echo "<script>window.close();</script>";

?>