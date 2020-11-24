<?php 
	//var_dump($_POST);
	require "db_connect.php"; 
	$id=$_POST["id"];
	$name=$_POST['name'];
	$categoryid=$_POST['categoryid'];

	var_dump($id,$name,$categoryid);
	$sql= "UPDATE subcategories SET name=:value1,category_id=:value2 WHERE id=:value3";
	$stmp=$conn->prepare($sql);
	$stmp->bindParam(':value1',$name);
	$stmp->bindParam(':value2',$categoryid);
	$stmp->bindParam(':value3',$id);
	$stmp->execute();

	header('location:subcategory_list.php');

?>