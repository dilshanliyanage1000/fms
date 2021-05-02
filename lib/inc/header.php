<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" type="image/jpg" href="../../../css/favicon_io/favicon-16x16.png" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Udaya Industries [FMS]</title>

    <!-- style sheets for admin-->

    <link rel="stylesheet" href="../../../css/bootstrap.css">

    <!-- style sheet for sweet alert -->
    <link rel="stylesheet" href="../../../css/sweetalert/dist/sweetalert.css">

    <!-- link icons  -->
    <link rel="stylesheet" href="../../../css/icons/css/all.css">

    <!-- Custom css  -->
    <link rel="stylesheet" href="../../../css/product_diagnosis.css">
    <link rel="stylesheet" href="../../../css/style.css">
    <link rel="stylesheet" href="../../../css/index.css">

    <!-- chart js css files -->
    <link rel="stylesheet" href="../../../js/chart.js/dist/Chart.css">
    <link rel="stylesheet" href="../../../js/chart.js/dist/Chart.min.css">
    <link rel="stylesheet" type="text/css" href=" https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

    <link rel="stylesheet" href="../../../css/multiselect/multiselect.css" />

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <link rel="stylesheet" type="text/css" href="../../../css/datepicker/datepicker.min.css" />

    <link rel="stylesheet" type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/smoothness/jquery-ui.css">

    <!-- javascript files -->
    <script type="text/javascript" src="../../../js/jquery.js"></script>

    <script type="text/javascript" src="../../../js/bootstrap.min.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <!-- chart js scripts -->
    <script type="text/javascript" src="../../../js/chart.js/dist/Chart.bundle.js"></script>

    <script type="text/javascript" src="../../../js/chart.js/dist/Chart.bundle.min.js"></script>

    <script type="text/javascript" src="../../../js/chart.js/dist/Chart.js"></script>

    <script type="text/javascript" src="../../../js/chart.js/dist/Chart.min.js"></script>

    <!-- sweet alert script -->
    <script type="text/javascript" src="../../../css/sweetalert/dist/sweetalert.js"></script>

    <script type="text/javascript" src="../../../css/sweetalert/dist/sweetalert.min.js"></script>

    <!-- js validation -->
    <script type="text/javascript" src="../../../js/js_validation.js"></script>

    <script type="text/javascript" src="../../../js/main.js"></script>

    <script type="text/javascript" src="../../../js/multiselect.js"></script>

    <script type="text/javascript" src="../../../css/datepicker/js/bootstrap-datepicker.min.js"></script>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/table-to-json@1.0.0/lib/jquery.tabletojson.min.js"></script>

</head>

<body>

    <?php

    if (isset($_SESSION['userId']) && ($_SESSION['user_role'] == 1)) {
        include_once('../../inc/sidenav.php');
    } else if (isset($_SESSION['userId']) && ($_SESSION['user_role'] == 2)) {
        include_once('../../inc/sidenav_manager.php');
    } else if (isset($_SESSION['userId']) && ($_SESSION['user_role'] == 3)) {
        include_once('../../inc/sidenav_supervisor.php');
    } else if (isset($_SESSION['userId']) && ($_SESSION['user_role'] == 4)) {
        include_once('../../inc/sidenav_inoffice.php');
    }

    ?>