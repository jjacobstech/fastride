<?php
load::config();
class admin
{
    #Admin Authentication
    #Method for Registration Fuctionality
    public static function register($name, $email, $password, $confirmpassword)
    {


        if (empty($name) || empty($email)) {

            echo '
                  <div class="alert alert-warning alert-dismissible show fade" style="text-align:center;  role="alert">
                  
                  <strong >All Fields Must  Be Filled</strong> </div>
                  ';
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
                $name = trim($name);
                $email = trim($email);
                $password = md5(trim($_POST['password']));

                #---------------------------------------------------------------
                $connection = DB_CONNECTION;

                $query_stmt = "INSERT INTO `admin`(`a_name`,  `a_email`,`a_pwd`, `a_created_date`, `a_modified_date`) VALUES ('$name','$email','$password',now(),now())";
                if ($connection->connect_errno) {
                    die('Connection Error');
                } else {
                    $db_query =  $connection->query($query_stmt);

                    if ($db_query) {
                        echo '<div class="notifier" id="alert">
                <div class="alert alert-success alert-dismissible show fade" style="text-align:center;  role="alert">

                <strong >REGISTRATION SUCCESSFUL</strong> </div>
                </div>';
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

    #Method for Login Functionlity
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
                $query_stmt = "SELECT * FROM admin WHERE a_email='$email' AND a_pwd='$password'";
                $query_response = $connection->query($query_stmt);
                if (!$query_response) {
                    echo '<div style="text-align:center; " class="alert alert-success alert-dismissible fade show" id="alert" role="alert">
              
                 <strong>User Does Not Exist </strong>
               </div>';
                } else {


                    $response = $query_response->fetch_assoc();
                    if ($response !== null) {
                        echo '<div style="text-align:center; " class="alert alert-success alert-dismissible fade show" id="alert" role="alert">

                             <strong>Logging In </strong>
                           </div>';
                        session_start();
                        $_SESSION = $response;
                        header('location:dashboard');
                    } else {
                        echo '<div style="text-align:center; " class="alert alert-success alert-dismissible fade show" id="alert" role="alert">
                         <strong>Check Username And Password</strong>
                       </div>';
                    }
                }
            }
        }
    }

    #Method for Session Functionlity
    public static function session()
    {
        if (!isset($_SESSION['a_name']) || !isset($_SESSION['a_email'])) {
            header('location:login');
        }
    }

    #Method for Logout Functionality
    public static function logout()
    {
        if (isset($_POST['logout'])) {
            session_unset();
            session_destroy();
            header('location:admin/login');
        }
    }
    #---------------------------------------------

    #Dashboard Functionality
    #Method for driver data
    #Drivers Model - Loads  data of drivers from Database
    public static function drivers()
    {
        $connection = DB_CONNECTION;
        $query_stmt = "SELECT `d_id`, `d_name`, `d_mobile`, `d_address`, `d_licenseno`, `d_is_active`, `d_created_date`, `d_modified_date` FROM `drivers`;";

        $drivers = $connection->query($query_stmt);
        if ($drivers) {
            if ($drivers->num_rows > 0) {
                echo '
                    <table class="table text-light m-0 p-0 border-0" style="background-color:#202433;">
                        <thead>
                            <tr style="text-align:center;">
                                <th scope="col">Name</th>
                                <th scope="col">Mobile no</th>
                                <th scope="col">Address</th>
                                <th scope="col">License No</th>
                                <th scope="col">Created</th>
                              <th scope="col">Last Modified</th>

                            </tr>
                        </thead>
                        <tbody>';


                foreach ($drivers as $driver) {
                    $name = $driver['d_name'];
                    $mobileNo = $driver['d_mobile'];
                    $Address = $driver['d_address'];
                    $licenseNo = $driver['d_licenseno'];
                    $d_date_created = explode(' ', $driver['d_created_date']);
                    $dateCreated = $d_date_created[0];
                    $timeCreated = $d_date_created[1];

                    $d_date_modified = explode(' ', $driver['d_modified_date']);
                    $dateModified = $d_date_modified[0];
                    $timeModified = $d_date_modified[1];

                    echo '<tr style="text-align:center;">
                                <td>' . $name . '</td>
                                <td>' . $mobileNo . '</td>
                                <td>' . $Address . '</td>
                                <td>' . $licenseNo . '</td>
                                <td> <p>' . $dateCreated . '</p> <p>' . $timeCreated . '</p></td>
                                <td> <p>' . $dateModified . '</p> <p>' . $timeModified . '</p></td>
                            </tr>';
                }

                echo '</tbody>
                    </table>';
            } else {
                echo 'No Drivers';
            }
        }
    }

    #Method for rides data
    #Ride Model - Loads  data of rides from Database
    public static function rides()
    {
        $connection = DB_CONNECTION;
        $query_stmt = "SELECT `r_id`, `r_reg_no`, `r_name`, `r_model`, `r_chassis_no`, `r_engine_no`, `r_brand`, `r_type`, `r_color`, `r_reg_exp_date`, `r_created_date`, `r_modified_date` FROM `rides`;";

        $rides = $connection->query($query_stmt);
        if ($rides) {
            echo '
                    <table class=" w-100 table text-light m-0 p-0 border-0" style="background-color:#202433;">
                        <thead>
                            <tr style="text-align:center;">
                                 <th scope="col">Registration No</th>
                                 <th scope="col">Name</th>
                                <th scope="col">Model</th>
                                <th scope="col">Chassis No</th>
                                <th scope="col">Engine No</th>
                                <th scope="col">Brand</th>
                                <th scope="col">Type</th>
                             <th scope="col">Color</th>
                              <th scope="col">Reg Expiration</th>
                                <th scope="col">Created</th>
                             <th scope="col">Modified</th>

                            </tr>
                        </thead>
                        <tbody>';


            foreach ($rides as $ride) {
                $registrationNo = $ride['r_reg_no'];
                $name = $ride['r_name'];
                $model = $ride['r_model'];
                $chassis = $ride['r_chassis_no'];
                $engineNo = $ride['r_engine_no'];
                $brand = $ride['r_brand'];
                $type = $ride['r_type'];
                $color = $ride['r_color'];

                $reg_exp = explode(' ', $ride['r_reg_exp_date']);
                $reg_exp_date = $reg_exp[0];

                $r_date_created = explode(' ', $ride['r_created_date']);
                $dateCreated = $r_date_created[0];
                $timeCreated = $r_date_created[1];

                $r_date_modified = explode(' ', $ride['r_modified_date']);
                $dateModified = $r_date_modified[0];
                $timeModified = $r_date_modified[1];






                echo '<tr style="text-align:center;" class="">
                                <td>' . $registrationNo . '</td>
                                 <td>' . $name . '</td>
                                <td>' . $model . '</td>
                                <td>' . $chassis . '</td>
                                <td>' . $engineNo . '</td>
                                <td>' . $brand . '</td>
                                <td>' . $type . '</td>
                                <td>' . $color . '</td>
                                <td>' . $reg_exp_date . '</td>
                                  <td> <p>' . $dateCreated . '</p> <p>' . $timeCreated . '</p></td>
                                <td> <p>' . $dateModified . '</p> <p>' . $timeModified . '</p></td>
                            </tr>';
            }

            echo '</tbody>
                    </table>';
        } else {
            echo 'No Rides';
        }
    }
    #Method for customers data
    #Customers Model - Loads  data of customers from Database
    public static function customers()
    {
        $connection = DB_CONNECTION;
        $query_stmt = "SELECT `c_name`, `c_mobile`, `c_email`, `c_address`, `c_created_date`, `c_modified_date` FROM `customers`;";

        $customers = $connection->query($query_stmt);
        if ($customers) {
            if (!empty($customers->num_rows)) {
                echo '
                    <table class="table text-light m-0 p-0 border-0" style="background-color:#202433;">
                        <thead>
                            <tr style="text-align:center;">
                                 <th scope="col">Name</th>
                                <th scope="col">Moble No</th>
                                <th scope="col">Email</th>
                                <th scope="col">Address</th>
                                <th scope="col">Created</th>
                                <th scope="col">Modified</th>
                            </tr>
                        </thead>
                        <tbody>';


                foreach ($customers as $customer) {
                    $customerName = $customer['c_name'];
                    $mobileNo = $customer['c_mobile'];
                    $email = $customer['c_email'];
                    $Address = $customer['c_address'];

                    $c_date_created = explode(' ', $customer['c_created_date']);
                    $dateCreated = $c_date_created[0];
                    $timeCreated = $c_date_created[1];

                    $c_date_modified = explode(' ', $customer['c_modified_date']);
                    $dateModified = $c_date_modified[0];
                    $timeModified = $c_date_modified[1];


                    echo '<tr style="text-align:center;">
                                <td>' . $customerName . '</td>
                                <td>' . $mobileNo . '</td>
                                <td>' . $email . '</td>
                                <td>' . $Address . '</td>
                          <td> <p>' . $dateCreated . '</p> <p>' . $timeCreated . '</p></td>
                                <td> <p>' . $dateModified . '</p> <p>' . $timeModified . '</p></td>
                            </tr>';
                }

                echo '</tbody>
                    </table>';
            } else {
                echo 'No Customers';
            }
        }
    }

    #Method for bookings data
    #Bookings Model - Loads  data of bookings from Database
    public static function bookings()
    {
        $connection = DB_CONNECTION;
        $query_stmt = "SELECT `b_customer_name`, `b_ride`, `b_date`, `b_trip_fromlocation`, `b_trip_tolocation`, `b_trip_amount`,`b_approved` FROM `bookings` WHERE `b_approved`='Approved';";

        $bookings = $connection->query($query_stmt);
        if ($bookings) {
            if (!empty($bookings->num_rows)) {
                echo '
                    <table class="table text-light m-0 p-0 border-0" style="background-color:#202433;">
                        <thead>
                            <tr style="text-align:center;">
                                 <th scope="col">Customer</th>
                                <th scope="col">Ride</th>
                                <th scope="col">From</th>
                                <th scope="col">To</th>
                                <th scope="col">Date</th>
                                <th scope="col">Price</th>
                                <th scope="col">Status</th>

                            </tr>
                        </thead>
                        <tbody>';


                foreach ($bookings as $booking) {
                    $customer = $booking['b_customer_name'];
                    $ride = $booking['b_ride'];
                    $date = explode(' ', $booking['b_date']);
                    $tripDate = $date[0];
                    $tripTime = $date[1];
                    $from = $booking['b_trip_fromlocation'];
                    $to = $booking['b_trip_tolocation'];
                    $price = $booking['b_trip_amount'];
                    $approved = $booking['b_approved'];

                    echo '<tr style="text-align:center;">
                                <td>' . $customer . '</td>
                                <td>' . $ride . '</td>
                                <td>' . $from . '</td>
                                <td>' . $to . '</td>
                                <td>' . $tripDate . '</td>
                                <td>' . $price . '</td>
                               <td>' . $approved . '</td>

                            </tr>';
                }

                echo '</tbody>
                    </table>';
            } else {
                echo 'No Bookings';
            }
        }
    }
    #----------------------------------------

    #Customer Functionality
    #Customer Editing Functionlity

    #Edit Customer Page Rendering
    public static function editCustomers()
    {
        $connection = DB_CONNECTION;
        $query_stmt = "SELECT `c_name`, `c_mobile`, `c_email`, `c_address`, `c_created_date`, `c_modified_date` FROM `customers`;";

        $customers = $connection->query($query_stmt);
        if ($customers) {
            if (!empty($customers->num_rows)) {
                echo '
                    <table class="table text-light m-0 p-0 border-0" style="background-color:#202433;">
                        <thead>
                            <tr style="text-align:center;">
                                 <th scope="col">Name</th>
                                <th scope="col">Moble No</th>
                                <th scope="col">Email</th>
                                <th scope="col">Address</th>
                                <th scope="col">Created</th>
                                <th scope="col">Modified</th>
                            </tr>
                        </thead>
                        <tbody>';


                foreach ($customers as $customer) {
                    $customerName = $customer['c_name'];
                    $mobileNo = $customer['c_mobile'];
                    $email = $customer['c_email'];
                    $Address = $customer['c_address'];

                    $c_date_created = explode(
                        ' ',
                        $customer['c_created_date']
                    );
                    $dateCreated = $c_date_created[0];
                    $timeCreated = $c_date_created[1];

                    $c_date_modified = explode(' ', $customer['c_modified_date']);
                    $dateModified = $c_date_modified[0];
                    $timeModified = $c_date_modified[1];


                    echo '<tr style="text-align:center;">
                                <td>' . $customerName . '</td>
                                <td>' . $mobileNo . '</td>
                                <td>' . $email . '</td>
                                <td>' . $Address . '</td>
                          <td> <p>' . $dateCreated . '</p> <p>' . $timeCreated . '</p></td>
                                <td> <p>' . $dateModified . '</p> <p>' . $timeModified . '</p></td>
                     <form action="" method="post">
                       <td><button type="submit" name="remove" value="' . $customerName . '">Remove</button></td>
           
                    <td><button type="submit" name="edit" value="' . $customerName . '">Edit</button></td>
                                </form>

                            </tr>';
                }

                echo '</tbody>
                    </table>';
            } else {
                echo 'No Customers';
            }
        }
    }

    #Link To page  For Editing Driver Infomation
    public static function editCustomer()
    {
        if (isset($_POST['edit'])) {
            $_SESSION['edit'] = $_POST['edit'];
            echo '<script type="text/javascript">
            window.location.href="editUserInfo"
                </script>';
        }
    }

    #Render User Detail from  the Database
    public static function loadCustomerInfo()
    {
        $customerName = $_SESSION['edit'];

        $connection = DB_CONNECTION;
        $query_stmt = "SELECT  `c_id`,`c_name`, `c_mobile`, `c_email`, `c_address` FROM `customers` WHERE `c_name`='$customerName';";

        $userInfo = $connection->query($query_stmt);

        if ($userInfo->num_rows > 0) {
            $userInfo = $userInfo->fetch_assoc();
            if ($userInfo) {
                $id = $userInfo['c_id'];
                $name = $userInfo['c_name'];
                $mobile = $userInfo['c_mobile'];
                $email = $userInfo['c_email'];
                $address = $userInfo['c_address'];
                echo '
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Name
                                            <span class="form-required">*</span>
                                        </label>
                                        <input type="hidden" name="c_id" value="' . $id . '">
                                        <input type="text" required="true" class="form-control" value="' . $name . '" id="c_name"
                                            name="c_name" placeholder="xxxxxxxxxxxxxxxxxxxx">
                                    </div>
                                </div>
                                 <div class="col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">Mobile
                                                <span class="form-required">*</span>
                                            </label>
                                       <input type="text" required="true"
                                     class="form-control" value="' . $mobile . '"
                                                id="c_mobile" name="c_mobile" placeholder="xxxxxxxxxxxxxxxxxxxx">
                                        </div>
                                    </div>
                                <div class="row">
                                  
                                    <div class="col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">Email
                                                <span class="form-required">*</span>
                                            </label>
                                         <input type="text" required="true" class="form-control" value="' . $email . '"
                                                id="c_email" name="c_email" placeholder="xxxxxxxxxxxxxxxxxxxx">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">Address
                                                <span class="form-required">*</span>
                                            </label>
                                            <input type="text" required="true" class="form-control" value="' . $address . '"
                                                id="c_address" name="c_address" placeholder="xxxxxxxxxxxxxxxxxxxx">
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>';
            }
        }
    }

    #Remove Customer From the Database
    public static function removeCustomer()
    {
        if (isset($_POST['remove'])) {
            $customer = $_POST['remove'];
            $connection = DB_CONNECTION;
            $query_stmt = "DELETE  FROM `customers` WHERE `c_name`='$customer' ";
            $removeUserInfo = $connection->query($query_stmt);
            if ($removeUserInfo) {
                echo '<script type="text/javascript">
            window.location.href="editUsers"
                </script>';
            }
        }
    }

    #Save Customer Info Into Database
    public static function saveCustomer()
    {
        if (isset($_POST['save_user_info'])) {
            print_r($_POST);
            $id = $_POST['c_id'];
            $customerName = $_POST['c_name'];
            $mobileNo = $_POST['c_mobile'];
            $email = $_POST['c_email'];
            $address = $_POST['c_address'];

            echo $customerName;
            $connection = DB_CONNECTION;

            $query_stmt = "UPDATE `customers` SET `c_name`='$customerName',`c_mobile`='$mobileNo',`c_email`='$email',`c_address`='$address',`c_modified_date`=now() WHERE `c_id`='$id'";

            $save = $connection->query($query_stmt);
            if ($save) {
                echo  '<div class="notifier" id="alert">
                    <div class="alert alert-success">
                        <strong>Updated</strong>
                    </div>
                </div>';
                echo '<script type="text/javascript">
                        setInterval(window.location.href="editUsers",20000);
                    </script>';
            } else {
                echo  '<div class="notifier" id="alert">
                <div class="alert alert-success">
                    <strong>An Error has occured</strong>
                </div>
            </div>';
            }
        }
    }

    public static function addCustomer()
    {
        if (isset($_POST['addCustomer'])) {
            $customerName = $_POST['c_name'];
            $password = md5($_POST['c_password']);
            $mobileNo = $_POST['c_mobile'];
            $email = $_POST['c_email'];
            $address = $_POST['c_address'];

            $connection =  DB_CONNECTION;
            $query_stmt = "INSERT INTO `customers`(`c_name`, `c_pwd`, `c_mobile`, `c_email`, `c_address`, `c_created_date`, `c_modified_date`) VALUES ('$customerName','$password','$mobileNo','$email','$address',now(),now())";

            $addCustomer = $connection->query($query_stmt);

            if ($addCustomer) {
                echo  '<div class="notifier" id="alert">
                <div class="alert alert-success">
                    <strong>Customer  Added</strong>
                </div>
            </div>';
            }
        }
    }
    #-----------------------------------------------------
    #Driver Functionality
    #Driver Editing Functionlity

    #Edit Driver Page Rendering
    public static function editDrivers()
    {
        $connection = DB_CONNECTION;
        $query_stmt = "SELECT `d_name`, `d_mobile`, `d_address`, `d_licenseno`, `d_created_date`, `d_modified_date` FROM `drivers`;";

        $drivers = $connection->query($query_stmt);
        if ($drivers) {
            if (!empty($drivers->num_rows)) {
                echo '
                    <table class="table text-light m-0 p-0 border-0" style="background-color:#202433;">
                        <thead>
                            <tr style="text-align:center;">
                                 <th scope="col">Name</th>
                                <th scope="col">Moble No</th>
                                <th scope="col">Address</th>
                                <th scope="col">License No</th>
                                <th scope="col">Created</th>
                                <th scope="col">Modified</th>
                            </tr>
                        </thead>
                        <tbody>';


                foreach ($drivers as $driver) {
                    $driverName = $driver['d_name'];
                    $mobileNo = $driver['d_mobile'];
                    $Address = $driver['d_address'];
                    $License = $driver['d_licenseno'];

                    $d_date_created = explode(' ', $driver['d_created_date']);
                    $dateCreated = $d_date_created[0];
                    $timeCreated = $d_date_created[1];

                    $d_date_modified = explode(' ', $driver['d_modified_date']);
                    $dateModified = $d_date_modified[0];
                    $timeModified = $d_date_modified[1];


                    echo '<tr style="text-align:center;">
                                <td>' . $driverName . '</td>
                                <td>' . $mobileNo . '</td>
                                <td>' . $Address . '</td>
                                <td>' . $License . '</td>
                          <td> <p>' . $dateCreated . '</p> <p>' . $timeCreated . '</p></td>
                                <td> <p>' . $dateModified . '</p> <p>' . $timeModified . '</p></td>
                     <form action="" method="post">
                       <td><button type="submit" name="remove" value="' . $driverName . '">Remove</button></td>
           
                    <td><button type="submit" name="edit" value="' . $driverName . '">Edit</button></td>
                                </form>

                            </tr>';
                }

                echo '</tbody>
                    </table>';
            } else {
                echo 'No Drivers ';
            }
        }
    }

    #Link To page  For Editing Driver Infomation
    public static function editDriver()
    {
        if (isset($_POST['edit'])) {
            $_SESSION['edit'] = $_POST['edit'];
            echo '<script type="text/javascript">
            window.location.href="editDriverInfo"
                </script>';
        }
    }

    #Render Driver Detail from  the Database
    public static function loadDriverInfo()
    {
        $driverName = $_SESSION['edit'];

        $connection = DB_CONNECTION;
        $query_stmt = "SELECT  `d_id`,`d_name`, `d_mobile`, `d_address`,`d_licenseno` FROM `drivers` WHERE `d_name`='$driverName';";


        $driverInfo = $connection->query($query_stmt);

        if ($driverInfo->num_rows > 0) {
            $driverInfo = $driverInfo->fetch_assoc();
            if ($driverInfo) {
                $id = $driverInfo['d_id'];
                $name = $driverInfo['d_name'];
                $mobileNo = $driverInfo['d_mobile'];
                $address = $driverInfo['d_address'];
                $licenceNo = $driverInfo['d_licenseno'];

                echo '
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Name
                                            <span class="form-required">*</span>
                                        </label>
                                        <input type="hidden" name="d_id" value="' . $id . '">
                                        <input type="text" required="true" class="form-control" value="' . $name . '" id=""
                                            name="d_name" placeholder="xxxxxxxxxxxxxxxxxxxx">
                                    </div>
                                </div>
                                 <div class="col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">Mobile No
                                                <span class="form-required">*</span>
                                            </label>
                                       <input type="text" required="true"
                                     class="form-control" value="' . $mobileNo . '"
                                                id="" name="d_mobile" placeholder="xxxxxxxxxxxxxxxxxxxx">
                                        </div>
                                    </div>
                                <div class="row">
                                  
                                    <div class="col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">Address
                                                <span class="form-required">*</span>
                                            </label>
                                         <input type="text" required="true" class="form-control" value="' . $address . '"
                                                id="" name="d_address" placeholder="xxxxxxxxxxxxxxxxxxxx">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">License No
                                                <span class="form-required">*</span>
                                            </label>
                                            <input type="text" required="true" class="form-control" value="' . $licenceNo . '"
                                                id="" name="d_licenseno" placeholder="xxxxxxxxxxxxxxxxxxxx">
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>';
            }
        }
    }

    #Remove Driver From the Database
    public static function removeDriver()
    {
        if (isset($_POST['remove'])) {
            $driver = $_POST['remove'];
            $connection = DB_CONNECTION;
            $query_stmt = "DELETE  FROM `drivers` WHERE `d_name`='$driver' ";
            $removeDriverInfo = $connection->query($query_stmt);
            if ($removeDriverInfo) {
                echo  '<div class="notifier" id="alert">
                <div class="alert alert-success">
                    <strong>Driver Removed</strong>
                </div>
            </div>';
                echo '<script type="text/javascript">
                    setInterval(window.location.href="editDrivers",20000);
                </script>';
            }
        }
    }

    #Save Driver Info Into Database
    public static function saveDriver()
    {
        if (isset($_POST['save_driver_info'])) {

            $id = $_POST['d_id'];
            $driverName = $_POST['d_name'];
            $mobileNo = $_POST['d_mobile'];
            $address = $_POST['d_address'];
            $licenseNo = $_POST['d_licenseno'];

            $connection = DB_CONNECTION;

            $query_stmt = "UPDATE `drivers` SET `d_name`='$driverName',`d_mobile`='$mobileNo',`d_address`='$address',`d_licenseno`='$licenseNo',`d_modified_date`=now() WHERE `d_id`='$id'";

            $save = $connection->query($query_stmt);
            if ($save) {
                echo  '<div class="notifier" id="alert">
                    <div class="alert alert-success">
                        <strong>Updated</strong>
                    </div>
                </div>';
                echo '<script type="text/javascript">
                        setInterval(window.location.href="editDrivers",20000);
                    </script>';
            } else {
                echo  '<div class="notifier" id="alert">
                <div class="alert alert-success">
                    <strong>An Error has occured</strong>
                </div>
            </div>';
            }
        }
    }
    #Add Driver to Database
    public static function addDriver()
    {
        if (isset($_POST['add_driver'])) {
            $driverName = $_POST['d_name'];
            $mobileNo = $_POST['d_mobile'];
            $address = $_POST['d_address'];
            $licenseNo = $_POST['d_licenseno'];


            $connection =  DB_CONNECTION;
            $query_stmt = "INSERT INTO `drivers`(`d_name`, `d_mobile`, `d_address`, `d_licenseno`,`d_created_date`, `d_modified_date`) VALUES ('$driverName','$mobileNo','$address','$licenseNo',now(),now());";

            $addCustomer = $connection->query($query_stmt);

            if ($addCustomer) {
                echo  '<div class="notifier" id="alert">
                <div class="alert alert-success">
                    <strong>Driver  Added</strong>
                </div>
            </div>';
            }
        }
    }
    #-----------------------------------------------

    #Ride Functionality
    #Ride Editing Functionlity

    #Edit Ride Page Rendering
    public static function editRides()
    {
        $connection = DB_CONNECTION;
        $query_stmt = "SELECT `r_id`, `r_reg_no`, `r_name`, `r_model`, `r_chassis_no`, `r_engine_no`, `r_brand`, `r_type`, `r_color`, `r_reg_exp_date`, `r_created_date`, `r_modified_date` FROM `rides`;";

        $rides = $connection->query($query_stmt);
        if ($rides->num_rows > 0) {
            if ($rides) {
                echo '
                    <table class=" w-100 table text-light m-0 p-0 border-0" style="background-color:#202433;">
                        <thead>
                            <tr style="text-align:center;">
                                 <th scope="col">Registration No</th>
                                 <th scope="col">Name</th>
                                <th scope="col">Model</th>
                                <th scope="col">Chassis No</th>
                                <th scope="col">Engine No</th>
                                <th scope="col">Brand</th>
                                <th scope="col">Type</th>
                             <th scope="col">Color</th>
                              <th scope="col">Reg Expiration</th>
                                <th scope="col">Created</th>
                             <th scope="col">Modified</th>

                            </tr>
                        </thead>
                        <tbody>';


                foreach ($rides as $ride) {
                    $registrationNo = $ride['r_reg_no'];
                    $rideName = $ride['r_name'];
                    $model = $ride['r_model'];
                    $chassisNo = $ride['r_chassis_no'];
                    $engineNo = $ride['r_engine_no'];
                    $brand = $ride['r_brand'];
                    $type = $ride['r_type'];
                    $color = $ride['r_color'];

                    $reg_exp = explode(' ', $ride['r_reg_exp_date']);
                    $reg_exp_date = $reg_exp[0];

                    $r_date_created = explode(' ', $ride['r_created_date']);
                    $dateCreated = $r_date_created[0];
                    $timeCreated = $r_date_created[1];

                    $r_date_modified = explode(' ', $ride['r_modified_date']);
                    $dateModified = $r_date_modified[0];
                    $timeModified = $r_date_modified[1];






                    echo '<tr style="text-align:center;">
                                <td>' . $registrationNo . '</td>
                                <td>' . $rideName . '</td>
                                <td>' . $model . '</td>
                                <td>' . $chassisNo . '</td>
                              <td>' . $engineNo . '</td>
                                <td>' . $brand . '</td>
                                <td>' . $type . '</td>
                                <td>' . $color . '</td>
                               <td>' . $reg_exp_date . '</td>
                          <td> <p>' . $dateCreated . '</p> <p>' . $timeCreated . '</p></td>
                                <td> <p>' . $dateModified . '</p> <p>' . $timeModified . '</p></td>
                     <form action="" method="post">
                       <td><button type="submit" name="remove" value="' . $rideName . '">Remove</button></td>

                    <td><button type="submit" name="edit" value="' . $rideName . '">Edit</button></td>
                                </form>

                            </tr>';
                }

                echo '</tbody>
                    </table>';
            }
        } else {
            echo 'No Rides';
        }
    }

    #Link To page  For Editing Rides Infomation
    public static function editRide()
    {
        if (isset($_POST['edit'])) {
            $_SESSION['edit'] = $_POST['edit'];
            echo '<script type="text/javascript">
            window.location.href="editRideInfo"
                </script>';
        }
    }


    #Render Rides Detail from  the Database
    public static function loadRideInfo()
    {
        $rideName = $_SESSION['edit'];

        $connection = DB_CONNECTION;
        $query_stmt = " SELECT  `r_id`, `r_reg_no`, `r_name`, `r_model`, `r_chassis_no`, `r_engine_no`, `r_brand`, `r_type`, `r_color`, `r_reg_exp_date`, `r_created_date`, `r_modified_date` FROM `rides` WHERE `r_name`='$rideName'; ";


        $rideInfo = $connection->query($query_stmt);


        if ($rideInfo->num_rows > 0) {
            $rideInfo = $rideInfo->fetch_assoc();
            if ($rideInfo) {

                $id = $rideInfo['r_id'];
                $registrationNo = $rideInfo['r_reg_no'];
                $name = $rideInfo['r_name'];
                $model = $rideInfo['r_model'];
                $chassisNo = $rideInfo['r_chassis_no'];
                $engineNo = $rideInfo['r_engine_no'];
                $brand = $rideInfo['r_brand'];
                $type = $rideInfo['r_type'];
                $color = $rideInfo['r_color'];
                $reg_exp_date = $rideInfo['r_reg_exp_date'];


                echo '
                        <class="card-body">
                            <div class="row">
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                         <input type="hidden" required="true" class="form-control" value="' . $id . '"  name="r_id">
                                        <label class="form-label">Registration No <span class="form-required">*</span>
                                        </label>
                                        <input type="text" required="true" class="form-control" value="' . $registrationNo . '"
                                            id="registrationNo" name="r_reg_no" placeholder="xxxxxxxxxxxxxxxxxxxx">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Name
                                            <span class="form-required">*</span>
                                        </label>
                                        <input type="text" required="true" class="form-control" value="' . $name . '" id="name"
                                            name="r_name" placeholder="xxxxxxxxxxxxxxxxxxxx">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Model
                                            <span class="form-required">*</span>
                                        </label>
                                        <input type="text" required="true" class="form-control" value="' . $model . '" id=""
                                            name="r_model" placeholder="xxxxxxxxxxxxxxxxxxxx">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Chassis No
                                            <span class="form-required">*</span>

                                        </label>
                                        <input type="text" required="true" class="form-control" value="' . $chassisNo . '" id=""
                                            name="r_chassis_no" placeholder="xxxxxxxxxxxxxxxxxxxx">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Engine No
                                            <span class="form-required">*</span>
                                        </label>
                                        <input type="text" required="true" class="form-control" value="' . $engineNo . '" id=""
                                            name="r_engine_no" placeholder="xxxxxxxxxxxxxxxxxxxx">
                                    </div>

                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Brand
                                            <span class="form-required">*</span>
                                        </label>
                                        <input type="text" required="true" class="form-control" value="' . $brand . '" id="brand"
                                            name="r_brand" placeholder="xxxxxxxxxxxxxxxxxxxx">
                                    </div>

                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Type
                                            <span class="form-required">*</span>
                                        </label>
                                        <input type="text" required="true" class="form-control" value="' . $type . '" id=""
                                            name="r_type" placeholder="xxxxxxxxxxxxxxxxxxxx">
                                    </div>

                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Color
                                            <span class="form-required">*</span>
                                        </label>
                                        <input type="text" required="true" class="form-control" value="' . $color . '" id=""
                                            name="r_color" placeholder="xxxxxxxxxxxxxxxxxxxx">
                                    </div>

                                </div>

                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Registartion Expiration
                                            <span class="form-required">*</span>
                                        </label>
                                        <input type="date" required="true" class="form-control" value="' . $reg_exp_date . '" id=""
                                            name="r_reg_exp_date" placeholder="xxxxxxxxxxxxxxxxxxxx">
                                    </div>

                                </div>
                            </div>';
            }
        }
    }

    #Remove Ride From the Database
    public static function removeRide()
    {
        if (isset($_POST['remove'])) {
            $ride = $_POST['remove'];
            $connection = DB_CONNECTION;
            $query_stmt = "DELETE  FROM `rides` WHERE `r_name`='$ride' ";
            $removeRideInfo = $connection->query($query_stmt);
            if ($removeRideInfo) {
                echo  '<div class="notifier" id="alert">
                <div class="alert alert-success">
                    <strong>Ride Removed</strong>
                </div>
            </div>';
                echo '<script type="text/javascript">
                    setInterval(window.location.href="editRides",20000);
                </script>';
            }
        }
    }

    #Save Ride Info Into Database
    public static function saveRide()
    {
        if (isset($_POST['save_ride_info'])) {

            $id = $_POST['r_id'];
            $registrationNo = $_POST['r_reg_no'];
            $name = $_POST['r_name'];
            $model = $_POST['r_model'];
            $chassisNo = $_POST['r_chassis_no'];
            $engineNo = $_POST['r_engine_no'];
            $brand = $_POST['r_brand'];
            $type = $_POST['r_type'];
            $color = $_POST['r_color'];
            $reg_exp_date = $_POST['r_reg_exp_date'];

            $connection = DB_CONNECTION;



            $query_stmt = "UPDATE `rides` SET  `r_reg_no`='$registrationNo',`r_name`='$name',`r_model`='$model',`r_chassis_no`='$chassisNo',`r_engine_no`='$engineNo',`r_brand`='$brand',`r_type`='$type',`r_color`='$color',`r_reg_exp_date`='$reg_exp_date',`r_modified_date`=now() WHERE `r_id`='$id';";

            $save = $connection->query($query_stmt);
            if ($save) {
                echo  '<div class="notifier" id="alert">
                    <div class="alert alert-success">
                        <strong>Updated</strong>
                    </div>
                </div>';
                echo '<script type="text/javascript">
                        setInterval(window.location.href="editRides",20000);
                    </script>';
            } else {
                echo  '<div class="notifier" id="alert">
                <div class="alert alert-success">
                    <strong>An Error has occured</strong>
                </div>
            </div>';
            }
        }
    }
    #Add Driver to Database
    public static function addRide()
    {
        if (isset($_POST['add_ride'])) {
            $rideRegistrationNo = $_POST['r_reg_no'];
            $rideName = $_POST['r_name'];
            $rideModel = $_POST['r_model'];
            $rideChassisNo = $_POST['r_chassis_no'];
            $rideEngineNo = $_POST['r_engine_no'];
            $rideBrand = $_POST['r_brand'];
            $rideType = $_POST['r_type'];
            $rideColor = $_POST['r_color'];
            $rideRegistrationDate = $_POST['r_reg_exp_date'];

            $connection =  DB_CONNECTION;
            $query_stmt = "INSERT INTO `rides`(`r_reg_no`,`r_name`, `r_model`, `r_chassis_no`, `r_engine_no`, `r_brand`, `r_type`,`r_color`,`r_reg_exp_date`,`r_created_date`,`r_modified_date`) VALUES ('$rideRegistrationNo','$rideName','$rideModel','$rideChassisNo','$rideEngineNo','$rideBrand','$rideType','$rideColor','$rideRegistrationDate',now(),now());";

            $addRide = $connection->query($query_stmt);

            if ($addRide) {
                echo  '<div class="notifier" id="alert">
                <div class="alert alert-success">
                    <strong>Ride Added</strong>
                </div>
            </div>';
            }
        }
    }

    #Booking Functionality
    #Booking Editing Functionlity

    #Edit Booking Page Rendering
    public static function loadBookings()
    {
        $connection = DB_CONNECTION;
        $query_stmt = "SELECT `b_id`, `b_customer_name`, `b_ride`, `b_date`, `b_trip_fromlocation`, `b_trip_tolocation`, `b_trip_amount`, `b_created_by`, `b_created_date`, `b_modified_date` FROM `bookings` WHERE `b_approved`= '0';";

        $bookings = $connection->query($query_stmt);
        if ($bookings->num_rows > 0) {
            if ($bookings) {
                echo '
                    <table class=" w-100 table text-light m-0 p-0 border-0" style="background-color:#202433;">
                        <thead>
                            <tr style="text-align:center;">
                                 <th scope="col">Customer</th>
                                 <th scope="col">Ride</th>
                                <th scope="col">Date</th>
                                <th scope="col">From</th>
                                <th scope="col">To</th>
                                <th scope="col">Price</th>
                                <th scope="col">Created By</th>
                                <th scope="col">Created</th>
                             <th scope="col">Modified</th>

                            </tr>
                        </thead>
                        <tbody>';


                foreach ($bookings as $booking) {
                    $id = $booking['b_id'];
                    $name = $booking['b_customer_name'];
                    $ride = $booking['b_ride'];
                    $date = $booking['b_date'];
                    $from = $booking['b_trip_fromlocation'];
                    $to = $booking['b_trip_tolocation'];
                    $price = $booking['b_trip_amount'];
                    $createdBy = $booking['b_created_by'];
                    $created = $booking['b_created_date'];
                    $modified = $booking['b_modified_date'];


                    $created = explode(' ', $booking['b_created_date']);
                    $dateCreated = $created[0];
                    $timeCreated = $created[1];

                    $modified = explode(' ', $booking['b_modified_date']);
                    $dateModified = $modified[0];
                    $timeModified = $modified[1];






                    echo '<tr style="text-align:center;">
                                <td>' . $name . '</td>
                                <td>' . $ride . '</td>
                                <td>' . $date . '</td>
                                <td>' . $from . '</td>
                              <td>' . $to . '</td>
                                <td>' . $price . '</td>
                              <td>' . $createdBy . '</td>

                          <td> <p>' . $dateCreated . '</p> <p>' . $timeCreated . '</p></td>
                                <td> <p>' . $dateModified . '</p> <p>' . $timeModified . '</p></td>
                     <form action="" method="post">
                       <td><button type="submit" name="remove" value="' . $id . '">Remove</button></td>

                    <td><button type="submit" name="approve" value="' . $id . '">Approve</button></td>
                                </form>

                            </tr>';
                }

                echo '</tbody>
                    </table>';
            }
        } else {
            echo 'No Bookings';
        }
    }


    #Link To page  For Editing Rides Infomation
    public static function approveBooking()
    {
        if (isset($_POST['approve'])) {
            $id = $_POST['approve'];
            $connection = DB_CONNECTION;
            $query_stmt = "UPDATE `bookings` SET `b_approved`='Approved'WHERE  `b_id`='$id';";

            $approveBooking = $connection->query($query_stmt);

            if ($approveBooking) {
                echo  '<div class="notifier" id="alert">
                <div class="alert alert-success">
                    <strong>Booking Approved</strong>
                </div>
            </div>';
                echo '<script type="text/javascript">
                    setInterval(window.location.href="editBookings",20000);
                </script>';
            }
        }
    }


    #Remove Booking From the Database
    public static function removeBooking()
    {
        if (isset($_POST['remove'])) {
            $booking = $_POST['remove'];
            $connection = DB_CONNECTION;
            $query_stmt = "DELETE  FROM `bookings` WHERE `b_id`='$booking' ";
            $removeBookingInfo = $connection->query($query_stmt);
            if ($removeBookingInfo) {
                echo  '<div class="notifier" id="alert">
                <div class="alert alert-success">
                    <strong>Booking Removed</strong>
                </div>
            </div>';
                echo '<script type="text/javascript">
                    setInterval(window.location.href="editBookings",20000);
                </script>';
            }
        }
    }

    #Add Driver to Database
    public static function addBooking()
    {
        if (isset($_POST['add_booking'])) {

            $name = $_POST['c_customer_name'];
            $ride = $_POST['b_ride'];
            $date = $_POST['b_date'];
            $from = $_POST['b_trip_fromlocation'];
            $to = $_POST['b_trip_fromlocation'];
            $price = $_POST['b_trip_amount'];
            $createdBy = $_SESSION['a_name'];

            $connection =  DB_CONNECTION;
            $query_stmt = "INSERT INTO `bookings`(`b_customer_name`, `b_ride`, `b_date`, `b_trip_fromlocation`, `b_trip_tolocation`, `b_trip_amount`, `b_created_by`, `b_created_date`, `b_modified_date`) VALUES ('$name','$ride','$date','$from','$to','$price','$createdBy',now(),now());";

            $addBooking = $connection->query($query_stmt);

            if ($addBooking) {
                echo  '<div class="notifier" id="alert">
                <div class="alert alert-success">
                    <strong>Ride Added</strong>
                </div>
            </div>';
            }
        }
    }
}
