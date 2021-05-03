<?php
session_start();

include_once('../../inc/header.php');

if (isset($_SESSION['userId']) && ($_SESSION['user_role'] == 1 || $_SESSION['user_role'] == 4)) {

?>
    <br>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Raw Material Request Form</a></li>
        </ol>
    </div>

    <div class="content-wrapper">
        <div class="content">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h3 class="card-title" style="text-align: center;">Production Request Note&nbsp;&nbsp;<i class="fas fa-clipboard-list"></i></h3>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="reload"></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form id="production_request_form" enctype="multipart/form-data">
                        <div class="row form-group">
                            <div class="col-md-4">
                                <label for="production_requester">Production Requester/ Supervisor :</label>
                                <select class="form-control" id="production_requester" name="production_requester">
                                    <?php
                                    include_once('../../functions/employee.php');
                                    getSupervisorsforRQST();
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="request_date">Production Request Date :</label>
                                <input type="text" name="request_date" id="request_date" class="form-control" disabled>
                            </div>
                            <div class="col-md-4">
                                <label>Logged User :</label>
                                <input type="text" id="usersName" name="usersName" value="<?php echo ($_SESSION['userFirstName'] . "&nbsp;" . $_SESSION['userLastName']); ?>" class="form-control" disabled>
                            </div>
                            <div class="col-md-4" style="display: none;">
                                <input type="text" name="logged_user" id="logged_user" value="<?php echo ($_SESSION['userId']); ?>" class="form-control" disabled>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        <h6>Search for products that needs production:</h6>
                                    </label>
                                    <input type="text" name="searchforlist" id="searchforlist" class="form-control" placeholder="Enter any product keyword..">
                                </div>
                                <div class="form-group" style="width: 100%;">
                                    <div class="container" id="prod_scroll_section" style="width: 100%; border: 3px #eee solid; overflow: auto; white-space: nowrap; background-color: #eee; display: none;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="display: none;" id="selectedproduct">
                                    <div style="border: 5px solid #abe0d1; border-radius: 10px; padding: 25px;" id="p_sel_section">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <p>Product Code</p>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <p>Product Name</p>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <input type="text" name="sel_pcode" id="sel_pcode" class="form-control" disabled>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <input type="text" name="sel_pname" id="sel_pname" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <p>Quantity</p>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <p>Urgency</p>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <input type="number" name="prd_qty" id="prd_qty" placeholder="Enter required quantity" class="form-control">
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <select class="custom-select" id="urgency_level" name="urgency_level">
                                                    <option value="Low">Low (~20 days)</option>
                                                    <option value="Medium">Medium (~15 days)</option>
                                                    <option value="High">High (~5 Days)</option>
                                                    <option value="Critical">Critical (~2 Days)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div align="right">
                                            <button id="addPRDtoREQ" class="btn btn-secondary" onclick="return false"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add to Production Request</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row" style="margin-bottom:20px; display: none; text-align: center;" id="show_table">
                            <table id="prod_req_list" class="table table-hover table-inverse table-responsive table-bordered" style="margin-top:10px; margin-left:10px; width:100%; font-size: 15px;">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th style="min-width: 100px;">Product ID</th>
                                        <th style="min-width: 100px;">Product Code</th>
                                        <th style="min-width: 150px;">Product Name</th>
                                        <th style="min-width: 150px;">Motor Capacity</th>
                                        <th style="min-width: 150px;">Quantity</th>
                                        <th style="min-width: 150px;">Urgency</th>
                                        <th style="min-width: 100px;">Delete</th>
                                    </tr>
                                </thead>
                                <tbody id="reqlist_body"></tbody>
                            </table>
                        </div>
                        <br>
                        <div class="text-right">
                            <button type="button" id="genrequest" class="btn btn-primary" onclick="return false"><i class="fas fa-paper-plane"></i>&nbsp;&nbsp;Request Production</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="navbar navbar-expand-lg navbar-light">
            <div class="text-center d-lg-none w-100">
                <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
                    <i class="icon-unfold mr-2"></i>
                    Footer
                </button>
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

        $("#request_date").val(today);
    </script>

    <script>
        $(document).ready(function() {

            document.getElementById("genrequest").disabled = true;

            var prod_id = '';
            var prod_name = '';
            var prod_code = '';
            var prod_description = '';
            var prod_capacity = '';
            var prod_motor_capacity = '';
            var prod_motor_speed = '';
            var prod_phase = '';

            var requester = '';
            var reqDate = '';
            var logged_user = '';

            $("#prd_qty").keyup(function() {

                var qtyvalue = $(this).val();

                if (qtyvalue < 0) {
                    swal("Error!", "Negative values are not allowed!", "warning");
                    $("#prd_qty").val('');
                }
            });

            $("#prd_qty").change(function() {

                var qtyvalue = $(this).val();

                if (qtyvalue < 0) {
                    swal("Error!", "Negative values are not allowed!", "warning");
                    $("#prd_qty").val('');
                }
            });

            $("#searchforlist").keyup(function() {

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

                            var prd_id = $(this).attr('id');

                            $("#prod_scroll_section").hide();

                            $.get("../../route/req_notes/fetchProdResult.php", {
                                id: prd_id
                            }, function(data) {

                                var jdata = jQuery.parseJSON(data);

                                prod_id = jdata.prod_id;
                                prod_name = jdata.prod_name;
                                prod_code = jdata.prod_code;
                                prod_description = jdata.prod_description;
                                prod_capacity = jdata.prod_capacity;
                                prod_motor_capacity = jdata.prod_motor_capacity;
                                prod_motor_speed = jdata.prod_motor_speed;
                                prod_phase = jdata.prod_phase;

                                $("#selectedproduct").show();

                                $("#sel_pcode").val(jdata.prod_code);
                                $("#sel_pname").val(jdata.prod_name);

                                document.getElementById('searchforlist').value = '';
                            });
                        });

                    })
                }
            });

            $("#addPRDtoREQ").click(function() {

                var prd_qty = $("#prd_qty").val();

                var urgency = $("#urgency_level").val();

                if (prd_qty == "" || urgency == "") {

                    $error_msg = "Kindly check whether 'Urgency Level' and 'Quantity' have been filled out";

                    swal("Check your inputs!", $error_msg, "warning");

                } else {

                    $("#show_table").show();

                    $("#prod_req_list tbody").append('<tr><td>' + prod_id + '</td><td>' + prod_code + '</td><td>' + prod_name + '</td><td>' + prod_motor_capacity + '</td><td>' + prd_qty + '</td><td>' + urgency + '</td><td><button class="btn btn-danger btn-del" type="button"><i class="far fa-trash-alt"></i></button></td></tr>');

                    document.getElementById('sel_pcode').value = '';
                    document.getElementById('sel_pname').value = '';
                    document.getElementById('prd_qty').value = '';
                    document.getElementById('urgency_level').value = 'Low';

                    $("#selectedproduct").hide();

                    document.getElementById("genrequest").disabled = false;
                }
            });

            $("#prod_req_list tbody").on("click", ".btn-del", function() {

                var id = $(this).closest("tr").attr("id");

                $(this).closest("tr").remove();

            });

            $("#genrequest").click(function() {

                production_requester = $("#production_requester").val();

                request_date = $("#request_date").val();

                logged_user = $("#logged_user").val();

                usersName = $("#usersName").val();

                var TableData = new Array();

                if (production_requester == '') {
                    swal("Please select supervisor!", "Kindly select the supervisor in charge to continue", "warning");
                } else {

                    $("#prod_req_list tr").each(function(row, tr) {
                        TableData[row] = {
                            "prodID": $(tr).find('td:eq(0)').text(),
                            "prodcode": $(tr).find('td:eq(1)').text(),
                            "prodname": $(tr).find('td:eq(2)').text(),
                            "proddetails": $(tr).find('td:eq(3)').text(),
                            "prodQty": $(tr).find('td:eq(4)').text(),
                            "prodUrgency": $(tr).find('td:eq(5)').text()
                        }
                    });

                    TableData.shift();

                    var ProdReqList = JSON.stringify(TableData);

                    var formData = new FormData(form);

                    var form = $('#production_request_form')[0];

                    $.post("../../route/req_notes/saveProductionRequest.php", {
                        production_requester: production_requester,
                        request_date: request_date,
                        logged_user: logged_user,
                        usersName: usersName,
                        ProdReqList: ProdReqList
                    }, function(data) {
                        if (data == "success") {
                            setTimeout(() => {
                                window.location.href = './allrequests.php';
                            }, 2200);
                            swal({
                                type: 'success',
                                title: 'New Request placed!',
                                text: 'New Request has been placed successfully!',
                                showConfirmButton: false,
                                timer: 2100
                            })
                        } else {
                            $error_msg = "Kindly check whether all the mandatory fields have been filled out";
                            swal("Check your inputs!", $error_msg, "warning");
                        }
                    });
                }
            });
        });
    </script>

    </body>

    </html>

<?php

} else if (isset($_SESSION['userId']) && ($_SESSION['user_role'] == 3)) {

?>

<br>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Raw Material Request Form</a></li>
        </ol>
    </div>

    <div class="content-wrapper">
        <div class="content">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h3 class="card-title" style="text-align: center;">Production Request Note&nbsp;&nbsp;<i class="fas fa-clipboard-list"></i></h3>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="reload"></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form id="production_request_form" enctype="multipart/form-data">
                        <div class="row form-group">
                            <div class="col-md-4">
                                <label for="production_requester">Production Requester/ Supervisor :</label>
                                <select class="form-control" id="production_requester" name="production_requester">
                                    <?php
                                    include_once('../../functions/employee.php');
                                    getSupervisorsforRQST();
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="request_date">Production Request Date :</label>
                                <input type="text" name="request_date" id="request_date" class="form-control" disabled>
                            </div>
                            <div class="col-md-4">
                                <label>Logged User :</label>
                                <input type="text" id="usersName" name="usersName" value="<?php echo ($_SESSION['userFirstName'] . "&nbsp;" . $_SESSION['userLastName']); ?>" class="form-control" disabled>
                            </div>
                            <div class="col-md-4" style="display: none;">
                                <input type="text" name="logged_user" id="logged_user" value="<?php echo ($_SESSION['userId']); ?>" class="form-control" disabled>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        <h6>Search for products that needs production:</h6>
                                    </label>
                                    <input type="text" name="searchforlist" id="searchforlist" class="form-control" placeholder="Enter any product keyword..">
                                </div>
                                <div class="form-group" style="width: 100%;">
                                    <div class="container" id="prod_scroll_section" style="width: 100%; border: 3px #eee solid; overflow: auto; white-space: nowrap; background-color: #eee; display: none;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="display: none;" id="selectedproduct">
                                    <div style="border: 5px solid #abe0d1; border-radius: 10px; padding: 25px;" id="p_sel_section">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <p>Product Code</p>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <p>Product Name</p>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <input type="text" name="sel_pcode" id="sel_pcode" class="form-control" disabled>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <input type="text" name="sel_pname" id="sel_pname" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <p>Quantity</p>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <p>Urgency</p>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <input type="number" name="prd_qty" id="prd_qty" placeholder="Enter required quantity" class="form-control">
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <select class="custom-select" id="urgency_level" name="urgency_level">
                                                    <option value="Low">Low (~20 days)</option>
                                                    <option value="Medium">Medium (~15 days)</option>
                                                    <option value="High">High (~5 Days)</option>
                                                    <option value="Critical">Critical (~2 Days)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div align="right">
                                            <button id="addPRDtoREQ" class="btn btn-secondary" onclick="return false"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add to Production Request</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row" style="margin-bottom:20px; display: none; text-align: center;" id="show_table">
                            <table id="prod_req_list" class="table table-hover table-inverse table-responsive table-bordered" style="margin-top:10px; margin-left:10px; width:100%; font-size: 15px;">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th style="min-width: 100px;">Product ID</th>
                                        <th style="min-width: 100px;">Product Code</th>
                                        <th style="min-width: 150px;">Product Name</th>
                                        <th style="min-width: 150px;">Motor Capacity</th>
                                        <th style="min-width: 150px;">Quantity</th>
                                        <th style="min-width: 150px;">Urgency</th>
                                        <th style="min-width: 100px;">Delete</th>
                                    </tr>
                                </thead>
                                <tbody id="reqlist_body"></tbody>
                            </table>
                        </div>
                        <br>
                        <div class="text-right">
                            <button type="button" id="genrequest" class="btn btn-primary" onclick="return false"><i class="fas fa-paper-plane"></i>&nbsp;&nbsp;Request Production</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="navbar navbar-expand-lg navbar-light">
            <div class="text-center d-lg-none w-100">
                <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
                    <i class="icon-unfold mr-2"></i>
                    Footer
                </button>
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

        $("#request_date").val(today);
    </script>

    <script>
        $(document).ready(function() {

            document.getElementById("genrequest").disabled = true;

            var prod_id = '';
            var prod_name = '';
            var prod_code = '';
            var prod_description = '';
            var prod_capacity = '';
            var prod_motor_capacity = '';
            var prod_motor_speed = '';
            var prod_phase = '';

            var requester = '';
            var reqDate = '';
            var logged_user = '';

            $("#prd_qty").keyup(function() {

                var qtyvalue = $(this).val();

                if (qtyvalue < 0) {
                    swal("Error!", "Negative values are not allowed!", "warning");
                    $("#prd_qty").val('');
                }
            });

            $("#prd_qty").change(function() {

                var qtyvalue = $(this).val();

                if (qtyvalue < 0) {
                    swal("Error!", "Negative values are not allowed!", "warning");
                    $("#prd_qty").val('');
                }
            });

            $("#searchforlist").keyup(function() {

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

                            var prd_id = $(this).attr('id');

                            $("#prod_scroll_section").hide();

                            $.get("../../route/req_notes/fetchProdResult.php", {
                                id: prd_id
                            }, function(data) {

                                var jdata = jQuery.parseJSON(data);

                                prod_id = jdata.prod_id;
                                prod_name = jdata.prod_name;
                                prod_code = jdata.prod_code;
                                prod_description = jdata.prod_description;
                                prod_capacity = jdata.prod_capacity;
                                prod_motor_capacity = jdata.prod_motor_capacity;
                                prod_motor_speed = jdata.prod_motor_speed;
                                prod_phase = jdata.prod_phase;

                                $("#selectedproduct").show();

                                $("#sel_pcode").val(jdata.prod_code);
                                $("#sel_pname").val(jdata.prod_name);

                                document.getElementById('searchforlist').value = '';
                            });
                        });

                    })
                }
            });

            $("#addPRDtoREQ").click(function() {

                var prd_qty = $("#prd_qty").val();

                var urgency = $("#urgency_level").val();

                if (prd_qty == "" || urgency == "") {

                    $error_msg = "Kindly check whether 'Urgency Level' and 'Quantity' have been filled out";

                    swal("Check your inputs!", $error_msg, "warning");

                } else {

                    $("#show_table").show();

                    $("#prod_req_list tbody").append('<tr><td>' + prod_id + '</td><td>' + prod_code + '</td><td>' + prod_name + '</td><td>' + prod_motor_capacity + '</td><td>' + prd_qty + '</td><td>' + urgency + '</td><td><button class="btn btn-danger btn-del" type="button"><i class="far fa-trash-alt"></i></button></td></tr>');

                    document.getElementById('sel_pcode').value = '';
                    document.getElementById('sel_pname').value = '';
                    document.getElementById('prd_qty').value = '';
                    document.getElementById('urgency_level').value = 'Low';

                    $("#selectedproduct").hide();

                    document.getElementById("genrequest").disabled = false;
                }
            });

            $("#prod_req_list tbody").on("click", ".btn-del", function() {

                var id = $(this).closest("tr").attr("id");

                $(this).closest("tr").remove();

            });

            $("#genrequest").click(function() {

                production_requester = $("#production_requester").val();

                request_date = $("#request_date").val();

                logged_user = $("#logged_user").val();

                usersName = $("#usersName").val();

                var TableData = new Array();

                if (production_requester == '') {
                    swal("Please select supervisor!", "Kindly select the supervisor in charge to continue", "warning");
                } else {

                    $("#prod_req_list tr").each(function(row, tr) {
                        TableData[row] = {
                            "prodID": $(tr).find('td:eq(0)').text(),
                            "prodcode": $(tr).find('td:eq(1)').text(),
                            "prodname": $(tr).find('td:eq(2)').text(),
                            "proddetails": $(tr).find('td:eq(3)').text(),
                            "prodQty": $(tr).find('td:eq(4)').text(),
                            "prodUrgency": $(tr).find('td:eq(5)').text()
                        }
                    });

                    TableData.shift();

                    var ProdReqList = JSON.stringify(TableData);

                    var formData = new FormData(form);

                    var form = $('#production_request_form')[0];

                    $.post("../../route/req_notes/saveProductionRequest.php", {
                        production_requester: production_requester,
                        request_date: request_date,
                        logged_user: logged_user,
                        usersName: usersName,
                        ProdReqList: ProdReqList
                    }, function(data) {
                        if (data == "success") {
                            setTimeout(() => {
                                window.location.href = '../dashboard/supervisor.php';
                            }, 2200);
                            swal({
                                type: 'success',
                                title: 'New Request placed!',
                                text: 'New Request has been placed successfully!',
                                showConfirmButton: false,
                                timer: 2100
                            })
                        } else {
                            $error_msg = "Kindly check whether all the mandatory fields have been filled out";
                            swal("Check your inputs!", $error_msg, "warning");
                        }
                    });
                }
            });
        });
    </script>

    </body>

    </html>

<?php

} else {

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