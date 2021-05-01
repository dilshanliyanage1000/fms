<?php
session_start();
//import HTML header section

date_default_timezone_set('Asia/Colombo');

include_once('../../inc/header.php');

if (isset($_SESSION['userId']) && $_SESSION['user_role'] == 1) {

    include_once('../../inc/sidenav.php');

?>
    <br>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Attendance</a></li>
            <li class="breadcrumb-item active">Salary Report</li>
        </ol>
    </div>

    <div class="col-md-12">
        <div class="jumbotron">
            <h1 class="display-5">Salary Report&nbsp;&nbsp;<i class="fas fa-check-double fa-1x"></i></h1>
            <p class="lead">Generate employee based salary report</p>
            <hr class="my-4">
            <br>

            <!-- attendance marking form -->
            <h5>Please select employee along with month/year to generate their respective salary report</h5>
            <br><br>
            <form id="mark_attendance">
                <div class="row form-group">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="emp_search">Select Employee :</label>
                            <div class="input-group">
                                <input type="search" name="emp_search" id="emp_search" class="form-control" placeholder="Enter any employee detail">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="empInfo"></div>
            </form>
            <br>
            <form id="report_gen" style="display: none;">
                <div class="jumbotron" style="background-color: white;">
                    <h4 align="center">Salary Report for Employees</h4>
                    <br>
                    <p class="lead">Employee Details</p>
                    <hr class="my-4">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <fieldset disabled="">
                                    <label class="control-label" for="disabledInput">Employee ID :</label>
                                    <input class="form-control" type="text" placeholder="Employee ID" id="emp_id" disabled="" />
                                </fieldset>
                            </div>
                            <br />
                            <div class="form-group">
                                <fieldset disabled="">
                                    <label class="control-label" for="disabledInput">Employee NIC :</label>
                                    <input class="form-control" type="text" placeholder="Employee NIC" id="emp_nic" disabled="" />
                                </fieldset>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <fieldset disabled="">
                                    <label class="control-label" for="disabledInput">Name :</label>
                                    <input class="form-control" type="text" placeholder="Employee Name" id="emp_name" disabled="" />
                                </fieldset>
                            </div>
                            <br />
                            <div class="form-group">
                                <label class="control-label">Pick Month & Year :</label>
                                <input type="text" maxlength="7" placeholder="Click to choose month & year" style="cursor: pointer; background: #fff; color:#6e6e6e; padding: 5px 10px; border: 1px solid #ccc; width: 100%; border-radius: 5px;" id="datepicker" name="datepicker" class="monthPicker" />
                            </div>
                            <br />
                            <div class="form-group" align="right">
                                <button class="btn btn-info" onclick="return false" id="gen_workhours"><i class="fas fa-sync"></i>&nbsp;&nbsp;Generate Worked Hours</button>
                            </div>
                        </div>
                        <div class="col-md-1" id="border1" style="display: none;">
                            <div align="center" style="border-left:1px solid #dbdbdb; height:250px"></div>
                        </div>
                        <div class="col-md-3" id="section2" style="display: none;">
                            <div class="form-group">
                                <fieldset disabled="">
                                    <label class="control-label" for="jbrole">Jobrole :</label>
                                    <input class="form-control" type="text" placeholder="Employee Jobrole" id="jbrole" name="jbrole" disabled="" />
                                </fieldset>
                            </div>
                            <br />
                            <div class="form-group">
                                <fieldset disabled="">
                                    <label class="control-label" for="ewhours">Total Work Hours :</label>
                                    <input class="form-control" type="text" placeholder="Total Worked Hours" id="ewhours" name="ewhours" disabled="" />
                                </fieldset>
                            </div>
                            <br />
                            <div class="form-group" align="right">
                                <button class="btn btn-info" onclick="return false" id="proceed_btn"><i class="far fa-arrow-alt-circle-down"></i>&nbsp;&nbsp;Proceed</button>
                            </div>
                        </div>
                    </div>
                    <h6 id="cannot_gen_report" style="color: red; display: none;"><i class="fas fa-times-circle"></i>&nbsp;&nbsp;No Work Hours to generate report</h6>
                </div>
                <br>
                <div id="section3" style="display: none;">
                    <div class="jumbotron" style="background-color: white;">
                        <h5>Salary Details</h5>
                        <hr class="my-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Work Hours :</label>
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <input type="number" id="work_hours" name="work_hours" class="form-control" disabled>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">hour(s)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <button type="button" class="btn btn-primary"><i class="far fa-edit"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">OT Hours :</label>
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <input type="number" id="ot_hours" name="ot_hours" class="form-control" disabled>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">hour(s)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <button type="button" class="btn btn-primary"><i class="far fa-edit"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <p id="nootsalaryone" style="color: red; display: none;"><i class="far fa-times-circle"></i>&nbsp;&nbsp;No OT records found!</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Current Salary :</label>
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Rs.</span>
                                                    </div>
                                                    <input type="number" id="current_sal" name="current_sal" class="form-control">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <button type="button" class="btn btn-primary"><i class="far fa-edit"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">OT Salary :</label>
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Rs.</span>
                                                    </div>
                                                    <input type="number" id="otsalary" name="otsalary" class="form-control">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <button type="button" class="btn btn-primary"><i class="far fa-edit"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <p id="nootsalarytwo" style="color: red; display: none;"><i class="far fa-times-circle"></i>&nbsp;&nbsp;No OT records found!</p>
                            </div>
                        </div>
                        <br><br>
                        <div class="form-group" align="right">
                            <button class="btn btn-info" onclick="return false" id="final_btn"><i class="far fa-arrow-alt-circle-down"></i>&nbsp;&nbsp;Proceed</button>
                        </div>
                    </div>
                </div>
                <br><br>
                <div id="section4" style="display: none;">
                    <div class="jumbotron" style="background-color: white;">
                        <h5>Total Salary Details</h5>
                        <hr class="my-4">
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Total Work Salary :</label>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Rs.</span>
                                                    </div>
                                                    <input type="number" id="tot_work_sal" name="tot_work_sal" class="form-control" disabled>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Total OT Salary :</label>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Rs.</span>
                                                    </div>
                                                    <input type="number" id="tot_ot_sal" name="tot_ot_sal" class="form-control" disabled>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p id="nootsalarythree" style="color: red; display: none;"><i class="far fa-times-circle"></i>&nbsp;&nbsp;No OT records found!</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Total Payroll :</label>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Rs.</span>
                                                    </div>
                                                    <input type="number" id="total_salary" name="total_salary" class="form-control" disabled>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div align="center">
                            <div id="salary_info_pill">
                                All Salary calculations will be rounded off to the nearest 10's !
                            </div>
                        </div>
                        <br>
                        <div class="form-group" align="right">
                            <button id="gen_btn" class="btn btn-primary" onclick="return false"><i class="fas fa-check-double fa-1x"></i>&nbsp;&nbsp;Generate Salary Report</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            var today_date = '';
            var monthyear = '';

            $("#border1").hide();
            $("#section2").hide();
            $("#section3").hide();
            $("#section4").hide();

            $("#gen_btn").click(function() {

                var employeeID = $("#emp_id").val();

                var employeeName = $("#emp_name").val();
                var employeeNIC = $("#emp_nic").val();
                var monthandyear = $("#datepicker").val();

                var jobrole = $('#jbrole').val();
                var empTotWorkhours = $("#ewhours").val();

                var empWorkHours = $("#work_hours").val();
                var empCurrentSal = $("#current_sal").val();

                var empOTHours = $("#ot_hours").val();
                var empOTSalary = $("#otsalary").val();

                // ------------- total salaries -----------

                var FinalWorkSal = $("#tot_work_sal").val();
                var FinalOTSal = $("#tot_ot_sal").val();

                //--- round off salaries to nearest 10 -------

                FinalWorkSal = Math.round(FinalWorkSal / 10) * 10;
                FinalOTSal = Math.round(FinalOTSal / 10) * 10;

                var FinalSalarySum = parseFloat(FinalWorkSal) + parseFloat(FinalOTSal);

                $.post("../../route/attendance/addSalaryReport.php", {
                    employeeID: employeeID,
                    monthandyear: monthandyear,
                    empTotWorkhours: empTotWorkhours,
                    empWorkHours: empWorkHours,
                    empCurrentSal: empCurrentSal,
                    empOTHours: empOTHours,
                    empOTSalary: empOTSalary,
                    FinalWorkSal: FinalWorkSal,
                    FinalOTSal: FinalOTSal,
                    FinalSalarySum: FinalSalarySum
                }, function(data) {
                    $empSalID = data;
                    $.when(
                        window.open("./salary_pdf.php?empSalID=" + data + "&employeeID=" + employeeID + "&employeeName=" + employeeName + "&employeeNIC=" + employeeNIC + "&monthandyear=" + monthandyear + "&empTotWorkhours=" + empTotWorkhours + "&empWorkHours=" + empWorkHours + "&empCurrentSal=" + empCurrentSal + "&empOTHours=" + empOTHours + "&empOTSalary=" + empOTSalary + "&FinalWorkSal=" + FinalWorkSal + "&FinalOTSal=" + FinalOTSal + "&FinalSalarySum=" + FinalSalarySum + "&/", "_blank")
                    ).then(function() {
                        setTimeout(() => {
                            window.location.href = './salary_sheets.php';
                        }, 2600);
                        swal({
                            type: 'success',
                            title: 'Salary Report Created!',
                            text: 'Salary report for employe has been created!',
                            showConfirmButton: false,
                            timer: 2500
                        });
                    });
                });
            });

            $("#datepicker").datepicker({
                format: "mm-yyyy",
                startView: "months",
                minViewMode: "months"
            });

            $("#datepicker").change(function() {
                $("#border1").hide();
                $("#section2").hide();
                $("#section3").hide();
                $("#section4").hide();
            });

            $("#emp_search").keyup(function() {

                $("#report_gen").hide();
                $("#border1").hide();
                $("#section2").hide();
                $("#section3").hide();
                $("#section4").hide();

                var searchVal = $(this).val();

                if (searchVal.length < 1) {
                    $("#empInfo").hide();
                } else {
                    $.get("../../route/attendance/searchEmp.php", {
                        data: searchVal
                    }, function(data) {
                        $("#empInfo").show();
                        $("#empInfo").html(data);

                        $(".btn-success").click(function() {

                            var empId = $(this).attr('id');

                            $("#empInfo").hide();

                            $("#emp_search").val('');

                            $.get("../../route/attendance/fetchEmpResult.php", {
                                id: empId
                            }, function(data) {

                                $("#report_gen").show();

                                var jdata = jQuery.parseJSON(data);

                                document.getElementById("emp_id").value = jdata.emp_id;
                                document.getElementById("emp_nic").value = jdata.emp_nic;
                                document.getElementById("emp_name").value = jdata.emp_fname + ' ' + jdata.emp_lname;

                            });
                        });
                    });
                }
            });

            $("#gen_workhours").click(function() {

                monthyear = $("#datepicker").val();
                var empid = $("#emp_id").val();

                $.get("../../route/attendance/salaryreportvalidation.php", {
                    id: empid,
                    monthyear: monthyear
                }, function(data) {
                    if (data == 'error') {
                        swal("This report has been already created!","Please proceed to 'Salary Sheets List' to view sheet", "warning");

                    } else if (data == 'create') {
                        if (monthyear == '') {

                            swal("Please Select Month & Date", "Please select Month & Date to proceed", "warning");

                        } else {

                            var empid = $("#emp_id").val();

                            var today_date = "<?php
                                                date_default_timezone_set('Asia/Colombo');
                                                echo date("m-Y");
                                                ?>";

                            if (monthyear > today_date) {

                                swal("Cannot Select Future Months", "Please select a valid month and year", "warning");

                            } else {

                                $("#border1").show();
                                $("#section2").show();

                                $.get("../../route/attendance/getWHours.php", {
                                    id: empid,
                                    monthyear: monthyear
                                }, function(data) {

                                    document.getElementById('proceed_btn').disabled = false;
                                    $("#cannot_gen_report").hide();

                                    $("#report_gen").show();

                                    var jdata = jQuery.parseJSON(data);

                                    var hrs = jdata.tot_hrs;

                                    var conhrs = parseFloat(hrs / 60);

                                    var fnhr = conhrs.toFixed(1);

                                    $("#jbrole").val(jdata.jobrole_name);
                                    $("#ewhours").val(fnhr);

                                    if (fnhr == 0) {
                                        document.getElementById('proceed_btn').disabled = true;
                                        $("#cannot_gen_report").show();

                                    } else {
                                        document.getElementById('proceed_btn').disabled = false;
                                        $("#cannot_gen_report").hide();

                                        $("#proceed_btn").click(function() {

                                            $("#section3").show();

                                            var fn = 0;

                                            if (fnhr > 204) {

                                                document.getElementById('otsalary').disabled = false;

                                                $("#nootsalaryone").hide();
                                                $("#nootsalarytwo").hide();
                                                $("#nootsalarythree").hide();

                                                var fn = fnhr - 204;

                                                var roundedfn = fn.toFixed(1);

                                                $("#work_hours").val(204);
                                                $("#ot_hours").val(roundedfn);

                                                $("#current_sal").val(jdata.jobrole_basicsal);
                                                $("#otsalary").val(jdata.jobrole_maxsal);

                                                $("#final_btn").click(function() {

                                                    $("#section4").show();

                                                    var whr = $("#work_hours").val();
                                                    var csal = $("#current_sal").val();

                                                    var othr = $("#ot_hours").val();
                                                    var csal = $("#otsalary").val();

                                                    var totworksal = parseFloat(whr * csal);
                                                    var tototsal = parseFloat(othr * csal);

                                                    $("#tot_work_sal").val(totworksal);
                                                    $("#tot_ot_sal").val(tototsal);

                                                    var wsal = $("#tot_work_sal").val();
                                                    var osal = $("#tot_ot_sal").val();

                                                    var totalpaysalary = parseFloat(wsal) + parseFloat(osal);

                                                    $("#total_salary").val(totalpaysalary);

                                                });

                                            } else {

                                                $("#work_hours").val(fnhr);
                                                $("#current_sal").val(jdata.jobrole_basicsal);

                                                document.getElementById('otsalary').disabled = true;

                                                $("#nootsalaryone").show();
                                                $("#nootsalarytwo").show();
                                                $("#nootsalarythree").show();

                                                $("#final_btn").click(function() {

                                                    $("#section4").show();

                                                    var whr = $("#work_hours").val();
                                                    var csal = $("#current_sal").val();

                                                    var totworksal = parseFloat(whr * csal);

                                                    $("#tot_work_sal").val(totworksal);

                                                    var osal = $("#tot_work_sal").val();

                                                    var totalpaysalary = parseFloat(osal);

                                                    $("#total_salary").val(totalpaysalary);
                                                });
                                            }
                                        });
                                    }
                                });
                            }
                        }
                    }
                })


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