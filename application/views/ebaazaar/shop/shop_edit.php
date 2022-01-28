<div id="img-modal" class="modal fade"></div>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">EDIT SHOP</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 text-right">
                    <a type="button" class="btn btn-info btn-xs" href="<?= base_url(); ?>admin/shops"><i class="fa fa-backward"></i> BACK TO LIST</a>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <form role="form" method="post" action="<?= base_url('admin/update_shop');?>" id="quickForm"  enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <input type="hidden" name="shopId" value="<?= $shop_details->shopId; ?>"/>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" class="form-control" value="<?= $shop_details->name; ?>" required="" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Shop Category</label>
                                            <select class="form-control select2" name="shopCategoryId" style="width: 100%;" required="">
                                                <option value="">Select Shop Category</option>
                                                <?php
                                                if (!empty($shop_category)) {
                                                    foreach ($shop_category as $val) {
                                                        ?>
                                                        <option value="<?= $val->shopCategoryId; ?>" <?= $shop_details->shopCategoryId == $val->shopCategoryId ? 'selected' : ''; ?>><?= $val->name; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Min Order</label>
                                            <input type="text" name="minimumOrder" class="form-control" required="" value="<?= $shop_details->minimumOrder; ?>"  />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Delivery Fee</label>
                                            <input type="text" name="deliveryFee" class="form-control" required="" value="<?= $shop_details->deliveryFee; ?>" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Packing Charge</label>
                                            <input type="text" name="packingCharge" class="form-control" required="" value="<?= $shop_details->packingCharge; ?>" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Gst</label>
                                            <input type="text" name="shopGst" class="form-control" required="" value="<?= $shop_details->shopGst; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Address</label>
                                            <input type="text" name="address" class="form-control" required="" value="<?= $shop_details->address; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Pin Code</label>
                                            <input type="text" name="pinCode" class="form-control" required="" value="<?= $shop_details->pinCode; ?>" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Email ID</label>
                                            <input type="email" name="shopEmailId" class="form-control" required="" value="<?= $shop_details->shopEmailId; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="image">Image</label>
                                            <input type="file" name="image" id="image" value="" accept="image/jpeg,image/png,image/jpg" />
                                        </div>
                                        <?php if ($shop_details->image) { ?>
                                            <img src="<?= base_url() . $shop_details->image; ?>" style="width: 25%;">
                                            <input type="hidden" value="<?= $shop_details->image ?>" name="currentImage">
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Shop Priority</label>
                                            <input type="text" name="shopPriority" class="form-control" required=""  value="<?= $shop_details->shopPriority; ?>" />
                                        </div>
                                    </div>



                                    <!--<div class="col-md-4">
                                        <div class="form-group">
                                            <label for="image">Image</label><br/>
                                            <input type="file" name="image" id="image" value="" accept="image/jpeg,image/png,image/jpg" required="">
                                        </div>
                                    </div>-->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="availabilityStatus">Active Status</label>
                                            <select class="form-control" name="active" style="width: 100%;" required="">
                                                <option value="1" <?= $shop_details->active == 1 ? 'selected' : ''; ?>>Active</option>
                                                <option value="0" <?= $shop_details->active == 0 ? 'selected' : ''; ?>>In Active</option>
                                            </select>
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
    jQuery(document).ready(function () {
        $('input[type=radio][name="bestItemFlag"]').on('change', function () {
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
            'data': {cat_id: cat_id},
            'success': function (result) {
                $('#sub_category_div').html(result);
            }
        });
    }
</script>
