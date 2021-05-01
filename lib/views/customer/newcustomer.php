<?php
session_start();

include_once('../../inc/header.php');

if (isset($_SESSION['userId']) && $_SESSION['user_role'] == 1) {

    include_once('../../inc/sidenav.php');

?>
    <br>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../dashboard/admin.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Customer</li>
        </ol>
    </div>

    <div class="col-md-12">
        <div class="jumbotron">
            <h1 class="display-5" style="text-align: center;"><i class="fas fa-user-friends fa-1x"></i>&nbsp;&nbsp;Register Customer</h1>
            <hr class="my-4">

            <!-- customer registration form -->
            <form id="saveCus">
                <div class="row form-group">
                    <div class="col-md-6">
                        <p class="lead">Customer Details</p>
                        <hr class="my-4">
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="firstname">First Name</label>
                                <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Ex: John" required>
                            </div>
                            <div class="col-md-6">
                                <label for="lastname">Last Name</label>
                                <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Ex: Appleseed" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="mail">Email Address</label>
                            <input type="email" name="mail" id="mail" class="form-control" placeholder="Ex: johnappleseed@email.com" required>
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <p style="color: red; display: none;" id="error_mail" class="form-text"><i class="far fa-times-circle"></i>&nbsp;This email already exists in the system!</p>
                        <br />
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="phoneone">Phone Number (Primary)</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <select class="form-control" id="code_phoneone" name="code_phoneone">
                                            <option value="+61">[+61] Australia</option>
                                            <option value="+880">[+880] Bangladesh</option>
                                            <option value="+852">[+852] Hong Kong</option>
                                            <option value="+91">[+91] India</option>
                                            <option value="+95">[+95] Myanmar</option>
                                            <option value="+248">[+248] Seychelles</option>
                                            <option value="+65">[+65] Singapore</option>
                                            <option value="+27">[+27] South Africa</option>
                                            <option value="+94" selected="">[+94] Sri Lanka</option>
                                            <option value="+84">[+84] Vietnam</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" name="phoneone" id="phoneone" class="form-control" placeholder="Ex: 771586351" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="phonetwo">Phone Number (Optional)</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <select class="form-control" id="code_phonetwo" name="code_phonetwo">
                                            <option value="+61">[+61] Australia</option>
                                            <option value="+880">[+880] Bangladesh</option>
                                            <option value="+852">[+852] Hong Kong</option>
                                            <option value="+91">[+91] India</option>
                                            <option value="+95">[+95] Myanmar</option>
                                            <option value="+248">[+248] Seychelles</option>
                                            <option value="+65">[+65] Singapore</option>
                                            <option value="+27">[+27] South Africa</option>
                                            <option value="+94" selected="">[+94] Sri Lanka</option>
                                            <option value="+84">[+84] Vietnam</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" name="phonetwo" id="phonetwo" class="form-control" placeholder="Ex: 771547896" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div style="border-left:1px solid #dbdbdb; height:300px"></div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <p class="lead">Address Details</p>
                            <hr class="my-4">
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label for="houseno">House No.</label>
                                    <input type="text" name="houseno" id="houseno" class="form-control" placeholder="Ex: 20" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="street1">Street 1</label>
                                    <input type="text" name="street1" id="street1" class="form-control" placeholder="Ex: Castle Lane" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="street2">Street 2</label>
                                    <input type="text" name="street2" id="street2" class="form-control" placeholder="Ex: Thornton Heath" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="city">City</label>
                                    <input type="text" name="city" id="city" class="form-control" placeholder="Ex: London" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="pcode">Postal Code</label>
                                    <input type="text" name="pcode" id="pcode" class="form-control" placeholder="Ex: 00556245" required>
                                </div>
                            </div>
                        </div>
                        <br /><br /><br />
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
            <h1 class="display-5" style="text-align: center;"><i class="fas fa-user-friends fa-1x"></i>&nbsp;&nbsp;Customer Information</h1>
            <hr class="my-4">
            <!-- our usual table -->
            <table id="allCustomers" class="table table-hover table-inverse table-responsive table-bordered" style="margin-top:10px;">
                <thead class="thead-inverse">
                    <tr>
                        <th style="min-width: 100px;">Code</th>
                        <th style="min-width: 100px;">First Name </th>
                        <th style="min-width: 100px;">Last Name </th>
                        <th style="min-width: 120px;">Email </th>
                        <th style="min-width: 150px;">Phone #1 </th>
                        <th style="min-width: 150px;">Phone #2 </th>
                        <th style="min-width: 150px;">Address </th>
                        <th style="width: 40px;">Status </th>
                        <th style="width: 40px;">Edit </th>
                        <th style="width: 40px;">Delete </th>
                    </tr>
                </thead>
                <tbody id="search_body_result">
                    <?php
                    include_once('../../functions/customer.php');
                    ViewCustomer();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Customer Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <form id="editform">
                        <div class="row form-group">
                            <div class="col-md-4">
                                <label>Customer ID</label>
                                <input type="text" name="cusID" id="cusID" class="form-control" disabled>
                            </div>
                            <div class="col-md-4">
                                <label>First Name</label>
                                <input type="text" name="cusFName" id="cusFName" class="form-control" placeholder="Ex: John" required>
                            </div>
                            <div class="col-md-4">
                                <label>Last Name</label>
                                <input type="text" name="cusLName" id="cusLName" class="form-control" placeholder="Ex: Appleseed" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" name="cusEmail" id="cusEmail" class="form-control" placeholder="Ex: johnappleseed@email.com">
                            <small id="emailHelpModal" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <p style="color: red; display: none;" id="error_mail_modal" class="form-text"><i class="far fa-times-circle"></i>&nbsp;This email already exists in the system!</p>
                        <br />
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="phoneone">Phone Number (Primary)</label>
                                <br />
                                <select class="form-control" id="codePhoneone" name="codePhoneone">
                                    <option value="+61">[+61] Australia</option>
                                    <option value="+880">[+880] Bangladesh</option>
                                    <option value="+852">[+852] Hong Kong</option>
                                    <option value="+91">[+91] India</option>
                                    <option value="+95">[+95] Myanmar</option>
                                    <option value="+248">[+248] Seychelles</option>
                                    <option value="+65">[+65] Singapore</option>
                                    <option value="+27">[+27] South Africa</option>
                                    <option value="+94" selected="">[+94] Sri Lanka</option>
                                    <option value="+84">[+84] Vietnam</option>
                                </select>
                                <br />
                                <input type="number" name="cusPhoneOne" id="cusPhoneOne" class="form-control" placeholder="Ex: 771586351" required>
                                <small style="color: red; display: none;" id="error_tel_one" class="form-text"><i class="far fa-times-circle"></i>&nbsp;Phone number should contain only 9 digits</small>
                            </div>
                            <div class="col-md-6">
                                <label for="phonetwo">Phone Number (Optional)</label>
                                <br />
                                <select class="form-control" id="codePhonetwo" name="codePhonetwo">
                                    <option value="+61">[+61] Australia</option>
                                    <option value="+880">[+880] Bangladesh</option>
                                    <option value="+852">[+852] Hong Kong</option>
                                    <option value="+91">[+91] India</option>
                                    <option value="+95">[+95] Myanmar</option>
                                    <option value="+248">[+248] Seychelles</option>
                                    <option value="+65">[+65] Singapore</option>
                                    <option value="+27">[+27] South Africa</option>
                                    <option value="+94" selected="">[+94] Sri Lanka</option>
                                    <option value="+84">[+84] Vietnam</option>
                                </select>
                                <br />
                                <input type="number" name="cusPhoneTwo" id="cusPhoneTwo" class="form-control" placeholder="Ex: 771547896" required>
                                <small style="color: red; display: none;" id="error_tel_two" class="form-text"><i class="far fa-times-circle"></i>&nbsp;Phone number should contain only 9 digits</small>
                            </div>
                        </div>
                        <div class="form-group">
                            <hr class="my-4">
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label for="chouseno">House No.</label>
                                    <input type="text" name="chouseno" id="chouseno" class="form-control" placeholder="Ex: 20" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="cstreet1">Street 1</label>
                                    <input type="text" name="cstreet1" id="cstreet1" class="form-control" placeholder="Ex: Castle Lane" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="cstreet2">Street 2</label>
                                    <input type="text" name="cstreet2" id="cstreet2" class="form-control" placeholder="Ex: Thornton Heath" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="ccity">City</label>
                                    <input type="text" name="ccity" id="ccity" class="form-control" placeholder="Ex: London" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="cpcode">Postal Code</label>
                                    <input type="text" name="cpcode" id="cpcode" class="form-control" placeholder="Ex: 00556245" required>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-group" align="right">
                            <button class="btn btn-warning" type="reset" style="margin:5px;"><i class="fas fa-minus-circle"></i>&nbsp;&nbsp;Clear</button>
                            <button id="btn_edit" class="btn btn-success" onclick="return false" style="margin:5px;"><i class="fas fa-save"></i>&nbsp;&nbsp;Save details</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Model -->


    <script>
        $(document).ready(function() {

            $("#allCustomers").DataTable({
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

            $("#cusPhoneOne").keyup(function() {
                $phonenolength = $(this).val();
                if ($phonenolength.length > 9) {
                    $("#error_tel_one").show();
                } else {
                    $("#error_tel_one").hide();
                }
            });

            $("#cusPhoneTwo").keyup(function() {
                $phonenolength = $(this).val();
                if ($phonenolength.length > 9) {
                    $("#error_tel_two").show();
                } else {
                    $("#error_tel_two").hide();
                }
            });

            document.getElementById('btnSave').disabled = true;


            $("#phoneone").keyup(function() {
                $phoneonevalue = $(this).val();
                if ($phoneonevalue < 0) {
                    swal("Error!", "Phone number cannot have negative values!", "warning");
                    $("#phoneone").val('');
                    document.getElementById('btnSave').disabled = true;
                } else {
                    if ($phoneonevalue.length > 9) {
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
                    if ($phoneonevalue.length > 9) {
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
                } else {
                    if ($phonetwovalue.length > 9) {
                        swal("Error!", "Phone number should contain only 10 digits!", "warning");
                        $("#phonetwo").val('');
                    }
                }
            });

            $("#phonetwo").change(function() {
                $phonetwovalue = $(this).val();
                if ($phonetwovalue < 0) {
                    swal("Error!", "Phone number cannot have negative values!", "warning");
                    $("#phonetwo").val('');
                } else {
                    if ($phonetwovalue.length > 9) {
                        swal("Error!", "Phone number should contain only 10 digits!", "warning");
                        $("#phonetwo").val('');
                    }
                }
            });

            $("#mail").keyup(function() {

                var mailresult = $(this).val();

                if (mailresult.length < 9) {
                    $("#error_mail").hide();

                } else {
                    $.get("../../route/cusmail_verification.php", {
                        data: mailresult
                    }, function(data) {
                        if (data == "success") {
                            $("#error_mail").show();
                            $("#emailHelp").show();
                        } else {
                            $("#error_mail").hide();
                        }
                    });
                }
            });

            $("#cusEmail").keyup(function() {

                var mailresult = $(this).val();

                if (mailresult.length < 9) {
                    $("#error_mail_modal").hide();

                } else {
                    $.get("../../route/cusmail_verification.php", {
                        data: mailresult
                    }, function(data) {
                        if (data == "success") {
                            $("#error_mail_modal").show();
                            $("#emailHelpModal").show();
                        } else {
                            $("#error_mail_modal").hide();
                        }
                    });
                }
            });

            //check edit button
            $('#allCustomers tbody').on('click', '.btn-primary', function() {

                $id = $(this).attr('id');

                //send ajax request to bring customer data
                $.get("../../route/customer/getsingleCus.php", {
                    id: $id
                }, function(data) {

                    var jdata = jQuery.parseJSON(data);

                    $("#cusID").val(jdata.cus_id);
                    $("#cusFName").val(jdata.cus_first_name);
                    $("#cusLName").val(jdata.cus_last_name);
                    $("#cusEmail").val(jdata.cus_email);
                    $("#codePhoneone").val(jdata.cus_code_phoneone);
                    $("#cusPhoneOne").val(jdata.cus_phone_one);
                    $("#codePhonetwo").val(jdata.cus_code_phonetwo);
                    $("#cusPhoneTwo").val(jdata.cus_phone_two);
                    $("#chouseno").val(jdata.cus_houseno);
                    $("#cstreet1").val(jdata.cus_street_one);
                    $("#cstreet2").val(jdata.cus_street_two);
                    $("#ccity").val(jdata.cus_city);
                    $("#cpcode").val(jdata.cus_postal_code);
                });
            });

            $("#btnSave").click(function() {

                //run ajax call
                $.ajax({
                    url: "../../route/customer/newcustomer.php",
                    type: "POST",
                    data: $("#saveCus").serialize(),
                    success: function(data) {

                        if (data == "success") {
                            setTimeout(() => {
                                location.reload();
                            }, 2100);
                            swal({
                                type: 'success',
                                title: 'New customer added!',
                                text: 'New customer has been successfully registered',
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else {

                            $error_msg = "Kindly check whether all the mandatory fields have been filled out";

                            swal("Check your inputs!", $error_msg, "warning");
                        }
                    }
                });
            });

            //if user click on save button on model it should call a ajax function
            $("#btn_edit").click(function() {

                $cusId = $("#cusID").val();
                $fname = $("#cusFName").val();
                $lname = $("#cusLName").val();
                $email = $("#cusEmail").val();
                $codeone = $("#codePhoneone").val();
                $phoneone = $("#cusPhoneOne").val();
                $codetwo = $("#codePhonetwo").val();
                $phonetwo = $("#cusPhoneTwo").val();
                $houseno = $("#chouseno").val();
                $streetone = $("#cstreet1").val();
                $streettwo = $("#cstreet2").val();
                $city = $("#ccity").val();
                $pcode = $("#cpcode").val();

                $.post("../../route/customer/updatecustomer.php", {
                    cusID: $cusId,
                    cusFName: $fname,
                    cusLName: $lname,
                    cusEmail: $email,
                    cusPhoneOneCode: $codeone,
                    cusPhoneOne: $phoneone,
                    cusPhoneTwoCode: $codetwo,
                    cusPhoneTwo: $phonetwo,
                    cusHouseNo: $houseno,
                    cusStreetOne: $streetone,
                    cusStreetTwo: $streettwo,
                    cusCity: $city,
                    cusPCode: $pcode,

                }, function(data) {

                    if (data == "success") {
                        setTimeout(() => {
                            location.reload();
                        }, 2100);
                        $('#editModal').modal('hide');
                        swal({
                            type: 'success',
                            title: 'Customer details updated!',
                            text: 'Customer details have been updated successfully',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    } else {

                        $error_msg = "Kindly check whether all the mandatory fields have been filled out";
                        swal("Check your inputs!", $error_msg, "warning");
                    }
                })
            });

            $('#allCustomers tbody').on('click', '.btn-danger', function() {

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
                            $.get("../../route/customer/delete.php", {
                                id: $trID
                            }, function(data) {
                                swal({
                                    type: 'success',
                                    title: 'Customer deleted!',
                                    text: 'Customer details succesfully deleted!',
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            });
                        } else {
                            swal({
                                type: 'warning',
                                title: 'Cancelled!',
                                text: 'Customer details remain!',
                                showConfirmButton: false,
                                timer: 2000
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