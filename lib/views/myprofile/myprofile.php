<?php
session_start();

include_once('../../inc/header.php');

if (isset($_SESSION['userId']) && $_SESSION['user_role'] == 1) {

    include_once('../../inc/sidenav.php');

?>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <style>
        .event a {
            background-color: red !important;
            background-image: none !important;
            color: white !important;
        }
    </style>

    <br>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../dashboard/admin.php">Dashboard</a></li>
            <li class="breadcrumb-item active">My Profile</li>
        </ol>
    </div>

    <div class="col-md-12">
        <div class="jumbotron" style="padding : 1rem 1rem;">
            <div class="row">
                <div class="col-md-4">
                    <img src="../../<?php echo ($_SESSION['userImage']); ?>" alt="Profile Picture" style="width:100px; border-radius: 10px;" />
                </div>
                <div class="col-md-4">
                    <h1 style="text-align: center; margin-top: 30px;">My Profile</h1>
                </div>
                <div class="col-md-4"></div>
            </div>
            <hr class="my-4">
            <div class="row">
                <div class="col-md-3">
                    <div id="datepicker"></div>
                </div>
                <div class="col-md-5">
                    <div style="background-color: white; border-radius: 10px; padding: 12px;">
                        <div class="row">
                            <div class="col-md-8">
                                <h5 style="text-align: left;">Personal Details</h5>
                            </div>
                            <div class="col-md-4">
                                <h6 style="text-align: right;"><button type="button" class="btn btn-light btn-sm" data-toggle='modal' data-target='#userEditModal'><i class="fas fa-user-edit"></i>&nbsp;&nbsp;Edit Profile</button></h6>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <h6 style="text-align: right;">Employee ID :</h6>
                            </div>
                            <div class="col-md-8">
                                <h6 style="text-align: left;" id="display_empID"></h6>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <h6 style="text-align: right;">Full Name :</h6>
                            </div>
                            <div class="col-md-8">
                                <h6 style="text-align: left;" id="display_name"></h6>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <h6 style="text-align: right;">Email :</h6>
                            </div>
                            <div class="col-md-8">
                                <h6 style="text-align: left;" id="display_email"></h6>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <h6 style="text-align: right;">NIC Number :</h6>
                            </div>
                            <div class="col-md-8">
                                <h6 style="text-align: left;" id="display_nic"></h6>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <h6 style="text-align: right;">Contacts :</h6>
                            </div>
                            <div class="col-md-8">
                                <h6 style="text-align: left;" id="display_numbers"></h6>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <h6 style="text-align: right;">Address :</h6>
                            </div>
                            <div class="col-md-8">
                                <h6 style="text-align: left;" id="display_address"></h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div style="background-color: white; border-radius: 10px; padding: 12px;">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 style="text-align: left;">Employee Information</h5>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-5">
                                <h6 style="text-align: right;">Employee Role :</h6>
                            </div>
                            <div class="col-md-7">
                                <h5 style="text-align: left;"><span class="badge badge-dark" id="display_jobrole"></span></h5>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5">
                                <h6 style="text-align: right;">Standard Salary :</h6>
                            </div>
                            <div class="col-md-7">
                                <h6 style="text-align: left;" id="display_basic_role"></h6>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5">
                                <h6 style="text-align: right;">O.T. Salary :</h6>
                            </div>
                            <div class="col-md-7">
                                <h6 style="text-align: left;" id="display_ot_sal"></h6>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5">
                                <h6 style="text-align: right;">Status :</h6>
                            </div>
                            <div class="col-md-7">
                                <h5 style="text-align: left;"><span class="badge badge-primary" id="display_emp_status"></span></h5>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div>
                        <div class="row">
                            <div class="col-md-12">
                                <h6><button type="button" class="btn btn-block btn-warning" style="color: black; padding: 20px;" data-toggle="modal" data-target="#changePasswordModal"><i class="fas fa-undo-alt"></i>&nbsp;&nbsp;Click here to change password!</button></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- -------------------------------------------------------------------------------- change password modal ------------------------------------------------------ -->

    <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="changepassword">
                        <div class="col-md-12">
                            <label for="userID">User ID :</label>
                            <input type="text" class="form-control" name="userID" id="userID" disabled>
                        </div>
                        <br>
                        <hr>
                        <div class="col-md-12">
                            <label for="current_password">Enter Your Current Password :</label>
                            <input type="password" class="form-control" name="current_password" id="current_password" placeholder="Please enter your current password">
                            <p style="color: red; display:none; text-align: center; margin-top: 3px;" id="current_pw_error"><i class="far fa-times-circle"></i>&nbsp;&nbsp;Incorrect Password</p>
                            <p style="color: green; display:none; text-align: center; margin-top: 3px;" id="current_pw_success"><i class="far fa-check-circle"></i>&nbsp;&nbsp;Password Matched</p>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <label for="new_password">Enter New Password :</label>
                            <input type="password" class="form-control" name="new_password" id="new_password" placeholder="Please enter your new password">
                            <p style="color: orange; display: none;" id="pw_info" class="form-text"><i class="fas fa-exclamation-circle"></i>&nbsp;Password should contain more than 8 characters!</p>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <label for="retype_new_password">Retype New Password :</label>
                            <input type="password" class="form-control" name="retype_new_password" id="retype_new_password" placeholder="Please retype your new password">
                            <p style="color: orange; display: none;" id="pw_differs" class="form-text"><i class="fas fa-exclamation-circle"></i>&nbsp;Passwords should match!</p>
                            <p style="color: #39d453; display: none;" id="pw_match" class="form-text"><i class="far fa-check-circle"></i>&nbsp;Passwords Match!</p>
                        </div>
                        <br>
                        <br>
                        <div class="col-md-12">
                            <button type="button" class="btn btn-block btn-success" id="change_btn"><i class="fas fa-check-double"></i>&nbsp;&nbsp;Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- --------------------------------------------------------------------------------  edit user modal ------------------------------------------------------ -->


    <div class="modal fade" id="userEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <div class="row form-group">
                            <div class="col-md-6">
                                <button class="btn btn-warning btn-block" id="btn_del" type="reset"><i class="fas fa-minus-circle"></i>&nbsp;&nbsp;Clear</button>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-primary btn-block" id="edit_btn" type="button"><i class="fas fa-check-double"></i>&nbsp;&nbsp;Update Details</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Model -->

    </body>

    </html>

    <script>
        $(document).ready(function() {

            var eventDates = {};

            var userID = "<?php echo ($_SESSION['userId']); ?>";

            $.get("../../route/myprofile/getEmp.php", {
                id: userID
            }, function(data) {
                if (data == 'error') {
                    $error_msg = "Kindly check whether all the mandatory fields have been filled out";
                    swal("Check your inputs!", $error_msg, "warning");
                } else {

                    var jdata = jQuery.parseJSON(data);

                    $("#userID").val(jdata.user_id);

                    $("#display_empID").html(jdata.emp_id);
                    $("#display_name").html(jdata.emp_fname + '&nbsp;' + jdata.emp_lname);
                    $("#display_email").html(jdata.emp_email);
                    $("#display_nic").html(jdata.emp_nic);
                    $("#display_numbers").html(jdata.emp_telno + '&nbsp;/&nbsp;' + jdata.emp_telno_2);
                    $("#display_address").html(jdata.emp_address);
                    $("#display_jobrole").html(jdata.jobrole_name);

                    var BasicSal = 'Rs. ' + jdata.jobrole_basicsal + '.00 /hr.';
                    var OTSal = 'Rs. ' + jdata.jobrole_maxsal + '.00 /hr.';

                    $("#display_basic_role").html(BasicSal);
                    $("#display_ot_sal").html(OTSal);
                    $("#display_emp_status").html('Active');

                    $("#emp_id").val(jdata.emp_id);
                    $("#emp_fname").val(jdata.emp_fname);
                    $("#emp_lname").val(jdata.emp_lname);
                    $("#emp_telno").val(jdata.emp_telno);
                    $("#emp_telno_2").val(jdata.emp_telno_2);
                    $("#emp_address").val(jdata.emp_address);

                    $.get("../../route/myprofile/getAttendanceDates.php", {
                        id: userID
                    }, function(data) {

                        var newdata = jQuery.parseJSON(data);

                        $.each(newdata, function(key, value) {
                            eventDates[new Date(value)] = new Date(value);
                        });
                        
                    });
                }
            });

            
            $('#datepicker').datepicker({
                beforeShowDay: function(date) {
                    var highlight = eventDates[date];
                    if (highlight) {
                        return [true, "event", 'Tooltip text'];
                    } else {
                        return [true, '', ''];
                    }
                }
            });


            document.getElementById('change_btn').disabled = true;
            document.getElementById('new_password').disabled = true;
            document.getElementById('retype_new_password').disabled = true;
            $("#current_pw_error").hide();
            $("#current_pw_success").hide();


            $("#current_password").keyup(function() {

                var userID = $("#userID").val();
                var currentpassword = $("#current_password").val();

                if (currentpassword.length > 1) {

                    $.get("../../route/myprofile/validatepassword.php", {
                        id: userID,
                        password: currentpassword
                    }, function(data) {
                        if (data == "success") {
                            $("#current_pw_error").hide();
                            $("#current_pw_success").show();

                            document.getElementById('new_password').disabled = false;

                        } else {
                            document.getElementById('new_password').disabled = true;
                            $("#current_pw_error").show();
                            $("#current_pw_success").hide();

                            document.getElementById('new_password').disabled = true;
                            document.getElementById('retype_new_password').disabled = true;
                        }
                    });
                } else {
                    document.getElementById('change_btn').disabled = true;
                }
            });

            $("#new_password").keyup(function() {
                var pw1 = $(this).val();

                $("#pw_info").hide();
                $("#pw_match").hide();
                $("#pw_differs").hide();
                document.getElementById("change_btn").disabled = true;

                if (pw1.length >= 1) {

                    if (pw1.length < 8) {
                        document.getElementById("retype_new_password").disabled = true;
                        $("#pw_info").show();
                        $("#pw_match").hide();
                        $("#pw_differs").hide();

                    } else {

                        $("#pw_info").hide();
                        document.getElementById("retype_new_password").disabled = false;

                        $("#retype_new_password").keyup(function() {
                            var pw2 = $(this).val();

                            if (pw1 == pw2) {
                                $("#pw_match").show();
                                $("#pw_differs").hide();
                                document.getElementById('change_btn').disabled = false;
                            } else {
                                $("#pw_match").hide();
                                $("#pw_differs").show();
                                document.getElementById('change_btn').disabled = true;
                            }
                        });
                    }
                }
            });

            $("#change_btn").click(function() {

                var userID = "<?php echo ($_SESSION['userId']); ?>";
                var currentpassword = $("#current_password").val();
                var newpassword = $("#new_password").val();
                var retypenewpassword = $("#retype_new_password").val();

                $.post("../../route/myprofile/changepassword.php", {
                    userID: userID,
                    currentpassword: currentpassword,
                    newpassword: newpassword,
                    retypenewpassword: retypenewpassword
                }, function(data) {

                    if (data == "success") {
                        setTimeout(() => {
                            location.reload();
                        }, 2450);
                        swal({
                            type: 'success',
                            title: 'Password Changed!',
                            text: 'Your new password has been set!',
                            showConfirmButton: false,
                            timer: 2400
                        });
                    } else {

                        $error_msg = "Kindly check whether all the mandatory fields have been filled out";

                        swal("Check your inputs!", $error_msg, "warning");
                    }
                });
            });

            //-------------------------- phone numbers -------------------------------

            $("#emp_telno").keyup(function() {
                var emp_id = $("#emp_id").val();
                var searchVal = $(this).val();

                if (searchVal.length < 10 || searchVal.length > 10) {
                    document.getElementById('edit_btn').disabled = true;
                } else {
                    $.get("../../route/employee/validatetel.php", {
                        id: emp_id,
                        value: searchVal
                    }, function(data) {
                        if (data == "proceed") {
                            document.getElementById('edit_btn').disabled = false;
                        } else {
                            document.getElementById('edit_btn').disabled = true;
                        }
                    });
                }
            });

            $("#emp_telno").change(function() {
                var emp_id = $("#emp_id").val();
                var searchVal = $(this).val();

                if (searchVal.length < 10 || searchVal.length > 10) {
                    document.getElementById('edit_btn').disabled = true;
                } else {
                    $.get("../../route/employee/validatetel.php", {
                        id: emp_id,
                        value: searchVal
                    }, function(data) {
                        if (data == "proceed") {
                            document.getElementById('edit_btn').disabled = false;
                        } else {
                            document.getElementById('edit_btn').disabled = true;
                        }
                    });
                }
            });

            $("#emp_telno_2").keyup(function() {
                var emp_id = $("#emp_id").val();
                var searchVal = $(this).val();

                if (searchVal.length < 10 || searchVal.length > 10) {
                    document.getElementById('edit_btn').disabled = true;
                } else {
                    $.get("../../route/employee/validatetel.php", {
                        id: emp_id,
                        value: searchVal
                    }, function(data) {
                        if (data == "proceed") {
                            document.getElementById('edit_btn').disabled = false;
                        } else {
                            document.getElementById('edit_btn').disabled = true;
                        }
                    });
                }
            });

            $("#emp_telno_2").change(function() {
                var emp_id = $("#emp_id").val();
                var searchVal = $(this).val();

                if (searchVal.length < 10 || searchVal.length > 10) {
                    document.getElementById('edit_btn').disabled = true;
                } else {
                    $.get("../../route/employee/validatetel.php", {
                        id: emp_id,
                        value: searchVal
                    }, function(data) {
                        if (data == "proceed") {
                            document.getElementById('edit_btn').disabled = false;
                        } else {
                            document.getElementById('edit_btn').disabled = true;
                        }
                    });
                }
            });

            //-------------------------------------update details btn ---------------------------------

            $("#edit_btn").click(function() {

                var emp_id = $("#emp_id").val();
                var emp_fname = $("#emp_fname").val();
                var emp_lname = $("#emp_lname").val();
                var emp_telno = $("#emp_telno").val();
                var emp_telno_2 = $("#emp_telno_2").val();
                var emp_address = $("#emp_address").val();

                $.post("../../route/myprofile/updateUser.php", {
                    emp_id: emp_id,
                    emp_fname: emp_fname,
                    emp_lname: emp_lname,
                    emp_telno: emp_telno,
                    emp_telno_2: emp_telno_2,
                    emp_address: emp_address
                }, function(data) {
                    if (data == "success") {
                        setTimeout(() => {
                            location.reload();
                        }, 2100);
                        swal({
                            type: 'success',
                            title: 'Your details updated!',
                            text: 'Your details have been updated successfully',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    } else {
                        swal("Check your inputs!", "Kindly check whether all the mandatory fields have been filled out", "warning");
                    }
                });
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