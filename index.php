<?php 
	require 'frontendheader.php';
	require 'db_connect.php ';
	$sql = "SELECT * FROM categories ORDER BY name LIMIT 8 ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $categories = $stmt->fetchAll();

    $sqlDis="SELECT * FROM items WHERE discount > 0 limit 8";
    $stmt3 = $conn->prepare($sqlDis);
    $stmt3->execute();
    $dis_items = $stmt3->fetchAll();

    $sqlFresh="SELECT * FROM items ORDER BY created_at DESC limit 8";
    $stmtFresh = $conn->prepare($sqlFresh);
    $stmtFresh->execute();
    $fresh_items = $stmtFresh->fetchAll();

?>
	<!-- Carousel -->
	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  		<ol class="carousel-indicators">
    		<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    		<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    		<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  		</ol>
  		
  		<div class="carousel-inner">
    		<div class="carousel-item active">
		      	<img src="frontend/image/banner/ac.jpg" class="d-block w-100 bannerImg" alt="...">
		    </div>
		    <div class="carousel-item">
		      	<img src="frontend/image/banner/giordano.jpg" class="d-block w-100 bannerImg" alt="...">
		    </div>
		    <div class="carousel-item">
		      	<img src="frontend/image/banner/garnier.jpg" class="d-block w-100 bannerImg" alt="...">
		    </div>
  		</div>
	</div>


	<!-- Content -->
	<div class="container mt-5 px-5">
		<!-- Category -->
		<div class="row">

			<?php 
				foreach ($categories as $category) {
				
				$cid = $category['id'];
				$cname = $category['name'];
				$clogo = $category['logo'];

			?>

			<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12 ">
				<div class="card categoryCard border-0 shadow-sm p-3 mb-5 rounded text-center">
				  	<img src="<?= $clogo ?>" class="card-img-top" alt="..." style="width: 100%; height: 150px;">
				  	<div class="card-body">
				    	<p class="card-text font-weight-bold text-truncate"> <?= $cname; ?> </p>
				  	</div>
				</div>
			</div>

			<?php 
				}
			?>

		</div>

		<div class="whitespace d-xl-block d-lg-block d-md-none d-sm-none d-none"></div>
		
		<!-- Discount Item -->
		<div class="row mt-5">
			<h1> Discount Item </h1>
		</div>

	    <!-- Disocunt Item -->
		<div class="row">
			<div class="col-12">
				<div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="1000">
		            <div class="MultiCarousel-inner">
		            	<?php
						    foreach ($dis_items as $item) {
							$di_id = $item['id'];
							$di_name = $item['name'];
							$di_photo = $item['photo'];
							$di_price=$item['price'];
							$di_discount=$item['discount'];
							$di_codeno=$item['codeno'];
		            	  ?>
		                <div class="item">
		                    <div class="pad15">
		                    	<a href="description.php?id=<?= $di_id ?>" class="text-decoration-none text-dark"><img src="<?= $di_photo; ?>" class="img-fluid" >
		                        <p class="text-truncate"><?= $di_name ?></p></a>
		                        <p class="item-price">
		                        <?php
		                        	if ($di_discount< 1 ) {
                                        $oldprice=null;
                                    }
                            	else{
                                        $oldprice=$di_price;
                                        echo "<strike>".$oldprice."MMK </strike>";
                                    } 
                                    ?>
		                        	<span class="d-block"><?= $di_price-$di_discount?>MMK</span>
		                        </p>

		                        <div class="star-rating">
									<ul class="list-inline">
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star-half' ></i></li>
									</ul>
								</div>

								<a href="javascripit:void(0)" class="addtocartBtn text-decoration-none" data-id="<?= $di_id ?>" data-name="<?= $di_name ?>" data-codeno="<?= $di_codeno ?>" data-photo="<?= $di_photo ?>" data-price="<?= $di_price ?>" data-discount="<?= $di_discount ?>"> Add to Cart</a>

		                    </div>
		                </div>
		            <?php } ?>
		                
		                
		            </div>
		            <button class="btn btnMain leftLst"><</button>
		            <button class="btn btnMain rightLst">></button>
		        </div>
		    </div>
		</div>

		<!-- Flash Sale Item -->
		<div class="row mt-5">
			<h1> Flash Sale </h1>
		</div>

	    <!-- Flash Sale Item -->
		<div class="row">
			<div class="col-12">
				<div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="1000">
		            <div class="MultiCarousel-inner">
		            	<?php
						    foreach ($fresh_items as $item) {
				
							$hi_id = $item['id'];
							$hi_name = $item['name'];
							$hi_photo = $item['photo'];
							$hi_price=$item['price'];
							$hi_discount=$item['discount'];
							$hi_codeno=$item['codeno'];
							
		            	  ?>
		                <div class="item">
		                    <div class="pad15">
		                    	<a href="description.php?id=<?= $hi_id ?>" class="text-decoration-none text-dark">
		                    	<img src="<?= $hi_photo; ?>" class="img-fluid">
		                        <p class="text-truncate"><?= $hi_name ?></p></a>
		                        <p class="item-price">
		                        <?php
		                        	if ($hi_discount< 1 ) {
                                        $oldprice=null;
                                    }
                            	else{
                                        $oldprice=$hi_price;
                                        echo "<strike>".$oldprice."MMK </strike>";
                                    } 
                                    ?>
		                        	<span class="d-block"><?= $hi_price-$hi_discount?>MMK</span>
		                        </p>

		                        <div class="star-rating">
									<ul class="list-inline">
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star-half' ></i></li>
									</ul>
								</div>

								<a href="javascripit:void(0)" class="addtocartBtn text-decoration-none" data-id="<?= $hi_id ?>" data-name="<?= $hi_name ?>" data-codeno="<?= $hi_codeno ?>" data-photo="<?= $hi_photo ?>" data-price="<?= $hi_price ?>" data-discount="<?= $hi_discount ?>">Add to Cart</a>

		                    </div>
		                </div>
		            <?php } ?>
		                
		                
		            </div>
		            <button class="btn btnMain leftLst"><</button>
		            <button class="btn btnMain rightLst">></button>
		        </div>
		    </div>
		</div>

		<!-- Random Catgory ~ Item -->
		<div class="row mt-5">
			<h1> Fresh Picks </h1>
		</div>

	    <!-- Random Item -->
		<div class="row">
			<div class="col-12">
				<div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="1000">
		            <div class="MultiCarousel-inner">
		            	<?php
		            		$sqlItem = "SELECT * FROM items ORDER BY name  ";
						    $stmt = $conn->prepare($sqlItem);
						    $stmt->execute();
						    $items = $stmt->fetchAll();

						    foreach ($items as $item) {
				
							$id = $item['id'];
							$name = $item['name'];
							$photo = $item['photo'];
							$price=$item['price'];
							$discount=$item['discount'];
							$codeno=$item['codeno'];
							
		            	  ?>
		                <div class="item">
		                    <div class="pad15">
		                    	<a href="description.php?id=<?= $id ?>" class="text-decoration-none text-dark">
		                    	<img src="<?= $photo; ?>" class="img-fluid">
		                        <p class="text-truncate"><?= $name ?></p>
		                    	</a>
		                        <p class="item-price">
		                        <?php
		                        	if ($discount< 1 ) {
                                        $oldprice=null;
                                    }
                            	else{
                                        $oldprice=$price;
                                        echo "<strike>".$oldprice."MMK </strike>";
                                    } 
                                    ?>
		                        	<span class="d-block"><?= $price-$discount?>MMK</span>
		                        </p>

		                        <div class="star-rating">
									<ul class="list-inline">
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star-half' ></i></li>
									</ul>
								</div>

								<a href="javascripit:void(0)" class="addtocartBtn text-decoration-none" data-id="<?= $id ?>" data-name="<?= $name ?>" data-codeno="<?= $codeno ?>" data-photo="<?= $photo ?>" data-price="<?= $price ?>" data-discount="<?= $discount ?>">Add to Cart</a>

		                    </div>
		                </div>
		            <?php } ?>
		                
		                
		            </div>
		            <button class="btn btnMain leftLst"><</button>
		            <button class="btn btnMain rightLst">></button>
		        </div>
		    </div>
		</div>

		
		<div class="whitespace d-xl-block d-lg-block d-md-none d-sm-none d-none"></div>

	    <!-- Brand Store -->
	    <div class="row mt-5">
			<h1> Top Brand Stores </h1>
	    </div>

	    <!-- Brand Store Item -->
	    <section class="customer-logos slider mt-5">
	    <?php 
	    	$sql1 = "SELECT * FROM brands ORDER BY name  ";
			$stmt1 = $conn->prepare($sql1);
			$stmt1->execute();
			$brands = $stmt1->fetchAll();

			foreach ($brands as $brand) {
			$brandPhoto = $brand['photo'];				
	     ?>

	      	<div class="slide">
	      		<a href="">
		      		<img src="<?= $brandPhoto; ?>" class="img-fluid">
		      	</a>
	      	</div>
	      <?php } ?>	
	      	
	   	</section>

	    <div class="whitespace d-xl-block d-lg-block d-md-none d-sm-none d-none"></div>

	</div>

<?php 
	require 'frontendfooter.php';
?>