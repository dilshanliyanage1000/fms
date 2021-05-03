<body style="margin-top: 60px;">

    <style type="text/css">
        .modal .modal-dialog-aside {
            width: 530px;
            max-width: 100%;
            height: 100%;
            margin: 0;
            transform: translate(0);
            transition: transform .2s;
        }

        .modal .modal-dialog-aside .modal-content {
            height: inherit;
            border: 0;
            border-radius: 0;
        }

        .modal .modal-dialog-aside .modal-content .modal-body {
            overflow-y: auto
        }

        .modal.fixed-left .modal-dialog-aside {
            margin-left: auto;
            margin-right: -19px;
            transform: translateX(100%);
        }

        .modal.fixed-right .modal-dialog-aside {
            margin-right: auto;
            transform: translateX(-100%);
        }

        .modal.show .modal-dialog-aside {
            transform: translateX(0);
        }

        .notification .badge {
            position: absolute;
            top: 9px;
            right: 135px;
            padding: 5px 7px 5px 7px;
            border-radius: 50%;
            background: #f27777;
            color: white;
        }

        #sidebar_btn {
            color: #b5b5b5;
        }

        #sidebar_btn:hover {
            color: #949494;
        }

        #textzoom {
            transition: transform .2s;
        }

        #textzoom:hover {
            transform: scale(1.09);
        }
    </style>

    <!--wrapper start-->
    <div class="custom-sidebar">
        <div class="wrapper custom-collapse">

            <!--header menu start-->
            <div class="header" style="box-shadow: 0 0 10px #b3b3b3; z-index: 100;">
                <div class="header-menu">
                    <a href="../dashboard/inoffice.php"><img class="img-responsive2" src="../../../img/logo.png" style="width:200px"></img></a>
                    <div class="sidebar-btn">
                        <i id="sidebar_btn" class="fas fa-bars fa-1x"></i>
                    </div>
                    <div id="user_pill">
                        Welcome,&nbsp;<?php echo ($_SESSION['userFirstName'] . '&nbsp;' . $_SESSION['userLastName']); ?>!
                    </div>
                    <ul>
                        <li><a href="#" class="notification" id="notification_popup" data-toggle='modal' data-target='#notificationModal'><span><i class="fas fa-bell"></i></span><span class="badge"><?php $id = $_SESSION['userId'];
                                                                                                                                                                                                        include_once('../../functions/notification.php');
                                                                                                                                                                                                        getNotificationCountbyUser($id) ?></span></a></li>
                        <li><a href="../../views/myprofile/myprofile.php"><i class="fas fa-user"></i></a></li>
                        <li><a href="../../functions/logout_class.php"><i class="fas fa-sign-out-alt"> </i></a></li>
                    </ul>
                </div>
            </div>
            <!--header menu end-->

            <!--sidebar start-->
            <div class="sidebar">
                <div class="sidebar-menu" style="margin-left: 5px;">
                    <li class="item">
                        <a href="#" class="menu-btn" style="text-align: center;">
                            <h5><span class="badge badge-pill badge-info">In-Office Dashboard</span></h5>
                        </a>
                    </li>
                    <li class="item">
                        <a href="../dashboard/inoffice.php" class="menu-btn" id="textzoom">
                            <i class="fas fa-tachometer-alt"></i><span>Dashboard</span>
                        </a>
                    </li>
                    <hr>
                    <li class="item" id="invoice">
                        <a href="#invoice" class="menu-btn" id="textzoom">
                            <i class="fas fa-file-invoice"></i><span>Billing (Invoice)<i class="fas fa-chevron-down drop-down"></i></span>
                        </a>
                        <div class="sub-menu">
                            <a href="../invoice/invoice.php" id="textzoom"><i class="fas fa-file-invoice"></i><span>For Machineries</span></a>
                            <a href="../invoice_part/invoice_part.php"><i class="fas fa-file-invoice"></i><span>For Parts</span></a>
                        </div>
                    </li>
                    <li class="item" id="human_Resource">
                        <a href="#human_Resource" class="menu-btn" id="textzoom">
                            <i class="fa fa-users"></i><span>Human Resource<i class="fas fa-chevron-down drop-down"></i></span>
                        </a>
                        <div class="sub-menu">
                            <a href="../customer/newcustomer.php"><i class="fas fa-user-circle"></i><span>Customer Management</span></a>
                            <a href="../employee/employee.php"><i class="fas fa-users"></i><span>Employee Management</span></a>
                            <a href="../supplier/supplier.php"><i class="fas fa-people-carry"></i><span>Supplier Management</span></a>
                            <a href="../warehouse/warehouse.php"><i class="fas fa-warehouse"></i><span>Warehouse Management</span></a>
                            <a href="../vehicle/newVehicle.php"><i class="fas fa-truck"></i><span>Vehicle Management</span></a>
                        </div>
                    </li>
                    <li class="item" id="attendance">
                        <a href="#attendance" class="menu-btn" id="textzoom">
                            <i class="fas fa-check-double"></i><span>Attendance<i class="fas fa-chevron-down drop-down"></i></span>
                        </a>
                        <div class="sub-menu">
                            <a href="../attendance/attendance.php"><i class="fas fa-check-double"></i><span>Mark Attendance</span></a>
                            <a href="../attendance/salary_report.php"><i class="fas fa-money-bill-wave"></i><span>Create Salary Report</span></a>
                            <a href="../attendance/salary_sheets.php"><i class="fas fa-money-bill-wave"></i><span>Salary Sheets</span></a>
                        </div>
                    </li>
                    <li class="item" id="quotation">
                        <a href="#quotation" class="menu-btn" id="textzoom">
                            <i class="far fa-clipboard"></i><span>Quotations<i class="fas fa-chevron-down drop-down"></i></span>
                        </a>
                        <div class="sub-menu">
                            <a href="../quotation/add_quotation.php"><i class="far fa-clipboard"></i><span>Create Quotation</span></a>
                            <a href="../quotation/quotation_list.php"><i class="far fa-clipboard"></i><span>Past Quotations</span></a>
                        </div>
                    </li>
                    <li class="item" id="reqNotes">
                        <a href="#reqNotes" class="menu-btn" id="textzoom">
                            <i class="fas fa-plus"></i><span>Request Notes<i class="fas fa-chevron-down drop-down"></i></span>
                        </a>
                        <div class="sub-menu">
                            <a href="../request_notes/rm_request.php"><i class="fas fa-plus"></i><span>Raw Material Request</span></a>
                            <a href="../request_notes/part_production_request.php"><i class="fas fa-plus"></i><span>Part Production Request</span></a>
                            <a href="../request_notes/production_req_form.php"><i class="fas fa-plus"></i><span>Production Request</span></a>
                            <a href="../request_notes/allrequests.php"><i class="far fa-question-circle"></i><span>All Requests</span></a>
                        </div>
                    </li>
                    <li class="item" id="order_management">
                        <a href="#order_management" class="menu-btn" id="textzoom">
                            <i class="fas fa-cash-register"></i><span>Order Management<i class="fas fa-chevron-down drop-down"></i></span>
                        </a>
                        <div class="sub-menu">
                            <a href="../grn/grn.php"><i class="fas fa-file-alt"></i><span>Create G.R. Note</span></a>
                            <a href="../grn/grn_list.php"><i class="fas fa-file-alt"></i><span>G.R. Notes List</span></a>
                            <a href="../purchase_order/po_list.php"><i class="fas fa-file-powerpoint"></i><span>Purchase Orders</span></a>
                            <a href="../invoice/invoice_list.php"><i class="fas fa-file-invoice"></i><span>Invoice Management</span></a>
                            <a href="../stock/stock.php"><i class="fas fa-chart-bar"></i><span>Stock Management</span></a>
                        </div>
                    </li>
                    <li class="item" id="update_production">
                        <a href="#update_production" class="menu-btn" id="textzoom">
                            <i class="fas fa-people-carry"></i><span>Update Production<i class="fas fa-chevron-down drop-down"></i></span>
                        </a>
                        <div class="sub-menu">
                            <a href="../updateproduction/updateproductionbyrequest.php"><i class="fas fa-people-carry"></i><span>Update Production By Request</span></a>
                            <a href="../updateproduction/updateproduction.php"><i class="fas fa-people-carry"></i><span>Update Machinery Production</span></a>
                            <a href="../updateproduction/updatepartproduction.php"><i class="fas fa-people-carry"></i><span>Update Part Production</span></a>
                            <a href="../production_history/production_history.php"><i class="fas fa-people-carry"></i><span>View Production History</span></a>
                        </div>
                    </li>
                    <li class="item" id="defectdiag">
                        <a href="#defectdiag" class="menu-btn" id="textzoom">
                            <i class="fas fa-laptop-code"></i><span>Defect Diagnosis<i class="fas fa-chevron-down drop-down"></i></span>
                        </a>
                        <div class="sub-menu">
                            <a href="../product_diagnosis/add_prod_diagnosis.php"><i class="fas fa-laptop-code"></i><span>Add Product Defects</span></a>
                            <a href="../product_diagnosis/diagnosis_list.php"><i class="fas fa-laptop-code"></i><span>Diagnosis List</span></a>
                        </div>
                    </li>
                </div>
            </div>
            <!--sidebar end-->
            <!--main container start-->
            <div class="main-container">

                <div id="notificationModal" class="modal fixed-left fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-aside" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="text-align: center;">
                                <h5 class="modal-title">Your Notifications</h5>&nbsp;|&nbsp;&nbsp;
                                <h5 class="modal-title" id="nf_count">
                                    <?php
                                    $id = $_SESSION['userId'];
                                    include_once('../../functions/notification.php');
                                    getNotificationCountbyUser($id)
                                    ?>
                                </h5>
                                <h5 class="modal-title">&nbsp;Unread</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" style="background-color: #eee;">
                                <?php
                                $id = $_SESSION['userId'];
                                include_once('../../functions/notification.php');
                                GetConfirmedNotificationsbyUser($id)
                                ?>
                                <?php
                                include_once('../../functions/notification.php');
                                lowStockProdError();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    $(document).ready(function() {

                        $(".btn-view-notice").click(function() {
                            $path = $(this).attr('id');
                            window.open($path, "_blank");
                        });

                        $(".btn-dismiss-notif").click(function() {
                            $id = $(this).attr('id');

                            $.post("../../route/notification/dismissnotification.php", {
                                id: $id
                            }, function(data) {
                                if (data == "success") {
                                    setTimeout(() => {
                                        location.reload();
                                    }, 2100);
                                    swal({
                                        type: 'success',
                                        title: 'Request Dismissed!',
                                        showConfirmButton: false,
                                        timer: 2000
                                    });
                                } else {
                                    $error_msg = "Kindly check whether all the mandatory fields have been filled out";
                                    swal("Check your inputs!", $error_msg, "warning");
                                }
                            });

                        });

                    });
                </script>