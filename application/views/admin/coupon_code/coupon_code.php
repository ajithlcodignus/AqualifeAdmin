<div id="img-modal" class="modal fade"></div>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Coupon Code</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 text-right">

                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <form role="form" method="post" action="<?= base_url('admin/insert_coupon_code');?>" id="quickForm"  enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="hidden" name="shopIdArray" id="shopIdArray" value="<?php
                                                $array=array();
                                                foreach ($shop_details as $value){
                                               $array[] = $value->shopId; }
                                               echo( implode(',',$array)) ?>" />
                                        <div class="form-group">
                                            <label for="shop">Select Shop</label>
                                            <select class="form-control" name="shopId" required="">
                                                <option selected disabled>--Select--</option>
                                                <option value="0" 
                                               >Select All Shops</option>
                                                <?php
                                                    foreach($shop_details as $value)
                                                    {
                                                 ?>
                                                <option value= "<?php echo $value->shopId;?>"><?php echo $value->name;?>
                                                <?php
                                                }
                                                ?>
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Coupon Name</label>
                                            <input type="text" maxlength="5"  name="couponName" id="couponName"  class="form-control" required="" />
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="number">Coupon Number</label>
                                            <input type="number"  maxlength="5"  name="couponNumber" id="couponNumber" class="form-control" required=""  />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" name="status" style="width: 100%;" required="">
                                                <option selected disabled>--Select--</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="couponType">Coupon Type</label>
                                            <select class="form-control" name="couponType" id="couponType" style="width: 100%;" required="">
                                                <option selected disabled>--Select--</option>
                                                <option value="2">Order Count</option>
                                                <option value="1">Discount Percentage</option>
                                                <option value="0">Fixed Amount</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="couponValue" id="couponTypeLabel">Percentage (%)</label>
                                            <input type="number"  name="numberOfOrders" id="numberOfOrders" class="form-control" required="" />
                                            <input type="text"  disabled style="display:none" name="couponPercentage" id="couponPercentage" class="form-control" required="" />
                                            <input type="text" disabled style="display:none" name="couponFixedAmount" id="couponFixedAmount" class="form-control" required="" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="purchase">Minimum Purchase Amount</label>
                                            <input type="number"  name="minPurchaseAmount" id="minPurchaseAmount" class="form-control" required=""  />
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="discount">Maximum Discount Amount</label>
                                            <input type="number"   name="maxDiscountAmount" id="maxDiscountAmount" class="form-control" required=""  />
                                        </div>
                                    </div>

                                    <div class="col-md-4" style="display:none" id="orderCountDiv">
                                        <div class="form-group" >
                                            <label for="orderCountType">Order Count Type</label>
                                            <select class="form-control" name="orderCountType" id="orderCountType" style="width: 100%;" required="">
                                                <option selected disabled>--Select--</option>
                                                <option value="2">Free delivery</option>
                                                <option value="1">Discount Percentage</option>
                                                <option value="0">Fixed Amount</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4" style="display:none" id="couponTypeDiv">
                                        <div class="form-group" >
                                            <label for="couponValue1" id="percentageLabel" >Percentage</label>
                                            <input type="text" style="display:none" name="orderCountFixed" id="orderCountFixed" class="form-control" required="" />
                                            <input type="text"   name="orderCountPercentage" id="orderCountPercentage" class="form-control" required="" />
                                        </div>
                                    </div>

                                    

                                    
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" id="submit" name="submit" class="btn btn-primary">Submit</button>
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
<!-- <script>
        jQuery(document).ready(function () {
            $('input[type=radio][name="bestItemFlag"]').on('change', function () {
                if ($('input[name="bestItemFlag"]:checked').val() == 1) {
                    $('#best_item_image_div').show();
                } else {
                    $('#best_item_image_div').hide();
                }
            });
        });
        function load_sub_category(cat_id) {
            $('#sub_category_div').html('<div style="margin-top:35px;text-align: center;color: green;"><b>Loading...</b></div>');
            $.ajax({
                'url': '<?= base_url('admin/load_sub_category'); ?>',
                'type': 'POST',
                'data': {cat_id: cat_id},
                'success': function (result) {
                    $('#sub_category_div').html(result);
                }
            });
        }
</script> -->
