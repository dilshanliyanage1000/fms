<?php
$code = $_GET["code"];

?>
    <div>
        <img style="margin-left: 20px;" src="http://localhost/fms/lib/views/product/qrcode.php?s=qrl&d=<?php echo $code ?>">
    </div>
    <div>
        <div><label style="font-size: 20px; margin-left: 6px;"><?php echo $code ?></label></div>
    </div>

<script src="../../../js/jquery.min.js"></script>
<script type="text/javascript" src="printThis.js"></script>

<!-- demo -->
<script>
    $(document).ready(function () {
        window.print();
    });
</script>