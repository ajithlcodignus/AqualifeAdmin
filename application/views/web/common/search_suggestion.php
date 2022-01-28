
<?php
if(!empty($item_data)){

    ?>
    <li class="list-group-item contsearch pt-1 pb-1">
<span class="search_item_count">
<?php  echo count($item_data).((count($item_data)>1)?' Products ':' Product '). 'found'; ?>
</span>
</li>

    <?php
foreach($item_data as $item_value){ ?>
<a href="<?= base_url('search_result/'.$item_value->itemId) ?>">
<li class="list-group-item contsearch" style="border-radius:0px;">
    <div class="container m-0 pr-0 pl-0">
        <div class="row m-0 p-0">
            <div class="col-4 col-md-4 d-flex justify-content-start m-0 pl-0 pr-2">
             
                 <img class="img-thumbnail img-fluid search_item_img"
                 style="" src="<?= base_url($item_value->image) ?>">

            </div>
            <div class="col-8 col-md-8 p-0 m-0">
                <div class="row">
                    <div class="col-12 col-md-12 pr-0 mr-0">
                    <span class="search_name"><?= $item_value->name ?></span>
                    </div>
                    <div class="col-12 col-md-12">
                    <span class="price search_price"><?= "₹ ". number_format((float)$item_value->offerPrice, 2, '.','') ?></span>
                    </div>
                </div>
            </div>
    </div>
</li>
</a>

<?php }
}else{?>
    <li class="list-group-item contsearch">
            <sanp>No data found</span>
    </li>
<?php 
} ?>
