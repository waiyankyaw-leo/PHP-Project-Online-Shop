<?php 
	//var_dump($_POST);
	require "db_connect.php"; 
	$id=$_POST["id"];
	$name=$_POST['name'];
	$newprofile=$_FILES['newprofile'];
	$oldprofile= $_POST['oldprofile'];
	$codeno= $_POST['code'];
	$price= $_POST['price'];
	$discount= $_POST['discount'];
	$description= $_POST['description'];
	$brandid= $_POST['brandid'];
	$subcategoryid= $_POST['subcategoryid'];
	//var_dump($id,$name,$newprofile,$oldprofile);
	
	if ($newprofile['size'] > 0) {
		$basepath="photo/category/";
		$fullpath=$basepath.$newprofile['name']; //photo/vote1.jpg
		echo "$fullpath";
		move_uploaded_file($newprofile['tmp_name'], $fullpath);
	}
	else{
		$fullpath = $oldprofile;
	}

	$sql= "UPDATE items SET name=:value1,photo=:value2,codeno=:value3,price=:value4,discount=:value5,description=:value6,brand_id=:value7,subcategory_id=:value8 WHERE id=:value9";
	$stmp=$conn->prepare($sql);
	$stmp->bindParam(':value1',$name);
	$stmp->bindParam(':value2',$fullpath);
	$stmp->bindParam(':value3',$codeno);
	$stmp->bindParam(':value4',$price);
	$stmp->bindParam(':value5',$discount);
	$stmp->bindParam(':value6',$description);
	$stmp->bindParam(':value7',$brandid);
	$stmp->bindParam(':value8',$subcategoryid);
	$stmp->bindParam(':value9',$id);
	$stmp->execute();

	header('location:item_list.php');

?>