<?php
session_start();

include_once('../../inc/header.php');

if (isset($_SESSION['userId']) && $_SESSION['user_role'] == 1) {

    include_once('../../inc/sidenav.php');

?>

    <style>
        #zoom {
            transition: transform .2s;
        }

        #zoom:hover {
            transform: scale(1.5);
        }
    </style>

    <br>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Invoice</a></li>
            <li class="breadcrumb-item active">Create Invoice For Parts</li>
        </ol>
    </div>

    <div class="col-md-12">
        <div class="content">
            <div class="jumbotron">
                <h1 class="display-5" style="text-align: center;"><i class="fas fa-file-invoice fa-1x"></i>&nbsp;&nbsp;Create Parts Invoice (Bill)</h1>
                <hr>
                <br>
                <form id="invoice">
                    <h5 class="card-title"><i class="fas fa-user"></i>&nbsp;&nbsp;Customer Details</h5>
                    <hr class="my-4">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Customer Name <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" id="firstname" name="firstname" class="form-control" placeholder="මුල් නම (Ex: Dilshan, etc.)">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" id="lastname" name="lastname" class="form-control" placeholder="මුල් නම (Ex: Liyanage, etc.)">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Email Address </label>
                                <div class="col-lg-9">
                                    <input type="email" name="email" class="form-control" id="email" placeholder="විද්යුත් තැපෑල (Ex: dila@hotmail.com, etc.)">
                                    <p style="color: red; display: none;" id="error_mail" class="form-text"><i class="icon-cancel-circle2"></i>&nbsp;This email already exists in the system!</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Contact Number #1:<span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <select class="form-control" id="code_phoneone" name="code_phoneone">
                                        <option value="%2B61">[+61] Australia</option>
                                        <option value="%2B880">[+880] Bangladesh</option>
                                        <option value="%2B852">[+852] Hong Kong</option>
                                        <option value="%2B91">[+91] India</option>
                                        <option value="%2B95">[+95] Myanmar</option>
                                        <option value="%2B248">[+248] Seychelles</option>
                                        <option value="%2B65">[+65] Singapore</option>
                                        <option value="%2B27">[+27] South Africa</option>
                                        <option value="%2B94" selected="">[+94] Sri Lanka</option>
                                        <option value="%2B84">[+84] Vietnam</option>
                                    </select>
                                </div>
                                <div class="col-lg-5">
                                    <input type="number" min="0" name="telone" id="telone" class="form-control" placeholder="දුරකතන අංකය (Ex: 771586351, etc.)">
                                    <p style="color: red; display: none;" id="error_tel_one" class="form-text"><i class="icon-cancel-circle2"></i>&nbsp;Phone number should contain only 9 digits</p>
                                    <p style="color: red; display: none;" id="error_telone_v" class="form-text"><i class="icon-cancel-circle2"></i>&nbsp;This number already exists in the system!</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Contact Number #2:</label>
                                <div class="col-lg-4">
                                    <select class="form-control" id="code_phonetwo" name="code_phonetwo">
                                        <option value="%2B61">[+61] Australia</option>
                                        <option value="%2B880">[+880] Bangladesh</option>
                                        <option value="%2B852">[+852] Hong Kong</option>
                                        <option value="%2B91">[+91] India</option>
                                        <option value="%2B95">[+95] Myanmar</option>
                                        <option value="%2B248">[+248] Seychelles</option>
                                        <option value="%2B65">[+65] Singapore</option>
                                        <option value="%2B27">[+27] South Africa</option>
                                        <option value="%2B94" selected="">[+94] Sri Lanka</option>
                                        <option value="%2B84">[+84] Vietnam</option>
                                    </select>
                                </div>
                                <div class="col-lg-5">
                                    <input type="number" min="0" name="teltwo" id="teltwo" class="form-control" placeholder="දුරකතන අංකය (Ex: 779106960, etc.)">
                                    <p style="color: red; display: none;" id="error_tel_two" class="form-text"><i class="icon-cancel-circle2"></i>&nbsp;Phone number should contain only 9 digits</p>
                                    <p style="color: red; display: none;" id="error_teltwo_v" class="form-text"><i class="icon-cancel-circle2"></i>&nbsp;This number already exists in the system!</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Address:<span class="text-danger">*</span></label>
                                <div class="col-lg-3">
                                    <input type="text" name="houseno" class="form-control" id="houseno" placeholder="නිවෙස් අංකය හෝ සමාගම් නාමය (Ex: 30/1, etc)">
                                </div>
                                <div class="col-lg-3">
                                    <input type="text" name="streetone" class="form-control" id="streetone" placeholder="වීදිය #1 (Ex: James Peiris Lane, etc.)">
                                </div>
                                <div class="col-lg-3">
                                    <input type="text" name="streettwo" class="form-control" id="streettwo" placeholder="වීදිය #2 (Ex: Kadawath, etc.)">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label"></label>
                                <div class="col-lg-5">
                                    <input type="text" name="city" class="form-control" id="city" placeholder="නගරය (Ex: Kandy, Colombo etc.)">
                                </div>
                                <div class="col-lg-4">
                                    <input type="text" name="postalcode" class="form-control" maxlength="5" id="postalcode" placeholder="තැපැල් කේතය (Ex: 20500, etc.)">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1">
                            <div style="border-left:1px solid #dbdbdb; height:400px"></div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label>Logged User/ Cashier</label>
                                <input type="text" name="userlogname" id="userlogname" value=<?php echo ($_SESSION['userFirstName'] . "&nbsp;" . $_SESSION['userLastName']); ?> class="form-control" disabled />
                                <input style="display: none;" type="text" name="logged_user" id="logged_user" value="<?php echo ($_SESSION['userId']); ?>" class="form-control" disabled />
                            </div>
                            <br>
                            <div class="form-group">
                                <label>Date of Issue</label>
                                <input type="text" id="date_of_issue" name="date_of_issue" class="form-control" disabled>
                            </div>
                            <br>
                            <div class="form-group">
                                <label>Search for existing customer:</label>
                                <input type="text" name="searchcus" id="searchcus" class="form-control" placeholder="Enter any customer detail...">
                            </div>
                            <div>
                                <div id="cus_search_result"></div>
                            </div>
                            <div style="display: none; color: green;" id="cus_sel">
                                <div class="row">
                                    <p><i class="fas fa-exclamation-circle"></i>&nbsp;Selected Customer: [</p>
                                    <p id="sel_cus_id"></p>
                                    <p>]</p>
                                    <p>&nbsp;</p>
                                    <p id="sel_cus_fname"></p>
                                    <p>&nbsp;</p>
                                    <p id="sel_cus_lname"></p>
                                </div>
                                <div class="row">
                                    <p><i class="fas fa-exclamation-circle"></i>&nbsp;Email:&nbsp;&nbsp;</p>
                                    <p id="sel_cus_email"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr style="width:100%; margin-left:0; border: 1px solid #dbdbdb;">
                    <br>
                    <h5 class="card-title"><i class="fas fa-box"></i>&nbsp;&nbsp;Parts List</h5>
                    <hr class="my-4">
                    <br>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label>Search parts for Invoice:</label>
                                <input type="text" name="search_part" id="search_part" class="form-control" placeholder="Part Name (කොටස් නාමය)">
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group" style="width: 100%;">
                                <div class="container" id="partInfo" style="width: 100%; border: 3px #eee solid; overflow: auto; white-space: nowrap; background-color: #eee; display: none;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr style="width:100%; margin-left:0; border: 1px solid #dbdbdb;">
                    <br>
                    <h5 class="card-title"><i class="fas fa-cogs"></i>&nbsp;&nbsp;Parts Invoice List</h5>
                    <hr class="my-4">
                    <br>
                    <div class="row" style="margin-bottom:20px;">
                        <table id="part_invoice_list" class="table table-hover table-striped table-inverse table-responsive table-bordered" style="margin-left:10px; margin-top:10px; width:100%; font-size: 16px;">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>Part ID</th>
                                    <th>Part Code</th>
                                    <th>Name</th>
                                    <th>Unit Price</th>
                                    <th>Qty</th>
                                    <th>Total Price</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <div style="margin-bottom:20px; font-size: 18px;">
                        <div class="row">
                            <div class="col-md-3" style="text-align: right;">
                                Total Price&nbsp;:
                            </div>
                            <div class="col-md-3" style="text-align: left;">
                                <input class="form-control" type="text" name="totalmprice" id="totalmprice" style="width: 200px;" disabled>
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3"></div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3" style="text-align: right;">
                                Discount Percentage&nbsp;:
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="input-group mb-3" style="width:200px;">
                                        <input type="number" id="percentageTB" max=100 min=0 name="percentageTB" class="form-control" placeholder="Enter Discount Percentage">
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                                <p style="display: none; color:red;" id="unrealpercentage"><i class="far fa-times-circle"></i>&nbsp;&nbsp;Unrealistic Percentage Value</p>
                            </div>
                            <div class="col-md-3"> </div>
                            <div class="col-md-3"></div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3" style="text-align: right;">
                                Final Price&nbsp;:
                            </div>
                            <div class="col-md-3" style="text-align: left;">
                                <input class="form-control" type="text" name="finalprice" id="finalprice" style="width:200px;" disabled>
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3"></div>
                        </div>
                    </div>
                    <br>
                    <hr style="width:100%; margin-left:0; border: 1px solid #dbdbdb;">
                    <br>
                    <h5 class="card-title"><i class="fas fa-info-circle"></i>&nbsp;&nbsp;Additional Info</h5>
                    <hr class="my-4">
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="payment_method">Payment Method</label>
                                <select class="form-control" id="payment_method" name="payment_method">
                                    <option value="" checked="">-- Select Payment Method--</option>
                                    <option value="cash">Cash</option>
                                    <option value="card">Card</option>
                                    <option value="cheque">Cheque</option>
                                </select>

                            </div>
                        </div>
                        <div class="col-md-3" style="text-align: left;">
                            <div class="form-group">
                                <label for="">&nbsp;</label>
                                <input class="form-control" style="display: none;" type="text" name="card_tb" id="card_tb" placeholder="Enter Transaction Receipt Number">
                                <input class="form-control" style="display: none;" type="text" name="cheque_number" id="cheque_number" placeholder="Enter Unique Cheque Number">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">&nbsp;</label>
                                <input class="form-control" style="display: none;" type="date" name="cheque_date" id="cheque_date" min="">
                            </div>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                    <br>
                    <div class="row" style="margin-bottom:20px; font-size: 15px;">
                        <div class="col-md-12">
                            <label for="specialnotes">Additional Notes</label>
                            <textarea class="form-control" style="width: 100%;" name="specialnotes" id="specialnotes" col="12" rows="3"></textarea>
                        </div>
                    </div>
                    <br>
                    <hr style="width:100%; margin-left:0; border: 1px solid #dbdbdb;">
                    <br>
                    <div class="text-right">
                        <button type="button" id="genInvoice_btn" class="btn btn-primary" onclick="return false"><i class="fas fa-paper-plane"></i>&nbsp;&nbsp;Generate Invoice</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;

        $("#date_of_issue").val(today);

        $('#cheque_date').attr('min', today);
    </script>

    <script>
        $(document).ready(function() {

            var partid = 0;
            var partcode = 0;
            var partname = 0;
            var partdesc = 0;
            var partweight = 0;
            var partwunit = 0;
            var partunitprice = 0;
            var partreorderlevel = 0;

            var discountprice = 0;

            var master_total = 0;

            var percentageval = 0;

            var final_total = 0;

            var method = '';

            document.getElementById('genInvoice_btn').disabled = true;

            $("#genInvoice_btn").click(function() {

                var logged_user = $("#logged_user").val();
                var logged_user_name = $("#userlogname").val();

                var firstname = $("#firstname").val();
                var lastname = $("#lastname").val();
                var email = $("#email").val();
                var code_phoneone = $("#code_phoneone").val();
                var telone = $("#telone").val();
                var code_phonetwo = $("#code_phonetwo").val();
                var teltwo = $("#teltwo").val();
                var houseno = $("#houseno").val();
                var streetone = $("#streetone").val();
                var streettwo = $("#streettwo").val();
                var city = $("#city").val();
                var postalcode = $("#postalcode").val();

                var master_total = $("#totalmprice").val();

                var discountperc = $("#percentageTB").val();

                var finalprice = $("#finalprice").val();

                var method = $("#payment_method").val();

                var specialnotes = $("#specialnotes").val();

                var TableData = new Array();

                $("#part_invoice_list tr").each(function(row, tr) {
                    TableData[row] = {
                        "partID": $(tr).find('td:eq(0)').text(),
                        "itemcode": $(tr).find('td:eq(1)').text(),
                        "partName": $(tr).find('td:eq(2)').text(),
                        "unitprice": $(tr).find('td:eq(3)').text(),
                        "qty": $(tr).find('td:eq(4)').text(),
                        "totalprice": $(tr).find('td:eq(5)').text()
                    }
                });

                TableData.shift();

                var partListTbl = JSON.stringify(TableData);

                var selcusid = $("#sel_cus_id").html();

                if (selcusid == "") {

                    if (partListTbl == '[]') {
                        swal("Failed to create Invoice!", "No items to create invoice!", "warning");
                    } else {

                        if (method == 'cash') {

                            var paymentmethod = 'cash';

                            $.when(
                                window.open("./part_invoice_pdf.php?firstname=" + firstname + "&lastname=" + lastname + "&email=" + email + "&code_phoneone=" + code_phoneone + "&telone=" + telone + "&code_phonetwo=" + code_phonetwo + "&teltwo=" + teltwo + "&houseno=" + houseno + "&streetone=" + streetone + "&streettwo=" + streettwo + "&city=" + city + "&postalcode=" + postalcode + "&cashier_id=" + logged_user + "&loggedusername=" + logged_user_name + "&paymentmethod=" + paymentmethod + "&partListTbl=" + partListTbl + "&master_total=" + master_total + "&discount=" + discountperc + "&finaltotal=" + finalprice + "&specialnotes=" + specialnotes + "&/", "_blank")
                            ).then(function() {
                                setTimeout(() => {
                                    window.location.href = '../invoice/invoice_list.php';
                                }, 2550);
                                swal({
                                    type: 'success',
                                    title: 'New Invoice Created!',
                                    text: 'New Invoice has been successfully created!',
                                    showConfirmButton: false,
                                    timer: 2500
                                });
                            });

                        } else if (method == 'card') {

                            var paymentmethod = 'card';

                            var transaction_receipt_no = $("#card_tb").val();

                            if (transaction_receipt_no == "") {
                                swal("Empty 'Transaction Receipt Number'!", "Invoice cannot be created without filling the 'Transaction Receipt Number'!", "warning");
                            } else {

                                $.when(
                                    window.open("./part_invoice_pdf.php?firstname=" + firstname + "&lastname=" + lastname + "&email=" + email + "&code_phoneone=" + code_phoneone + "&telone=" + telone + "&code_phonetwo=" + code_phonetwo + "&teltwo=" + teltwo + "&houseno=" + houseno + "&streetone=" + streetone + "&streettwo=" + streettwo + "&city=" + city + "&postalcode=" + postalcode + "&cashier_id=" + logged_user + "&loggedusername=" + logged_user_name + "&paymentmethod=" + paymentmethod + "&transaction_receipt_no=" + transaction_receipt_no + "&partListTbl=" + partListTbl + "&master_total=" + master_total + "&discount=" + discountperc + "&finaltotal=" + finalprice + "&specialnotes=" + specialnotes + "&/", "_blank")
                                ).then(function() {
                                    setTimeout(() => {
                                        window.location.href = '../invoice/invoice_list.php';
                                    }, 2550);
                                    swal({
                                        type: 'success',
                                        title: 'New Invoice Created!',
                                        text: 'New Invoice has been successfully created!',
                                        showConfirmButton: false,
                                        timer: 2500
                                    });

                                });
                            }

                        } else if (method == 'cheque') {

                            var paymentmethod = 'cheque';

                            var chequeNo = $("#cheque_number").val();

                            var chequeDate = $("#cheque_date").val();

                            if (chequeNo == "" || chequeDate == "") {
                                swal("Empty 'Cheque Number' or 'Cheque Date'!", "Invoice cannot be created without filling the 'Cheque Number' and 'Cheque Date'!", "warning");
                            } else {

                                $.when(
                                    window.open("./part_invoice_pdf.php?firstname=" + firstname + "&lastname=" + lastname + "&email=" + email + "&code_phoneone=" + code_phoneone + "&telone=" + telone + "&code_phonetwo=" + code_phonetwo + "&teltwo=" + teltwo + "&houseno=" + houseno + "&streetone=" + streetone + "&streettwo=" + streettwo + "&city=" + city + "&postalcode=" + postalcode + "&cashier_id=" + logged_user + "&loggedusername=" + logged_user_name + "&paymentmethod=" + paymentmethod + "&chequeNo=" + chequeNo + "&chequeDate=" + chequeDate + "&partListTbl=" + partListTbl + "&master_total=" + master_total + "&discount=" + discountperc + "&finaltotal=" + finalprice + "&specialnotes=" + specialnotes + "&/", "_blank")
                                ).then(function() {
                                    setTimeout(() => {
                                        window.location.href = '../invoice/invoice_list.php';
                                    }, 2550);
                                    swal({
                                        type: 'success',
                                        title: 'New Invoice Created!',
                                        text: 'New Invoice has been successfully created!',
                                        showConfirmButton: false,
                                        timer: 2500
                                    });

                                });
                            }

                        } else {

                            swal("Please select Payment Option!", "Invoice cannot be created without a payment option!", "warning");
                        }
                    }
                } else {

                    $.get("../../route/customer/getsingleCus.php", {
                        id: selcusid
                    }, function(data) {

                        var jdata = jQuery.parseJSON(data);

                        var selected_cus_id = jdata.cus_id;

                        if (partListTbl == '[]') {
                            swal("Failed to create Invoice!", "No items to create invoice!", "warning");
                        } else {

                            if (method == 'cash') {

                                var paymentmethod = 'cash';

                                $.when(
                                    window.open("./part_invoice_selected_pdf.php?selected_cus_id=" + selected_cus_id + "&cashier_id=" + logged_user + "&loggedusername=" + logged_user_name + "&paymentmethod=" + paymentmethod + "&partListTbl=" + partListTbl + "&master_total=" + master_total + "&discount=" + discountperc + "&finaltotal=" + finalprice + "&specialnotes=" + specialnotes + "&/", "_blank")
                                ).then(function() {
                                    setTimeout(() => {
                                        window.location.href = '../invoice/invoice_list.php';
                                    }, 2550);
                                    swal({
                                        type: 'success',
                                        title: 'New Invoice Created!',
                                        text: 'New Invoice has been successfully created!',
                                        showConfirmButton: false,
                                        timer: 2500
                                    });
                                });

                            } else if (method == 'card') {

                                var paymentmethod = 'card';

                                var transaction_receipt_no = $("#card_tb").val();

                                if (transaction_receipt_no == "") {
                                    swal("Empty 'Transaction Receipt Number'!", "Invoice cannot be created without filling the 'Transaction Receipt Number'!", "warning");
                                } else {

                                    $.when(
                                        window.open("./part_invoice_selected_pdf.php?selected_cus_id=" + selected_cus_id + "&cashier_id=" + logged_user + "&loggedusername=" + logged_user_name + "&paymentmethod=" + paymentmethod + "&transactionreceipt=" + transaction_receipt_no + "&partListTbl=" + partListTbl + "&master_total=" + master_total + "&discount=" + discountperc + "&finaltotal=" + finalprice + "&specialnotes=" + specialnotes + "&/", "_blank")
                                    ).then(function() {
                                        setTimeout(() => {
                                            window.location.href = '../invoice/invoice_list.php';
                                        }, 2550);
                                        swal({
                                            type: 'success',
                                            title: 'New Invoice Created!',
                                            text: 'New Invoice has been successfully created!',
                                            showConfirmButton: false,
                                            timer: 2500
                                        });
                                    });
                                }

                            } else if (method == 'cheque') {

                                var paymentmethod = 'cheque';

                                var chequeNo = $("#cheque_number").val();

                                var chequeDate = $("#cheque_date").val();

                                if (chequeNo == "" || chequeDate == "") {
                                    swal("Empty 'Cheque Number' or 'Cheque Date'!", "Invoice cannot be created without filling the 'Cheque Number' and 'Cheque Date'!", "warning");
                                } else {

                                    $.when(
                                        window.open("./part_invoice_selected_pdf.php?selected_cus_id=" + selected_cus_id + "&cashier_id=" + logged_user + "&loggedusername=" + logged_user_name + "&paymentmethod=" + paymentmethod + "&chequecode=" + chequeNo + "&chequedate=" + chequeDate + "&partListTbl=" + partListTbl + "&master_total=" + master_total + "&discount=" + discountperc + "&finaltotal=" + finalprice + "&specialnotes=" + specialnotes + "&/", "_blank")
                                    ).then(function() {
                                        setTimeout(() => {
                                            window.location.href = '../invoice/invoice_list.php';
                                        }, 2550);
                                        swal({
                                            type: 'success',
                                            title: 'New Invoice Created!',
                                            text: 'New Invoice has been successfully created!',
                                            showConfirmButton: false,
                                            timer: 2500
                                        });
                                    });
                                }
                            } else {
                                swal("Please select Payment Option!", "Invoice cannot be created without a payment option!", "warning");
                            }

                        };
                    });
                }
            });

            $("#payment_method").change(function() {
                var method = $(this).val();

                if (method == 'cash') {
                    $("#card_tb").hide();
                    $("#card_tb").val('');

                    $("#cheque_number").hide();
                    $("#cheque_number").val('');

                    $("#cheque_date").hide();
                    $("#cheque_date").val('');

                    document.getElementById('genInvoice_btn').disabled = false;
                } else if (method == 'card') {
                    $("#card_tb").show();

                    $("#cheque_number").hide();
                    $("#cheque_number").val('');

                    $("#cheque_date").hide();
                    $("#cheque_date").val('');

                    document.getElementById('genInvoice_btn').disabled = false;

                } else if (method == 'cheque') {
                    $("#card_tb").hide();
                    $("#card_tb").val('');

                    $("#cheque_number").show();
                    $("#cheque_date").show();

                    document.getElementById('genInvoice_btn').disabled = false;
                } else {
                    document.getElementById('genInvoice_btn').disabled = true;
                }
            });

            $("#percentageTB").change(function() {

                var discountpercentage = $(this).val();

                if (discountpercentage < 0) {

                    $("#unrealpercentage").hide();
                    swal("Error!", "Negative Percentages are not allowed!", "warning");
                    $("#percentageTB").val(0);
                    $("#finalprice").val(master_total);

                } else if (discountpercentage >= 100) {

                    $("#unrealpercentage").hide();
                    swal("Error!", "Percentage cannot be more than 100!", "warning");
                    $("#percentageTB").val(0);
                    $("#finalprice").val(master_total);

                } else {

                    var percentageval = parseFloat(master_total) * (parseFloat(discountpercentage) / 100);

                    final_total = parseFloat(master_total) - parseFloat(percentageval);

                    $("#finalprice").val(final_total);
                }

            });

            $("#percentageTB").keyup(function() {

                var discountpercentage = $(this).val();

                if (discountpercentage < 0) {

                    $("#unrealpercentage").hide();
                    swal("Error!", "Negative Percentages are not allowed!", "warning");
                    $("#percentageTB").val(0);
                    $("#finalprice").val(master_total);

                } else if (discountpercentage >= 100) {

                    $("#unrealpercentage").hide();
                    swal("Error!", "Percentage cannot be more than 100!", "warning");
                    $("#percentageTB").val(0);
                    $("#finalprice").val(master_total);

                } else if (discountpercentage == '') {
                    $("#finalprice").val(master_total);

                } else {
                    if (discountpercentage >= 55 && discountpercentage <= 99) {
                        $("#unrealpercentage").show();
                    } else {
                        $("#unrealpercentage").hide();
                    }

                    var percentageval = parseFloat(master_total) * (parseFloat(discountpercentage) / 100);

                    final_total = parseFloat(master_total) - parseFloat(percentageval);

                    $("#finalprice").val(final_total);
                }

            });

            $("#part_invoice_list tbody").on("click", ".btn-del", function() {

                var currentRow = $(this).closest("tr");

                var priceCol = currentRow.find("td:eq(5)").text();

                var price = priceCol.split(" ")[1];

                master_total = master_total - parseFloat(price);

                $("#totalmprice").val(master_total);

                var perc_disc = parseFloat(master_total) * parseFloat(($("#percentageTB").val()) / 100);

                var ftotal = parseFloat(master_total) - parseFloat(perc_disc);

                $("#finalprice").val(ftotal);

                var id = $(this).closest("tr").attr("id");

                $(this).closest("tr").remove();

            });

            $("#searchcus").keyup(function() {

                $("#cus_sel").hide();

                var searchVal = $(this).val();

                if (searchVal.length < 1) {
                    $("#cus_search_result").hide();
                } else {
                    $.get("../../route/quotation/cusSearch.php", {
                        data: searchVal
                    }, function(data) {
                        $("#cus_search_result").show();
                        $("#cus_search_result").html(data);

                        $(".btn-info").click(function() {

                            var cusID = $(this).attr('id');

                            $("#cus_search_result").hide();

                            //send ajax request to confirm request

                            $.get("../../route/quotation/fetchCusResult.php", {
                                id: cusID
                            }, function(data) {

                                var jdata = jQuery.parseJSON(data);

                                $("#cus_sel").show();

                                // //show json data on HTML inputs
                                $("#sel_cus_id").html(jdata.cus_id);
                                $("#sel_cus_fname").html(jdata.cus_first_name);
                                $("#sel_cus_lname").html(jdata.cus_last_name);
                                $("#sel_cus_email").html(jdata.cus_email);

                                document.getElementById('searchcus').value = cusID;

                            });

                        });
                    });
                }
            });

            $("#telone").keyup(function() {
                $phonenolength = $(this).val();

                if ($phonenolength.length > 9) {
                    $("#error_tel_one").show();
                } else {
                    $("#error_tel_one").hide();
                }
            });

            $("#teltwo").keyup(function() {
                $phonenolength = $(this).val();

                if ($phonenolength.length > 9) {
                    $("#error_tel_two").show();
                } else {
                    $("#error_tel_two").hide();
                }
            });

            $("#search_part").keyup(function() {

                var searchVal = $(this).val();

                $.get("../../route/invoice_part/searchPart.php", {
                    data: searchVal
                }, function(data) {
                    if (searchVal.length < 1) {
                        $("#partInfo").hide();
                        $("#selected_prod").hide();
                    } else {
                        $("#partInfo").show();
                        $("#partInfo").html(data);

                        $(".btn-qtyremove").click(function() {
                            var removeQTY = $(this).attr('id');

                            var productID = removeQTY.split("REM")[1];

                            var textboxID = 'TXT' + productID;

                            var tbval = $('#' + textboxID).val();

                            $("#maxqty").hide();

                            if (tbval == 1) {
                                $("#MAXQTY" + productID).show();
                            } else {
                                $("#MAXQTY" + productID).hide();
                                var newval = parseInt(tbval) - 1;
                                $("#" + textboxID).val(newval);
                            }
                        });

                        $(".btn-qtyadd").click(function() {

                            var addQTY = $(this).attr('id');

                            var productID = addQTY.split("ADD")[1];

                            $.get("../../route/invoice_part/getPartStockQty.php", {
                                id: productID
                            }, function(data) {

                                var allowedQTY = data;

                                var textboxID = 'TXT' + productID;

                                var textboxval = $('#' + textboxID).val();

                                var newval = parseInt(textboxval) + 1;

                                if (newval <= allowedQTY) {
                                    $("#" + textboxID).val(newval);
                                    $("#MAXQTY" + productID).hide();
                                } else {
                                    swal("Not Enough Stocks!", "The quantity you require is greater than the stock count! Please, consider placing a production order.", "warning");
                                }
                            });
                        });

                        $(".btn-selectprod").click(function() {

                            $("#partInfo").hide();

                            var partid = $(this).attr('id');

                            $.get("../../route/invoice_part/fetchPartResult.php", {
                                id: partid
                            }, function(data) {
                                var jdata = jQuery.parseJSON(data);

                                partid = jdata.part_id;
                                partcode = jdata.part_code;
                                partname = jdata.part_name;
                                partdesc = jdata.part_desc;
                                partweight = jdata.part_weight;
                                partwunit = jdata.part_w_unit;
                                partunitprice = jdata.part_unit_price;
                                partreorderlevel = jdata.part_reorder_level;

                                document.getElementById('search_part').value = '';

                                var TableData = new Array();

                                $("#part_invoice_list tr").each(function(row, tr) {
                                    TableData[row] = {
                                        "partid": $(tr).find('td:eq(0)').text(),
                                        "itemcode": $(tr).find('td:eq(1)').text(),
                                        "partname": $(tr).find('td:eq(2)').text(),
                                        "unitprice": $(tr).find('td:eq(3)').text(),
                                        "qty": $(tr).find('td:eq(4)').text(),
                                        "totalprice": $(tr).find('td:eq(5)').text()
                                    }
                                });

                                TableData.shift();

                                var thistable = JSON.stringify(TableData);

                                if (thistable.includes(partid)) {
                                    swal("This Part is already included!", "Please remove the relevant row and re-enter the appropriate quantity", "warning");
                                } else {
                                    var unprice = parseFloat(partunitprice);

                                    var prtQty = parseFloat($("#TXT" + partid).val());

                                    var price = parseFloat(unprice * prtQty);

                                    $("#part_invoice_list tbody").append('<tr><td>' + partid + '</td><td>' + partcode + '</td><td>' + partname + '</td><td>Rs. ' + partunitprice + '.00</td><td>' + prtQty + '</td><td class="total-price">Rs. ' + price + '.00</td><td><button class="btn btn-danger btn-del" type="button"><i class="fas fa-trash"></i></button></td></tr>');

                                    master_total = parseFloat(master_total) + parseFloat(price);

                                    $("#totalmprice").val(master_total);

                                    $("#finalprice").val(master_total);
                                }
                            });
                        });
                    }
                });
            });

            $("#firstname").keyup(function() {

                $("#cus_sel").hide();

                var searchVal = $(this).val();

                if (searchVal.length < 1) {
                    $("#cus_search_result").hide();
                } else {
                    $.get("../../route/quotation/cusSearch.php", {
                        data: searchVal
                    }, function(data) {
                        $("#cus_search_result").show();
                        $("#cus_search_result").html(data);

                        $(".btn-info").click(function() {

                            var cusID = $(this).attr('id');

                            $("#cus_search_result").hide();

                            //send ajax request to confirm request

                            $.get("../../route/quotation/fetchCusResult.php", {
                                id: cusID
                            }, function(data) {

                                var jdata = jQuery.parseJSON(data);

                                $("#cus_sel").show();

                                // //show json data on HTML inputs
                                $("#sel_cus_id").html(jdata.cus_id);
                                $("#sel_cus_fname").html(jdata.cus_first_name);
                                $("#sel_cus_lname").html(jdata.cus_last_name);
                                $("#sel_cus_email").html(jdata.cus_email);

                                document.getElementById('searchcus').value = cusID;

                            });

                        });
                    });
                }
            });

            $("#lastname").keyup(function() {

                $("#cus_sel").hide();

                var searchVal = $(this).val();

                if (searchVal.length < 1) {
                    $("#cus_search_result").hide();
                } else {
                    $.get("../../route/quotation/cusSearch.php", {
                        data: searchVal
                    }, function(data) {
                        $("#cus_search_result").show();
                        $("#cus_search_result").html(data);

                        $(".btn-info").click(function() {

                            var cusID = $(this).attr('id');

                            $("#cus_search_result").hide();

                            //send ajax request to confirm request

                            $.get("../../route/quotation/fetchCusResult.php", {
                                id: cusID
                            }, function(data) {

                                var jdata = jQuery.parseJSON(data);

                                $("#cus_sel").show();

                                // //show json data on HTML inputs
                                $("#sel_cus_id").html(jdata.cus_id);
                                $("#sel_cus_fname").html(jdata.cus_first_name);
                                $("#sel_cus_lname").html(jdata.cus_last_name);
                                $("#sel_cus_email").html(jdata.cus_email);

                                document.getElementById('searchcus').value = cusID;

                            });

                        });
                    });
                }
            });

            $("#email").keyup(function() {

                $("#cus_sel").hide();

                var searchVal = $(this).val();

                if (searchVal.length < 1) {
                    $("#cus_search_result").hide();
                } else {
                    $.get("../../route/quotation/cusSearch.php", {
                        data: searchVal
                    }, function(data) {
                        $("#cus_search_result").show();
                        $("#cus_search_result").html(data);

                        $(".btn-info").click(function() {

                            var cusID = $(this).attr('id');

                            $("#cus_search_result").hide();

                            //send ajax request to confirm request

                            $.get("../../route/quotation/fetchCusResult.php", {
                                id: cusID
                            }, function(data) {

                                var jdata = jQuery.parseJSON(data);

                                $("#cus_sel").show();

                                // //show json data on HTML inputs
                                $("#sel_cus_id").html(jdata.cus_id);
                                $("#sel_cus_fname").html(jdata.cus_first_name);
                                $("#sel_cus_lname").html(jdata.cus_last_name);
                                $("#sel_cus_email").html(jdata.cus_email);

                                document.getElementById('searchcus').value = cusID;

                            });

                        });
                    });
                }
            });

            $("#telone").keyup(function() {

                $("#cus_sel").hide();

                var searchVal = $(this).val();

                if (searchVal.length < 1) {
                    $("#cus_search_result").hide();
                } else {
                    $.get("../../route/quotation/cusSearch.php", {
                        data: searchVal
                    }, function(data) {
                        $("#cus_search_result").show();
                        $("#cus_search_result").html(data);

                        $(".btn-info").click(function() {

                            var cusID = $(this).attr('id');

                            $("#cus_search_result").hide();

                            //send ajax request to confirm request

                            $.get("../../route/quotation/fetchCusResult.php", {
                                id: cusID
                            }, function(data) {

                                var jdata = jQuery.parseJSON(data);

                                $("#cus_sel").show();

                                // //show json data on HTML inputs
                                $("#sel_cus_id").html(jdata.cus_id);
                                $("#sel_cus_fname").html(jdata.cus_first_name);
                                $("#sel_cus_lname").html(jdata.cus_last_name);
                                $("#sel_cus_email").html(jdata.cus_email);

                                document.getElementById('searchcus').value = cusID;

                            });
                        });
                    });
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
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