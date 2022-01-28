<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Shop Admin Profile</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 text-right">
                    <a type="button" class="btn btn-info btn-xs" href="<?= base_url(); ?>admin/shop_admins"><i class="fa fa-backward"></i> BACK TO LIST</a>
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
                                            <td><?= $shopadmin_details->name ?></td>
                                        </tr>

                                        <tr>
                                            <td>Email ID</td>
                                            <td><?= $shopadmin_details->emailId ?></td>
                                        </tr>

                                        <tr>
                                            <td>Contact</td>
                                            <td><?= $shopadmin_details->mobile ?></td>
                                        </tr>

                                        <tr>
                                            <td>Address</td>
                                            <td><?= $shopadmin_details->address ?></td>
                                        </tr>
                                       
                                        <!-- <tr>
                                            <td>Profile Image</td>
                                            <td><img src="<?= base_url($shopadmin_details->profileImg) ?>" style="max-height: 300px; max-width: 300px;"/> </td>
                                        </tr> -->

                                        <tr>
                                            <td>Pincode</td>
                                            <td><?= $shopadmin_details->pinCode ?></td>
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
