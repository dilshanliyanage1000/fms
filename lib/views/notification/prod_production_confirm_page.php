<?php
session_start();

include_once('../../inc/header.php');

if (isset($_SESSION['userId']) && $_SESSION['user_role'] == 1) {

    include_once('../../inc/sidenav.php');

    $requestID = $_GET['requestID'];

?>
    <br>

    <div class="content-wrapper">
        <div class="content">
            <div class="card">
                <div class="card-body">
                    <form id="rawmaterial_request_form" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10" style="text-align: left;">
                                <h5>The products as per the following request includes,</h5>
                                <br>
                                <table id="requested_products" class="table table-hover table-inverse table-responsive table-bordered" style="margin-top:10px; font-size: 15px;">
                                </table>
                                <br>
                                <button type="button" class="btn btn-primary" id="gen_list" name="gen_list"><i class="fas fa-arrow-down"></i>&nbsp;&nbsp;Proceed</button>
                                <br>
                                <div id="main_content" style="display: none;">
                                    <h5>Required Parts with their respective quantities,</h5>
                                    <br>
                                    <div class="col-md-12">
                                        <div class="row" id="expand_content">
                                        </div>
                                    </div>
                                    <br><br><br>
                                    <div style="margin-bottom: 30px;" align="center">
                                        <h6 id="reason" style="color: red; display: none;"><i class="fas fa-exclamation-circle"></i>&nbsp;&nbsp;Due to insufficient stocks, please consider placing a <a style="color: red;" href="../request_notes/part_production_request.php">parts production request</a></h6>
                                        <br>
                                        <button type="button" class="btn btn-success" id="confirm_request" name="confirm_request"><i class="fas fa-check-double"></i>&nbsp;&nbsp;Confirm Production</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                        <br>
                        <br>
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

            var requestID = '<?php echo ($_GET['requestID']) ?>';

            $.get("../../route/miscellaneous/getReqDetails.php", {
                id: requestID
            }, function(data) {
                $("#requested_products").html(data);
            });

            $("#gen_list").click(function() {

                var TableData = new Array();

                $("#requested_products tr").each(function(row, tr) {
                    TableData[row] = {
                        "prodID": $(tr).find('td:eq(1)').text(),
                        "prodCode": $(tr).find('td:eq(2)').text(),
                        "prodName": $(tr).find('td:eq(3)').text(),
                        "prodQty": $(tr).find('td:eq(4)').text()
                    }
                });

                TableData.shift();

                var prodReqList = JSON.stringify(TableData);

                $.get("../../route/miscellaneous/getFinalProductionReq.php", {
                    prodReqList: prodReqList
                }, function(data) {

                    var jdata = jQuery.parseJSON(data);

                    $("#gen_list").hide();
                    $("#main_content").show();
                    $("#expand_content").html(jdata[0]);

                    var partList = jdata[1];
                    var partListArr = partList.split('/');
                    partListArr.splice(-1, 1)

                    var FinalError = [];

                    $.each(partListArr, function(index, value) {

                        var elements = value.split('_');

                        var checkError = jQuery.inArray("error", elements);

                        FinalError.push(checkError);
                    });

                    var errorValidate = '';

                    $.each(FinalError, function(index, value) {
                        if (value !== -1) {
                            errorValidate = 'Errors exist';
                        }
                    });

                    if (errorValidate !== '') {
                        document.getElementById('confirm_request').disabled = true;
                        $('#reason').show();
                    } else {
                        document.getElementById('confirm_request').disabled = false;

                        $("#confirm_request").click(function() {

                            var TableData = new Array();

                            $("#requested_products tr").each(function(row, tr) {
                                TableData[row] = {
                                    "prodID": $(tr).find('td:eq(1)').text(),
                                    "prodCode": $(tr).find('td:eq(2)').text(),
                                    "prodName": $(tr).find('td:eq(3)').text(),
                                    "prodQty": $(tr).find('td:eq(4)').text()
                                }
                            });

                            TableData.shift();

                            var ProdListTbl = JSON.stringify(TableData);

                            var TableData_2 = new Array();

                            $("#final_result tr").each(function(row, tr) {
                                TableData_2[row] = {
                                    "partID": $(tr).find('td:eq(0)').text(),
                                    "partCode": $(tr).find('td:eq(1)').text(),
                                    "partName": $(tr).find('td:eq(2)').text(),
                                    "partQty": $(tr).find('td:eq(4)').text()
                                }
                            });

                            var FinalPartReqList = JSON.stringify(TableData_2);

                            $.when(
                                window.open("prod_confirm_pdf.php?requestID=" + requestID + "&FinalPartReqList=" + FinalPartReqList + "&ProdListTbl=" + ProdListTbl + "&/", "_blank")
                            ).then(function() {
                                setTimeout(() => {
                                    window.location.href = '../request_notes/allrequests.php';
                                }, 2600);
                                swal({
                                    type: 'success',
                                    title: 'Request Confirmed!',
                                    text: 'Part Production Request is confirmed and proceeded for production!',
                                    showConfirmButton: false,
                                    timer: 2500
                                });
                            });
                        });
                    }
                });
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