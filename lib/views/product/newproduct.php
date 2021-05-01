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
            <li class="breadcrumb-item"><a href="#">Product</a></li>
            <li class="breadcrumb-item active">Manage Product</li>
        </ol>
    </div>

    <div class="col-md-12">
        <div class="jumbotron">
            <h1 class="display-5" style="text-align: center;"><i class="fas fa-box fa-1x"></i>&nbsp;&nbsp;Add New Machine</h1>
            <p class="lead" style="text-align: center;">Save new product details</p>
            <hr class="my-4">

            <!-- product registration form -->

            <form id="saveProd">
                <div class="row">
                    <div class="col-md-6">
                        <p class="lead">Product Description</p>

                        <hr class="my-4">

                        <div class="row form-group">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="prodname">Machine Name</label>
                                    <input type="text" id="prodname" name="prodname" class="form-control" placeholder="Product Name (නිෂ්පාදන නාමය)" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="prodcode">Manufacture Code</label>
                                <input type="text" id="prodcode" name="prodcode" class="form-control" placeholder="Manufacture Code (නිෂ්පාදන කේතය)" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="product_img">Machine Image</label>
                                    <br>
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="product_image" id="product_image">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                    <img id="prod_image" src="" class="img-responsive img-rounded center-block border">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea rows="3" cols="3" id="proddesc" name="proddesc" class="form-control" placeholder="Product Details and Description (නිෂ්පාදන විස්තර)"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div style="border-left:1px solid #dbdbdb; height:400px"></div>
                    </div>
                    <div class="col-md-5">
                        <p class="lead">Machine Specifications</p>

                        <hr class="my-4">

                        <div class="row form-group">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="prodcapacity">Capacity</label>
                                    <input type="text" id="prodcapacity" name="prodcapacity" class="form-control" placeholder="Capacity (ධාරිතාව)" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="prodmotorcapacity">Motor Capacity</label>
                                    <input type="text" id="prodmotorcapacity" name="prodmotorcapacity" class="form-control" placeholder="Motor Capacity (මෝටර් ධාරිතාව​)" required>
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="length">Motor Speed</label>
                                    <input type="text" id="prodmotorspeed" name="prodmotorspeed" class="form-control" placeholder="Motor Speed (මෝටර් වේගය)" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="prodphase">Current Phase</label>
                                        <select class="form-control" name="prodphase" id="prodphase">
                                            <option value="" selected>-- Phases (අදියර) --</option>
                                            <option value="Single Phase">Single Phase</option>
                                            <option value="Three Phase">Three Phase</option>
                                        </select>
                                    </div>
                                    <!-- <label for="weight">Current Phase</label>
                                    <input type="text" id="prodphase" name="prodphase" class="form-control" placeholder="Phases (අදියර)" required> -->
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="unitprice">Unit Price</label>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rs.</span>
                                            </div>
                                            <input type="number" class="form-control" name="unitprice" id="unitprice" placeholder="Ex: Rs. 40,000, Rs. 20,000 etc...">
                                            <div class="input-group-append">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="reorderlevel">Reorder Level</label>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <input type="number" class="form-control" name="reorderlevel" id="reorderlevel" placeholder="Ex: 10, 15 units etc...">
                                            <div class="input-group-append">
                                                <span class="input-group-text">unit(s)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="form-group" align="right">
                    <button class="btn btn-warning" type="reset" style="margin:5px;"><i class="fas fa-minus-circle"></i>&nbsp;&nbsp;Clear</button>
                    <button id="btnSave" class="btn btn-success" onclick="return false" style="margin:5px;"><i class="fas fa-save"></i>&nbsp;&nbsp;Save details</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-12">
        <div class="jumbotron">
            <h1 class="display-5" style="text-align: center;"><i class="fas fa-box fa-1x"></i>&nbsp;&nbsp;Product List</h1>
            <br><br>
            <table class="table table-hover table-inverse table-responsive table-bordered" id="product_list">
                <thead>
                    <tr>
                        <th>Item Code</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>P.Capacity</th>
                        <th>Motor</th>
                        <th>Current</th>
                        <th>Price</th>
                        <th>R/Level</th>
                        <th style="min-width: 40px;">QR</th>
                        <th style="min-width: 40px;">Edit</th>
                        <th style="min-width: 40px;">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include_once("../../functions/product.php");
                    ViewProduct();
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Machine Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editform" enctype="multipart/form-data">
                        <div class="row form-group">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="ed_prodid">Machine ID</label>
                                    <input type="text" name="ed_prodid" id="ed_prodid" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ed_prodname">Machine Name</label>
                                    <input type="text" name="ed_prodname" id="ed_prodname" class="form-control" placeholder="Product Name (නිෂ්පාදන නාමය)">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ed_prodcode">Machine Code</label>
                                    <input type="text" name="ed_prodcode" id="ed_prodcode" class="form-control" placeholder="Manufacture Code (නිෂ්පාදන කේතය)">
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="product_img">Machine Image</label>
                                    <br>
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="product_pic" id="product_pic">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                    <img id="prod_pic" name="prod_pic" src="" class="img-responsive img-rounded center-block border">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ed_desc">Description</label>
                                    <textarea name="ed_desc" id="ed_desc" class="form-control" rows="3" placeholder="Product Details and Description (නිෂ්පාදන විස්තර)"></textarea>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="row form-group">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ed_prodcapacity">Capacity</label>
                                    <input type="text" id="ed_prodcapacity" name="ed_prodcapacity" class="form-control" placeholder="Capacity (ධාරිතාව)" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ed_motorcapacity">Motor Capacity</label>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="ed_motorcapacity" id="ed_motorcapacity" placeholder="Motor Capacity (මෝටර් ධාරිතාව​)">
                                            <div class="input-group-append">
                                                <span class="input-group-text">HP</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ed_motorspeed">Motor Speed</label>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="ed_motorspeed" id="ed_motorspeed" placeholder="Motor Speed (මෝටර් වේගය)">
                                            <div class="input-group-append">
                                                <span class="input-group-text">RPM</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ed_prodphase">Current Phase</label>
                                    <input type="text" id="ed_prodphase" name="ed_prodphase" class="form-control" placeholder="Current Phase (අදියර)" required>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ed_unitprice">Unit Price</label>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rs.</span>
                                            </div>
                                            <input type="number" class="form-control" name="ed_unitprice" id="ed_unitprice" placeholder="Ex: Rs. 40,000, Rs. 20,000 etc...">
                                            <div class="input-group-append">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ed_reorderlevel">Reorder Level</label>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <input type="number" class="form-control" name="ed_reorderlevel" id="ed_reorderlevel" placeholder="Ex: 10, 15 units etc...">
                                            <div class="input-group-append">
                                                <span class="input-group-text">unit(s)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" align="right">
                            <button id="btnEdit" class="btn btn-success" onclick="return false" style="margin:5px;"><i class="fas fa-save"></i>&nbsp;&nbsp;Update Details</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Model -->

    <script>
        $(document).ready(function() {

            $("#btnSave").click(function() {

                var form = $('#saveProd')[0];
                var formData = new FormData(form);

                $.ajax({
                    url: "../../route/product/newproduct.php",
                    data: formData,
                    processData: false,
                    contentType: false,
                    type: 'POST',
                    success: function(data) {

                        if (data == "Success") {
                            setTimeout(() => {
                                location.reload();
                            }, 2700);
                            swal({
                                type: 'success',
                                title: 'New Product added!',
                                text: 'New Product has been successfully registered',
                                showConfirmButton: false,
                                timer: 2500
                            }).then((result) => {
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    $("#new_reminder").modal("hide");
                                }
                            });
                        } else if (data == "ext_error") {

                            swal("Image Error!", "You can only upload either .PNG, .JPG or .GIF images!", "warning");

                        } else {

                            swal("Check your inputs!", "Kindly check whether all the mandatory fields have been filled out", "warning");
                        }
                    }
                })
            });

            $("#product_list").DataTable({
                dom: 'B<"clear">lfrtip',
                "order": [[ 2, "asc" ]],
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

            $('#product_list tbody').on('click', '.btn-primary', function() {

                $id = $(this).attr("id");

                $.get("../../route/product/getsingleProd.php", {
                    id: $id
                }, function(data) {

                    var jdata = jQuery.parseJSON(data);
                    var imgdbpath = jdata.prod_img_path;

                    // //show json data on HTML inputs
                    $("#ed_prodid").val(jdata.prod_id);
                    $("#ed_prodname").val(jdata.prod_name);
                    $("#ed_desc").val(jdata.prod_description);
                    $("#ed_prodcode").val(jdata.prod_code);
                    $("#ed_prodcapacity").val(jdata.prod_capacity);
                    $("#ed_motorcapacity").val(jdata.prod_motor_capacity);
                    $("#ed_motorspeed").val(jdata.prod_motor_speed);
                    $("#ed_prodphase").val(jdata.prod_phase);
                    $("#ed_unitprice").val(jdata.prod_unit_price);
                    $("#ed_reorderlevel").val(jdata.prod_reorder_level);

                    $('#prod_pic').attr("style", "width:40%");
                    $('#prod_pic').attr("src", '../../' + imgdbpath + '');
                })
            });

            $("#btnEdit").click(function() {

                var form = $('#editform')[0];
                var formData = new FormData(form);

                var ed_prodid = $("#ed_prodid").val();

                formData.append('ed_prodid', ed_prodid);

                $.ajax({
                    url: "../../route/product/updateproduct.php",
                    data: formData,
                    processData: false,
                    contentType: false,
                    type: 'POST',
                    success: function(data) {
                        if (data == "success") {
                            setTimeout(() => {
                                location.reload();
                            }, 2600);
                            swal({
                                type: 'success',
                                title: 'Product Updated!',
                                text: 'Product details has been updated successfully!',
                                showConfirmButton: false,
                                timer: 2500
                            }).then((result) => {
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    $("#new_reminder").modal("hide");
                                }
                            });
                        } else if (data == "ext_error") {

                            swal("Image Error!", "You can only upload either .PNG, .JPG or .GIF images!", "warning");

                        } else {

                            swal("Check your inputs!", "Kindly check whether all the mandatory fields have been filled out", "warning");
                        }
                    }
                });
            });

            $('#product_list tbody').on('click', '.btn-info', function() {

                this.click;
                var prodID = $(this).attr('id');
                window.open("productqr.php?code=" + prodID);
            });


            $('#product_list tbody').on('click', '.btn-danger', function() {

                this.click;

                $trID = $(this).attr('id');

                swal({
                        title: "Are you sure?",
                        text: "You will still be able to recover this data!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            $.get("../../route/product/deleteProduct.php", {
                                id: $trID
                            }, function(data) {
                                if (data == "Deleted") {
                                    setTimeout(() => {
                                        location.reload();
                                    }, 2100);
                                    swal({
                                        type: 'success',
                                        title: 'Product deleted!',
                                        text: 'Product details succesfully deleted!',
                                        showConfirmButton: false,
                                        timer: 2000
                                    }).then((result) => {
                                        if (result.dismiss === Swal.DismissReason.timer) {
                                            $("#new_reminder").modal("hide");
                                        }
                                    });
                                }
                            });
                        } else {
                            swal({
                                type: 'warning',
                                title: 'Cancelled!',
                                text: 'Customer details remain!',
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

        $('#product_image').change(function() {
            var read = new FileReader();

            read.onload = function(e) {
                $('#prod_image').attr("style", "width:40%");
                $('#prod_image').attr("src", e.target.result);
            }

            read.readAsDataURL(this.files[0]);
        });

        $('#product_pic').change(function() {
            var read = new FileReader();

            read.onload = function(e) {
                $('#prod_image').attr("style", "width:40%");
                $('#prod_image').attr("src", e.target.result);
            }

            read.readAsDataURL(this.files[0]);
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