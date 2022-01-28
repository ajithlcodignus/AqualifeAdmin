<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Shop View</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 text-right">
                    <a type="button" class="btn btn-info btn-xs" href="<?= base_url(); ?>ebadmin/shops"><i class="fa fa-backward"></i> BACK TO LIST</a>
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
                                            <td>Shop Name</td>
                                            <td><?= $shop_details->name ?></td>
                                        </tr>
                                        <tr>
                                            <td>Address</td>
                                            <td><?= $shop_details->address ?></td>
                                        </tr>
                                        <tr>
                                            <td>Type</td>
                                            <td><?= $shop_details->shopCategory ?></td>
                                        </tr>
                                        <tr>
                                            <td>Minimum Order</td>
                                            <td><?= $shop_details->minimumOrder ?></td>
                                        </tr>
                                        <tr>
                                            <td>GST</td>
                                            <td><?= $shop_details->shopGst ?></td>
                                        </tr>
                                        <tr>
                                            <td>Delivery Fee</td>
                                            <td><?= $shop_details->deliveryFee ?></td>
                                        </tr>
                                        <tr>
                                            <td>Packing Fee</td>
                                            <td><?= $shop_details->packingCharge ?></td>
                                        </tr>
                                        <tr>
                                            <td>Email ID</td>
                                            <td><?= $shop_details->shopEmailId ?></td>
                                        </tr>

                                        <tr>
                                            <td>Active</td>
                                            <td><?= $shop_details->active == 1 ? 'Yes' : 'No' ?></td>
                                        </tr>

                                        <tr>
                                            <td>Image</td>
                                            <td><img src="<?= base_url($shop_details->image) ?>" style="max-height: 300px; max-width: 300px;"/> </td>
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