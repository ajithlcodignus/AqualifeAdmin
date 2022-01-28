

<div id="toastWidget">
</div>



<div class="content-wrapper">
    <div id="item-modal" class="modal fade"></div>
    <div id="item-result-modal" class="modal fade"></div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">QUICK CART ITEM</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content">
    
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12" style="display: flex;">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body table-responsive">
                            <table class="table table-striped table-valign-middle" id="datatable1">
                                    <thead>
                                        <tr>
                                            <th width="5%;" class="text-center">Sl No</th>
                                            <th width="35%;">Name</th>
                                            <th width="15%;">MRP</th>
                                            <th width="15%;">Offer Price</th>
                                            <th width="15%;" class="text-center">Action</th>
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
                                                    <td><?php echo $row->name; ?></td>
                                                    <td><?php echo $row->price; ?></td>
                                                    <td><?php echo $row->offerPrice; ?></td>
                                                    <td class="text-center">
                                                        <input id="itemId<?=$i?>" type="hidden" value="<?= $row->itemId ?>">
                                                        <input id="itemName<?=$i?>" type="hidden" value="<?= $row->name ?>">
                                                        <input id="offerPrice<?=$i?>" type="hidden" value="<?= $row->offerPrice ?>">
                                                        <a class="btn btn-primary btn-xs" href="javascript:void(0);" onclick="quick_cart(<?= $i;?>);"><i class="fa fa-plus"></i></a>
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
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body table-responsive">
                                <table class="table table-striped table-valign-middle">
                                    
                                    <?php 
                                        if (!empty($cart_item)) 
                                        {
                                    ?>
                                            <thead>
                                            <tr>
                                                <th width="5%;" class="text-center">Sl No</th>
                                                <th width="40%;">Item</th>
                                                <th width="15%;">Quantity</th>
                                                <th  width="15%;">Price</th>
                                                <th style="text-align: end" width="15%;">Total Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $total_item_amount = 0;
                                                $total_items = 0;
                                                $i = 1;
                                                foreach ($cart_item as $row) 
                                                {
                                            ?>
                                                        <tr>
                                                            <td><?= $i; ?></td>
                                                            <td><?php echo $row->quickItemName; ?></td>
                                                            <td style="text-align: end">
                                                            
                                                                <input id="quickCartId<?=$i?>" name="quickCartId<?=$i?>"  type="hidden" value="<?= $row->quickCartId ?>">
                                                                <input id="quickQuantity<?=$i?>" name="quickQuantity<?=$i?>"  type="hidden" value="<?= $row->quickQuantity ?>">
                                                                <a class="btn btn-primary btn-xs" href="<?= base_url()?>admin/quickCartDecre/<?= $row->quickCartId.'/'. $row->quickQuantity?>">
                                                                    <i class="fa fa-minus"></i>
                                                                </a>
                                                                    <span style="padding: 3px;"><?php echo $row->quickQuantity; ?></span>
                                                                <a class="btn btn-primary btn-xs" href="<?= base_url()?>admin/quickCartIncre/<?= $row->quickCartId ?>" >
                                                                    <i class="fa fa-plus"></i>
                                                                    </a>
                                                            </td>
                                                            <td style="text-align: end"><?php echo $row->quickAmount; ?></td>
                                                            <td style="text-align: end"><?php echo $row->quickQuantity * $row->quickAmount; ?></td>
                                                        </tr>

                                            <?php
                                                $total_item_amount = $total_item_amount + ($row->quickQuantity * $row->quickAmount)+$row->quickGst;
                                                $total_items+=$row->quickQuantity;
                                                $i++;
                                                }
                                            ?>
                                            <tr>
                                                <td></td>
                                                <th>GST</th>
                                                <td></td>
                                                <td></td>
                                                <th style="text-align: end"><?php echo $row->quickGst; ?></th>
                                            </tr>
                                            
                                            <tr>
                                                <td></td>
                                                <th>Grand Total</th>
                                                <th style="text-align: end"><?= $total_items ?></th>
                                                <td></td>
                                                <th style="text-align: end"><?= $total_item_amount?></th>
                                            </tr>

                                        </tbody>

                                    <?php
                                        } else
                                        echo "Your Cart Is Empty...!"; 
                                    ?>
                                </table>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success" style="float: right;">
                            <a style="color: #fff;" href="<?= base_url('admin/quick_order_submit') ?>">Submit Order</a>
                        </button>   
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
