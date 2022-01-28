<link rel="stylesheet" href="<?php echo base_url('plugins/Jcrop/css/jCropstyle.css'); ?>" />
<link rel="stylesheet" href="<?php echo base_url('plugins/Jcrop/css/jquery.Jcrop.min.css'); ?>" type="text/css" />
<div id="img-modal" class="modal fade"></div>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">EDIT ITEM</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 text-right">
                    <a type="button" class="btn btn-info btn-xs" href="<?= base_url(); ?>admin/item"><i class="fa fa-backward"></i> BACK TO LIST</a>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <form role="form" method="post" action="<?= base_url('admin/update_item'); ?>" id="quickForm" enctype="multipart/form-data">
                            <div class="card-body">
                                <input type="hidden" name="itemId" value="<?= $item[0]->itemId ?>"/>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Shop</label>
                                            <select class="form-control select2" name="shopId" style="width: 100%;" required="" disabled>
                                                <?php
                                                if (count($shop)) {
                                                    foreach ($shop as $val) {
                                                        ?>
                                                        <option value="<?= $val->shopId; ?>" <?= $item[0]->shopId == $val->shopId ? 'selected' : ''; ?>><?= $val->name; ?></option>
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
                                            <input type="text" name="name" class="form-control" value="<?= $item[0]->name; ?>" required=""  maxlength="30">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select class="form-control select2" name="categoryId" style="width: 100%;" required="">
                                                <?php
                                                if (!empty($category)) {
                                                    foreach ($category as $val) {
                                                        ?>
                                                        <option value="<?= $val->categoryId; ?>" <?= $item[0]->categoryId == $val->categoryId ? 'selected' : ''; ?>><?= $val->name; ?></option>
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
                                            <input type="text" name="itemType" class="form-control" value="<?/*= $item[0]->itemType; */?>" required="">
                                        </div>
                                    </div>-->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="availabilityStatus">Availability Status</label>
                                            <select class="form-control" name="availabilityStatus" style="width: 100%;" required="">
                                                <option value="1" <?= $item[0]->availabilityStatus == 1 ? 'selected' : ''; ?>>Available</option>
                                                <option value="0" <?= $item[0]->availabilityStatus == 0 ? 'selected' : ''; ?>>Not Available</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="price">MRP Price</label>
                                            <input type="text" name="price" id="price" class="form-control" value="<?= $item[0]->price; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="offerPrice">Offer Price</label>
                                            <input type="text" name="offerPrice" class="form-control" value="<?= $item[0]->offerPrice; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="offerPrice">Recommended Item?</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="recommendedItemFlag" id="recommendedItemFlagYes" value="1" <?= $item[0]->recommendedItemFlag == 1 ? 'checked=""' : ''; ?>>
                                                <label class="form-check-label" for="recommendedItemFlagYes">Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <input class="form-check-input" type="radio" name="recommendedItemFlag" id="recommendedItemFlagNo" value="0" <?= $item[0]->recommendedItemFlag == 0 ? 'checked=""' : ''; ?>>
                                                <label class="form-check-label" for="recommendedItemFlagNo">No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="offerPrice">Popular Item?</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="popularItemFlag" id="popularItemFlagYes" value="1" <?= $item[0]->popularItemFlag == 1 ? 'checked=""' : ''; ?>>
                                                <label class="form-check-label" for="popularItemFlagYes">Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <input class="form-check-input" type="radio" name="popularItemFlag" id="popularItemFlagNo" value="0" <?= $item[0]->popularItemFlag == 0 ? 'checked=""' : ''; ?>>
                                                <label class="form-check-label" for="popularItemFlagNo">No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="offerPrice">Best Item?</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="bestItemFlag" id="bestItemFlagYes" value="1" <?= $item[0]->bestItemFlag == 1 ? 'checked=""' : ''; ?>>
                                                <label class="form-check-label" for="bestItemFlagYes">Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <input class="form-check-input" type="radio" name="bestItemFlag" id="bestItemFlagNo" value="0" <?= $item[0]->bestItemFlag == 0 ? 'checked=""' : ''; ?>>
                                                <label class="form-check-label" for="bestItemFlagNo">No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" id="best_item_image_div" style="<?= $item[0]->bestItemFlag == 0 ? 'display: none' : 'display: block'; ?>">
                                        <div class="form-group">
                                            <label for="image">Best Item Image</label><br/>
                                            <span class="btn btn-default btn-xs btn-file" onclick="show_popup('popup_upload', 2);">
                                                Upload Image
                                            </span>
                                            <div class="pad-10"  id="photo_container_2">
                                                <?php if ($item[0]->bestItemImage) { ?>
                                                    <img src="<?= base_url() . $item[0]->bestItemImage; ?>" style="width: 50%;">
                                                <?php } ?>
                                                <input type="hidden" name="bestItemImage" id="bestItemImage" value="" accept="image/jpeg,image/png,image/jpg">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="image">Image</label><br/>
                                            <span class="btn btn-default btn-xs btn-file" onclick="show_popup('popup_upload', 1);">
                                                Upload Image
                                            </span>
                                            <div class="pad-10"  id="photo_container_1">
                                                <?php if ($item[0]->image) { ?>
                                                    <img src="<?= base_url() . $item[0]->image; ?>" style="width: 50%;">
                                                <?php } ?>
                                                <input type="hidden" name="image" id="image" value="" accept="image/jpeg,image/png,image/jpg">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea name="description" class="form-control" rows="2" maxlength="200"><?= $item[0]->description; ?></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Item Priority</label>
                                            <input type="text" name="itemPriority" class="form-control" required="" value="<?= $item[0]->itemPriority; ?>" />
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
<script src="<?php echo base_url('plugins/Jcrop/js/jquery.Jcrop.min.js'); ?>"></script>
<script src="<?php echo base_url('plugins/Jcrop/js/script.js'); ?>"></script>
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