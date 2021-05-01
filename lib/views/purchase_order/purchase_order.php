<?php
session_start();

date_default_timezone_set('Asia/Colombo');

require_once('../../inc/tcpdf/tcpdf.php');

include_once('../../functions/db_conn.php');

include_once('../../functions/Id_maker.php');

$conn = Connection();

$username = $_SESSION['userFirstName'] . "&nbsp;" . $_SESSION['userLastName'];

$rqstID = $_GET['rqstID'];

$today = date("dS \of F\, Y");

$distinct_sup = "SELECT DISTINCT rqst_items_tbl.sup_id, supplier_tbl.sup_company_name, supplier_tbl.sup_phone, supplier_tbl.sup_phone_two, supplier_tbl.sup_fax_number, supplier_tbl.sup_address, supplier_tbl.sup_email
                    FROM ((rqst_items_tbl
                    INNER JOIN supplier_tbl
                    ON rqst_items_tbl.sup_id = supplier_tbl.sup_id)
                    INNER JOIN request_tbl
                    ON rqst_items_tbl.rqst_id = request_tbl.rqst_id)
                    WHERE request_tbl.rqst_id = '$rqstID';";

$view_result = mysqli_query($conn, $distinct_sup);

$nor = mysqli_num_rows($view_result);

if ($nor > 0) {

  while ($rec = mysqli_fetch_assoc($view_result)) {

    $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $obj_pdf = $obj_pdf->rollbackTransaction(false);
    $obj_pdf->SetCreator(PDF_CREATOR);
    $obj_pdf->SetTitle("UDAYA INDUSTRIES : PURCHASE ORDERS");
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

    $supID = $rec['sup_id'];
    $supplycompanyname = $rec['sup_company_name'];
    $supplierphone = $rec['sup_phone'];
    $supplierphonetwo = $rec['sup_phone_two'];
    $supplierfax = $rec['sup_fax_number'];
    $suppliermail = $rec['sup_email'];
    $supplieraddress = $rec['sup_address'];

    $tblContent = '';
    $requestername = '';
    $creatorname = '';

    $getItems = "SELECT rawmaterial_tbl.rm_name, rqst_items_tbl.rm_qty, rqst_items_tbl.rm_urgency, rqst_items_tbl.rm_notes, supplier_tbl.sup_id, supplier_tbl.sup_company_name, supplier_tbl.sup_phone, supplier_tbl.sup_phone_two, supplier_tbl.sup_fax_number, supplier_tbl.sup_address, supplier_tbl.sup_email,  emp_tbl.emp_fname, emp_tbl.emp_lname
                  FROM ((((request_tbl
                  INNER JOIN rqst_items_tbl ON request_tbl.rqst_id = rqst_items_tbl.rqst_id)
                  INNER JOIN supplier_tbl ON rqst_items_tbl.sup_id = supplier_tbl.sup_id)
                  INNER JOIN rawmaterial_tbl ON rqst_items_tbl.rm_id = rawmaterial_tbl.rm_id)
                  INNER JOIN emp_tbl ON request_tbl.emp_id = emp_tbl.emp_id)
                  WHERE request_tbl.rqst_id = '$rqstID' && supplier_tbl.sup_id = '$supID';";

    $item_result = mysqli_query($conn, $getItems);

    $rows = mysqli_num_rows($item_result);

    if ($rows > 0) {

      $c = 1;

      while ($record = mysqli_fetch_assoc($item_result)) {

        $requestername = $record['emp_fname'] . '&nbsp;' . $record['emp_lname'];

        if ($record['rm_notes'] == '') {
          $tblContent .= '<tr style="text-align:center;">
                                        <td>#' . $c . '</td>
                                        <td style="text-align:center;">' . $record['rm_name'] . '</td>
                                        <td style="text-align:right;">' . $record['rm_qty'] . ' Kg(s)</td>
                                        <td style="text-align:center;">' . $record['rm_urgency'] . '</td>
                                        <td style="text-align:center;">-</td>
                                    </tr>';
          $c++;
        } else {
          $tblContent .= '<tr style="text-align:center;">
                                        <td>#' . $c . '</td>
                                        <td style="text-align:center;">' . $record['rm_name'] . '</td>
                                        <td style="text-align:right;">' . $record['rm_qty'] . ' Kg(s)</td>
                                        <td style="text-align:center;">' . $record['rm_urgency'] . '</td>
                                        <td style="text-align:center;">' . $record['rm_notes'] . '</td>
                                    </tr>';
          $c++;
        }
      }
    }

    $po_id = Auto_id("po_id", "purchase_order_tbl", "PCO");

    $getusername = "SELECT emp_tbl.emp_fname, emp_tbl.emp_lname
                        FROM ((user_tbl
                        INNER JOIN emp_tbl ON user_tbl.emp_id = emp_tbl.emp_id)
                        INNER JOIN request_tbl ON request_tbl.user_id = user_tbl.user_id)
                        WHERE request_tbl.rqst_id = '$rqstID';";

    $nameres = mysqli_query($conn, $getusername);

    $nor = mysqli_num_rows($nameres);

    if ($nor > 0) {

      while ($rec = mysqli_fetch_assoc($nameres)) {

        $creatorname = $rec['emp_fname'] . ' ' . $rec['emp_lname'];
      }
    } else {
    }

    $content = '';

    $content = '<div>';

    $content .= '<table style="border: none;">
                <tr>
                  <td style="font-weight: bold; text-align:left;"><img src="../../../img/invimg.png"/></td>
                  <td style="font-weight: bold; text-align:center;"></td>
                  <td style="font-weight: bold; text-align:right;"><h1>PURCHASE ORDER</h1></td>
                </tr>
                <tr>
                  <td style="width:100%; font-size: 8px; color: #000; text-align:left;">UDA ALUDENIYA, WELIGALLA, KANDY. 20610.<br>Tel: +94 (81) 231 0086 | +94 (81) 231 0831<br>Email: udayaind@sltnet.lk | udaya.industries@yahoo.com</td>
                </tr>
              </table>
              <br><br><br><br>';

    $content .= '<table style="border: 1px solid #8c8c8c; width:100%; padding: 7px;">
                  <tr>
                    <td style="text-align:left; width: 18%; padding: 2px;font-weight: bold;">Supplier:</td>
                    <td style="text-align:left; width: 32%; padding: 2px;">' . $supplycompanyname . '</td>
                    <td style="text-align:left; width: 5%; padding: 2px;"></td>
                    <td style="text-align:right; width: 15%; padding: 2px;font-weight: bold;">Date:</td>
                    <td style="text-align:right; width: 30%; padding: 2px;">' . $today . '</td>
                  </tr>
                  <tr>
                    <td style="text-align:left; width: 18%; padding: 2px;font-weight: bold;">Address:</td>
                    <td style="text-align:left; width: 32%; padding: 2px;">' . $supplieraddress . '.</td>
                    <td style="text-align:left; width: 5%; padding: 2px;"></td>
                    <td style="text-align:right; width: 15%; padding: 2px;font-weight: bold;">PO Ref:</td>
                    <td style="text-align:right; width: 30%; padding: 2px;">' . $po_id . '</td>
                  </tr>
                  <tr style="padding: 8px;">
                    <td style="text-align:left; width: 18%; padding: 2px;font-weight: bold;">Telephone:</td>
                    <td style="text-align:left; width: 32%; padding: 2px;">' . $supplierphone . '<br>' . $supplierphonetwo . '<br>' . $supplierfax . '</td>
                    <td style="text-align:left; width: 5%; padding: 2px;"></td>
                    <td style="text-align:right; width: 15%; padding: 2px;font-weight: bold;">Created By:</td>
                    <td style="text-align:right; width: 30%; padding: 2px;">' . $creatorname . '</td>
                  </tr>
                </table>
                <br><br>';

    $content .= '<table border="0" cellspacing="0" cellpadding="3" style="border: 1px solid #8c8c8c; width:100%;">
                  <tr style="text-align: center; font-weight: bold;">
                      <th width="10%" style="text-align:center;">Item No</th>
                      <th width="40%" style="text-align:center;">Material Description</th>
                      <th width="20%" style="text-align:center;">Quantity</th>
                      <th width="10%" style="text-align:center;">Urgency</th>
                      <th width="20%" style="text-align:center;">Additional Notes</th>
                  </tr>';

    $content .= $tblContent;

    $content .= '</table><br><br><br><br><br>';

    $content .= '<table style="border: none; width:100%; padding: 7px;">
                  <tr>
                    <td style="text-align:center; width: 25%; padding: 2px;">.............</td>
                    <td style="text-align:center; width: 25%; padding: 2px;">.............</td>
                    <td style="text-align:center; width: 25%; padding: 2px;">.............</td>
                    <td style="text-align:center; width: 25%; padding: 2px;">.............</td>
                  </tr>
                  <tr>
                    <td style="text-align:center; width: 25%; padding: 2px;">Prepared By</td>
                    <td style="text-align:center; width: 25%; padding: 2px;">Checked By</td>
                    <td style="text-align:center; width: 25%; padding: 2px;">Approved By</td>
                    <td style="text-align:center; width: 25%; padding: 2px;">Authorized for Issue</td>
                  </tr>
                </table>';

    $content .= '</div>';

    $insertSQL = "INSERT INTO purchase_order_tbl(po_id, rqst_id, sup_id, po_form_status, po_status)
                        VALUES ('$po_id','$rqstID','$supID','Pending',1)";

    $sql_result = mysqli_query($conn, $insertSQL);

    $pdfname = $po_id . '-' . $rqstID;

    $obj_pdf->writeHTML($content);

    $pdf_string = $obj_pdf->Output('' . $pdfname . '.pdf', 'S');

    file_put_contents('../../docs/purchase_orders/' . $pdfname . '.pdf', $pdf_string);

    $realpath = '../../docs/purchase_orders/' . $pdfname . '.pdf';

    $updatePathSQL = "UPDATE purchase_order_tbl SET po_pdf_path = '$realpath' WHERE po_id = '$po_id';";

    $update_result = mysqli_query($conn, $updatePathSQL);

    if ($update_result > 0) {
      echo "<script>window.close();</script>";
    } else {
      return "Error, Try again !!";
    }
  }
}
?>