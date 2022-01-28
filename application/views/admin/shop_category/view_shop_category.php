<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Shop View</h1>
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
                <div class="col-lg-6">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body table-responsive">
                                <table class="table table-striped table-valign-middle" id="datatable1">
                                    <tbody>
                                        <tr>
                                            <td>Shop Category</td>
                                            <td><?= $shop_category->name ?></td> 
                                        </tr>
                                        <tr>
                                            <td>Shop Category Status</td>
                                            <td><?= $shop_category->activeFlag ?></td> 
                                        </tr>
                                        <tr>
                                            <td>Shop Category Image</td>
                                            <td><img src="<?= base_url($shop_category->image) ?>" style="max-height: 300px; max-width: 300px;"/> </td>
                                        </tr>



                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- /.card -->
                </div>
                <!-- <div class="col-lg-6">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body text-left m-0 text-dark">
                               <?php if($shop_details->publishFlag!=0) {
                                   ?>

                                   Your Shop is Published....
                                <?php
                               }
                               else
                               {
                                   ?>
                                   <input id="publish_flag" type="hidden" value="<?= $shop_details->publishFlag ?>">
                                   <input id="shop_item_count" type="hidden" value="<?= $shop_item_count ?>">
                                   <button type="submit" class="btn btn-primary"  onclick="publish_shop(<?= $shop_details->shopId; ?>)" style="opacity: <?= $shop_item_count == 0 ? 0.5 : 1 ?>;">Publish Now</button>
                                <?php
                               }?>
                            </div>
                        </div>
                    </div>
		 </div>
                    /.card -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>

</div>
