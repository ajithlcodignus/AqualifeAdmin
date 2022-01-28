<div id="img-modal" class="modal fade"></div>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">EDIT SHIPMENT</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 text-right">
                    <a type="button" class="btn btn-info btn-xs" href="<?= base_url('admin/order_shipping_list/' . $order_shipping->orderShippingId); ?>"><i class="fa fa-backward"></i> BACK TO LIST</a>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <form role="form" method="post" action="<?= base_url('admin/update_order_shipment'); ?>" id="quickForm" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <input type="hidden" name="id" value="<?= $order_shipping->orderShippingId; ?>" />
                                    <input type="hidden" name="orderId" value="<?= $order_shipping->orderId; ?>" />

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="shippingStatus">status</label>
                                            <select class="form-control" name="shippingStatus" style="width: 100%;" required="">
                                                <option <?= $order_shipping->shippingStatus == 'Ordered' ? 'selected' : ''; ?>>Ordered</option>
                                                <option <?= $order_shipping->shippingStatus == 'Processing' ? 'selected' : ''; ?>>Processing</option>
                                                <option <?= $order_shipping->shippingStatus == 'Packed' ? 'selected' : ''; ?>>Packed</option>
                                                <option <?= $order_shipping->shippingStatus == 'Shipped' ? 'selected' : ''; ?>>Shipped</option>
                                                <option <?= $order_shipping->shippingStatus == 'Assigned to Deliveryboy' ? 'selected' : ''; ?>>Assigned to Deliveryboy</option>
                                                <option <?= $order_shipping->shippingStatus == 'Item Collected From Seller' ? 'selected' : ''; ?>>Item Collected From Seller</option>
                                                <option <?= $order_shipping->shippingStatus == 'Delivered' ? 'selected' : ''; ?>>Delivered</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="progressBarStatus">Progress Bar Status</label>
                                            <select class="form-control" name="progressBarStatus" style="width: 100%;">
                                            <option <?= $order_shipping->progressBarStatus == 'Incomplete' ? 'selected' : ''; ?>>Incomplete</option>
						<option <?= $order_shipping->progressBarStatus == 'Complete' ? 'selected' : ''; ?>>Complete</option>
</select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="shippingType">Shipping Type</label>
                                            <select class="form-control" name="shippingType" style="width: 100%;" disabled>
                                                <option <?= $order_shipping->shippingType == 'LongShipping' ? 'selected' : ''; ?>>LongShipping</option>
                                                <option <?= $order_shipping->shippingType == 'ShortShipping' ? 'selected' : ''; ?>>ShortShipping</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Address</label>
                                            <input type="text" name="address" class="form-control" required="" value="<?= $order_shipping->address; ?>" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="location">Location</label>
                                            <input type="text" name="location" class="form-control" required="" value="<?= $order_shipping->location; ?>" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Pin Code</label>
                                            <input type="text" name="pinCode" class="form-control" required="" value="<?= $order_shipping->pinCode; ?>" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="remarks">Remarks</label>
                                            <input type="text" name="remarks" class="form-control" required="" value="<?= $order_shipping->remarks; ?>" />
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

</script>
