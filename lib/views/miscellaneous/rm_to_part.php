<?php
session_start();

include_once('../../inc/header.php');

if (isset($_SESSION['userId']) && ($_SESSION['user_role'] == 1 || $_SESSION['user_role'] == 3)) {

    include_once('../../inc/sidenav.php');

?>
    <style>
        #zoom {
            transition: transform .2s;
        }

        #zoom:hover {
            transform: scale(1.5);
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
            <li class="breadcrumb-item active">Raw Material to Part</li>
        </ol>
    </div>

    <div class="content-wrapper">
        <div class="content">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h2 class="card-title" style="text-align: center;"><i class="fas fa-clipboard-list"></i>&nbsp;&nbsp;Assign Raw Material to Parts</h2>
                    <br>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="reload"></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form id="rawmaterial_request_form" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>
                                        <h6>Search for Part :</h6>
                                    </label>
                                    <input type="text" name="part_search" id="part_search" class="form-control" placeholder="Enter any Part Name..">
                                </div>
                                <div class="form-group">
                                    <div class="container" id="part_scroll_section" style="border: 3px #eee solid; overflow: auto; white-space: nowrap; background-color: #eee; display: none;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div style="border-left:1px solid #dbdbdb; height:300px"></div>
                            </div>
                            <div class="col-md-6">
                                <div id="partsel_success" style="display: none; background-color: #f5fff5; width: 100%;border: 1px solid #eee; border-radius: 20px; padding-bottom: 10px;">
                                    <br>
                                    <h5 style="text-align: center; margin-left: 20px; color: #00cc00;"><i class="fas fa-check-double"></i>&nbsp;&nbsp;<u>Selected Part Details</u></h5>
                                    <br>
                                    <div class="row" style="margin-left: 10px;">
                                        <div class="col-md-5">
                                            <h6>Part Code</h6>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <h6>:&nbsp;&nbsp;</h6>
                                                <h6 id="sel_pcode"> </h6>
                                                <h6 style="display: none;" id="sel_pid"> </h6>
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
                                                <h6 id="sel_pname"> </h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-left: 10px; margin-top: 5px;">
                                        <div class="col-md-5">
                                            <h6>Weight</h6>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <h6>:&nbsp;&nbsp;</h6>
                                                <h6 id="sel_pweight"> </h6>
                                                <h6 id="sel_pwunit"> </h6>
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
                                                <h6 id="sel_preorderlevel"> </h6>
                                                <h6>&nbsp;unit(s)</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="partsel_error" style="display: none; background-color: #fff9e3; text-align:center; width: 100%;border: 1px solid #eee; border-radius: 20px;">
                                    <div style="margin: 15px;">
                                        <i style="color: #ffcc00" class="fas fa-exclamation-triangle fa-3x"></i>
                                    </div>
                                    <div style="margin: 15px;">
                                        <h4>This Part already has raw materials assigned to it!</h4>
                                        <h6>If you wish to change it, please proceed to RM-Part List and remove the respective record, then reassign the new materials.</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="row" style="margin-bottom: 30px;">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        <h6>Search raw materials:</h6>
                                    </label>
                                    <input type="text" name="rm_search" id="rm_search" class="form-control" placeholder="Enter any Raw Material Name..">
                                </div>
                                <div class="form-group">
                                    <div class="container" id="rawmat_scroll_section" style="border: 3px #eee solid; overflow: auto; white-space: nowrap; background-color: #eee; display: none;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="display: none;" id="selected_rm">
                                    <div style="border: 5px solid #abe0d1; border-radius: 10px; padding: 25px;" id="p_sel_section">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <p>Raw Material Name</p>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <p>Quantity & Unit</p>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <input type="text" name="rmName" id="rmName" class="form-control" disabled>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <div class="input-group mb-3">
                                                            <input type="number" name="rm_qty" id="rm_qty" class="form-control">
                                                            <div class="input-group-append">
                                                                <select class="custom-select" name="rm_punit" id="rm_punit">
                                                                    <option value="mg">mg</option>
                                                                    <option value="g">g</option>
                                                                    <option value="kg" selected="">kg</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-12" id="invalid_qty" style="display:none; color:red;">
                                                <p><i class="far fa-times-circle"></i>&nbsp;&nbsp;Invalid Quantity: Quantity cannot be less than 0!!</p>
                                            </div>
                                        </div>
                                        <br>
                                        <div align="right">
                                            <button id="addRMtoPT" class="btn btn-secondary" onclick="return false"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add to List</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <hr>
                        <div class="row" style="font-size:18px; margin-bottom:20px; display: none;" id="show_table">
                            <h5>Required Raw Materials</h5>
                            <table id="rm_tbl" class="table table-hover table-inverse table-responsive table-bordered" style="margin-top:10px; margin-left:10px; width:100%;">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th style="min-width:150px;">Material ID</th>
                                        <th style="min-width:150px;">Raw Material Name</th>
                                        <th style="min-width:150px;">Quantity</th>
                                        <th style="min-width:150px;">Unit</th>
                                        <th style="min-width:100px;">Delete</th>
                                    </tr>
                                </thead>
                                <tbody id="reqlist_body"></tbody>
                            </table>
                        </div>
                        <br>
                        <div class="text-right">
                            <button type="button" id="assignRMtoPT" class="btn btn-primary" onclick="return false"><i class="fas fa-paper-plane"></i>&nbsp;&nbsp;Assign Materials to Part</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="jumbotron">
            <h1 class="display-5" style="text-align: center;"><i class="fas fa-clipboard-list"></i>&nbsp;&nbsp;Raw Material to Parts List</h1>
            <hr class="my-4">
            <!-- our usual table -->
            <table id="allPartRM" class="table table-hover table-inverse table-responsive table-bordered" style="width:100%; margin-top:10px;">
                <thead class="thead-inverse">
                    <tr>
                        <th style="min-width: 100px;">Part ID</th>
                        <th style="min-width: 100px;">Part Image</th>
                        <th style="min-width: 250px;">Part Name </th>
                        <th style="min-width: 500px;">Raw Material Description</th>
                        <th style="min-width: 100px;">Delete </th>
                    </tr>
                </thead>
                <tbody id="search_body_result">
                    <?php
                    include_once('../../functions/miscellaneous.php');
                    getAllRmParts()
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

            $("#allPartRM").DataTable({
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

            document.getElementById("assignRMtoPT").disabled = true;

            var partID = '';
            var partCode = '';
            var partName = '';
            var partWeight = '';
            var partWUnit = '';
            var partDesc = '';
            var partUnitPrice = '';
            var partReorderLevel = '';

            var rmID = '';
            var rmName = '';
            var rmDesc = '';
            var rmUnitPrice = '';
            var rmReorderLevel = '';



            $("#rm_qty").keyup(function() {

                var rm_qty = $("#rm_qty").val();

                $("#invalid_qty").hide();

                document.getElementById("addRMtoPT").disabled = false;

                if (rm_qty < 0) {
                    $("#invalid_qty").show();
                    document.getElementById("addRMtoPT").disabled = true;
                } else {
                    $("#invalid_qty").hide();
                    document.getElementById("addRMtoPT").disabled = false;
                }

            });

            $("#rm_qty").change(function() {

                var rm_qty = $("#rm_qty").val();

                $("#invalid_qty").hide();

                document.getElementById("addRMtoPT").disabled = false;

                if (rm_qty < 0) {
                    $("#invalid_qty").show();
                    document.getElementById("addRMtoPT").disabled = true;
                } else {
                    $("#invalid_qty").hide();
                    document.getElementById("addRMtoPT").disabled = false;
                }

            });

            $("#assignRMtoPT").click(function() {

                var pt_id = $("#sel_pid").html();

                var TableData = new Array();

                $("#rm_tbl tr").each(function(row, tr) {
                    TableData[row] = {
                        "rmID": $(tr).find('td:eq(0)').text(),
                        "rmName": $(tr).find('td:eq(1)').text(),
                        "rmQty": $(tr).find('td:eq(2)').text(),
                        "rmUnit": $(tr).find('td:eq(3)').text()
                    }
                });

                TableData.shift();

                var PartRMList = JSON.stringify(TableData);

                $.post("../../route/miscellaneous/assignPartRM.php", {
                    pt_id: pt_id,
                    PartRMList: PartRMList
                }, function(data) {
                    if (data == "success") {
                        setTimeout(() => {
                            location.reload();
                        }, 2100);
                        swal({
                            type: 'success',
                            title: 'Raw Materials Assigned!',
                            text: 'New Raw Materials has been assigned to Part!',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    } else {
                        $error_msg = "Kindly check whether all the mandatory fields have been filled out";
                        swal("Check your inputs!", $error_msg, "warning");
                    }
                });
            });

            document.getElementById('rm_search').disabled = true;

            $("#part_search").keyup(function() {

                var searchValue = $(this).val();

                if (searchValue.length < 1) {
                    $("#part_scroll_section").hide();
                } else {

                    $.get("../../route/miscellaneous/partSearch.php", {
                        data: searchValue
                    }, function(data) {

                        $("#part_scroll_section").show();
                        $("#part_scroll_section").html(data);

                        $(".btn-info").click(function() {

                            $partID = $(this).attr('id');

                            $("#part_scroll_section").hide();

                            $.get("../../route/part/getsinglePart.php", {
                                id: $partID
                            }, function(data) {

                                var jdata = jQuery.parseJSON(data);

                                partID = jdata.part_id;

                                $("#partsel_success").hide();
                                $("#partsel_error").hide();

                                $.get("../../route/miscellaneous/validatepartonrm.php", {
                                    id: partID
                                }, function(data) {
                                    if (data == "success") {
                                        $("#partsel_success").hide();
                                        $("#partsel_error").show();
                                    } else {
                                        $("#partsel_success").show();
                                        $("#partsel_error").hide();

                                        partCode = jdata.part_code;
                                        partName = jdata.part_name;
                                        partWeight = jdata.part_weight;
                                        partWUnit = jdata.part_w_unit;
                                        partDesc = jdata.part_desc;
                                        partUnitPrice = jdata.part_unit_price;
                                        partReorderLevel = jdata.part_reorder_level;

                                        $("#sel_pid").html(jdata.part_id);
                                        $("#sel_pcode").html(jdata.part_code);
                                        $("#sel_pname").html(jdata.part_name);
                                        $("#sel_pweight").html(jdata.part_weight);
                                        $("#sel_pwunit").html(jdata.part_w_unit);
                                        $("#sel_punit_price").html(jdata.part_unit_price);
                                        $("#sel_preorderlevel").html(jdata.part_reorder_level);

                                        document.getElementById('part_search').value = '';

                                        document.getElementById('rm_search').disabled = false;
                                    }
                                });
                            });
                        });
                    })
                }
            });

            $("#rm_search").keyup(function() {

                var searchValue = $(this).val();

                if (searchValue.length < 1) {
                    $("#rawmat_scroll_section").hide();
                } else {

                    $.get("../../route/rawmaterial/searchRawMat.php", {
                        data: searchValue
                    }, function(data) {

                        $("#rawmat_scroll_section").show();
                        $("#rawmat_scroll_section").html(data);

                        $(".btn-info").click(function() {

                            $rmID = $(this).attr('id');

                            $("#rawmat_scroll_section").hide();

                            $.get("../../route/rawmaterial/getsingleRawMat.php", {
                                id: $rmID
                            }, function(data) {

                                var jdata = jQuery.parseJSON(data);

                                rmID = jdata.rm_id;
                                rmName = jdata.rm_name;
                                rmDesc = jdata.rm_desc;
                                rmUnitPrice = jdata.rm_unit_price;
                                rmReorderLevel = jdata.rm_reorder_level;

                                $("#selected_rm").show();

                                $("#rmName").val(jdata.rm_name);

                                document.getElementById('rm_search').value = '';
                            });
                        });

                    })
                }
            });



            $("#addRMtoPT").click(function() {

                var rm_qty = $("#rm_qty").val();

                var rm_punit = $("#rm_punit").val();

                if (rm_qty == "" || rm_qty < 0) {

                    $error_msg = "Kindly check whether 'Quantity' has been filled out";

                    swal("Check your inputs!", $error_msg, "warning");

                } else {

                    $("#show_table").show();

                    $("#rm_tbl tbody").append('<tr><td>' + rmID + '</td><td>' + rmName + '</td><td>' + rm_qty + '</td><td>' + rm_punit + '</td><td><button style="text-align:center;" class="btn btn-danger btn-del" type="button"><i class="far fa-trash-alt"></i></button></td></tr>');

                    document.getElementById('rmName').value = '';
                    document.getElementById('rm_qty').value = '';
                    document.getElementById('rm_punit').value = 'mg';

                    $("#selected_rm").hide();

                    document.getElementById("assignRMtoPT").disabled = false;
                }
            });

            $("#rm_tbl tbody").on("click", ".btn-del", function() {

                var id = $(this).closest("tr").attr("id");

                $(this).closest("tr").remove();

            });

            $("#allPartRM tbody").on("click", ".btn-del-rmpart", function() {

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
                            $.post("../../route/miscellaneous/permenant_del_rmpart.php", {
                                id: id
                            }, function(data) {
                                setTimeout(() => {
                                    location.reload();
                                }, 2100);
                                swal({
                                    type: 'success',
                                    title: 'Raw Material to Part deleted!',
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