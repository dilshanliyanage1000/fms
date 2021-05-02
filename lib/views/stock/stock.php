<?php
session_start();

include_once('../../inc/header.php');

if (isset($_SESSION['userId']) && ($_SESSION['user_role'] == 1 || $_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 3 || $_SESSION['user_role'] == 4)) {

?>
    <br>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Stock</a></li>
            <li class="breadcrumb-item active">Stock Details</li>
        </ol>
    </div>

    <br>

    <div class="col-md-12">
        <div class="jumbotron">
            <h1 class="display-5" style="text-align: center;"><i class="fas fa-file-medical-alt"></i>&nbsp;&nbsp;Stock Information</h1>
            <hr class="my-4">
            <br>
            <div class="col-md-12">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#rawmaterialstock">
                            <h4>Raw Material Stock</h4>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#partstock">
                            <h4>Parts Stock</h4>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#productstock">
                            <h4>Products Stock</h4>
                        </a>
                    </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade show active" id="rawmaterialstock">
                        <br><br>
                        <table id="rawmatStock" class="table table-hover table-inverse table-responsive table-bordered" style="margin-top:10px; width:100%;">
                            <thead class="thead-inverse">
                                <tr>
                                    <th style="min-width: 80px;">Code</th>
                                    <th style="min-width: 200px;">Raw Material Name</th>
                                    <th style="min-width: 480px">Stock Information</th>
                                    <th style="min-width: 45px">Levels</th>
                                    <th style="min-width: 90px;">Availability</th>
                                    <th style="min-width: 90px;">Status</th>
                                </tr>
                            </thead>
                            <tbody id="search_body_result">
                                <?php
                                include_once("../../functions/stock.php");
                                RMStockList();
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="partstock">
                        <br><br>
                        <table id="partStock" class="table table-hover table-inverse table-responsive table-bordered" style="margin-top:10px; width:100%;">
                            <thead class="thead-inverse">
                                <tr>
                                    <th style="min-width: 80px;">Code</th>
                                    <th style="min-width: 300px;">Part Details</th>
                                    <th style="min-width: 430px">Stock Information</th>
                                    <th style="min-width: 45px">Levels</th>
                                    <th style="min-width: 90px;">Availability</th>
                                    <th style="min-width: 90px;">Status</th>
                                </tr>
                            </thead>
                            <tbody id="search_body_result">
                                <?php
                                include_once("../../functions/stock.php");
                                PartsStockList();
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="productstock">
                        <br><br>
                        <table id="prodStock" class="table table-hover table-inverse table-responsive table-bordered" style="margin-top:10px; width:100%;">
                            <thead class="thead-inverse">
                                <tr>
                                    <th style="min-width: 80px;">Code</th>
                                    <th style="min-width: 280px;">Product Details</th>
                                    <th style="min-width: 400px">Stock Information</th>
                                    <th style="min-width: 45px">Levels</th>
                                    <th style="min-width: 90px;">Availability</th>
                                    <th style="min-width: 90px;">Status</th>
                                </tr>
                            </thead>
                            <tbody id="search_body_result">
                                <?php
                                include_once("../../functions/stock.php");
                                MachineStockList();
                                ?>
                            </tbody>
                        </table>
                    </div>
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
        $(document).ready(function() {

            $("#rawmatStock").DataTable({
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
                        title: "Udaya Industries [REPORT: PRODUCT LIST]"
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fas fa-file-csv"></i>&nbsp;Export to CSV',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7, 8]
                        },
                        title: "Udaya Industries [REPORT: PRODUCT LIST]"
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i>&nbsp;Export to PDF',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7, 8]
                        },
                        title: "Udaya Industries [REPORT: PRODUCT LIST]"
                    }
                ]
            });

            $("#partStock").DataTable({
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
                        title: "Udaya Industries [REPORT: PRODUCT LIST]"
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fas fa-file-csv"></i>&nbsp;Export to CSV',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7, 8]
                        },
                        title: "Udaya Industries [REPORT: PRODUCT LIST]"
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i>&nbsp;Export to PDF',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7, 8]
                        },
                        title: "Udaya Industries [REPORT: PRODUCT LIST]"
                    }
                ]
            });

            $("#prodStock").DataTable({
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
                        title: "Udaya Industries [REPORT: PRODUCT LIST]"
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fas fa-file-csv"></i>&nbsp;Export to CSV',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7, 8]
                        },
                        title: "Udaya Industries [REPORT: PRODUCT LIST]"
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i>&nbsp;Export to PDF',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7, 8]
                        },
                        title: "Udaya Industries [REPORT: PRODUCT LIST]"
                    }
                ]
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