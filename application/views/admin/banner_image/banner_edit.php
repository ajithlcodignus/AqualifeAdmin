<div id="img-modal" class="modal fade"></div>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">EDIT BANNER</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 text-right">
                    <a type="button" class="btn btn-info btn-xs" href="<?= base_url(); ?>admin/banner_images"><i class="fa fa-backward"></i> BACK TO LIST</a>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <form role="form" method="post" action="<?= base_url('admin/update_banner');?>" id="quickForm"  enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <input type="hidden" name="id" value="<?= $banner_details->id; ?>"/>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Description</label>
                                            <input type="text" name="description" class="form-control" value="<?= $banner_details->description; ?>" required="" />
                                        </div>
				    </div>
				    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" name="status" style="width: 100%;" required="">
                                                <option value="1" <?= $banner_details->status == 1 ? 'selected' : ''; ?>>Active</option>
                                                <option value="0" <?= $banner_details->status == 0 ? 'selected' : ''; ?>>In Active</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="image">Banner </label>
                                            <input type="file" name="banner" id="banner" value="" accept="image/jpeg,image/png,image/jpg" />
                                        </div>
                                        <?php if ($banner_details->banner) { ?>
                                            <img src="<?= base_url() . $banner_details->banner; ?>" style="width: 40%;">
                                            <input type="hidden" value="<?= $banner_details->banner ?>" name="currentImage">
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

