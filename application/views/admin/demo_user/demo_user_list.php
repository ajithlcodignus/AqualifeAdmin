<div class="content-wrapper">
    <div id="item-modal" class="modal fade"></div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Demo Users</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 text-right">
                    <a type="button" class="btn btn-success btn-xs" href="<?= base_url(); ?>admin/add_demo_users"><i class="fa fa-plus"></i>  Demo User</a>
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
                                        <th width="20%;">Name</th>
                                        <th width="20%;">Phone</th>
                                        <th width="20%;">Demo Time</th>
                                        <th width="20%;">Status</th>
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
                                                <td><?= $row->userName ?></td>
                                                <td><?= $row->mobile ?></td>
                                                <td><?= $row->demoTime ?></td>

                                                <td><?= $row->isActive=='Active'?"ACTIVE": 'INACTIVE'?></td>
                                                
                                                <td class="text-center">
                                                    <a class="btn btn-primary btn-xs" href="<?= base_url('admin/demo_user_view/'.$row->demoId); ?>"><i class="fa fa-book" title="Full view"></i></a>
                                                    <a type="button" class="btn btn-info btn-xs" href="<?= base_url('admin/demo_user_edit/'.$row->demoId); ?>"><i class="fa fa-edit" title="Edit"></i></a>
                                                    
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
                               echo "Empty...";
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
