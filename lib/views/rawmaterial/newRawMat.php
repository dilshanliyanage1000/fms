<?php
session_start();

include_once('../../inc/header.php');

if (isset($_SESSION['userId']) && ($_SESSION['user_role'] == 1 || $_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 3)) {

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
            <li class="breadcrumb-item"><a href="#">Raw Material</a></li>
            <li class="breadcrumb-item active">Raw Material</li>
        </ol>
    </div>

    <div class="col-md-12">
        <div class="jumbotron">
            <h1 class="display-5" style="text-align: center;"><i class="fas fa-truck-loading fa-1x"></i>&nbsp;&nbsp;Add Raw Material</h1>
            <p class="lead" style="text-align: center;">Save new raw material details</p>
            <hr class="my-4">

            <!-- raw material registration form -->
            <form id="saveRawMat">
                <div class="row form-group">
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <div class="row form-group">
                                <label for="rm_name">Raw Material Name</label>
                                <input type="text" name="rm_name" id="rm_name" class="form-control" placeholder="Ex: Graphite, Iron etc.">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row form-group">
                                <label for="rm_reorder_level">Reorder Level</label>
                                <div class="input-group mb-3">
                                    <input type="number" name="rm_reorder_level" id="rm_reorder_level" class="form-control" placeholder="Ex: 5 loads">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Kg(s)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="rm_description">Raw Material Description & Usage</label>
                            <textarea name="rm_description" id="rm_description" class="form-control" placeholder="Ex: Raw Material Description along with its uses" rows="5"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group" align="right">
                    <button type="reset" class="btn btn-warning" style="margin:5px;"><i class="fas fa-minus-circle"></i>&nbsp;&nbsp;Clear</button>
                    <button id="btnSave" class="btn btn-success" onclick="return false" style="margin:5px;"><i class="fas fa-save"></i>&nbsp;&nbsp;Save details</button>
                </div>

            </form>
        </div>
    </div>

    <div class="col-md-12">
        <div class="jumbotron">
            <h1 class="display-5" style="text-align: center;"><i class="fas fa-truck-loading fa-1x"></i>&nbsp;&nbsp;Raw Material List</h1>
            <br>
            <hr class="my-4">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#allrawmat">All Raw Materials</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#delrawmat">Deleted Raw Materials</a>
                </li>
            </ul>
            <br>
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade show active" id="allrawmat">
                    <table id="allRawMaterials" class="table table-hover table-inverse table-responsive table-bordered" id="product_list">
                        <thead>
                            <tr>
                                <th style="min-width: 180px; text-align:center;">Raw Material ID </th>
                                <th style="min-width: 200px; text-align:center;">Name </th>
                                <th style="min-width: 200px; text-align:center;">Description </th>
                                <th style="min-width: 150px; text-align:center;">Reorder Level </th>
                                <th style="min-width: 100px; text-align:center;">Status </th>
                                <th style="min-width: 100px; text-align:center;">Edit</th>
                                <th style="min-width: 100px; text-align:center;">Delete</th>
                            </tr>
                        </thead>
                        <tbody id="search_body_result">
                            <?php
                            include_once('../../functions/rawmaterial.php');
                            ViewRawMaterial();
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="delrawmat">
                    <table id="deletedRawMaterials" class="table table-hover table-inverse table-responsive table-bordered" id="product_list">
                        <thead>
                            <tr>
                                <th style="min-width: 180px; text-align:center;">Raw Material ID </th>
                                <th style="min-width: 200px; text-align:center;">Name </th>
                                <th style="min-width: 250px; text-align:center;">Description </th>
                                <th style="min-width: 150px; text-align:center;">Reorder Level </th>
                                <th style="min-width: 100px; text-align:center;">Status </th>
                                <th style="min-width: 100px; text-align:center;">Delete</th>
                            </tr>
                        </thead>
                        <tbody id="search_body_result">
                            <?php
                            include_once('../../functions/rawmaterial.php');
                            DeletedRawMaterials();
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Raw Material Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form id="editform">

                        <div class="form-group">
                            <label for="rmID">Raw Material ID</label>
                            <input type="text" name="rmID" id="rmID" class="form-control" readonly>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="rmName">Raw Material Name</label>
                                <input type="text" name="rmName" id="rmName" class="form-control" placeholder="Ex: Graphite, Iron etc.">
                            </div>
                            <div class="col-md-6">
                                <label for="rmReorderLevel">Reorder level (in loads)</label>
                                <input type="text" name="rmReorderLevel" id="rmReorderLevel" class="form-control" placeholder="Ex: 5 loads">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="rmDesc">Raw Material Description & Usage</label>
                            <textarea name="rmDesc" id="rmDesc" class="form-control" placeholder="Ex: Raw Material Description along with its uses" rows="3"></textarea>
                        </div>
                        </br>
                        <div class="form-group" align="right">
                            <button class="btn btn-light" id="btn_del" type="reset" style="margin-left: 8px;"><i class="fas fa-minus-circle"></i>&nbsp;&nbsp;Clear</button>
                            <button class="btn btn-success" id="btn_edit" onclick="return false"><i class="fas fa-check-double"></i>&nbsp;&nbsp;Update Details</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- End Model -->

    <script>
        $(document).ready(function() {

            $("#rm_reorder_level").keyup(function() {

                var value = $(this).val();

                if (value < 0) {
                    swal("Error!", "Negative values are not allowed!", "warning");
                    $("#rm_reorder_level").val('');
                }
            });

            $("#rm_reorder_level").change(function() {

                var value = $(this).val();

                if (value < 0) {
                    swal("Error!", "Negative values are not allowed!", "warning");
                    $("#rm_reorder_level").val('');
                }
            });

            $("#allRawMaterials").DataTable({
                dom: 'B<"clear">lfrtip',
                "order": [
                    [0, "desc"]
                ],
                buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="fas fa-copy"></i>&nbsp;Copy to Clipboard',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i>&nbsp;Export to Excel',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6]
                        },
                        title: "Udaya Industries [REPORT: RAW MATERIAL LIST]"
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fas fa-file-csv"></i>&nbsp;Export to CSV',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6]
                        },
                        title: "Udaya Industries [REPORT: RAW MATERIAL LIST]"
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i>&nbsp;Export to PDF',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6]
                        },
                        title: "Udaya Industries [REPORT: RAW MATERIAL LIST]"
                    }
                ]
            });

            $("#deletedRawMaterials").DataTable({
                dom: 'B<"clear">lfrtip',
                "order": [
                    [0, "desc"]
                ],
                buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="fas fa-copy"></i>&nbsp;Copy to Clipboard',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i>&nbsp;Export to Excel',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6]
                        },
                        title: "Udaya Industries [REPORT: RAW MATERIAL LIST]"
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fas fa-file-csv"></i>&nbsp;Export to CSV',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6]
                        },
                        title: "Udaya Industries [REPORT: RAW MATERIAL LIST]"
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i>&nbsp;Export to PDF',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6]
                        },
                        title: "Udaya Industries [REPORT: RAW MATERIAL LIST]"
                    }
                ]
            });

            $("#btnSave").click(function() {
                $name = $("#rm_name").val();
                $reorderlevel = $("#rm_reorder_level").val();
                $desc = $("#rm_description").val();

                $.post("../../route/rawmaterial/newRawMat.php", {
                    rm_name: $name,
                    rm_reorder_level: $reorderlevel,
                    rm_description: $desc,

                }, function(data) {

                    if (data == "Success") {
                        setTimeout(() => {
                            location.reload();
                        }, 2100);
                        swal({
                            type: 'success',
                            title: 'New raw material added!',
                            text: 'New raw material has been successfully registered',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    } else {
                        swal("Check your inputs!", "Kindly check whether all the mandatory fields have been filled out", "warning");
                    }
                })
            });

            $('#allRawMaterials tbody').on('click', '.btn-primary', function() {

                $id = $(this).attr('id');

                //send ajax request to bring raw material data
                $.get("../../route/rawmaterial/getsingleRawMat.php", {
                    id: $id
                }, function(data) {

                    var jdata = jQuery.parseJSON(data);

                    $("#rmID").val(jdata.rm_id);
                    $("#rmName").val(jdata.rm_name);
                    $("#rmDesc").val(jdata.rm_description);
                    $("#rmReorderLevel").val(jdata.rm_reorder_level);
                })
            });

            $("#btn_edit").click(function() {
                $.ajax({
                    url: "../../route/rawmaterial/updateRawMat.php",
                    type: "POST",
                    data: $("#editform").serialize(),
                    success: (data) => {
                        if (data == "success") {
                            setTimeout(() => {
                                location.reload();
                            }, 2100);
                            swal({
                                type: 'success',
                                title: 'Raw material details updated!',
                                text: 'Raw material details have been updated successfully',
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else {

                            $error_msg = "Kindly check whether all the mandatory fields have been filled out";

                            swal("Check your inputs!", $error_msg, "warning");
                        }
                    }
                })
            })

            $('#allRawMaterials tbody').on('click', '.btn-danger', function() {

                this.click;

                $trID = $(this).attr('id');

                swal({
                        title: "Are you sure?",
                        text: "You will still be able to recover this data!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            $.get("../../route/rawmaterial/deleteRawMat.php", {
                                id: $trID
                            }, function(data) {
                                if (data == "Deleted") {
                                    setTimeout(() => {
                                        location.reload();
                                    }, 2100);
                                    swal({
                                        type: 'success',
                                        title: 'Product deleted!',
                                        text: 'Product details succesfully deleted!',
                                        showConfirmButton: false,
                                        timer: 2000
                                    })
                                }
                            });
                        } else {
                            swal({
                                type: 'warning',
                                title: 'Cancelled!',
                                text: 'Customer details remain!',
                                showConfirmButton: false,
                                timer: 2000
                            });
                        }
                    });
            });

            $('#deletedRawMaterials tbody').on('click', '.btn-reactivate', function() {

                this.click;
                $trID = $(this).attr('id');

                swal({
                        title: "Reactivate Raw Material : " + $trID + "?",
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
                            $.get("../../route/rawmaterial/reactivateRawMat.php", {
                                id: $trID
                            }, function(data) {
                                setTimeout(() => {
                                    location.reload();
                                }, 2050);
                                swal({
                                    type: 'success',
                                    title: 'Raw Material Reactivated!',
                                    text: 'Raw Material details succesfully restored!',
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            });
                        } else {
                            swal({
                                type: 'warning',
                                title: 'Cancelled!',
                                text: 'Raw Material details remain deleted!',
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