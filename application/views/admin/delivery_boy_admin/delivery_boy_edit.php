<link rel="stylesheet" href="<?php echo base_url('plugins/Jcrop/css/jCropstyle.css'); ?>" />
<link rel="stylesheet" href="<?php echo base_url('plugins/Jcrop/css/jquery.Jcrop.min.css'); ?>" type="text/css" />
<div id="img-modal" class="modal fade"></div>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">EDIT DELIVERY BOY</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 text-right">
                    <a type="button" class="btn btn-info btn-xs" href="<?= base_url(); ?>admin/delivery_boy_admin"><i class="fa fa-backward"></i> BACK TO LIST</a>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <form role="form" method="post" action="<?= base_url('admin/update_delivery_boy'); ?>" id="quickForm">
                            <div class="card-body">
                                <input type="hidden" id="deliveryBoyId" name="deliveryBoyId" value="<?= $delivery_boy_details->deliveryBoyId ?>"/>
                                <div class="row">



                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" name="deliveryBoyName" class="form-control" value="<?= $delivery_boy_details->deliveryBoyName; ?>" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="itemType">Mobile</label>
                                            <input type="text" name="editMobile" class="form-control" value="<?= $delivery_boy_details->mobile; ?>" required="">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="price">Email ID</label>
                                            <input type="text" name="editEmailId" class="form-control" value="<?= $delivery_boy_details->emailId ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="price">Commission Type</label>
                                            <select class="form-control" name="commissionType" style="width: 100%;" required="">
                                                <option value="FIXED">Fixed Amount</option>
                                                <option value="PERCENTAGE">Percentage</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="commissionAmount">Commission Amount</label>
                                            <input type="text" name="commissionAmount" class="form-control" value="<?= $delivery_boy_details->commissionAmount ?>" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="availabilityStatus">Active</label>
                                            <select class="form-control" name="active" style="width: 100%;" required="">
                                                <option value="1" <?= $delivery_boy_details->active == 1 ? 'selected' : ''; ?>>Active</option>
                                                <option value="0" <?= $delivery_boy_details->active == 0 ? 'selected' : ''; ?>>In Active</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="offerPrice">Place</label>
                                            <input type="text" name="place" class="form-control" value="<?= $delivery_boy_details->place ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="description">Pin Code</label>

                                            <input type="text" name="pinCode" class="form-control" value="<?= $delivery_boy_details->pinCode ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="description">Address</label>
                                            <textarea name="address" class="form-control" rows="2"><?= $delivery_boy_details-> address?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">UPDATE</button>
                            </div>
                        </form>
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
