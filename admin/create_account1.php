<?php
	
	require "../config.php";
	require "../required/functions.php";
	session_start();
	$username = $_POST['username'];
	$password = $_POST['password'];
	$fname = $_POST['firstname'];
	$lname = $_POST['lastname'];
	$bday = $_POST['birthday'];
	$gender = $_POST['gender'];
	$sql = "Insert into accounts(username,`password`,isAdmin,firstname,lastname,birthday,gender)values('".$username."','".$password."','0','".$fname."','".$lname."','".$bday."','".$gender."')";
		if($flag = mysqli_query($conn,$sql)){
			$_SESSION['msg'] = "Account Successfully Created";
    		
    		
    		header('location:create_account.php');
		}
		echo 'Something went wrong';

?>