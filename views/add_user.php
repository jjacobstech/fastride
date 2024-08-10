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
                    <i class="ri-menu-fold-line ri-lg fold align-middle" data-bs-toggle="tooltip"
                        data-bs-placement="right" title="Close menu"></i>
                    <i class="ri-menu-unfold-line ri-lg unfold align-middle" data-bs-toggle="tooltip"
                        data-bs-placement="right" title="Open Menu"></i>
                </div>
                <!-- / Menu Toggle-->

                <!-- Navbar Actions-->
                <div class="d-flex align-items-right">

                    <!-- logout-->
                    <form method="post" action="">

                        <button id='logout-btn' class="text-white  p-2"
                            style="background-color: transparent; border-radius:50rem; border:1px solid #202433; background-color:#202433;"
                            type="submit" name="logout">
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
                                    <a href="">Customers</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Add Customer
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
            admin::addCustomer();
            ?>
            <section class="content">
                <div class="container-fluid">
                    <form method="post" id="customer_add" class="card" action="" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Name
                                            <span class="form-required">*</span>
                                        </label>
                                        <input type="text" required="true" class="form-control" value="" id="c_name"
                                            name="c_name" placeholder="xxxxxxxxxxxxxxxxxxxx">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Password
                                            <span class="form-required">*</span>
                                        </label>
                                        <input type="password" required="true" class="form-control" value=""
                                            id="c_password" name="c_password" placeholder="xxxxxxxxxxxxxxxxxxxx">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Mobile
                                            <span class="form-required">*</span>
                                        </label>
                                        <input type="text" required="true" class="form-control" value="" id="c_mobile"
                                            name="c_mobile" placeholder="xxxxxxxxxxxxxxxxxxxx">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Email</label>
                                        <input type="text" required="true" class="form-control" value="" id="c_email"
                                            name="c_email" placeholder="xxxxxxxxxxxxxxxxxxxx">
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Address
                                        <span class="form-required">*</span>
                                    </label>
                                    <textarea class="form-control" required="true" id="c_address" autocomplete="off"
                                        placeholder="xxxxxxxxxxxxxxxxxxxx" name="c_address"></textarea>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="c_created_date" name="c_created_date" value="">
                        <div class="modal-footer">
                            <button type="submit" name="addCustomer" class="btn">
                                Add Customer
                            </button>
                        </div>
                </div>
                </form>

                </div>



                </div>
                <?php include_once 'footer.php'; ?>