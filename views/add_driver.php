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
                    </form>
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
                                    <a href="">Driver</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Add Driver
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
            <?php
            admin::addDriver();
            ?>
            <section class="content">
                <div class="container-fluid">
                    <form method="post" id="customer_add" class="card" action="">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Name
                                            <span class="form-required">*</span>
                                        </label>
                                        <input type="text" required="true" class="form-control" value="" id="d_name" name="d_name" placeholder="xxxxxxxxxxxxxxxxxxxx">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Mobile
                                            <span class="form-required">*</span>
                                        </label>
                                        <input type="text" required="true" class="form-control" value="" id="d_mobile" name="d_mobile" placeholder="xxxxxxxxxxxxxxxxxxxx">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 ">
                                    <div class="form-group">
                                        <label class="form-label">Licence No
                                            <span class="form-required">*</span>

                                        </label>
                                        <input type="text" required="true" class="form-control" value="" id="d_licenseno" name="d_licenseno" placeholder="xxxxxxxxxxxxxxxxxxxx">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Address
                                            <span class="form-required">*</span>
                                        </label>
                                        <textarea class="form-control" required="true" id="d_address" autocomplete="off" placeholder="xxxxxxxxxxxxxxxxxxxx" name="d_address"></textarea>
                                    </div>
                                </div>
                            </div>

                        </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" name="add_driver" class="btn">
                        Add Driver
                    </button>
                </div>
                </div>
                </form>
                </div>



                </div>
                <?php include_once 'footer.php'; ?>