<?php

include_once('../../functions/db_conn.php');
include_once('../../functions/employee.php');

$emp_id = $_GET["emp_id"];
$emp_fname = $_GET["emp_fname"];
$emp_lname = $_GET["emp_lname"];
$realimgpath = $_GET["realimgpath"];
$jobrole_name = $_GET["jobrole_name"];

?>

<link rel="stylesheet" href="../../../css/bootstrap.css">
<link rel="stylesheet" href="../../../css/icons/css/all.css">

<div style="margin-top: 15px; margin-left: 15px;">
    <div style="border: 5px solid #969696; border-radius: 20px; width: 500px;">

        <!-- Upper pill cutout for lace -->
        <div align="center" style="margin-top:10px;">
            <div style="border: 5px solid #969696; border-radius: 20px; width: 45%;">
                <h6>&nbsp;</h6>
            </div>
        </div>

        <div style="margin: 5px;">
            <div style="text-align: center; margin-top: 30px;">
                <img alt="Udaya Industries Logo" src="../../../img/invimg.png" style="width: 75%;" />
            </div>
            <div style="text-align: center; margin-top: 20px;">
                <img alt="Employee Image" src="<?php echo $realimgpath ?>" style="width: 70%; border: 5px dashed #5bb356; padding: 4px;" />
            </div>
            <div style="text-align: center; margin-top: 20px; background-color: #5bb356;">
                <h4 style="color: white; padding-top:10px;"><?php echo ($emp_fname . "&nbsp;" . $emp_lname) ?></h4>
                <h5 style="color: white; padding-bottom: 10px;"><?php echo ("<i class='fas fa-suitcase'></i>&nbsp;&nbsp;" . $jobrole_name . "&nbsp;&nbsp;<i class='fas fa-suitcase'></i>") ?></h5>
            </div>
            <div style="text-align: center;">
                <img alt="QR Code" src="./qrcode.php?s=qrl&d=<?php echo $emp_id ?>" style="width: 30%;" />
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="../../../js/jquery.js"></script>
<script type="text/javascript" src="../../../js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        window.print();
    });
</script>