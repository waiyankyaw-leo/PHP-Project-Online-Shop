<?php
	require "db_connect.php"; 
	$name=$_POST['name'];
	$photo=$_FILES['photo'];

	$basepath="photo/brand/";
	$fullpath=$basepath.$photo['name']; //photo/brand/photoname.jpg
	move_uploaded_file($photo['tmp_name'], $fullpath);

	$sql= "INSERT INTO brands (name,photo) VALUES (:value1,:value2)";
	$stmp=$conn->prepare($sql);
	$stmp->bindParam(':value1',$name);
	$stmp->bindParam(':value2',$fullpath);

	$stmp->execute();

	header('location:brand_list.php');
?>