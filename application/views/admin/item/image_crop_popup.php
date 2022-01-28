<div id="popup_image">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Select Image</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin: -6px;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" style="margin: 0px;">
                    <div style="width: 90%;">
                        <form action="<?= base_url(); ?>admin/image_crop_upload" method="post" id="form_id" enctype="multipart/form-data" target="upload_frame" onsubmit="submit_photo()">
                            <div class="form-group">
                                <input type="file" name="photo" id="photo" class="file_input" onchange="image_crop_load(this);"  accept="image/jpeg,image/jpg,image/png">
                                <div id="loading_progress"></div>
                            </div>
                        </form>
                        <iframe name="upload_frame" class="upload_frame"></iframe>
                    </div> 
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>
<div id="popup_crop">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Image</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    <!-- This is the image we're attaching the crop to -->
                    <img id="cropbox" />

                    <!-- This is the form that our event handler fills -->

                    <input type="hidden" id="x" name="x" />
                    <input type="hidden" id="y" name="y" />
                    <input type="hidden" id="w" name="w" />
                    <input type="hidden" id="h" name="h" />
                    <input type="hidden" id="photo_url" name="photo_url" />
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button"  class="btn btn-primary btn-sm" onclick="crop_photo(<?php echo $type; ?>)">Crop & Upload Image</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
</div>
<script>
    jQuery(document).ready(function () {
        $('#cropbox').Jcrop({
            aspectRatio: TARGET_W / TARGET_H,
            setSelect: [0, 0, TARGET_W, TARGET_H],
            onSelect: updateCoords
        }, function () {
            jcrop_api = this;
        });
    });
</script>