<?php
session_start();

include_once('../../inc/header.php');

if (isset($_SESSION['userId']) && ($_SESSION['user_role'] == 1 || $_SESSION['user_role'] == 3)) {

?>
    <style>
        #zoom {
            transition: transform .2s;
        }

        #zoom:hover {
            transform: scale(1.4);
        }

        .cancel {
            background-color: #FFCE67;
        }
    </style>
    <br>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Miscellaneous</a></li>
            <li class="breadcrumb-item active">Assign Parts to Product</li>
        </ol>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h1 class="display-5" style="text-align: center;"><i class="fas fa-clipboard-list"></i>&nbsp;&nbsp;Assign Parts to Products</h1>
                <p class="lead" style="text-align: center;">Assign parts with their respective quantities to products</p>
            </div>
            <br>
            <form id="rawmaterial_request_form" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>
                                <h6>Search for Products :</h6>
                            </label>
                            <input type="text" name="prod_search" id="prod_search" class="form-control" placeholder="Enter any Product Name..">
                        </div>
                        <div class="form-group">
                            <div class="container" id="prod_scroll_section" style="border: 3px #eee solid; overflow: auto; white-space: nowrap; background-color: #eee; display: none;">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div style="border-left:1px solid #dbdbdb; height:300px"></div>
                    </div>
                    <div class="col-md-5">
                        <div id="prod_sel_success" style="display: none; background-color: #f5fff5; width: 100%;border: 1px solid #eee; border-radius: 20px; padding-bottom: 10px;">
                            <br>
                            <h5 style="text-align: center; margin-left: 20px; color: #00cc00;"><i class="fas fa-check-double"></i>&nbsp;&nbsp;<u>Selected Product Details</u></h5>
                            <br>
                            <div class="row" style="margin-left: 10px;">
                                <div class="col-md-5">
                                    <h6>Product Code</h6>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <h6>:&nbsp;&nbsp;</h6>
                                        <h6 id="sel_prod_code"> </h6>
                                        <h6 style="display: none;" id="sel_prod_id"> </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-left: 10px; margin-top: 5px;">
                                <div class="col-md-5">
                                    <h6>Part Name</h6>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <h6>:&nbsp;&nbsp;</h6>
                                        <h6 id="sel_prod_name"> </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-left: 10px; margin-top: 5px;">
                                <div class="col-md-5">
                                    <h6>Output</h6>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <h6>:&nbsp;&nbsp;</h6>
                                        <h6 id="sel_prod_capacity"> </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-left: 10px; margin-top: 5px;">
                                <div class="col-md-5">
                                    <h6>Capacity</h6>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <h6>:&nbsp;&nbsp;</h6>
                                        <h6 id="sel_prod_motor"> </h6>&nbsp;<h6>(</h6>
                                        <h6 id="sel_prod_phase"> </h6>
                                        <h6>)</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-left: 10px; margin-top: 5px;">
                                <div class="col-md-5">
                                    <h6>Unit Price</h6>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <h6>:&nbsp;&nbsp;Rs.&nbsp;</h6>
                                        <h6 id="sel_punit_price"> </h6>
                                        <h6>.00</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-left: 10px; margin-top: 5px;">
                                <div class="col-md-5">
                                    <h6>Reorder Level</h6>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <h6>:&nbsp;&nbsp;</h6>
                                        <h6 id="sel_prod_reorder"> </h6>
                                        <h6>&nbsp;unit(s)</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="prod_sel_error" style="display: none; background-color: #fff9e3; text-align:center; width: 100%;border: 1px solid #eee; border-radius: 20px;">
                            <div style="margin: 15px;">
                                <i style="color: #ffcc00" class="fas fa-exclamation-triangle fa-3x"></i>
                            </div>
                            <div style="margin: 15px;">
                                <h4>This Product already has raw materials assigned to it!</h4>
                                <h6>If you wish to change it, please proceed to Part_product List below and remove the respective record, then reassign the part quantities.</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row" style="margin-bottom:20px;" align="center">
                    <div style="font-size:18px; display: none;" id="show_table">
                        <hr>
                        <h4 style="text-align: center;">Parts for Specific product</h4>
                        <br>
                        <table id="pt_tbl" class="table table-inverse table-hover table-responsive table-bordered" style="margin-top:10px; margin-left:100px;">
                            <thead class="thead-inverse">
                                <tr>
                                    <th style="min-width:100px; text-align: center;">Part Image</th>
                                    <th style="min-width:150px; text-align: center;">Part ID</th>
                                    <th style="min-width:150px; text-align: center;">Part Code</th>
                                    <th style="min-width:150px; text-align: center;">Part Name</th>
                                    <th style="min-width:100px; text-align: center;">Quantity</th>
                                </tr>
                            </thead>
                            <tbody id="pt_prod_body">
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                <div class="text-right">
                    <button type="button" id="assignPTtoPRD" class="btn btn-primary" onclick="return false"><i class="fas fa-paper-plane"></i>&nbsp;&nbsp;Assign Part to Products</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-12">
        <div class="jumbotron">
            <h1 class="display-5" style="text-align: center;"><i class="fas fa-clipboard-list"></i>&nbsp;&nbsp;Parts to Product List</h1>
            <hr class="my-4">
            <!-- our usual table -->
            <table id="allPartProdTable" class="table table-inverse table-responsive table-bordered" style="width:100%; margin-top:10px;">
                <thead class="thead-inverse">
                    <tr>
                        <th style="min-width: 150px; text-align: center;">Product ID</th>
                        <th style="min-width: 100px; text-align: center;">Code</th>
                        <th style="min-width: 100px; text-align: center;">Image</th>
                        <th style="min-width: 200px; text-align: center;">Product Name </th>
                        <th style="min-width: 400px; text-align: center;">Parts Description</th>
                        <th style="min-width: 50px; text-align: center;">Delete </th>
                    </tr>
                </thead>
                <tbody id="search_body_result">
                    <?php
                    include_once('../../functions/miscellaneous.php');
                    getAllPartProduct();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".sidebar-btn").click(function() {
                $(".wrapper").toggleClass("hideSide");
            });
        });
    </script>

    <script>
        $(document).ready(function() {

            $("#allPartProdTable").DataTable({
                dom: 'B<"clear">lfrtip',
                buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="fas fa-copy"></i>&nbsp;Copy to Clipboard',
                        exportOptions: {
                            columns: [2, 3]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i>&nbsp;Export to Excel',
                        exportOptions: {
                            columns: [2, 3]
                        },
                        title: "Udaya Industries [REPORT: PART-RM LIST]"
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fas fa-file-csv"></i>&nbsp;Export to CSV',
                        exportOptions: {
                            columns: [2, 3]
                        },
                        title: "Udaya Industries [REPORT: PART-RM LIST]"
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i>&nbsp;Export to PDF',
                        exportOptions: {
                            columns: [2, 3]
                        },
                        title: "Udaya Industries [REPORT: PART-RM LIST]"
                    }
                ]
            });

            document.getElementById("assignPTtoPRD").disabled = true;

            var prodID = '';
            var prodCode = '';
            var prodName = '';
            var prodCapacity = '';
            var prodMotor = '';
            var prodMotorSpeed = '';
            var prodCurrentPhase = '';
            var prodUnitPrice = '';
            var prodReorderLevel = '';
            var prodImagePath = '';

            $("#assignPTtoPRD").click(function() {

                var prod_id = $("#sel_prod_id").html();

                var TableData = new Array();

                $("#pt_tbl tr").each(function(row, tr) {

                    $(this).find('input').each(function() {

                        var qtyval = $(this).val();

                        TableData[row] = {
                            "partID": $(tr).find('td:eq(1)').text(),
                            "partQty": qtyval
                        }
                    })
                });

                TableData.shift();

                var ProdListTbl = JSON.stringify(TableData);

                if (ProdListTbl == '[]') {
                    swal("Failed to Assign Parts!", "No items with quantities to assign parts!", "warning");
                } else {
                    $.post("../../route/miscellaneous/newPartProd.php", {
                        id: prod_id,
                        PartProductList: ProdListTbl
                    }, function(data) {
                        if (data == "success") {
                            setTimeout(() => {
                                location.reload();
                            }, 2100);
                            swal({
                                type: 'success',
                                title: 'Parts have been assigned!',
                                text: 'Part has been successfully assigned to product',
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else {
                            swal("Check your inputs!", "Kindly check whether all the mandatory fields have been filled out", "warning");
                        }
                    })
                }
            });

            $("#prod_search").keyup(function() {

                var searchValue = $(this).val();

                if (searchValue.length < 1) {
                    $("#prod_scroll_section").hide();
                } else {

                    $.get("../../route/req_notes/prodSearch.php", {
                        data: searchValue
                    }, function(data) {

                        $("#prod_scroll_section").show();
                        $("#prod_scroll_section").html(data);

                        $(".btn-info").click(function() {

                            $prodID = $(this).attr('id');

                            $("#prod_scroll_section").hide();

                            $.get("../../route/req_notes/fetchProdResult.php", {
                                id: $prodID
                            }, function(data) {

                                var jdata = jQuery.parseJSON(data);

                                prodID = jdata.prod_id;

                                $("#prod_sel_success").hide();
                                $("#prod_sel_error").hide();

                                $.get("../../route/miscellaneous/validateprodonpart.php", {
                                    id: prodID
                                }, function(data) {
                                    if (data == "success") {
                                        $("#prod_sel_success").hide();
                                        $("#prod_sel_error").show();
                                    } else {
                                        $("#prod_sel_success").show();
                                        $("#prod_sel_error").hide();

                                        prodCode = jdata.prod_code;
                                        prodName = jdata.prod_name;
                                        prodCapacity = jdata.prod_capacity;
                                        prodMotor = jdata.prod_motor_capacity;
                                        prodMotorSpeed = jdata.prod_motor_speed;
                                        prodCurrentPhase = jdata.prod_phase;
                                        prodUnitPrice = jdata.prod_unit_price;
                                        prodReorderLevel = jdata.prod_reorder_level;
                                        prodImagePath = jdata.prod_img_path;

                                        $("#sel_prod_id").html(jdata.prod_id);
                                        $("#sel_prod_code").html(jdata.prod_code);
                                        $("#sel_prod_name").html(jdata.prod_name);
                                        $("#sel_prod_capacity").html(jdata.prod_capacity);
                                        $("#sel_prod_motor").html(jdata.prod_motor_capacity);
                                        $("#sel_prod_phase").html(jdata.prod_phase);
                                        $("#sel_punit_price").html(jdata.prod_unit_price);
                                        $("#sel_prod_reorder").html(jdata.prod_reorder_level);
                                        $(".btn-success").attr('id', jdata.prod_id);

                                        document.getElementById('prod_search').value = '';

                                        $.get("../../route/miscellaneous/getpartsbyprod.php", {
                                            data: jdata.prod_id
                                        }, function(data) {
                                            if (data == "") {
                                                swal("No Data to display!");
                                            } else {
                                                $("#show_table").show();
                                                $("#pt_prod_body").html(data);
                                                document.getElementById("assignPTtoPRD").disabled = false;

                                                $(".btn-qtyremove").click(function() {
                                                    var removeQTY = $(this).attr('id');

                                                    var partID = removeQTY.split("REM")[1];

                                                    var textboxID = 'TXT' + partID;

                                                    var tbval = $('#' + textboxID).val();

                                                    if (tbval == 1) {
                                                        var tbval = $('#' + textboxID).val(1);
                                                    } else {
                                                        var newval = parseInt(tbval) - 1;
                                                        $("#" + textboxID).val(newval);
                                                    }
                                                });

                                                $(".btn-qtyadd").click(function() {

                                                    var addQTY = $(this).attr('id');

                                                    var partID = addQTY.split("ADD")[1];

                                                    var textboxID = 'TXT' + partID;

                                                    var textboxval = $('#' + textboxID).val();

                                                    var newval = parseInt(textboxval) + 1;

                                                    $("#" + textboxID).val(newval);
                                                });
                                            }
                                        });
                                    }
                                });
                            });
                        });
                    })
                }
            });

            $("#allPartProdTable tbody").on("click", ".btn-del", function() {

                var id = $(this).attr("id");

                swal({
                        title: "Are you sure to delete?",
                        text: "You will not be able to recover this data!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Delete",
                        confirmButtonColor: "#AAAAAA",
                        cancelButtonText: "Cancel",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            $.post("../../route/miscellaneous/permenant_del_partprod.php", {
                                id: id
                            }, function(data) {
                                swal({
                                    type: 'success',
                                    title: 'Parts to Product deleted!',
                                    text: 'Relevant information has been permenantly deleted!',
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                            });
                        } else {
                            swal({
                                type: 'warning',
                                title: 'Cancelled!',
                                text: 'Information remains!',
                                showConfirmButton: false,
                                timer: 2000
                            })
                        }
                    });
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