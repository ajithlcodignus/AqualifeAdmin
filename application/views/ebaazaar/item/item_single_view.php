<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">ITEM VIEW</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 text-right">
                    <a type="button" class="btn btn-info btn-xs" href="<?= base_url(); ?>ebadmin/item"><i class="fa fa-backward"></i> BACK TO LIST</a>
                </div>
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
                                <table class="table table-striped table-valign-middle" >
                                    <tbody>
                                        <tr>
                                            <td>Item</td>
                                            <td><?= $item[0]->name ?></td>
                                        </tr>
                                        <tr>
                                            <td>Shop</td>
                                            <td><?= $item[0]->shopName ?></td>
                                        </tr>
                                        <tr>
                                            <td>Type</td>
                                            <td><?= $item[0]->itemType ?></td>
                                        </tr>
                                        <tr>
                                            <td>Price</td>
                                            <td><?= number_format($item[0]->price, 2) ?></td>
                                        </tr>
                                        <tr>
                                            <td>Recommended Item?</td>
                                            <td><?= $item[0]->recommendedItemFlag == 1 ? 'Yes' : 'No' ?></td>
                                        </tr>
                                        <tr>
                                            <td>Best Item?</td>
                                            <td><?= $item[0]->bestItemFlag == 1 ? 'Yes' : 'No' ?></td>
                                        </tr>
                                        <tr>
                                            <td>User</td>
                                            <td><?= $item[0]->userName ?></td>
                                        </tr>
                                        <tr>
                                            <td>Image</td>
                                            <td><img src="<?= base_url($item[0]->image); ?>"/></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body table-responsive">
                                <table class="table table-striped table-valign-middle">
                                    <tbody>
                                        <!--<tr>
                                            <td>Category</td>
                                            <td><?/*= $item[0]->CatName */?></td>
                                        </tr>-->
                                        <tr>
                                            <td>Item Category</td>
                                            <td><?= $item[0]->subCatName ?></td>
                                        </tr>
                                        <tr>
                                            <td>Availability</td>
                                            <td><?= $item[0]->availabilityStatus == 1 ? 'Yes' : 'No' ?></td>
                                        </tr>
                                        <tr>
                                            <td>Offer Price</td>
                                            <td><?= number_format($item[0]->offerPrice, 2) ?></td>
                                        </tr>
                                        <tr>
                                            <td>Popular Item</td>
                                            <td><?= $item[0]->popularItemFlag == 1 ? 'Yes' : 'No' ?></td>
                                        </tr>
                                        <tr>
                                            <td>Date & Time</td>
                                            <td><?= date('d-m-Y H:i:s A', strtotime($item[0]->entryDate)) ?></td>
                                        </tr>
                                        <?php if ($item[0]->bestItemFlag == 1) { ?>
                                            <tr>
                                                <td>Best Item Image</td>
                                                <td><img src="<?= base_url($item[0]->bestItemImage); ?>"/></td>
                                            </tr>
                                        <?php } ?>
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
