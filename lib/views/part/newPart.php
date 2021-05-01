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
            <li class="breadcrumb-item"><a href="#">Part</a></li>
            <li class="breadcrumb-item active">Manage Part</li>
        </ol>
    </div>

    <div class="col-md-12">
        <div class="jumbotron">
            <h1 class="display-5" style="text-align: center;">Register Part&nbsp;&nbsp;<i class="fas fa-cogs fa-1x"></i></h1>
            <hr class="my-4">

            <!-- parts registration form -->

            <form id="savePart" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="name">Part Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Ex: Handle, Nut, Spanner etc..">
                            </div>
                            <div class="col-md-6">
                                <label for="partcode">Part Code</label>
                                <input type="text" name="partcode" id="partcode" class="form-control" placeholder="Ex: Handle, Nut, Spanner etc..">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="weight">Weight</label>
                                <input type="number" name="weight" id="weight" class="form-control" placeholder="Ex: 10 mg, 50 g, 2 kg etc..">
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Unit</label>
                                    <select class="custom-select" name="unit">
                                        <option value="mg">mg</option>
                                        <option value="g">g</option>
                                        <option value="kg">kg</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="part_img">Part Image</label>
                                    <br>
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <label class="custom-file-label">Choose file</label>
                                            <input type="file" class="custom-file-input" name="part_image" id="part_image">
                                        </div>
                                    </div>
                                    <small class="form-text text-muted"><i class="fas fa-question-circle"></i>&nbsp;Please use 600x600 resolution photo</small>
                                    <img id="prt_image" src="" class="img-responsive img-rounded center-block border">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="pt_product">Part for Product :</label>
                                <select class="form-control" id="pt_product" name="pt_product">
                                    <?php
                                    include_once('../../functions/product.php');
                                    getProducts();
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div style="border-left:1px solid #dbdbdb; height:300px"></div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="3" placeholder="Ex: Part description and uses"></textarea>
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
                        <br />
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
            <h1 class="display-5" style="text-align: center;">Part Information&nbsp;&nbsp;<i class="fas fa-cogs fa-1x"></i></h1>
            <hr class="my-4">
            <br>
            <table id="allParts" class="table table-hover table-inverse table-responsive table-bordered" style="margin-top:10px; width: 100%;">
                <thead class="thead-inverse">
                    <tr>
                        <th style="min-width:80px;">Code</th>
                        <th>Image</th>
                        <th style="min-width:160px;">Name </th>
                        <th style="min-width:160px;">Product </th>
                        <th style="min-width:75px;">Weight </th>
                        <th style="min-width:100px;">Unit Price </th>
                        <th style="min-width:120px;">Reorder Level </th>
                        <th style="min-width:60px;">Status </th>
                        <th style="min-width:40px;">Edit </th>
                        <th style="min-width:40px;">Delete </th>
                    </tr>
                </thead>
                <tbody id="search_body_result">
                    <?php
                    include_once('../../functions/part.php');
                    ViewPart();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Part Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form id="editform" enctype="multipart/form-data">
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="part_id">Part ID</label>
                                <input type="text" name="part_id" id="part_id" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="pname">Part Name</label>
                                <input type="text" name="pname" id="pname" class="form-control" placeholder="Ex: Handle, Nut, Spanner etc..">
                            </div>
                            <div class="col-md-6">
                                <label for="pcode">Part Code</label>
                                <input type="text" name="pcode" id="pcode" class="form-control" placeholder="Ex: Handle, Nut, Spanner etc..">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="part_img">Part Image</label>
                                    <br>
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <label class="custom-file-label">Choose file</label>
                                            <input type="file" class="custom-file-input" name="part_pic" id="part_pic">
                                        </div>
                                    </div>
                                    <small class="form-text text-muted"><i class="fas fa-question-circle"></i>&nbsp;Please use 600x600 resolution photo</small>
                                    <img id="pt_image" src="" class="img-responsive img-rounded center-block border" style="width: 100px; height: 100px;">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="pweight">Weight</label>
                                <input type="number" name="pweight" id="pweight" class="form-control" placeholder="Ex: 10 mg, 50 g, 2 kg etc..">
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Unit</label>
                                    <select class="custom-select" name="punit" id="punit">
                                        <option value="mg">mg</option>
                                        <option value="g">g</option>
                                        <option value="kg">kg</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="pdesc">Description</label>
                                <textarea name="pdesc" id="pdesc" class="form-control" rows="2" placeholder="Ex: Part description and uses"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="ptedproduct">Part for Product :</label>
                                <select class="form-control" id="ptedproduct" name="ptedproduct">
                                    <?php
                                    include_once('../../functions/product.php');
                                    getProducts();
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="punitprice">Unit Price</label>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rs.</span>
                                            </div>
                                            <input type="number" class="form-control" name="punitprice" id="punitprice" placeholder="Ex: Rs. 40,000, Rs. 20,000 etc...">
                                            <div class="input-group-append">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="prlevel">Reorder Level</label>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <input type="number" class="form-control" name="prlevel" id="prlevel" placeholder="Ex: 10, 15 units etc...">
                                            <div class="input-group-append">
                                                <span class="input-group-text">unit(s)</span>
                                            </div>
                                        </div>
                                    </div>
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

            $("#allParts").DataTable({
                dom: 'B<"clear">lfrtip',
                "order": [
                    [0, "desc"]
                ],
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
                        title: "Udaya Industries [REPORT: PART LIST]"
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fas fa-file-csv"></i>&nbsp;Export to CSV',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        },
                        title: "Udaya Industries [REPORT: PART LIST]"
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i>&nbsp;Export to PDF',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        },
                        title: "Udaya Industries [REPORT: PART LIST]"
                    }
                ]
            });

            $("#btnSave").click(function() {

                var form = $('#savePart')[0];
                var formData = new FormData(form);

                //run ajax call
                $.ajax({
                    url: "../../route/part/newPart.php",
                    data: formData,
                    processData: false,
                    contentType: false,
                    type: 'POST',
                    success: function(data) {
                        if (data == "Success") {
                            setTimeout(() => {
                                location.reload();
                            }, 2100);
                            swal({
                                type: 'success',
                                title: 'New part added!',
                                text: 'New part has been successfully registered',
                                showConfirmButton: false,
                                timer: 2000
                            })
                        } else if (data == "ext_error") {

                            swal("Image Error!", "You can only upload either .PNG, .JPG or .GIF images!", "warning");

                        } else {

                            swal("Check your inputs!", "Kindly check whether all the mandatory fields have been filled out", "warning");
                        }
                    }
                });
            });


            $("#btn_edit").click(function() {

                var form = $('#editform')[0];
                var formData = new FormData(form);

                $.ajax({
                    url: "../../route/part/updatePart.php",
                    data: formData,
                    processData: false,
                    contentType: false,
                    type: 'POST',
                    success: (data) => {
                        if (data == "success") {
                            $('#editModal').modal('hide');
                            setTimeout(() => {
                                location.reload();
                            }, 2100);
                            swal({
                                type: 'success',
                                title: 'Part details updated!',
                                text: 'Part details have been updated successfully',
                                showConfirmButton: false,
                                timer: 2000
                            }).then((result) => {
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    $("#editModal").modal("hide");
                                }
                            });
                        } else {

                            $error_msg = "Kindly check whether all the mandatory fields have been filled out";

                            swal("Check your inputs!", $error_msg, "warning");
                        }
                    }
                });
            });

            //check edit button
            $('#allParts tbody').on('click', '.btn-primary', function() {

                $id = $(this).attr('id');

                //send ajax request to bring supplier data to view modal
                $.get("../../route/part/getsinglePart.php", {
                    id: $id
                }, function(data) {

                    var jdata = jQuery.parseJSON(data);
                    var imgdbpath = jdata.part_img_path;

                    //show json data on HTML inputs
                    $("#part_id").val(jdata.part_id);
                    $("#pname").val(jdata.part_name);
                    $("#ptedproduct").val(jdata.prod_id);
                    $("#pcode").val(jdata.part_code);

                    $('#pt_image').attr("style", "width:40%");
                    $('#pt_image').attr("src", '../../' + imgdbpath + '');

                    $("#pweight").val(jdata.part_weight);
                    $("#punit").val(jdata.part_w_unit);
                    $("#pdesc").val(jdata.part_desc);
                    $("#punitprice").val(jdata.part_unit_price);
                    $("#prlevel").val(jdata.part_reorder_level);
                });
            });

            $('#allParts tbody').on('click', '.btn-danger', function() {

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
                            $.get("../../route/part/deletePart.php", {
                                id: $trID
                            }, function(data) {
                                swal({
                                    type: 'success',
                                    title: 'Part deleted!',
                                    text: 'Part details succesfully deleted!',
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
                                text: 'Part details remain!',
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

        // image uploading script
        $('#part_image').change(function() {
            var read = new FileReader();

            read.onload = function(e) {
                $('#prt_image').attr("style", "width:40%");
                $('#prt_image').attr("src", e.target.result);
            }

            read.readAsDataURL(this.files[0]);
        });

        // image uploading script
        $('#part_pic').change(function() {
            var read = new FileReader();

            read.onload = function(e) {
                $('#pt_image').attr("style", "width:100px");
                $('#pt_image').attr("src", e.target.result);
            }

            read.readAsDataURL(this.files[0]);
        });

        //-------------------------- TEXTBOX AND BUTTON VALIDATIONS : FRONT END ------------------------------------------------

        $("#weight").keyup(function() {

            var partweight = $(this).val();

            if (partweight < 0) {
                swal("Error!", "Negative values are not allowed!", "warning");
                $("#weight").val('');
            }
        });

        $("#weight").change(function() {

            var partweight = $(this).val();

            if (partweight < 0) {
                swal("Error!", "Negative values are not allowed!", "warning");
                $("#weight").val('');
            }
        });

        $("#unitprice").keyup(function() {

            var partweight = $(this).val();

            if (partweight < 0) {
                swal("Error!", "Negative values are not allowed!", "warning");
                $("#unitprice").val('');
            }
        });

        $("#unitprice").change(function() {

            var partweight = $(this).val();

            if (partweight < 0) {
                swal("Error!", "Negative values are not allowed!", "warning");
                $("#unitprice").val('');
            }
        });

        $("#reorderlevel").keyup(function() {

            var partweight = $(this).val();

            if (partweight < 0) {
                swal("Error!", "Negative values are not allowed!", "warning");
                $("#reorderlevel").val('');
            }
        });

        $("#reorderlevel").change(function() {

            var partweight = $(this).val();

            if (partweight < 0) {
                swal("Error!", "Negative values are not allowed!", "warning");
                $("#reorderlevel").val('');
            }
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