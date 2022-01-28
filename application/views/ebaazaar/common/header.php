<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= base_url('ebadmin/index/') ?>" class="nav-link">Home</a>
        </li>

        <?php if(isset($this->session->userdata[TAG_E_B_TEMP_LOGIN_SESSION])) { if(!empty($this->session->userdata[TAG_E_B_TEMP_LOGIN_SESSION][TAG_E_B_TEMP_SESSION_ACTIVE_SHOP_NAME])){ ?>

            <li class="nav-item d-none d-sm-inline-block nav-link">
                -
            </li>

            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?= base_url('ebadmin/index/') ?>" class="nav-link"><?php echo urldecode($this->session->userdata[TAG_E_B_TEMP_LOGIN_SESSION][TAG_E_B_TEMP_SESSION_ACTIVE_SHOP_NAME  ]); ?></a>
            </li>
        <?php  }  } ?>


    </ul>
</nav>