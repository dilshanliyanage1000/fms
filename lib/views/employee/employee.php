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
            <li class="breadcrumb-item"><a href="#">Employee</a></li>
            <li class="breadcrumb-item active">Manage Employee</li>
        </ol>
    </div>
    <div class="col-md-12">
        <div class="jumbotron">
            <h1 class="display-5" style="text-align: center;"><i class="fas fa-users fa-1x"></i>&nbsp;&nbsp;Register Employee</h1>
            <hr class="my-4">

            <form id="saveEmp" enctype="multipart/form-data">
                <div class="row form-group">
                    <div class="col-md-6">
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Ex: John">
                            </div>
                            <div class="col-md-6">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Ex: Appleseed">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="email">Email Address</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Ex: johnappleseed@email.com">
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                <p style="color: red; display: none;" id="error_mail" class="form-text"><i class="far fa-times-circle"></i>&nbsp;This email already exists in the system!</p>
                            </div>
                            <div class="col-md-6">
                                <label for="nic">NIC Number</label>
                                <input type="text" name="nic" id="nic" class="form-control" placeholder="Ex: 658954785V" maxlength="10">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="phone_1">Phone Number (Primary)</label>
                                <input type="number" name="phone_1" id="phone_1" class="form-control" placeholder="Ex: 0771586351" maxlength="10">
                                <p style="color: red; display: none;" id="error_telone" class="form-text"><i class="far fa-times-circle"></i>&nbsp;This phone number already exists in the system!</p>
                            </div>
                            <div class="col-md-6">
                                <label for="phone_2">Phone Number (Optional)</label>
                                <input type="number" name="phone_2" id="phone_2" class="form-control" placeholder="Ex: 0771547896" maxlength="10">
                                <p style="color: red; display: none;" id="error_teltwo" class="form-text"><i class="far fa-times-circle"></i>&nbsp;This phone number already exists in the system!</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div style="border-left:1px solid #dbdbdb; height:300px"></div>
                    </div>
                    <div class="col-md-5">
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="address">Address</label>
                                <input type="text" name="address" id="address" class="form-control" placeholder="Ex: 15, Kings Road, New York NY">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="employee_img">Employee Photo</label>
                                <br>
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <label class="custom-file-label">Choose file</label>
                                        <input type="file" class="custom-file-input" name="employee_image" id="employee_image">
                                    </div>
                                </div>
                                <small class="form-text text-muted"><i class="fas fa-question-circle"></i>&nbsp;Please use 600x600 resolution photo</small>
                                <img id="emp_image" src="" class="img-responsive img-rounded center-block border">
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="job_role">Job Role</label>
                                    <select class="custom-select" name="job_role" id="job_role">
                                        <option selected="">--Select job role--</option>
                                        <?php
                                        include_once("../../functions/jobrole.php");
                                        getJobroleSelect();
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group" align="right">
                    <button class="btn btn-warning" type="reset" style="margin:5px;"><i class="fas fa-minus-circle"></i>&nbsp;&nbsp;Clear</button>
                    <button class="btn btn-primary" id="btnSave" onclick="return false" style="margin:5px;"><i class="fas fa-save"></i>&nbsp;&nbsp;Save details</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-12">
        <div class="jumbotron">
            <h1 class="display-5" style="text-align: center;"><i class="fas fa-users fa-1x"></i>&nbsp;&nbsp;Employee Information</h1>
            <hr class="my-4">
            <table id="allEmployees" class="table table-hover table-inverse table-responsive table-bordered" style="margin-top:10px;">
                <thead class="thead-inverse">
                    <tr>
                        <th style="min-width: 50px;">ID</th>
                        <th>Profile</th>
                        <th style="min-width: 150px;">Name</th>
                        <th style="min-width: 100px;">Job Role</th>
                        <th style="min-width: 80px;">NIC</th>
                        <th style="min-width: 90px;">Contact No</th>
                        <th style="min-width: 100px;">Address</th>
                        <th style="min-width: 100px;">Email</th>
                        <th style="min-width: 40px;">Status</th>
                        <th style="min-width: 35px;">QR</th>
                        <th style="min-width: 40px;">Edit</th>
                        <th style="min-width: 40px;">Delete</th>
                    </tr>
                </thead>
                <tbody id="search_body_result">
                    <?php
                    include_once('../../functions/employee.php');
                    ViewEmployee();
                    ?>
                </tbody>
            </table>
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
                    <form id="editform" enctype="multipart/form-data">
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="emp_id">Employee ID</label>
                                <input type="text" name="emp_id" id="emp_id" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="emp_fname">First Name</label>
                                <input type="text" name="emp_fname" id="emp_fname" class="form-control" placeholder="Ex: John">
                            </div>
                            <div class="col-md-6">
                                <label for="emp_lname">Last Name</label>
                                <input type="text" name="emp_lname" id="emp_lname" class="form-control" placeholder="Ex: Appleseed">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="employee_img">Employee Photo</label>
                                <br>
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <label class="custom-file-label">Choose file</label>
                                        <input type="file" class="custom-file-input" name="edit_employee_image" id="edit_employee_image">
                                    </div>
                                </div>
                                <small class="form-text text-muted"><i class="fas fa-question-circle"></i>&nbsp;Please use 600x600 resolution photo</small>
                                <img id="ed_emp_image" src="" class="img-responsive img-rounded center-block border">
                            </div>
                            <div class="col-md-6">
                                <label>Job Role</label>
                                <select class="custom-select" name="emp_jobrole" id="emp_jobrole">
                                    <?php
                                    include_once("../../functions/jobrole.php");
                                    getJobroleSelect();
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="emp_nic">NIC Number</label>
                                <input type="text" name="emp_nic" id="emp_nic" class="form-control" placeholder="Ex: John">
                            </div>
                            <div class="col-md-6">
                                <label for="emp_email">Email Address</label>
                                <input type="email" name="emp_email" id="emp_email" class="form-control" placeholder="Ex: johnappleseed@email.com">
                                <p style="color: red; display: none;" id="edit_error_mail" class="form-text"><i class="far fa-times-circle"></i>&nbsp;This email already exists in the system!</p>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="emp_telno">Phone Number (Primary)</label>
                                <input type="text" name="emp_telno" id="emp_telno" class="form-control" placeholder="Ex: 0771586351" maxlength="10">
                                <p style="color: red; display: none;" id="modal_error_telone" class="form-text"><i class="far fa-times-circle"></i>&nbsp;This phone number already exists in the system!</p>

                            </div>
                            <div class="col-md-6">
                                <label for="emp_telno_2">Phone Number (Optional)</label>
                                <input type="text" name="emp_telno_2" id="emp_telno_2" class="form-control" placeholder="Ex: 0771547896" maxlength="10">
                                <p style="color: red; display: none;" id="modal_error_teltwo" class="form-text"><i class="far fa-times-circle"></i>&nbsp;This phone number already exists in the system!</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="emp_address">Address</label>
                            <input type="text" name="emp_address" id="emp_address" class="form-control" placeholder="Ex: 15, Kings Road, New York NY">
                        </div>
                        <br>
                        <div class="form-group">
                            <button id="edit_btn" class="btn btn-primary" onclick="return false"><i class="fas fa-check-double"></i>&nbsp;&nbsp;Update Details</button>
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

            document.getElementById('btnSave').disabled = true;

            $("#phone_1").keyup(function() {
                $phoneonevalue = $(this).val();
                $("#error_telone").hide();
                if ($phoneonevalue < 0) {
                    $("#error_telone").hide();
                    swal("Error!", "Phone number cannot have negative values!", "warning");
                    $("#phone_1").val('');
                    document.getElementById('btnSave').disabled = true;
                } else {
                    if ($phoneonevalue.length > 10) {
                        swal("Error!", "Phone number should contain only 10 digits!", "warning");
                        $("#phone_1").val('');
                        document.getElementById('btnSave').disabled = true;
                    } else if ($phoneonevalue.length == 10) {
                        $.get("../../route/employee/updateTel.php", {
                            data: $phoneonevalue
                        }, function(data) {
                            if (data == "already_exits") {
                                $("#error_telone").show();
                                document.getElementById('btnSave').disabled = true;
                            } else {
                                $("#error_telone").hide();
                                document.getElementById('btnSave').disabled = false;
                            }
                        });
                    } else if ($phoneonevalue.length < 10) {
                        document.getElementById('btnSave').disabled = true;
                    }
                }
            });

            $("#phone_1").change(function() {
                $phoneonevalue = $(this).val();
                $("#error_telone").hide();
                if ($phoneonevalue < 0) {
                    swal("Error!", "Phone number cannot have negative values!", "warning");
                    $("#phone_1").val('');
                    document.getElementById('btnSave').disabled = true;
                } else {
                    if ($phoneonevalue.length > 10) {
                        swal("Error!", "Phone number should contain only 10 digits!", "warning");
                        $("#phone_1").val('');
                        document.getElementById('btnSave').disabled = true;
                    } else if ($phoneonevalue.length == 10) {
                        $.get("../../route/employee/updateTel.php", {
                            data: $phoneonevalue
                        }, function(data) {
                            if (data == "already_exits") {
                                $("#error_telone").show();
                                document.getElementById('btnSave').disabled = true;
                            } else {
                                $("#error_telone").hide();
                                document.getElementById('btnSave').disabled = false;
                            }
                        });
                    } else if ($phoneonevalue.length < 10) {
                        document.getElementById('btnSave').disabled = true;
                    }
                }
            });

            $("#phone_2").keyup(function() {
                $phonetwovalue = $(this).val();
                $("#error_teltwo").hide();
                if ($phonetwovalue < 0) {
                    swal("Error!", "Phone number cannot have negative values!", "warning");
                    $("#phone_2").val('');
                    document.getElementById('btnSave').disabled = true;
                } else {
                    if ($phonetwovalue.length > 10) {
                        swal("Error!", "Phone number should contain only 10 digits!", "warning");
                        $("#phone_2").val('');
                        document.getElementById('btnSave').disabled = true;
                    } else if ($phonetwovalue.length == 10) {
                        $.get("../../route/employee/updateTel.php", {
                            data: $phonetwovalue
                        }, function(data) {
                            if (data == "already_exits") {
                                $("#error_teltwo").show();
                                document.getElementById('btnSave').disabled = true;
                            } else {
                                $("#error_teltwo").hide();
                                document.getElementById('btnSave').disabled = false;
                            }
                        });
                    } else if ($phonetwovalue.length < 10) {
                        document.getElementById('btnSave').disabled = true;
                    }
                }
            });

            $("#phone_2").change(function() {
                $phonetwovalue = $(this).val();
                $("#error_teltwo").hide();
                if ($phonetwovalue < 0) {
                    swal("Error!", "Phone number cannot have negative values!", "warning");
                    $("#phone_2").val('');
                    document.getElementById('btnSave').disabled = true;
                } else {
                    if ($phonetwovalue.length > 10) {
                        swal("Error!", "Phone number should contain only 10 digits!", "warning");
                        $("#phone_2").val('');
                        document.getElementById('btnSave').disabled = true;
                    } else if ($phonetwovalue.length == 10) {
                        $.get("../../route/employee/updateTel.php", {
                            data: $phonetwovalue
                        }, function(data) {
                            if (data == "already_exits") {
                                $("#error_teltwo").show();
                                document.getElementById('btnSave').disabled = true;
                            } else {
                                $("#error_teltwo").hide();
                                document.getElementById('btnSave').disabled = false;
                            }
                        });
                    } else if ($phonetwovalue.length < 10) {
                        document.getElementById('btnSave').disabled = true;
                    }
                }
            });

            $("#email").keyup(function() {

                var emailval = $(this).val();

                if (emailval.length < 6) {
                    $("#error_mail").hide();
                } else {
                    $.get("../../route/employee/emp_mail_v.php", {
                        data: emailval
                    }, function(data) {
                        if (data == "success") {
                            $("#error_mail").show();
                            $("#emailHelp").hide();
                        } else {
                            $("#error_mail").hide();
                            $("#emailHelp").show();
                        }
                    });
                }
            });

            $("#emp_email").keyup(function() {
                var emailval = $(this).val();

                if (emailval.length < 6) {
                    $("#error_mail").hide();
                } else {
                    $.get("../../route/employee/emp_mail_v.php", {
                        data: emailval
                    }, function(data) {
                        if (data == "success") {
                            $("#error_mail").show();
                            document.getElementById("savebtn").disabled = true;
                        } else {
                            $("#error_mail").hide();
                            document.getElementById("savebtn").disabled = false;
                        }
                    });
                }
            });

            $("#btnSave").click(function() {
                var form = $('#saveEmp')[0];
                var formData = new FormData(form);

                $.ajax({
                    url: "../../route/employee/newemployee.php",
                    data: formData,
                    processData: false,
                    contentType: false,
                    type: 'POST',
                    success: function(data) {
                        if (data == "success") {
                            setTimeout(() => {
                                location.reload();
                            }, 2100);
                            swal({
                                type: 'success',
                                title: 'New employee added!',
                                text: 'New employee has been registered successfully',
                                showConfirmButton: false,
                                timer: 2000
                            }).then((result) => {
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    $("#new_reminder").modal("hide");
                                }
                            });
                        } else if (data == "ext_error") {

                            swal("Image Error!", "You can only upload either .PNG, .JPG or .GIF images!", "warning");

                        } else {

                            swal("Check your inputs!", "Kindly check whether all the mandatory fields have been filled out", "warning");
                        }
                    }
                })
            });

            $("#allEmployees").DataTable({
                "order": [
                    [0, "desc"]
                ],
                dom: 'B<"clear">lfrtip',
                buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="fas fa-copy"></i>&nbsp;Copy to Clipboard',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7, 8]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i>&nbsp;Export to Excel',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7, 8]
                        },
                        title: "Udaya Industries [REPORT: EMPLOYEE LIST]"
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fas fa-file-csv"></i>&nbsp;Export to CSV',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7, 8]
                        },
                        title: "Udaya Industries [REPORT: EMPLOYEE LIST]"
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i>&nbsp;Export to PDF',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7, 8]
                        },
                        title: "Udaya Industries [REPORT: EMPLOYEE LIST]"
                    }
                ]
            });


            //check edit button
            $('#allEmployees tbody').on('click', '.btn-success', function() {

                $id = $(this).attr('id');

                //send ajax request to bring customer data
                $.get("../../route/employee/getsingleEmp.php", {
                    id: $id
                }, function(data) {

                    var jdata = jQuery.parseJSON(data);
                    var imgdbpath = jdata.emp_img_path;

                    $("#emp_id").val(jdata.emp_id);
                    $("#emp_fname").val(jdata.emp_fname);
                    $("#emp_lname").val(jdata.emp_lname);

                    $('#ed_emp_image').attr("style", "width:40%");
                    $('#ed_emp_image').attr("src", '../../' + imgdbpath + '');

                    $("#emp_jobrole").val(jdata.jobrole_id);
                    $("#emp_nic").val(jdata.emp_nic);
                    $("#emp_telno").val(jdata.emp_telno);
                    $("#emp_telno_2").val(jdata.emp_telno_2);
                    $("#emp_address").val(jdata.emp_address);
                    $("#emp_email").val(jdata.emp_email);
                });
            });

            //if user click on save button on model it should call a ajax function
            $("#edit_btn").click(function() {

                var form = $('#editform')[0];
                var formData = new FormData(form);

                $.ajax({
                    url: "../../route/employee/updateEmployee.php",
                    data: formData,
                    processData: false,
                    contentType: false,
                    type: 'POST',
                    success: function(data) {
                        if (data == "success") {
                            setTimeout(() => {
                                location.reload();
                            }, 2100);
                            swal({
                                type: 'success',
                                title: 'Employee details updated!',
                                text: 'Employee details have been updated successfully',
                                showConfirmButton: false,
                                timer: 2000
                            }).then((result) => {
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    $("#new_reminder").modal("hide");
                                }
                            });
                        } else if (data == "ext_error") {

                            swal("Image Error!", "You can only upload either .PNG, .JPG or .GIF images!", "warning");

                        } else {

                            swal("Check your inputs!", "Kindly check whether all the mandatory fields have been filled out", "warning");
                        }
                    }
                })
            });

            //----------------- QR CODE --------------------------------------------

            $('#allEmployees tbody').on('click', '.btn-info', function() {

                this.click;

                var empID = $(this).attr('id');

                $.get("../../route/employee/getsingleEmp.php", {
                    id: empID
                }, function(data) {

                    var jdata = jQuery.parseJSON(data);

                    var emp_id = jdata.emp_id;
                    var emp_fname = jdata.emp_fname;
                    var emp_lname = jdata.emp_lname;

                    var jobrole_name = jdata.jobrole_name;

                    var imgdbpath = jdata.emp_img_path;
                    var realimgpath = '../../' + imgdbpath;

                    window.open("empqr.php?emp_id=" + emp_id + "&emp_fname=" + emp_fname + "&emp_lname=" + emp_lname + "&realimgpath=" + realimgpath + "&jobrole_name=" + jobrole_name + "&/", "_blank");
                });
            });

            //-----------------------------------------------------------------------

            $('#allEmployees tbody').on('click', '.btn-danger', function() {

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
                            $.get("../../route/employee/deleteEmployee.php", {
                                id: $trID
                            }, function(data) {
                                swal({
                                    type: 'success',
                                    title: 'Employee deleted!',
                                    text: 'Employee details succesfully inactivated!',
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
                                text: 'Customer details remain!',
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

            //--------------- modal tel validation -----------------------------------------

            $("#emp_telno").keyup(function() {
                $phoneonevalue = $(this).val();
                if ($phoneonevalue < 0) {
                    swal("Error!", "Phone number cannot have negative values!", "warning");
                    $("#emp_telno").val('');
                    document.getElementById('edit_btn').disabled = true;
                } else {
                    if ($phoneonevalue.length > 10) {
                        swal("Error!", "Phone number should contain only 10 digits!", "warning");
                        $("#emp_telno").val('');
                        document.getElementById('edit_btn').disabled = true;
                    } else if ($phoneonevalue.length == 10) {
                        $.get("../../route/employee/validatetel.php", {
                            id: $empID,
                            phone: $phonetwovalue
                        }, function(data) {
                            if (data == "already_exits") {
                                $("#error_telone").show();
                                document.getElementById('edit_btn').disabled = true;
                            } else {
                                $("#error_telone").hide();
                                document.getElementById('edit_btn').disabled = false;
                            }
                        });
                    } else if ($phoneonevalue.length < 10) {
                        document.getElementById('edit_btn').disabled = true;
                    }
                }
            });

            $("#emp_telno").change(function() {
                $phoneonevalue = $(this).val();
                if ($phoneonevalue < 0) {
                    swal("Error!", "Phone number cannot have negative values!", "warning");
                    $("#emp_telno").val('');
                    document.getElementById('edit_btn').disabled = true;
                } else {
                    if ($phoneonevalue.length > 10) {
                        swal("Error!", "Phone number should contain only 10 digits!", "warning");
                        $("#emp_telno").val('');
                        document.getElementById('edit_btn').disabled = true;
                    } else if ($phoneonevalue.length == 10) {
                        $.get("../../route/employee/validatetel.php", {
                            id: $empID,
                            phone: $phonetwovalue
                        }, function(data) {
                            if (data == "already_exits") {
                                $("#error_telone").show();
                                document.getElementById('edit_btn').disabled = true;
                            } else {
                                $("#error_telone").hide();
                                document.getElementById('edit_btn').disabled = false;
                            }
                        });
                    } else if ($phoneonevalue.length < 10) {
                        document.getElementById('edit_btn').disabled = true;
                    }
                }
            });

            $("#emp_telno_2").keyup(function() {
                $phonetwovalue = $(this).val();
                if ($phonetwovalue < 0) {
                    swal("Error!", "Phone number cannot have negative values!", "warning");
                    $("#emp_telno_2").val('');
                    document.getElementById('edit_btn').disabled = true;
                } else {
                    if ($phonetwovalue.length > 10) {
                        swal("Error!", "Phone number should contain only 10 digits!", "warning");
                        $("#emp_telno_2").val('');
                        document.getElementById('edit_btn').disabled = true;
                    } else if ($phonetwovalue.length == 10) {
                        $.get("../../route/employee/validatetel.php", {
                            id: $empID,
                            phone: $phonetwovalue
                        }, function(data) {
                            if (data == "already_exits") {
                                $("#modal_error_teltwo").show();
                                document.getElementById('edit_btn').disabled = true;
                            } else {
                                $("#modal_error_teltwo").hide();
                                document.getElementById('edit_btn').disabled = false;
                            }
                        });
                    } else if ($phonetwovalue.length < 10) {
                        document.getElementById('edit_btn').disabled = true;
                    }
                }
            });

            $("#emp_telno_2").change(function() {
                $empID = $("#emp_id").val();
                $phonetwovalue = $(this).val();
                if ($phonetwovalue < 0) {
                    swal("Error!", "Phone number cannot have negative values!", "warning");
                    $("#emp_telno_2").val('');
                    document.getElementById('edit_btn').disabled = true;
                } else {
                    if ($phonetwovalue.length > 10) {
                        swal("Error!", "Phone number should contain only 10 digits!", "warning");
                        $("#emp_telno_2").val('');
                        document.getElementById('edit_btn').disabled = true;
                    } else if ($phonetwovalue.length == 10) {
                        $.get("../../route/employee/validatetel.php", {
                            id: $empID,
                            phone: $phonetwovalue
                        }, function(data) {
                            if (data == "already_exits") {
                                $("#modal_error_teltwo").show();
                                document.getElementById('edit_btn').disabled = true;
                            } else {
                                $("#modal_error_teltwo").hide();
                                document.getElementById('edit_btn').disabled = false;
                            }
                        });
                    } else if ($phonetwovalue.length < 10) {
                        document.getElementById('edit_btn').disabled = true;
                    }
                }
            });
        });

        //------------------------- image scripts --------------------------------------

        $('#employee_image').change(function() {
            var read = new FileReader();

            read.onload = function(e) {
                $('#emp_image').attr("style", "width:40%");
                $('#emp_image').attr("src", e.target.result);
            }

            read.readAsDataURL(this.files[0]);
        });

        $('#edit_employee_image').change(function() {
            var read = new FileReader();

            read.onload = function(e) {
                $('#ed_emp_image').attr("style", "width:40%");
                $('#ed_emp_image').attr("src", e.target.result);
            }

            read.readAsDataURL(this.files[0]);
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