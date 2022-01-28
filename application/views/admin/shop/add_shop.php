<div id="img-modal" class="modal fade"></div>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">ADD SHOP</h1>
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
                        <form role="form" method="post" action="<?= base_url('admin/insert_shop'); ?>" id="quickForm" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Shop Category</label>
                                            <select class="form-control select2" name="shopCategoryId" style="width: 100%;" required="">
                                                <option value="">Select Shop Category</option>
                                                <?php
                                                if (!empty($data)) {
                                                    foreach ($data as $val) {
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
                                            <input type="text" name="name" class="form-control" required="" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Min Order</label>
                                            <input type="text" name="minimumOrder" class="form-control" required="" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Base Delivery Fee</label>
                                            <input type="text" name="deliveryFee" class="form-control" required="" title="Base Delivery Fee" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Base Delivery KM(KM)</label>
                                            <input type="text" name="deliveryFeeBaseKM" class="form-control" required="" title="Base km for free or basic Delivery fee" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Delivery Fee per KM(Rupies)</label>
                                            <input type="text" name="deliveryBaseAmount" class="form-control" required="" title="Base Delivery Fee amount to be add to every one KM" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Packing Charge</label>
                                            <input type="text" name="packingCharge" class="form-control" required="" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Gst(Percentage)</label>
                                            <input type="text" name="shopGst" class="form-control" required="" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Address</label>
                                            <input type="text" name="address" class="form-control" required="" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="location">Location</label>
                                            <input type="text" name="location" class="form-control" required="" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Pin Code</label>
                                            <input type="text" name="pinCode" class="form-control" required="" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Email ID</label>
                                            <input type="email" name="shopEmailId" class="form-control"  required="" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="mobile">Mobile</label>
                                            <input type="number" name="shopMobile" class="form-control" required="" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="landline">Landline</label>
                                            <input type="number" name="shopLandline" class="form-control" required="" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Shop Priority</label>
                                            <input type="text" name="shopPriority" class="form-control" required="" />
                                        </div>
                                    </div>

                                    <div class="col-md-4 bootstrap-timepicker">
                                        <div class="form-group">
                                            <label>Delivery Time</label>

                                            <input type="text" name="deliveryTime" class="form-control" id="deliveryTime" />
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                            <!-- /.input group -->
                                        </div>
                                        <!-- /.form group -->
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="image">Thumbnail Image</label><br />
                                            <input type="file" name="image" id="image" value="" accept="image/jpeg,image/png,image/jpg" required="">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="image">Banner Image</label><br />
                                            <input type="file" name="bannerImage" id="bannerImage" value="" accept="image/jpeg,image/png,image/jpg" required="">
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
