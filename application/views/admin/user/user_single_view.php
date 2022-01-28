<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">USER VIEW</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 text-right">
                    <a type="button" class="btn btn-info btn-xs" href="<?= base_url(); ?>admin/user_info_list"><i class="fa fa-backward"></i> BACK TO LIST</a>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12" style="display: flex;">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body table-responsive">
                                <table class="table table-striped table-valign-middle">
                                    <tbody>
                                        <tr>
                                            <td>Profile</td>
                                            <td><img src="<?= base_url($user[0]->profileImg); ?>" /></td>
                                        </tr>
                                        <tr>
                                            <td>Name</td>
                                            <td><?= $user[0]->name ?></td>
                                        </tr>
                                        <tr>
                                            <td>Email Id</td>
                                            <td><?= $user[0]->emailId ?></td>
                                        </tr>
                                        <tr>
                                            <td>Phone</td>
                                            <td><?= $user[0]->mobile ?></td>
                                        </tr>
                                        <tr>
                                            <td>Address</td>
                                            <td><?= $user[0]->address ?></td>
                                        </tr>
                                        <tr>
                                            <td>Account Status</td>
                                            <td>
                                                <span <?php
                                                        if ($user[0]->accountStatus == "NORMAL") {
                                                            echo "style='color: black'";
                                                        }
                                                        if ($user[0]->accountStatus == "WARNING") {
                                                            echo "style='color: yellow'";
                                                        }
                                                        if ($user[0]->accountStatus == "SUSPECT") {
                                                            echo "style='color: orange'";
                                                        }
                                                        if ($user[0]->accountStatus == "BLOCKED") {
                                                            echo "style='color: red;'";
                                                        }
                                                        ?>>
                                                    <?= $user[0]->accountStatus ?></span>
                                                <a href="<?= base_url('admin/edit_user_status/' . $user[0]->userId); ?>"><i class="fa fa-edit" title="Full View"></i></a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Date & Time</td>
                                            <td><?= date('d-m-Y H:i:s A', strtotime($user[0]->entryDate)) ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>

</div>