<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">QUICK IMPORT DETAILS</h4>
            <a type="button" class="close" href="<?= base_url('admin/quick_shop_items');?>" style="margin: -6px;">
                <span aria-hidden="true">&times;</span>
            </a>
        </div>
        <form role="form" method="post" action="<?= base_url('admin/import_quick_item'); ?>" enctype="multipart/form-data" id="ImportItemForm">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-striped table-valign-middle">
                            <tr>
                                <th class="text-center" width="15%;">Sl No</th>
                                <th>Result</th>
                            </tr>
                            <?php
                            if (count($response)) {
                                $i = 1;
                                foreach ($response as $val) {
                                    ?>
                                    <tr style="<?= $val['flag'] == 0 ? 'color:red' : 'color:green;' ?>">
                                        <td class="text-center"><?= $i; ?></td>
                                        <th><?= $val['msg']; ?></th>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="2">No record</td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <a type="button" class="btn btn-default" href="<?= base_url('admin/quick_shop_items');?>">Close</a>
            </div>
        </form>
    </div>
    <!-- /.modal-content -->
</div>

