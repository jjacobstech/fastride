<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

#includes initialization file for class loading


include_once '../app/init.php';

#Initializes Customer class containing all actions that can be performed by the user
load::customer();
load::autoloader();

#starts the  user session 
session_start();
#Logout action
#Logout method called statically from the Customer class
customer::logout();


#Checks if the user has a session ,if true access is given to the dashboard, if false the user is redirected to the login page
customer::session();


?>
<!-- Dashboard Frontend -->
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets/bootstrap-5.2.0-beta1-dist/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/booking.css">
    <link rel="stylesheet" href="assets/css/libs.bundle.css">
    <link rel="stylesheet" href="assets/css/theme.bundle.css">
    <title>Booking</title>
</head>

<body class="text-light">
    <!-- Nav tabs -->
    <nav class="nav nav-fill bg-dark">
        <li class="nav-item text-light"><img src="assets/images/2.png" width="50" height="50"
                style=" border-radius:50%;">
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="#"></a>
        </li>
        <li class="nav-item">

            <a class="nav-link active" href="#"></a>

        <li>
        <li class="nav-item">

            <a class="nav-link active" href="#"></a>

        <li>


        </li>
        <li class="nav-item" style="display: flex;margin-left:120px;">
            <div style="margin-right: 10px;">
                <img class="mt-3" src="assets/images/user.jpg" width="30" height="30" alt=""
                    style=" border-radius:50%;">
            </div>
            <div>
                <p class="mb-0 mt-1 text-white"><?php
                                                echo $_SESSION['c_name'] ?></p>
                <small class="text-light"><?php
                                            echo $_SESSION['c_email'] ?></small>

            </div>

        </li>
        <li>
            <form method="post" action="">
                <button class="p-1" id="logout-btn" type="submit" name="logout">
                    <i class="ri-logout-box-r-line me-2"></i>

                    Logout
                </button>
            </form>
        </li>
    </nav>

    <div>

    </div>
    <div class="container-fluid">
        <div class="row mt-2">
            <div class="col-6 p-5 mt-5 text-light justify-content-center " style="padding-left:1000px;">
                <h3>Book Your Ride</h3>
                <div class='row mt-2'>
                    <div class='col'>

                        <form action='' method='post' enctype='multipart/form-data'>
                            <div class='mb-3'>
                                <label for='route' class='form-label'>Route</label>
                                <select id="route" name="route" required>
                                    <option value="">--Select a Route-- </option>
                                    <?php
                                    customer::route();
                                    ?>


                                </select>

                                <label for='ride' class='form-label'>Date</label>
                                <div class="col-sm-5">
                                    <input type="date" name="trip_date" id="date" class="form-control" value=""
                                        required="required" title="">
                                </div>

                                <label for='username' class='form-label'>Ride</label>

                                <select id="ride" name="ride" required>
                                    <option value="">--select a ride--</option>
                                    <?php
                                    customer::ride();
                                    ?>
                                </select>


                            </div>

                            <div class="mb-3"><button type='submit' name='book' id='book'>Book</button>
                            </div>
                        </form>
                        <?php customer::book();
                        ?>
                    </div>



                </div>

            </div>

            <div class=" col-sm-12 col-lg-6">
                <div class="card h-100" style="background-color: #202433;">
                    <div class="card-header d-flex border-0 pb-0 text-center">
                        <h6 class="card-title">Bookings</h6>

                    </div>
                    <div class="card-body">

                        <div class="tab-content" id="scheduleTabContent">

                            <div class="tab-pane fade show active" id="bookings" role="tabpanel">
                                <?php
                                customer::listBookings()
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>

<script src="assets/bootstrap-5.2.0-beta1-dist/js/bootstrap.js"></script>
<script src="assets/js/jquery-3.6.0.js"></script>
<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/index.js"></script>

</html>