<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Demo User Profile</h1>
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
                <div class="col-lg-6">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body table-responsive">
                                <table class="table table-striped table-valign-middle" id="datatable1">
                                    <tbody>
                                        <tr>
                                            <td>Name</td>
                                            <td><?= $demouser_details->userName ?></td>
                                        </tr>

                                        <tr>
                                            <td>Contact Number</td>
                                            <td><?= $demouser_details->mobile ?></td>
                                        </tr>

                                        <tr>
                                            <td>Status</td>
                                            <td><?= $demouser_details->isActive=='Active'?"ACTIVE": 'INACTIVE'?> </td>
                                        </tr>
                                        <tr>
                                            <td>Demo Time</td>
                                            <td><?= $demouser_details->demoTime ?></td>
                                        </tr>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- /.card -->
                </div>
                
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>

</div>
