<!DOCTYPE html>
<html lang="en">
  <head>
    <title>FoodvenoGrocery</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>

  <?php $this->load->view("header"); ?>
  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	  <div class="container">
		  <a class="navbar-brand" href="<?php echo base_url(); ?>index">FoodvenoGrocery</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
			  <span class="oi oi-menu"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="ftco-nav">
			  <ul class="navbar-nav ml-auto">
				  <?php  ?>
				  <li class="nav-item"><a href="<?php echo base_url(); ?>index" class="nav-link">Home</a></li>
				  <li class="nav-item"><a href="<?php echo base_url(); ?>about" class="nav-link">About</a></li>
				  <li class="nav-item active"><a href="<?php echo base_url(); ?>menu" class="nav-link">Menu</a></li>
				  <li class="nav-item"><a href="<?php echo base_url(); ?>contact" class="nav-link">Contact</a></li>
				  <!--<li class="nav-item cta"><a href="reservation.html" class="nav-link">Book a table</a></li>-->
			  </ul>
		  </div>
	  </div>
  </nav>

    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/grecery_banner1.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
          <div class="col-md-9 ftco-animate text-center mb-4">
            <h1 class="mb-2 bread">Specialties</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Menu <i class="ion-ios-arrow-forward"></i></span></p>
          </div>
        </div>
      </div>
    </section>


		<section class="ftco-section">
    	<div class="container">
        <div class="ftco-search">
					<div class="row">
            <div class="col-md-12 nav-link-wrap">
	            <div class="nav nav-pills d-flex text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">

					<?php if(!empty($all_categories))
					{
						$i=1;
						foreach ($all_categories as $category_row) {
						?>
							<a class="nav-link ftco-animate <?php if($i==1) echo 'active' ?>" style="font-size: 14px;" id="<?php echo $category_row->categoryId; ?>-tab" data-toggle="pill" href="#v-pills-<?php echo $category_row->categoryId; ?>" role="tab" aria-controls="<?php echo $category_row->categoryId; ?>" aria-selected="<?php if($i==1) {echo 'true'; } else { echo 'false'; } ?>"><?php echo $category_row->name; ?></a>

					<?php
							$i++;
					}}?>


	              <!--<a class="nav-link ftco-animate" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2" role="tab" aria-controls="v-pills-2" aria-selected="false">Lunch</a>

	              <a class="nav-link ftco-animate" id="v-pills-3-tab" data-toggle="pill" href="#v-pills-3" role="tab" aria-controls="v-pills-3" aria-selected="false">Dinner</a>

	              <a class="nav-link ftco-animate" id="v-pills-4-tab" data-toggle="pill" href="#v-pills-4" role="tab" aria-controls="v-pills-4" aria-selected="false">Drinks</a>

	              <a class="nav-link ftco-animate" id="v-pills-5-tab" data-toggle="pill" href="#v-pills-5" role="tab" aria-controls="v-pills-5" aria-selected="false">Desserts</a>

	              <a class="nav-link ftco-animate" id="v-pills-6-tab" data-toggle="pill" href="#v-pills-6" role="tab" aria-controls="v-pills-6" aria-selected="false">Wine</a>-->

	            </div>
	          </div>
	          <div class="col-md-12 tab-wrap">
	            
	            <div class="tab-content" id="v-pills-tabContent">


					<?php

					if(!empty($category_items))
					{
						$j = 1;
						foreach ($category_items as $main_row) {
							?>



							<div class="tab-pane fade <?php if($j==1) echo 'show active' ?>" id="v-pills-<?php echo $main_row[TAG_CATEGORY_ID]; ?>" role="tabpanel">
								<div class="row no-gutters d-flex align-items-stretch">
								<?php

								if(!empty($main_row[TAG_ALL_ITEMS])){


								foreach($main_row[TAG_ALL_ITEMS] as $row)
								{


								?>


									<div class="col-md-12 col-lg-6 d-flex align-self-stretch">
										<div class="menus d-sm-flex ftco-animate align-items-stretch">
											<div class="menu-img img" style="background-image: url(<?php echo $row->image; ?>); border:1px solid #e6e6e6;background-size: contain;"></div>
											<div class="text d-flex align-items-center">
												<div>
													<div class="d-flex">
														<div class="one-half">
															<h3><?php echo $row->name; ?></h3>
														</div>
														<div class="one-forth">
															<span class="price">&#8377;<?php echo $row->price; ?></span>
														</div>
													</div>
													<p style="width:100%"><span><?php if(!empty($row->description)) echo $row->description ?></span></p>
													<p><a href="#" class="btn btn-primary">Order now</a></p>
												</div>
											</div>
										</div>
									</div>

								<?php
								}}
								?>
							</div>
							</div>


					<?php
							$j++;
						}

					}

					?>

	            </div>
	          </div>
	        </div>
        </div>
    	</div>
    </section>

  <?php $this->load->view("footer"); ?>

  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.timepicker.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
    
  </body>
</html>