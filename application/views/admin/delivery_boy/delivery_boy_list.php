<div class="content-wrapper">
    <div id="item-modal" class="modal fade"></div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Delivery Boys</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 text-right">
                    <?php if($type == "superAdmin")
                    {
                        ?>
                        <a type="button" class="btn btn-success btn-xs" href="<?= base_url(); ?>admin/add_delivery_boy_for_admin"><i class="fa fa-plus"></i> DELIVERY BOY</a>
                    <?php
                    }
                    else {
                        ?>
                        <a type="button" class="btn btn-success btn-xs" href="<?= base_url(); ?>admin/add_delivery_boy_from_list"><i class="fa fa-plus"></i> DELIVERY BOY</a>
                    <?php
                    }?>

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
                            if (!empty($delivery_boys_list)) {
                                ?>
                                <table class="table table-striped table-valign-middle" id="datatable1">
                                    <thead>
                                    <tr>
                                        <th width="5%;" class="text-center">Sl No</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Email ID</th>
                                        <th>Address</th>
                                        <th width="10%;" class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 1;
                                    if (!empty($delivery_boys_list)) {
                                        foreach ($delivery_boys_list as $row) {
                                            ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?php echo $row->deliveryBoyName; ?></td>
                                                <td><?php echo $row->mobile; ?></td>
                                                <td><?php echo $row->emailId; ?></td>
                                                <td><?php echo $row->address; ?></td>
                                                <td class="text-center">
                                                    <a class="btn btn-primary btn-xs" href="<?= base_url('admin/delivery_boy_view/' . $row->deliveryBoyId); ?>"><i class="fa fa-book" title="Full View"></i></a>
                                                    <a type="button" class="btn btn-info btn-xs" href="<?= base_url('admin/delivery_boy_edit/' . $row->deliveryBoyId); ?>" ><i class="fa fa-edit"  title="Edit"></i></a>
                                                    <a class="btn btn-danger btn-xs" href="javascript:void(0);" onclick="delete_delivery_boy(<?= $row->deliveryBoyId; ?>);"><i class="fa fa-trash"  title="Delete"></i></a>
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