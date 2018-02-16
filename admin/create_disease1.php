<?php
	
	require "../config.php";
	require "../functions.php";
	session_start();
	$disease = addslashes($_POST['disease']);
	$description = addslashes($_POST['description']);
	$red_level = addslashes($_POST['red_level']);
	$orange_level = addslashes($_POST['orange_level']);
	$green_level = addslashes($_POST['green_level']);
	
	$sql = "Insert into diseases(disease_name,description,green_level,orange_level,red_level)values('".$disease."','".$description."','$green_level','$orange_level','$red_level')";
		if($flag = mysqli_query($conn,$sql)){
			$_SESSION['msg'] = "Disease Successfully Created";
    		
    		
    		header('location:create_disease.php');
		}
		echo $sql;
		echo 'Something went wrong';

?>