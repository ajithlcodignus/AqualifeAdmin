<div id="img-modal" class="modal fade"></div>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">ADD SHIPPING</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 text-right">
                    <a type="button" class="btn btn-info btn-xs" href="<?= base_url(); ?>admin/order_shipping_list"><i class="fa fa-backward"></i> BACK TO LIST</a>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <form role="form" method="post" action="<?= base_url('admin/insert_shipping_details'); ?>" id="quickForm" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <input type="hidden" name="orderId" value="<?= $this->uri->segment(3) ?>"/>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input type="address" name="address" class="form-control" required="">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sellerName">Seller Name</label>
                                            <input type="text" name="sellerName" class="form-control" required="">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="location">Location</label>
                                            <input type="text" name="location" class="form-control" required="">
                                        </div>

                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pinCode">Pincode</label>
                                            <input type="number" name="pinCode" class="form-control" required="" maxlength="7">
                                        </div>

                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="shippingStatus">Status</label>
                                            <select class="form-control" name="shippingStatus" style="width: 100%;" required="">
                                                <option selected disabled>--Select--</option>
                                                <option>Waiting for Confirmation From Seller</option>
                                                <option>Processing</option>
                                                <option>Packed</option>
                                                <option>Shipped</option>
                                                <option>Assigned to Deliveryboy</option>
                                                <option>Item Collected From Seller</option>
                                                <option>Delivered</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="shippingType">Shipping Type</label>
                                            <select class="form-control" name="shippingType" style="width: 100%;" disabled>
                                                <option>LongShipping</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="progressBarStatus">Progress Bar Status</label>
                                            <select class="form-control" name="progressBarStatus" style="width: 100%;" >
                                                <option>Complete</option>
                                                <option>Incomplete</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="priority">Priority</label>
                                            <select class="form-control" name="priority" style="width: 100%;" required="">
                                                <option selected disabled>--Select--</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="remarks">Remarks</label>
                                            <textarea name="remarks" class="form-control" rows="2"></textarea>
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
<script>
    jQuery(document).ready(function() {
        $('input[type=radio][name="bestItemFlag"]').on('change', function() {
            if ($('input[name="bestItemFlag"]:checked').val() == 1) {
                $('#best_item_image_div').show();
            } else {
                $('#best_item_image_div').hide();
            }
        });
    });

    function load_sub_category(cat_id) {
        $('#sub_category_div').html('<div style="margin-top:35px;text-align: center;color: green;"><b>Loading...</b></div>');
        $.ajax({
            'url': '<?= base_url('admin/load_sub_category'); ?>',
            'type': 'POST',
            'data': {
                cat_id: cat_id
            },
            'success': function(result) {
                $('#sub_category_div').html(result);
            }
        });
    }
</script>
