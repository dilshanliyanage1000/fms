<?php
session_start();

include_once('../../inc/header.php');

if (isset($_SESSION['userId']) && ($_SESSION['user_role'] == 1 || $_SESSION['user_role'] == 2)) {

?>
    <br>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active">Sales Analytics</li>
        </ol>
    </div>

    <div class="col-md-12">
        <div class="jumbotron">
            <h1 class="display-5" style="text-align: center;"><i class="fas fa-chart-bar"></i>&nbsp;&nbsp;Sales Report</h1>
            <p class="lead" style="text-align: center;">Generate Sales report based on the selected time frame</p>
            <hr class="my-4">
            <br>

            <!-- attendance marking form -->
            <h5>Please select the time-period to generate the sales report</h5>
            <br><br>
            <form id="sales_form">
                <div class="row form-group">
                    <div class="col-md-3"></div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Select Date Period :</label>
                            <div id="reportrange" class="form-control" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%;">
                                <i class="fa fa-calendar"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span></span>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-down"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <button type="button" id="gen_sales" class="btn btn-primary" style="margin-top: 32px;"><i class="fas fa-paper-plane"></i>&nbsp;&nbsp;Generate Sales</button>
                        </div>
                    </div>
                </div>
                <div id="load_content"></div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            var startDate = '';
            var endDate = '';

            $(function() {

                var start = moment().subtract(29, 'days');
                var end = moment();

                function cb(start, end) {
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                    startDate = start.format('YYYY-MM-DD');
                    endDate = end.format('YYYY-MM-DD');
                }

                $('#reportrange').daterangepicker({
                    startDate: start,
                    endDate: end,
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    }
                }, cb);

                cb(start, end);
            });

            $("#gen_sales").click(function() {

                var today_date = "<?php
                                    date_default_timezone_set('Asia/Colombo');
                                    echo date("Y-m-d");
                                    ?>";

                if (startDate > today_date || endDate > today_date) {
                    swal("Invalid Time Period", "Please select a valid date period", "warning");
                } else {
                    window.open("./custom_sales_report.php?startDate=" + startDate + "&endDate=" + endDate + "&/", "_blank");
                }
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