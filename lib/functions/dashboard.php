<?php

date_default_timezone_set('Asia/Colombo');

include_once('db_conn.php');

include_once('id_maker.php');

function AnnualEarnings()
{
    $thisyear = date("Y");

    $yearstart = $thisyear . '-01-01';

    $yearend = $thisyear . '-12-31';

    $conn = Connection();

    $getAE = "SELECT SUM(invoice_tbl.inv_final_price) AS TotalAnnualSales
                FROM invoice_tbl
                WHERE invoice_tbl.inv_date BETWEEN '$yearstart' AND '$yearend';";

    $runQuery = mysqli_query($conn, $getAE);

    $rec = mysqli_fetch_assoc($runQuery);

    $TotalSales = number_format($rec['TotalAnnualSales']);

    $TotalSales = 'Rs. ' . $TotalSales . '.00';

    echo ($TotalSales);
}

function MonthlyEarnings()
{
    $thismonth = date("Y-m");

    $monthstart = $thismonth . '-01';

    $monthend = $thismonth . '-31';

    $conn = Connection();

    $getAE = "SELECT SUM(invoice_tbl.inv_final_price) AS TotalAnnualSales
                FROM invoice_tbl
                WHERE invoice_tbl.inv_date BETWEEN '$monthstart' AND '$monthend';";

    $runQuery = mysqli_query($conn, $getAE);

    $rec = mysqli_fetch_assoc($runQuery);

    $TotalSales = number_format($rec['TotalAnnualSales']);

    $TotalSales = 'Rs. ' . $TotalSales . '.00';

    echo ($TotalSales);
}

?>