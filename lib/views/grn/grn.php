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
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Goods Recieved Note</a></li>
        </ol>
    </div>

    <div class="content-wrapper">
        <div class="content">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <br>
                    <h2 class="card-title" style="text-align: center;"><i class="fas fa-file-invoice"></i>&nbsp;&nbsp;Goods Recieved Note</h2>
                    <br>
                </div>
                <div class="card-body">
                    <form id="goodsrecievednote" enctype="multipart/form-data">
                        <h4 class="card-title">GRN Details</h4>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="grn_supplier">Goods Supplier :</label>
                                    <select class="custom-select" name="grn_supplier" id="grn_supplier">
                                        <?php
                                        include_once("../../functions/grn.php");
                                        getSupplierforSelect();
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>System Date :</label>
                                <input type="text" name="date_of_issue" id="date_of_issue" class="form-control" disabled />
                            </div>
                            <div class="col-md-4">
                                <label>Logged User :</label>
                                <input type="text" name="logged_user" id="logged_user" value="<?php echo ($_SESSION['userId']); ?>" class="form-control" disabled />
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <label>GRN Ref.No :</label>
                                <input type="text" name="grn_refno" id="grn_refno" class="form-control" placeholder="Enter received GRN reference number" />
                            </div>
                            <div class="col-md-4">
                                <label>Payment Status :</label>
                                <select class="custom-select" name="payment_stt" id="payment_stt">
                                    <option value="Pending">Pending</option>
                                    <option value="Paid">Paid</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label style="display: inline-block;" id="ifpending">Payment Due Date :</label>
                                <label style="display: none;" id="ifpaid">Payment Paid Date :</label>
                                <input type="date" name="due_date" id="due_date" min="" class="form-control" />
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Recieved Warehouse :</label>
                                <select class="custom-select" name="warehouse" id="warehouse">
                                    <?php
                                    include_once("../../functions/grn.php");
                                    getWarehouseforSelect();
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Upload Scanned GRN :</label>
                                <div class="input-group mb-3" style="z-index: 0;">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="grn_note" id="grn_note">
                                        <label class="custom-file-label" for="grn_note">Choose file</label>
                                    </div>
                                </div>
                                <p id="grn_img" style="color: red;"></p>
                            </div>
                            <div class="col-md-4">
                                <label>Additional/Extra Notes :</label>
                                <input type="text" name="additionalnotes" id="additionalnotes" placeholder="Enter any additional notes provided in the GRN" class="form-control" />
                            </div>
                        </div>
                        <hr class="my-4">
                        <h4 class="card-title">Received Raw Materials List</h4>
                        <br>
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label>Search for receieved Raw Materials :</label>
                                    <input type="text" name="rm_search" id="rm_search" class="form-control" placeholder="Enter any raw materials to select...">
                                </div>
                                <div id="prod_res_scroll_section" style="display: none;">
                                    <div id="rawmatInfo"></div>
                                </div>
                            </div>
                            <div class="col-lg-1">
                                <div style="border-left:1px solid #dbdbdb; height:350px"></div>
                            </div>
                            <div class="col-lg-6">
                                <div style="display: none;" id="selected_rm">
                                    <div style="border: 5px solid #abe0d1; border-radius: 10px; padding: 25px;" id="p_sel_section">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <p>Raw Material ID</p>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <p>Name</p>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <input type="text" name="sel_rm_id" id="sel_rm_id" class="form-control" disabled>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <input type="text" name="sel_rm_name" id="sel_rm_name" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <p>Unit Price</p>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <p>Quantity (in Kg)</p>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <input type="number" name="rm_unitprice" id="rm_unitprice" placeholder="Enter Unit Price" class="form-control">
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <input type="number" name="rm_quantity" id="rm_quantity" placeholder="Enter Quantity" class="form-control">
                                            </div>
                                        </div>
                                        <br>
                                        <div align="right">
                                            <button id="addRM" class="btn btn-secondary" onclick="return false"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add to GRN Items</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr style="width:100%; margin-left:0; border: 1px solid #dbdbdb;">
                        <br>
                        <h5 class="card-title">Recieved Materials List</h5>
                        <br>
                        <div class="col-md-12" style="display: none;" id="list_table">
                            <div class="row" style="margin-bottom:20px; font-size: 18px;">
                                <table id="grn_list" class="table table-hover table-inverse table-responsive table-bordered" style="margin-top:10px; margin-left: 20px; width:100%; text-align: center;">
                                    <thead class="thead-inverse">
                                        <tr>
                                            <th style="width: 300px;">Raw Material Code</th>
                                            <th style="width: 300px;">Name</th>
                                            <th style="width: 300px;">Unit Price</th>
                                            <th style="width: 300px;">Quantity</th>
                                            <th style="width: 300px;">Total Price</th>
                                            <th style="width: 300px;">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody id="grn_body"></tbody>
                                </table>
                            </div>
                            <div class="row" style="font-size: 18px;">
                                <div class="col-md-8"></div>
                                <div class="col-md-4">
                                    <b>Total Price&nbsp;:&nbsp;&nbsp;Rs.&nbsp;</b><input style="padding: 5px; text-align: right;" type="text" name="totalmprice" id="totalmprice" disabled /><b>&nbsp;.00</b>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <br>
                        <div class="text-right">
                            <button type="button" id="genGRN" class="btn btn-primary" onclick="return false"><i class="fas fa-paper-plane"></i>&nbsp;&nbsp;Save Goods Recieved Note</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;

        $("#date_of_issue").val(today);
        $("#due_date").attr('min', today);
    </script>

    <script>
        $(document).ready(function() {

            var supplier = '';
            var grnRefNo = '';
            var paymentstatus = '';
            var issuedate = '';
            var paymentduedate = '';
            var warehouse = '';
            var additionalnotes = '';
            var userid = '';
            var mastertotalprice = '';

            var rmid = '';
            var rmname = '';
            var rmdesc = '';
            var rmunitprice = 0;
            var rmreorderlevel = 0;

            var TableData;
            var prodqty = 0;
            var master_total = 0;

            $("#payment_stt").change(function() {
                if ($("#payment_stt").val() == 'Pending') {
                    $("#ifpending").show();
                    $("#ifpaid").hide();

                } else {
                    $("#ifpending").hide();
                    $("#ifpaid").show();
                }
            });

            $("#rm_unitprice").keyup(function() {

                var qtyvalue = $(this).val();

                if (qtyvalue < 0) {
                    swal("Error!", "Negative values are not allowed!", "warning");
                    $("#rm_unitprice").val('');
                }
            });

            $("#rm_unitprice").change(function() {

                var qtyvalue = $(this).val();

                if (qtyvalue < 0) {
                    swal("Error!", "Negative values are not allowed!", "warning");
                    $("#rm_unitprice").val('');
                }
            });

            $("#rm_quantity").keyup(function() {

                var qtyvalue = $(this).val();

                if (qtyvalue < 0) {
                    swal("Error!", "Negative values are not allowed!", "warning");
                    $("#rm_quantity").val('');
                } else if (qtyvalue % 1 !== 0) {
                    swal("Error!", "Decimals are not allowed!", "warning");
                    $("#rm_quantity").val('');
                }
            });

            $("#rm_quantity").change(function() {

                var qtyvalue = $(this).val();

                if (qtyvalue < 0) {
                    swal("Error!", "Negative values are not allowed!", "warning");
                    $("#rm_quantity").val('');
                } else if (qtyvalue % 1 !== 0) {
                    swal("Error!", "Decimals are not allowed!", "warning");
                    $("#rm_quantity").val('');
                }
            });


            document.getElementById('genGRN').disabled = true;

            $('#grn_note').change(function() {
                var read = new FileReader();
                read.readAsDataURL(this.files[0]);

                var fileName = this.files[0].name
                fileName = '<i class="fas fa-check-circle"></i>&nbsp;&nbsp;Selected File Name : ' + fileName;

                $('#grn_img').html(fileName);
            });

            $("#genGRN").click(function() {

                if ($("#grn_note").val() == '') {

                    swal("Missing Supplier's Invoice Scan", "Please scan and upload the supplier's invoice!", "warning");

                } else {

                    swal({
                            title: "Create GRN?",
                            text: "Please re-check all information! You cannot change data after creating the GRN",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Create GRN",
                            cancelButtonColor: "#eb4034",
                            cancelButtonText: "Wait!",
                            closeOnConfirm: false,
                            closeOnCancel: false
                        },
                        function(isConfirm) {
                            if (isConfirm) {
                                supplier = $("#grn_supplier").val();
                                warehouse = $("#warehouse").val();
                                grnRefNo = $("#grn_refno").val();
                                paymentstatus = $("#payment_stt").val();
                                issuedate = $("#date_of_issue").val();
                                paymentduedate = $("#due_date").val();
                                warehouse = $("#warehouse").val();
                                additionalnotes = $("#additionalnotes").val();
                                userid = $("#logged_user").val();

                                var TableData = new Array();

                                $("#grn_list tr").each(function(row, tr) {
                                    TableData[row] = {
                                        "rawmatID": $(tr).find('td:eq(0)').text(),
                                        "rawmatName": $(tr).find('td:eq(1)').text(),
                                        "rmUnitPrice": $(tr).find('td:eq(2)').text(),
                                        "rmQty": $(tr).find('td:eq(3)').text(),
                                        "rmTotalPrice": $(tr).find('td:eq(4)').text()
                                    }
                                });

                                TableData.shift();

                                var RMListTbl = JSON.stringify(TableData);

                                var form = $('#goodsrecievednote')[0];

                                var formData = new FormData(form);

                                mastertotalprice = $("#totalmprice").val();

                                formData.append('userID', userid);

                                formData.append('totalmprice', mastertotalprice);

                                $.ajax({
                                    url: "../../route/grn/saveGRN.php",
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    type: 'POST',
                                    success: function(data) {

                                        if (data == "success") {
                                            window.open("./grn_pdf.php?paymentstatus=" + paymentstatus + "&warehouseid=" + warehouse + "&supplierid=" + supplier + "&grnrefno=" + grnRefNo + "&additionalnotes=" + additionalnotes + "&RMListTbl=" + RMListTbl + "&master_total=" + mastertotalprice + "&/", "_blank");

                                            setTimeout(() => {
                                                window.location.href = './grn_list.php';
                                            }, 2550);

                                            swal({
                                                type: 'success',
                                                title: 'New GRN added!',
                                                text: 'New GRN has been successfully registered',
                                                showConfirmButton: false,
                                                timer: 2500
                                            });

                                        } else if (data == 'ext_error') {

                                            swal("File Type Error!", "You can only upload .PDF files!", "warning");

                                        } else {

                                            $error_msg = "Kindly check whether all the mandatory fields have been filled out";

                                            swal("Check your inputs!", $error_msg, "warning");
                                        }
                                    }
                                });
                            } else {
                                $("#new_reminder").modal("hide");
                            }
                        });
                }
            });

            $("#grn_list tbody").on("click", ".btn-del", function() {

                var currentRow = $(this).closest("tr");

                var priceCol = currentRow.find("td:eq(4)").text();

                var price = priceCol.split(" ")[1];

                master_total = master_total - parseFloat(price);

                $("#totalmprice").val(master_total);

                var id = $(this).closest("tr").attr("id");

                $(this).closest("tr").remove();

            });

            $("#rm_search").keyup(function() {

                var searchVal = $(this).val();

                var selectedsupplier = $("#grn_supplier").val();

                if (selectedsupplier == '') {
                    swal("Please select supplier", "Select supplier to view their respective materials", "warning");
                    document.getElementById('rm_search').value = '';
                } else {
                    $.get("../../route/grn/rmSearch.php", {
                        search: searchVal,
                        supplier: selectedsupplier
                    }, function(data) {

                        $("#rawmatInfo").show();
                        $("#rawmatInfo").html(data);

                        if (searchVal.length < 1) {

                            $("#prod_res_scroll_section").hide();
                            $("#selected_rm").hide();

                        } else {
                            $("#prod_res_scroll_section").show();

                            $("#rawmatInfo").html(data);

                            $(".btn-success").click(function() {

                                $("#prod_res_scroll_section").hide();

                                var rmID = $(this).attr('id');

                                $("#rm_search").val(rmID);
                                $("#rawmatInfo").hide();

                                $.get("../../route/grn/fetchRMResult.php", {
                                    id: rmID
                                }, function(data) {

                                    var jdata = jQuery.parseJSON(data);

                                    rmid = jdata.rm_id;
                                    rmname = jdata.rm_name;
                                    rmdesc = jdata.rm_description;
                                    rmunitprice = jdata.rm_unit_price;
                                    rmreorderlevel = jdata.rm_reorder_level;

                                    $("#selected_rm").show();

                                    $("#sel_rm_id").val(jdata.rm_id);
                                    $("#sel_rm_name").val(jdata.rm_name);
                                    $("#rm_unitprice").val(jdata.rm_unit_price);

                                    document.getElementById('rm_search').value = '';
                                });
                            });
                        }
                    });
                }
            });

            $("#addRM").click(function() {

                var one = $("#rm_unitprice").val();
                var two = $("#rm_quantity").val();

                if (one == "" || two == "") {

                    $error_msg = "Kindly check whether 'Unit Price' and 'Quantity' have been filled out";

                    swal("Check your inputs!", $error_msg, "warning");

                    document.getElementById('genGRN').disabled = true;

                } else if (one == "0" || two == "0") {

                    $error_msg = "Kindly enter valid 'Unit Price' and 'Quantity' values";

                    swal("0 is not allowed", $error_msg, "warning");

                    document.getElementById('genGRN').disabled = true;

                } else {

                    var TableData = new Array();

                    $("#grn_list tr").each(function(row, tr) {
                        TableData[row] = {
                            "rmID": $(tr).find('td:eq(0)').text(),
                            "rmName": $(tr).find('td:eq(1)').text(),
                            "rmUnitPrice": $(tr).find('td:eq(2)').text(),
                            "rmQty": $(tr).find('td:eq(3)').text(),
                            "rmTotalPrice": $(tr).find('td:eq(4)').text()
                        }
                    });

                    TableData.shift();

                    var thistable = JSON.stringify(TableData);

                    if (thistable.includes(rmid)) {

                        swal("This Raw Material is already included!", "Please remove the relevant row and re-enter the appropriate quantity", "warning");
                        document.getElementById('sel_rm_id').value = '';
                        document.getElementById('sel_rm_name').value = '';
                        document.getElementById('rm_unitprice').value = '';
                        document.getElementById('rm_quantity').value = '';
                        $("#p_sel_section").hide();

                    } else {

                        $("#list_table").show();

                        $("#list_table_mprice").show();

                        var unprice = parseFloat($("#rm_unitprice").val());

                        var prdqty = parseFloat($("#rm_quantity").val());

                        var price = parseFloat(unprice * prdqty);

                        $("#grn_list tbody").append('<tr><td>' + rmid + '</td><td>' + rmname + '</td><td>Rs. ' + unprice + '.00</td><td>' + prdqty + ' Kg(s)</td><td>Rs. ' + price + '.00</td><td><button class="btn btn-danger btn-del" type="button"><i class="far fa-trash-alt"></i></button></td></tr>');

                        master_total = parseFloat(master_total) + parseFloat(price);

                        $("#totalmprice").val(master_total);

                        document.getElementById('sel_rm_id').value = '';
                        document.getElementById('sel_rm_name').value = '';
                        document.getElementById('rm_unitprice').value = '';
                        document.getElementById('rm_quantity').value = '';
                        document.getElementById('rm_search').value = '';

                        $("#selected_rm").hide();

                        document.getElementById('genGRN').disabled = false;
                    }
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