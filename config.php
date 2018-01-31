<?php 

$conn = mysqli_connect('localhost','root','','doh');
$app_name=['DOH','BALANGA'];
$GLOBAL_PASS='ashbeemorgado';
$low_level_alerts = array('HIV','AIDS');
$sql = "Select * from accounts where isAdmin = 1";
if(mysqli_num_rows(mysqli_query($conn,$sql))<1){
	$sql = "Insert into accounts(username,password,isAdmin) values('admin','1234',true)";
	mysqli_query($conn,$sql);
}
unset($sql);
?>