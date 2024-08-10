<?php
include_once '../app/init.php';
load::customer();


$email = $_POST['email'];
$password = $_POST['password'];
if (isset($_POST['login'])) {
    customer::login($email, $password);
}
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
    <nav class="nav" id="navbar">
        <a class="nav-link active" href="index">Home</a>

    </nav>

    <div class=' container-sm mt-5'>
        <div class='row'>
            <div class='col-12'>
                <div class='card'>
                    <div class='card-body'>
                        <form action='' method='post' enctype='multipart/form-data'>
                            <div class='mb-3'>
                                <label for='username' class='form-label'></label>
                                <input type='text' class='form-control' name='email' id='email' placeholder='Email' value="<?php echo $email; ?>">
                                <label for='password' class='form-label'></label>
                                <input type='password' class='form-control' name='password' id='password' placeholder='Password' value=''>
                            </div>

                            <div class='btn-container'><button type='submit' name='login' class='btn'>Login</button>
                            </div>
                        </form>
                        <h1 id='display-6' style='text-align:center; color:black;'>Create an
                            Account</h1>
                        <div class='btn-container'>
                            <a href="signup">
                                <button class='btn'>Sign
                                    Up</button>
                            </a>
                        </div>

                    </div>

                    <div class='btn-container'>
                        <a href="forgotpassword">
                            <button class='btn'>
                                Forgot Password
                            </button>
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