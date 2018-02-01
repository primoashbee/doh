<?php 
require "config.php";
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

if($username == "" || $password ==""){
	header('location:index.php');
}
$sql = "Select * from accounts where username ='$username'";
if(mysqli_num_rows($res = mysqli_query($conn,$sql))>0){
	$user = mysqli_fetch_assoc($res);
	if (strcmp($password, $user['password']) !== 0) {
    	$_SESSION['msg']='Username/Password is incorrect';	
		$_SESSION['old_user']=$username;
		header('location:index.php');
		exit;
	}
	$_SESSION['user'] =$user;
	
	if($user['isAdmin']){
		header('location:admin/index.php');
	}else{
		header('location:rhu/index.php');
	
	}
	exit;
}else{
	$_SESSION['msg']='Username/Password is incorrect';	
	$_SESSION['old_user']=$username;
	header('location:index.php');
	exit;
}
?>