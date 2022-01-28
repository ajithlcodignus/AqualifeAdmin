<div class="content-wrapper">
    <div id="item-modal" class="modal fade"></div>
    <div id="item-result-modal" class="modal fade"></div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Order Shipping</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 text-right">
                    <a type="button" class="btn btn-success btn-xs" href="<?= base_url('admin/add_shipping/' . $this->uri->segment(3)); ?>"><i class="fa fa-plus"></i> Shipping</a>
	    <a type="button" class="btn btn-success btn-xs" href="<?= base_url('admin/complete_order/' . $this->uri->segment(3)); ?>">Order Complete</a>
	</div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <?php if (!empty($order_shipping)) {
                    ?>
                        <div class="card">
                            <div class="card-body table-responsive">
                                <table class="table table-striped table-valign-middle" id="datatable1">
                                    <thead>
                                        <tr>
                                            <th width="5%;" class="text-center">Sl No</th>
                                            <th>Shiping Status</th>
                                            <th>Address</th>
                                            <th>Progress Bar Status</th>
                                            <th>Pincode</th>
                                            <th>Remarks</th>
                                            <th width="10%;" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        if (!empty($order_shipping)) {
                                            foreach ($order_shipping as $row) {
                                        ?>
                                                <tr>
                                                    <td><?= $i; ?></td>
                                                    <td><b><?= $row->shippingStatus ?></b></td>
                                                    <td><?= $row->address ?></td>
                                                    <td><?= $row->progressBarStatus ?></td>
                                                    <td><?= $row->pinCode ?></td>
                                                    <td> <i> <?= $row->remarks ?></i></td>
                                                    <td class="text-center">
                                                        <a type="button" class="btn btn-info btn-xs" href="<?= base_url('admin/order_shippment_edit/' . $row->orderShippingId); ?>" title="Edit"><i class="fa fa-edit" title="Edit"></i></a>

                                                        <a class="btn btn-danger btn-xs" href="javascript:void(0);" onclick="delete_order_shippment(<?= $row->orderShippingId; ?>);"><i class="fa fa-trash" title="Delete"></i></a>
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
                    <?php
                    } else
                        echo "No Records...!";
                    ?>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    function delete_order_shippment(id) {
        var res = confirm("Are you sure!  You want to delete this shipment?");
        if (res == true) {
            $.post("<?= base_url(); ?>admin/delete_order_shippment", {
                id: id
            }, function(data) {
                if (data.length > 0) {
                    alert(data);
                    location.reload(true);
                }
            })
        } else {
            alert("Your Shipping Details are safe...!")
        }
    }
</script>
