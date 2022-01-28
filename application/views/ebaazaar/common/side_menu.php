<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('admin/index/') ?>" class="brand-link">
        <!--<img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">-->
        <span class="brand-text font-weight-light"><?= TAG_PARTNER_APP_NAME ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


                <li class="nav-item ">
                    <a href="<?= base_url('ebadmin/index/') ?>" class="nav-link active">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Profile
                        </p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="<?= base_url('ebadmin/index/') ?>" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Shop
                        </p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="<?= base_url(); ?>ebadmin/item" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Item
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="<?= base_url(); ?>ebadmin/item_categories" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Item Category
                        </p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="<?= base_url(); ?>ebadmin/order_report" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Orders
                        </p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="<?= base_url(); ?>ebadmin/delivery_boy" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Delivery Boys
                        </p>
                    </a>
                </li>



            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>