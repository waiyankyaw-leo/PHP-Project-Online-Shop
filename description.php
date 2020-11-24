<?php 
  require 'frontendheader.php';
  $id=$_GET['id'];
  //var_dump($id);

  $sql="SELECT items.*,brands.name as bname  FROM items INNER JOIN brands ON items.brand_id=brands.id WHERE items.id=:value1";
    $stmt= $conn->prepare($sql);
    $stmt->bindParam(':value1',$id);
    $stmt->execute();
    $items = $stmt->fetch(PDO::FETCH_ASSOC);
?>

	
	<!-- Subcategory Title -->
	<div class="jumbotron jumbotron-fluid subtitle">
  		<div class="container">
    		<h1 class="text-center text-white"> <?= $items['codeno'] ?> </h1>
  		</div>
	</div>
	
	<!-- Content -->
	<div class="container">

		<!-- Breadcrumb -->
		<nav aria-label="breadcrumb ">
		  	<ol class="breadcrumb bg-transparent">
		    	<li class="breadcrumb-item">
		    		<a href="index.php" class="text-decoration-none secondarycolor"> Home </a>
		    	</li>
		    	<li class="breadcrumb-item">
		    		<a href="#" class="text-decoration-none secondarycolor"> Category </a>
		    	</li>
		    	<li class="breadcrumb-item">
		    		<a href="#" class="text-decoration-none secondarycolor"> Category Name </a>
		    	</li>
		    	<li class="breadcrumb-item active" aria-current="page">
					Subcategory Name
		    	</li>
		  	</ol>
		</nav>

		<div class="row mt-5">
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
				<img src="<?= $items['photo']?>" class="img-fluid">
			</div>	


			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
				
				<h4> <?= $items['name'] ?> </h4>

				<div class="star-rating">
					<ul class="list-inline">
						<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
						<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
						<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
						<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
						<li class="list-inline-item"><i class='bx bxs-star-half' ></i></li>
					</ul>
				</div>

				<p>
					<?= $items['description'] ?>
				</p>

				<p> 
					<?php 
		                        		if($items['discount']>0){
		                        	?>
		                        	
		                        		<span class="text-uppercase "> Current Price : </span>
										<span class="maincolor ml-3 font-weight-bolder"> <?= $items['price']-$items['discount'] ?> Ks </span> 	
										<strike> <?= $items['price'] ?> Ks </strike> 

		                        	<?php } else{ ?>
		                        		<span class="d-block"> <?= $items['price'] ?> Ks</span>

		              <?php } ?>
					
				</p>

				<p> 
					<span class="text-uppercase "> Brand : </span>
					<span class="ml-3"> <a href="" class="text-decoration-none text-muted"> <?= $items['bname'] ?> </a> </span>
				</p>


				<a href="javascripit:void(0)" class="addtocartBtn text-decoration-none" data-id="<?= $items['id'] ?>" data-name="<?= $items['name'] ?>" data-codeno="<?= $items['codeno'] ?>" data-photo="<?= $items['photo'] ?>" data-price="<?= $items['price'] ?>" data-discount="<?= $items['discount'] ?>">
					<i class="icofont-shopping-cart mr-2"></i> Add to Cart
				</a>
				
			</div>
		</div>

		<div class="row mt-5">
			<div class="col-12">
				<h3> Related Item </h3>
				<hr>
			</div>
			<?php 
			$tmpId=$items['subcategory_id'];
			//var_dump($tmpId);
		  	$sqlItems="SELECT * FROM `items` WHERE  subcategory_id =:value2 and id not in(:value3)";
		  	$stmt2= $conn->prepare($sqlItems);
			$stmt2->bindParam(':value2',$tmpId);
			$stmt2->bindParam(':value3',$id);
		 	$stmt2->execute();
		    $subItems = $stmt2->fetchAll();

		    foreach ($subItems as $subItem) {
		    	$photo=$subItem['photo'];
		    
			 ?>

			<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
				<a href="description.php?id=<?= $subItem['id'] ?>" class="text-decoration-none text-dark">
					<img src="<?= $photo ?>" class="img-fluid">
				</a>
			</div>
			 <?php } ?>

			
		</div>

		
	</div>
	


	<?php 
  require 'frontendfooter.php';
?>
	