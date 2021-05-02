<?php
session_start();

include_once('../../inc/header.php');

if (isset($_SESSION['userId']) && ($_SESSION['user_role'] == 1 || $_SESSION['user_role'] == 3 || $_SESSION['user_role'] == 4)) {

?>
    <br>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Update Production</a></li>
            <li class="breadcrumb-item active">Update Production by Request Letter</li>
        </ol>
    </div>

    <div class="col-md-12">
        <div class="jumbotron">
            <h2 class="display-5" style="text-align: center;">Update Production by Request Note&nbsp;&nbsp;<i class="fas fa-people-carry"></i></h2>
            <hr class="my-4">
            <div class="card-body">
                <form id="production_request_form" enctype="multipart/form-data">
                    <div class="row form-group">
                        <div class="col-md-6">
                            <label for="updation_date">Production Update Date :</label>
                            <input type="text" name="updation_date" id="updation_date" class="form-control" disabled>
                        </div>
                        <div class="col-md-6">
                            <label>Logged User :</label>
                            <input type="text" id="usersName" name="usersName" value="<?php echo ($_SESSION['userFirstName'] . "&nbsp;" . $_SESSION['userLastName']); ?>" class="form-control" disabled>
                        </div>
                        <div class="col-md-4" style="display: none;">
                            <input type="text" name="logged_user" id="logged_user" value="<?php echo ($_SESSION['userId']); ?>" class="form-control" disabled>
                        </div>
                    </div>
                    <br>
                    <div>
                        <h5 style="text-align: center;"><i class="far fa-file-code"></i>&nbsp;&nbsp;Please enter the request letter reference code to update production&nbsp;&nbsp;<i class="far fa-file-code"></i></h5>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <br>
                                <div class="input-group mb-3">
                                    <input class="form-control form-control-lg" type="text" placeholder="Enter Reference Code" maxlength="10" id="refcode_search" name="refcode_search">
                                    <div class="input-group-append">
                                        <span class="input-group-text">&nbsp;<i class="fas fa-search"></i>&nbsp;</span>
                                    </div>
                                </div>
                                <div id="no_records_found_error" style="text-align: center; display: none;">
                                    <p style="color: red;"><i class="far fa-times-circle"></i>&nbsp;&nbsp;No records found for the given request ID!</p>
                                </div>
                                <div id="record_already_exists" style="text-align: center; display: none;">
                                    <p style="color: red;"><i class="far fa-times-circle"></i>&nbsp;&nbsp;This request ID has been submitted!</p>
                                </div>
                                <div id="this_is_rm_req" style="text-align: center; display: none;">
                                    <p style="color: red;"><i class="far fa-times-circle"></i>&nbsp;&nbsp;This is an invalid request code: Raw Material Request Code!</p>
                                </div>
                                <br>
                                <div id="view_request_info" style="text-align: center; display: none;">
                                    <button type="button" id="viewlist_btn" class="btn btn-primary" onclick="return false"><i class="fas fa-arrow-circle-down"></i>&nbsp;&nbsp;View Request Info</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row form-group">
                        <div class="col-md-12" id="loadDetails">
                        </div>
                    </div>
                </form>
            </div>
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
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;

        $("#updation_date").val(today);
    </script>

    <script>
        $(document).ready(function() {

            var requester = '';
            var reqDate = '';
            var logged_user = '';

            $("#refcode_search").keyup(function() {

                var searchVal = $(this).val();

                if (searchVal.length > 9) {

                    $.get("../../route/updateproduction/updateproductionbyrequest.php", {
                        value: searchVal
                    }, function(data) {

                        $("#view_request_info").hide();
                        $("#no_records_found_error").hide();
                        $("#record_already_exists").hide();
                        $("#this_is_rm_req").hide();

                        if (data == 'no_records_found') {

                            $("#view_request_info").hide();
                            $("#no_records_found_error").show();
                            $("#record_already_exists").hide();
                            $("#this_is_rm_req").hide();

                        } else if (data == 'rec_exists') {

                            $("#view_request_info").hide();
                            $("#no_records_found_error").hide();
                            $("#record_already_exists").show();
                            $("#this_is_rm_req").hide();

                        } else if (data == 'success') {

                            $("#view_request_info").show();
                            $("#no_records_found_error").hide();
                            $("#record_already_exists").hide();
                            $("#this_is_rm_req").hide();

                            document.getElementById('refcode_search').disabled = true;

                            var refcode_search = $("#refcode_search").val();

                            $("#viewlist_btn").click(function() {

                                $.get("../../route/updateproduction/getAllDetailsbyRQSID.php", {
                                    id: refcode_search
                                }, function(data) {
                                    if (data == 'rm_req') {
                                        $("#this_is_rm_req").show();
                                    } else {
                                        $("#loadDetails").html(data);

                                        $("#viewlist_btn").hide();

                                        $(".btn-finalize").click(function() {

                                            var requestID = $(this).attr('id');

                                            var updation_date = $("#updation_date").val();

                                            var logged_user = $("#logged_user").val();

                                            $.post("../../route/req_notes/updateproductionbyrequestid.php", {
                                                requestID: requestID,
                                                updation_date: updation_date,
                                                logged_user: logged_user
                                            }, function(data) {
                                                if (data == 'success') {
                                                    setTimeout(() => {
                                                        window.location.href = '../production_history/production_history.php';
                                                    }, 2600);
                                                    swal({
                                                        type: 'success',
                                                        title: 'Product Updated by Request Note!',
                                                        text: 'Production has been logged and stock has been updated!',
                                                        showConfirmButton: false,
                                                        timer: 2500
                                                    });
                                                } else {
                                                    swal("Check your inputs!", "Kindly check whether all the mandatory fields have been filled out", "warning");
                                                }
                                            });
                                        });
                                    }
                                });
                            });
                        }
                    });

                } else {
                    $("#view_request_info").hide();
                    $("#no_records_found_error").hide();
                    $("#record_already_exists").hide();
                }
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