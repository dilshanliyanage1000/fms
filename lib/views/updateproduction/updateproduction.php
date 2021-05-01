<?php
session_start();

include_once('../../inc/header.php');

if (isset($_SESSION['userId']) && ($_SESSION['user_role'] == 1 || $_SESSION['user_role'] == 3)) {

    include_once('../../inc/sidenav.php');

?>
    <br>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Update Production</a></li>
        </ol>
    </div>

    <div class="col-md-12">
        <div class="jumbotron">
            <h2 class="display-5" style="text-align: center;">Update Machine Production&nbsp;&nbsp;<i class="fas fa-people-carry"></i></h2>
            <hr class="my-4">
            <br>
            <div class="card-body">
                <form id="production_request_form" enctype="multipart/form-data">
                    <div class="row form-group">
                        <div class="col-md-4">
                            <label for="updation_date">Production Update Date :</label>
                            <input type="text" name="updation_date" id="updation_date" class="form-control" disabled>
                        </div>
                        <div class="col-md-4">
                            <label>Logged User :</label>
                            <input type="text" id="usersName" name="usersName" value="<?php echo ($_SESSION['userFirstName'] . "&nbsp;" . $_SESSION['userLastName']); ?>" class="form-control" disabled>
                        </div>
                        <div class="col-md-4" style="display: none;">
                            <input type="text" name="logged_user" id="logged_user" value="<?php echo ($_SESSION['userId']); ?>" class="form-control" disabled>
                        </div>
                        <div class="col-md-4">
                            <label for="production_update_requester">Production Update Supervisor :</label>
                            <select class="form-control" id="production_update_requester" name="production_update_requester">
                                <?php
                                include_once('../../functions/employee.php');
                                getSupervisorsforRQST();
                                ?>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>
                                    <h6>Search for products that needs updation:</h6>
                                </label>
                                <input type="text" name="searchforlist" id="searchforlist" class="form-control" placeholder="Enter any product or part keyword..">
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
                                            <p>Motor Capacity</p>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <p>Quantity</p>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <input type="text" name="sel_pmotor" id="sel_pmotor" class="form-control" disabled>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <input type="number" name="prd_qty" id="prd_qty" max='50' min='1' placeholder="Enter Quantity" class="form-control">
                                        </div>
                                    </div>
                                    <br>
                                    <div align="right">
                                        <button id="addPRDtoUP" class="btn btn-secondary" onclick="return false"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add to Production Update!</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row" style="margin-bottom:20px; display: none; text-align: center;" id="show_table">
                        <table id="production_update_list" class="table table-hover table-inverse table-responsive table-bordered" style="margin-top:10px; margin-left:10px; width:100%; font-size: 17px;">
                            <thead class="thead-inverse">
                                <tr>
                                    <th style="min-width: 120px;">Product ID</th>
                                    <th style="min-width: 120px;">Product Code</th>
                                    <th style="min-width: 170px;">Product Name</th>
                                    <th style="min-width: 170px;">Product Details</th>
                                    <th style="min-width: 150px;">Quantity</th>
                                    <th style="min-width: 120px;">Delete</th>
                                </tr>
                            </thead>
                            <tbody id="productionupdatebody"></tbody>
                        </table>
                    </div>
                    <br>
                    <div class="text-right">
                        <button type="button" id="updateproduction" class="btn btn-primary" onclick="return false"><i class="fas fa-paper-plane"></i>&nbsp;&nbsp;Update Production</button>
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

            document.getElementById("updateproduction").disabled = true;

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
                $val = $(this).val();
                document.getElementById('addPRDtoUP').disabled = false;
                if ($val > 50) {
                    document.getElementById('addPRDtoUP').disabled = true;
                    swal("Unrealistic Production Amount", "Please check the production update quantity", "warning");
                } else {
                    document.getElementById('addPRDtoUP').disabled = false;
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
                                $("#sel_pmotor").val(jdata.prod_motor_capacity + " E/Motor");

                                document.getElementById('searchforlist').value = '';
                            });
                        });

                    })
                }
            });

            $("#addPRDtoUP").click(function() {

                var prd_qty = $("#prd_qty").val();

                if (prd_qty == "") {

                    $error_msg = "Kindly check whether 'Urgency Level' and 'Quantity' have been filled out";

                    swal("Check your inputs!", $error_msg, "warning");

                } else {

                    document.getElementById('sel_pcode').value = '';
                    document.getElementById('sel_pname').value = '';
                    document.getElementById('sel_pmotor').value = '';
                    document.getElementById('prd_qty').value = '';

                    var TableData = new Array();

                    $("#show_table").show();

                    $("#production_update_list tr").each(function(row, tr) {
                        TableData[row] = {
                            "prodID": $(tr).find('td:eq(0)').text(),
                            "prodQty": $(tr).find('td:eq(4)').text()
                        }
                    });

                    TableData.shift();

                    var productionUpdateList = JSON.stringify(TableData);

                    if (productionUpdateList.includes(prod_id)) {
                        $("#selectedproduct").hide();
                        swal("This Product is already included!", "Please remove the relevant row and re-enter the appropriate quantity", "warning");
                    } else {
                        $("#selectedproduct").hide();
                        $("#production_update_list tbody").append('<tr><td>' + prod_id + '</td><td>' + prod_code + '</td><td>' + prod_name + '</td><td>' + prod_capacity + '<br>' + prod_motor_capacity + '<br>' + prod_phase + '</td><td>' + prd_qty + '</td><td><button class="btn btn-danger btn-del" type="button"><i class="far fa-trash-alt"></i>&nbsp;&nbsp;Delete</button></td></tr>');
                        document.getElementById("updateproduction").disabled = false;
                    }
                }
            });

            $("#production_update_list tbody").on("click", ".btn-del", function() {

                var id = $(this).closest("tr").attr("id");

                $(this).closest("tr").remove();

            });

            $("#updateproduction").click(function() {

                var production_update_requester = $("#production_update_requester").val();

                var updation_date = $("#updation_date").val();

                logged_user = $("#logged_user").val();

                var TableData = new Array();

                if (production_update_requester == '') {
                    swal("Please select supervisor!", "Kindly select the supervisor in charge to continue", "warning");
                } else {

                    $("#production_update_list tr").each(function(row, tr) {
                        TableData[row] = {
                            "prodID": $(tr).find('td:eq(0)').text(),
                            "prodQty": $(tr).find('td:eq(4)').text()
                        }
                    });

                    TableData.shift();

                    var productionUpdateList = JSON.stringify(TableData);

                    $.post("../../route/req_notes/updateproduction.php", {
                        production_update_requester: production_update_requester,
                        updation_date: updation_date,
                        logged_user: logged_user,
                        productionUpdateList: productionUpdateList
                    }, function(data) {

                        if (data == "success") {
                            setTimeout(() => {
                                windows.location.href = "../production_history/production_history.php";
                            }, 2050);
                            swal({
                                type: 'success',
                                title: 'Machine Production Updated!',
                                text: 'Production has been logged and stock has been updated!',
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else {

                            var str = data;
                            var res = str.split('#');
                            res.shift();

                            var displaytext = '';

                            $.each(res, function(index, value) {

                                if (displaytext == '') {
                                    var newtxt = "for " + value;
                                    displaytext = displaytext.concat(newtxt);
                                } else {
                                    var newtxt = " and for " + value;
                                    displaytext = displaytext.concat(newtxt);
                                }
                            });

                            swal({
                                type: 'error',
                                title: 'Storage Limit Exceeded!',
                                text: displaytext,
                                showConfirmButton: true
                            }).then((result) => {
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    $("#new_reminder").modal("hide");
                                }
                            });
                        }
                    });
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