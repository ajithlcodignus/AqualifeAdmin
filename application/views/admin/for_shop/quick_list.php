<div class="content-wrapper">
    <div id="item-modal" class="modal fade"></div>
    <div id="item-result-modal" class="modal fade"></div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">FOR  FOODVENOGROCERY</h1>
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
                                        <th width="5%;">Sl No.</th>
                                        <th width="50%;">Name</th>
                                        <th width="20%;">MRP</th>
                                        <th width="20%;">Purchase Price</th>
                                        <th width="20%;">Offer Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($item)) 
                                    {
                                        $i= 1;
                                        foreach ($item as $row) 
                                        {
                                            ?>

                                            <tr>
                                                <td><?php echo $i;?></td>
                                                <td><?php echo $row->quickName;?></td>
                                                <td><?php echo $row->quickPrice;?></td>
                                                <td><?php echo $row->quickPurchasePrice;?></td>
                                                <td><?php echo $row->quickOfferPrice;?></td>
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
