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
if($request=="baranggayListRanking"){
	$id = addslashes($_POST['disease_id']);
	$status = addslashes($_POST['status']);
	$sql ="SELECT b.`name`,COUNT(b.id) AS total FROM outbreak o LEFT JOIN patients p ON o.`patient_id` = p.id LEFT JOIN baranggays b ON p.`baranggay_id` = b.id WHERE disease_id ='$id' and status ='$status' GROUP BY b.id order by total DESC";
			
	echo json_encode(mysqli_fetch_all(mysqli_query($conn,$sql),MYSQLI_ASSOC));
	exit;
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
	$zone = addslashes($_POST['zone']);
	$block = addslashes($_POST['block']);
	$street = addslashes($_POST['street']);
	$contact = addslashes($_POST['contact']);
	$gender= addslashes($_POST['gender']);
	$baranggay = addslashes($_POST['baranggay']);
	$sql = "Update patients set firstname ='$fname', lastname ='$lname', birthday='$bday', address ='$address',contact='$contact', 
	gender ='$gender', baranggay_id='$baranggay',
	zone='$zone', block = '$block', street ='$street' where id ='$id'";
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
	$sql="Update diseases set isDeleted = true where id ='$id'";
	
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

	$sql="select * from diseases where id ='$id'";

	if($res = mysqli_query($conn,$sql)){
		$data =mysqli_fetch_assoc($res);
		echo json_encode(array('msg'=>200,'description'=>$data['description'],'info'=>$data));
	}else{
		echo json_encode(array('msg'=>404));
	}
	return false;
}
if($request=="updateDiseaseViaID"){
	$id = addslashes($_POST['id']);
	$name = addslashes($_POST['name']);
	$description = addslashes($_POST['description']);
	$green_level = addslashes($_POST['green_level']);
	$orange_level = addslashes($_POST['orange_level']);
	$red_level = addslashes($_POST['red_level']);
	$sql="Update diseases set disease_name = '$name', description = '$description', green_level = '$green_level', orange_level='$orange_level', red_level = '$red_level' where id ='$id'";
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