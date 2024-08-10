<?php
include_once '../app/init.php';

# This is for loading the admin class
load::admin();

# --------------------------------------------------------------------

$email = $_POST['email'];
$password = ($_POST['password']);

if (isset($_POST['login'])) {
    admin::login($email, $password);
}
if (isset($_POST['signup'])) {
    header('location:signup');
}
?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Admin</title>
    <link rel='stylesheet' href='../assets/css/loginstyles.css'>
    <link rel='stylesheet' href='../assets/bootstrap-5.2.0-beta1-dist/css/bootstrap.css'>

</head>

<body>

    <div class=' container' style="margin-top: 100px; width:50%; padding-bottom:00px;">
        <div class='row'>
            <div class='col-12'>
                <div class='card'>
                    <div class='card-body'>
                        <form action='' method='post' enctype='multipart/form-data'>
                            <div class='mb-3'>
                                <label for='email' class='form-label'></label>
                                <input type='text' class='form-control' name='email' id='email' placeholder='Email'
                                    value="<?php echo $email; ?>">
                                <label for='password' class='form-label'></label>
                                <input type='password' class='form-control' name='password' id='password'
                                    placeholder='Password' value=''>
                            </div>

                            <div class='btn-container'><button type='submit' name='login' class='btn'>Login</button>
                            </div>
                            <h1 id='display-6' style='text-align:center; color:black;'>If you already have an
                                Account</h1>
                            <div class='btn-container'>
                                <button type="submit" name="signup" class='btn'>Sign up</button>
                                </a>
                            </div>

                        </form>

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