<?php
session_start();

include_once('../../inc/header.php');

if (isset($_SESSION['userId']) && $_SESSION['user_role'] == 1) {

    include_once('../../inc/sidenav.php');

?>
    <br>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active">Purchase Order List</li>
        </ol>
    </div>


    <div class="col-md-12">
        <div class="jumbotron">
            <h1 class="display-5" style="text-align: center;"><i class="fas fa-file-powerpoint"></i>&nbsp;&nbsp;Purchase Order List</h1>
            <hr class="my-4">
            <table class="table table-bordered datatable-basic table-hover datatable-button-html5-columns" id="purchaseordersList">
                <thead>
                    <tr>
                        <th>RequestID</th>
                        <th>Supplier</th>
                        <th>Request Date</th>
                        <th>Requester</th>
                        <th>Accepted Date</th>
                        <th>Creator</th>
                        <th>Purchase Orders</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include_once("../../functions/purchaseorders.php");
                    purchaseOrderList();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Set -->
    <div class="modal fade" id="po_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 style="text-align: center;" class="modal-title" id="exampleModalLabel">Purchase Orders</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="col-md-12">
                            <div id="load_po"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="gif_load" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div id="load_po">
                        <div style="text-align: center; margin-top: 25px;">
                            <h4>Your mail is being sent... Please wait!</h4>
                        </div>
                        <br>
                        <div style="text-align: center;" id="load_spinner">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="mail_sent_success" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div id="load_po">
                        <div style="text-align: center; margin-top: 25px;">
                            <h4>
                                <i class="far fa-check-circle fa-7x" style="color: #56CC9D;"></i>
                            </h4>
                            <br>
                            <h4>Your mail has been sent successfully!</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End Model -->

    <script>
        $(document).ready(function() {
            $("#purchaseordersList").DataTable({
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
                        title: "Udaya Industries [REPORT: CUSTOMER LIST]"
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fas fa-file-csv"></i>&nbsp;Export to CSV',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        },
                        title: "Udaya Industries [REPORT: CUSTOMER LIST]"
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i>&nbsp;Export to PDF',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        },
                        title: "Udaya Industries [REPORT: CUSTOMER LIST]"
                    }
                ]
            });

            $(".btn-selectpo").click(function() {

                $id = $(this).attr('id');

                $.get("../../route/purchase_order/getallPO.php", {
                    id: $id
                }, function(data) {
                    $("#load_po").html(data);

                    $(".btn-pdf").click(function() {

                        $path = $(this).attr('id');

                        window.open($path, "_blank");

                    });

                    $(".btn-sendmail").click(function() {

                        $id = $(this).attr('id');

                        $('#po_modal').modal('hide');

                        $("#load_spinner").load('../../../img/DualRingSpinner.html');

                        $('#gif_load').modal({
                            backdrop: 'static',
                            keyboard: false
                        });

                        $.post("mail_purchaseorder.php", {
                            id: $id
                        }, function(data) {
                            if (data == "sucess") {
                                $.when(
                                    $('#gif_load').modal('hide')
                                ).then(function() {
                                    $('#mail_sent_success').modal('show');
                                    setTimeout(function() {
                                        $('#mail_sent_success').modal('hide')
                                    }, 2000);
                                });
                            } else {
                                $error_msg = "Kindly check whether all the mandatory fields have been filled out";
                                swal("Check your inputs!", $error_msg, "warning");
                            }
                        });
                    });
                })
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
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