<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">DELIVERY BOY VIEW</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 text-right">
                    <a type="button" class="btn btn-info btn-xs" href="<?= base_url(); ?>ebadmin/delivery_boy"><i class="fa fa-backward"></i> BACK TO LIST</a>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body table-responsive">
                                <table class="table table-striped table-valign-middle" id="datatable1">
                                    <tbody>
                                        <tr>
                                            <td>Name</td>
                                            <td><?= $delivery_boy_details->deliveryBoyName ?></td>
                                        </tr>
                                        <tr>
                                            <td>Email ID</td>
                                            <td><?= $delivery_boy_details->emailId ?></td>
                                        </tr>
                                        <tr>
                                            <td>Mobile</td>
                                            <td><?= $delivery_boy_details->mobile ?></td>
                                        </tr>

                                        <tr>
                                            <td>Address</td>
                                            <td><?= $delivery_boy_details->address ?></td>
                                        </tr>

                                        <tr>
                                            <td>Place</td>
                                            <td><?= $delivery_boy_details->place ?></td>
                                        </tr>

                                        <tr>
                                            <td>Pin Code</td>
                                            <td><?= $delivery_boy_details->pinCode ?></td>
                                        </tr>

                                        <tr>
                                            <td>Active?</td>
                                            <td><?= $delivery_boy_details->active == 1 ? 'Yes' : 'No' ?></td>
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