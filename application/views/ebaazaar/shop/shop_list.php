<div class="content-wrapper">
    <div id="item-modal" class="modal fade"></div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Shops</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 text-right">
                    <!--<a type="button" class="btn btn-success btn-xs" href="<?/*= base_url(); */?>admin/add_shop"><i class="fa fa-plus"></i> SHOP</a>-->
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
                                        <th width="5%;">Sl No</th>
                                        <th width="22%;">Shop Name</th>
                                        <th width="30%;">Address</th>
                                        <th width="8%;">Priority</th>
                                        <th width="12%;">Type</th>
                                        <th width="13%;" >Active</th>
                                        <th width="10%;" class="text-center">Action</th>
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
                                                <td><?php echo $row->address.", ".$row->pinCode; ?></td>
                                                <td><?php echo $row->shopPriority; ?></td>
                                                <td><?php echo $row->shopCategory; ?></td>
                                                <td><?php echo $row->active == 1 ? 'Yes' : 'No' ?></td>
                                                <td class="text-center">
                                                    <a class="btn btn-primary btn-xs" href="<?= base_url('ebadmin/shop_view/' . $row->shopId); ?>"><i class="fa fa-book" title="Full View"></i></a>
                                                    <!--<a type="button" class="btn btn-info btn-xs" href="<?/*= base_url('admin/shop_edit/' . $row->shopId); */?>"><i class="fa fa-edit" title="Edit"></i></a>-->
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
