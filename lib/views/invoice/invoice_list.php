<?php
session_start();

include_once('../../inc/header.php');

if (isset($_SESSION['userId']) && $_SESSION['user_role'] == 1) {

    include_once('../../inc/sidenav.php');

?>

    <style>
        .cancel {
            background-color: #FFCE67;
        }
    </style>

    <br>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../dashboard/admin.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Invoice</a></li>
            <li class="breadcrumb-item active">Invoice List</li>
        </ol>
    </div>



    <div class="col-md-12">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#machineinvoicelist">
                    <h5>Machinery Invoice List</h5>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#partsinvoicelist">
                    <h5>Parts Invoice List</h5>
                </a>
            </li>
        </ul>
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade show active" id="machineinvoicelist">
                <br>
                <h1 class="display-5" style="text-align: center;"><i class="fas fa-boxes"></i>&nbsp;&nbsp;Machineries Invoice List</h1>
                <h6 style="text-align: center;">View all details and invoices of machineries</h6>
                <hr class="my-4">
                <br>
                <table class="table datatable-basic table-bordered table-hover datatable-button-html5-columns" id="invoice_list">
                    <thead>
                        <tr>
                            <th style='text-align:center;'>Invoice ID</th>
                            <th style='text-align:center;'>Create Date</th>
                            <th style='text-align:center;'>Customer Details</th>
                            <th style='text-align:center;'>Total Price</th>
                            <th style='text-align:center;'>Discount</th>
                            <th style='text-align:center;'>Final Price</th>
                            <th style='text-align:center;'>View Summary</th>
                            <th style='text-align:center;'>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include_once("../../functions/invoice.php");
                        InvoiceList();
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="partsinvoicelist">
                <br>
                <h1 class="display-5" style="text-align: center;"><i class="fas fa-cogs"></i>&nbsp;&nbsp;Parts Invoice List</h1>
                <h6 style="text-align: center;">View all details and invoices of parts</h6>
                <br>
                <hr class="my-4">
                <table class="table datatable-basic table-bordered table-hover datatable-button-html5-columns" id="invoice_parts_list">
                    <thead>
                        <tr>
                            <th style='text-align:center;'>Invoice ID</th>
                            <th style='text-align:center;'>Create Date</th>
                            <th style='text-align:center;'>Customer Details</th>
                            <th style='text-align:center;'>Total Price</th>
                            <th style='text-align:center;'>Discount</th>
                            <th style='text-align:center;'>Final Price</th>
                            <th style='text-align:center;'>View Summary</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include_once("../../functions/invoice.php");
                        PartsInvoiceList();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="col-md-12">
                        <div class="row">
                            <h6 class="modal-title" id="exampleModalLabel">Invoice Summary :&nbsp;</h6>
                            <h6 class="modal-title" id="invID"></h6>
                        </div>
                    </div>
                    </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <h6>Invoice Creator/ User</h6>
                        <div class="col-md-12" style="background-color: #f5f5f5; border-radius: 15px;">
                            <p id="user_details" style="padding: 10px;"></p>
                        </div>
                    </div>
                    <div>
                        <h6>Customer Details</h6>
                        <div class="col-md-12" style="background-color: #f5f5f5; border-radius: 15px; margin-top: 5px;">
                            <p id="customer_details" style="padding: 10px;"></p>
                        </div>
                    </div>
                    <div>
                        <h6>Invoice Items / Products</h6>
                        <div class="col-md-12" style="background-color: #f5f5f5; border-radius: 15px; margin-top: 5px;">
                            <p id="invoice_details" style="padding: 10px;">
                                <button id="invoice_items_list" type="button" class="btn btn-light btn-sm btn-block">
                                    <i class="fas fa-arrow-circle-down"></i>&nbsp;&nbsp;View all invoice items
                                </button>
                            </p>
                        </div>
                    </div>
                    <div>
                        <h6>Payment Details</h6>
                        <div class="col-md-12" style="background-color: #f5f5f5; border-radius: 15px; margin-top: 5px;">
                            <p id="payment_details" style="padding: 10px; color: #08a823;"></p>
                        </div>
                    </div>
                    <div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12" id="view_invoice" style="margin-top: 5px;">
                                    <button type="button" id="inv_btn" class="btn btn-light btn-block">
                                        <i class="fas fa-download"></i>&nbsp;&nbsp;Download Invoice
                                    </button>
                                </div>
                                <div class="col-md-12" id="view_aod" style="margin-top: 5px;">
                                    <button type="button" id="aod_btn" class="btn btn-light btn-block">
                                        <i class="fas fa-download"></i>&nbsp;&nbsp;Advice of Dispatch
                                    </button>
                                </div>
                                <div class="col-md-12" id="view_gio" style="margin-top: 5px;">
                                    <button type="button" id="gio_btn" class="btn btn-light btn-block">
                                        <i class="fas fa-download"></i>&nbsp;&nbsp;Goods Issue Note
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Model -->

    <!-- Modal -->
    <div class="modal fade" id="editPartsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="col-md-12">
                        <div class="row">
                            <h6 class="modal-title" id="exampleModalLabel">Invoice Summary :&nbsp;</h6>
                            <h6 class="modal-title" id="pinvID"></h6>
                        </div>
                    </div>
                    </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <h6>Invoice Creator/ User</h6>
                        <div class="col-md-12" style="background-color: #f5f5f5; border-radius: 15px;">
                            <p id="p_user_details" style="padding: 10px;"></p>
                        </div>
                    </div>
                    <div>
                        <h6>Customer Details</h6>
                        <div class="col-md-12" style="background-color: #f5f5f5; border-radius: 15px; margin-top: 5px;">
                            <p id="p_customer_details" style="padding: 10px;"></p>
                        </div>
                    </div>
                    <div>
                        <h6>Invoice Items / Products</h6>
                        <div class="col-md-12" style="background-color: #f5f5f5; border-radius: 15px; margin-top: 5px;">
                            <p id="p_invoice_details" style="padding: 10px;">
                                <button id="p_invoice_items_list" type="button" class="btn btn-light btn-sm btn-block">
                                    <i class="fas fa-arrow-circle-down"></i>&nbsp;&nbsp;View all invoice items
                                </button>
                            </p>
                        </div>
                    </div>
                    <div>
                        <h6>Payment Details</h6>
                        <div class="col-md-12" style="background-color: #f5f5f5; border-radius: 15px; margin-top: 5px;">
                            <p id="p_payment_details" style="padding: 10px; color: #08a823;"></p>
                        </div>
                    </div>
                    <div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12" id="p_view_invoice" style="margin-top: 5px;">
                                    <button type="button" id="p_inv_btn" class="btn btn-light btn-block">
                                        <i class="fas fa-download"></i>&nbsp;&nbsp;Download Invoice
                                    </button>
                                </div>
                                <div class="col-md-12" id="p_view_aod" style="margin-top: 5px;">
                                    <button type="button" id="p_aod_btn" class="btn btn-light btn-block">
                                        <i class="fas fa-download"></i>&nbsp;&nbsp;Advice of Dispatch
                                    </button>
                                </div>
                                <div class="col-md-12" id="p_view_gio" style="margin-top: 5px;">
                                    <button type="button" id="p_gio_btn" class="btn btn-light btn-block">
                                        <i class="fas fa-download"></i>&nbsp;&nbsp;Goods Issue Note
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Model -->


    <script>
        $(document).ready(function() {
            $("#invoice_list").DataTable({
                dom: 'B<"clear">lfrtip',
                "order": [
                    [0, "desc"]
                ],
                buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="fas fa-copy"></i>&nbsp;Copy to Clipboard',
                        exportOptions: {
                            columns: [0, 1, 3, 4, 5]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i>&nbsp;Export to Excel',
                        exportOptions: {
                            columns: [0, 1, 3, 4, 5]
                        },
                        title: "Udaya Industries [REPORT: INVOICE LIST]"
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fas fa-file-csv"></i>&nbsp;Export to CSV',
                        exportOptions: {
                            columns: [0, 1, 3, 4, 5]
                        },
                        title: "Udaya Industries [REPORT: INVOICE LIST]"
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i>&nbsp;Export to PDF',
                        exportOptions: {
                            columns: [0, 1, 3, 4, 5]
                        },
                        title: "Udaya Industries [REPORT: INVOICE LIST]"
                    }
                ]
            });

            $("#invoice_parts_list").DataTable({
                dom: 'B<"clear">lfrtip',
                "order": [
                    [0, "desc"]
                ],
                buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="fas fa-copy"></i>&nbsp;Copy to Clipboard',
                        exportOptions: {
                            columns: [0, 1, 3, 4, 5]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i>&nbsp;Export to Excel',
                        exportOptions: {
                            columns: [0, 1, 3, 4, 5]
                        },
                        title: "Udaya Industries [REPORT: INVOICE LIST]"
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fas fa-file-csv"></i>&nbsp;Export to CSV',
                        exportOptions: {
                            columns: [0, 1, 3, 4, 5]
                        },
                        title: "Udaya Industries [REPORT: INVOICE LIST]"
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i>&nbsp;Export to PDF',
                        exportOptions: {
                            columns: [0, 1, 3, 4, 5]
                        },
                        title: "Udaya Industries [REPORT: INVOICE LIST]"
                    }
                ]
            });

            $('#invoice_list tbody').on('click', '.btn-selectinvoice', function() {

                $inv_ID = $(this).attr('id');

                $.get("../../route/invoice/getinvoicedetails.php", {
                    id: $inv_ID
                }, function(data) {

                    var jdata = jQuery.parseJSON(data);

                    var invoiceID = jdata.inv_id;
                    var invoiceDate = jdata.inv_date;
                    var invoiceTotalPrice = jdata.inv_total_price;
                    var invoiceDiscount = jdata.inv_discount;
                    var invoiceFinalTotal = jdata.inv_final_price;

                    var userFirstName = jdata.emp_fname;
                    var userLastName = jdata.emp_lname;

                    var cus_id = jdata.cus_id;
                    var cusfirstname = jdata.cus_first_name;
                    var cuslastname = jdata.cus_last_name;

                    var cusemail = jdata.cus_email;

                    var cuscodephoneone = jdata.cus_code_phoneone;
                    var cusphoneone = jdata.cus_phone_one;
                    var cuscodephonetwo = jdata.cus_code_phonetwo;
                    var cusphonetwo = jdata.cus_phone_two;

                    var cushouseno = jdata.cus_houseno;
                    var cusstreetone = jdata.cus_street_one;
                    var cusstreettwo = jdata.cus_street_two;
                    var cuscity = jdata.cus_city;
                    var cuspostalcode = jdata.cus_postal_code;

                    var paymentType = jdata.payment_type;
                    var paymentReciept = jdata.payment_cardreceipt;
                    var paymentChequeNo = jdata.payment_chequeNo;
                    var paymentChequeDate = jdata.payment_chequeDate;
                    var paymentTime = jdata.payment_time;

                    var date = paymentTime.split(" ")[0];
                    var time = paymentTime.split(" ")[1];

                    var paymentTime = date + "&nbsp;@&nbsp;" + time;

                    //----------------------------------------------------

                    var invPDF = jdata.inv_pdf_path;

                    if (invPDF == '') {
                        $("#view_invoice").hide();
                    } else {
                        $("#view_invoice").show();
                    }

                    $("#inv_btn").click(function() {
                        window.open(invPDF, '_blank');
                    });

                    //----------------------------------------------------

                    var aodPDF = jdata.aod_pdf_path;

                    if (aodPDF == '') {
                        $("#view_aod").hide();
                    } else {
                        $("#view_aod").show();
                    }

                    $("#aod_btn").click(function() {
                        window.open(aodPDF, '_blank');
                    });

                    //----------------------------------------------------

                    var gioPDF = jdata.gio_pdf_path;

                    if (gioPDF == '') {
                        $("#view_gio").hide();
                    } else {
                        $("#view_gio").show();
                    }

                    $("#gio_btn").click(function() {
                        window.open(gioPDF, '_blank');
                    });

                    //----------------------------------------------------

                    $("#invID").html(invoiceID);

                    var userDetails = userFirstName + '&nbsp;' + userLastName;

                    $("#user_details").html(userDetails);

                    var customerDetails = cusfirstname + '&nbsp;' + cuslastname + '<br>' + cusemail + '<br>' + cushouseno + ',<br>' + cusstreetone + ', ' + cusstreettwo + ',<br>' + cuscity + '. ' + cuspostalcode + '<br>(' + cuscodephoneone + ') ' + cusphoneone + ' / ' + '(' + cuscodephonetwo + ') ' + cusphonetwo;

                    $("#customer_details").html(customerDetails);

                    var paymentDetails = '';

                    if (paymentType == 'cash') {
                        paymentDetails = 'Cash Payment on ' + paymentTime;
                    } else if (paymentType == 'card') {
                        paymentDetails = 'Card Payment on ' + paymentTime + '<br>Payment Receipt No:&nbsp;' + paymentReciept;
                    } else if (paymentType == 'cheque') {
                        paymentDetails = 'Cheque Payment on ' + paymentTime + '<br>Unique Cheque Number:&nbsp;' + paymentChequeNo + '<br>Cheque Date:&nbsp;' + paymentChequeDate;
                    }

                    $("#payment_details").html(paymentDetails);

                    //----------------------------------------

                    $("#invoice_details").html("<button id='invoice_items_list' type='button' class='btn btn-light btn-sm btn-block'><i class='fas fa-arrow-circle-down'></i>&nbsp;&nbsp;View all invoice items</button>");

                    //----------------------------------------

                    $('#invoice_items_list').click(function() {
                        $.get("../../route/invoice/getinvoiceItems.php", {
                            id: $inv_ID
                        }, function(data) {
                            $("#invoice_details").css("color", "#d12d21");
                            $("#invoice_details").html(data);
                        });
                    });
                });
            });

            $('#invoice_parts_list tbody').on('click', '.btn-selectinvoice', function() {

                $pinv_ID = $(this).attr('id');

                $.get("../../route/invoice/getpartsinvoicedetails.php", {
                    id: $pinv_ID
                }, function(data) {

                    var jdata = jQuery.parseJSON(data);

                    var invoiceID = jdata.p_inv_id;
                    var invoiceDate = jdata.p_inv_date;
                    var invoiceTotalPrice = jdata.p_inv_total_price;
                    var invoiceDiscount = jdata.p_inv_discount;
                    var invoiceFinalTotal = jdata.p_inv_final_price;

                    var userFirstName = jdata.emp_fname;
                    var userLastName = jdata.emp_lname;

                    var cus_id = jdata.cus_id;
                    var cusfirstname = jdata.cus_first_name;
                    var cuslastname = jdata.cus_last_name;

                    var cusemail = jdata.cus_email;

                    var cuscodephoneone = jdata.cus_code_phoneone;
                    var cusphoneone = jdata.cus_phone_one;
                    var cuscodephonetwo = jdata.cus_code_phonetwo;
                    var cusphonetwo = jdata.cus_phone_two;

                    var cushouseno = jdata.cus_houseno;
                    var cusstreetone = jdata.cus_street_one;
                    var cusstreettwo = jdata.cus_street_two;
                    var cuscity = jdata.cus_city;
                    var cuspostalcode = jdata.cus_postal_code;

                    var paymentType = jdata.payment_type;
                    var paymentReciept = jdata.payment_cardreceipt;
                    var paymentChequeNo = jdata.payment_chequeNo;
                    var paymentChequeDate = jdata.payment_chequeDate;
                    var paymentTime = jdata.payment_time;

                    var date = paymentTime.split(" ")[0];
                    var time = paymentTime.split(" ")[1];

                    var paymentTime = date + "&nbsp;@&nbsp;" + time;

                    //----------------------------------------------------

                    var invPDF = jdata.p_inv_pdf_path;

                    if (invPDF == '') {
                        $("#p_view_invoice").hide();
                    } else {
                        $("#p_view_invoice").show();
                    }

                    $("#p_inv_btn").click(function() {
                        window.open(invPDF, '_blank');
                    });

                    //----------------------------------------------------

                    var aodPDF = jdata.p_aod_pdf_path;

                    if (aodPDF == '') {
                        $("#p_view_aod").hide();
                    } else {
                        $("#p_view_aod").show();
                    }

                    $("#p_aod_btn").click(function() {
                        window.open(aodPDF, '_blank');
                    });

                    //----------------------------------------------------

                    var gioPDF = jdata.p_gio_pdf_path;

                    if (gioPDF == '') {
                        $("#p_view_gio").hide();
                    } else {
                        $("#p_view_gio").show();
                    }

                    $("#p_gio_btn").click(function() {
                        window.open(gioPDF, '_blank');
                    });

                    //----------------------------------------------------

                    $("#pinvID").html(invoiceID);

                    var userDetails = userFirstName + '&nbsp;' + userLastName;

                    $("#p_user_details").html(userDetails);

                    var customerDetails = cusfirstname + '&nbsp;' + cuslastname + '<br>' + cusemail + '<br>' + cushouseno + ',<br>' + cusstreetone + ', ' + cusstreettwo + ',<br>' + cuscity + '. ' + cuspostalcode + '<br>(' + cuscodephoneone + ') ' + cusphoneone + ' / ' + '(' + cuscodephonetwo + ') ' + cusphonetwo;

                    $("#p_customer_details").html(customerDetails);

                    var paymentDetails = '';

                    if (paymentType == 'cash') {
                        paymentDetails = 'Cash Payment on ' + paymentTime;
                    } else if (paymentType == 'card') {
                        paymentDetails = 'Card Payment on ' + paymentTime + '<br>Payment Receipt No:&nbsp;' + paymentReciept;
                    } else if (paymentType == 'cheque') {
                        paymentDetails = 'Cheque Payment on ' + paymentTime + '<br>Unique Cheque Number:&nbsp;' + paymentChequeNo + '<br>Cheque Date:&nbsp;' + paymentChequeDate;
                    }

                    $("#p_payment_details").html(paymentDetails);

                    //----------------------------------------

                    $("#p_invoice_details").html("<button id='p_invoice_items_list' type='button' class='btn btn-light btn-sm btn-block'><i class='fas fa-arrow-circle-down'></i>&nbsp;&nbsp;View all invoice items</button>");

                    //----------------------------------------

                    $('#p_invoice_items_list').click(function() {
                        $.get("../../route/invoice/getinvoicepartitems.php", {
                            id: $pinv_ID
                        }, function(data) {
                            $("#p_invoice_details").css("color", "#d12d21");
                            $("#p_invoice_details").html(data);
                        });
                    });
                });
            });

            $(".btn-delinvoice").click(function() {

                var invoiceID = $(this).attr('id');

                swal({
                        title: "Delete Invoice : " + invoiceID + "?",
                        text: "You will not be able to recover this data!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Delete",
                        confirmButtonColor: "#000000",
                        cancelButtonText: "Cancel",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            $.get("../../route/invoice/deleteInvoice.php", {
                                id: invoiceID
                            }, function(data) {
                                setTimeout(() => {
                                    location.reload();
                                }, 2550);
                                swal({
                                    type: 'success',
                                    title: 'Invoice deleted!',
                                    text: 'Invoice Details have been removed!',
                                    showConfirmButton: false,
                                    timer: 2500
                                });
                            });
                        } else {
                            swal({
                                type: 'warning',
                                title: 'Deletion Cancelled!',
                                text: 'Invoice details remain!',
                                showConfirmButton: false,
                                timer: 2500
                            });
                        }
                    });
            });

            $(".sidebar-btn").click(function() {
                $(".wrapper").toggleClass("hideSide");
            });

        });
    </script>

    </body>

    </html>

<?php } else {
?>

    <body id="login_body" style="background-image: url('../../../img/login.jpg'); background-size: cover; background-repeat: 'no-repeat'; background-attachment: 'fixed'; background-position: 'center';">
        <div class="container" style="margin-top:200px; width: 500px; height:500px; background-color:#eee; border-radius: 2%;">
            <div style="text-align:center;">
                <i class="fas fa-exclamation-circle fa-10x" style="color: #ffc13b; margin-top: 10%;"></i>
                <br />
                <h1 class="display-4" style="margin-top: 10%;">Error!</h1>
                <h4>Invalid Login</h4>
                <br />
                <div id="text_group">
                    <div align="center">
                        <a href="../../../index.php" style="text-decoration: none;">
                            <button href="" type="submit" class="btn btn-primary btn-lg btn-block" style="width:90%; margin-top: 10%;">
                                <i class="fas fa-arrow-left"></i>&nbsp;&nbsp;&nbsp;Proceed to login
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div id="footer">
            <h4 style="color: white;">- Developed by Dilshan Liyanage [1708937] -</h4>
        </div>
    </body>

<?php
}
?>