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
                    <a href="<?= base_url('admin/index/') ?>" class="nav-link <?= ($selected_menu=='HOME')?'active':''?>">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Home
                        </p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="<?= base_url('admin/delivery_boy_admin') ?>" class="nav-link <?= ($selected_menu=='DELIVERY_BOY_LIST')?'active':''?>">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Delivery Boys List
                        </p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="<?= base_url(); ?>admin/payment_pending_orders" class="nav-link <?= ($selected_menu=='PAYMENT_PENDING_ORDERS')?'active':''?>">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                        Payment Pending Orders
                        </p>
                    </a>
                </li>
                
                <li class="nav-item ">
                    <a href="<?= base_url(); ?>admin/d_boy_paid_orders" class="nav-link <?= ($selected_menu=='PAID_ORDERS')?'active':''?>">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                        Paid Orders
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="<?= base_url(); ?>admin/payment_pending_delivery_boys" class="nav-link <?= ($selected_menu=='PAYMENT_PENDING_DELIVERY_BOYS')?'active':''?>">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                        Payment Pending Boys 
                        </p>
                    </a>
                </li>
                
                



            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>