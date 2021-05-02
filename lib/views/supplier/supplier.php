<?php
session_start();

include_once('../../inc/header.php');

if (isset($_SESSION['userId']) && ($_SESSION['user_role'] == 1 || $_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 4)) {

?>
    <style>
        .cancel {
            background-color: #FFCE67;
        }
    </style>

    <br>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Supplier</a></li>
            <li class="breadcrumb-item active">Register Supplier</li>
        </ol>
    </div>

    <div class="col-md-12">
        <div class="jumbotron">
            <h1 class="display-5" style="text-align: center;"><i class="fas fa-dolly-flatbed fa-1x"></i>&nbsp;&nbsp;Register Supplier</h1>
            <hr class="my-4">

            <!-- supplier registration form -->
            <form id="saveSup">
                <div class="row">
                    <div class="col-md-7">
                        <h3 class="text-muted">Supplier Details</h3>
                        <br>
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="name">Supplier Company Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Ex: John">
                            </div>
                            <div class="col-md-6">
                                <label for="email">Company Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Ex: johnappleseed@gmail.com">
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="phoneone">Phone Number (Primary)</label>
                                <input type="number" name="phoneone" id="phoneone" class="form-control" placeholder="Ex: 771586351" required>
                            </div>
                            <div class="col-md-6">
                                <label for="phonetwo">Phone Number (Optional)</label>
                                <input type="number" name="phonetwo" id="phonetwo" class="form-control" placeholder="Ex: 771547896" required>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="fax">Fax Number</label>
                                <input type="number" name="fax" id="fax" class="form-control" placeholder="Ex: 0779563256" maxlength="10">
                            </div>
                            <div class="col-md-6">
                                <label for="address">Address</label>
                                <input type="text" name="address" id="address" class="form-control" placeholder="Ex: 15, Kings Road, New York NY">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div style="border-left:1px solid #dbdbdb; height:400px"></div>
                    </div>
                    <div class="col-md-4">
                        <h3 class="text-muted">Supplier Information</h3>
                        <br />
                        <div class="form-group">
                            <label for="supplier_rm">Supplies / Raw Material : </label>
                            <select multiple="" class="form-control" id="supplier_rm" name="supplier_rm[]" placeholder="Click to display all raw materials">
                                <?php
                                include_once("../../functions/rawmaterial.php");
                                getRM();
                                ?>
                            </select>
                        </div>
                        <br /><br /><br /><br /><br /><br /><br />
                        <div class="form-group" align="right">
                            <button class="btn btn-warning" type="reset" style="margin:5px;"><i class="fas fa-minus-circle"></i>&nbsp;&nbsp;Clear</button>
                            <button id="btnSave" class="btn btn-success" onclick="return false" style="margin:5px;"><i class="fas fa-save"></i>&nbsp;&nbsp;Save details</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-12">
        <div class="jumbotron">
            <h1 class="display-5" style="text-align: center;"><i class="fas fa-user-friends fa-1x"></i>&nbsp;&nbsp;Supplier Information</h1>
            <hr class="my-4">
            <!-- our usual table -->
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#supplier_list">All Suppliers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#deleted_supplier_list">Deleted Suppliers</a>
                </li>
            </ul>
            <br>
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade show active" id="supplier_list">
                    <table id="allSuppliers" class="table table-hover table-inverse table-responsive table-bordered" style="margin-top:10px;">
                        <thead class="thead-inverse">
                            <tr>
                                <th style="width: 90px;">Supplier ID </th>
                                <th style="width: 150px;">Company Name </th>
                                <th>Email </th>
                                <th style="width: 100px;">Contact No </th>
                                <th>Address </th>
                                <th style="width: 200px;">Supplied Raw Material</th>
                                <th style="width: 40px;">Status </th>
                                <th style="width: 40px;">Edit </th>
                                <th style="width: 40px;">Delete </th>
                            </tr>
                        </thead>
                        <tbody id="search_body_result">
                            <?php
                            include_once('../../functions/supplier.php');
                            ViewSupplier();
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="deleted_supplier_list">
                    <table id="deletedSuppliers" class="table table-hover table-inverse table-responsive table-bordered" style="margin-top:10px;">
                        <thead class="thead-inverse">
                            <tr>
                                <th style="width: 90px;">Supplier ID </th>
                                <th style="width: 150px;">Company Name </th>
                                <th>Email </th>
                                <th style="width: 100px;">Contact No </th>
                                <th>Address </th>
                                <th style="width: 200px;">Supplied Raw Material</th>
                                <th style="width: 40px;">Status </th>
                                <th style="width: 40px;">Delete </th>
                            </tr>
                        </thead>
                        <tbody id="search_body_result">
                            <?php
                            include_once('../../functions/supplier.php');
                            ViewDeletedSupplier();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Supplier Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <!-- supplier registration form -->
                    <form id="editform">
                        <div class="form group">
                            <label for="supID">Supplier ID</label>
                            <input type="text" name="supID" id="supID" class="form-control" disabled>
                        </div>
                        </br>
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="supName">Supplier Company Name</label>
                                <input type="text" name="supName" id="supName" class="form-control" placeholder="Ex: John">
                            </div>
                            <div class="col-md-6">
                                <label for="supEmail">Email</label>
                                <input type="email" name="supEmail" id="supEmail" class="form-control" placeholder="Ex: Appleseed">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="supPhone">Phone Number (Primary)</label>
                                <input type="number" name="supPhone" id="supPhone" class="form-control" placeholder="Ex: 0771586351" maxlength="10">
                            </div>
                            <div class="col-md-6">
                                <label for="supPhoneTwo">Phone Number (Optional)</label>
                                <input type="number" name="supPhoneTwo" id="supPhoneTwo" class="form-control" placeholder="Ex: 0771547896" maxlength="10">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="supFax">Fax Number</label>
                                <input type="number" name="supFax" id="supFax" class="form-control" placeholder="Ex: 0779563256" maxlength="10">
                            </div>
                            <div class="col-md-6">
                                <label for="supAddress">Address</label>
                                <input type="text" name="supAddress" id="supAddress" class="form-control" placeholder="Ex: 15, Kings Road, New York NY">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ed_supplier_rm">Supplies / Raw Material : </label>
                            <small class="form-text" id="load_rm" style="color: green"></small>
                            <br>
                            <select multiple="" class="form-control" id="ed_supplier_rm" name="ed_supplier_rm[]" placeholder="Click to display all raw materials">
                                <?php
                                include_once("../../functions/rawmaterial.php");
                                getRM();
                                ?>
                            </select>
                        </div>
                        <div class="form-group" align="right">
                            <button class="btn btn-light" id="btn_del" type="reset" style="margin-left: 8px;"><i class="fas fa-minus-circle"></i>&nbsp;&nbsp;Clear</button>
                            <button class="btn btn-success" id="btn_edit" onclick="return false"><i class="fas fa-check-double"></i>&nbsp;&nbsp;Update Details</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Model -->

    <script>
        $(document).ready(function() {

            var multipleCancelButton = new Choices('#supplier_rm', {
                removeItemButton: true
            });

            var multipleCancelButton = new Choices('#ed_supplier_rm', {
                removeItemButton: true
            });

            $("#allSuppliers").DataTable({
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
                        title: "Udaya Industries [REPORT: SUPPLIER LIST]"
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fas fa-file-csv"></i>&nbsp;Export to CSV',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        },
                        title: "Udaya Industries [REPORT: SUPPLIER LIST]"
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i>&nbsp;Export to PDF',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        },
                        title: "Udaya Industries [REPORT: SUPPLIER LIST]"
                    }
                ]
            });

            $("#deletedSuppliers").DataTable({
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
                        title: "Udaya Industries [REPORT: DELETED SUPPLIER LIST]"
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fas fa-file-csv"></i>&nbsp;Export to CSV',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        },
                        title: "Udaya Industries [REPORT: DELETED SUPPLIER LIST]"
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i>&nbsp;Export to PDF',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        },
                        title: "Udaya Industries [REPORT: DELETED SUPPLIER LIST]"
                    }
                ]
            });

            $("#phoneone").keyup(function() {
                $phoneonevalue = $(this).val();
                if ($phoneonevalue < 0) {
                    swal("Error!", "Phone number cannot have negative values!", "warning");
                    $("#phoneone").val('');
                    document.getElementById('btnSave').disabled = true;
                } else {
                    if ($phoneonevalue.length > 10) {
                        swal("Error!", "Phone number should contain only 10 digits!", "warning");
                        $("#phoneone").val('');
                        document.getElementById('btnSave').disabled = true;
                    } else if ($phoneonevalue.length == 9) {
                        document.getElementById('btnSave').disabled = false;
                    } else if ($phoneonevalue.length < 9) {
                        document.getElementById('btnSave').disabled = true;
                    }
                }
            });

            $("#phoneone").change(function() {
                $phoneonevalue = $(this).val();
                if ($phoneonevalue < 0) {
                    swal("Error!", "Phone number cannot have negative values!", "warning");
                    $("#phoneone").val('');
                    document.getElementById('btnSave').disabled = true;
                } else {
                    if ($phoneonevalue.length > 10) {
                        swal("Error!", "Phone number should contain only 10 digits!", "warning");
                        $("#phoneone").val('');
                        document.getElementById('btnSave').disabled = true;
                    } else if ($phoneonevalue.length == 9) {
                        document.getElementById('btnSave').disabled = false;
                    } else if ($phoneonevalue.length < 9) {
                        document.getElementById('btnSave').disabled = true;
                    }
                }
            });

            $("#phonetwo").keyup(function() {
                $phonetwovalue = $(this).val();
                if ($phonetwovalue < 0) {
                    swal("Error!", "Phone number cannot have negative values!", "warning");
                    $("#phonetwo").val('');
                    document.getElementById('btnSave').disabled = true;
                } else {
                    if ($phonetwovalue.length > 10) {
                        swal("Error!", "Phone number should contain only 10 digits!", "warning");
                        $("#phonetwo").val('');
                        document.getElementById('btnSave').disabled = true;
                    } else if ($phonetwovalue.length == 9) {
                        document.getElementById('btnSave').disabled = false;
                    } else if ($phonetwovalue.length < 9) {
                        document.getElementById('btnSave').disabled = true;
                    }
                }
            });

            $("#phonetwo").change(function() {
                $phonetwovalue = $(this).val();
                if ($phonetwovalue < 0) {
                    swal("Error!", "Phone number cannot have negative values!", "warning");
                    $("#phonetwo").val('');
                    document.getElementById('btnSave').disabled = true;
                } else {
                    if ($phonetwovalue.length > 10) {
                        swal("Error!", "Phone number should contain only 10 digits!", "warning");
                        $("#phonetwo").val('');
                        document.getElementById('btnSave').disabled = true;
                    } else if ($phonetwovalue.length == 9) {
                        document.getElementById('btnSave').disabled = false;
                    } else if ($phonetwovalue.length < 9) {
                        document.getElementById('btnSave').disabled = true;
                    }
                }
            });

            $("#fax").keyup(function() {
                $faxvalue = $(this).val();
                if ($faxvalue < 0) {
                    swal("Error!", "Phone number cannot have negative values!", "warning");
                    $("#fax").val('');
                } else {
                    if ($faxvalue.length > 10) {
                        swal("Error!", "Phone number should contain only 10 digits!", "warning");
                        $("#fax").val('');
                    } else if ($faxvalue.length == 9) {} else if ($faxvalue.length < 9) {}
                }
            });

            $("#fax").change(function() {
                $faxvalue = $(this).val();
                if ($faxvalue < 0) {
                    swal("Error!", "Phone number cannot have negative values!", "warning");
                    $("#fax").val('');
                    document.getElementById('btnSave').disabled = true;
                } else {
                    if ($faxvalue.length > 10) {
                        swal("Error!", "Phone number should contain only 10 digits!", "warning");
                        $("#fax").val('');
                        document.getElementById('btnSave').disabled = true;
                    } else if ($faxvalue.length == 9) {
                        document.getElementById('btnSave').disabled = false;
                    } else if ($faxvalue.length < 9) {
                        document.getElementById('btnSave').disabled = true;
                    }
                }
            });

            $('#allSuppliers tbody').on('click', '.btn-primary', function() {

                $id = $(this).attr('id');

                $.get("../../route/supplier/getsingleSup.php", {
                    id: $id
                }, function(data) {

                    var jdata = jQuery.parseJSON(data);

                    var supinfo = jdata[0];

                    $("#supID").val(supinfo.sup_id);
                    $("#supName").val(supinfo.sup_company_name);
                    $("#supEmail").val(supinfo.sup_email);
                    $("#supPhone").val(supinfo.sup_phone);
                    $('#supPhoneTwo').val(supinfo.sup_phone_two);
                    $('#supFax').val(supinfo.sup_fax_number);
                    $("#supAddress").val(supinfo.sup_address);

                    var rminfo = jdata[1];

                    $('#load_rm').html(rminfo);
                });
            });

            $("#btn_edit").click(function() {

                $supID = $("#supID").val();
                $supName = $("#supName").val();
                $supEmail = $("#supEmail").val();
                $supPhone = $("#supPhone").val();
                $supPhoneTwo = $("#supPhoneTwo").val();
                $supFax = $("#supFax").val();
                $supAddress = $("#supAddress").val();

                $supRM = $("#ed_supplier_rm").val();

                if ($supRM == '') {
                    $.post("../../route/supplier/updateSupplier.php", {
                        supID: $supID,
                        supName: $supName,
                        supEmail: $supEmail,
                        supPhone: $supPhone,
                        supPhoneTwo: $supPhoneTwo,
                        supFax: $supFax,
                        supAddress: $supAddress
                    }, function(data) {
                        if (data == "success") {
                            setTimeout(() => {
                                location.reload();
                            }, 2010);
                            swal({
                                type: 'success',
                                title: 'Supplier details updated!',
                                text: 'Supplier details have been updated successfully!',
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else {
                            $error_msg = "Kindly check whether all the mandatory fields have been filled out";
                            swal("Check your inputs!", $error_msg, "warning");
                        }
                    });
                } else {
                    $.post("../../route/supplier/updateSupplierwithRM.php", {
                        supID: $supID,
                        supName: $supName,
                        supEmail: $supEmail,
                        supPhone: $supPhone,
                        supPhoneTwo: $supPhoneTwo,
                        supFax: $supFax,
                        supAddress: $supAddress,
                        supRM: $supRM
                    }, function(data) {
                        if (data == "success") {
                            setTimeout(() => {
                                location.reload();
                            }, 2010);
                            swal({
                                type: 'success',
                                title: 'Supplier details updated!',
                                text: 'Supplier details have been updated successfully!',
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else {
                            $error_msg = "Kindly check whether all the mandatory fields have been filled out";
                            swal("Check your inputs!", $error_msg, "warning");
                        }
                    });
                }
            });


            $('#allSuppliers tbody').on('click', '.btn-danger', function() {
                this.click;
                $trID = $(this).attr('id');

                swal({
                        title: "Are you sure?",
                        text: "You will still be able to recover this data!",
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
                            $.get("../../route/supplier/deleteSupplier.php", {
                                id: $trID
                            }, function(data) {
                                setTimeout(() => {
                                    location.reload();
                                }, 2050);
                                swal({
                                    type: 'success',
                                    title: 'Supplier deleted!',
                                    text: 'Supplier details succesfully deleted!',
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            });
                        } else {
                            swal({
                                type: 'warning',
                                title: 'Cancelled!',
                                text: 'Supplier details remain!',
                                showConfirmButton: false,
                                timer: 2000
                            });
                        }
                    });
            });


            $('#deletedSuppliers tbody').on('click', '.btn-reactivate', function() {

                this.click;
                $trID = $(this).attr('id');

                swal({
                        title: "Reactivate Supplier : " + $trID + "?",
                        text: "You will restore " + $trID + "'s data!",
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
                            $.get("../../route/supplier/reactivateSupplier.php", {
                                id: $trID
                            }, function(data) {
                                setTimeout(() => {
                                    location.reload();
                                }, 2050);
                                swal({
                                    type: 'success',
                                    title: 'Supplier deleted!',
                                    text: 'Supplier details succesfully deleted!',
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            });
                        } else {
                            swal({
                                type: 'warning',
                                title: 'Cancelled!',
                                text: 'Supplier details remain!',
                                showConfirmButton: false,
                                timer: 2000
                            });
                        }
                    });
            });


            $("#btnSave").click(function() {
                $.ajax({
                    url: "../../route/supplier/newsupplier.php",
                    type: "POST",
                    data: $("#saveSup").serialize(),
                    success: function(data) {
                        if (data == "Success") {
                            setTimeout(() => {
                                location.reload();
                            }, 2100);
                            swal({
                                type: 'success',
                                title: 'New supplier added!',
                                text: 'New supplier has been successfully registered',
                                showConfirmButton: false,
                                timer: 2000
                            })
                        } else {
                            swal("Check your inputs!", "Kindly check whether all the mandatory fields have been filled out", "warning");
                        }
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