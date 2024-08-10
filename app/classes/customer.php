<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

load::config();
load::autoloader();
class customer
{

    public static function register($name, $mobile_no, $email, $address, $password, $confirmpassword, $pin)
    {
        $connection = DB_CONNECTION;


        if ((empty($name) || empty($mobile_no)) || (empty($email) || empty($address))) {

            echo '<div class="notifier" id="alert">
                <div class="alert alert-warning alert-dismissible show fade" style="text-align:center;  role="alert">

                <strong >All Fields Must Be Filled</strong> </div>
                </div>';
        } elseif (empty($password) || empty($confirmpassword)) {
            echo '<div class="notifier" id="alert">
        <div class="alert alert-warning alert-dismissible show fade" style="text-align:center;  role="alert">
        
        <strong >Check Password</strong> </div>
        </div>';
        } else {
            if ($password !== $confirmpassword) {
                echo '<div class="notifier" id="alert">
            <div class="alert alert-warning alert-dismissible show fade" style="text-align:center;  role="alert">
            
            <strong >Password Not Matching</strong> </div>
            </div>';
            } else {
                if (empty($pin)) {
                    echo '<div class="notifier" id="alert">
            <div class="alert alert-warning alert-dismissible show fade" style="text-align:center;  role="alert">
            
            <strong >Check Pin</strong> </div>
            </div>';
                } else {
                    $name = trim($name);
                    $mobile_no = trim($mobile_no);
                    $email = trim($email);
                    $address = trim($address);
                    $password = md5(trim($_POST['password']));
                    $pin = trim($pin);
                    #---------------------------------------------------------------

                    $query_stmt = "INSERT INTO `customers`(`c_name`,  `c_pwd`,`c_mobile`, `c_email`, `c_address`, `c_created_date`, `c_modified_date`,`auth_pin`) VALUES ('$name','$password','$mobile_no','$email','$address',now(),now(),$pin)";
                    if ($connection->connect_errno) {
                        die('Connection Error');
                    } else {
                        $db_query =  $connection->query($query_stmt);

                        if ($db_query) {
                            echo '<div class="notifier" id="alert">
                <div class="alert alert-success alert-dismissible show fade" style="text-align:center;  role="alert">

                <strong >REGISTRATION SUCCESSFUL</strong> </div>
                
                </div>';
                            header('location:login');
                        } else {
                            echo '<div class="notifier" id="alert">
                <div class="alert alert-danger alert-dismissible show fade" style="text-align:center;  role="alert">

                <strong >Invalid Credentials</strong> </div>
                </div>';
                        }
                    }
                }
            }
        }
    }
    #----------------------------------------------------------------
    public static function login($email, $password)
    {
        $connection = DB_CONNECTION;

        if (empty($password) || empty($email)) {
            echo '<div style="text-align:center; " class="alert alert-danger alert-dismissible fade show" id="alert" role="alert">
       
        <strong>Fill All Fields </strong>
      </div>';
        } else {
            if (!$connection) {

                echo '<div style="text-align:center; " class="alert alert-danger alert-dismissible fade show" id="alert" role="alert">
           
            <strong>Unable To Connect </strong>
          </div>';
            } else {
                $email = trim($email);
                $password = md5($password);
                $query_stmt = "SELECT * FROM customers WHERE c_email='$email' AND c_pwd='$password'";
                $query_response = $connection->query($query_stmt);
                if (!$query_response) {
                    echo '<div style="text-align:center; " class="alert alert-success alert-dismissible fade show" id="alert" role="alert">
              
                 <strong>User Does Not Exist </strong>
               </div>';
                } else {


                    $response = $query_response->fetch_assoc();
                    if ($response === null) {
                        echo '<div style="text-align:center; " class="alert alert-success alert-dismissible fade show" id="alert" role="alert">
                         <strong>Check Username And Password</strong>
                       </div>';
                    } else {
                        echo '<div style="text-align:center; " class="alert alert-success alert-dismissible fade show" id="alert" role="alert">

                             <strong>Logging In </strong>
                           </div>';
                        session_start();
                        $_SESSION = $response;

                        header('location:userAuth');
                        $connection->close();
                    }
                }
            }
        }
    }
    public static function session()
    {
        if (!isset($_SESSION['c_name']) || !isset($_SESSION['c_email'])) {
            header('location:login');
        }
    }
    public static function logout()
    {
        if (isset($_POST['logout'])) {

            session_unset();
            session_destroy();
            header('location:login');
        }
    }
    public static function route()
    {
        $customerName = $_SESSION['c_name'];
        $connection = DB_CONNECTION;
        // --------------------------------------------
        $query_stmt_address = "SELECT  `c_address` FROM `customers` WHERE `c_name`='$customerName'";
        $address_qry = $connection->query($query_stmt_address);
        $address = $address_qry->fetch_assoc();
        // -----------------------------------------------
        $query_stmt_routes = "SELECT * FROM `routes`";
        $routes = $connection->query($query_stmt_routes);

        // -----------------------------------------------

        foreach ($routes as $route) {

            $to = $route['to'];
            $price = $route['price'];

            echo '<option value="' . $address['c_address'] . ' to ' . $to . ' - ' . $price . '">' . $address['c_address'] . ' to ' . $to . ' - ' . $price . '</option>';
        }
    }
    public static function ride()
    {
        $connection = DB_CONNECTION;
        $query_stmt = "SELECT * FROM `rides`";
        $rides = $connection->query($query_stmt);
        foreach ($rides as $ride) {
            $type = $ride['r_type'];
            $brand = $ride['r_brand'];
            $reg_no = $ride['r_reg_no'];


            echo '<option value="' . $type . ' - ' . $brand . ' - ' . $reg_no . '">' . $type . ' - ' . $brand . ' - ' . $reg_no . '</option>';
        }
    }
    public static function book()
    {
        if (isset($_POST['book'])) {

            $customerName = $_SESSION['c_name'];
            $ride = $_POST['ride'];
            $tripDate = $_POST['trip_date'];

            $routeInfo = explode('-', $_POST['route']);
            $price = $routeInfo[1];

            $locationInfo = explode('to', $routeInfo[0]);
            $from = $locationInfo[0];
            $to = $locationInfo[1];

            $connection = DB_CONNECTION;
            $query_stmt = "INSERT INTO `bookings`(`b_customer_name`, `b_ride`, `b_date`, `b_trip_fromlocation`, `b_trip_tolocation`, `b_trip_amount`, `b_created_by`, `b_created_date`, `b_modified_date`) VALUES ('$customerName','$ride',now(),'$from','$to','$price','$customerName',now(),now());";

            $book = $connection->query($query_stmt);

            if ($book) {
                echo  '<div class="notifier" id="alert">
                <div class="alert alert-success">
                    <strong>Booking Successful</strong>
                </div>
            </div>';
                echo '<script type="text/javascript">
                    setInterval(window.location.href="booking",20000);
                </script>';

                $mail = new PHPMailer(true);
                $mail->SMTPDebug = 2;
                $mail->isSMTP();
                $mail->Host = SMTP_HOST;
                $mail->SMTPAuth = SMTP_AUTH;
                $mail->Username = SMTP_USERNAME;
                $mail->Password = SMTP_PASSWORD;
                $mail->SMTPSecure = SMTP_SECURITY;
                $mail->Port = SMTP_PORT;

                $mail->setFrom(SMTP_EMAIL, 'Booking Confirmation');
                $mail->addAddress($_SESSION['c_email'], $_SESSION['c_name']);

                $mail->isHTML(true);

                $mail->Subject = 'Booking Confirmation';
                $mail->Body = ' 
                <html lang="en">
                <!DOCTYPE html>
                <meta http-equiv=Content-Type content="text/html; charset=UTF-8">
                <head>
                <style type="text/css">
                body,
                td,
                div,
                p,
                a,
                input {
                font-family: arial, sans-serif;
                }
                </style>
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <title>Gmail - Booking Confirmation - Landy</title>
                <style type="text/css">
                body,
                td {
                font-size: 13px
                }
                a:link,
                a:active {
                color: #1155CC;
                text-decoration: none
                }
                a:hover {
                text-decoration: underline;
                cursor: pointer
                }
                a:visited {
                color: ##6611CC
                }
                img {
                border: 0px
                }
                pre {
                white-space: pre;
                white-space: -moz-pre-wrap;
                white-space: -o-pre-wrap;
                white-space: pre-wrap;
                word-wrap: break-word;
                max-width: 800px;
                overflow: auto;
                }
                .logo {
                left: -7px;
                position: relative;
                }
                </style>
                </head>
                <body>
                <div class="bodycontainer">
                <hr>
                <div class="maincontent">
                <table width=100% cellpadding=0 cellspacing=0 border=0>
                <tr style="text-align:center;">
                <td>
                <h2><b>Booking Confirmation - FastRide</b></h2><br>
                </td>
                </tr>
                </table>
                <hr>
                <table width=100% cellpadding=0 cellspacing=0 border=0 class="message">
                <table width=100% cellpadding=12 cellspacing=0 border=0>
                <tr>
                <td>
                <div style="overflow: hidden;">
                <font size=-1>
                <u></u>
                <div>
                <table border="0" cellpadding="0" cellspacing="0" class="m_-1555617993795112461body">
                <tr>
                <td></td>
                <td class="m_-1555617993795112461container">
                <div class="m_-1555617993795112461content">
                <span class="m_-1555617993795112461preheader"></span>
                <div style="width:170px;padding-left:19px"></div>
                <table class="m_-1555617993795112461main">
                <tr>
                <td class="m_-1555617993795112461wrapper">
                <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                <td>
                <p>Dear ' . $customerName . ',
                <p>
                <p>
                Thank
                you for choosing FastRide
                </font>
                <p>
                <p>
                We look
                forward to welcoming you
                to start trip.</font>
                <p>
                <p><b>Trip Details :</b><br><br>
                ' . $from . '
                <br><b>to</b><br>' . $to . ' <br>on<br>
                ' . $tripDate . '
                <p>
                <p><b>Amount</b></p>
                <p>' . $price . '</p>
                <p>Our professional and
                friendly staff are
                committed to
                ensuring your travel
                is both enjoyable
                and comfortable.
                <p>
                <p>Should you have any
                requests prior to
                your travel, please
                do not hesitate to
                contact us and we
                will endeavor to
                assist you whenever
                possible.
                <p>
                </p>
                </p>
                </p>
                </p>
                </p>
                </p>
                </p>
                </td>
                </tr>
                </table>
                </td>
                </tr>
                </table>
                </div>
                </div>
                </td>
                </tr>
                </table>
                <div class="m_-1555617993795112461footer">
                <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                <td class="m_-1555617993795112461content-block">
                <span class="m_-1555617993795112461apple-link">FastRide</span>
                </td>
                </tr>
                </table>
                </div>
                </div>
                </body>
                </html>';


                if (!$mail->send()) {
                    echo 'TEst mail Failed to  send', $mail->ErrorInfo;
                } else {
                    echo 'Test Mail sent';
                }
            } else {
                echo  '<div class="notifier mt-3" id="alert">
                <div class="alert alert-danger">
                    <strong>Booking Failed</strong>
                </div>
            </div>';
            }
        }
    }
    public static function listBookings()
    {
        $customerName = $_SESSION['c_name'];
        $connection = DB_CONNECTION;
        $query_stmt = "SELECT `b_ride`, `b_date`, `b_trip_fromlocation`, `b_trip_tolocation`, `b_trip_amount`FROM `bookings` WHERE `b_customer_name` = '$customerName';";

        $bookings = $connection->query($query_stmt);
        if ($bookings) {
            echo '
                    <table class="table text-light m-0 p-0 border-0" style="background-color:#202433;">
                        <thead>
                            <tr style="text-align:center;">
                                <th scope="col">Ride</th>
                                <th scope="col">From</th>
                                <th scope="col">To</th>
                                <th scope="col">Date</th>
                                <th scope="col">Price</th>
                            </tr>
                        </thead>
                        <tbody>';


            foreach ($bookings as $booking) {
                $ride = $booking['b_ride'];
                $date = explode(' ', $booking['b_date']);
                $tripDate = $date[0];
                $tripTime = $date[1];
                $from = $booking['b_trip_fromlocation'];
                $to = $booking['b_trip_tolocation'];
                $price = $booking['b_trip_amount'];

                echo '<tr class="">
                                <td>' . $ride . '</td>
                                <td>' . $from . '</td>
                                <td>' . $to . '</td>
                                <td>' . $tripDate . '</td>
                                <td>' . $price . '</td>
                            </tr>';
            }

            echo '</tbody>
                    </table>';
        } else {
            echo 'no Bookings';
        }
    }
    public static function auth()
    {
        if (isset($_POST['auth_login'])) {

            $authPin = $_POST['pin'];
            $sessionPin = $_SESSION['auth_pin'];

            if ($authPin === $sessionPin) {

                echo  '<div class="notifier" id="alert">
                <div class="alert alert-success">
                    <strong>Access Granted</strong>
                </div>
            </div>';

                echo '<script type="text/javascript">
                    setInterval(window.location.href="booking",20000);
                </script>';
            } else {
                echo  '<div class="notifier" id="alert" style="z-index:3; display:absolute;">
                <div class="alert alert-warning">
                    <strong>Wrong Pin</strong>
                </div>
            </div>';
                echo '<script type="text/javascript">
                    setInterval(window.location.href="userAuth",20000);
                </script>';
            }
        }
    }

    public static function forgotpassword()
    {
        $username = trim($_POST['username']);
        $email = trim($_POST['registered-email']);
        $newPassword = trim(md5($_POST['new-password']));
        $confirmNewPassword = trim(md5($_POST['confirm-new-password']));
        $connection = DB_CONNECTION;

        if (!empty($username)) {
            if (!empty($email)) {
                if ($connection) {
                    $query = "SELECT * FROM customers WHERE c_name='$username' and c_email='$email'";
                    $sqlQuery = mysqli_query($connection, $query);
                    if ($sqlQuery) {
                        $request = mysqli_fetch_assoc($sqlQuery);
                        //  print_r($request);
                        if (
                            array_search($username, $request) &&
                            array_search($email, $request)
                        ) {
                            if (!empty($newPassword) && !empty($confirmNewPassword)) {
                                if ($newPassword === $confirmNewPassword) {
                                    $passwdquery = "UPDATE customers SET c_pwd='$newPassword' WHERE c_name='$username' and c_email='$email'";
                                    $sqlQuery = mysqli_query($connection, $passwdquery);
                                    if ($sqlQuery) {
                                        echo
                                        '<div style="text-align:center; " class="alert alert-success alert-dismissible fade show" id="alert" role="alert">
       
        <strong>Password Changed </strong>
      </div>';
                                    } else {
                                        echo '<div style="text-align:center; " class="alert alert-danger alert-dismissible fade show" id="alert" role="alert">
                   
                    <strong>ERROR!</strong>
                  </div>';
                                    }
                                } else {
                                    echo '<div style="text-align:center; " class="alert alert-danger alert-dismissible fade show" id="alert" role="alert">
       
        <strong>Passwords Do not Match </strong>
      </div>';
                                }
                            } else {
                                echo '<div style="text-align:center; " class="alert alert-danger alert-dismissible fade show" id="alert" role="alert">
            
             <strong>Passwords Cannot Be Empty</strong>
           </div>';
                            }
                        } else {
                            echo '<div style="text-align:center; " class="alert alert-danger alert-dismissible fade show" id="alert" role="alert">
           
            <strong>User Does Not Exist </strong>
          </div>';
                        }
                    } else {
                        echo '<div style="text-align:center; " class="alert alert-danger alert-dismissible fade show" id="alert" role="alert">
       
        <strong>Connection Error!</strong>
      </div>';
                    }
                } else {
                    echo '<div style="text-align:center; " class="alert alert-danger alert-dismissible fade show" id="alert" role="alert">
        
        <strong>Connection Error! </strong>
      </div>';
                }
            } else {
                echo '<div style="text-align:center; " class="alert alert-danger alert-dismissible fade show" id="alert" role="alert">
    
     <strong>Email Cannot Be Empty </strong>
   </div>';
            }
        } else {
            echo '
            <div class="notifier" id="alert">
            <div style="text-align:center;" class="alert alert-danger alert-dismissible show fade " id="alert" role="alert">
  
   <strong>Username Cannot Be Empty</strong>
 </div>
 </div>';
        }
    }
}