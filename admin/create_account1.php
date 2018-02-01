<?php
	
	require "../config.php";
	require "../functions.php";
	session_start();
	$username = addslashes($_POST['username']);
	$password = addslashes($_POST['password']);
	$fname = addslashes($_POST['firstname']);
	$lname = addslashes($_POST['lastname']);
	$bday = addslashes($_POST['birthday']);
	$gender = addslashes($_POST['gender']);
	$sql = "Insert into accounts(username,`password`,isAdmin,firstname,lastname,birthday,gender)values('".$username."','".$password."','0','".$fname."','".$lname."','".$bday."','".$gender."')";
		if($flag = mysqli_query($conn,$sql)){
			$_SESSION['msg'] = "Account Successfully Created";
    		
    		
    		header('location:create_account.php');
		}
		echo 'Something went wrong';

?>