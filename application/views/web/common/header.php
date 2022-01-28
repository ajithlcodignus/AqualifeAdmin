<header class="header_section">


    <nav class="navbar navbar-expand-lg navbar-light nav_color">

        <!-- <form class="top_search_form d-flex input-group w-auto">
            <input type="search" class="form-control rounded-left search_item" id="top_search_item" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
            <span class="border-0 top_search_button search_button rounded-right" id="top_search_button">
                <i class="fas fa-search align-bottom"></i>
            </span>
        </form> -->
       


        <span class="top_search_botton" data-toggle="modal" data-target="#searchModal" aria-haspopup="true" aria-expanded="false" href="#" title="Login">
            <i class="fas fas fa-search" style="font-size: 6vw;"></i>
        </span>

        <a class="navbar-brand" href="#">FoodVeno</a>
        <button class="navbar-toggler navbar_button" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        
       
       
        <div class="collapse navbar-collapse w-100 order-3 dual-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">

                <li class="nav-item active">
                    <a class="nav-link text-capitalize mr-3 mb-3" href="<?= base_url('/') ?>"><strong>Home</strong></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link text-capitalize mr-3 mb-3" onclick="testClick()" href="#"><strong>About</strong></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link text-capitalize mr-3 mb-3" href="#"><strong>Terms and Condition</strong></a>
                </li>
                <li class="nav-item active text-capitalize mr-3 mb-3">
                    <a class="nav-link text-capitalize mr-3" href="#"><strong>Contact</strong></a>
                </li>
                <li class="nav-item active mr-3 mb-3">
                    <a class="nav-link" href="#"><i class="fab fa-whatsapp header_icon_size whatsaapp-icon"></i> </a>
                </li>
                <li class="nav-item active mr-3 mb-3">
                    <a class="nav-link" href="#"><i class="fab fa-facebook header_icon_size fb-icon"></i> </a>
                </li>

                <?php

                if (null !== $this->session->userdata(TAG_FOODVENO_LOGIN_SESSION)) {
                ?>

                    <li class="nav-item active mr-3 mb-3">

                        <div class="dropdown show">

                            <a class="nav-link " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#"><i class="fas fa-user theme_color header_icon_size"></i></a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="<?= base_url('profile') ?>">Profile</a>
                                <a class="dropdown-item" href="<?= base_url('orders') ?>">Orders</a>
                                <a class="dropdown-item" href="<?= base_url('logout') ?>">Logout</a>
                            </div>

                        </div>
                    </li>


                <?php
                } else {
                ?>
                    <li class="nav-item active mr-3 mb-3">

                        <div class="dropdown show">

                            <a class="nav-link " data-toggle="modal" data-target="#LoginModal" aria-haspopup="true" aria-expanded="false" href="#" title="Login">
                                <i class="fas fa-user theme_color header_icon_size"></i>
                            </a>

                        </div>
                    </li>

                <?php
                }
                ?>

            </ul>


        </div>
    </nav>


</header>

<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="LoginModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm m-0" role="document">
        <div class="modal-content">
            <div class="container">
                <div class="row">
                    <div class="col-1 col-md-1 p-0">
                        <button type="button" class="search_back_button rounded-left">
                            <span aria-hidden="true"><i class="fas fa-arrow-left"></i></span>
                        </button>
                    </div>
                    <div class="col-9 col-md-9 p-0">
                        <input class="form-control search-input search_item" type="search" name="search_item" id="search_item" placeholder="Search Your Product" aria-label="Search">
                    </div>
                    <div class="col-2 col-md-2 pl-0 pr-0">
                        <button class="search_button button rounded-right" id="search_button" type="submit" name="search" value="Search">
                            <span>
                                <i class="fas fas fa-search"></i>
                            </span>

                        </button>

                    </div>
                    <div class="col-1 col-md-1 p-0"></div>
                    <div class="col-9 col-md-9 pr-0">
                        <ul class="list-group" id="search_suggestion" style="position: absalute;z-index: 999;display:block">

                        </ul>
                    </div>
                    <div class="col-2 col-md-1 p-0"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Login Modal -->
    <form role="form" method="post" id="loginForm" enctype="multipart/form-data">
        <div class="modal fade" id="LoginModal" tabindex="-1" role="dialog" aria-labelledby="LoginModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header login_head">
                        <h5 class="modal-title justify-content-center" id="modalLongTitle">Login</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>


                    <div class="modal-body">


                        <div class="container">

                            <div class="row">
                                <div class="col py-2 form-group">
                                    <input type="number" class="form-control" id="mobile" name="mobile" placeholder="Mobile Number">
                                </div>
                            </div>


                            <div class="row">
                                <div class="col py-2 form-group">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                </div>
                            </div>

                        </div>


                        <div class="d-flex justify-content-center pt-4">
                            <p>New Member <a href="#" data-toggle="modal" data-target="#SignupModal">Sign Up?</a></p>
                        </div>
                        <div class="d-flex justify-content-center error" id='loginError'></div>
                        <div class="modal-footer update_button">
                            <button type="submit" id="loginButton" class="modal-button mr-auto">Login</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>


    <!--SignUp Modal -->

    <div class="modal fade" id="SignupModal" tabindex="-1" role="dialog" aria-labelledby="SignupModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header signup-head">
                    <h5 class="modal-title d-flex justify-content-center" id="modalLongTitle">Sign Up</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="d-flex justify-content-center">
                    <p>Every fill is required in signup</p>
                </div>

                <div class="modal-body">
                    <form class="modal-form" role="form" method="post" id="signupForm">
                        <div class="container">

                            <div class="row">
                                <div class="form-group py-2 col-md-3">
                                    <select class="form-control">
                                        <option value="1">Mr.</option>
                                        <option value="0">Ms.</option>
                                    </select>
                                </div>
                                <div class="form-group py-2 col-md-9">
                                    <input type="text" class="form-control" name="sign_up_name" id="sign_up_name" placeholder="First name">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col py-2 form-group">
                                    <input type="email" class="form-control" name="sign_up_emailId" id="sign_up_emailId" placeholder="Email Id">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col py-2 form-group">
                                    <input type="number" class="form-control" name="sign_up_mobile" id="sign_up_mobile" placeholder="Contact Number">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col py-2 form-group">
                                    <input type="password" class="form-control" name="sign_up_password" id="sign_up_password" placeholder="Password">
                                </div>
                            </div>

                        </div>

                        <div class="d-flex justify-content-center pt-4 modal-agree">
                            <p>By Singing up, you agree to Foodveno's <a href="">Terms&Conditions</a> </p>
                        </div>

                        <div class="modal-footer update_button">
                            <button type="submit" class="modal-button mr-auto">Continue</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
