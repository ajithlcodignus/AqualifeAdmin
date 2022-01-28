<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Publish DB Version</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 text-right">
                    <!--<a type="button" class="btn btn-info btn-xs" href="<?/*= base_url(); */?>admin/shops"><i class="fa fa-backward"></i> BACK TO LIST</a>-->
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body table-responsive">
                                <table class="table table-striped table-valign-middle" id="datatable1">
                                    <tbody>
                                        <tr class="text-center">

                                            <input id="publish_flag" type="hidden" value="<?= $flag ?>">
                                            <!--<td><a href="<?/*= base_url('admin/publish_db_changes') */?>" class="btn btn-primary" style="padding-left:20px; padding-right: 20px;">Update DB Changes</a></td>-->
                                            <td><button type="submit" class="btn btn-primary"  onclick="publish_db_change()" style="opacity: <?= $flag == 0 ? 0.5 : 1 ?>;">Publish Now</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- /.card -->
                </div>

            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>

</div>