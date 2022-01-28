<div id="img-modal" class="modal fade"></div>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">ADD BANNER IMAGE </h1>
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
                        <form role="form" method="post" action="<?= base_url('admin/insert_banner');?>" id="quickForm"  enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <input type="text" name="description" class="form-control" required="" />
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="banner">Banner Image</label><br/>
                                            <input type="file" name="banner" id="banner" value="" accept="image/jpeg,image/png,image/jpg" required="">
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
