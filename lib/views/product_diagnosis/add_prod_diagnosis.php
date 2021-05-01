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
            <li class="breadcrumb-item"><a href="#">Product Diagnosis</a></li>
            <li class="breadcrumb-item active">Add Product Diagnosis</li>
        </ol>
    </div>

    <div class="col-md-12">
        <div class="jumbotron">
            <h1 class="display-5" style="text-align: center;"><i class="fas fa-laptop-code fa-1x"></i>&nbsp;&nbsp;Add Product for Diagnosis</h1>
            <hr class="my-4">
            <br>
            <form id="prod_diagnosis_form" enctype="multipart/form-data">
                <div class="row form-group">
                    <div class="col-md-6">
                        <label>
                            <h6>Search for Customer:</h6>
                        </label>
                        <input type="text" name="customer_search" id="customer_search" class="form-control" placeholder="Enter any customer to search..">
                        <p id="selected_customer" class="form-text" style="color: green; display: none;"></p>
                        <div id="cusInfo"></div>
                    </div>
                    <div class="col-md-6">
                        <label>
                            <h6>Search for Product</h6>
                        </label>
                        <input type="text" name="product_search" id="product_search" class="form-control" placeholder="Enter any product keyword to search..">
                        <p id="selected_product" class="form-text" style="color: green; display: none;"></p>
                        <div id="prodInfo"></div>
                    </div>
                </div>
                <br>
                <div class="row form-group">
                    <div class="col-md-6">
                        <label>
                            <h6>Initial Customer Statement :</h6>
                        </label>
                        <textarea name="customer_statement" id="customer_statement" class="form-control" rows="2" placeholder="Enter initial customer statement in detail.."></textarea>
                    </div>
                    <div class="col-md-6">
                        <label>
                            <h6>Initial Defect Statement :</h6>
                        </label>
                        <textarea name="defect_statement" id="defect_statement" class="form-control" rows="2" placeholder="Enter initial defect statement in detail.."></textarea>
                    </div>
                </div>
                <br>
                <div class=" row form-group">
                    <div class="col-md-6">
                        <label>
                            <h6>Upload Defect Image #1 :</h6>
                        </label>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="defect_image" name="defect_image">
                                <label class="custom-file-label" for="defect_image">Choose file</label>
                            </div>
                        </div>
                        <img id="image_preview" src="" alt="" />
                    </div>
                    <div class="col-md-6">
                        <label>
                            <h6>Upload Defect Image #2 :</h6>
                        </label>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="defect_image_two" name="defect_image_two">
                                <label class="custom-file-label" for="defect_image_two">Choose file</label>
                            </div>
                        </div>
                        <img id="image_preview_two" src="" alt="" />
                    </div>
                </div>
                <div class="text-right">
                    <button type="button" id="addDiagnosis" class="btn btn-primary" onclick="return false"><i class="fas fa-paper-plane"></i>&nbsp;&nbsp;Add Defect Diagnosis</button>
                </div>
            </form>
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

            $("#customer_search").keyup(function() {

                var searchVal = $(this).val();

                if (searchVal.length < 1) {
                    $("#cusInfo").hide();
                } else {
                    $.get("../../route/productDefectDiagnosis/SearchCus.php", {
                        data: searchVal
                    }, function(data) {
                        $("#cusInfo").show();
                        $("#cusInfo").html(data);

                        $(".btn-info").click(function() {
                            var cusID = $(this).attr('id');
                            $("#cusInfo").hide();

                            $.get("../../route/productDefectDiagnosis/fetchCusResult.php", {
                                id: cusID
                            }, function(data) {

                                var jdata = jQuery.parseJSON(data);

                                $("#selected_customer").show();

                                var showText = '<i class="fas fa-check"></i>&nbsp;&nbsp;Selected Product : [' + jdata.cus_id + ']&nbsp;' + jdata.cus_first_name + '&nbsp;' + jdata.cus_last_name;

                                $("#selected_customer").html(showText);

                                document.getElementById('customer_search').value = cusID;

                            });

                        });
                    });
                }
            });


            $("#product_search").keyup(function() {

                var searchVal = $(this).val();

                if (searchVal.length < 1) {
                    $("#prodInfo").hide();
                } else {
                    $.get("../../route/productDefectDiagnosis/SearchProd.php", {
                        data: searchVal
                    }, function(data) {
                        $("#prodInfo").show();
                        $("#prodInfo").html(data);

                        $(".btn-selprod").click(function() {

                            var prodID = $(this).attr('id');
                            $("#prod_number").val(prodID);
                            $("#prodInfo").hide();

                            $.get("../../route/productDefectDiagnosis/fetchProdResult.php", {
                                id: prodID
                            }, function(data) {

                                var jdata = jQuery.parseJSON(data);

                                $("#selected_product").show();

                                var showText = '<i class="fas fa-check"></i>&nbsp;&nbsp;Selected Product : [' + prodID + '] ' + jdata.prod_name;

                                $("#selected_product").html(showText);

                                document.getElementById('product_search').value = prodID;

                            });

                        });
                    });
                }

            });

            $("#addDiagnosis").click(function() {

                var form = $('#prod_diagnosis_form')[0];
                var formData = new FormData(form);

                var one = $("#selected_customer").html();
                var two = $("#selected_product").html();

                if (one == '' || two == '') {
                    swal("Please Select Customer/Product!", "Please select customer and product to proceed!", "warning");
                } else {
                    $.ajax({
                        url: "../../route/productDefectDiagnosis/newProductDiagnosis.php",
                        data: formData,
                        processData: false,
                        contentType: false,
                        type: 'POST',
                        success: function(data) {
                            if (data == "success") {
                                setTimeout(() => {
                                    window.location.href = "./product_diagnosis.php";
                                }, 2100);
                                swal({
                                    type: 'success',
                                    title: 'New Defective Product Added!',
                                    text: 'New Defective Product has been added successfully!',
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            } else if (data == "ext_error") {
                                swal("Image Error!", "You can only upload either .PNG, .JPG or .GIF images!", "warning");
                            } else if (data == "no_img") {
                                swal("No Images Found!", "Please upload both IR images of the defective product!", "warning");
                            } else {
                                swal("Check your inputs!", "Kindly check whether all the mandatory fields have been filled out", "warning");
                            }
                        }
                    });
                }
            });

            $('#defect_image').change(function() {
                var read = new FileReader();

                read.onload = function(e) {
                    $('#image_preview').attr("style", "width:40%");
                    $('#image_preview').attr("src", e.target.result);
                }

                read.readAsDataURL(this.files[0]);
            });

            $('#defect_image_two').change(function() {
                var read = new FileReader();

                read.onload = function(e) {
                    $('#image_preview_two').attr("style", "width:40%");
                    $('#image_preview_two').attr("src", e.target.result);
                }

                read.readAsDataURL(this.files[0]);
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