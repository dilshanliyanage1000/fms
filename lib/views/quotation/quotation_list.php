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
            <li class="breadcrumb-item"><a href="#">Quotation</a></li>
            <li class="breadcrumb-item"><a href="#">Quotations List</a></li>
        </ol>
    </div>


    <div class="col-md-12">
        <div class="jumbotron">
            <h1 class="display-5" style="text-align: center;">Quotations List&nbsp;&nbsp;<i class="fas fa-paste"></i></h1>
            <hr class="my-4">
            <table class="table datatable-basic table-hover datatable-button-html5-columns" id="quotation_list">
                <thead>
                    <tr>
                        <th>Ref/No</th>
                        <th style="min-width: 115px;">Date</th>
                        <th>Quotation</th>
                        <th>Customer Details</th>
                        <th>Quotation Products</th>
                        <th>Status</th>
                        <th>Action</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include_once("../../functions/quotation.php");
                    QuotationList();
                    ?>
                </tbody>
            </table>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $("#quotation_list").DataTable({
                dom: 'B<"clear">lfrtip',
                "order": [[0, "desc"]],
                buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="fas fa-copy"></i>&nbsp;Copy to Clipboard',
                        exportOptions: {
                            columns: [0, 1, 3, 4, 5]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i>&nbsp;Export to Excel',
                        exportOptions: {
                            columns: [0, 1, 3, 4, 5]
                        },
                        title: "Udaya Industries [REPORT: QUOTATION LIST]"
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fas fa-file-csv"></i>&nbsp;Export to CSV',
                        exportOptions: {
                            columns: [0, 1, 3, 4, 5]
                        },
                        title: "Udaya Industries [REPORT: QUOTATION LIST]"
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i>&nbsp;Export to PDF',
                        exportOptions: {
                            columns: [0, 1, 3, 4, 5]
                        },
                        title: "Udaya Industries [REPORT: QUOTATION LIST]"
                    }
                ]
            });

            $('#quotation_list tbody').on('click', '.btn-delete-quotation', function() {

                $id = $(this).attr('id');

                swal({
                        title: "Are you sure?",
                        text: "Your can still recover the quotation!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-warning",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            $.get("../route/quotation/deleteQuotation.php", {
                                id: $id
                            }, function(data) {
                                setTimeout(() => {
                                    location.reload();
                                }, 2100);
                                swal({
                                    type: 'success',
                                    title: 'Quotation deleted!',
                                    text: 'Quotation details succesfully deleted!',
                                    showConfirmButton: false,
                                    timer: 2000
                                }).then((result) => {
                                    if (result.dismiss === Swal.DismissReason.timer) {
                                        $("#new_reminder").modal("hide");
                                    }
                                });
                            });
                        } else {
                            swal({
                                type: 'warning',
                                title: 'Cancelled!',
                                text: 'Quotation details remain!',
                                showConfirmButton: false,
                                timer: 2000
                            }).then((result) => {
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    $("#new_reminder").modal("hide");
                                }
                            });
                        }
                    });

            });

            $('#quotation_list tbody').on('click', '.btn-confirm-quotation', function() {

                $id = $(this).attr('id');

                swal({
                        title: "Confirm Quotation?",
                        text: "Your can still change status of the quotation!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "Confirm!",
                        closeOnConfirm: false
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            $.get("../route/quotation/confirmQuotation.php", {
                                id: $id
                            }, function(data) {
                                setTimeout(() => {
                                    location.reload();
                                }, 2100);
                                swal({
                                    type: 'success',
                                    title: 'Quotation deleted!',
                                    text: 'Quotation details succesfully deleted!',
                                    showConfirmButton: false,
                                    timer: 2000
                                }).then((result) => {
                                    if (result.dismiss === Swal.DismissReason.timer) {
                                        $("#new_reminder").modal("hide");
                                    }
                                });
                            });
                        } else {
                            swal({
                                type: 'warning',
                                title: 'Cancelled!',
                                text: 'Quotation details remain on Pending!',
                                showConfirmButton: false,
                                timer: 2000
                            }).then((result) => {
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    $("#new_reminder").modal("hide");
                                }
                            });
                        }
                    });

            });

            $('#quotation_list tbody').on('click', '.btn-pending-quotation', function() {

                $id = $(this).attr('id');

                swal({
                        title: "Change to 'Pending' Quotation?",
                        text: "Your can still change status of the quotation!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Confirm!",
                        closeOnConfirm: false
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            $.get("../route/quotation/confirmQuotation.php", {
                                id: $id
                            }, function(data) {
                                setTimeout(() => {
                                    location.reload();
                                }, 2100);
                                swal({
                                    type: 'success',
                                    title: 'Quotation deleted!',
                                    text: 'Quotation details succesfully deleted!',
                                    showConfirmButton: false,
                                    timer: 2000
                                }).then((result) => {
                                    if (result.dismiss === Swal.DismissReason.timer) {
                                        $("#new_reminder").modal("hide");
                                    }
                                });
                            });
                        } else {
                            swal({
                                type: 'warning',
                                title: 'Cancelled!',
                                text: 'Quotation details remain!',
                                showConfirmButton: false,
                                timer: 2000
                            }).then((result) => {
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    $("#new_reminder").modal("hide");
                                }
                            });
                        }
                    });
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