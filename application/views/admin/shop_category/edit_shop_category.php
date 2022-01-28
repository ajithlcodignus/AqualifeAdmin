<div id="img-modal" class="modal fade"></div>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">EDIT SHOP CATEGORY</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 text-right">
                    <a type="button" class="btn btn-info btn-xs" href="<?= base_url(); ?>admin/shop_category"><i class="fa fa-backward"></i> BACK TO LIST</a>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <form role="form" method="post" action="<?= base_url('admin/update_shop_category');?>" id="quickForm"  enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <input type="hidden" name="id" value="<?= $shop_category->shopCategoryId; ?>"/>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Shop Category</label>
                                            <input type="text" name="name" class="form-control" value="<?= $shop_category->name; ?>" required="" />
                                        </div>
				    </div>
				    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" name="status" style="width: 100%;" required="">
                                                <option value="ACTIVE" <?= $shop_category->activeFlag == "ACTIVE" ? 'selected' : ''; ?>>Active</option>
                                                <option value="INACTIVE" <?= $shop_category->activeFlag == "INACTIVE" ? 'selected' : ''; ?>>In Active</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="image">Banner </label>
                                            <input type="file" name="image" id="image" value="" accept="image/jpeg,image/png,image/jpg" />
                                        </div>
                                        <?php if ($shop_category->image) { ?>
                                            <img src="<?= base_url() . $shop_category->image; ?>" style="width: 40%;">
                                            <input type="hidden" value="<?= $shop_category->image ?>" name="currentImage">
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
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

