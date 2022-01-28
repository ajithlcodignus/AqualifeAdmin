<div class="content-wrapper">
    <div id="item-modal" class="modal fade"></div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Coupon Code</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 text-right">
                    <a type="button" class="btn btn-success btn-xs" href="<?= base_url(); ?>admin/coupon_code"><i class="fa fa-plus"></i>  Coupon</a>
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
                                        <th width="20%;">Coupon Name</th>
                                        <th width="20%;">Coupon Number</th>
                                        <th width="20%;">Coupon Code</th>
                                        <th width="20%;">Status</th>
                                        <th width="20%;">Coupon Type</th>
                                        <th width="20%;">Number Of Orders</th>
                                        <th width="20%;">Coupon Value(Fixed/%)</th>
                                        <th width="20%;">Purchase Amount</th>
                                        <th width="20%;">Discount Amount</th>
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
                                                <td><?=strtoupper ($row->couponName) ?></td>
                                                <td><?= $row->couponNumber ?></td>
                                                <td><?=strtoupper ($row->couponCode)?></td>
                                                <td><?php echo $row->status == 1 ? 'Yes' : 'No' ?></td>
                                                <td><?php 
                                                        if($row->couponType == 2){ echo 'Order Count';} 
                                                        if($row->couponType == 1){ echo 'Discount Percentage';}
                                                        if($row->couponType == 0){ echo 'Fixed Amount';}
                                                    ?></td>
                                                <td><?php 
                                                        if($row->couponType == 2){ echo "$row->numberOfOrders";}
                                                        else{echo "";}
                                                    ?>
                                                </td>
                                                
                                                <?php if($row->couponPercentage!=null) echo '<td>'.$row->couponPercentage.' %</td>' ?>
                                                <?php if($row->couponFixedAmount!=null) echo '<td>'.$row->couponFixedAmount.'</td>' ?>
                                                <?php if($row->orderCountType==2) echo '<td> FREE DELIVERY </td>' ?>
                                                <td><?= $row->minPurchaseAmount ?></td>
                                                <td><?= $row->maxDiscountAmount ?></td>
                                                
                                                <td class="text-center">
                                                    <a class="btn btn-primary btn-xs" href="<?= base_url('admin/coupon_edit/'.$row->couponId); ?>"><i class="fa fa-edit" title="Edit"></i></a>
                                                    <a type="button" class="btn btn-info btn-xs" href="<?= base_url('admin/delete_coupon?couponId='.$row->couponId); ?>"><i class="fa fa-trash" title="Delete"></i></a>
                                                    
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
