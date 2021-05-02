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
            <li class="breadcrumb-item"><a href="#">Vehicle</a></li>
            <li class="breadcrumb-item active">Register Vehicle</li>
        </ol>
    </div>

    <br>

    <div class="col-md-12">
        <div class="jumbotron">
            <h1 class="display-5" style="text-align: center;"><i class="fas fa-truck"></i>&nbsp;&nbsp;Register Vehicle</h1>
            <br>
            <hr class="my-4">

            <!-- Vehicle registration form -->

            <div class="row">
                <div class="col-md-4">
                    <img src="../../../img/english_plate.png" alt="English Number Plate" style="width: 100%;">
                </div>
                <div class="col-md-4">
                    <img src="../../../img/dash_plate.png" alt="Dash (-) Number Plate" style="width: 100%;">
                </div>
                <div class="col-md-4">
                    <img src="../../../img/sri_plate.png" alt="Sri (ශ්‍රී) Number Plate" style="width: 100%;">
                </div>
            </div>

            </br>

            <div class="row">
                <div class="col-md-4">
                    <button type="button" class="btn btn-dark btn-block" id="eng_plate">ENG Number Plate</button>
                </div>
                <div class="col-md-4">
                    <button type="button" class="btn btn-dark btn-block" id="dash_plate">Dash Number Plate</button>
                </div>
                <div class="col-md-4">
                    <button type="button" class="btn btn-dark btn-block" id="sri_plate">Sri (ශ්‍රී) Number Plate</button>
                </div>
            </div>

            </br></br>

            <div id="eng_plate_form" style="display: none; color: green;">
                <form id="saveEngVehicle">
                    <div class="form-group">
                        <h5 class="lead" style="color: green;">English Number Plate Information</h5>
                        <hr class="my-4">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="vehicle_province">Province</label>
                                        <select name="vehicle_province" id="vehicle_province" class="form-control">
                                            <option value="" selected>---</option>
                                            <option value="CP">CP</option>
                                            <option value="EP">EP</option>
                                            <option value="NC">NC</option>
                                            <option value="NP">NP</option>
                                            <option value="NW">NW</option>
                                            <option value="SG">SG</option>
                                            <option value="SP">SP</option>
                                            <option value="UP">UP</option>
                                            <option value="WP">WP</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="reg_letters">Registered Letters</label>
                                        <input type="text" name="reg_letters" id="reg_letters" class="form-control" placeholder="Ex: NC, FJ etc.." maxlength="3">
                                        <p style="color: orange; display: none;" id="invalid_eng" class="form-text"><i class="fas fa-exclamation-circle"></i>&nbsp;Only maximum of 3 English letters allowed!</p>
                                        <p style="color: #39d453; display: none;" id="valid_eng" class="form-text"><i class="far fa-check-circle"></i>&nbsp;Valid English Plate!</p>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="reg_numbers">Registered Numbers</label>
                                        <input type="number" name="reg_numbers" id="reg_numbers" class="form-control" placeholder="Ex: 2563, 7485 etc..">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div style="border-left:1px solid #dbdbdb; height:300px"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="vehicle_brand">Vehicle Brand</label>
                                        <input type="text" name="vehicle_brand" id="vehicle_brand" class="form-control" placeholder="Ex: Isuzu, Tata etc..">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="vehicle_model">Model</label>
                                        <input type="text" name="vehicle_model" id="vehicle_model" class="form-control" placeholder="Ex: Mono, Lorry+ etc..">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="category">Vehicle Category</label>
                                        <select name="category" id="category" class="form-control">
                                            <option value="">-- Choose Category --</option>
                                            <option value="Lorry">Lorry</option>
                                            <option value="Container">Container</option>
                                            <option value="Buddy Lorry">Buddy Lorry</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="vehicle_description">Vehicle Description</label>
                                        <textarea name="vehicle_description" id="vehicle_description" class="form-control" rows="3" placeholder="Ex: Vehicle description and details"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" align="right">
                            <button class="btn btn-warning" type="reset" style="margin:5px;"><i class="fas fa-minus-circle"></i>&nbsp;&nbsp;Clear</button>
                            <button id="saveEngBtn" class="btn btn-success" onclick="return false" style="margin:5px;"><i class="fas fa-save"></i>&nbsp;&nbsp;Save details</button>
                        </div>
                    </div>
                </form>
            </div>

            <div id="dash_plate_form" style="display: none; color: #e6a800;">
                <form id="saveDashVehicle">
                    <div class="form-group">
                        <h5 class="lead" style="color: #e6a800;">Dash Number Plate Information</h5>
                        <hr class="my-4">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="vin_number">Vehicle Identification Number</label>
                                        <input type="number" name="vin_number" id="vin_number" class="form-control" placeholder="Ex: 17, 40 etc..">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="regdnumbers">Registered Numbers</label>
                                        <input type="number" name="regdnumbers" id="regdnumbers" class="form-control" placeholder="Ex: 2563, 7485 etc..">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div style="border-left:1px solid #dbdbdb; height:300px"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="vehicledbrand">Vehicle Brand</label>
                                        <input type="text" name="vehicledbrand" id="vehicledbrand" class="form-control" placeholder="Ex: Isuzu, Tata etc..">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="vehicledmodel">Model</label>
                                        <input type="text" name="vehicledmodel" id="vehicledmodel" class="form-control" placeholder="Ex: Mono, Lorry+ etc..">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="d_category">Vehicle Category</label>
                                        <select name="d_category" id="d_category" class="form-control">
                                            <option value="">-- Choose Category --</option>
                                            <option value="Lorry">Lorry</option>
                                            <option value="Container">Container</option>
                                            <option value="Buddy Lorry">Buddy Lorry</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="d_vehicle_description">Vehicle Description</label>
                                        <textarea name="d_vehicle_description" id="d_vehicle_description" class="form-control" rows="3" placeholder="Ex: Vehicle description and details"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" align="right">
                            <button class="btn btn-warning" type="reset" style="margin:5px;"><i class="fas fa-minus-circle"></i>&nbsp;&nbsp;Clear</button>
                            <button id="saveDashBtn" class="btn btn-success" onclick="return false" style="margin:5px;"><i class="fas fa-save"></i>&nbsp;&nbsp;Save details</button>
                        </div>
                    </div>
                </form>
            </div>

            <div id="sri_plate_form" style="display: none; color: brown;">
                <form id="saveSriVehicle">
                    <div class="form-group">
                        <h5 class="lead" style="color: brown;">Sri (ශ්‍රී) Number Plate Information</h5>
                        <hr class="my-4">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="s_vin_number">Vehicle Identification Number</label>
                                        <input type="number" name="s_vin_number" id="s_vin_number" class="form-control" placeholder="Ex: 17, 40 etc..">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="regsrinumbers">Registered Numbers</label>
                                        <input type="number" name="regsrinumbers" id="regsrinumbers" class="form-control" placeholder="Ex: 2563, 7485 etc..">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div style="border-left:1px solid #dbdbdb; height:300px"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="s_vehicle_brand">Vehicle Brand</label>
                                        <input type="text" name="s_vehicle_brand" id="s_vehicle_brand" class="form-control" placeholder="Ex: Isuzu, Tata etc..">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="s_vehicle_model">Model</label>
                                        <input type="text" name="s_vehicle_model" id="s_vehicle_model" class="form-control" placeholder="Ex: Mono, Lorry+ etc..">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="s_category">Vehicle Category</label>
                                        <select name="s_category" id="s_category" class="form-control">
                                            <option value="">-- Choose Category --</option>
                                            <option value="Lorry">Lorry</option>
                                            <option value="Container">Container</option>
                                            <option value="Buddy Lorry">Buddy Lorry</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="s_vehicle_description">Vehicle Description</label>
                                        <textarea name="s_vehicle_description" id="s_vehicle_description" class="form-control" rows="3" placeholder="Ex: Vehicle description and details"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" align="right">
                            <button class="btn btn-warning" type="reset" style="margin:5px;"><i class="fas fa-minus-circle"></i>&nbsp;&nbsp;Clear</button>
                            <button id="saveSriBtn" class="btn btn-success" onclick="return false" style="margin:5px;"><i class="fas fa-save"></i>&nbsp;&nbsp;Save details</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="jumbotron">
            <h1 class="display-5" style="text-align: center;"><i class="fas fa-truck"></i>&nbsp;&nbsp;Vehicle Information</h1>
            <hr class="my-4">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#vehicleList">All Vehicles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#deletedVehicleList">Deleted Vehicles</a>
                </li>
            </ul>
            <br>
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade show active" id="vehicleList">
                    <table id="allVehicles" class="table table-hover table-inverse table-responsive table-bordered" style="margin-top:10px;">
                        <thead class="thead-inverse">
                            <tr>
                                <th style="width: 100px;">Vehicle ID </th>
                                <th style="width: 300px;">ENG Number Plate </th>
                                <th style="width: 300px;">Dash / Sri Plate </th>
                                <th style="width: 200px;">Brand </th>
                                <th style="width: 100px;">Model </th>
                                <th style="width: 100px;">Category </th>
                                <th style="width: 300px;">Description </th>
                                <th style="width: 40px;">Status </th>
                                <th style="width: 40px;">Edit </th>
                                <th style="width: 40px;">Delete </th>
                            </tr>
                        </thead>
                        <tbody id="search_body_result">
                            <?php
                            include_once('../../functions/vehicle.php');
                            ViewAllVehicles();
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="deletedVehicleList">
                    <table id="allDeletedVehicles" class="table table-hover table-inverse table-responsive table-bordered" style="margin-top:10px;">
                        <thead class="thead-inverse">
                            <tr>
                                <th style="width: 100px;">Vehicle ID </th>
                                <th style="width: 300px;">ENG Number Plate </th>
                                <th style="width: 300px;">Dash / Sri Plate </th>
                                <th style="width: 200px;">Brand </th>
                                <th style="width: 100px;">Model </th>
                                <th style="width: 100px;">Category </th>
                                <th style="width: 300px;">Description </th>
                                <th style="width: 40px;">Status </th>
                                <th style="width: 40px;">Delete </th>
                            </tr>
                        </thead>
                        <tbody id="search_body_result">
                            <?php
                            include_once('../../functions/vehicle.php');
                            ViewDeletedVehicles();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Product Part Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editVehicleForm">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="vehicleID">Vehicle ID</label>
                                    <input type="text" name="vehicleID" id="vehicleID" class="form-control" disabled>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="e_province">Province</label>
                                    <select name="e_province" id="e_province" class="form-control">
                                        <option value="" selected>---</option>
                                        <option value="CP">CP</option>
                                        <option value="EP">EP</option>
                                        <option value="NC">NC</option>
                                        <option value="NP">NP</option>
                                        <option value="NW">NW</option>
                                        <option value="SG">SG</option>
                                        <option value="SP">SP</option>
                                        <option value="UP">UP</option>
                                        <option value="WP">WP</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="e_regletters">Registered Letters</label>
                                    <input type="text" name="e_regletters" id="e_regletters" class="form-control" placeholder="Ex: NC, FJ etc.." maxlength="3">
                                    <p style="color: orange; display: none;" id="" class="form-text"><i class="fas fa-exclamation-circle"></i>&nbsp;Only maximum of 3 English letters allowed!</p>
                                    <p style="color: #39d453; display: none;" id="" class="form-text"><i class="far fa-check-circle"></i>&nbsp;Valid English Plate!</p>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="e_vin">Vehicle Identification Number</label>
                                    <input type="number" name="e_vin" id="e_vin" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="e_regnumbers">Registered Numbers</label>
                                    <input type="number" name="e_regnumbers" id="e_regnumbers" class="form-control">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="e_brand">Vehicle Brand</label>
                                    <input type="text" name="e_brand" id="e_brand" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="d_vehicle_model">Model</label>
                                    <input type="text" name="e_vehiclemodel" id="e_vehiclemodel" class="form-control">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="e_category">Vehicle Category</label>
                                    <select name="e_category" id="e_category" class="form-control">
                                        <option value="">-- Choose Category --</option>
                                        <option value="Lorry">Lorry</option>
                                        <option value="Container">Container</option>
                                        <option value="Buddy Lorry">Buddy Lorry</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="e_desc">Vehicle Description</label>
                                    <textarea name="e_desc" id="e_desc" class="form-control" rows="2"></textarea>
                                </div>
                            </div>
                            <br>
                            <div class="form-group" align="right">
                                <button class="btn btn-warning" type="reset" style="margin:5px;"><i class="fas fa-minus-circle"></i>&nbsp;&nbsp;Clear</button>
                                <button id="editBtn" class="btn btn-success" onclick="return false" style="margin:5px;"><i class="fas fa-save"></i>&nbsp;&nbsp;Save details</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            $("#allVehicles").DataTable({
                dom: 'B<"clear">lfrtip',
                "order": [
                    [0, "desc"]
                ],
                buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="fas fa-copy"></i>&nbsp;Copy to Clipboard',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i>&nbsp;Export to Excel',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6]
                        },
                        title: "Udaya Industries [REPORT: VEHICLE LIST]"
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fas fa-file-csv"></i>&nbsp;Export to CSV',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6]
                        },
                        title: "Udaya Industries [REPORT: VEHICLE LIST]"
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i>&nbsp;Export to PDF',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6]
                        },
                        title: "Udaya Industries [REPORT: VEHICLE LIST]"
                    }
                ]
            });

            $("#allDeletedVehicles").DataTable({
                dom: 'B<"clear">lfrtip',
                "order": [
                    [0, "desc"]
                ],
                buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="fas fa-copy"></i>&nbsp;Copy to Clipboard',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i>&nbsp;Export to Excel',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6]
                        },
                        title: "Udaya Industries [REPORT: DELETED VEHICLE LIST]"
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fas fa-file-csv"></i>&nbsp;Export to CSV',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6]
                        },
                        title: "Udaya Industries [REPORT: DELETED VEHICLE LIST]"
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i>&nbsp;Export to PDF',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6]
                        },
                        title: "Udaya Industries [REPORT: DELETED VEHICLE LIST]"
                    }
                ]
            });

            $("#eng_plate").click(function() {
                $("#eng_plate_form").show();
                $("#dash_plate_form").hide();
                $("#sri_plate_form").hide();
            })

            $("#dash_plate").click(function() {
                $("#eng_plate_form").hide();
                $("#dash_plate_form").show();
                $("#sri_plate_form").hide();
            })

            $("#sri_plate").click(function() {
                $("#eng_plate_form").hide();
                $("#dash_plate_form").hide();
                $("#sri_plate_form").show();
            })


            $('#allVehicles tbody').on('click', '.btn-primary', function() {

                $id = $(this).attr('id');

                $.get("../../route/vehicle/getsingleVehicle.php", {
                    id: $id
                }, function(data) {

                    var jdata = jQuery.parseJSON(data);

                    var vechicleid = jdata.vehicle_id;
                    var platetype = jdata.v_plate_type;
                    var plateidentifier = jdata.v_plate_identifier;
                    var province = jdata.v_province;
                    var regletters = jdata.v_reg_letters;
                    var vin = jdata.v_i_number;
                    var regnumber = jdata.v_reg_number;
                    var oldregnumber = jdata.v_old_reg_no;
                    var brand = jdata.v_brand;
                    var model = jdata.v_model;
                    var category = jdata.v_category;
                    var description = jdata.v_description;

                    if (platetype == 'ENG') {

                        $("#vehicleID").val(vechicleid);
                        $("#e_province").val(province);
                        $("#e_regletters").val(regletters);
                        $("#e_regnumbers").val(regnumber);
                        $("#e_brand").val(brand);
                        $("#e_vehiclemodel").val(model);
                        $("#e_category").val(category);
                        $("#e_desc").val(description);

                        document.getElementById('e_province').disabled = false;
                        document.getElementById('e_regletters').disabled = false;
                        document.getElementById('e_vin').disabled = true;

                    } else if (platetype == 'Dash') {

                        $("#vehicleID").val(vechicleid);
                        $("#e_vin").val(vin);
                        $("#e_regletters").val(regletters);
                        $("#e_regnumbers").val(oldregnumber);
                        $("#e_brand").val(brand);
                        $("#e_vehiclemodel").val(model);
                        $("#e_category").val(category);
                        $("#e_desc").val(description);

                        document.getElementById('e_province').disabled = true;
                        document.getElementById('e_regletters').disabled = true;
                        document.getElementById('e_vin').disabled = false;

                    } else if (platetype == 'Sri') {

                        $("#vehicleID").val(vechicleid);
                        $("#e_vin").val(vin);
                        $("#e_regletters").val(regletters);
                        $("#e_regnumbers").val(oldregnumber);
                        $("#e_brand").val(brand);
                        $("#e_vehiclemodel").val(model);
                        $("#e_category").val(category);
                        $("#e_desc").val(description);

                        document.getElementById('e_province').disabled = true;
                        document.getElementById('e_regletters').disabled = true;
                        document.getElementById('e_vin').disabled = false;

                    }

                })
            });

            $("#editBtn").click(function() {

                $id = $("#vehicleID").val();
                $provincename = $("#e_province").val();
                $regiletter = $("#e_regletters").val();
                $vinno = $("#e_vin").val();
                $regisnumber = $("#e_regnumbers").val();
                $vehiclebrand = $("#e_brand").val();
                $vechiclemodel = $("#e_vehiclemodel").val();
                $vechiclecategory = $("#e_category").val();
                $vechicledesc = $("#e_desc").val();

                $.post("../../route/vehicle/updateVehicle.php", {
                    vechicleid: $id,
                    province: $provincename,
                    regletters: $regiletter,
                    vin: $vinno,
                    regnumber: $regisnumber,
                    brand: $vehiclebrand,
                    model: $vechiclemodel,
                    category: $vechiclecategory,
                    description: $vechicledesc,

                }, function(data) {

                    if (data == "success") {
                        $('#editModal').modal('hide');
                        setTimeout(() => {
                            location.reload();
                        }, 2100);
                        swal({
                            type: 'success',
                            title: 'Vehicle Updated!',
                            text: 'New vehicle has been updated successfully!',
                            showConfirmButton: false,
                            timer: 2000
                        }).then((result) => {
                            if (result.dismiss === Swal.DismissReason.timer) {
                                $("#new_reminder").modal("hide");
                            }
                        });
                    } else {

                        $error_msg = "Kindly check whether all the mandatory fields have been filled out";

                        swal("Check your inputs!", $error_msg, "warning");
                    }
                })
            });


            $('#allVehicles tbody').on('click', '.btn-danger', function() {

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
                            $.get("../../route/vehicle/deleteVehicle.php", {
                                id: $trID
                            }, function(data) {
                                setTimeout(() => {
                                    location.reload();
                                }, 2100);
                                swal({
                                    type: 'success',
                                    title: 'Vehicle deleted!',
                                    text: 'Vehicle details succesfully deleted!',
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            });
                        } else {
                            swal({
                                type: 'warning',
                                title: 'Cancelled!',
                                text: 'Vehicle details remain!',
                                showConfirmButton: false,
                                timer: 2000
                            });
                        }
                    });
            });

            $('#allDeletedVehicles tbody').on('click', '.btn-reactivate', function() {

                this.click;
                $trID = $(this).attr('id');

                swal({
                        title: "Reactivate Vehicle : " + $trID + "?",
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
                            $.get("../../route/vehicle/reactivate_vehicle.php", {
                                id: $trID
                            }, function(data) {
                                setTimeout(() => {
                                    location.reload();
                                }, 2050);
                                swal({
                                    type: 'success',
                                    title: 'Vehicle Reactivated!',
                                    text: 'Vehicle details succesfully restored!',
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            });
                        } else {
                            swal({
                                type: 'warning',
                                title: 'Cancelled!',
                                text: 'Vehicle details remain deleted!',
                                showConfirmButton: false,
                                timer: 2000
                            });
                        }
                    });
            });

            $("#saveEngBtn").click(function() {
                $.ajax({
                    url: "../../route/vehicle/newEngVehicle.php",
                    type: "POST",
                    data: $("#saveEngVehicle").serialize(),
                    success: function(data) {
                        if (data == "success") {
                            setTimeout(() => {
                                location.reload();
                            }, 2100);
                            swal({
                                type: 'success',
                                title: 'New vehicle added!',
                                text: 'New vehicle has been successfully registered',
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

            $("#saveDashBtn").click(function() {
                $.ajax({
                    url: "../../route/vehicle/newDashVehicle.php",
                    type: "POST",
                    data: $("#saveDashVehicle").serialize(),
                    success: function(data) {
                        if (data == "success") {
                            setTimeout(() => {
                                location.reload();
                            }, 2100);
                            swal({
                                type: 'success',
                                title: 'New vehicle added!',
                                text: 'New vehicle has been successfully registered',
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

            $("#saveSriBtn").click(function() {
                $.ajax({
                    url: "../../route/vehicle/newSriVehicle.php",
                    type: "POST",
                    data: $("#saveSriVehicle").serialize(),
                    success: function(data) {
                        if (data == "success") {
                            setTimeout(() => {
                                location.reload();
                            }, 2100);
                            swal({
                                type: 'success',
                                title: 'New vehicle added!',
                                text: 'New vehicle has been successfully registered',
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