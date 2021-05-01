<?php
session_start();
//import HTML header section

include_once('../../inc/header.php');

if (isset($_SESSION['userId']) && ($_SESSION['user_role'] == 1 || $_SESSION['user_role'] == 3)) {

    include_once('../../inc/sidenav.php');

?>
    <br>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Product Diagnosis</a></li>
            <li class="breadcrumb-item active">Check Product Diagnosis</li>
        </ol>
    </div>

    <div class="col-md-12">
        <div class="jumbotron">
            <h1 class="display-5" align="center">Product Defect Diagnosis Terminal&nbsp;&nbsp;<i class="fas fa-laptop-code fa-1x"></i></h1>
            <br>
            <hr class="display-4">
            <br>
            <div class="row">
                <div class="col-md-4">
                    <div class="wrapper" id="wrapper">
                        <div id="image-set-scroll-section">
                            <?php
                            include_once('../../functions/productDefectDiagnosis.php');
                            getProdDiag();
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="wrapper" id="wrapper">
                        <div id="loaded-images-scroll-section">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="selected-image">
                        <img id="main-image" src="../../../img/noimage.png" alt="Images3">
                    </div>
                </div>
            </div>
            <br>
            <hr class="display-4">
            <br><br>

            <!-- Other information -->

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>
                            <h6>Initial product defect diagnosis</h6>
                        </label>
                        <textarea class="form-control" id="inital_diagnosis_statement" rows="2" disabled></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>
                            <h6>Initial Customer statement</h6>
                        </label>
                        <textarea class="form-control" id="initial_customer_statement" rows="2" disabled></textarea>
                    </div>
                </div>
            </div>
            <br>

            <!-- Auto detect or just a small AI to suggest defects based on our inputs -->


            <div class="form-group">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <h6>Final product defect diagnosis may include*,</h6>
                        <br>
                        <div style="margin-left: 5%;">
                            <h6># Higher current flow in the rotor fan</h6>
                            <h6># Rotor fan malfunctioning</h6>
                            <h6># Grinding motor has unpassed substances (Chamber blocking)</h6>
                        </div>
                        <label style="color: rgb(184, 20, 20);">*This analysis is not the final result. Further manual inspections are required to finalize defects</label>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
            <br>
            <div class="form-group">
                <label>
                    <h6>Final product defect diagnosis</h6>
                </label>
                <textarea class="form-control" id="final_diagnosis" rows="3" placeholder="Enter final product diagnosis statement.."></textarea>
                <br><br>
                <div class="row">
                    <div class="col-md-4">
                        <label>
                            <h6>Is the product still under warranty?</h6>
                        </label>
                        <div class="form-group">
                            <select class="custom-select" name="warranty_status" id="warranty_status">
                                <option value="" selected="">-- Select Warranty Status --</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>
                            <h6>Eligible for..</h6>
                        </label>
                        <div class="form-group">
                            <select class="custom-select" name="prod_eligibility" id="prod_eligibility">
                                <option selected="">-- Select Eligibility --</option>
                                <option value="repair">Repairs**</option>
                                <option value="onetonereplacement">One-to-one replacement</option>
                            </select>
                        </div>
                        <div class="form-group" id="show_tb" style="display: none;">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rs</span>
                                    </div>
                                    <input type="number" class="form-control" placeholder="Enter Repair Cost" name="repair_cost" id="repair_cost">
                                    <div class="input-group-append">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>
                            <h6>Product Condition :</h6>
                        </label>
                        <div class="form-group">
                            <select class="custom-select" name="prod_condition" id="prod_condition">
                                <option selected="">-- Select Product Condition --</option>
                                <option value="weak">Weak</option>
                                <option value="moderate">Moderate</option>
                                <option value="excellent">Excellent</option>
                            </select>
                        </div>
                    </div>
                </div>
                <br>
                <label style="color: rgb(184, 20, 20);">**Repair charges are not covered by this industry. Charges may vary</label>
                <div class="form-group">
                    <div style="text-align:right;">
                        <button id="save_diagnosis_btn" class="btn btn-primary" onclick="return false" style="margin:5px;"><i class="fas fa-check-double"></i>&nbsp;&nbsp;Finalize Product Diagnosis</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            var prod_diag_id = '';

            $("#prod_eligibility").change(function() {
                var value = $("#prod_eligibility").val();

                if (value == 'repair') {
                    $("#show_tb").show();
                } else {
                    $("#show_tb").hide();
                }
            });

            $("#repair_cost").keyup(function() {
                var tb_val = $(this).val();

                if (tb_val < 0) {
                    $("#repair_cost").val('');
                }
            });

            $("#repair_cost").change(function() {
                var tb_val = $(this).val();

                if (tb_val < 0) {
                    $("#repair_cost").val('');
                }
            });

            $(".btn-load-img").click(function() {

                prod_diag_id = $(this).attr('id');

                $.when(
                    $.get("../../route/productDefectDiagnosis/getDiagnosisbyID.php", {
                        id: prod_diag_id
                    }, function(data) {
                        var jdata = jQuery.parseJSON(data);
                        $("#inital_diagnosis_statement").val(jdata.inital_d_statement);
                        $("#initial_customer_statement").val(jdata.cus_statement);
                        $("#main-image").attr('src', '../../../img/noimage.png');
                    })
                ).then(function() {
                    $.get("../../route/productDefectDiagnosis/getImagesbyId.php", {
                        id: prod_diag_id
                    }, function(data) {
                        $("#loaded-images-scroll-section").html(data);
                        $("#loaded_img_one").click(function() {
                            var imgUrl = $(this).attr('src');
                            $("#main-image").attr("src", imgUrl);
                        });

                        $("#loaded_img_two").click(function() {
                            var imgUrl = $(this).attr('src');
                            $("#main-image").attr("src", imgUrl);
                        });

                    });
                });
            });

            $("#save_diagnosis_btn").click(function() {

                var inital_diagnosis_statement = $("#inital_diagnosis_statement").val();
                var initial_customer_statement = $("#initial_customer_statement").val();

                var warranty_status = $("#warranty_status").val();
                var prod_eligibility = $("#prod_eligibility").val();
                var prod_condition = $("#prod_condition").val();
                var final_diagnosis = $("#final_diagnosis").val();

                if (warranty_status == '' || prod_eligibility == '' || prod_condition == '') {
                    swal("Check selected options!", "Please select values for Warranty Status / Warranty Eligibilty / Product Condition!", "warning");
                } else {

                    if (prod_eligibility == 'repair') {

                        var repaircost = $("#repair_cost").val();

                        if (repaircost == '') {
                            swal("Please fill Repair Cost!", "Please fill in the repair cost to proceed!", "warning");
                        } else {
                            $.post("../../route/productDefectDiagnosis/finalizeDiagnosis.php", {
                                id: prod_diag_id,
                                warranty_status: warranty_status,
                                prod_eligibility: prod_eligibility,
                                prod_condition: prod_condition,
                                final_diagnosis: final_diagnosis,
                                repaircost: repaircost
                            }, function(data) {
                                if (data == 'error') {
                                    swal("Check your inputs!", "Kindly check whether all the mandatory fields have been filled out", "warning");
                                } else {
                                    $.when(
                                        window.open("./finalizedDiagnosis_pdf.php?id=" + data + "&diagid=" + prod_diag_id + "&inital_diagnosis_statement=" + inital_diagnosis_statement + "&initial_customer_statement=" + initial_customer_statement + "&warranty_status=" + warranty_status + "&prod_eligibility=" + prod_eligibility + "&repaircost=" + repaircost + "&prod_condition=" + prod_condition + "&final_diagnosis=" + final_diagnosis + "&/", "_blank")
                                    ).then(function() {
                                        swal({
                                            type: 'success',
                                            title: 'New Invoice Created!',
                                            text: 'New Invoice has been successfully created!',
                                            showConfirmButton: false,
                                            timer: 2500
                                        });
                                    });
                                }
                            });
                        }
                    } else {
                        $.post("../../route/productDefectDiagnosis/finalizeDiagnosis.php", {
                            id: prod_diag_id,
                            warranty_status: warranty_status,
                            prod_eligibility: prod_eligibility,
                            prod_condition: prod_condition,
                            final_diagnosis: final_diagnosis
                        }, function(data) {
                            if (data == 'error') {
                                swal("Check your inputs!", "Kindly check whether all the mandatory fields have been filled out", "warning");
                            } else {
                                $.when(
                                    window.open("./finalizedDiagnosis_pdf.php?id=" + data + "&diagid=" + prod_diag_id + "&inital_diagnosis_statement=" + inital_diagnosis_statement + "&initial_customer_statement=" + initial_customer_statement + "&warranty_status=" + warranty_status + "&prod_eligibility=" + prod_eligibility + "&prod_condition=" + prod_condition + "&final_diagnosis=" + final_diagnosis + "&/", "_blank")
                                ).then(function() {
                                    swal({
                                        type: 'success',
                                        title: 'New Invoice Created!',
                                        text: 'New Invoice has been successfully created!',
                                        showConfirmButton: false,
                                        timer: 2500
                                    });
                                });
                            }
                        });
                    }
                }
            });

            $(".btn-delete-diag").click(function() {
                $id = $(this).attr('id');
                alert($id);
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