<aside class="aside bg-dark-700">
    <div class="simplebar-wrapper">
        <div data-pixr-simplebar>
            <div class="pb-6 pb-sm-0 mt-5 position-relative">
                <div
                    class="cursor-pointer close-menu me-4 text-primary-hover transition-color disable-child-pointer position-absolute end-0 top-0 mt-3 pt-1 d-xl-none">
                    <i class="ri-close-circle-line ri-lg align-middle me-n2"></i>
                </div>


                </a>
            </div>

            <div class=" pt-3 pb-5 mb-6 d-flex flex-column align-items-center">
                <div class="position-relative">
                    <picture class="avatar">
                        <img class="avatar-profile-img" src="../assets/images/user.jpg">
                    </picture>
                    <span class="dot bg-success avatar-dot"></span>
                </div>
                <p class="mb-0 mt-3 text-white"><?php
                                                echo $_SESSION['a_name'] ?></p>
                <small><?php
                        echo $_SESSION['a_email'] ?></small>
                <div class="d-flex flex-wrap mt-2 justify-content-between align-items-center mb-2">



                </div>
                <ul class="list-unstyled mt-1 aside-menu">

                    <ol class="breadcrumb">
                        <a href="dashboard" class="text-light">
                            <li class="breadcrumb-item">
                                <i class="ri-home-line align-bottom me-1"></i>
                                Dashboard

                            </li>
                        </a>
                    </ol>

                    <li class="menu-item" id="bookings">
                        <a class="d-flex align-items-center collapsed menu-link" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseMenuItemBookings" aria-expanded="false"
                            aria-controls="collapseMenuItemBookings">
                            <i class="ri-book-line me-3"></i>
                            <span>Bookings</span>
                        </a>
                        <div class="collapse" id="collapseMenuItemBookings">
                            <ul class="submenu">
                                <li>
                                    <a class="submenu-link" href="addBooking">Add Booking</a>
                                </li>
                                <li>
                                    <a class="submenu-link" href="editBookings">Approve Booking</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="menu-item" id="customers">
                        <a class="d-flex align-items-center collapsed  menu-link" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseMenuItemCustomers" aria-expanded="false"
                            aria-controls="collapseMenuItemCustomers">
                            <i class="ri-user-line me-3"></i>
                            <span>Customers</span>
                        </a>
                        <div class="collapse" id="collapseMenuItemCustomers">
                            <ul class="submenu">
                                <li>
                                    <a class="submenu-link" href="addUser">Add Customer</a>
                                </li>
                                <li>
                                    <a class="submenu-link" href="editUsers">Edit Customers</a>
                                </li>

                            </ul>
                        </div>
                    </li>
                    <li class="menu-item" id="drivers">
                        <a class="d-flex align-items-center collapsed menu-link" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseMenuItemDrivers" aria-expanded="false"
                            aria-controls="collapseMenuItemDrivers">
                            <i class="ri-user-2-line me-3"></i>
                            <span>Drivers</span>
                        </a>
                        <div class="collapse" id="collapseMenuItemDrivers">
                            <ul class="submenu">
                                <li>
                                    <a class="submenu-link" href="addDriver">Add Driver</a>
                                </li>
                                <li>
                                    <a class="submenu-link" href="editDrivers">Edit Drivers</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="menu-item" id="rides">
                        <a class="d-flex align-items-center collapsed menu-link" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseMenuItemRides" aria-expanded="false"
                            aria-controls="collapseMenuItemRides">
                            <i class="ri-car-line me-3"></i>
                            <span>Rides</span>
                        </a>
                        <div class="collapse" id="collapseMenuItemRides">
                            <ul class="submenu">
                                <li>
                                    <a class="submenu-link" href="addRide">Add Ride</a>
                                </li>
                                <li>
                                    <a class="submenu-link" href="editRides">Edit Rides</a>
                                </li>
                            </ul>
                        </div>
                    </li>


                </ul>
            </div>
        </div>
    </div>
</aside>