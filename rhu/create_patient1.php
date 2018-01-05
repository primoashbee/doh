<?php
	
	require "../config.php";
	require "../functions.php";
	session_start();
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$birthday = $_POST['birthday'];
	$address = $_POST['address'];
	$contact = $_POST['contact'];
	$gender = $_POST['gender'];
	$baranggay = $_POST['baranggay'];
	$sql = "Insert into patients(firstname,lastname,birthday,address,contact,gender,baranggay_id,created_by)values('".$firstname."','".$lastname."','".$birthday."','".$address."','".$contact."','".$gender."','".$baranggay."','".$_SESSION['user']['id']."')";
		if($flag = mysqli_query($conn,$sql)){
		
			$_SESSION['msg'] = "Patient Successfully Created";
    		
    		
    		header('location:create_patient.php');
		}
		echo 'Something went wrong';

?>