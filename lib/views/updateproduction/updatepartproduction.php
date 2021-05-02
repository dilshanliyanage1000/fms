<?php
session_start();

include_once('../../inc/header.php');

if (isset($_SESSION['userId']) && ($_SESSION['user_role'] == 1 || $_SESSION['user_role'] == 3 || $_SESSION['user_role'] == 4)) {

?>
    <br>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Update Part Production</a></li>
        </ol>
    </div>

    <div class="col-md-12">
        <div class="jumbotron">
            <h2 class="display-5" style="text-align: center;">Update Part Production&nbsp;&nbsp;<i class="fas fa-people-carry"></i></h2>
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
                    <label>
                        <h6>Search for parts that needs updation:</h6>
                    </label>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="searchforlist" id="searchforlist" class="form-control" placeholder="Enter any part keyword..">
                            </div>
                            <div class="form-group" style="width: 100%;">
                                <div class="container" id="part_scroll_section" style="width: 100%; border: 3px #eee solid; overflow: auto; white-space: nowrap; background-color: #eee; display: none;">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div style="display: none;" id="selectedpart">
                                <div style="border: 5px solid #abe0d1; border-radius: 10px; padding: 25px;" id="p_sel_section">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <p>Part Code</p>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <p>Part Name</p>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <input type="text" name="sel_part_code" id="sel_part_code" class="form-control" disabled>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <input type="text" name="sel_part_name" id="sel_part_name" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <p>Approx. Weight</p>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <p>Quantity</p>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <input type="text" name="sel_part_weight" id="sel_part_weight" class="form-control" disabled>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <input type="number" name="part_qty" id="part_qty" max='50' min='1' placeholder="Enter Quantity" class="form-control">
                                        </div>
                                    </div>
                                    <br>
                                    <div align="right">
                                        <button id="addPRTtoUPP" class="btn btn-secondary" onclick="return false"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add to Production Update!</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row" style="margin-bottom:20px; display: none; text-align: center;" id="show_table">
                        <table id="part_production_update_list" class="table table-hover table-inverse table-responsive table-bordered" style="margin-top:10px; margin-left:10px; width:100%; font-size: 17px;">
                            <thead class="thead-inverse">
                                <tr>
                                    <th style="min-width: 150px;">Part ID</th>
                                    <th style="min-width: 150px;">Part Code</th>
                                    <th style="min-width: 200px;">Part Name</th>
                                    <th style="min-width: 150px;">Quantity</th>
                                    <th style="min-width: 150px;">Delete</th>
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

            var part_id = '';
            var part_name = '';
            var part_code = '';

            var requester = '';
            var reqDate = '';
            var logged_user = '';

            $("#part_qty").keyup(function() {
                $val = $(this).val();
                document.getElementById('addPRTtoUPP').disabled = false;
                if ($val < 0) {
                    document.getElementById('addPRTtoUPP').disabled = true;
                    swal("Negative Values Not Allowed", "Negative quantities are not allowed", "warning");
                    $("#part_qty").val("");
                } else if ($val > 50) {
                    document.getElementById('addPRTtoUPP').disabled = true;
                    swal("Unrealistic Production Amount", "Please check the production update quantity", "warning");
                    $("#part_qty").val("");
                } else {
                    document.getElementById('addPRTtoUPP').disabled = false;
                }
            });

            $("#part_qty").change(function() {
                $val = $(this).val();
                document.getElementById('addPRTtoUPP').disabled = false;
                if ($val < 0) {
                    document.getElementById('addPRTtoUPP').disabled = true;
                    swal("Negative Values Not Allowed", "Negative quantities are not allowed", "warning");
                    $("#part_qty").val("");
                } else if ($val > 50) {
                    document.getElementById('addPRTtoUPP').disabled = true;
                    swal("Unrealistic Production Amount", "Please check the production update quantity", "warning");
                    $("#part_qty").val("");
                } else {
                    document.getElementById('addPRTtoUPP').disabled = false;
                }
            });

            $("#searchforlist").keyup(function() {

                var searchValue = $(this).val();

                if (searchValue.length < 1) {
                    $("#part_scroll_section").hide();
                } else {

                    $.get("../../route/req_notes/partSearch.php", {
                        data: searchValue
                    }, function(data) {

                        $("#part_scroll_section").show();
                        $("#part_scroll_section").html(data);

                        $(".btn-info").click(function() {

                            var pid = $(this).attr('id');

                            $("#part_scroll_section").hide();

                            $.get("../../route/req_notes/fetchPartResult.php", {
                                id: pid
                            }, function(data) {

                                var jdata = jQuery.parseJSON(data);

                                part_id = jdata.part_id;
                                part_name = jdata.part_name;
                                part_code = jdata.part_code;

                                $("#selectedpart").show();

                                $("#sel_part_code").val(jdata.part_code);
                                $("#sel_part_name").val(jdata.part_name);
                                $("#sel_part_weight").val(jdata.part_weight + " " + jdata.part_w_unit);

                                document.getElementById('searchforlist').value = '';
                            });
                        });

                    })
                }
            });

            $("#addPRTtoUPP").click(function() {

                var ptqty = $("#part_qty").val();

                if (ptqty == "") {

                    $error_msg = "Kindly check whether 'Urgency Level' and 'Quantity' have been filled out";

                    swal("Check your inputs!", $error_msg, "warning");

                } else {

                    document.getElementById('sel_part_code').value = '';
                    document.getElementById('sel_part_name').value = '';
                    document.getElementById('sel_part_weight').value = '';
                    document.getElementById('part_qty').value = '';

                    var TableData = new Array();

                    $("#show_table").show();

                    $("#part_production_update_list tr").each(function(row, tr) {
                        TableData[row] = {
                            "partID": $(tr).find('td:eq(0)').text(),
                            "partQty": $(tr).find('td:eq(3)').text()
                        }
                    });

                    TableData.shift();

                    var productionUpdateList = JSON.stringify(TableData);

                    if (productionUpdateList.includes(part_id)) {
                        swal("This part is already included!", "Please remove the relevant row and re-enter the appropriate quantity", "warning");
                        $("#selectedpart").hide();
                    } else {
                        $("#part_production_update_list tbody").append('<tr><td>' + part_id + '</td><td>' + part_code + '</td><td>' + part_name + '</td><td>' + ptqty + '</td><td><button class="btn btn-danger btn-del" type="button"><i class="far fa-trash-alt"></i>&nbsp;&nbsp;Delete</button></td></tr>');
                        $("#selectedpart").hide();
                        document.getElementById("updateproduction").disabled = false;
                    }
                }
            });

            $("#part_production_update_list tbody").on("click", ".btn-del", function() {

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
                    $("#part_production_update_list tr").each(function(row, tr) {
                        TableData[row] = {
                            "partID": $(tr).find('td:eq(0)').text(),
                            "partQty": $(tr).find('td:eq(3)').text()
                        }
                    });

                    TableData.shift();

                    var productionUpdateList = JSON.stringify(TableData);

                    var formData = new FormData(form);

                    var form = $('#production_request_form')[0];

                    $.post("../../route/req_notes/updatePartProduction.php", {
                        production_update_requester: production_update_requester,
                        updation_date: updation_date,
                        logged_user: logged_user,
                        productionUpdateList: productionUpdateList
                    }, function(data) {

                        if (data == "success") {
                            setTimeout(() => {
                                windows.location.href = "../production_history/production_history.php";
                            }, 2550);
                            swal({
                                type: 'success',
                                title: 'Part Production Updated!',
                                text: 'Production has been logged and stock has been updated!',
                                showConfirmButton: false,
                                timer: 2500
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