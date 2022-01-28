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
                    <a href="<?= base_url('admin/quick_item_list') ?>" class="nav-link active">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Quick List
                        </p>
                    </a>
                </li>


                <li class="nav-item ">
                    <a href="<?= base_url('admin/quick_shop_items') ?>" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                           Quick Items
                        </p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="<?= base_url('admin/quick_list') ?>" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Quick All Items
                        </p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="<?= base_url('admin/quick_cart') ?>" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Quick Cart Items
                        </p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="<?= base_url('admin/quick_bill_list') ?>" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Quick Order Bills
                        </p>
                    </a>
                </li>
                
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
