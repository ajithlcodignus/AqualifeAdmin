<script>
//    var check_session;
//    function CheckForSession() {
//        jQuery.ajax({
//            type: "POST",
//            url: "<?= base_url(); ?>admin/check_session",
//            cache: false,
//            success: function (res) {
//                if (res == '') {
//                    alert();
//                    window.location.href = '<?= base_url(); ?>admin/login';
//                }
//            }
//        });
//    }
//    check_session = setInterval(CheckForSession, 3000);

    function import_item() {
        $('#item-modal').load('<?= base_url(); ?>admin/import_item/', function () {
            $('#item-modal').modal();
        });
    }

    function delete_item(id) {
        var res = confirm("Are you want to delete this item?");
        if (res == true) {
            $.post("<?= base_url(); ?>admin/delete_item", {id: id}, function (data) {
                if (data.length > 0) {
                    alert(data);
                    location.reload(true);
                }
            })
        }
    }

    function delete_delivery_boy(id) {
        var res = confirm("Are you want to delete this deliver boy?");
        if (res == true) {
            $.post("<?= base_url(); ?>admin/delete_delivery_boy", {id: id}, function (data) {
                if (data.length > 0) {
                    alert(data);
                    location.reload(true);
                }
            })
        }
    }

    function quick_import_item() {
        $('#item-modal').load('<?= base_url(); ?>admin/quick_import_item/', function () {
            $('#item-modal').modal();
        });
    }

    

    function update_d_boy_payment_status(dbPaymentId,status) {
       var paid_message="didn't paid";
        if(status=="PAID"){
            paid_message="paid"
        }
        var res = confirm("Are you sure delivery boy "+paid_message+" amount ?");
        if (res == true) {
            $.post("<?= base_url(); ?>admin/update_d_boy_payment_status", {dbPaymentId: dbPaymentId,status:status}, function (data) {
                if (data.length > 0) {
                  
                    location.reload(true);
                }
            })
        }
    }
</script>