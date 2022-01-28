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
                        <form role="form" method="post" action="<?= base_url('admin/update_shop'); ?>" id="quickForm" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <input type="hidden" name="shopId" value="<?= $shop_details->shopId; ?>" />
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Shop Category</label>
                                            <select class="form-control select2" name="shopCategoryId" style="width: 100%;" required="">
                                                
                                                <?php
                                                if (!empty($shop_category_list)) {
                                                    foreach ($shop_category_list as $val) {
                                                ?>
                                                        <option value="<?= $val->shopCategoryId; ?>"><?= $val->name; ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" class="form-control" value="<?= $shop_details->name; ?>" required="" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Min Order</label>
                                            <input type="text" name="minimumOrder" class="form-control" required="" value="<?= $shop_details->minimumOrder; ?>" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Base Delivery Fee</label>
                                            <input type="text" name="deliveryFee" class="form-control" required="" value="<?= $shop_details->deliveryFee; ?>" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Base Delivery KM(KM)</label>
                                            <input type="text" name="deliveryFeeBaseKM" class="form-control" required="" value="<?= $shop_details->deliveryFeeBaseKM; ?>" title="Base km for free or basic Delivery fee" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Delivery Fee per KM(Rupies)</label>
                                            <input type="text" name="deliveryBaseAmount" class="form-control" required="" value="<?= $shop_details->deliveryBaseAmount; ?>" title="Base Delivery Fee amount to be add to every one KM" />
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
                                            <label for="name">Gst(Percentage)</label>
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
                                            <label for="name">Location</label>
                                            <input type="text" name="location" class="form-control" required="" value="<?= $shop_details->location; ?>" />
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
                                            <label for="mobile">Mobile</label>
                                            <input type="number" name="shopMobile" class="form-control" required="" value="<?= $shop_details->shopMobile; ?>" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="landline">Landline</label>
                                            <input type="number" name="shopLandline" class="form-control" required="" value="<?= $shop_details->shopLandline; ?>" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Shop Priority</label>
                                            <input type="text" name="shopPriority" class="form-control" required="" value="<?= $shop_details->shopPriority; ?>" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="image">Thumbnail Image</label>
                                            <input type="file" name="image" id="image" value="" accept="image/jpeg,image/png,image/jpg" />
                                        </div>
                                        <?php if ($shop_details->image) { ?>
                                            <img src="<?= base_url() . $shop_details->image; ?>" style="width: 25%;">
                                            <input type="hidden" value="<?= $shop_details->image ?>" name="currentImage">
                                        <?php } ?>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="availabilityStatus">Active Status</label>
                                            <select class="form-control" name="active" style="width: 100%;" required="">
                                                <option value="1" <?= $shop_details->active == 1 ? 'selected' : ''; ?>>Active</option>
                                                <option value="0" <?= $shop_details->active == 0 ? 'selected' : ''; ?>>In Active</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 bootstrap-timepicker">
                                        <div class="form-group">
                                            <label>Delivery Time</label>

                                            <input type="text" name="deliveryTime" class="form-control" id="deliveryTime"  value="<?= $shop_details->deliveryTime ?>" />
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                            <!-- /.input group -->
                                        </div>
                                        <!-- /.form group -->
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="image">Banner Image</label>
                                            <input type="file" name="bannerImage" id="bannerImage" value="" accept="image/jpeg,image/png,image/jpg" />
                                        </div>
                                        <?php if ($shop_details->image) { ?>
                                            <img src="<?= base_url() . $shop_details->bannerImage; ?>" style="width: 25%;">
                                            <input type="hidden" value="<?= $shop_details->bannerImage ?>" name="currentBannerImage">
                                        <?php } ?>
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

        $('#deliveryTime').timepicker({
            showMeridian: false,
            up: 'glyphicon glyphicon-chevron-up',
            down: 'glyphicon glyphicon-chevron-down'
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
