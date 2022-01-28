// the target size
var TARGET_W = 150;
var TARGET_H = 170;

function submit_photo() {
    if ($('#photo').val() != '') {
        $('#loading_progress').html(' Loading...');
    }
    $('#loading_progress').html(' Loading...');
}
function image_crop_load() {
    $('#form_id').submit();
}
// show_popup : show the popup
function show_popup(id, type) {
    // show the popup
    $('#' + id).show();
    var $modal = $('#img-modal');
    $modal.load("" + base_url + "admin/image_crop_popup/", {id: id, type: type}, function () {
        $modal.modal({backdrop: 'static', keyboard: false, width: '20%', });
    });
}

// close_popup : close the popup
function close_popup(id) {
    // hide the popup
    $('#' + id).hide();
}

// show_popup_crop : show the crop popup
function show_popup_crop(url, id) {
    // change the photo source
    $('#cropbox').attr('src', url);
    // destroy the Jcrop object to create a new one
    try {
        jcrop_api.destroy();
    } catch (e) {
        // object not defined
    }

    // store the current uploaded photo url in a hidden input to use it later
    $('#photo_url').val(id);
    // hide and reset the upload popup

    $('#loading_progress').html('');
//    $('#photo').val('');

    // show the crop popup
    $('#popup_crop').show();
    $('#popup_image').hide();
}

// crop_photo : 
function crop_photo(type) {
    var x_ = $('#x').val();
    var y_ = $('#y').val();
    var w_ = $('#w').val();
    var h_ = $('#h').val();
    var photo_url_ = $('#photo_url').val();
    $('#popup_crop').hide();

    $('#photo_container_' + type).html(' Processing...');

    // crop photo with a php file using ajax call
    $.ajax({
        url: base_url + 'admin/crop_photo',
        type: 'POST',
        data: {x: x_, y: y_, w: w_, h: h_, photo_url: photo_url_, targ_w: TARGET_W, targ_h: TARGET_H, action_type: type},
        success: function (data) {
            // display the croped photo
            $('#photo_container_' + type).html(data);
            var $modal = $('#img-modal');
            $modal.modal('toggle');


        }
    });
}

// updateCoords : updates hidden input values after every crop selection
function updateCoords(c) {
    $('#x').val(c.x);
    $('#y').val(c.y);
    $('#w').val(c.w);
    $('#h').val(c.h);
}
// END
