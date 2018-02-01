<?php
	
	require "../config.php";
	require "../functions.php";
	session_start();
	$firstname = addslashes($_POST['firstname']);
	$lastname = addslashes($_POST['lastname']);
	$birthday = addslashes($_POST['birthday']);
	$address = addslashes($_POST['address']);
	$contact = addslashes($_POST['contact']);
	$gender = addslashes($_POST['gender']);
	$baranggay = addslashes($_POST['baranggay']);
	$sql = "Insert into patients(firstname,lastname,birthday,address,contact,gender,baranggay_id,created_by)values('".$firstname."','".$lastname."','".$birthday."','".$address."','".$contact."','".$gender."','".$baranggay."','".$_SESSION['user']['id']."')";
		if($flag = mysqli_query($conn,$sql)){
		
			$_SESSION['msg'] = "Patient Successfully Created";
    		
    		
    		header('location:create_patient.php');
		}
		echo 'Something went wrong';

?>