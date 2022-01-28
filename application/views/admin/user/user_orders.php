<div class="content-wrapper">
    <div id="item-modal" class="modal fade"></div>
    <div id="item-result-modal" class="modal fade"></div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Quick Bill List</h1>
                </div><!-- /.col -->
               
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
                                        <th width="20%;">Customer Name</th>
                                        <th width="15%;">Payment Amount</th>
                                        <th width="15%;">Order Status</th>
                                        <th width="15%;">Date</th>
                                        <th width="10%;" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    if (!empty($bill_data)) 
                                    {
                                        foreach ($bill_data as $row) 
                                        {
                                            ?>

                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?php echo $row->name;?></td>
                                                <td><?php echo $row->paymentAmount;?></td>
                                                <td><?php echo $row->orderSummary;?></td>
                                                <td><?php echo $row->orderEntryDate;?></td>
                                                <td class="text-center">
                                                    <a class="btn btn-primary btn-xs" href="<?= base_url('admin/quick_bill/' . $row->orderId); ?>" ><i class="fa fa-book" title="Full View"></i></a>
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
