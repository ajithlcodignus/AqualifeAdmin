<div class="content-wrapper">
    <div id="item-modal" class="modal fade"></div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Shop Categories</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 text-right">

                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-body table-responsive">
                            <?php
                            if (!empty($list)) {
                                ?>
                                <table class="table table-striped table-valign-middle" id="datatable1">
                                    <thead>
                                    <tr>
                                        <th width="15%;">Sl No</th>
                                        <th width="30%;">Name</th>
                                        <th width="40%;">Description</th>
                                        <th width="15%;" class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 1;
                                    if (!empty($list)) {
                                        foreach ($list as $row) {
                                            ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?php echo $row->name; ?></td>
                                                <td><?php echo $row->description; ?></td>
                                                <td class="text-center">
                                                    <a class="btn btn-primary btn-xs" href="<?= base_url('ebadmin/shop_category_view/' . $row->shopCategoryId); ?>"><i class="fa fa-book" title="Full View"></i></a>
                                                    <!--<a type="button" class="btn btn-info btn-xs" href="<?/*= base_url('admin/delivery_boy_edit/' . $row->suCategoryId); */?>"><i class="fa fa-edit"></i></a>-->
                                                    <!--<a class="btn btn-danger btn-xs" href="javascript:void(0);" onclick="delete_delivery_boy(<?/*= $row->suCategoryId; */?>);"><i class="fa fa-trash"></i></a>-->
                                                </td>
                                            </tr>

                                            <?php
                                            $i++;
                                        }
                                    }
                                    ?>

                                    </tbody>
                                </table>
                                <?php
                            }
                            else
                            {
                               echo "No Categories...";
                            }
                            ?>

                        </div>
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