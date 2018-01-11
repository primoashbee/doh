<?php 
class Account{
	public $username;
	public $password;
	public $isAdmin;
	public $fname;
	public $lname;
	public $conn;
	public $errorBag=[];
	public function __construct($account = array(),$conn){
		$this->username = $account['username'];
		$this->password = $account['password'];
		$this->fname = $account['firstname'];
		$this->lname = $account['lastname'];
		$this->isAdmin = 0;
		$this->conn = $conn;

	}
	public function createAccount(){
		$sql = "Insert into accounts(username,`password`,isAdmin,firstname,lastname)values('".$this->username."','".$this->password."','".$this->isAdmin."','".$this->fname."','".$this->lname."')";
		if($flag = mysqli_query($this->conn,$sql)){
			echo 'good';
			return $flag;
		}
	
	}

}
function getPopulation(){
	require "config.php";
	$sql="Select * from patients where isDeleted = false";
	$res = mysqli_query($conn,$sql);
	return mysqli_num_rows($res);
	
}
function getAccountsCollection(){
	require "config.php";
	$sql="Select * from accounts where isDeleted = false and isAdmin = false";
	$res = mysqli_query($conn,$sql);
	$data;
	while($row =mysqli_fetch_array($res)){
		$length = sizeof($row['password']);
		$password="";
		for($i=0;$i<=$length;$i++){
			$password.="*";
		}
		$data[] = array(
			'id'=>$row['id'],'username'=>$row['username'],'name'=>$row['firstname'].' '.$row['lastname'],
			'created_at'=>$row['created_at'],'updated_at'=>$row['updated_at'],'lname'=>$row['lastname'],'fname'=>$row['firstname'],'birthday'=>$row['birthday'],'gender'=>$row['gender']
		);
	}
	return $data;
}
function getDiseaseCollection(){
	require "config.php";
	$sql="Select * from diseases where isDeleted = false";
	$res = mysqli_query($conn,$sql);
	$data;
	while($row =mysqli_fetch_array($res)){
		$data[]=array('id'=>$row['id'],'name'=>$row['disease_name'],'description'=>$row['description'],'created_at'=>$row['created_at']);
		
	}
	return $data;
}
function getDiseaseViaID(){
	require "config.php";
	$sql="Select description from diseases where isDeleted = false";

	$res =	mysqli_fetch_assoc($res);
	$data=array('description'=>$row['description']);
	return $data;
}
function getDiseaseViaIDNumber($id){
	require "config.php";
	$sql="Select * from diseases where id = '$id' and isDeleted = false";

	$result = mysqli_query($conn,$sql);
	
	return mysqli_fetch_all($result,MYSQLI_ASSOC);

}
function getPatientCollection(){
	require "config.php";
	$sql="Select * from patients where isDeleted = false";
	$res = mysqli_query($conn,$sql);
	$data;
	if(mysqli_num_rows($res)==0){
		return $data[]=array();
	}
	while($row =mysqli_fetch_array($res)){
		$data[]=array('id'=>$row['id'],'firstname'=>$row['firstname'],'lastname'=>$row['lastname'],'birthday'=>$row['birthday'],'address'=>$row['address'],'contact'=>$row['contact'],'created_at'=>$row['created_at'],'created_by'=>$row['created_by'],'age'=>computeAge($row['birthday']),'gender'=>$row['gender'],'baranggay'=>getBarangay($row['baranggay_id']),'baranggay_id'=>$row['baranggay_id']);
		
	}
	return $data;
}
function getBaranggayCollection(){
	require "config.php";
	$sql="Select * from baranggays where isDeleted = false order by name  ASC";
	$res = mysqli_query($conn,$sql);
	$data;
	while($row =mysqli_fetch_array($res)){
		$data[]=array('id'=>$row['id'],'name'=>$row['name']);
		
	}
	return $data;
}

function checkIfUsernameExists($username){
	require "config.php";
	$sql="Select * from accounts where username = '$username'";
		$res = mysqli_query($conn,$sql);
	if(mysqli_num_rows($res)>0){

		return 200;
	}
	return 404;

}
function checkIfLoggedIn(){
	//session_start();
	if(isset($_SESSION['user'])){
		
		return true;
	}
		return false;
}

function ifLoggedIsAdmin(){
	//session_start();
	if($_SESSION['user']['isAdmin']==true){
		return true;
	}
	return false;
}
function oldUsername(){
	if(isset($_SESSION['old_user'])){
		return $_SESSION['old_user'];
	}
	return "";
}
function computeAge($birthday){
	
	return  date_diff(date_create($birthday), date_create('now'))->y;
}
function getBarangay($baranggay_id){
	require "config.php";
	$sql = "Select * from baranggays where id = '$baranggay_id'";
	$data = mysqli_fetch_assoc(mysqli_query($conn,$sql));
	return $data['name'];
}
function checkIfExistingOutbreak($p_id,$d_id){
	require "config.php";
	$sql = "Select * from outbreak where patient_id = '$p_id' and disease_id='$d_id' order by created_at DESC";
	if(mysqli_num_rows($res = mysqli_query($conn,$sql))>0){
		return true;
	}
	
	return false;
}
function qryOutbreak(array $arr=array()){
	require 'config.php';
	$sql = "SELECT p.id AS patient_id,o.status,o.id,p.firstname,p.lastname,p.birthday,p.address,p.contact,p.gender,b.name,d.id AS disease_id, d.disease_name,d.description,b.name, TIMESTAMPDIFF(YEAR, p.birthday,CURDATE()) AS age, o.status,o.`lattitude`,o.`longitude`,o.created_at FROM outbreak o LEFT JOIN patients p ON o.`patient_id` = p.`id` LEFT JOIN diseases d ON o.`disease_id` = d.`id` LEFT JOIN baranggays b ON p.`baranggay_id` = b.`id`";
	$filter="";
	$rows = count($arr);
	$ctr=0;
	if($rows>0){
		$filter = "where ";
		foreach($arr as $key=>$value){
			if($value!=""){

				$ctr++;
				if($ctr!=$rows){

					$filter.=$key.=" = '".$value."' and ";
				}else{
					$filter.=$key.=" = '".$value."' ";
				}

			}
		}
	
	}
	$sql = $sql.$filter;
		//Execute the query and put data into a result
	$result = mysqli_query($conn,$sql);
	
	return mysqli_fetch_all($result,MYSQLI_ASSOC);
}
function getMorbidityReport(array $arr=array()){
	require 'config.php';
	$sql = "SELECT p.id AS patient_id,o.status,o.id,p.firstname,p.lastname,p.birthday,p.address,p.contact,p.gender,b.name,d.id AS disease_id, d.disease_name,d.description,b.name, TIMESTAMPDIFF(YEAR, p.birthday,CURDATE()) AS age, o.status,o.`lattitude`,o.`longitude`,o.created_at FROM outbreak o LEFT JOIN patients p ON o.`patient_id` = p.`id` LEFT JOIN diseases d ON o.`disease_id` = d.`id` LEFT JOIN baranggays b ON p.`baranggay_id` = b.`id` where `status` ='morbidity' ";
	$filter="";
	$rows = count($arr);
	$ctr=0;
	if($rows>0){
		$filter = " and ";
		foreach($arr as $key=>$value){
			if($value!=""){

				$ctr++;
				if($ctr!=$rows){

					$filter.=$key.=" = '".$value."' and ";
				}else{
					$filter.=$key.=" = '".$value."' ";
				}

			}
		}
	
	}

	$sql = $sql.$filter;

	//Execute the query and put data into a result
	$result = mysqli_query($conn,$sql);
	
	return mysqli_fetch_all($result,MYSQLI_ASSOC);
}
function getMortalityReport(array $arr=array()){
	require 'config.php';
	$sql = "SELECT p.id AS patient_id,o.status,o.id,p.firstname,p.lastname,p.birthday,p.address,p.contact,p.gender,b.name,d.id AS disease_id, d.disease_name,d.description,b.name, TIMESTAMPDIFF(YEAR, p.birthday,CURDATE()) AS age, o.status,o.`lattitude`,o.`longitude`,o.created_at FROM outbreak o LEFT JOIN patients p ON o.`patient_id` = p.`id` LEFT JOIN diseases d ON o.`disease_id` = d.`id` LEFT JOIN baranggays b ON p.`baranggay_id` = b.`id` where `status` ='mortality'";
	$filter="";
	$rows = count($arr);
	$ctr=0;
	if($rows>0){

		$filter = " and ";
		foreach($arr as $key=>$value){
			if($value!=""){

				$ctr++;
				if($ctr!=$rows){

					$filter.=$key.=" = '".$value."' and ";
				}else{
					$filter.=$key.=" = '".$value."' ";
				}

			}
		}
	
	}

	$sql = $sql.$filter;
		//Execute the query and put data into a result
	$result = mysqli_query($conn,$sql);
	
	return mysqli_fetch_all($result,MYSQLI_ASSOC);
}

function getYears(){
	require "config.php";
	$sql = "SELECT DISTINCT(year) AS year FROM outbreak";
	$result = mysqli_query($conn,$sql);
	return mysqli_fetch_all($result,MYSQLI_ASSOC);

}
function antiNull($data){
	//var_dump($data);
	if(is_null($data) || isset($data)){
		return "";
	}
	return 'haha';
}
function getDiseaseIDS($outbreakResult){
	$disease_ids =array();
	foreach ($outbreakResult as $key => $value) {
		
		if(!in_array($value['disease_id'],$disease_ids)){
			array_push($disease_ids,$value['disease_id']);
		}
	}
	return $disease_ids;
}

function getCountOnAge($id,$start,$end,array $arr = array()){
	require "config.php";
	$data = array();
	
	$sql ="select  * from (SELECT p.id AS patient_id,o.status,o.id,p.firstname,p.lastname,p.birthday,p.address,p.contact,p.gender,b.name,d.id AS disease_id, d.disease_name,d.description, p.baranggay_id as baranggay_id,TIMESTAMPDIFF(YEAR, p.birthday,CURDATE()) AS age,o.`lattitude`,o.`longitude`,o.created_at,o.year FROM outbreak o LEFT JOIN patients p ON o.`patient_id` = p.`id` LEFT JOIN diseases d ON o.`disease_id` = d.`id` LEFT JOIN baranggays b ON p.`baranggay_id` = b.`id` WHERE gender ='Male' and disease_id = '$id' ) p where age between '$start' and '$end'";
	
		$filter="";
	$rows = count($arr);
	$ctr=0;
	if($rows>0){

		$filter = " and ";
		foreach($arr as $key=>$value){
			if($value!=""){

				$ctr++;
				if($ctr!=$rows){

					$filter.=$key.=" = '".$value."' and ";
				}else{
					$filter.=$key.=" = '".$value."' ";
				}

			}
		}
	
	}

	$sql = $sql.$filter;

	$total_m = mysqli_num_rows(mysqli_query($conn,$sql));




		
	$sql ="select  * from (SELECT p.id AS patient_id,o.status,o.id,p.firstname,p.lastname,p.birthday,p.address,p.contact,p.gender,b.name,d.id AS disease_id, d.disease_name,d.description,p.baranggay_id as baranggay_id, TIMESTAMPDIFF(YEAR, p.birthday,CURDATE()) AS age,o.`lattitude`,o.`longitude`,o.created_at,o.year FROM outbreak o LEFT JOIN patients p ON o.`patient_id` = p.`id` LEFT JOIN diseases d ON o.`disease_id` = d.`id` LEFT JOIN baranggays b ON p.`baranggay_id` = b.`id` WHERE gender ='Female' and disease_id = '$id' ) p where age between '$start' and '$end'";
	$rows = count($arr);
	$ctr=0;
	if($rows>0){

		$filter = " and ";
		foreach($arr as $key=>$value){
			if($value!=""){

				$ctr++;
				if($ctr!=$rows){

					$filter.=$key.=" = '".$value."' and ";
				}else{
					$filter.=$key.=" = '".$value."' ";
				}

			}
		}
	
	}

	$sql = $sql.$filter;
	

	$total_f = mysqli_num_rows(mysqli_query($conn,$sql));
	$data[]=array(
		'Female'=>$total_f,
		'Male'=>$total_m
	);

	return $data;

}
function getCountOnAgeMortality($id,$start,$end,array $arr = array()){
	require "config.php";
	$data = array();
	
	$sql ="select  * from (SELECT p.id AS patient_id,o.status,o.id,p.firstname,p.lastname,p.birthday,p.address,p.contact,p.gender,b.name,d.id AS disease_id, d.disease_name,d.description, p.baranggay_id as baranggay_id,TIMESTAMPDIFF(YEAR, p.birthday,CURDATE()) AS age,o.`lattitude`,o.`longitude`,o.created_at,o.month,o.year FROM outbreak o LEFT JOIN patients p ON o.`patient_id` = p.`id` LEFT JOIN diseases d ON o.`disease_id` = d.`id` LEFT JOIN baranggays b ON p.`baranggay_id` = b.`id` WHERE gender ='Male' and disease_id = '$id' and status='mortality') p where age between '$start' and '$end'";
	
		$filter="";
	$rows = count($arr);
	$ctr=0;
	if($rows>0){

		$filter = " and ";
		foreach($arr as $key=>$value){
			if($value!=""){

				$ctr++;
				if($key=="status"){

				}else{
					if($ctr!=$rows){

						$filter.=$key.=" = '".$value."' and ";
					}else{
						$filter.=$key.=" = '".$value."' ";
					}
				}
			}
		}
	
	}

	$sql = $sql.$filter;

	$total_m = mysqli_num_rows(mysqli_query($conn,$sql));



		
	$sql ="select  * from (SELECT p.id AS patient_id,o.status,o.id,p.firstname,p.lastname,p.birthday,p.address,p.contact,p.gender,b.name,d.id AS disease_id, d.disease_name,d.description,p.baranggay_id as baranggay_id, TIMESTAMPDIFF(YEAR, p.birthday,CURDATE()) AS age,o.`lattitude`,o.`longitude`,o.created_at,o.month,o.year FROM outbreak o LEFT JOIN patients p ON o.`patient_id` = p.`id` LEFT JOIN diseases d ON o.`disease_id` = d.`id` LEFT JOIN baranggays b ON p.`baranggay_id` = b.`id` WHERE gender ='Female' and disease_id = '$id' and status='mortality') p where age between '$start' and '$end'";
	$rows = count($arr);
	$ctr=0;
	if($rows>0){

			$filter = " and ";
			foreach($arr as $key=>$value){
				if($value!=""){

					$ctr++;
					if($key=="status"){

					}else{
						if($ctr!=$rows){

							$filter.=$key.=" = '".$value."' and ";
						}else{
							$filter.=$key.=" = '".$value."' ";
						}
					}
				}
			}
		
	}

	$sql = $sql.$filter;
	

	$total_f = mysqli_num_rows(mysqli_query($conn,$sql));
	$data[]=array(
		'Female'=>$total_f,
		'Male'=>$total_m
	);

	return $data;

}

function getCountOnAgeMorbidity($id,$start,$end,array $arr = array()){
	require "config.php";
	$data = array();
	
	$sql ="select  * from (SELECT p.id AS patient_id,o.status,o.id,p.firstname,p.lastname,p.birthday,p.address,p.contact,p.gender,b.name,d.id AS disease_id, d.disease_name,d.description, p.baranggay_id as baranggay_id,TIMESTAMPDIFF(YEAR, p.birthday,CURDATE()) AS age,o.`lattitude`,o.`longitude`,o.created_at,o.month, o.year FROM outbreak o LEFT JOIN patients p ON o.`patient_id` = p.`id` LEFT JOIN diseases d ON o.`disease_id` = d.`id` LEFT JOIN baranggays b ON p.`baranggay_id` = b.`id` WHERE gender ='Male' and disease_id = '$id' and status='morbidity') p where age between '$start' and '$end'";
	
		$filter="";
	$rows = count($arr);
	$ctr=0;
	if($rows>0){

		$filter = " and ";
		foreach($arr as $key=>$value){
			if($value!=""){

				$ctr++;
				if($key=="status"){

				}else{
					if($ctr!=$rows){

						$filter.=$key.=" = '".$value."' and ";
					}else{
						$filter.=$key.=" = '".$value."' ";
					}
				}
			}
		}
	
	}

	$sql = $sql.$filter;

	$total_m = mysqli_num_rows(mysqli_query($conn,$sql));




		
	$sql ="select  * from (SELECT p.id AS patient_id,o.status,o.id,p.firstname,p.lastname,p.birthday,p.address,p.contact,p.gender,b.name,d.id AS disease_id, d.disease_name,d.description,p.baranggay_id as baranggay_id, TIMESTAMPDIFF(YEAR, p.birthday,CURDATE()) AS age,o.`lattitude`,o.`longitude`,o.created_at,o.month,o.year FROM outbreak o LEFT JOIN patients p ON o.`patient_id` = p.`id` LEFT JOIN diseases d ON o.`disease_id` = d.`id` LEFT JOIN baranggays b ON p.`baranggay_id` = b.`id` WHERE gender ='Female' and disease_id = '$id' and status='morbidity') p where age between '$start' and '$end'";
	$rows = count($arr);
	$ctr=0;
	if($rows>0){

			$filter = " and ";
			foreach($arr as $key=>$value){
				if($value!=""){

					$ctr++;
					if($key=="status"){

					}else{
						if($ctr!=$rows){

							$filter.=$key.=" = '".$value."' and ";
						}else{
							$filter.=$key.=" = '".$value."' ";
						}
					}
				}
			}
		
	}

	$sql = $sql.$filter;
	

	$total_f = mysqli_num_rows(mysqli_query($conn,$sql));
	$data[]=array(
		'Female'=>$total_f,
		'Male'=>$total_m
	);

	return $data;

}
function summarizeAgeRangePerDisease($id){
	$data = array();
	//foreach ($ids as $key => $id) {
		$data[] = array('under'=>getCountOnAge($id,0,1));
		$data[] = array('under'=>getCountOnAge($id,1,4));
		$data[] = array('under'=>getCountOnAge($id,5,9));
		$data[] = array('under'=>getCountOnAge($id,10,14));
		$data[] = array('under'=>getCountOnAge($id,15,19));
		$data[] = array('under'=>getCountOnAge($id,20,24));
		$data[] = array('under'=>getCountOnAge($id,25,29));
		$data[] = array('under'=>getCountOnAge($id,30,34));
		$data[] = array('under'=>getCountOnAge($id,35,39));
		$data[] = array('under'=>getCountOnAge($id,40,44));
		$data[] = array('under'=>getCountOnAge($id,45,49));
		$data[] = array('under'=>getCountOnAge($id,50,54));
		$data[] = array('under'=>getCountOnAge($id,55,59));
		$data[] = array('under'=>getCountOnAge($id,60,64));
		$data[] = array('under'=>getCountOnAge($id,65,1000000));

	//}
	return $data;

}
function convertToMonthName($month){
	$monthNum  = $month;
	$dateObj   = DateTime::createFromFormat('!m', $monthNum);
	$monthName = $dateObj->format('F'); 

	return $monthName;
}
?>