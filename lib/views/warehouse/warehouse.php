<?php
session_start();

include_once('../../inc/header.php');

if (isset($_SESSION['userId']) && ($_SESSION['user_role'] == 1 || $_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 4)) {

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
            <li class="breadcrumb-item"><a href="#">Warehouse</a></li>
            <li class="breadcrumb-item active">Register Warehouse</li>
        </ol>
    </div>

    <div class="col-md-12">
        <div class="jumbotron">
            <h1 class="display-5" style="text-align: center;"><i class="fas fa-warehouse fa-1x">&nbsp;&nbsp;</i>Register Warehouse</h1>
            <p class="lead" style="text-align: center;">Save new warehouse details</p>
            <hr class="my-4">
            <!-- warehouse registration form -->
            <form id="saveWarehouse">
                <div class="row form-group">
                    <div class="col-md-6">
                        <label for="location">Warehouse Location</label>
                        <input type="text" name="location" id="location" class="form-control" placeholder="Ex: Kandy">
                    </div>
                    <div class="col-md-6">
                        <label for="address">Warehouse Address</label>
                        <input type="text" name="address" id="address" class="form-control" placeholder="Ex: No.11, Kandy Road, Peradeniya">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6">
                        <label for="phoneone">Phone Number (Primary)</label>
                        <input type="text" name="phoneone" id="phoneone" class="form-control" placeholder="Ex: 0771586351" maxlength="10">
                    </div>
                    <div class="col-md-6">
                        <label for="phonetwo">Phone Number (Optional)</label>
                        <input type="text" name="phonetwo" id="phonetwo" class="form-control" placeholder="Ex: 0771547896" maxlength="10">
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" cols="30" rows="3" class="form-control" placeholder="Ex: Warehouse details and description"></textarea>
                </div>
                <div class="form-group" align="right">
                    <button class="btn btn-warning" type="reset" style="margin:5px;"><i class="fas fa-minus-circle"></i>&nbsp;&nbsp;Clear</button>
                    <button id="btnSave" class="btn btn-primary" onclick="return false" style="margin:5px;"><i class="fas fa-save"></i>&nbsp;&nbsp;Save details</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-12">
        <div class="jumbotron">
            <h1 class="display-5" style="text-align: center;"><i class="fas fa-warehouse fa-1x"></i>&nbsp;&nbsp;Warehouse Information</h1>
            <hr class="my-4">
            <!-- our usual table -->
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#warehouseslist">All Warehouses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#deletedwarehouses">Removed Warehouses</a>
                </li>
            </ul>
            <br>
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade show active" id="warehouseslist">
                    <table id="allWarehouse" class="table table-hover table-inverse table-responsive table-bordered" style="margin-top:10px;">
                        <thead class="thead-inverse">
                            <tr>
                                <th>WH Code</th>
                                <th>Location</th>
                                <th>Address</th>
                                <th style="min-width: 90px;">Contact #1</th>
                                <th style="min-width: 90px;">Contact #2</th>
                                <th>Description</th>
                                <th style="min-width: 50px;">Status </th>
                                <th style="min-width: 40px;">Edit </th>
                                <th style="min-width: 40px;">Delete </th>
                            </tr>
                        </thead>
                        <tbody id="search_body_result">
                            <?php
                            include_once('../../functions/warehouse.php');
                            ViewWarehouse();
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="deletedwarehouses">
                    <table id="deletedWarehouseList" class="table table-hover table-inverse table-responsive table-bordered" style="margin-top:10px;">
                        <thead class="thead-inverse">
                            <tr>
                                <th>WH Code</th>
                                <th>Location</th>
                                <th>Address</th>
                                <th style="min-width: 90px;">Contact #1</th>
                                <th style="min-width: 90px;">Contact #2</th>
                                <th>Description</th>
                                <th style="min-width: 50px;">Status </th>
                                <th style="min-width: 40px;">Delete </th>
                            </tr>
                        </thead>
                        <tbody id="search_body_result">
                            <?php
                            include_once('../../functions/warehouse.php');
                            deletedWarehouses();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Warehouse Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editform">
                        <div class="form-group">
                            <label for="whID">Warehouse ID</label>
                            <input type="text" name="whID" id="whID" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label for="whlocation">Location</label>
                            <input type="text" name="whlocation" id="whlocation" class="form-control" placeholder="Ex: Kandy">
                        </div>
                        <div class="form-group">
                            <label for="whaddress">Warehouse Address</label>
                            <input type="text" name="whaddress" id="whaddress" class="form-control" placeholder="Ex: No.11, Kandy Road, Peradeniya">
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="whphoneone">Phone Number #1</label>
                                <input type="number" name="whphoneone" id="whphoneone" class="form-control" placeholder="Ex: 0771586351" maxlength="10">
                            </div>
                            <div class="col-md-6">
                                <label for="whphonetwo">Phone Number #2</label>
                                <input type="number" name="whphonetwo" id="whphonetwo" class="form-control" placeholder="Ex: 0771547896" maxlength="10">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="whdescription">Warehouse Description</label>
                            <textarea name="whdescription" id="whdescription" cols="30" rows="2" class="form-control" placeholder="Ex: Warehouse details and description"></textarea>
                        </div>
                        <br>
                        <div class="form-group">
                            <button class="btn btn-primary" id="btn_edit" onclick="return false"><i class="fas fa-check-double"></i>&nbsp;&nbsp;Update Details</button>
                            <button class="btn btn-light" id="btn_del" type="reset" style="margin-left: 8px;"><i class="fas fa-minus-circle"></i>&nbsp;&nbsp;Clear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Model -->

    <script>
        $(document).ready(function() {

            $("#allWarehouse").DataTable({
                dom: 'B<"clear">lfrtip',
                "order": [
                    [0, "desc"]
                ],
                buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="fas fa-copy"></i>&nbsp;Copy to Clipboard',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i>&nbsp;Export to Excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        },
                        title: "Udaya Industries [REPORT: WAREHOUSE LIST]"
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fas fa-file-csv"></i>&nbsp;Export to CSV',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        },
                        title: "Udaya Industries [REPORT: WAREHOUSE LIST]"
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i>&nbsp;Export to PDF',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        },
                        title: "Udaya Industries [REPORT: WAREHOUSE LIST]"
                    }
                ]
            });

            $("#deletedWarehouseList").DataTable({
                dom: 'B<"clear">lfrtip',
                "order": [
                    [0, "desc"]
                ],
                buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="fas fa-copy"></i>&nbsp;Copy to Clipboard',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i>&nbsp;Export to Excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        },
                        title: "Udaya Industries [REPORT: DELETED WAREHOUSE LIST]"
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fas fa-file-csv"></i>&nbsp;Export to CSV',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        },
                        title: "Udaya Industries [REPORT: DELETED WAREHOUSE LIST]"
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i>&nbsp;Export to PDF',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        },
                        title: "Udaya Industries [REPORT: DELETED WAREHOUSE LIST]"
                    }
                ]
            });

            $("#btnSave").click(function() {
                $.ajax({
                    url: "../../route/warehouse/newWarehouse.php",
                    type: "POST",
                    data: $("#saveWarehouse").serialize(),
                    success: function(data) {
                        setTimeout(() => {
                            location.reload();
                        }, 2100);
                        if (data == "Success") {
                            swal({
                                type: 'success',
                                title: 'New warehouse added!',
                                text: 'New warehouse has been successfully registered',
                                showConfirmButton: false,
                                timer: 2000
                            }).then((result) => {
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    $("#new_reminder").modal("hide");
                                }
                            });
                        } else {
                            swal("Check your inputs!", "Kindly check whether all the mandatory fields have been filled out", "warning");
                        }
                    }
                })
            });

            $('#allWarehouse tbody').on('click', '.btn-success', function() {

                $id = $(this).attr('id');

                //send ajax request to bring warehouse data
                $.get("../../route/warehouse/getsinglewarehouse.php", {
                    id: $id
                }, function(data) {

                    var jdata = jQuery.parseJSON(data);

                    // //show json data on HTML inputs
                    $("#whID").val(jdata.wh_id);
                    $("#whlocation").val(jdata.wh_location);
                    $("#whaddress").val(jdata.wh_address);
                    $("#whphoneone").val(jdata.wh_phone_one);
                    $("#whphonetwo").val(jdata.wh_phone_two);
                    $("#whdescription").val(jdata.wh_description);
                })
            });

            //if user click on save button on model it should call a ajax function
            $("#btn_edit").click(function() {

                $whID = $("#whID").val();
                $whlocation = $("#whlocation").val();
                $whaddress = $("#whaddress").val();
                $whphoneone = $("#whphoneone").val();
                $whphonetwo = $("#whphonetwo").val();
                $whdescription = $("#whdescription").val();

                $.post("../../route/warehouse/updateWarehouse.php", {
                    whID: $whID,
                    whlocation: $whlocation,
                    whaddress: $whaddress,
                    whphoneone: $whphoneone,
                    whphonetwo: $whphonetwo,
                    whdescription: $whdescription
                }, function(data) {
                    setTimeout(() => {
                        location.reload();
                    }, 2100);
                    if (data == "success") {
                        swal({
                            type: 'success',
                            title: 'Warehouse details updated!',
                            text: 'Warehouse details have been updated successfully',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    } else {
                        $error_msg = "Kindly check whether all the mandatory fields have been filled out";
                        swal("Check your inputs!", $error_msg, "warning");
                    }
                });
            });


            $('#allWarehouse tbody').on('click', '.btn-danger', function() {

                this.click;
                $trID = $(this).attr('id');

                swal({
                        title: "Are you sure?",
                        text: "You will still be able to recover this data!",
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
                            $.get("../../route/warehouse/deleteWarehouse.php", {
                                id: $trID
                            }, function(data) {
                                setTimeout(() => {
                                    location.reload();
                                }, 2050);
                                swal({
                                    type: 'success',
                                    title: 'Warehouse deleted!',
                                    text: 'Warehouse details succesfully deleted!',
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            });
                        } else {
                            swal({
                                type: 'warning',
                                title: 'Cancelled!',
                                text: 'Warehouse details remain!',
                                showConfirmButton: false,
                                timer: 2000
                            });
                        }
                    });
            });

            $('#deletedWarehouseList tbody').on('click', '.btn-reactivate', function() {

                this.click;
                $trID = $(this).attr('id');

                swal({
                        title: "Reactivate Warehouse : " + $trID + "?",
                        text: "You will restore " + $trID + "'s data!",
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
                            $.get("../../route/warehouse/reactivateWarehouse.php", {
                                id: $trID
                            }, function(data) {
                                setTimeout(() => {
                                    location.reload();
                                }, 2050);
                                swal({
                                    type: 'success',
                                    title: 'Warehouse Reactivated!',
                                    text: 'Warehouse details succesfully restored!',
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            });
                        } else {
                            swal({
                                type: 'warning',
                                title: 'Cancelled!',
                                text: 'Warehouse details remain deleted!',
                                showConfirmButton: false,
                                timer: 2000
                            });
                        }
                    });
            });
        })
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