<?php
include_once 'header.php';
include_once 'sidebar.php';

?>
<style>
    #scrollbars {
        overflow: scroll;
        scrollbar-color: rgb(0, 0, 0);
        scrollbar-width: solid;
        height: 500px;
    }
</style>

<body class="">
    <nav class="navbar navbar-expand-lg navbar-light border-0 py-0 fixed-top bg-dark-800">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center flex-grow-1 navbar-actions">

                <!-- Menu Toggle-->
                <div class="menu-toggle cursor-pointer me-4 text-primary-hover  disable-child-pointer">
                    <i class="ri-menu-fold-line ri-lg fold align-middle" data-bs-toggle="tooltip" data-bs-placement="right" title="Close menu"></i>
                    <i class="ri-menu-unfold-line ri-lg unfold align-middle" data-bs-toggle="tooltip" data-bs-placement="right" title="Open Menu"></i>
                </div>
                <!-- / Menu Toggle-->

                <!-- Navbar Actions-->
                <div class="d-flex align-items-right">

                    <!-- logout-->
                    <form method="post" action="">

                        <button id='logout-btn' class="text-white  p-2" style="background-color: transparent; border-radius:50rem; border:1px solid #202433; background-color:#202433;" type="submit" name="logout">
                            <i class="ri-lock-line me-2"></i>
                            Logout
                        </button>

                </div>
            </div>



        </div>
        <!-- / Navbar Actions-->

        </div>
        </div>
    </nav>

    <main id="main">
        <section class="container-fluid">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">

                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="">Rides</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Edit Ride
                                </li>
                            </ol>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- Main content -->

            <section class="content">
                <div class="container-fluid">
                    <form action="" method="post" id="" class="card">
                        <?php
                        admin::loadRideInfo()
                        ?>

                        <div class="modal-footer">
                            <button type="submit" name="save_ride_info" class="btn">
                                Save
                            </button>
                        </div>

                    </form>
                </div>
                <?php
                admin::saveRide();
                ?>
                </div>
                <?php include_once 'footer.php'; ?>