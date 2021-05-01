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
            <li class="breadcrumb-item"><a href="#">Raw Material Request Form</a></li>
        </ol>
    </div>

    <div class="content-wrapper">
        <div class="content">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h3 class="card-title" style="text-align: center;">Raw Materials Request Note&nbsp;&nbsp;<i class="fas fa-clipboard-list"></i></h3>
                </div>
                <div class="card-body">
                    <form id="rawmaterial_request_form" enctype="multipart/form-data">
                        <div class="row">
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
                                <input type="text" id="usersName" id="usersName" value="<?php echo ($_SESSION['userFirstName'] . "&nbsp;" . $_SESSION['userLastName']); ?>" class="form-control" disabled>
                            </div>
                            <div class="col-md-4" style="display: none;">
                                <label for="logged_user"></label>
                                <input type="text" name="logged_user" id="logged_user" value="<?php echo ($_SESSION['userId']); ?>" class="form-control" disabled>
                            </div>
                        </div>
                        <br>
                        <div class="row" style="margin-bottom: 30px;">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        <h6>Search raw materials:</h6>
                                    </label>
                                    <input type="text" name="rm_search" id="rm_search" class="form-control" placeholder="Enter any Raw Material Name..">
                                </div>
                                <div class="form-group">
                                    <div class="container" id="rawmat_scroll_section" style="border: 3px #eee solid; overflow: auto; white-space: nowrap; background-color: #eee; display: none;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="display: none;" id="selected_rm_sup">
                                    <div style="border: 5px solid #abe0d1; border-radius: 10px; padding: 25px;" id="p_sel_section">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <p>Supplier ID</p>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <input type="text" name="sel_sup_id" id="sel_sup_id" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <p>Requested Supplier</p>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <p>Raw Material Name</p>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <input type="text" name="sel_sup" id="sel_sup" class="form-control" disabled>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <input type="text" name="sel_rm" id="sel_rm" class="form-control" disabled>
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

                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <div class="input-group mb-3">
                                                            <input type="number" name="rm_qty" id="rm_qty" class="form-control">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">Kg(s)</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <select class="custom-select" id="urgency_level" name="urgency_level">
                                                    <option value="Low" selected="">Low (~20 days)</option>
                                                    <option value="Medium">Medium (~15 days)</option>
                                                    <option value="High">High (~5 Days)</option>
                                                    <option value="Critical">Critical (~2 Days)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p>Additional Notes</p>
                                                <textarea name="additionalnotes" id="additionalnotes" class="form-control" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <br>
                                        <div align="right">
                                            <button id="addRMtoREQ" class="btn btn-secondary" onclick="return false"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add to Request List</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <hr>
                        <div class="row" style="font-size:15px; margin-bottom:20px; display: none;" id="show_table">
                            <h5>Required Raw Materials</h5>
                            <table id="rm_req_list" class="table table-hover table-inverse table-responsive table-bordered" style="margin-top:10px; margin-left:10px; width:100%;">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th>Material ID</th>
                                        <th>Raw Material Name</th>
                                        <th>Requested Supplier ID</th>
                                        <th>Requested Supplier Name</th>
                                        <th>Quantity</th>
                                        <th>Urgency</th>
                                        <th>Additional Info</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody id="reqlist_body"></tbody>
                            </table>
                        </div>
                        <br>
                        <div class="text-right">
                            <button type="button" id="genrequest" class="btn btn-primary" onclick="return false"><i class="fas fa-paper-plane"></i>&nbsp;&nbsp;Create Supplies Requests</button>
                        </div>
                    </form>
                </div>
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

            var production_requester = '';
            var request_date = '';
            var logged_user = '';
            var rm_id = '';
            var rm_name = '';
            var rm_description = '';
            var sup_id = '';
            var sup_company_name = '';

            $("#rm_qty").keyup(function() {

                var qtyvalue = $(this).val();

                if (qtyvalue < 0) {
                    swal("Error!", "Negative values are not allowed!", "warning");
                    $("#rm_qty").val('');
                }
            });

            $("#rm_qty").change(function() {

                var qtyvalue = $(this).val();

                if (qtyvalue < 0) {
                    swal("Error!", "Negative values are not allowed!", "warning");
                    $("#rm_qty").val('');
                }
            });

            $("#genrequest").click(function() {

                production_requester = $("#production_requester").val();

                request_date = $("#request_date").val();

                logged_user = $("#logged_user").val();

                usersName = $("#usersName").val();

                var TableData = new Array();

                $("#rm_req_list tr").each(function(row, tr) {
                    TableData[row] = {
                        "rmID": $(tr).find('td:eq(0)').text(),
                        "rmName": $(tr).find('td:eq(1)').text(),
                        "rmSupID": $(tr).find('td:eq(2)').text(),
                        "rmSupplier": $(tr).find('td:eq(3)').text(),
                        "rmQty": $(tr).find('td:eq(4)').text(),
                        "rmUrgency": $(tr).find('td:eq(5)').text(),
                        "rmNotes": $(tr).find('td:eq(6)').text()
                    }
                });

                TableData.shift();

                var ProdReqList = JSON.stringify(TableData);

                $.post("../../route/req_notes/saveRequest.php", {
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
                        });
                    } else {
                        $error_msg = "Kindly check whether all the mandatory fields have been filled out";
                        swal("Check your inputs!", $error_msg, "warning");
                    }
                });
            });

            $("#rm_search").keyup(function() {

                var searchValue = $(this).val();

                $("#sel_sup_id").val('');
                $("#sel_sup").val('');
                $("#sel_rm").val('');

                $("#selected_rm_sup").hide();

                if (searchValue.length < 1) {
                    $("#rawmat_scroll_section").hide();
                } else {

                    $.get("../../route/req_notes/rmsupSearch.php", {
                        data: searchValue
                    }, function(data) {

                        $("#rawmat_scroll_section").show();
                        $("#rawmat_scroll_section").html(data);

                        $(".btn-info").click(function() {

                            var rmsupID = $(this).attr('id');

                            $("#rawmat_scroll_section").hide();

                            $.get("../../route/req_notes/fetchrmsupResult.php", {
                                id: rmsupID
                            }, function(data) {

                                var jdata = jQuery.parseJSON(data);

                                rm_sup_id = jdata.rm_sup_id;
                                sup_id = jdata.sup_id;
                                sup_company_name = jdata.sup_company_name;
                                rm_id = jdata.rm_id;
                                rm_name = jdata.rm_name;
                                rm_description = jdata.rm_description;

                                $("#selected_rm_sup").show();

                                $("#sel_sup_id").val(jdata.rm_sup_id);
                                $("#sel_sup").val(jdata.sup_company_name);
                                $("#sel_rm").val(jdata.rm_name);

                                document.getElementById('rm_search').value = '';
                            });
                        });
                    })
                }
            });

            $("#addRMtoREQ").click(function() {

                var rm_qty = $("#rm_qty").val();

                var urgency = $("#urgency_level").val();

                var rm_additionalnotes = $("#additionalnotes").val();

                if (rm_qty == "" || urgency == "") {

                    $error_msg = "Kindly check whether 'Urgency Level' and 'Quantity' have been filled out";

                    swal("Check your inputs!", $error_msg, "warning");

                } else {

                    var TableData = new Array();

                    $("#rm_req_list tr").each(function(row, tr) {
                        TableData[row] = {
                            "rmID": $(tr).find('td:eq(0)').text(),
                            "rmName": $(tr).find('td:eq(1)').text(),
                            "rmSupID": $(tr).find('td:eq(2)').text(),
                            "rmSupplier": $(tr).find('td:eq(3)').text(),
                            "rmQty": $(tr).find('td:eq(4)').text(),
                            "rmUrgency": $(tr).find('td:eq(5)').text(),
                            "rmNotes": $(tr).find('td:eq(6)').text()
                        }
                    });

                    TableData.shift();

                    var thistable = JSON.stringify(TableData);

                    if (thistable.includes(rm_id)) {
                        swal("This material is already included!", "Please remove the relevant row and re-enter the appropriate quantity", "warning");
                        document.getElementById('sel_sup').value = '';
                        document.getElementById('sel_rm').value = '';
                        document.getElementById('rm_qty').value = '';
                        document.getElementById('urgency_level').value = 'Low';
                        document.getElementById('additionalnotes').value = '';
                        $("#selected_rm_sup").hide();

                    } else {

                        $("#show_table").show();

                        $("#rm_req_list tbody").append('<tr><td>' + rm_id + '</td><td>' + rm_name + '</td><td>' + sup_id + '</td><td>' + sup_company_name + '</td><td>' + rm_qty + '&nbsp;load(s)</td><td>' + urgency + '</td><td>' + rm_additionalnotes + '</td><td><button class="btn btn-danger btn-del" type="button"><i class="far fa-trash-alt"></i></button></td></tr>');

                        document.getElementById('sel_sup').value = '';
                        document.getElementById('sel_rm').value = '';
                        document.getElementById('rm_qty').value = '';
                        document.getElementById('urgency_level').value = 'Low';
                        document.getElementById('additionalnotes').value = '';

                        $("#selected_rm_sup").hide();

                        document.getElementById("genrequest").disabled = false;
                    }

                }
            });

            $("#rm_req_list tbody").on("click", ".btn-del", function() {

                var id = $(this).closest("tr").attr("id");

                $(this).closest("tr").remove();

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