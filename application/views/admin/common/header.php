<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= base_url('admin/index/') ?>" class="nav-link">Home</a>
        </li>

        <?php if (isset($this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION])) {
            if (!empty($this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_ACTIVE_SHOP_NAME])) { ?>

                <li class="nav-item d-none d-sm-inline-block nav-link">
                    -
                </li>

                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?= base_url('admin/index/') ?>" class="nav-link"><?php echo urldecode($this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_ACTIVE_SHOP_NAME]); ?></a>
                </li>
        <?php  }
        } ?>
        <li class="nav-item d-sm-inline-block">
        </li>
        <?php if (($this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_USER_ROLE] == TAG_USER_ROLE_SUPER_ADMIN) || ($this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_USER_ROLE] == TAG_USER_ROLE_ADMIN)) { ?>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?= base_url('admin/update_app_version') ?>" class="nav-link" style="padding-left:20px; padding-right: 20px;">Update App Version</a>
            </li>
        <?php } ?>
    </ul>
    <?php if (($this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_USER_ROLE] == TAG_USER_ROLE_SUPER_ADMIN)) { ?>
        <a href="<?= base_url('admin/publish_db') ?>" class="nav-link btn btn-danger text-white" style="padding-left:20px; padding-right: 20px;">PUBLISH CHANGES</a>
    <?php } else { ?>
        <a href="<?= base_url('admin/shop_admin_publish_db') ?>" class="nav-link btn btn-danger text-white" style="padding-left:20px; padding-right: 20px;">PUBLISH CHANGES</a>
    <?php } ?>
</nav>