<label>Sub Category</label>
<select class="form-control select2" name="subCategoryId" style="width: 100%;">
    <option value="">Select Sub Category</option>
    <?php
    if (count($sub_category)) {
        foreach ($sub_category as $val) {
            ?>
            <option value="<?= $val->suCategoryId; ?>"><?= $val->name; ?></option>
            <?php
        }
    }
    ?>
</select>