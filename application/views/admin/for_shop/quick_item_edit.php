<link rel="stylesheet" href="<?php echo base_url('plugins/Jcrop/css/jCropstyle.css'); ?>" />
<link rel="stylesheet" href="<?php echo base_url('plugins/Jcrop/css/jquery.Jcrop.min.css'); ?>" type="text/css" />
<div id="img-modal" class="modal fade"></div>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">EDIT QUICK ITEM</h1>
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
                        <form role="form" method="post" action="<?= base_url('admin/update_quick_item'); ?>" id="quickForm" enctype="multipart/form-data">
                            <div class="card-body">
                                <input type="hidden" name="quickItemId" value="<?= $item[0]->quickItemId ?>"/>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Shop</label>
                                            <select class="form-control select2" name="quickShopId" style="width: 100%;" required="" disabled>
                                                <?php
                                                if (count($shop)) {
                                                    foreach ($shop as $val) {
                                                        ?>
                                                        <option value="<?= $val->shopId; ?>" <?= $item[0]->quickShopId == $val->shopId ? 'selected' : ''; ?>><?= $val->name; ?></option>
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
                                            <input type="text" name="quickName" class="form-control" value="<?= $item[0]->quickName; ?>" required=""  maxlength="30">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select class="form-control select2" name="quickCategoryId" style="width: 100%;" required="">
                                                <?php
                                                if (!empty($category)) {
                                                    foreach ($category as $val) {
                                                        ?>
                                                        <option value="<?= $val->categoryId; ?>" <?= $item[0]->quickCategoryId == $val->categoryId ? 'selected' : ''; ?>><?= $val->name; ?></option>
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
                                            <label for="quickAvailabilityStatus">Availability Status</label>
                                            <select class="form-control" name="quickAvailabilityStatus" style="width: 100%;" required="">
                                                <option value="1" <?= $item[0]->quickAvailabilityStatus == 1 ? 'selected' : ''; ?>>Available</option>
                                                <option value="0" <?= $item[0]->quickAvailabilityStatus == 0 ? 'selected' : ''; ?>>Not Available</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="price">MRP Price</label>
                                            <input type="text" name="quickPrice" id="quickPrice" class="form-control" value="<?= $item[0]->quickPrice; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="purchasePrice">Purchase Price</label>
                                            <input type="text" name="quickPurchasePrice" id="quickPurchasePrice" class="form-control" value="<?= $item[0]->quickPurchasePrice; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="offerPrice">Offer Price</label>
                                            <input type="text" name="quickOfferPrice" class="form-control" value="<?= $item[0]->quickOfferPrice; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="recommendedItem">Recommended Item?</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="quickRecommendedItemFlag" id="recommendedItemFlagYes" value="1" <?= $item[0]->quickRecommendedItemFlag == 1 ? 'checked=""' : ''; ?>>
                                                <label class="form-check-label" for="recommendedItemFlagYes">Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <input class="form-check-input" type="radio" name="quickRecommendedItemFlag" id="recommendedItemFlagNo" value="0" <?= $item[0]->quickRecommendedItemFlag == 0 ? 'checked=""' : ''; ?>>
                                                <label class="form-check-label" for="recommendedItemFlagNo">No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="popularItem">Popular Item?</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="quickPopularItemFlag" id="popularItemFlagYes" value="1" <?= $item[0]->quickPopularItemFlag == 1 ? 'checked=""' : ''; ?>>
                                                <label class="form-check-label" for="popularItemFlagYes">Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <input class="form-check-input" type="radio" name="quickPopularItemFlag" id="popularItemFlagNo" value="0" <?= $item[0]->quickPopularItemFlag == 0 ? 'checked=""' : ''; ?>>
                                                <label class="form-check-label" for="popularItemFlagNo">No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="bestItem">Best Item?</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="quickBestItemFlag" id="bestItemFlagYes" value="1" <?= $item[0]->quickBestItemFlag == 1 ? 'checked=""' : ''; ?>>
                                                <label class="form-check-label" for="bestItemFlagYes">Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <input class="form-check-input" type="radio" name="quickBestItemFlag" id="bestItemFlagNo" value="0" <?= $item[0]->quickBestItemFlag == 0 ? 'checked=""' : ''; ?>>
                                                <label class="form-check-label" for="bestItemFlagNo">No</label>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="image">Image</label>
                                            <input type="file" name="quickImage" id="quickImage" value="" accept="image/jpeg,image/png,image/jpg" />
                                        </div>
                                        <?php if ($item[0]->quickImage) { ?>
                                            <img src="<?= base_url() . $item[0]->quickImage; ?>" style="width: 25%;">
                                            <input type="hidden" value="<?= $item[0]->quickImage ?>" name="currentImage">
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea name="quickDescription" class="form-control" rows="2" maxlength="200"><?= $item[0]->quickDescription; ?></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="itempriority">Item Priority</label>
                                            <input type="text" name="quickItemPriority" class="form-control" required="" value="<?= $item[0]->quickItemPriority; ?>" />
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
