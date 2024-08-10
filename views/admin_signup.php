<?php
include_once '../app/init.php';

load::admin();

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirmpassword = $_POST['confirmpassword'];
if (isset($_POST['signup'])) {
    admin::register($name, $email, $password, $confirmpassword);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../assets/css/regstyles.css">
    <link rel='stylesheet' href='../assets/bootstrap-5.2.0-beta1-dist/css/bootstrap.css'>

</head>

<body>
    <div class="container-sm" style="z-index: 1;">
        <div class="row">
            <div class="col-12">
                <div class="card" style="background-color: black;">
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">


                            <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $name; ?>">

                            <label for="email" class="form-label"></label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>">


                            <label for="password" class="form-label"></label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password">

                            <label for="confirmpassword" class="form-label"></label>
                            <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password">
                    </div>

                    <div class="btn-container mb-1"><button type="submit" name="signup" class="btn">Sign up</button>
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
    <script src="../assets/bootstrap-5.2.0-beta1-dist/js/bootstrap.js"></script>
    <script src="../assets/js/jquery-3.6.0.js"></script>
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/index.js"></script>

</body>

</html>