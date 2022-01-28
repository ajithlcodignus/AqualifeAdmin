<div id="img-modal" class="modal fade"></div>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">EDIT SHOP ADMIN</h1>
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
                <div class="col-lg-12">
                    <div class="card">
                        <form role="form" method="post" action="<?= base_url('admin/update_shop_admin');?>" id="editShopAdmin"  enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <input type="hidden" name="userId" id="userId" value="<?= $shopadmin_details->userId; ?>"/>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" class="form-control" value="<?= $shopadmin_details->name; ?>" required="" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="emailId">Email ID</label>
                                            <input type="email" name="emailId" class="form-control" required="" value="<?= $shopadmin_details->emailId; ?>" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="mobile">Contact Number</label>
                                            <input type="number" name="mobile" class="form-control" required="" value="<?= $shopadmin_details->mobile; ?>" />
                                        </div>
                                    </div>

                                    
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Address</label>
                                            <input type="text" name="address" class="form-control" required="" value="<?= $shopadmin_details->address; ?>" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="image">Profile Image</label>
                                            <input type="file" name="profileImg" id="profileImg" value="" accept="image/jpeg,image/png,image/jpg" />
                                        </div>
                                        <?php if ($shopadmin_details->profileImg) { ?>
                                            <img src="<?= base_url() . $shopadmin_details->profileImg; ?>" style="width: 25%;">
                                            <input type="hidden" value="<?= $shopadmin_details->profileImg?>" name="currentImage">
                                        <?php } ?>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Pin Code</label>
                                            <input type="text" name="pinCode" class="form-control" required="" value="<?= $shopadmin_details->pinCode; ?>" />
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
