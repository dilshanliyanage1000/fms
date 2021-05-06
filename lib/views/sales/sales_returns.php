<?php
session_start();

include_once('../../inc/header.php');

if (isset($_SESSION['userId']) && ($_SESSION['user_role'] == 1 || $_SESSION['user_role'] == 2)) {

?>
    <br>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active">Sales Returns</li>
        </ol>
    </div>

    <div class="col-md-12">
        <div class="jumbotron">
            <h2 class="display-5" style="text-align: center;">Sales Returns</h2>
            <hr class="my-4">
            <br>
            <!-- attendance marking form -->
            <br><br>
            <form id="sales_form">
                <div class="row form-group">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Enter Invoice Code:</label>
                            <input type="text" class="form-control" maxlength="10" name="invoice_code" id="invoice_code" placeholder="Enter Returned Invoice Number">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <button type="button" id="return_sales" class="btn btn-primary btn-block" style="margin-top: 32px;"><i class="fas fa-paper-plane"></i>&nbsp;&nbsp;Return Sales</button>
                        </div>
                    </div>
                </div>
                <div id="load_content"></div>
            </form>
        </div>
    </div>

    <div class="col-md-12">
        <div class="jumbotron">
            <h1 class="display-5" style="text-align: center;"><i class="fas fa-user-friends fa-1x"></i>&nbsp;&nbsp;View all returned sales</h1>
            <hr class="my-4">
            <!-- our usual table -->
            <br>
            <table id="allreturns" class="table table-hover table-inverse table-responsive table-bordered" style="margin-top:10px;">
                <thead class="thead-inverse">
                    <tr>
                        <th style="min-width: 100px;">Invoice Code</th>
                        <th style="min-width: 100px;">Customer</th>
                        <th style="min-width: 100px;">Returned Products</th>
                    </tr>
                </thead>
                <tbody id="search_body_result">
                    <?php
                    include_once('../../functions/sales.php');
                    viewReturns();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            $("#allreturns").DataTable({
                dom: 'B<"clear">lfrtip',
                "order": [
                    [0, "desc"]
                ],
                buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="fas fa-copy"></i>&nbsp;Copy to Clipboard',
                        exportOptions: {
                            columns: [0, 1, 2]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i>&nbsp;Export to Excel',
                        exportOptions: {
                            columns: [0, 1, 2]
                        },
                        title: "Udaya Industries [REPORT: DELETED CUSTOMER LIST]"
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fas fa-file-csv"></i>&nbsp;Export to CSV',
                        exportOptions: {
                            columns: [0, 1, 2]
                        },
                        title: "Udaya Industries [REPORT: DELETED CUSTOMER LIST]"
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i>&nbsp;Export to PDF',
                        exportOptions: {
                            columns: [0, 1, 2]
                        },
                        title: "Udaya Industries [REPORT: DELETED CUSTOMER LIST]"
                    }
                ]
            });
            
            $("#return_sales").click(function() {

                var invoiceCode = $("#invoice_code").val();

                $.post("../../route/return_sales/return_sales.php", {
                    invoiceCode: invoiceCode
                }, function(data) {
                    if (data == "success") {
                        setTimeout(() => {
                            location.reload();
                        }, 2100);
                        swal({
                            type: 'success',
                            title: 'Sales have been returned!',
                            text: 'Sales have been returned and stocks have been updated',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    } else {

                        $error_msg = "Kindly check whether all the mandatory fields have been filled out";

                        swal("Check your inputs!", $error_msg, "warning");
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