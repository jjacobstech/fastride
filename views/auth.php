<?php
include_once '../app/init.php';
session_start();

load::customer();
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Login</title>
    <link rel='stylesheet' href='assets/css/loginstyles.css'>
    <link rel='stylesheet' href='assets/bootstrap-5.2.0-beta1-dist/css/bootstrap.css'>
    <link rel="stylesheet" href="assets/css/libs.bundle.css">
    <link rel="stylesheet" href="assets/css/theme.bundle.css">

</head>

<body>

    <?php
    customer::auth();
    ?>
    <div class=' container-sm mt-5 '>
        <div class='row justify-content-center mt-5'>
            <div class='col-6 mt-5'>
                <div class='card'>
                    <div class='card-body'>
                        <form action='' method='post' enctype='multipart/form-data'>
                            <div class='mb-3 mt-5'>
                                <div class="text-white text-center mt-5">
                                    <h3>Hello <?php echo $_SESSION['c_name'] ?></h3>
                                    <p>Kindly enter your PIN to access your account and cotinue activity</p>
                                </div>
                                <label for='pin' class='form-label'></label>
                                <input type='password' class='form-control' name='pin' id='pin' placeholder='Pin'
                                    value='' maxlength="4">
                            </div>

                            <div class='btn-container'><button type='submit' name='auth_login'
                                    class='btn'>Login</button>
                            </div>
                        </form>

                    </div>


                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="assets/bootstrap-5.2.0-beta1-dist/js/bootstrap.js"></script>
    <script src="assets/js/jquery-3.6.0.js"></script>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/index.js"></script>
</body>

</html>