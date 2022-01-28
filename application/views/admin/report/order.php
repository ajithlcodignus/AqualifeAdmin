<div class="content-wrapper">
    <div id="item-modal" class="modal fade"></div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Order Report</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <form class="form-horizontal serach_form" id="form" method="post" action="<?= base_url(); ?>admin/order_report_details">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="far fa-calendar-alt"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control float-right" name="search_date" id="reservation" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="form-control" name="search_order_status" style="width: 100%;">
                                                <option value="">All Order Status</option>
                                                <?php
                                                if (count($status)) {
                                                    foreach ($status as $val) {
                                                        ?>
                                                        <option value="<?= $val; ?>"><?= $val; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <input type="hidden" name="type" id="type" value="" />
                                    <div class=" col-md-2">
                                        <button class="btn btn-block btn-primary btn-sm" id="search_btn" type="button"><i class="fa fa-search"></i> Search</button>
                                    </div>
                                    <div class=" col-md-1">
                                        <button class="btn btn-block btn-primary btn-sm" id="pdf_btn" name="pdf" value="1" type="submit"><i class="fa fa-download"></i> PDF</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                    <div id="search_result">
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<script>
    jQuery(document).ready(function () {
        $("form button[type=submit]").click(function () {
            $("button[type=submit]", $(this).parents("form")).removeAttr("clicked");
            $(this).attr("clicked", "true");
        });
        $('#reservation').daterangepicker({
            format: moment().format('DD/MM/YYYY'),
        });

        $('#form').on('submit', function (e) {
            e.preventDefault();
            var val = $("button[type=submit][clicked=true]").val();
            $('#type').val(val);
            this.submit();
        });
        $('#search_btn').on('click', function (e) {
            $('button[type="button"]').prop('disabled', true);
            $('#type').val(0);
            var formData = new FormData($('.serach_form')[0]);
            var url = $('.serach_form').attr('action');
            $('#search_btn').html(' Loading...');
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function (data) {
                    $('#search_btn').html('<i class="fa fa-search"></i>  Search');
                    $('button[type="button"]').prop('disabled', false);
                    if (data.result) {
                        $('#search_result').html(data.search_data)

                    }
                }
            });
        });
    });
</script>
