<?php
	
	require "../config.php";
	require "../functions.php";
	session_start();
	$disease = addslashes($_POST['disease']);
	$description = addslashes($_POST['description']);
	
	$sql = "Insert into diseases(disease_name,description)values('".$disease."','".$description."')";
		if($flag = mysqli_query($conn,$sql)){
			$_SESSION['msg'] = "Disease Successfully Created";
    		
    		
    		header('location:create_disease.php');
		}
		echo $sql;
		echo 'Something went wrong';

?>