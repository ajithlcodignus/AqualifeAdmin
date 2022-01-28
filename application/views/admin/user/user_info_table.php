<div class="content-wrapper">
    <div id="item-modal" class="modal fade"></div>
    <div id="item-result-modal" class="modal fade"></div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">User List</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 text-right">
                    <form role="form" method="post" action="<?= base_url('admin/user_status'); ?>" id="quickForm">
                        <div>
                            <select class="form-control" name="accountStatus" id="accountStatus" style="width:auto; display:inline">
                                <option selected disabled>-- Account Status --</option>
                                <option style="color: black;" value="NORMAL">NORMAL</option>
                                <option style="color: yellow;" value="WARNING">WARNING</option>
                                <option style="color: orange" value="SUSPECT">SUSPECT</option>
                                <option style="color: red;" value="BLOCKED">BLOCKED</option>
                            </select>
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
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
                            <table class="table table-striped table-valign-middle" id="datatable1">
                                <thead>
                                    <tr>
                                        <th width="5%;" class="text-center">Sl No</th>
                                        <th width="20%;">Name</th>
                                        <th width="15%;">Email</th>
                                        <th width="15%;">Phone</th>
                                        <th width="15%;">Order Count</th>
                                        <th width="15%;">Status</th>
                                        <th width="10%;" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    if (!empty($user_data)) {
                                        foreach ($user_data as $row) {
                                    ?>

                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?php echo $row->name; ?></td>
                                                <td><?php echo $row->emailId; ?></td>
                                                <td><?php echo $row->mobile; ?></td>
                                                <td style="text-align: center">
                                                    <a class="badge badge-primary" href="<?= base_url('admin/single_user_orders/' . $row->userId); ?>"><?php echo $row->orderCount; ?></a>
                                                </td>
                                                <td>
                                                    <span class="badge badge-warning" <?php
                                                                                        if ($row->accountStatus == "NORMAL") {
                                                                                            echo "style='background-color: white'";
                                                                                        }
                                                                                        if ($row->accountStatus == "WARNING") {
                                                                                            echo "style='background-color: yellow'";
                                                                                        }
                                                                                        if ($row->accountStatus == "SUSPECT") {
                                                                                            echo "style='background-color: orange'";
                                                                                        }
                                                                                        if ($row->accountStatus == "BLOCKED") {
                                                                                            echo "style='background-color: red;'";
                                                                                        }
                                                                                        ?>>
                                                        <?php echo $row->accountStatus; ?></span>
                                                </td>
                                                <td class="text-center">
                                                    <a class="btn btn-primary btn-xs" href="<?= base_url('admin/user_full_view/' . $row->userId); ?>"><i class="fa fa-book" title="Full View"></i></a>
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