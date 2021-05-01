<?php
session_start();

include_once('../../inc/header.php');

if (isset($_SESSION['userId']) && ($_SESSION['user_role'] == 1 || $_SESSION['user_role'] == 3)) {

    include_once('../../inc/sidenav.php');

?>

    <style>
        #zoom {
            transition: transform .2s;
        }

        #zoom:hover {
            transform: scale(1.5);
        }
    </style>

    <br>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active">Production History</li>
        </ol>
    </div>

    <div class="col-md-12">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#production_history">
                    <h4>Production History</h4>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#part_production_history">
                    <h4>Part Production History</h4>
                </a>
            </li>
        </ul>
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade show active" id="production_history">
                <br><br>
                <h1 class="display-5" style="text-align: center;"><i class="fas fa-people-carry fa-1x"></i>&nbsp;&nbsp;Production Update History</h1>
                <hr class="my-4">
                <table id="production_history_tbl" class="table table-hover table-inverse table-responsive table-bordered" style="margin-top:10px; width:100%;">
                    <thead class="thead-inverse">
                        <tr>
                            <th style="min-width: 140px;">Date & Time</th>
                            <th style="min-width: 140px;">Creator</th>
                            <th style="min-width: 140px">Updater</th>
                            <th style="min-width: 420px">Product Details</th>
                            <th style="min-width: 90px;">Pre-Qty</th>
                            <th style="min-width: 90px;">Update-Qty</th>
                            <th style="min-width: 90px;">Post-Qty</th>
                        </tr>
                    </thead>
                    <tbody id="search_body_result">
                        <?php
                        include_once("../../functions/production_history.php");
                        getProductionHistory();
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="part_production_history">
                <br><br>
                <h1 class="display-5" style="text-align: center;"><i class="fas fa-people-carry fa-1x"></i>&nbsp;&nbsp;Part Production Update History</h1>
                <hr class="my-4">
                <table id="part_production_history_tbl" class="table table-hover table-inverse table-responsive table-bordered" style="margin-top:10px; width:100%;">
                    <thead class="thead-inverse">
                        <tr>
                            <th style="min-width: 140px;">Date & Time</th>
                            <th style="min-width: 140px;">Creator</th>
                            <th style="min-width: 140px">Updater</th>
                            <th style="min-width: 420px">Part Details</th>
                            <th style="min-width: 90px;">Pre-Qty</th>
                            <th style="min-width: 90px;">Update-Qty</th>
                            <th style="min-width: 90px;">Post-Qty</th>
                        </tr>
                    </thead>
                    <tbody id="search_body_result">
                        <?php
                        include_once("../../functions/production_history.php");
                        getPartProductionHistory();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {

            $(".sidebar-btn").click(function() {
                $(".wrapper").toggleClass("hideSide");
            });

            $("#production_history_tbl").DataTable({
                "order": [
                    [0, "desc"]
                ],
                dom: 'B<"clear">lfrtip',
                buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="fas fa-copy"></i>&nbsp;Copy to Clipboard',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i>&nbsp;Export to Excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        },
                        title: "Udaya Industries [REPORT: PRODUCTION HISTORY]"
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fas fa-file-csv"></i>&nbsp;Export to CSV',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        },
                        title: "Udaya Industries [REPORT: PRODUCTION HISTORY]"
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i>&nbsp;Export to PDF',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        },
                        title: "Udaya Industries [REPORT: PRODUCTION HISTORY]"
                    }
                ]
            });

            $("#part_production_history_tbl").DataTable({
                "order": [
                    [0, "desc"]
                ],
                dom: 'B<"clear">lfrtip',
                buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="fas fa-copy"></i>&nbsp;Copy to Clipboard',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i>&nbsp;Export to Excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        },
                        title: "Udaya Industries [REPORT: PART PRODUCTION HISTORY]"
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fas fa-file-csv"></i>&nbsp;Export to CSV',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        },
                        title: "Udaya Industries [REPORT: PART PRODUCTION HISTORY]"
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i>&nbsp;Export to PDF',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        },
                        title: "Udaya Industries [REPORT: PART PRODUCTION HISTORY]"
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