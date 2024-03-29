<?php
session_start();

include_once('../../inc/header.php');

if (isset($_SESSION['userId']) && ($_SESSION['user_role'] == 1 || $_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 3 || $_SESSION['user_role'] == 4)) {

?>
    <style>
        #img_1 {
            transition: transform .2s;
        }

        #img_1:hover {
            transform: scale(1.5);
        }

        #img_2 {
            transition: transform .2s;
        }

        #img_2:hover {
            transform: scale(1.5);
        }
    </style>

    <br>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Product Diagnosis</a></li>
            <li class="breadcrumb-item active">Product Diagnosis List</li>
        </ol>
    </div>

    <div class="col-md-12">
        <div class="jumbotron">
            <h1 class="display-5" style="text-align: center;">Product Diagnosis List&nbsp;&nbsp;<i class="fas fa-laptop-code"></i></h1>
            <hr class="my-4">
            <table id="diagnosis_list" class="table table-hover table-inverse table-responsive table-bordered" style="margin-top:10px;">
                <thead>
                    <tr>
                        <th>Ref/No</th>
                        <th>Uploaded</th>
                        <th>Customer Name</th>
                        <th>Defective Product</th>
                        <th style="width: 100px;">Image #1</th>
                        <th style="width: 100px;">Image #2</th>
                        <th style="width: 150px;">Finalized</th>
                        <th style="width: 100px;">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include_once("../../functions/productDefectDiagnosis.php");
                    DiagnosisList();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".sidebar-btn").click(function() {
                $(".wrapper").toggleClass("hideSide");
            });

            $("#diagnosis_list").DataTable({
                dom: 'B<"clear">lfrtip',
                buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="fas fa-copy"></i>&nbsp;Copy to Clipboard',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i>&nbsp;Export to Excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        },
                        title: "Udaya Industries [REPORT: DEFECT DIAGNOSIS LIST]"
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fas fa-file-csv"></i>&nbsp;Export to CSV',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        },
                        title: "Udaya Industries [REPORT: DEFECT DIAGNOSIS LIST]"
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i>&nbsp;Export to PDF',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        },
                        title: "Udaya Industries [REPORT: DEFECT DIAGNOSIS LIST]"
                    }
                ]
            });



            $("#img_1").click(function() {
                $source = $(this).attr('src');
                window.open($source, '_blank');
            });

            $("#img_2").click(function() {
                $source = $(this).attr('src');
                window.open($source, '_blank');
            });

            $('#diagnosis_list tbody').on('click', '.btn-delete', function() {

                this.click;
                $trID = $(this).attr('id');

                swal({
                        title: "Delete Customer : " + $trID + "?",
                        text: "You will delete all of " + $trID + "'s data!",
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
                            $.get("../../route/productDefectDiagnosis/deleteDiagnosis.php", {
                                id: $trID
                            }, function(data) {
                                setTimeout(() => {
                                    location.reload();
                                }, 2050);
                                swal({
                                    type: 'success',
                                    title: 'Defect Diagnosis Report Deleted!',
                                    text: 'All relevant details have been deleted!',
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            });
                        } else {
                            swal({
                                type: 'warning',
                                title: 'Cancelled!',
                                text: 'Defect Diagnosis details remain!',
                                showConfirmButton: false,
                                timer: 2000
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