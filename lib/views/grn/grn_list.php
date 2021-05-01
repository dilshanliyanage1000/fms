<?php
session_start();

include_once('../../inc/header.php');

if (isset($_SESSION['userId']) && $_SESSION['user_role'] == 1) {

    include_once('../../inc/sidenav.php');

?>
    <style>
        .cancel {
            background-color: #FFCE67;
        }
    </style>

    <br>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../dashboard/admin.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Goods Recieved Note</a></li>
            <li class="breadcrumb-item"><a href="#">GRN List</a></li>
        </ol>
    </div>

    <div class="col-md-12">
        <div class="jumbotron">
            <h1 class="display-5" style="text-align: center;">Goods Recieved Note List&nbsp;&nbsp;<i class="fas fa-paste"></i></h1>
            <hr class="my-4">
            <table id="grn_list" class="table table-hover table-inverse table-responsive table-bordered" style="margin-top:10px;">
                <thead class="thead-inverse">
                    <tr>
                        <th style="width: 70px;">GRN Ref/Code</th>
                        <th style="width: 70px;">Create Date</th>
                        <th>Material Supplier</th>
                        <th>Invoice Scan</th>
                        <th>Invoice Reference</th>
                        <th>Payment Status</th>
                        <th style="width: 70px;">Due Date</th>
                        <th style="width: 70px;">Paid Date</th>
                        <th>GRN Total Amount</th>
                        <th>Goods Note</th>
                        <th style="width: 70px;">Delete</th>
                    </tr>
                </thead>
                <tbody id="search_body_result">
                    <?php
                    include_once("../../functions/grn.php");
                    GRNlist();
                    ?>
                </tbody>
            </table>
        </div>
    </div>


    <script>
        $(document).ready(function() {

            $("#grn_list").DataTable({
                dom: 'B<"clear">lfrtip',
                "order": [
                    [0, "desc"]
                ],
                buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="fas fa-copy"></i>&nbsp;Copy to Clipboard',
                        exportOptions: {
                            columns: [0, 1, 3, 4, 5, 6, 7, 9]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i>&nbsp;Export to Excel',
                        exportOptions: {
                            columns: [0, 1, 3, 4, 5, 6, 7, 9]
                        },
                        title: "Udaya Industries [REPORT: GRN LIST]"
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fas fa-file-csv"></i>&nbsp;Export to CSV',
                        exportOptions: {
                            columns: [0, 1, 3, 4, 5, 6, 7, 9]
                        },
                        title: "Udaya Industries [REPORT: GRN LIST]"
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i>&nbsp;Export to PDF',
                        exportOptions: {
                            columns: [0, 1, 3, 4, 5, 6, 7, 9]
                        },
                        title: "Udaya Industries [REPORT: GRN LIST]"
                    }
                ]
            });

            $(".btn-delgrn").click(function() {

                var grnID = $(this).attr('id');

                swal({
                        title: "Delete Invoice : " + grnID + "?",
                        text: "You will not be able to recover this data!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Delete",
                        confirmButtonColor: "#000000",
                        cancelButtonText: "Cancel",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            $.get("../../route/grn/deleteGRN.php", {
                                id: grnID
                            }, function(data) {
                                setTimeout(() => {
                                    location.reload();
                                }, 2550);
                                swal({
                                    type: 'success',
                                    title: 'Goods Receieved Note deleted!',
                                    text: 'GRN Details have been removed!',
                                    showConfirmButton: false,
                                    timer: 2500
                                });
                            });
                        } else {
                            swal({
                                type: 'warning',
                                title: 'Deletion Cancelled!',
                                text: 'GRN details remain!',
                                showConfirmButton: false,
                                timer: 2500
                            });
                        }
                    });
            });


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