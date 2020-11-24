<?php 
	//var_dump($_POST);
	require "db_connect.php"; 
	$id=$_POST["id"];
	$name=$_POST['name'];
	$newprofile=$_FILES['newprofile'];
	$oldprofile= $_POST['oldprofile'];

	//var_dump($id,$name,$newprofile,$oldprofile);
	
	if ($newprofile['size'] > 0) {
		$basepath="photo/brand/";
		$fullpath=$basepath.$newprofile['name']; //photo/vote1.jpg
		echo "$fullpath";
		move_uploaded_file($newprofile['tmp_name'], $fullpath);
	}
	else{
		$fullpath = $oldprofile;
	}

	$sql= "UPDATE brands SET name=:value1,photo=:value2 WHERE id=:value3";
	$stmp=$conn->prepare($sql);
	$stmp->bindParam(':value1',$name);
	$stmp->bindParam(':value2',$fullpath);
	$stmp->bindParam(':value3',$id);
	$stmp->execute();

	header('location:brand_list.php');

?>