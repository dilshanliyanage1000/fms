<?php
//import auth backend
include_once('lib/functions/auth.php');

//if user click on the login button
if (isset($_POST['userEmail'])) {
?>
    <!-- HTML error message box -->
    <div align="center">
        <div class="col-md-4">
            <div class="alert alert-dismissible alert-danger" style="margin-top: 10px; font-size: 22px;">
                <?php
                $result = Auth($_POST['userEmail'], $_POST['pwd']);
                echo ($result);
                ?>
            </div>
        </div>
    </div>

<?php
    //php isset end here
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" type="image/jpg" href="css/favicon_io/favicon-16x16.png" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>FMS [Udaya Industries]</title>

    <link rel="stylesheet" href="css/bootstrap.css">

    <link rel="stylesheet" href="css/icons/css/all.css">

    <link rel="stylesheet" href="css/index.css">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

</head>

<body id="login_body">
    <div class="container">
        <div id="login_form">
            <div class="container">
                <div class="col-md-12" style="text-align:center;">
                    <img src="img/logo.png" id="mainBodyImage" alt="Udaya Industries">
                </div>
            </div>
            <br><br>
            <hr class="my-2">
            <br>
            <div id="text_group">
                <form action="<?php echo ($_SERVER['PHP_SELF']) ?>" method="post">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user fa-2x"></i></span>
                        </div>
                        <input type="email" class="form-control form-control-lg" name="userEmail" id="userEmail" placeholder="Username">
                        <div class="input-group-append" id="verified_mail" style="display: none;">
                            <span class="input-group-text" style="color: #39d453"><i class="far fa-check-circle fa-2x"></i></span>
                        </div>
                    </div>
                    <div class="input-group mb-3" style="margin-top: 20px;">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key fa-2x"></i></span>
                        </div>
                        <input type="password" class="form-control form-control-lg" name="pwd" id="pwd" placeholder="Password">
                    </div>
                    <br>
                    <div align="center">
                        <button type="submit" class="btn btn-primary btn-lg btn-block" style="width:50%;">Login</button>
                    </div>
                </form>
            </div>
            </br>
            <a href="" id="forget_pw">Forgot Password?</a>
        </div>
    </div>
</body>

<div id="footer">
    <h4 style="color: white;">- Developed by Dilshan Liyanage [1708937] -</h4>
</div>

<script>
    $(document).ready(function() {

        $("#userEmail").keyup(function() {

            var searchVal = $(this).val();

            if (searchVal.length < 8) {
                $("#verified_mail").hide();
            } else {
                $.get("lib/route/login/searchUser.php", {
                    data: searchVal
                }, function(data) {
                    if (data == "success") {
                        $("#verified_mail").show();
                    } else {
                        $("#verified_mail").hide();

                    }
                });
            }
        });
    });
</script>

</html>