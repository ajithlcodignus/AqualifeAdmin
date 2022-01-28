<link rel="stylesheet" href="<?php echo base_url('plugins/Jcrop/css/jCropstyle.css'); ?>" />
<link rel="stylesheet" href="<?php echo base_url('plugins/Jcrop/css/jquery.Jcrop.min.css'); ?>" type="text/css" />
<div id="img-modal" class="modal fade"></div>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit CATEGORY</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 text-right">
                    <a type="button" class="btn btn-info btn-xs" href="<?= base_url(); ?>admin/item_categories"><i class="fa fa-backward"></i> BACK TO LIST</a>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <form role="form" method="post" action="<?= base_url('admin/update_item_category'); ?>" enctype="multipart/form-data" id="quickForm">
                            <div class="card-body">
                                <div class="row">
                                    <input type="hidden" name="categoryId" value="<?= $category_details->categoryId; ?>"/>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Category</label>
                                            <input type="text" name="name" class="form-control" required=""  value="<?= $category_details->name; ?>"/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea name="description" class="form-control" rows="2" maxlength="200"><?= $category_details->description; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="image">Image</label>
                                            <input type="file" name="image" id="image" value="" accept="image/jpeg,image/png,image/jpg" />
                                        </div>
                                        <?php if ($category_details->image) { ?>
                                            <img src="<?= base_url() . $category_details->image; ?>" style="width: 25%;">
                                            <input type="hidden" value="<?= $category_details->image ?>" name="currentImage">
                                        <?php } ?>
                                    </div>


                                    <!--<div class="col-md-4">
                                        <div class="form-group">
                                            <label for="image">Image</label><br/>
                                            <input type="file" name="image" id="image" value="" accept="image/jpeg,image/png,image/jpg" required="">
                                        </div>
                                    </div>-->

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