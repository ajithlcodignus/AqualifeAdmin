<div id="img-modal" class="modal fade"></div>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">EDIT DEMO USER</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 text-right">
                    <a type="button" class="btn btn-info btn-xs" href="<?= base_url(); ?>admin/demo_users"><i class="fa fa-backward"></i> BACK TO LIST</a>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <form role="form" method="post" action="<?= base_url('admin/update_demo_user');?>" id="quickForm"  enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <input type="hidden" name="demoId" value="<?= $demouser_details->demoId; ?>"/>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="userName">Name</label>
                                            <input type="text" name="userName" class="form-control" value="<?= $demouser_details->userName; ?>" required="" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="mobile">Contact Number</label>
                                            <input type="number" id="mobile" name="mobile" class="form-control" required="" value="<?= $demouser_details->mobile; ?>" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="isActive">Status</label>
                                            <select class="form-control" name="isActive" style="width: 100%;">
                                                <option value="Active" <?= $demouser_details->isActive == 'Active' ? 'selected' : ''; ?>>Active</option>
                                                <option value="Inactive" <?= $demouser_details->isActive == 'Inactive' ? 'selected' : ''; ?>>Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="demoTime">Demo Time</label>
                                            <input type="text" name="demoTime" value="<?= $demouser_details->demoTime ?>" class="form-control demoTime" required="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
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
