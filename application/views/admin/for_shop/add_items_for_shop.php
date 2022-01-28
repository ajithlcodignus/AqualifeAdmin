<div id="img-modal" class="modal fade"></div>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">ADD ITEM</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 text-right">
                    <a type="button" class="btn btn-info btn-xs" href="<?= base_url(); ?>admin/quick_shop_items"><i class="fa fa-backward"></i> BACK TO LIST</a>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <form role="form" method="post" action="<?= base_url('admin/quick_insert_items_for_shop');?>" id="quickForm"  enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Shop</label>
                                            <select class="form-control select2" name="quickshopId" style="width: 100%;" required="" disabled>
                                                <option value="">Select Shop</option>
                                                <?php
                                                if (count($shop)) {
                                                    foreach ($shop as $val) {
                                                        ?>
                                                        <option value="<?= $val->shopId; ?>" <?php if($val->shopId == $this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_ACTIVE_SHOP_ID]) echo 'selected'; ?>><?= $val->name; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="quickName">Name</label>
                                            <input type="text" name="quickName" class="form-control" required="" maxlength="30">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Item Category</label>
                                            <select class="form-control select2" name="quickCategoryId" style="width: 100%;" required="">
                                                <option value="">Select Category</option>
                                                <?php
                                                if (!empty($category)) {
                                                    foreach ($category as $val) {
                                                        ?>
                                                        <option value="<?= $val->categoryId; ?>"><?= $val->name; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <!--<div class="col-md-4">
                                        <div class="form-group">
                                            <label for="itemType">Type</label>
                                            <input type="text" name="itemType" class="form-control" required="">
                                        </div>
                                    </div>-->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="availabilityStatus">Availability Status</label>
                                            <select class="form-control" name="quickAavailabilityStatus" style="width: 100%;" required="">
                                                <option value="1">Available</option>
                                                <option value="0">Not Available</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="quickPrice">MRP Price</label>
                                            <input type="text" name="quickPrice" id="quickPrice" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="quickPurchasePrice">Purchase Price</label>
                                            <input type="text" name="quickPurchasePrice" id="quickPurchasePrice" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="quickOfferPrice">Offer Price</label>
                                            <input type="text" name="quickOfferPrice" id="quickOfferPrice" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="quickRecommendedItemFlag">Recommended Item?</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="quickRecommendedItemFlag" id="recommendedItemFlagYes" value="1">
                                                <label class="form-check-label" for="recommendedItemFlagYes">Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <input class="form-check-input" type="radio" name="quickRecommendedItemFlag" id="recommendedItemFlagNo" value="0" checked="">
                                                <label class="form-check-label" for="recommendedItemFlagNo">No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="quickPopularItemFlag">Popular Item?</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="quickPopularItemFlag" id="popularItemFlagYes" value="1">
                                                <label class="form-check-label" for="popularItemFlagYes">Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <input class="form-check-input" type="radio" name="quickPopularItemFlag" id="popularItemFlagNo" value="0" checked="">
                                                <label class="form-check-label" for="popularItemFlagNo">No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="quickBestItemFlag">Best Item?</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="quickBestItemFlag" id="bestItemFlagYes" value="1">
                                                <label class="form-check-label" for="bestItemFlagYes">Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <input class="form-check-input" type="radio" name="quickBestItemFlag" id="bestItemFlagNo" value="0" checked="">
                                                <label class="form-check-label" for="bestItemFlagNo">No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" id="quick_best_item_image_div" style="display: none">
                                        <div class="form-group">
                                            <label for="image">Best Item Image</label><br/>
                                            <input type="file" name="quickBestItemImage" id="quickBestItemImage" value="" accept="image/jpeg,image/png,image/jpg">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="image">Image</label>
                                            <input type="file" name="quickImage" id="quickImage" value="" accept="image/jpeg,image/png,image/jpg" required=""/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="quickDescription">Description</label>
                                            <textarea name="quickDescription" class="form-control" rows="2"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="quickItemPriority">Item Priority</label>
                                            <input type="text" name="quickItemPriority" class="form-control" required="" />
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
            $('input[type=radio][name="quickBestItemFlag"]').on('change', function () {
                if ($('input[name="quickBestItemFlag"]:checked').val() == 1) {
                    $('#quick_best_item_image_div').show();
                } else {
                    $('#quick_best_item_image_div').hide();
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
