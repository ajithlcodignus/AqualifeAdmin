<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('admin/index/') ?>" class="brand-link">
        <!--<img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">-->
        <span class="brand-text font-weight-bold"><?= TAG_APP_NAME ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


                <li class="nav-item ">
                    <a href="<?= base_url('admin/index/') ?>" class="nav-link active">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Home
                        </p>
                    </a>
		</li>
		<li class="nav-item ">
                    <a href="<?= base_url(); ?>admin/shop_category" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Shop Category
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="<?= base_url(); ?>admin/shops" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Shops
                        </p>
                    </a>
		</li>
 		<li class="nav-item ">
                    <a href="<?= base_url(); ?>admin/shop_admins" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Shop Admins
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="<?= base_url(); ?>admin/delivery_boy_admin" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Delivery Boys
                        </p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="<?= base_url(); ?>admin/push_notification" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Push Notification
                        </p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="<?= base_url(); ?>admin/banner_images" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Banner images
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="<?= base_url('admin/user_info_list') ?>" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Users 
                        </p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="<?= base_url(); ?>admin/logout" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>

                <!-- <li class="nav-item ">
                    <a href="<?= base_url(); ?>admin/coupon_view" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Coupon Code
                        </p>
                    </a>
                </li> 

                <li class="nav-item ">
                    <a href="<?= base_url(); ?>admin/for_quick_shop_view" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                           For Shop
                        </p>
                    </a>
                </li> 

                

                <li class="nav-item ">
                    <a href="<?= base_url(); ?>admin/demo_users" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                           Demo users
                        </p>
                    </a>
                </li>

		

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
