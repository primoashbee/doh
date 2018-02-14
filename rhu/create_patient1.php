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
			

			$lat = addslashes($_POST['lat']);
			$long = addslashes($_POST['long']);
			$status = addslashes($_POST['status']);
			$disease_id = addslashes($_POST['disease_id']);
			$patient_id = mysqli_insert_id($conn);
			$user_id = $_SESSION['user']['id'];

			if(checkIfExistingOutbreak($patient_id,$disease_id)){
				echo json_encode(array('msg'=>404,'description'=>'Record Already Exists'));

			}else{		
				$sql = "Insert into outbreak(patient_id,disease_id,lattitude,longitude,created_by,status,`month`,`year`)values('$patient_id','$disease_id','$lattitude','$longitude','$user_id','$status',month(current_timestamp),year(current_timestamp))";
				if(mysqli_query($conn,$sql)){
					echo json_encode(array('msg'=>200,'description'=>'Record Added'));
				}else{
						echo json_encode(array('msg'=>404,'description'=>mysqli_error($conn)));
				}
			}
    		
    		header('location:create_patient.php');
		}
		echo 'Something went wrong';

?>