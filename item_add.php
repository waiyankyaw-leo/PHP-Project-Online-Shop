<?php
	require "db_connect.php"; 
	$name=$_POST['name'];
	$photo=$_FILES['photo'];
	$price=$_POST['price'];
	$discount=$_POST['discount'];
	$description=$_POST['description'];
	$brand=$_POST['brandid'];
	$subcategory=$_POST['subcategoryid'];
	$code=$_POST['code'];

	//var_dump($name,$photo,$price,$discount,$description,$brand,$subcategory);

	$basepath="photo/item/";
	$fullpath=$basepath.$photo['name']; //photo/category/photoname.jpg
	move_uploaded_file($photo['tmp_name'], $fullpath);

	$sql= "INSERT INTO items (name,photo,price,discount, description, 	brand_id, subcategory_id,codeno ) 
		VALUES 
		(:value1,:value2,:value3,:value4,:value5,:value6,:value7,:value8)";
	$stmp=$conn->prepare($sql);
	$stmp->bindParam(':value1',$name);
	$stmp->bindParam(':value2',$fullpath);
	$stmp->bindParam(':value3',$price);
	$stmp->bindParam(':value4',$discount);
	$stmp->bindParam(':value5',$description);
	$stmp->bindParam(':value6',$brand);
	$stmp->bindParam(':value7',$subcategory);
	$stmp->bindParam(':value8',$code);

	$stmp->execute();

	header('location:item_list.php');
?>