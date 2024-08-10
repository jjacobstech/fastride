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
                            <i class="ri-logout-box-r-line me-2"></i>
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


            <div class="row g-4 mb-4">
                <div class="col-12 col-lg-12">
                    <div class="card h-100">
                        <div class="card-header justify-content-between align-items-center d-flex border-0 pb-0">
                            <h6 class="card-title">Drivers</h6>

                        </div>
                        <div class="card-body">

                            <div class="tab-content" id="scheduleTabContent">

                                <div class="tab-pane fade show active" id="scrollbars" role="tabpanel">
                                    <?php
                                    admin::drivers()
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-12">
                    <div class="card h-100">
                        <div class="card-header justify-content-between align-items-center d-flex border-0 pb-0">
                            <h6 class="card-title">Rides</h6>

                        </div>
                        <div class="card-body">

                            <div class="tab-content" id="scheduleTabContent">

                                <div class="tab-pane fade show active" role="tabpanel" id="scrollbars">
                                    <?php
                                    admin::rides()
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-12 col-lg-12" id="users">
                    <div class="card h-100">
                        <div class="card-header justify-content-between align-items-center d-flex border-0 pb-0">
                            <h6 class="card-title">Customers</h6>

                        </div>
                        <div class="card-body">

                            <div class="tab-content" id="scheduleTabContent">

                                <div class="tab-pane fade show active" id="scrollbars" role="tabpanel">
                                    <?php
                                    admin::customers()
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-12">
                    <div class="card h-100">
                        <div class="card-header justify-content-between align-items-center d-flex border-0 pb-0">
                            <h6 class="card-title">Bookings</h6>

                        </div>
                        <div class="card-body">

                            <div class="tab-content" id="scheduleTabContent">

                                <div class="tab-pane fade show active" id="scrollbars" role="tabpanel">
                                    <?php
                                    admin::bookings()
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
<?php include_once 'footer.php'; ?>