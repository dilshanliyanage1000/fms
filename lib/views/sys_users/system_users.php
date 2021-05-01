<?php
session_start();
//import HTML header section

include_once('../../inc/header.php');

if (isset($_SESSION['userId']) && $_SESSION['user_role'] == 1) {

    include_once('../../inc/sidenav.php');

?>
    <br>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">System Users</a></li>
            <li class="breadcrumb-item active">Create New Login</li>
        </ol>
    </div>
    <div class="col-md-12">
        <div class="jumbotron">
            <h1 class="display-5" align="center">New User Login&nbsp;&nbsp;<i class="fas fa-users fa-1x"></i></h1>
            <hr class="my-4">
            <div class="row">
                <div class="col-md-5">
                    <form id="purchase_product">
                        <p class="lead">System Information</p>
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="date_of_issue">Date of Issue</label>
                                <input type="text" name="date_of_issue" id="date_of_issue" class="form-control" disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="sys_user">Logged Admin</label>
                                <input type="text" name="sys_user" id="sys_user" class="form-control" value=<?php echo ($_SESSION['userFirstName'] . "&nbsp;" . $_SESSION['userLastName']); ?> disabled />
                            </div>
                        </div>
                        <br />
                        <hr class="my-4">
                        <p class="lead">Employee Selection</p>
                        <div class="row form-group">
                            <div class="col-md-10">
                                <br />
                                <div class="row">
                                    <div class="col-sm-8 col-md-8 col-lg-8">
                                        <div class="input-group">
                                            <input type="search" name="emp_search" id="emp_search" class="form-control" placeholder="Enter any employee detail...">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4">
                                        <button id="newEmp" class="btn btn-info" onclick="return false"><i class="fas fa-plus"></i>&nbsp;Employee</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="row" id="e_sel_section" style="margin-top:5px; display:none;">
                                        <p class="form-text text-muted"><i class="fas fa-exclamation-circle" style="margin-left:15px;">&nbsp;</i>Selected Employee :&nbsp;</p>
                                        <p class="form-text text-muted">[</p>
                                        <p class="form-text text-muted" id="sel_emp_id"></p>
                                        <p class="form-text text-muted">]</p>&nbsp;
                                        <p class="form-text text-muted" id="sel_emp_fname"></p>&nbsp;
                                        <p class="form-text text-muted" id="sel_emp_lname"></p>
                                    </div>
                                    <p style="color: red; display: none;" id="error_mail" class="form-text"><i class="far fa-times-circle"></i>&nbsp;This user already has a login to the system!</p>
                                    <p style="color: #39d453; display: none;" id="valid_mail" class="form-text"><i class="far fa-check-circle"></i>&nbsp;Valid User! Proceed to fill in login credentials!</p>
                                </div>
                                <br />
                                <div id="empInfo"></div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-1">
                    <div style="border-left:1px solid #dbdbdb; height:450px"></div>
                </div>
                <div class="col-md-6" style="border-radius: 20px; border: 5px solid #ebebeb;">
                    <form id="save_user_login" style="margin-top:15px;">
                        <div style="width:50%; margin-left:25%;">
                            <h3 class="lead" style="text-align: center; background-color:white; border-radius: 10px; padding-top:5px; padding-bottom:5px;">User Information</h3>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-md-6">
                                <h6 for="usr_fname">First Name</h6>
                                <input type="text" name="usr_fname" id="usr_fname" class="form-control" disabled>
                            </div>
                            <div class="col-md-6">
                                <h6 for="usr_lname">Last Name</h6>
                                <input type="text" name="usr_lname" id="usr_lname" class="form-control" disabled>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-md-6">
                                <h6 for="username">Username</h6>
                                <input type="text" name="username" id="username" class="form-control" disabled>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h6 for="job_role">Login User Role</h6>
                                    <select class="custom-select" name="job_role" id="job_role" required>
                                        <option selected="">--Select job role--</option>
                                        <option value="1">Admin</option>
                                        <option value="2">Manager</option>
                                        <option value="3">Supervisor</option>
                                        <option value="4">In-office Employee</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-md-6">
                                <h6 for="password_one">Password</h6>
                                <input type="password" name="password_one" id="password_one" class="form-control" placeholder="Enter Password" required>
                                <p style="color: orange; display: none;" id="pw_info" class="form-text"><i class="fas fa-exclamation-circle"></i>&nbsp;Password should contain more than 8 characters!</p>
                            </div>
                            <div class="col-md-6">
                                <h6 for="password_two">Retype Password</h6>
                                <input type="password" name="password_two" id="password_two" class="form-control" placeholder="Re-enter password..." required disabled>
                                <p style="color: orange; display: none;" id="pw_differs" class="form-text"><i class="fas fa-exclamation-circle"></i>&nbsp;Passwords should match!</p>
                                <p style="color: #39d453; display: none;" id="pw_match" class="form-text"><i class="far fa-check-circle"></i>&nbsp;Passwords Match!</p>
                            </div>
                        </div>
                        <div class="form-group" align="right">
                            <button id="btnSave" class="btn btn-primary" onclick="return false" style="display: none; margin-right:5px;"><i class="fas fa-check-double"></i>&nbsp;&nbsp;Create User Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="jumbotron">
            <h1 class="display-5" align="center">New User Login&nbsp;&nbsp;<i class="fas fa-users fa-1x"></i></h1>
            <br>
            <hr class="my-4">
            <table id="allUsers" class="table table-hover table-inverse table-responsive table-bordered">
                <thead class="thead-inverse">
                    <tr>
                        <th style="min-width: 100px;">User ID</th>
                        <th style="min-width: 100px;">First Name </th>
                        <th style="min-width: 100px;">Last Name </th>
                        <th>Email </th>
                        <th>Password [MD5] </th>
                        <th>User Role </th>
                        <th style="width: 40px;">Status </th>
                        <th style="width: 40px;">Edit </th>
                        <th style="width: 40px;">Delete </th>
                    </tr>
                </thead>
                <tbody id="userBody">
                    <?php
                    include_once('../../functions/system_users.php');
                    getUsers();
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit User Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editform">
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label>User Login ID</label>
                                <input type="text" name="userID" id="userID" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label>Employee ID</label>
                                <input type="text" name="employeeID" id="employeeID" class="form-control" disabled>
                            </div>
                            <div class="col-md-6">
                                <label>Employee Email</label>
                                <input type="text" name="employeeEmail" id="employeeEmail" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label>First Name</label>
                                <input type="text" name="employeeFName" id="employeeFName" class="form-control" disabled>
                            </div>
                            <div class="col-md-6">
                                <label>Last Name</label>
                                <input type="text" name="employeeLName" id="employeeLName" class="form-control" disabled>
                            </div>
                        </div>
                        <hr class="display-4">
                        <div class="row form-group">
                            <div class="col-md-12">
                                <h5>Change Password</h5>
                            </div>
                        </div>
                        <hr class="display-4">
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label>Enter New Password</label>
                                <input type="password" name="OnePassword" id="OnePassword" class="form-control" placeholder="Please enter new password">
                                <p style="color: orange; display: none;" id="modal_pw_info" class="form-text"><i class="fas fa-exclamation-circle"></i>&nbsp;Password should contain more than 8 characters!</p>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label>Re-type Password</label>
                                <input type="password" name="TwoPassword" id="TwoPassword" class="form-control" placeholder="Re-type new password">
                                <p style="color: orange; display: none;" id="modal_pw_differs" class="form-text"><i class="fas fa-exclamation-circle"></i>&nbsp;Passwords should match!</p>
                                <p style="color: #39d453; display: none;" id="modal_pw_match" class="form-text"><i class="far fa-check-circle"></i>&nbsp;Passwords Match!</p>
                            </div>
                        </div>
                        <div class="form-group" align="right">
                            <button class="btn btn-warning" type="reset" style="margin:5px;"><i class="fas fa-minus-circle"></i>&nbsp;&nbsp;Clear</button>
                            <button id="btn_edit" class="btn btn-success" onclick="return false" style="display: none; margin-right:5px;"><i class="fas fa-save"></i>&nbsp;&nbsp;Save details</button>
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

            document.getElementById('password_one').disabled = true;
            document.getElementById("TwoPassword").disabled = true;

            $("#allUsers").DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="fas fa-copy"></i>&nbsp;Copy to Clipboard',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 5, 6]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i>&nbsp;Export to Excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 5, 6]
                        },
                        title: "Udaya Industries [REPORT: SYSTEM USER LIST]"
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fas fa-file-csv"></i>&nbsp;Export to CSV',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 5, 6]
                        },
                        title: "Udaya Industries [REPORT: SYSTEM USER LIST]"
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i>&nbsp;Export to PDF',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 5, 6]
                        },
                        title: "Udaya Industries [REPORT: SYSTEM USER LIST]"
                    }
                ]
            });

            $("#emp_search").keyup(function() {
                var searchVal = $(this).val();

                if (searchVal.length < 2) {
                    $("#empInfo").hide();
                } else {
                    $.get("../../route/attendance/searchEmp.php", {
                        data: searchVal
                    }, function(data) {
                        $("#empInfo").show();
                        $("#empInfo").html(data);

                        $(".btn-success").click(function() {

                            var empId = $(this).attr('id');

                            $("#emp_number").val(empId);
                            $("#empInfo").hide();

                            //send ajax request to confirm request

                            $.get("../../route/attendance/fetchEmpResult.php", {
                                id: empId
                            }, function(data) {

                                var jdata = jQuery.parseJSON(data);

                                $("#e_sel_section").show();
                                $("#sel_emp_id").html(jdata.emp_id);
                                $("#sel_emp_fname").html(jdata.emp_fname);
                                $("#sel_emp_lname").html(jdata.emp_lname);

                                $("#username").val(jdata.emp_email);
                                $("#usr_fname").val(jdata.emp_fname);
                                $("#usr_lname").val(jdata.emp_lname);

                                document.getElementById('emp_search').value = empId;

                                var vmail = $("#username").val();

                                $.get("../../route/sys_users/mailVerify.php", {
                                    data: vmail
                                }, function(data) {
                                    if (data == "success") {
                                        $("#error_mail").show();
                                        $("#valid_mail").hide();
                                        document.getElementById("password_one").disabled = true;

                                    } else {
                                        $("#valid_mail").show();
                                        $("#error_mail").hide();
                                        document.getElementById("password_one").disabled = false;
                                        document.getElementById('password_one').disabled = false;
                                    }
                                });
                            });
                        });
                    });
                }
            });

            $("#password_one").keyup(function() {
                var pw1 = $(this).val();

                $("#pw_info").hide();
                $("#pw_match").hide();
                $("#pw_differs").hide();

                if (pw1.length >= 1) {

                    if (pw1.length < 8) {
                        document.getElementById("password_two").disabled = true;
                        $("#pw_info").show();
                        $("#pw_match").hide();
                        $("#pw_differs").hide();

                    } else {

                        $("#pw_info").hide();
                        document.getElementById("password_two").disabled = false;

                        $("#password_two").keyup(function() {
                            var pw2 = $(this).val();

                            if (pw1 == pw2) {
                                $("#pw_match").show();
                                $("#pw_differs").hide();
                                $("#btnSave").show();
                            } else {
                                $("#pw_match").hide();
                                $("#pw_differs").show();
                                $("#btnSave").hide();
                            }
                        });
                    }
                } else {
                    $("#modal_pw_info").hide();
                }
            });

            // $("#password_one").keyup(function() {
            //     var pw1 = $(this).val();

            //     if (pw1.length < 8) {
            //         document.getElementById("password_two").disabled = true;
            //         $("#pw_info").show();

            //     } else {

            //         $("#pw_info").hide();
            //         document.getElementById("password_two").disabled = false;

            //         $("#password_two").keyup(function() {
            //             var pw2 = $(this).val();

            //             if (pw1 == pw2) {
            //                 $("#pw_match").show();
            //                 $("#pw_differs").hide();
            //                 $("#btnSave").show();
            //             } else {
            //                 $("#pw_match").hide();
            //                 $("#pw_differs").show();
            //                 $("#btnSave").hide();
            //             }
            //         });
            //     }

            // });

            $("#OnePassword").keyup(function() {
                var pw1 = $(this).val();

                $("#modal_pw_info").hide();
                $("#modal_pw_match").hide();
                $("#modal_pw_differs").hide();

                if (pw1.length >= 1) {

                    if (pw1.length < 8) {
                        document.getElementById("TwoPassword").disabled = true;
                        $("#modal_pw_info").show();
                        $("#modal_pw_match").hide();
                        $("#modal_pw_differs").hide();

                    } else {

                        $("#modal_pw_info").hide();
                        document.getElementById("TwoPassword").disabled = false;

                        $("#TwoPassword").keyup(function() {
                            var pw2 = $(this).val();

                            if (pw1 == pw2) {
                                $("#modal_pw_match").show();
                                $("#modal_pw_differs").hide();
                                $("#btn_edit").show();
                            } else {
                                $("#modal_pw_match").hide();
                                $("#modal_pw_differs").show();
                                $("#btn_edit").hide();
                            }
                        });
                    }
                } else {
                    $("#modal_pw_info").hide();
                }
            });


            $("#btnSave").click(function() {

                $empID = $("#sel_emp_id").html();
                $fname = $("#usr_fname").val();
                $lname = $("#usr_lname").val();
                $email = $("#username").val();
                $role = $("#job_role").val();
                $password = $("#password_one").val();

                $.post("../../route/login/newUserLogin.php", {
                    emp_id: $empID,
                    f_name: $fname,
                    l_name: $lname,
                    email: $email,
                    role: $role,
                    password: $password,

                }, function(data) {

                    if (data == "success") {
                        setTimeout(() => {
                            location.reload();
                        }, 2100);
                        swal({
                            type: 'success',
                            title: 'New System User Created!',
                            text: 'New system user has been created succesfully!',
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

            $('#allUsers tbody').on('click', '.btn-success', function() {

                $id = $(this).attr('id');

                $.get("../../route/sys_users/getsingleUser.php", {
                    id: $id
                }, function(data) {

                    var jdata = jQuery.parseJSON(data);

                    $("#userID").val(jdata.user_id);
                    $("#employeeID").val(jdata.emp_id);
                    $("#employeeEmail").val(jdata.emp_email);
                    $("#employeeFName").val(jdata.emp_fname);
                    $("#employeeLName").val(jdata.emp_lname);
                });
            });

            $("#btn_edit").click(function() {

                $userID = $("#userID").val();
                $empID = $("#employeeID").val();
                $passwordOne = $("#OnePassword").val();
                $passwordTwo = $("#TwoPassword").val();

                $.post("../../route/sys_users/updateUserPassword.php", {
                    userID: $userID,
                    empID: $empID,
                    passwordOne: $passwordOne,
                    passwordTwo: $passwordTwo

                }, function(data) {

                    if (data == "success") {
                        setTimeout(() => {
                            location.reload();
                        }, 2100);
                        $('#editModal').modal('hide');
                        swal({
                            type: 'success',
                            title: 'Password Updated!',
                            text: 'User password has been updated successfully',
                            showConfirmButton: false,
                            timer: 2000
                        }).then((result) => {
                            if (result.dismiss === Swal.DismissReason.timer) {
                                $("#editModal").modal("hide");
                            }
                        });
                    } else {
                        $error_msg = "Kindly check whether all the mandatory fields have been filled out";
                        swal("Check your inputs!", $error_msg, "warning");
                    }
                })
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