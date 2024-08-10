<?php
include_once '../app/init.php';

load::customer();

$name = $_POST['name'];
$mobile_no = $_POST['mobileNo'];
$email = $_POST['email'];
$address = $_POST['address'];
$password = $_POST['password'];
$confirmpassword = $_POST['confirmpassword'];
$pin = $_POST['pin'];

if (isset($_POST['sign_up'])) {
    customer::register($name, $mobile_no, $email, $address, $password, $confirmpassword, $pin);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="assets/css/regstyles.css">
    <link rel='stylesheet' href='assets/bootstrap-5.2.0-beta1-dist/css/bootstrap.css'>
    <link rel="stylesheet" href="assets/css/libs.bundle.css">
    <link rel="stylesheet" href="assets/css/theme.bundle.css">
</head>
<nav class="nav" id="navbar">
    <a class="nav-link active" href="index">Home</a>

</nav>

<body>
    <div class="container-sm" style="z-index: 1;">
        <div class="row">
            <div class="col-12">
                <div class="card" style="background-color: black;">
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">


                            <input type="text" class="form-control" name="name" id="name" placeholder="Name"
                                value="<?php echo $name; ?>">

                            <label for="Mobile No" class=" form-label"></label>
                            <input type="text" class="form-control" name="mobileNo" id="mobileNo"
                                placeholder="Mobile No" value="<?php echo $mobile_no; ?>">

                            <label for="email" class="form-label"></label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="Email"
                                value="<?php echo $email; ?>">

                            <label for="address" class="form-label"></label>
                            <input type="text" class="form-control" name="address" id="address" placeholder="Address"
                                value="<?php echo $address; ?>">


                            <label for="password" class="form-label"></label>
                            <input type="password" class="form-control" name="password" id="password"
                                placeholder="Password">

                            <label for="confirmpassword" class="form-label"></label>
                            <input type="password" class="form-control" name="confirmpassword" id="confirmpassword"
                                placeholder="Confirm Password">

                            <label for="pin" class="form-label"></label>
                            <input type="password" class="form-control" name="pin" id="pin" placeholder="Pin"
                                maxlength="4">
                    </div>

                    <div class="btn-container mb-1"><button type="submit" name="sign_up" class="btn">Sign up</button>
                    </div>
                    </form>
                    <h1 class="display-6" style="text-align:center; color:white;">If you already have an
                        Account</h1>
                    <div class="btn-container">
                        <a href="login">
                            <button class="btn">Login</button>
                        </a>
                    </div>
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