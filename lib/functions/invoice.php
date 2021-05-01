<?php
include_once('db_conn.php');

include_once('id_maker.php');

function createInvoice($cusID, $empID, $invoiceTotal, $discount, $finalprice, $paymentID, $date, $pdfpath)
{
    $conn = Connection();

    $id = Auto_id("inv_id", "invoice_tbl", "INV");

    $createSQL = "INSERT INTO invoice_tbl (inv_id, cus_id, user_id, inv_total_price, inv_discount, inv_final_price, payment_id, inv_date, inv_pdf_path, inv_status)
                    VALUES ('$id','$cusID','$empID','$invoiceTotal','$discount','$finalprice','$paymentID','$date','../../$pdfpath',1);";

    $searchQuery = mysqli_query($conn, $createSQL);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    if ($searchQuery > 0) {
        return $id;
    } else {
        return "Error, Try again !!";
    }
}

function createPartInvoice($cusID, $empID, $invoiceTotal, $discount, $finalprice, $paymentID, $date, $pdfpath)
{
    $conn = Connection();

    $id = Auto_id("p_inv_id", "invoice_parts_tbl", "PIV");

    $createSQL = "INSERT INTO invoice_parts_tbl (p_inv_id, cus_id, user_id, p_inv_total_price, p_inv_discount, p_inv_final_price, payment_id, p_inv_date, p_inv_pdf_path, p_inv_status)
                    VALUES ('$id','$cusID','$empID','$invoiceTotal','$discount','$finalprice','$paymentID','$date','../../$pdfpath',1);";

    $searchQuery = mysqli_query($conn, $createSQL);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    if ($searchQuery > 0) {
        return $id;
    } else {
        return "Error, Try again !!";
    }
}

function invoiceItems($invoiceID, $prodID, $unitprice, $qty, $totalprice)
{
    $conn = Connection();

    //create new invoice items along with its details

    $id = Auto_id("init_id", "invoice_items_tbl", "IVI");

    $createSQL = "INSERT INTO invoice_items_tbl (init_id, inv_id, prod_id, prod_unit_price, prod_qty, prod_total_price, init_status)
                    VALUES ('$id','$invoiceID','$prodID','$unitprice','$qty','$totalprice',1);";

    $searchQuery = mysqli_query($conn, $createSQL);

    //reduce relevant stocks with every purchase

    $reduceStockSQL = "UPDATE stock_prod_tbl SET prod_qty = prod_qty-$qty WHERE prod_id = '$prodID';";

    $stockQuery = mysqli_query($conn, $reduceStockSQL);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    if ($searchQuery > 0 && $stockQuery > 0) {
        return ("success");
    } else {
        return "Error, Try again !!";
    }
}

function invoicePartItems($invoiceID, $partID, $unitprice, $qty, $totalprice)
{
    $conn = Connection();

    //create new invoice items along with its details

    $id = Auto_id("pinit_id", "invoice_parts_items_tbl", "PVI");

    $createSQL = "INSERT INTO invoice_parts_items_tbl (pinit_id, p_inv_id, part_id, part_unit_price, part_qty, part_total_price, pinit_status)
                  VALUES ('$id','$invoiceID','$partID','$unitprice','$qty','$totalprice',1);";

    $searchQuery = mysqli_query($conn, $createSQL);

    //reduce relevant stocks with every purchase

    $reduceStockSQL = "UPDATE stock_part_tbl SET part_qty = part_qty - $qty WHERE part_id = '$partID';";

    $stockQuery = mysqli_query($conn, $reduceStockSQL);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    if ($searchQuery > 0 && $stockQuery > 0) {
        return ("success");
    } else {
        return "Error, Try again !!";
    }
}

function addPayment($type, $amount, $cardreceipt, $checkqueno, $chequeDate)
{
    $conn = Connection();

    $id = Auto_id("payment_id", "payment_tbl", "PAY");

    $createSQL = "INSERT INTO payment_tbl (payment_id, payment_type, payment_amount, payment_cardreceipt, payment_chequeNo, payment_chequeDate, payment_status)
                    VALUES ('$id','$type','$amount','$cardreceipt','$checkqueno','$chequeDate',1);";

    $searchQuery = mysqli_query($conn, $createSQL);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    if ($searchQuery > 0) {
        return ($id);
    } else {
        return "Error, Try again !!";
    }
}

function updateInvoicePDF($id, $path)
{

    $conn = Connection();

    $updateSQL = "UPDATE invoice_tbl SET inv_pdf_path = '$path' WHERE inv_id = '$id';";

    $sql_result = mysqli_query($conn, $updateSQL);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    if ($sql_result > 0) {
        return ("success");
    } else {
        return false;
    }
}

function updatePartInvoicePDF($id, $path)
{

    $conn = Connection();

    $updateSQL = "UPDATE invoice_parts_tbl SET p_inv_pdf_path = '$path' WHERE p_inv_id = '$id';";

    $sql_result = mysqli_query($conn, $updateSQL);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    if ($sql_result > 0) {
        return ("success");
    } else {
        return false;
    }
}

function prodSearchInvoice($search)
{
    $conn = Connection();

    if ($search == '') {
        $search = ' ';
    }

    $searchSql = "SELECT *
                  FROM product_tbl 
                  WHERE prod_id  LIKE '%$search%' OR
                    prod_name LIKE '%$search%' OR
                    prod_code LIKE '%$search%' OR
                    prod_description LIKE '%$search%' OR
                    prod_capacity LIKE '%$search%' OR
                    prod_motor_capacity LIKE '%$search%' OR
                    prod_motor_speed LIKE '%$search%' OR
                    prod_phase LIKE '%$search%';";

    $searchQuery = mysqli_query($conn, $searchSql);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $nor = mysqli_num_rows($searchQuery);

    if ($nor > 0) {

        while ($rec = mysqli_fetch_assoc($searchQuery)) {

            echo ("<div style='display: inline-block; margin-top:5px; margin-left:10px; margin-bottom: 5px; width: 270px; text-align:center;'>
                        <div class='card' style='width:260px; min-height: 400px;'>
                            <h6 class='card-title'>" . $rec["prod_code"] . "</h6>
                            <h6 class='card-title'>" . $rec["prod_name"] . "</h6>
                             <div class='row'>
                                <div class='col-md-2'></div>
                                <div class='col-md-8'>
                                    <img id='zoom' style='width:100%;' src='" . $rec["prod_img_path"] . "' alt=''>
                                </div>
                                <div class='col-md-2'></div>
                             </div>
                             <div class='card-body'>
                                 <p class='card-text'>" . $rec["prod_motor_capacity"] . " E/Motor</br>" . $rec["prod_phase"] . " Current</br>Rs. " . $rec["prod_unit_price"] . ".00</p>
                             </div>
                             <div class='row'>
                                <div class='col-md-2'></div>
                                <div class='col-md-8'>
                                    <div class='form-group'>
                                        <div class='input-group mb-3'>
                                            <div class='input-group-prepend'>
                                                <button type='button' class='btn btn-qtyremove btn-light btn-sm' id='REM" . $rec["prod_id"] . "' style='border: 1px solid #d6d6d6; width:100%;'>
                                                <i class='fas fa-minus'></i>
                                                </button>
                                            </div>
                                            <input type='number' style='text-align:center;' name='TXT" . $rec["prod_id"] . "' id='TXT" . $rec["prod_id"] . "' class='form-control' value='1' disabled>
                                            <div class='input-group-append'>
                                                <button type='button' class='btn btn-qtyadd btn-light btn-sm' id='ADD" . $rec["prod_id"] . "' style='border: 1px solid #d6d6d6; width:100%;'>
                                                <i class='fas fa-plus'></i>
                                                </button>
                                            </div>
                                        </div>
                                        <p id='MAXQTY" . $rec["prod_id"] . "' style='width:100%; color:red; display: none;'><i class='far fa-times-circle'></i></br>Minimum QTY reached!<p>
                                    </div>
                                </div>
                                <div class='col-md-2'></div>
                             </div>
                             <ul class='list-group list-group-flush'>
                                 <div class='form-group'>
                                    <button type='button' style='width:100%;' id='" . $rec["prod_id"] . "' class='btn btn-selectprod btn-info btn-sm'><i class='fas fa-plus'></i>&nbsp;&nbsp;Add to Invoice</button>
                                </div>
                             </ul>
                         </div>
                    </div>");
        }
    } else {
        echo ("No record found!");
    }
};

function partSearchInvoice($search)
{
    $conn = Connection();

    if ($search == '') {
        $search = ' ';
    }

    $searchSql = "SELECT *
                  FROM parts_tbl 
                  WHERE part_id  LIKE '%$search%' OR
                    part_code LIKE '%$search%' OR
                    part_name LIKE '%$search%' OR
                    prod_id LIKE '%$search%' OR
                    part_weight LIKE '%$search%' OR
                    part_desc LIKE '%$search%' OR
                    part_unit_price LIKE '%$search%' OR
                    part_reorder_level LIKE '%$search%';";

    $searchQuery = mysqli_query($conn, $searchSql);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $nor = mysqli_num_rows($searchQuery);

    if ($nor > 0) {

        while ($rec = mysqli_fetch_assoc($searchQuery)) {

            echo ("<div style='display: inline-block; margin-top:5px; margin-left:10px; margin-bottom: 5px; width: 270px; text-align:center;'>
                        <div class='card' style='width:260px; min-height: 400px;'>
                            <h6 class='card-title'>" . $rec["part_code"] . "</h6>
                            <h6 class='card-title'>" . $rec["part_name"] . "</h6>
                             <div class='row'>
                                <div class='col-md-2'></div>
                                <div class='col-md-8'>
                                    <img id='zoom' style='width:100%;' src='" . $rec["part_img_path"] . "' alt=''>
                                </div>
                                <div class='col-md-2'></div>
                             </div>
                             <div class='card-body'>
                                 <p class='card-text'>" . $rec["part_weight"] . $rec["part_w_unit"] . "</br>Rs. " . $rec["part_unit_price"] . ".00</p>
                             </div>
                             <div class='row'>
                                <div class='col-md-2'></div>
                                <div class='col-md-8'>
                                    <div class='form-group'>
                                        <div class='input-group mb-3'>
                                            <div class='input-group-prepend'>
                                                <button type='button' class='btn btn-qtyremove btn-light btn-sm' id='REM" . $rec["part_id"] . "' style='border: 1px solid #d6d6d6; width:100%;'>
                                                <i class='fas fa-minus'></i>
                                                </button>
                                            </div>
                                            <input type='number' style='text-align:center;' name='TXT" . $rec["part_id"] . "' id='TXT" . $rec["part_id"] . "' class='form-control' value='1' disabled>
                                            <div class='input-group-append'>
                                                <button type='button' class='btn btn-qtyadd btn-light btn-sm' id='ADD" . $rec["part_id"] . "' style='border: 1px solid #d6d6d6; width:100%;'>
                                                <i class='fas fa-plus'></i>
                                                </button>
                                            </div>
                                        </div>
                                        <p id='MAXQTY" . $rec["part_id"] . "' style='width:100%; color:red; display: none;'><i class='far fa-times-circle'></i></br>Minimum QTY reached!<p>
                                    </div>
                                </div>
                                <div class='col-md-2'></div>
                             </div>
                             <ul class='list-group list-group-flush'>
                                 <div class='form-group'>
                                    <button type='button' style='width:100%;' id='" . $rec["part_id"] . "' class='btn btn-selectprod btn-info btn-sm'><i class='fas fa-plus'></i>&nbsp;&nbsp;Add to Invoice</button>
                                </div>
                             </ul>
                         </div>
                    </div>");
        }
    } else {
        echo ("No record found!");
    }
};

function PartsInvoiceList()
{

    $conn = Connection();

    $view_sql = "SELECT invoice_parts_tbl.p_inv_id, invoice_parts_tbl.p_inv_date,
                    cus_tbl.cus_first_name, cus_tbl.cus_last_name,
                    cus_tbl.cus_email, cus_tbl.cus_code_phoneone,
                    cus_tbl.cus_phone_one,  cus_tbl.cus_houseno,
                    cus_tbl.cus_street_one, cus_tbl.cus_street_two,
                    cus_tbl.cus_city, cus_tbl.cus_postal_code,
                    invoice_parts_tbl.p_inv_total_price, invoice_parts_tbl.p_inv_discount,
                    invoice_parts_tbl.p_inv_final_price
                    FROM invoice_parts_tbl
                    INNER JOIN cus_tbl
                    ON invoice_parts_tbl.cus_id = cus_tbl.cus_id
                    WHERE invoice_parts_tbl.p_inv_status = 1;";

    $view_result = mysqli_query($conn, $view_sql);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $nor = mysqli_num_rows($view_result);

    if ($nor > 0) {

        while ($rec = mysqli_fetch_assoc($view_result)) {

            echo ("<td style='text-align:center;'>" . $rec['p_inv_id'] . "</td>");

            echo ("<td style='text-align:center;'>" . $rec['p_inv_date'] . "</td>");

            $customerdetails = '';

            if ($rec['cus_first_name'] !== '') {
                $customerdetails .= $rec['cus_first_name'];
            } else {
            }

            if ($rec['cus_last_name'] !== '') {
                $customerdetails .= ' ' . $rec['cus_last_name'];
            } else {
            }

            if ($rec['cus_houseno'] !== '') {
                $customerdetails .= ',' . '<br>' . $rec['cus_houseno'];
            } else {
            }

            if ($rec['cus_street_one'] !== '') {
                $customerdetails .= ', ' . $rec['cus_street_one'];
            } else {
            }

            if ($rec['cus_street_two'] !== '') {
                $customerdetails .= ', ' . $rec['cus_street_two'];
            } else {
            }

            if ($rec['cus_city'] !== '') {
                $customerdetails .= ', ' . $rec['cus_city'];
            } else {
            }

            if ($rec['cus_postal_code'] !== '') {
                $customerdetails .= '. ' . $rec['cus_postal_code'] . '<br>';
            } else {
                $customerdetails .= '.' . '<br>';
            }

            if ($rec['cus_email'] !== '') {
                $customerdetails .= $rec['cus_email'];
            } else {
            }

            if ($rec['cus_phone_one'] !== '') {
                $customerdetails .= '<br>' . $rec['cus_code_phoneone'] . ' ' . $rec['cus_phone_one'];
            } else {
            }

            echo ("<td>" . $customerdetails . "</td>");

            $totprice = $rec['p_inv_total_price'];
            $totproperprice = number_format($totprice, 2);
            $totalprice = 'Rs. ' . $totproperprice;

            echo ("<td style='text-align:right;'>" . $totalprice . "</td>");

            echo ("<td style='text-align:center;'>" . $rec['p_inv_discount'] . "%</td>");

            $finprice = $rec['p_inv_final_price'];
            $finproperprice = number_format($finprice, 2);
            $finalprice = 'Rs. ' . $finproperprice;

            echo ("<td style='text-align:right;'>" . $finalprice . "</td>");

            echo ("<td><button type='button' style='width:100%;' id='" . $rec["p_inv_id"] . "' class='btn btn-selectinvoice btn-info btn-sm' data-toggle='modal' data-target='#editPartsModal'><i class='fas fa-info-circle'></i>&nbsp;&nbsp; Invoice Summary</button></td>");

            echo ("</tr>");
        }
    } else {
        return (" No record found");
    }
}

function InvoiceList()
{
    $conn = Connection();

    $view_sql = "SELECT invoice_tbl.inv_id, invoice_tbl.inv_date, cus_tbl.cus_first_name, cus_tbl.cus_last_name, cus_tbl.cus_email, cus_tbl.cus_code_phoneone, cus_tbl.cus_phone_one, cus_tbl.cus_houseno, cus_tbl.cus_street_one, cus_tbl.cus_street_two, cus_tbl.cus_city, cus_tbl.cus_postal_code, invoice_tbl.inv_total_price, invoice_tbl.inv_discount, invoice_tbl.inv_final_price
                    FROM invoice_tbl
                    INNER JOIN cus_tbl
                    ON invoice_tbl.cus_id = cus_tbl.cus_id
                    WHERE invoice_tbl.inv_status = 1;";

    $view_result = mysqli_query($conn, $view_sql);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $nor = mysqli_num_rows($view_result);

    if ($nor > 0) {

        while ($rec = mysqli_fetch_assoc($view_result)) {

            echo ("<td style='text-align:center;'>" . $rec['inv_id'] . "</td>");

            echo ("<td style='text-align:center;'>" . $rec['inv_date'] . "</td>");

            $customerdetails = '';

            if ($rec['cus_first_name'] !== '') {
                $customerdetails .= $rec['cus_first_name'];
            } else {
            }

            if ($rec['cus_last_name'] !== '') {
                $customerdetails .= ' ' . $rec['cus_last_name'];
            } else {
            }

            if ($rec['cus_houseno'] !== '') {
                $customerdetails .= ',' . '<br>' . $rec['cus_houseno'];
            } else {
            }

            if ($rec['cus_street_one'] !== '') {
                $customerdetails .= ', ' . $rec['cus_street_one'];
            } else {
            }

            if ($rec['cus_street_two'] !== '') {
                $customerdetails .= ', ' . $rec['cus_street_two'];
            } else {
            }

            if ($rec['cus_city'] !== '') {
                $customerdetails .= ', ' . $rec['cus_city'];
            } else {
            }

            if ($rec['cus_postal_code'] !== '') {
                $customerdetails .= '. ' . $rec['cus_postal_code'] . '<br>';
            } else {
                $customerdetails .= '.' . '<br>';
            }

            if ($rec['cus_email'] !== '') {
                $customerdetails .= $rec['cus_email'];
            } else {
            }

            if ($rec['cus_phone_one'] !== '') {
                $customerdetails .= '<br>' . $rec['cus_code_phoneone'] . ' ' . $rec['cus_phone_one'];
            } else {
            }

            echo ("<td>" . $customerdetails . "</td>");

            $totprice = $rec['inv_total_price'];
            $totproperprice = number_format($totprice, 2);
            $totalprice = 'Rs. ' . $totproperprice;

            echo ("<td style='text-align:right;'>" . $totalprice . "</td>");

            echo ("<td style='text-align:center;'>" . $rec['inv_discount'] . "%</td>");

            $finprice = $rec['inv_final_price'];
            $finproperprice = number_format($finprice, 2);
            $finalprice = 'Rs. ' . $finproperprice;

            echo ("<td style='text-align:right;'>" . $finalprice . "</td>");

            echo ("<td><button type='button' style='width:100%;' id='" . $rec["inv_id"] . "' class='btn btn-selectinvoice btn-info btn-sm' data-toggle='modal' data-target='#editModal'><i class='fas fa-info-circle'></i>&nbsp;Invoice Summary</button></td>");

            echo ("<td><button type='button' style='width:100%;' id='" . $rec["inv_id"] . "' class='btn btn-delinvoice btn-danger btn-sm'><i class='fas fa-trash'></i>&nbsp;&nbsp;Delete</button></td>");

            echo ("</tr>");
        }
    } else {
        return (" No record found");
    }
}


function getinvoicebyID($id)
{
    $conn = Connection();

    $getinvoice = "SELECT invoice_tbl.inv_id, invoice_tbl.inv_date, invoice_tbl.user_id, cus_tbl.cus_id, cus_tbl.cus_first_name, cus_tbl.cus_last_name, cus_tbl.cus_email, cus_tbl.cus_code_phoneone, cus_tbl.cus_phone_one, cus_tbl.cus_code_phonetwo, cus_tbl.cus_phone_two, cus_tbl.cus_houseno, cus_tbl.cus_street_one, cus_tbl.cus_street_two, cus_tbl.cus_city, cus_tbl.cus_postal_code, emp_tbl.emp_fname, emp_tbl.emp_lname, invoice_tbl.inv_total_price, invoice_tbl.inv_discount, invoice_tbl.inv_final_price, payment_tbl.payment_type, payment_tbl.payment_cardreceipt, payment_tbl.payment_chequeNo, payment_tbl.payment_chequeDate, payment_tbl.payment_time, invoice_tbl.inv_pdf_path, invoice_tbl.aod_pdf_path, invoice_tbl.gio_pdf_path
                    FROM ((((invoice_tbl
                    INNER JOIN cus_tbl
                    ON invoice_tbl.cus_id = cus_tbl.cus_id)
                    INNER JOIN user_tbl
                    ON invoice_tbl.user_id = user_tbl.user_id)
                    INNER JOIN payment_tbl
                    ON invoice_tbl.payment_id = payment_tbl.payment_id)
                    INNER JOIN emp_tbl
                    ON user_tbl.emp_id = emp_tbl.emp_id)
                    WHERE invoice_tbl.inv_id = '$id';";

    $runSQL = mysqli_query($conn, $getinvoice);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $nor = mysqli_num_rows($runSQL);

    if ($nor > 0) {
        $rec = mysqli_fetch_assoc($runSQL);

        return json_encode($rec);
    } else {
        return false;
    }
}

function getpartsinvoicebyID($id)
{
    $conn = Connection();

    $getinvoice = "SELECT invoice_parts_tbl.p_inv_id, invoice_parts_tbl.p_inv_date, invoice_parts_tbl.user_id, cus_tbl.cus_id, cus_tbl.cus_first_name, cus_tbl.cus_last_name, cus_tbl.cus_email, cus_tbl.cus_code_phoneone, cus_tbl.cus_phone_one, cus_tbl.cus_code_phonetwo, cus_tbl.cus_phone_two, cus_tbl.cus_houseno, cus_tbl.cus_street_one, cus_tbl.cus_street_two, cus_tbl.cus_city, cus_tbl.cus_postal_code, emp_tbl.emp_fname, emp_tbl.emp_lname, invoice_parts_tbl.p_inv_total_price, invoice_parts_tbl.p_inv_discount, invoice_parts_tbl.p_inv_final_price, payment_tbl.payment_type, payment_tbl.payment_cardreceipt, payment_tbl.payment_chequeNo, payment_tbl.payment_chequeDate, payment_tbl.payment_time, invoice_parts_tbl.p_inv_pdf_path, invoice_parts_tbl.p_aod_pdf_path, invoice_parts_tbl.p_gio_pdf_path
                    FROM ((((invoice_parts_tbl
                    INNER JOIN cus_tbl
                    ON invoice_parts_tbl.cus_id = cus_tbl.cus_id)
                    INNER JOIN user_tbl
                    ON invoice_parts_tbl.user_id = user_tbl.user_id)
                    INNER JOIN payment_tbl
                    ON invoice_parts_tbl.payment_id = payment_tbl.payment_id)
                    INNER JOIN emp_tbl
                    ON user_tbl.emp_id = emp_tbl.emp_id)
                    WHERE invoice_parts_tbl.p_inv_id = '$id';";

    $runSQL = mysqli_query($conn, $getinvoice);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $nor = mysqli_num_rows($runSQL);

    if ($nor > 0) {
        $rec = mysqli_fetch_assoc($runSQL);

        return json_encode($rec);
    } else {
        return false;
    }
}

function getinvoiceItemsbyID($id)
{
    $conn = Connection();

    $view_sql = "SELECT invoice_items_tbl.inv_id, invoice_items_tbl.prod_id, product_tbl.prod_name, product_tbl.prod_code, product_tbl.prod_description, product_tbl.prod_capacity, product_tbl.prod_motor_capacity, product_tbl.prod_motor_speed, product_tbl.prod_phase
                    FROM invoice_items_tbl
                    INNER JOIN product_tbl
                    ON invoice_items_tbl.prod_id = product_tbl.prod_id
                    WHERE invoice_items_tbl.inv_id = '$id';";

    $view_result = mysqli_query($conn, $view_sql);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $nor = mysqli_num_rows($view_result);

    if ($nor > 0) {

        $products = '';

        while ($rec = mysqli_fetch_assoc($view_result)) {
            $products .= '• [' . $rec['prod_code'] . '] ' . $rec['prod_name'] . ' : (' . $rec['prod_motor_capacity'] . ')&nbsp;(' . $rec['prod_phase'] . ')<br>';
        }

        return ($products);
    } else {
        return (" No record found");
    }
}

function getinvoicePartItemsbyID($id)
{
    $conn = Connection();

    $view_sql = "SELECT invoice_parts_items_tbl.p_inv_id, invoice_parts_items_tbl.part_id, parts_tbl.part_code, parts_tbl.part_name
                    FROM invoice_parts_items_tbl
                    INNER JOIN parts_tbl
                    ON invoice_parts_items_tbl.part_id = parts_tbl.part_id
                    WHERE invoice_parts_items_tbl.p_inv_id = '$id';";

    $view_result = mysqli_query($conn, $view_sql);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $nor = mysqli_num_rows($view_result);

    if ($nor > 0) {

        $parts = '';

        while ($rec = mysqli_fetch_assoc($view_result)) {
            $parts .= '• [' . $rec['part_code'] . '] ' . $rec['part_name'] . '<br>';
        }

        return ($parts);
    } else {
        return (" No record found");
    }
}

function getProductStockQty($id)
{
    $conn = Connection();

    $getQTY = "SELECT * FROM stock_prod_tbl WHERE prod_id = '$id';";

    $result = mysqli_query($conn, $getQTY);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    if (mysqli_num_rows($result) > 0) {

        $rec = mysqli_fetch_assoc($result);

        $qty = $rec["prod_qty"];

        return ($qty);
    } else {
        return false;
    }
}

function getPartStockQty($id)
{
    $conn = Connection();

    $getQTY = "SELECT * FROM stock_part_tbl WHERE part_id = '$id';";

    $result = mysqli_query($conn, $getQTY);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    if (mysqli_num_rows($result) > 0) {

        $rec = mysqli_fetch_assoc($result);

        $qty = $rec["part_qty"];

        return ($qty);
    } else {
        return false;
    }
}

function getAODID($id)
{
    $str = $id;

    $number = (explode("INV", $str)[1]);

    $aodID = 'AOD' . $number;

    return ($aodID);
}

function getGIOID($id)
{
    $str = $id;

    $number = (explode("INV", $str)[1]);

    $gioID = 'GIO' . $number;

    return ($gioID);
}

function getPAODID($id)
{
    $str = $id;

    $number = (explode("PIV", $str)[1]);

    $aodID = 'AOD' . $number;

    return ($aodID);
}

function getPGIOID($id)
{
    $str = $id;

    $number = (explode("PIV", $str)[1]);

    $gioID = 'GIO' . $number;

    return ($gioID);
}

function deleteInvoice($id)
{
    $conn = Connection();

    $checkSQL = "SELECT * FROM invoice_tbl WHERE inv_id = '$id';";

    $runSQL = mysqli_query($conn, $checkSQL);

    $nor = mysqli_num_rows($runSQL);

    if ($nor > 0) {

        $delInvoiceItems = "SELECT prod_id, prod_qty FROM invoice_items_tbl WHERE inv_id = '$id';";

        $runItems = mysqli_query($conn, $delInvoiceItems);

        if (mysqli_num_rows($runItems) > 0) {
            while ($rec = mysqli_fetch_assoc($runItems)) {

                $prodID = $rec['prod_id'];
                $prodQty = $rec['prod_qty'];

                $deleteProd = "UPDATE stock_prod_tbl SET prod_qty = prod_qty + $prodQty WHERE prod_id = '$prodID';";
                $rundelProd = mysqli_query($conn, $deleteProd);
            }
        }

        $delItems = "UPDATE invoice_items_tbl SET init_status = 0 WHERE inv_id = '$id';";

        $runItemDel = mysqli_query($conn, $delItems);

        $delSQL = "UPDATE invoice_tbl SET inv_status = 0 WHERE inv_id = '$id';";

        $runDel = mysqli_query($conn, $delSQL);

        if ($runDel > 0 && $runItemDel > 0) {
            echo ("success");
        } else {
            echo ("error");
        }
    } else {
        echo ("No records found!!!");
    }
}

?>