<div class="content-wrapper">
    <div id="item-modal" class="modal fade"></div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Payment Pending Orders</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 text-right">
                   

                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">

                <!-- ./col -->


                <!-- ./col -->
               
                <div class="col-lg-3 col-6">

                    <div class="small-box bg-danger">

                        <div class="inner">
                            
                                <h3><?=
                                
                                number_format((float)$pending_amount_details->paymentAmount, 2, '.', '')
                                
                                ?></h3>
                                


                            <p>Pending Amount</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        
                    </div>
                </div>
              

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                        <h3><?= $pending_amount_details->deliveryBoyCount?></h3>
                           

                            <p>Pending Boys Count</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                       
                    </div>
                </div>

                
            </div>
        </div>
    </section>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-body table-responsive">
                            <?php
                            if (!empty($pending_delivery_boys_list)) {
                                ?>
                                <table class="table table-striped table-valign-middle" id="datatable1">
                                    <thead>
                                    <tr>
                                        <th width="5%;" class="text-center">Sl No</th>
                                        <th>Shop Name</th>
                                        <th>Boy Name</th>
                                        <th>Delivery Number</th>
                                        <th>Amount</th>
                                        <th width="20%;" class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 1;
                                    if (!empty($pending_delivery_boys_list)) {
                                        foreach ($pending_delivery_boys_list as $row) {
                                            ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?php echo $row->shopName; ?></td>
                                                <td><?php echo $row->deliveryBoyName; ?></td>
                                                <td><?php echo $row->deliveryBoyMobile; ?></td>
                                                <td><?php echo $row->paymentAmount; ?></td>
                                                <td class="text-center">
                                                    <a class="btn btn-primary btn-xs" href="<?= base_url('admin/delivery_boy_view_admin/' . $row->dbPaymentId); ?>" ><i class="fa fa-book" title="Full View"></i></a>
                                                    <a class="btn btn-success btn-xs"   href="javascript:void(0);" onclick="update_d_boy_payment_status(<?= $row->dbPaymentId; ?>,'PAID');"><i class="fa fa-check-circle mr-2" title="Amount Paid"></i>PAID</a>
                                                    <!--<a class="btn btn-danger btn-xs" href="javascript:void(0);" onclick="delete_delivery_boy(<?/*= $row->deliveryBoyId; */?>);"><i class="fa fa-trash"  title="Delete"></i></a>-->
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
                               echo "No Delivery Boys...";
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