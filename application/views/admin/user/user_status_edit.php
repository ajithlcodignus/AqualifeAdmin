<link rel="stylesheet" href="<?php echo base_url('plugins/Jcrop/css/jCropstyle.css'); ?>" />
<link rel="stylesheet" href="<?php echo base_url('plugins/Jcrop/css/jquery.Jcrop.min.css'); ?>" type="text/css" />
<div id="img-modal" class="modal fade"></div>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">EDIT USER</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 text-right">
                    <a type="button" class="btn btn-info btn-xs" href="<?= base_url(); ?>admin/item"><i class="fa fa-backward"></i> BACK TO LIST</a>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <form role="form" method="post" action="<?= base_url('admin/user_status_update/'.$user->userId);?>" id="quickForm" enctype="multipart/form-data">
                            <div class="card-body">

                            <input type="hidden" name="userId" value="<?= $user->userId ?>"/>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" class="form-control" value="<?= $user->name;?>" readonly  maxlength="30">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Email Id</label>
                                            <input type="text" name="name" class="form-control" value="<?= $user->emailId; ?>" readonly  maxlength="30">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Phone</label>
                                            <input type="text" name="name" class="form-control" value=" <?= $user->mobile; ?>" readonly  maxlength="30">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Address</label>
                                            <input type="text" name="name" class="form-control" value=" <?= $user->address; ?>" readonly  maxlength="30">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Data And Time</label>
                                            <input type="text" name="name" class="form-control" value="<?= $user->entryDate; ?>" readonly  maxlength="30">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Account Status</label>
                                                <select class="form-control" name="accountStatus" id="accountStatus">
                                                    <option style="color: black;" value="NORMAL" <?= $user->accountStatus == 'NORMAL' ? 'selected' : ''; ?>>NORMAL</option>
                                                    <option style="color: yellow;" value="WARNING" <?= $user->accountStatus == 'WARNING' ? 'selected' : ''; ?>>WARNING</option>
                                                    <option style="color: orange;" value="SUSPECT" <?= $user->accountStatus == 'SUSPECT' ? 'selected' : ''; ?>>SUSPECT</option>
                                                    <option style="color: red;" value="BLOCKED" <?= $user->accountStatus == 'BLOCKED' ? 'selected' : ''; ?>>BLOCKED</option>
                                                </select>                                        
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="image">Profile</label>
                                            <img src="<?= base_url() . $user->profileImg; ?>" style="width: 25%;" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button style="float: left; width:auto;" type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
