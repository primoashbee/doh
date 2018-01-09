<?php
session_start();
require "config.php";
require "functions.php";
$request = addslashes($_POST['request']);

if($request=="checkIfUsernameExists"){
	$username = addslashes($_POST['username']);
	echo checkIfUsernameExists($username);
	return checkIfUsernameExists($username);
}
if($request=="deleteAccountViaID"){
	$id = addslashes($_POST['id']);
	$sql="Update accounts set isDeleted = true where id ='$id'";

	if(mysqli_query($conn,$sql)){
	
		echo json_encode(array('msg'=>200));
	}else{
		echo json_encode(array('msg'=>404));
	}
	return false;
}
if($request=="checkIfDiseaseExists"){
	$name = addslashes($_POST['disease']);
	$sql="select * from  diseases where disease_name = '$name'";
	if(mysqli_num_rows(mysqli_query($conn,$sql))>0){
		//existing
		echo json_encode(array('msg'=>404));
	}else{
		echo json_encode(array('msg'=>200));
	}
		return false;
}
if($request=="updatePatientViaID"){
	require "config.php";
	$id = addslashes($_POST['id']);
	$fname= addslashes($_POST['fname']);
	$lname= addslashes($_POST['lname']);
	$bday = addslashes($_POST['bday']);
	$address = addslashes($_POST['address']);
	$contact = addslashes($_POST['contact']);
	$gender= addslashes($_POST['gender']);
	$baranggay = $_POST['baranggay'];
	$sql = "Update patients set firstname ='$fname', lastname ='$lname', birthday='$bday', address ='$address',contact='$contact', 
	gender ='$gender', baranggay_id='$baranggay' where id ='$id'";
	if(mysqli_query($conn,$sql)){
		
		echo json_encode(array('msg'=>200));
		return false;
	}
	return false;
}
if($request=="deletePatientViaID"){
	$id = addslashes($_POST['id']);
	$sql="Update patients set isDeleted = true where id ='$id'";

	if(mysqli_query($conn,$sql)){
	
		echo json_encode(array('msg'=>200));
	}else{
		echo json_encode(array('msg'=>404));
	}
	return false;
}
if($request=="deleteDiseaseViaID"){
	$id = addslashes($_POST['id']);
	$sql="Update diseaes set isDeleted = true where id ='$id'";

	if(mysqli_query($conn,$sql)){
	
		echo json_encode(array('msg'=>200));
	}else{
		echo json_encode(array('msg'=>404));
	}
	return false;
}
if($request =="updateAccountViaID"){
	$id = addslashes($_POST['id']);
	$firstname = addslashes($_POST['firstname']);
	$lastname = addslashes($_POST['lastname']);
	$gender = addslashes($_POST['gender']);
	$birthday = addslashes($_POST['birthday']);
	$sql="Update accounts set firstname = '$firstname', lastname = '$lastname', gender = '$gender', birthday='$birthday' where id ='$id'";
	if(mysqli_query($conn,$sql)){
		
		echo json_encode(array('msg'=>200));
	}else{
		echo json_encode(array('msg'=>404));
	}
	return false;
}

if($request=="getDiseaseViaID"){
	$id = addslashes($_POST['id']);

	$sql="select description from diseases where id ='$id'";

	if($res = mysqli_query($conn,$sql)){
		$data =mysqli_fetch_assoc($res);
		echo json_encode(array('msg'=>200,'description'=>$data['description']));
	}else{
		echo json_encode(array('msg'=>404));
	}
	return false;
}
if($request=="updateDiseaseViaID"){
	$id = addslashes($_POST['id']);
	$name = addslashes($_POST['name']);
	$description = addslashes($_POST['description']);
	$sql="Update diseases set disease_name = '$name', description = '$description' where id ='$id'";
	if(mysqli_query($conn,$sql)){
		
		echo json_encode(array('msg'=>200));
	}else{
		echo json_encode(array('msg'=>404));
	}
	return false;
}
if($request=="insertOutbreak"){
	$patient_id = $_POST['patient_id'];
	$disease_id = $_POST['disease_id'];
	$status = $_POST['status'];
	$user_id = $_SESSION['user']['id'];
	$lattitude = $_POST['lat'];
	$longitude = $_POST['long'];
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
		return 404;
}
echo 404;
?>