<?php
include_once '../app/init.php';
load::customer();


if (isset($_POST['login'])) {
  header("location:login");
}
if (isset($_POST['register'])) {
  header("location:signup");
}
if (isset($_POST['changepassword'])) {
  customer::forgotpassword();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fast Ride </title>
    <link rel='stylesheet' href='assets/css/loginstyles.css'>
    <link rel='stylesheet' href='assets/bootstrap-5.2.0-beta1-dist/css/bootstrap.css'>
    <link rel="stylesheet" href="assets/css/libs.bundle.css">
    <link rel="stylesheet" href="assets/css/theme.bundle.css">

</head>

<body>
    <nav class="nav" id="navbar">
        <a class="nav-link active" href="index">Home</a>

    </nav>

    <div class="container-sm">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <input type="text" class="form-control" name="username" id="username"
                                    placeholder="Username" value="">
                                <label for="email" class="form-label"></label>
                                <input type="text" class="form-control" name="registered-email" id="email"
                                    placeholder="Registered Email" value="">
                                <label for="email" class="form-label"></label>
                                <input type="password" class="form-control" name="new-password" id="newpassword"
                                    placeholder="New Password" value="">
                                <label for="confirm-new-password" class="form-label"></label>
                                <input type="password" class="form-control" name="confirm-new-password" id="password"
                                    placeholder="Confirm New Password" value="">
                            </div>

                            <div class="btn-container"><button type="submit" name="changepassword" class="btn">Change
                                    Password</button></div>
                            <div class="btn-container mt-5"><button type="submit" name="login"
                                    class="btn">Login</button></div>
                            <div class="btn-container mt-5"><button type="submit" name="register"
                                    class="btn">Signup</button></div>


                    </div>
                    </form </div>
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