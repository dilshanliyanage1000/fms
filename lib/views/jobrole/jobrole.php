<?php
session_start();

include_once('../../inc/header.php');

if (isset($_SESSION['userId']) && $_SESSION['user_role'] == 1) {

    include_once('../../inc/sidenav.php');

?>
    <br>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">System Configurations</a></li>
            <li class="breadcrumb-item active">Employee Job Role</li>
        </ol>
    </div>

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-5">
                <div class="jumbotron">
                    <h1 class="display-5" align="center"><i class="fas fa-user-tie fa-1x"></i>&nbsp;&nbsp;Create Jobrole</h1>
                    <br>
                    <hr class="my-4">
                    <form id="addJobrole">
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="jobrole_name">Job Role Name :</label>
                                <input type="text" name="jobrole_name" id="jobrole_name" class="form-control" placeholder="Ex: Supervisor">
                            </div>
                            <div class="col-md-6"></div>
                        </div>
                        <hr class="my-4">
                        <div class="row form-group">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Basic Salary</label>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rs.</span>
                                            </div>
                                            <input type="number" class="form-control" id="basicsal" name="basicsal" placeholder="Ex: 30,000" aria-label="Amount (to the nearest dollar)">
                                            <div class="input-group-append">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Maximum Salary</label>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rs.</span>
                                            </div>
                                            <input type="number" class="form-control" id="maxsal" name="maxsal" placeholder="Ex: 40,000" aria-label="Amount (to the nearest dollar)">
                                            <div class="input-group-append">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-group" align="right">
                            <button class="btn btn-warning" type="reset" style="margin:5px;"><i class="fas fa-minus-circle"></i>&nbsp;&nbsp;Clear</button>
                            <button id="save_jobrole" class="btn btn-success" onclick="return false" style="margin:5px;"><i class="fas fa-save"></i>&nbsp;&nbsp;Save details</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-7">
                <div class="jumbotron">
                    <h1 class="display-5" align="center"><i class="fas fa-user-tie fa-1x"></i>&nbsp;&nbsp;View Jobrole</h1>
                    <br />
                    <hr class="my-4">
                    <table id="allUsers" class="table table-hover table-inverse table-responsive table-bordered" style="margin-top:10px;">
                        <thead class="thead-inverse">
                            <tr>
                                <th style="min-width: 80px;">Jobrole ID</th>
                                <th style="min-width: 110px;">Jobrole Name</th>
                                <th style="min-width: 100px;">Basic Salary</th>
                                <th style="min-width: 100px;">Max. Salary</th>
                                <th style="min-width: 50px;">Status</th>
                                <th style="min-width: 40px;">Edit</th>
                                <th style="min-width: 40px;">Delete</th>
                            </tr>
                        </thead>
                        <tbody id="userBody">
                            <?php
                            include_once('../../functions/jobrole.php');
                            getallJobroles();
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Employee Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editFormJB">
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="jb_id">Job Role ID :</label>
                                <input type="text" name="jb_id" id="jb_id" class="form-control" placeholder="Ex: Supervisor" disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="jb_name">Job Role Name :</label>
                                <input type="text" name="jb_name" id="jb_name" class="form-control" placeholder="Ex: Supervisor">
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="row form-group">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Basic Salary</label>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rs.</span>
                                            </div>
                                            <input type="number" class="form-control" id="jb_basicsal" name="jb_basicsal" placeholder="Ex: 30,000" aria-label="Amount (to the nearest dollar)">
                                            <div class="input-group-append">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Maximum Salary</label>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rs.</span>
                                            </div>
                                            <input type="number" class="form-control" id="jb_maxsal" name="jb_maxsal" placeholder="Ex: 40,000" aria-label="Amount (to the nearest dollar)">
                                            <div class="input-group-append">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-group" align="right">
                            <button class="btn btn-warning" type="reset" style="margin:5px;"><i class="fas fa-minus-circle"></i>&nbsp;&nbsp;Clear</button>
                            <button id="update_jobrole" class="btn btn-success" onclick="return false" style="margin:5px;"><i class="fas fa-save"></i>&nbsp;&nbsp;Update details</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Model -->

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

            $("#allUsers").DataTable({
                dom: 'B<"clear">lfrtip',
                buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="fas fa-copy"></i>&nbsp;Copy',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 5, 6]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i>&nbsp;Excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 5, 6]
                        },
                        title: "Udaya Industries [REPORT: SYSTEM USER LIST]"
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fas fa-file-csv"></i>&nbsp;CSV',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 5, 6]
                        },
                        title: "Udaya Industries [REPORT: SYSTEM USER LIST]"
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i>&nbsp;PDF',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 5, 6]
                        },
                        title: "Udaya Industries [REPORT: SYSTEM USER LIST]"
                    }
                ]
            });

            $("#save_jobrole").click(function() {

                $jobrole_name = $("#jobrole_name").val();
                $basicsal = $("#basicsal").val();
                $maxsal = $("#maxsal").val();

                $.post("../../route/jobrole/createJobrole.php", {
                    jobrole_name: $jobrole_name,
                    jobrole_basicsal: $basicsal,
                    jobrole_maxsal: $maxsal,

                }, function(data) {

                    if (data == "success") {
                        document.getElementById("jobrole_name").value = "";
                        document.getElementById("basicsal").value = "";
                        document.getElementById("maxsal").value = "";
                        swal({
                            type: 'success',
                            title: 'New Jobrole Created!',
                            text: 'New jobrole has been created succesfully!',
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
                })
            });

            $(".btn-primary").click(function() {

                $id = $(this).attr('id');

                $.get("../../route/jobrole/editsinglejobrole.php", {
                    id: $id
                }, function(data) {

                    var jdata = jQuery.parseJSON(data);

                    document.getElementById('update_jobrole').disabled = false;

                    $("#jb_id").val(jdata.jobrole_id);
                    $("#jb_name").val(jdata.jobrole_name);
                    $("#jb_basicsal").val(jdata.jobrole_basicsal);
                    $("#jb_maxsal").val(jdata.jobrole_maxsal);

                    $("#jb_basicsal").keyup(function() {

                        var basicsalary = $(this).val();

                        if (basicsalary <= 0) {
                            swal("Error!", "Negative values are not allowed!", "warning");
                            document.getElementById('update_jobrole').disabled = true;
                        } else if (basicsalary > 500) {
                            swal("Error!", "Unrealistic Salary Amount!", "warning");
                            document.getElementById('update_jobrole').disabled = true;
                        } else {
                            document.getElementById('update_jobrole').disabled = false;
                        }
                    });

                    $("#jb_basicsal").change(function() {

                        var basicsalary = $(this).val();

                        if (basicsalary <= 0) {
                            swal("Error!", "Negative values are not allowed!", "warning");
                            document.getElementById('update_jobrole').disabled = true;
                        } else if (basicsalary > 500) {
                            swal("Error!", "Unrealistic Salary Amount!", "warning");
                            document.getElementById('update_jobrole').disabled = true;
                        } else {
                            document.getElementById('update_jobrole').disabled = false;
                        }
                    });

                    $("#jb_maxsal").keyup(function() {

                        var maxsalary = $(this).val();

                        if (maxsalary <= 0) {
                            swal("Error!", "Negative values are not allowed!", "warning");
                            document.getElementById('update_jobrole').disabled = true;
                        } else if (maxsalary > 500) {
                            swal("Error!", "Unrealistic Salary Amount!", "warning");
                            document.getElementById('update_jobrole').disabled = true;
                        } else {
                            document.getElementById('update_jobrole').disabled = false;
                        }
                    });

                    $("#jb_maxsal").change(function() {

                        var maxsalary = $(this).val();

                        if (maxsalary <= 0) {
                            swal("Error!", "Negative values are not allowed!", "warning");
                            document.getElementById('update_jobrole').disabled = true;
                        } else if (maxsalary > 500) {
                            swal("Error!", "Unrealistic Salary Amount!", "warning");
                            document.getElementById('update_jobrole').disabled = true;
                        } else {
                            document.getElementById('update_jobrole').disabled = false;
                        }
                    });
                })
            });

            $("#update_jobrole").click(function() {

                $jbid = $("#jb_id").val();
                $jobrole_name = $("#jb_name").val();
                $basicsal = $("#jb_basicsal").val();
                $maxsal = $("#jb_maxsal").val();

                $.post("../../route/jobrole/updateJobrole.php", {
                    jobrole_id: $jbid,
                    jobrole_name: $jobrole_name,
                    jobrole_basicsal: $basicsal,
                    jobrole_maxsal: $maxsal,

                }, function(data) {

                    if (data == "success") {
                        $('#editModal').modal('hide');
                        swal({
                            type: 'success',
                            title: 'Jobrole details updated!',
                            text: 'Jobrole details have been updated successfully',
                            showConfirmButton: false,
                            timer: 2000
                        }).then((result) => {
                            if (result.dismiss === Swal.DismissReason.timer) {
                                $("#new_reminder").modal("hide");
                            }
                        });
                    } else {

                        $error_msg = "Kindly check whether all the mandatory fields have been filled out";

                        swal("Check your inputs!", $error_msg, "warning");
                    }
                })
            });

            $(".btn-danger").click(function() {

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
                            $.get("../../route/jobrole/deletejobrole.php", {
                                id: $trID
                            }, function(data) {
                                swal({
                                    type: 'success',
                                    title: 'Jobrole deleted!',
                                    text: 'Jobrole details succesfully inactivated!',
                                    showConfirmButton: false,
                                    timer: 2000
                                }).then((result) => {
                                    if (result.dismiss === Swal.DismissReason.timer) {
                                        $("#new_reminder").modal("hide");
                                    }
                                });
                            });
                        } else {
                            swal({
                                type: 'warning',
                                title: 'Cancelled!',
                                text: 'Jobrole details remain!',
                                showConfirmButton: false,
                                timer: 2000
                            }).then((result) => {
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    $("#new_reminder").modal("hide");
                                }
                            });
                        }
                    });
            });

            //-------------------------- TEXTBOX AND BUTTON VALIDATIONS : FRONT END ------------------------------------------------

            $("#basicsal").keyup(function() {

                var basicsalary = $(this).val();

                if (basicsalary <= 0) {
                    swal("Error!", "Negative values are not allowed!", "warning");
                    $("#basicsal").val('');
                } else if (basicsalary > 500) {
                    swal("Error!", "Unrealistic Salary Amount!", "warning");
                    $("#basicsal").val('');
                }
            });

            $("#basicsal").change(function() {

                var basicsalary = $(this).val();

                if (basicsalary <= 0) {
                    swal("Error!", "Negative values are not allowed!", "warning");
                    $("#basicsal").val('');
                } else if (basicsalary > 500) {
                    swal("Error!", "Unrealistic Salary Amount!", "warning");
                    $("#basicsal").val('');
                }
            });

            $("#maxsal").keyup(function() {

                var maxsalary = $(this).val();

                if (maxsalary <= 0) {
                    swal("Error!", "Negative values are not allowed!", "warning");
                    $("#maxsal").val('');
                } else if (maxsalary > 500) {
                    swal("Error!", "Unrealistic Salary Amount!", "warning");
                    $("#maxsal").val('');
                }
            });

            $("#maxsal").change(function() {

                var maxsalary = $(this).val();

                if (maxsalary <= 0) {
                    swal("Error!", "Negative values are not allowed!", "warning");
                    $("#maxsal").val('');
                } else if (maxsalary > 500) {
                    swal("Error!", "Unrealistic Salary Amount!", "warning");
                    $("#maxsal").val('');
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