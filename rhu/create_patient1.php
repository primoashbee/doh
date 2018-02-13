<?php
	
	require "../config.php";
	require "../functions.php";
	session_start();
	$firstname = addslashes($_POST['firstname']);
	$lastname = addslashes($_POST['lastname']);
	$birthday = addslashes($_POST['birthday']);
	$number = addslashes($_POST['address_number']);
	$street = addslashes($_POST['address_street']);
	$zone = addslashes($_POST['address_zone']);
	$block = addslashes($_POST['address_block']);
	$contact = addslashes($_POST['contact']);
	$gender = addslashes($_POST['gender']);
	$baranggay = addslashes($_POST['baranggay']);
	$sql = "Insert into patients(firstname,lastname,birthday,address,street,zone,block,contact,gender,baranggay_id,created_by)values('".$firstname."','".$lastname."','".$birthday."','".$address."','".$street."','".$zone."','".$block."','".$contact."','".$gender."','".$baranggay."','".$_SESSION['user']['id']."')";
		if($flag = mysqli_query($conn,$sql)){
		
			$_SESSION['msg'] = "New Patients Record Added";
    		
    		
    		header('location:create_patient.php');
		}
		echo 'Something went wrong';

?>