<?php
session_start();

date_default_timezone_set('Asia/Colombo');

include_once('../../inc/header.php');

if (isset($_SESSION['userId']) && $_SESSION['user_role'] == 2) {

?>

    <style>
        #zoom {
            transition: transform .2s;
        }

        #zoom:hover {
            transform: scale(1.05);
        }

        .option-tile {
            transition: transform .5s;
        }

        .option-tile:hover {
            transform: scale(1.05);
            background-color: #fffcfc;
        }
    </style>

    <div class="container-fluid">
        <div class="col-md-12">
            <br>
            <div id="loadDetails">
                <div class="row">

                    <!-- Weekly Sales -->
                    <div class="col-xl-3 col-md-6 mb-3" id="zoom">
                        <div class="card border-left-primary shadow h-100 py-2" style="background: rgb(225,255,224); background: linear-gradient(0deg, rgba(225,255,224,1) 0%, rgba(255,255,255,1) 100%);">
                            <div class="card-body">
                                <div style="color: #20c997;">
                                    <h6 style="text-align: center;"><i class="fas fa-dollar-sign"></i>&nbsp;&nbsp;<b>MONTHLY SALES</b></h6>
                                </div>
                                <hr>
                                <div>
                                    <h5 style="text-align: center;">
                                        <?php
                                        include_once("../../functions/dashboard.php");
                                        MonthlyEarnings();
                                        ?>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Annual Earnings -->
                    <div class="col-xl-3 col-md-6 mb-3" id="zoom">
                        <div class="card border-left-primary shadow h-100 py-2" style="background: rgb(225,255,224); background: linear-gradient(0deg, rgba(225,255,224,1) 0%, rgba(255,255,255,1) 100%);">
                            <div class="card-body">
                                <div style="color: #20c997;">
                                    <h6 style="text-align: center;"><i class="fas fa-dollar-sign"></i>&nbsp;&nbsp;<b>ANNUAL EARNINGS (<?php echo date("Y"); ?>)</b></h6>
                                </div>
                                <hr>
                                <div>
                                    <h5 style="text-align: center;">
                                        <?php
                                        include_once("../../functions/dashboard.php");
                                        AnnualEarnings();
                                        ?>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Orders -->
                    <div class="col-xl-3 col-md-6 mb-3" id="zoom">
                        <div class="card border-left-warning shadow h-100 py-2" style="background: rgb(224,247,255); background: linear-gradient(0deg, rgba(224,247,255,1) 0%, rgba(255,255,255,1) 100%);">
                            <div class="card-body">
                                <div style="color: #6CC3D5;">
                                    <h6 style="text-align: center;"><i class="fas fa-poll"></i>&nbsp;&nbsp;<b>PENDING NOTIFICATIONS</b></h6>
                                </div>
                                <hr>
                                <div>
                                    <h5 style="text-align: center;">
                                        <?php
                                        include_once('../../functions/notification.php');
                                        getNotificationCount();
                                        ?> Requests
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- System Date -->
                    <div class="col-xl-3 col-md-6 mb-3" id="zoom">
                        <div class="card border-left-info shadow h-100 py-2" style="background: rgb(255,227,248); background: linear-gradient(0deg, rgba(255,227,248,1) 0%, rgba(255,255,255,1) 100%);">
                            <div class="card-body">
                                <div style="color: #F3969A;">
                                    <h6 style="text-align: center;"><i class="far fa-clock"></i>&nbsp;&nbsp;<b>SYSTEM DATE</b></h6>
                                </div>
                                <hr>
                                <div>
                                    <h5 style="text-align: center;" id="displaytime"></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="shadow h-100" style="border-radius: 15px; padding: 25px; background-color: #fff; margin: 5px;">
                            <h4 style="text-align: center; color: #e3a700;"><i class="fas fa-cogs"></i>&nbsp;&nbsp;TOP SELLING MACHINERIES</h4>
                            <div style="margin-top: 30px;">
                                <?php
                                include_once("../../functions/sales.php");
                                getMostSelling();
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12" style="width: 100%;">
                            <div class="shadow h-100" style="border-radius: 15px; padding: 25px; background-color: #fff; margin: 5px;">
                                <h4 style="text-align: center; color: #e3a700;"><i class="fas fa-truck-loading"></i>&nbsp;&nbsp;LOWERING STOCKS : RAW MATERIALS</h4>
                                <div style="margin-top: 30px;">
                                    <?php
                                    include_once("../../functions/stock.php");
                                    RMLoweringStocks();
                                    ?>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-12" style="width: 100%;">
                            <div class="shadow h-100" style='border: 1px solid #f2f2f2; border-radius: 15px; background-color: white;'>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="shadow h-100 option-tile" style="border-radius: 15px;">
                                                <a href="../purchase_order/po_list.php" style="text-decoration: none;">
                                                    <div class="card-body" style="margin-bottom: -10px;">
                                                        <h6 id="txt111" style="text-align: center;"><i class="far fa-file-alt fa-2x"></i></h6>
                                                        <h6 id="txt112" style="text-align: center; margin-top: 10px;">Purchase Orders</h6>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="shadow h-100 option-tile" style="border-radius: 15px;">
                                                <a href="../attendance/salary_report.php" style="text-decoration: none;">
                                                    <div class="card-body" style="margin-bottom: -10px;">
                                                        <h6 style="text-align: center;"><i class="fas fa-file-invoice-dollar fa-2x"></i></h6>
                                                        <h6 style="text-align: center; margin-top: 10px;">Salary Sheets</h6>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="shadow h-100 option-tile" style="border-radius: 15px;">
                                                <a href="../sales/sales.php" style="text-decoration: none;">
                                                    <div class="card-body" style="margin-bottom: -10px;">
                                                        <h6 style="text-align: center;"><i class="far fa-chart-bar fa-2x"></i></h6>
                                                        <h6 style="text-align: center; margin-top: 10px;">Company Sales</h6>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {

            var timeDisplay = document.getElementById("displaytime");

            function refreshTime() {
                var dateString = new Date().toLocaleString("en-US", {
                    timeZone: "Asia/Colombo"
                });
                var formattedString = dateString.replace(", ", " - ");
                timeDisplay.innerHTML = formattedString;
            }

            setInterval(refreshTime, 1000)

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