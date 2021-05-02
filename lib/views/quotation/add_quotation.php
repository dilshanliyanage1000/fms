<?php
session_start();

include_once('../../inc/header.php');

if (isset($_SESSION['userId']) && ($_SESSION['user_role'] == 1 || $_SESSION['user_role'] == 3 || $_SESSION['user_role'] == 4)) {

?>
    <br>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Quotation</a></li>
        </ol>
    </div>

    <div class="col-md-12">
        <div class="jumbotron">
            <h1 class="display-5" style="text-align: center;"><i class="fas fa-file-contract"></i>&nbsp;&nbsp;Create Quotation</h1>
            <p class="lead" style="text-align: center;">Create quotation based on customer's requirements</p>
            <hr class="my-4">
            <br>
            <!-- quotation body -->
            <form id="quotation">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title"><i class="fas fa-user"></i>&nbsp;&nbsp;Customer Details</h5>
                </div>
                <br>
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
                            <label>Date of Issue <span class="text-danger">*</span></label>
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
                <div class="card-header header-elements-inline">
                    <h5 class="card-title"><i class="fas fa-box"></i>&nbsp;&nbsp;Product Selection</h5>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-5">
                        <div class="form-group">
                            <label>Search products for quotation:</label>
                            <input type="text" name="prod_search" id="prod_search" class="form-control" placeholder="Product Name (නිෂ්පාදන නාමය) / Manufacture Code (නිෂ්පාදන කේතය)">
                        </div>
                        <div id="prod_res_scroll_section" style="display: none; background-color: #eee;">
                            <div id="prodInfo"></div>
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <div style="border-left:1px solid #dbdbdb; height:350px"></div>
                    </div>
                    <div class="col-lg-6">
                        <div style="display: none;" id="selected_prod">
                            <div style="border: 5px solid #abe0d1; border-radius: 10px; padding: 25px;" id="p_sel_section">
                                <div class="row">
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <p>Code</p>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <p>Product Name</p>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <input type="text" name="sel_prod_id" id="sel_prod_id" class="form-control" disabled>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <input type="text" name="sel_prod_name" id="sel_prod_name" class="form-control" disabled>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <p>Unit Price</p>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <p>Quantity</p>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rs</span>
                                                </div>
                                                <input type="text" name="prod_price" id="prod_price" class="form-control" style="text-align: right;" disabled>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">.00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <input type="number" name="prod_qty" id="prod_qty" class="form-control" placeholder="Enter Quantity">
                                    </div>
                                </div>
                                <br>
                                <div align="right">
                                    <button id="addPRDtoQUOTE" class="btn btn-secondary" onclick="return false"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add to Quotation List</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr style="width:100%; margin-left:0; border: 1px solid #dbdbdb;">
                <br>
                <div class="card-header header-elements-inline">
                    <h5 class="card-title"><i class="fas fa-boxes"></i>&nbsp;&nbsp;Quotation Product List</h5>
                </div>
                <br>
                <div class="row" style="margin-bottom:20px;">
                    <table id="quote_list" class="table table-hover table-striped table-inverse table-responsive table-bordered" style="margin-left:10px; margin-top:10px; width:100%;">
                        <thead class="thead-inverse">
                            <tr>
                                <th>Item Code</th>
                                <th>Name</th>
                                <th>Capacity</th>
                                <th>Motor Capacity</th>
                                <th>Motor Speed</th>
                                <th>Current Phase</th>
                                <th>Unit Price</th>
                                <th>Qty</th>
                                <th>Total Price</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody id="quote_body"></tbody>
                    </table>
                </div>
                <div style="margin-bottom:20px; font-size: 18px;">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3">
                            Total Price&nbsp;:&nbsp;&nbsp;<input type="text" name="totalmprice" id="totalmprice" disabled>
                        </div>
                    </div>
                </div>
                <br>
                <hr style="width:100%; margin-left:0; border: 1px solid #dbdbdb;">
                <br>
                <div class="card-header header-elements-inline">
                    <h5 class="card-title"><i class="fas fa-info-circle"></i>&nbsp;&nbsp;Additional Info</h5>
                </div>
                <br>
                <div class="row" style="font-size: 15px;">
                    <div class="col-md-4">
                        <h6 class="d-block font-weight-semibold">Guarantee Period :</h6>
                        <div>
                            <input type="radio" name="guaranteeperiod" id="nowar" value="nowar">
                            <label>&nbsp;&nbsp;No Warranty</label>
                            <br>
                            <input type="radio" name="guaranteeperiod" id="oneyr" value="oneyr">
                            <label>&nbsp;&nbsp;01-year warranty</label>
                            <br>
                            <input type="radio" name="guaranteeperiod" id="oneyrexm" value="oneyrexm" checked>
                            <label>&nbsp;&nbsp;01-year warranty/ Excluding Motor</label>
                            <br>
                            <input type="radio" name="guaranteeperiod" id="twoyr" value="twoyr">
                            <label>&nbsp;&nbsp;02-year warranty</label>
                            <br>
                            <input type="radio" name="guaranteeperiod" id="twoyrexm" value="twoyrexm">
                            <label>&nbsp;&nbsp;02-year warranty/ Excluding Motor</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div>
                            <h6 class="d-block font-weight-semibold">E/Motor Guarantee :</h6>
                            <div>
                                <input type="radio" name="motorguarantee" id="threem" value="threem">
                                <label>&nbsp;&nbsp;03 months warranty</label>
                                <br>
                                <input type="radio" name="motorguarantee" id="sixm" value="sixm">
                                <label>&nbsp;&nbsp;06 months warranty</label>
                                <br>
                                <input type="radio" name="motorguarantee" id="ninem" value="ninem">
                                <label>&nbsp;&nbsp;09 months warranty</label>
                                <br>
                                <input type="radio" name="motorguarantee" id="oneymw" value="oneymw">
                                <label>&nbsp;&nbsp;01-year warranty</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h6 class="d-block font-weight-semibold">Quotation Validity :</h6>
                        <div>
                            <input type="radio" name="quotation-validity" id="30" value="30" checked>
                            <label>&nbsp;&nbsp;30 Days</label>
                            <br>
                            <input type="radio" name="quotation-validity" id="60" value="60">
                            <label>&nbsp;&nbsp;60 Days</label>
                            <br>
                            <input type="radio" name="quotation-validity" id="90" value="90">
                            <label>&nbsp;&nbsp;90 Days</label>
                        </div>
                    </div>
                </div>
                <br><br>
                <div class="row" style="margin-bottom:20px;">
                    <div class="col-md-6">
                        <h6 class="d-block font-weight-semibold">Payment Scheme :</h6>
                        <div>
                            <input type="radio" name="payment-scheme" id="prior" value="prior">
                            <label>&nbsp;&nbsp;Full payment prior to delivery</label>
                            <br>
                            <input type="radio" name="payment-scheme" id="30pay" value="30pay">
                            <label>&nbsp;&nbsp;30% advanced payment & remaining balance on delivery</label>
                            <br>
                            <input type="radio" name="payment-scheme" id="50pay" value="50pay" checked>
                            <label>&nbsp;&nbsp;50% advanced payment & remaining balance on delivery</label>
                            <br>
                            <input type="radio" name="payment-scheme" id="70pay" value="70pay">
                            <label>&nbsp;&nbsp;70% advanced payment & remaining balance on delivery</label>
                            <br>
                            <input type="radio" name="payment-scheme" id="fullpay" value="fullpay">
                            <label>&nbsp;&nbsp;Full payment on delivery</label>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <h6 class="d-block font-weight-semibold">Delivery Options :</h6>
                        <div>
                            <input type="radio" name="delivery-option" id="freedelivery" value="freedelivery">
                            <label>&nbsp;&nbsp;Free Delivery</label>
                            <br>
                            <input type="radio" name="delivery-option" id="nodelivery" value="nodelivery">
                            <label>&nbsp;&nbsp;No-Free Delivery</label>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-bottom:20px;">
                    <div class="col-md-12">
                        <h6 class="d-block font-weight-semibold">Additional/Special Notes :</h6>
                        <div>
                            <textarea class="form-group" style="width: 100%;" name="specialnotes" id="specialnotes" col="12" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <br>
                <div class="text-right">
                    <button type="button" id="genquote" class="btn btn-primary" onclick="return false"><i class="fas fa-check-double"></i>&nbsp;&nbsp;Generate Quotation</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;

        $("#date_of_issue").val(today);
    </script>

    <script>
        $(document).ready(function() {

            var firstname = 0;
            var lastname = 0;
            var email = 0;
            var code_phoneone = 0;
            var telone = 0;
            var code_phonetwo = 0;
            var teltwo = 0;
            var houseno = 0;
            var streetone = 0;
            var streettwo = 0;
            var city = 0;
            var postalcode = 0;

            var prodid = 0;
            var prodcode = 0;
            var prodname = 0;
            var proddesc = 0;
            var prodcapacity = 0;
            var prodmotorcapacity = 0;
            var prodmotorspeed = 0;
            var prodphase = 0;
            var produnitprice = 0;
            var prodqty = 0;

            var master_total = 0;

            var quotevalidity = 0;
            var paymentmethod = 0;
            var freedelivery = 0;
            var issuedate = $("#date_of_issue").val();


            if ($('input[name="guaranteeperiod"]:checked').val() == 'oneyrexm' || $('input[name="guaranteeperiod"]:checked').val() == 'twoyrexm') {
                $('input[type=radio][name=motorguarantee]').attr('disabled', true);
            } else {
                $('input[type=radio][name=motorguarantee]').attr('disabled', false);
            }

            $('input[type=radio][name=guaranteeperiod]').change(function() {

                if ($('input[name="guaranteeperiod"]:checked').val() == 'oneyrexm' || $('input[name="guaranteeperiod"]:checked').val() == 'twoyrexm') {
                    $('input[type=radio][name=motorguarantee]').attr('disabled', true);
                } else {
                    $('input[type=radio][name=motorguarantee]').attr('disabled', false);
                }
            });

            $("#prod_qty").keyup(function() {

                var qtyvalue = $(this).val();

                if (qtyvalue < 0) {
                    swal("Error!", "Negative values are not allowed!", "warning");
                    $("#prod_qty").val('');
                }
            });

            $("#prod_qty").change(function() {

                var qtyvalue = $(this).val();

                if (qtyvalue < 0) {
                    swal("Error!", "Negative values are not allowed!", "warning");
                    $("#prod_qty").val('');
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

            $("#genquote").click(function() {

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

                var guaranteeperiod = $('input[name="guaranteeperiod"]:checked').val();
                var motorguarantee = $('input[name="motorguarantee"]:checked').val();
                var quotevalidity = $('input[name="quotation-validity"]:checked').val();
                var paymentmethod = $('input[name="payment-scheme"]:checked').val();
                var freedelivery = $('input[name="freedelivery"]:checked').val();

                var specialnotes = $("#specialnotes").val();

                var TableData = new Array();

                $("#quote_list tr").each(function(row, tr) {
                    TableData[row] = {
                        "itemcode": $(tr).find('td:eq(0)').text(),
                        "prodname": $(tr).find('td:eq(1)').text(),
                        "capacity": $(tr).find('td:eq(2)').text(),
                        "motorocapacity": $(tr).find('td:eq(3)').text(),
                        "motorspeed": $(tr).find('td:eq(4)').text(),
                        "currentphase": $(tr).find('td:eq(5)').text(),
                        "unitprice": $(tr).find('td:eq(6)').text(),
                        "qty": $(tr).find('td:eq(7)').text(),
                        "totalprice": $(tr).find('td:eq(8)').text()
                    }
                });

                TableData.shift();

                var ProdListTbl = JSON.stringify(TableData);

                var selcusid = $("#sel_cus_id").html();

                if (selcusid == "") {
                    $.when(
                        window.open("./quotation_pdf.php?firstname=" + firstname + "&lastname=" + lastname + "&email=" + email + "&code_phoneone=" + code_phoneone + "&telone=" + telone + "&code_phonetwo=" + code_phonetwo + "&teltwo=" + teltwo + "&houseno=" + houseno + "&streetone=" + streetone + "&streettwo=" + streettwo + "&city=" + city + "&postalcode=" + postalcode + "&ProdListTbl=" + ProdListTbl + "&master_total=" + master_total + "&guaranteeperiod=" + guaranteeperiod + "&motorguarantee= " + motorguarantee + "&quotevalidity=" + quotevalidity + "&freedelivery=" + freedelivery + "&paymentmethod=" + paymentmethod + "&specialnotes=" + specialnotes + "&/", "_blank")
                    ).then(function() {
                        setTimeout(() => {
                            window.location.href = './quotation_list.php';
                        }, 2600);
                        swal({
                            type: 'success',
                            title: 'New Quotation Created!',
                            text: 'New Quotation has been successfully created!',
                            showConfirmButton: false,
                            timer: 2500
                        }).then((result) => {
                            if (result.dismiss === Swal.DismissReason.timer) {
                                $("#new_reminder").modal("hide");
                            }
                        });

                    });

                } else {

                    $.get("../../route/customer/getsingleCus.php", {
                        id: selcusid
                    }, function(data) {

                        var jdata = jQuery.parseJSON(data);
                        var selected_cus_id = jdata.cus_id;

                        $.when(
                            window.open("./quotation_selected_pdf.php?selected_cus_id=" + selected_cus_id + "&ProdListTbl=" + ProdListTbl + "&master_total=" + master_total + "&guaranteeperiod=" + guaranteeperiod + "&motorguarantee=" + motorguarantee + "&quotevalidity=" + quotevalidity + "&freedelivery=" + freedelivery + "&paymentmethod=" + paymentmethod + "&specialnotes=" + specialnotes + "&/", "_blank")
                        ).then(function() {

                            setTimeout(() => {
                                window.location.href = './quotation_list.php';
                            }, 2600);

                            swal({
                                type: 'success',
                                title: 'New Quotation Created!',
                                text: 'New Quotation has been successfully created!',
                                showConfirmButton: false,
                                timer: 2500
                            }).then((result) => {
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    $("#new_reminder").modal("hide");
                                }
                            });

                        });
                    });

                }
            });

            $("#quote_list tbody").on("click", ".btn-del", function() {

                var currentRow = $(this).closest("tr");

                var priceCol = currentRow.find("td:eq(8)").text();

                var price = priceCol.split(" ")[1];

                master_total = master_total - parseFloat(price);

                $("#totalmprice").val(master_total);

                var id = $(this).closest("tr").attr("id");

                $(this).closest("tr").remove();

            });

            $("#prod_search").keyup(function() {

                var searchVal = $(this).val();

                $.get("../../route/quotation/prodSearch.php", {
                    data: searchVal
                }, function(data) {

                    $("#prodInfo").show();
                    $("#prodInfo").html(data);

                    if (searchVal.length < 1) {

                        $("#prod_res_scroll_section").hide();
                        $("#selected_prod").hide();

                    } else {
                        $("#prod_res_scroll_section").show();

                        $("#prodInfo").html(data);

                        $(".btn-success").click(function() {

                            $("#prod_res_scroll_section").hide();

                            var prodID = $(this).attr('id');

                            $("#prod_number").val(prodID);
                            $("#prodInfo").hide();

                            //send ajax request to confirm request

                            $.get("../../route/quotation/fetchProdResult.php", {
                                id: prodID
                            }, function(data) {

                                var jdata = jQuery.parseJSON(data);

                                prodid = jdata.prod_id;
                                prodcode = jdata.prod_code;
                                prodname = jdata.prod_name;
                                proddesc = jdata.prod_description;
                                prodcapacity = jdata.prod_capacity;
                                prodmotorcapacity = jdata.prod_motor_capacity;
                                prodmotorspeed = jdata.prod_motor_speed;
                                prodphase = jdata.prod_phase;
                                produnitprice = jdata.prod_unit_price;

                                $("#selected_prod").show();

                                $("#sel_prod_id").val(jdata.prod_code);
                                $("#sel_prod_name").val(jdata.prod_name);
                                $("#prod_price").val(jdata.prod_unit_price);

                                document.getElementById('prod_search').value = prodID;
                            });
                        });
                    }
                });
            });

            $("#addPRDtoQUOTE").click(function() {

                var one = $("#prod_price").val();
                var two = $("#prod_qty").val();

                if (one == "" || two == "") {

                    $error_msg = "Kindly check whether 'Unit Price' and 'Quantity' have been filled out";

                    swal("Check your inputs!", $error_msg, "warning");

                } else {

                    var TableData = new Array();

                    $("#quote_list tr").each(function(row, tr) {
                        TableData[row] = {
                            "itemcode": $(tr).find('td:eq(0)').text(),
                            "prodname": $(tr).find('td:eq(1)').text(),
                            "capacity": $(tr).find('td:eq(2)').text(),
                            "motorocapacity": $(tr).find('td:eq(3)').text(),
                            "motorspeed": $(tr).find('td:eq(4)').text(),
                            "currentphase": $(tr).find('td:eq(5)').text(),
                            "unitprice": $(tr).find('td:eq(6)').text(),
                            "qty": $(tr).find('td:eq(7)').text(),
                            "totalprice": $(tr).find('td:eq(8)').text()
                        }
                    });

                    TableData.shift();

                    var ProdListTbl = JSON.stringify(TableData);

                    if (ProdListTbl.includes(prodcode)) {
                        swal("This Product is already included!", "Please remove the relevant row and re-enter the appropriate quantity", "warning");

                    } else {
                        $("#selected_prod").hide();

                        var unprice = parseFloat($("#prod_price").val());

                        var prdqty = parseFloat($("#prod_qty").val());

                        var price = parseFloat(unprice * prdqty);

                        $("#quote_list tbody").append('<tr><td>' + prodcode + '</td><td>' + prodname + '</td><td>' + prodcapacity + '</td><td>' + prodmotorcapacity + '</td><td>' + prodmotorspeed + '</td><td>' + prodphase + '</td><td style="text-align:right;">Rs. ' + unprice + '.00</td><td>' + prdqty + '</td><td class="total-price">Rs. ' + price + '.00</td><td><button class="btn btn-danger btn-del" type="button"><i class="far fa-trash-alt"></i></button></td></tr>');

                        master_total = parseFloat(master_total) + parseFloat(price);

                        $("#totalmprice").val(master_total);

                        document.getElementById('sel_prod_id').value = '';
                        document.getElementById('sel_prod_name').value = '';
                        document.getElementById('prod_price').value = '';
                        document.getElementById('prod_qty').value = '';
                        document.getElementById('prod_search').value = '';
                    }
                }
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