<div class="content-wrapper">
    <div id="item-modal" class="modal fade"></div>
    <div id="item-result-modal" class="modal fade"></div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">FOR SHOP</h1>
                </div><!-- /.col -->
                <!-- <div class="col-sm-6 text-right">
                    <a type="button" class="btn btn-success btn-xs" href="javascript:void(0);" onclick="import_item();"><i class="fa fa-plus"></i> IMPORT ITEM</a>
                    <a type="button" class="btn btn-success btn-xs" href="<?= base_url(); ?>admin/quick_add_items_for_shop"><i class="fa fa-plus"></i> ITEM</a>
                </div> -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table class="table table-striped table-valign-middle" id="datatable1">
                                <thead>
                                    <tr>
                                        <th width="5%;" class="text-center">Sl No</th>
                                        <th width="35%;">Name</th>
                                        <th width="15%;">MRP</th>
                                        <th width="15%;">Purchase Price</th>
                                        <th width="15%;">Offer Price</th>
                                        <th width="10%;" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    if (!empty($item)) 
                                    {
                                        foreach ($item as $row) 
                                        {
                                            ?>

                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?php echo $row->quickName;?></td>
                                                <td><?php echo $row->quickPrice;?></td>
                                                <td><?php echo $row->quickPurchasePrice;?></td>
                                                <td><?php echo $row->quickOfferPrice;?></td>
                                                <td class="text-center">
                                                    <a class="btn btn-primary btn-xs" href="<?= base_url('admin/quick_item_view/' . $row->quickItemId); ?>" ><i class="fa fa-book" title="Full View"></i></a>
                                                    <a type="button" class="btn btn-info btn-xs" href="<?= base_url('admin/quick_item_edit/' . $row->quickItemId); ?>" title="Edit"><i class="fa fa-edit" title="Edit"></i></a>
                                                    <!--<a class="btn btn-danger btn-xs" href="javascript:void(0);" onclick="delete_item(<?/*= $row->itemId; */?>);"><i class="fa fa-trash"  title="Delete"></i></a>-->
                                                </td>
                                            </tr>

                                            <?php
                                            $i++;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
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
