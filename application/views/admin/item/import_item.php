<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">IMPORT ITEM</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin: -6px;">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form role="form" method="post" action="<?= base_url('admin/insert_import_item'); ?>" enctype="multipart/form-data" id="ImportItemForm">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-right" style="margin-bottom: 15px;">
                            <a href="<?= base_url('excel/item.xlsx'); ?>" download=""> <i class="fa fa-download"></i> Download Excel </a>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>
                                Import Excel <i class="fa fa-asterisk" style="font-size: 7px;color:red; vertical-align: text-top;"></i>
                            </label>
                            <input type="file" name="item_import_file" class="form-control" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="load_btn">Submit</button>
            </div>
        </form>
    </div>
    <!-- /.modal-content -->
</div>
<script>
    jQuery(document).ready(function () {
        $.validator.setDefaults({
            submitHandler: function () {
//                        alert("Form successful submitted!");
                var formData = new FormData($('#ImportItemForm')[0]);
                var url = $('#ImportItemForm').attr('action');
                $('#load_btn').prop('disabled', true);
                $('#load_btn').html(' Loading...');
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        $('#load_btn').html('Submit');
                        $('#load_btn').prop('disabled', false);
                        if (data.count) {
                            $('#item-modal').modal('toggle');
                            $('#item-result-modal').load('<?= base_url(); ?>admin/import_result/', {response: data.response}, function () {
                                $('#item-result-modal').modal();
                            });
                        } else {

                        }

                    }
                });
            }
        });
        $('#ImportItemForm').validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                    minlength: 5
                },
                terms: {
                    required: true
                },
            },
            messages: {
                email: {
                    required: "Please enter a email address",
                    email: "Please enter a vaild email address"
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                terms: "Please accept our terms"
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
