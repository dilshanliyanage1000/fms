<?php

include_once('lib/inc/attendance_header.php');

?>

<div class="col-md-12">
    <div class="jumbotron">
        <h1 class="display-5" style="text-align: center;"><i class="fas fa-check-double fa-1x"></i>&nbsp;&nbsp;Mark Attendance</h1>
        <p class="lead" style="text-align: center;">Mark employee attendance details</p>
        <hr class="my-4">
        <br>
        <div class="row">
            <!-- attendance marking form -->
            <div class="col-md-5">
                <h5 style="text-align: center; margin-top:auto; margin-bottom:auto;">Select employee to mark attendance</h5>
                <br><br>
                <form id="mark_attendance">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" name="emp_number" id="emp_number" class="form-control" placeholder="Hold Employee QR Code">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-qrcode"></i></span>
                            </div>
                        </div>
                        <small id="emailHelp" class="form-text text-muted"><i class="fas fa-qrcode"></i>&nbsp;&nbsp;Hold Employee QR code onto the scanner to mark attendance</small>
                    </div>
                    <br>
                    <div style="text-align: center; margin-top:auto; margin-bottom:auto;">
                        <p class="lead">-&nbsp;OR&nbsp;-</p>
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="search" name="emp_search" id="emp_search" class="form-control" placeholder="Enter employee name or NIC">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                            </div>
                        </div>
                        <small id="emailHelp" class="form-text text-muted"><i class="fas fa-search"></i>&nbsp;&nbsp;Search by Employee name or NIC number</small>
                    </div>
                </form>
                <div id="empInfo"></div>
            </div>

            <div class="col-md-1">
                <div style="border-left:1px solid #dbdbdb; height:480px"></div>
            </div>

            <!--last marked attendance section-->

            <div class="col-md-6">
                <h5 style="text-align: center; margin-top:auto; margin-bottom:auto;">Last marked attendance</h5>
                <br><br>
                <div class="row">
                    <div class="col-md-4 col-lg-4 col-sm-4 col-xs-4">
                        <img src="lib/../img/dummy_pro_pic.jpg" alt="Dummy Profile Picture" id="load_img" style="width: 100%;" align="left">
                    </div>
                    <div class="col-md-8 col-lg-8 col-sm-8 col-xs-8">
                        <div class="input-group">
                            <fieldset disabled="">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Employee ID</span>
                                        </div>
                                        <input class="form-control" id="emp_nic" type="text" placeholder="Ex: EMP0000001, etc.." disabled />
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <br>
                        <div class="input-group">
                            <fieldset disabled="">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">First Name&nbsp;&nbsp;&nbsp;</span>
                                        </div>
                                        <input class="form-control" id="emp_fname" type="text" placeholder="Ex: John" disabled />
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <br>
                        <div class="input-group">
                            <fieldset disabled="">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Last Name&nbsp;&nbsp;&nbsp;</span>
                                        </div>
                                        <input class="form-control" id="emp_lname" type="text" placeholder="Ex: Appleseed" disabled />
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
                <br>
                <div id="marked" style="display: none; width:100%;">
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong>Attandance Marked Successfully</strong>
                    </div>
                </div>
                <div id="checkedout" style="display: none; width:100%;">
                    <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong>Employee checked out.. Status Marked Successfully</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Page scripts -->

<script>
    $(document).ready(function() {

        function disableSearch() {

            document.getElementById('emp_number').disabled = true;
            document.getElementById('emp_search').disabled = true;

            setTimeout(function() {
                document.getElementById('emp_number').disabled = false;
                document.getElementById('emp_search').disabled = false;
            }, 10000);

            setTimeout(function() {
                location.reload();
            }, 10050);

            return true;
        };

        $("#emp_number").change(function() {

            var employeeID = $("#emp_number").val();

            if (employeeID.length < 10 || employeeID.length > 10) {

            } else if (employeeID.length == 10) {
                $.get("lib/route/attendance/fetchEmpResult.php", {
                    id: employeeID
                }, function(data) {

                    var jdata = jQuery.parseJSON(data);

                    $("#emp_fname").val(jdata.emp_fname);
                    $("#emp_lname").val(jdata.emp_lname);
                    $("#emp_nic").val(jdata.emp_nic);
                    $("#load_img").attr('src', 'lib/' + jdata.emp_img_path);

                    $("#emp_search").val("");

                    $.post("lib/route/attendance/markAttendance.php", {
                        data: employeeID
                    }, function(data) {
                        if (data == "success") {
                            disableSearch();
                            $("#marked").show();
                            $("#checkedout").hide();
                            $("#emp_search").val('');
                            $("#emp_number").val('');
                        } else if (data == "loggedout") {
                            disableSearch();
                            $("#checkedout").show();
                            $("#marked").hide();
                            $("#emp_search").val('');
                            $("#emp_number").val('');
                        } else {
                            $("#marked").hide();
                            $("#checkedout").hide();
                            $("#emp_search").val('');
                            $("#emp_number").val('');
                        }
                    })
                });
            }
        });


        $("#emp_search").keyup(function() {
            var searchVal = $(this).val();

            if (searchVal.length < 1) {
                $("#empInfo").hide();
            } else {
                $.get("lib/route/attendance/searchEmp.php", {
                    data: searchVal
                }, function(data) {
                    $("#empInfo").show();
                    $("#empInfo").html(data);

                    $(".btn-success").click(function() {

                        var empId = $(this).attr('id');

                        $("#emp_number").val(empId);
                        $("#empInfo").hide();

                        //send ajax request to confirm request

                        $.get("lib/route/attendance/fetchEmpResult.php", {
                            id: empId
                        }, function(data) {

                            var jdata = jQuery.parseJSON(data);

                            $("#emp_fname").val(jdata.emp_fname);
                            $("#emp_lname").val(jdata.emp_lname);
                            $("#emp_nic").val(jdata.emp_nic);
                            $("#load_img").attr('src', 'lib/' + jdata.emp_img_path);

                            $("#emp_search").val("");
                        });

                        $.post("lib/route/attendance/markAttendance.php", {
                            data: empId
                        }, function(data) {
                            if (data == "success") {
                                disableSearch();
                                $("#marked").show();
                                $("#checkedout").hide();
                            } else if (data == "loggedout") {
                                disableSearch();
                                $("#checkedout").show();
                                $("#marked").hide();
                            } else {
                                $("#marked").hide();
                                $("#checkedout").hide();
                            }
                        })

                    });
                });
            }
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