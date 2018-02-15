<?php 	
function random_color_part() {
    return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
}

function getAgeCountMorbidity(array $arr = array(),$gender){
	require 'config.php';
	
		if(isset($arr['status'])){
			unset($arr['status']);
		}
		$filter="";
		$rows = count($arr);
		$ctr=0;
		
		/*
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
		
		}*/

			
	$isRanged = false;
			if(isset($arr['month']) && isset($arr['month2'])){
					$isRanged = true;
			}


			if($rows>0){
				$filter = "where ";
				foreach($arr as $key=>$value){
					
						if($value!=""){
							if($isRanged){

								//if may ranged na params
									$ctr++;
									if($key=="month" || $key=="month2"){

									}else{
										if($ctr!=$rows){

											$filter.=$key.=" = '".$value."' and ";
										}else{
											$filter.=$key.=" = '".$value."' ";
										}
									}
							}else{

									$ctr++;
									if($ctr!=$rows){

										$filter.=$key.=" = '".$value."' and ";
									}else{
										$filter.=$key.=" = '".$value."' ";
									}
							}

						}
					
				}
			
			}


		$sql = "SELECT
	    SUM(IF(age < 1,1,0)) AS 'under_1',
	    SUM(IF(age BETWEEN 1 AND 4,1,0)) AS '1-4',
	    SUM(IF(age BETWEEN 5 AND 9,1,0)) AS '5-9',
	    SUM(IF(age BETWEEN 10 AND 14,1,0)) AS '10-14',
	    SUM(IF(age BETWEEN 15 AND 19,1,0)) AS '15-19',
	    SUM(IF(age BETWEEN 20 AND 24,1,0)) AS '20-24',
	    SUM(IF(age BETWEEN 25 AND 29,1,0)) AS '25-29',
	    SUM(IF(age BETWEEN 30 AND 34,1,0)) AS '30-34',    
	    SUM(IF(age BETWEEN 35 AND 39,1,0)) AS '35-39',
	    SUM(IF(age BETWEEN 40 AND 44,1,0)) AS '40-44',
	    SUM(IF(age BETWEEN 45 AND 49,1,0)) AS '45-49',
	    SUM(IF(age BETWEEN 50 AND 54,1,0)) AS '50-55',
	    SUM(IF(age BETWEEN 55 AND 59,1,0)) AS '55-59',
	    SUM(IF(age BETWEEN 60 AND 64,1,0)) AS '60-64',
	    SUM(IF(age>64,1,0)) AS 'over_65',
	    SUM(IF(age IS NULL, 1, 0)) AS 'NULL'
		FROM (SELECT o.*,TIMESTAMPDIFF(YEAR, p.`birthday`, CURDATE()) AS `age` FROM outbreak o inner JOIN patients p ON o.`patient_id` = p.`id` ".$filter." and p.gender = '$gender' and status ='morbidity' ";
	
			if($isRanged){
				$ctr--;
				$from = $arr['month'];
				$to = $arr['month2'];
				if($ctr>1){
						$sql = $sql. " and month between '$from' and '$to' order by created_at DESC  ) AS derived";
				}else{
						$sql = $sql. " month between '$from' and '$to' order by created_at DESC  ) AS derived";
				}
			}else{
				$sql = $sql.$filter. " order by created_at DESC ) AS derived";
			
			}	//Execute the query and put data into a result
		$res = mysqli_query($conn, $sql);
		$list = array();
		
		$columns = mysqli_field_count($conn)-1;
		$data = mysqli_fetch_array($res);
	       
	    for($ctr=0;$ctr<=$columns;$ctr++){
	    	if(is_null($data[$ctr])){
				array_push($list,0);
	    	}else{
	    	array_push($list,$data[$ctr]);
	    	}
	    }
		return $list;

}
function getAgeCountMortality(array $arr = array(),$gender){
		require 'config.php';
	
		if(isset($arr['status'])){
			unset($arr['status']);
		}
		$filter="";
		$rows = count($arr);
		$ctr=0;
		
		/*
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
		
		}*/

			
	$isRanged = false;
			if(isset($arr['month']) && isset($arr['month2'])){
					$isRanged = true;
			}


			if($rows>0){
				$filter = "where ";
				foreach($arr as $key=>$value){
					
						if($value!=""){
							if($isRanged){

								//if may ranged na params
									$ctr++;
									if($key=="month" || $key=="month2"){

									}else{
										if($ctr!=$rows){

											$filter.=$key.=" = '".$value."' and ";
										}else{
											$filter.=$key.=" = '".$value."' ";
										}
									}
							}else{

									$ctr++;
									if($ctr!=$rows){

										$filter.=$key.=" = '".$value."' and ";
									}else{
										$filter.=$key.=" = '".$value."' ";
									}
							}

						}
					
				}
			
			}


		$sql = "SELECT
	    SUM(IF(age < 1,1,0)) AS 'under_1',
	    SUM(IF(age BETWEEN 1 AND 4,1,0)) AS '1-4',
	    SUM(IF(age BETWEEN 5 AND 9,1,0)) AS '5-9',
	    SUM(IF(age BETWEEN 10 AND 14,1,0)) AS '10-14',
	    SUM(IF(age BETWEEN 15 AND 19,1,0)) AS '15-19',
	    SUM(IF(age BETWEEN 20 AND 24,1,0)) AS '20-24',
	    SUM(IF(age BETWEEN 25 AND 29,1,0)) AS '25-29',
	    SUM(IF(age BETWEEN 30 AND 34,1,0)) AS '30-34',    
	    SUM(IF(age BETWEEN 35 AND 39,1,0)) AS '35-39',
	    SUM(IF(age BETWEEN 40 AND 44,1,0)) AS '40-44',
	    SUM(IF(age BETWEEN 45 AND 49,1,0)) AS '45-49',
	    SUM(IF(age BETWEEN 50 AND 54,1,0)) AS '50-55',
	    SUM(IF(age BETWEEN 55 AND 59,1,0)) AS '55-59',
	    SUM(IF(age BETWEEN 60 AND 64,1,0)) AS '60-64',
	    SUM(IF(age>64,1,0)) AS 'over_65',
	    SUM(IF(age IS NULL, 1, 0)) AS 'NULL'
		FROM (SELECT o.*,TIMESTAMPDIFF(YEAR, p.`birthday`, CURDATE()) AS `age` FROM outbreak o inner JOIN patients p ON o.`patient_id` = p.`id` ".$filter." and p.gender = '$gender' and status ='mortality' ";
	
			if($isRanged){
				$ctr--;
				$from = $arr['month'];
				$to = $arr['month2'];
				if($ctr>1){
						$sql = $sql. " and month between '$from' and '$to' order by created_at DESC  ) AS derived";
				}else{
						$sql = $sql. " month between '$from' and '$to' order by created_at DESC  ) AS derived";
				}
			}else{
				$sql = $sql.$filter. " order by created_at DESC ) AS derived";
			
			}	//Execute the query and put data into a result
		$res = mysqli_query($conn, $sql);
		$list = array();
		
		$columns = mysqli_field_count($conn)-1;
		$data = mysqli_fetch_array($res);
	       
	    for($ctr=0;$ctr<=$columns;$ctr++){
	    	if(is_null($data[$ctr])){
				array_push($list,0);
	    	}else{
	    	array_push($list,$data[$ctr]);
	    	}
	    }
		return $list;
}
function generateColor() {
	$colors = ['#0000FF','#7bc636','#c52085'];
	//$index = rand(0,2);

	return $colors[0];
    return '#'.random_color_part() . random_color_part() . random_color_part();
}
function generateColor2() {
	$colors = ['#ffb6c1','#7bc636','#c52085'];
	//$index = rand(0,2);

	return $colors[0];
    return '#'.random_color_part() . random_color_part() . random_color_part();
}
function trClassViaID($disease_id, $status, $disease_name){
	require "config.php";
	$sql = "Select count(disease_id) as total_count from outbreak where status = '$status' and disease_id 
		='$disease_id' group by disease_id";
	$res = mysqli_fetch_all(mysqli_query($conn,$sql),MYSQLI_ASSOC);
	return alertLevel($disease_name,$res[0]['total_count']);
}
function alertLevel($name,$count){
	require "config.php";
	//check list of low level alerts via config
	$hasHit = 0;
	/*
	foreach ($low_level_alerts as $key => $value) {
		echo $value;
		//if passed name is inside the low level alert check the count the return class
		if (strpos($name, $value)) {
		 $hasHit++;
		}
		if (in_array($name, $))

	}*/
	if(in_array(strtoupper($name), $low_level_alerts)){
		$hasHit++;
	}

	if($hasHit>0){
		if($count > 2 && $count < 6){
		//3 - 5
			return 'orange-mo-bes';
		}elseif($count >5){
		//6 pataas
			return 'red-mo-bes';
		}elseif($count <2){
			return 'green-mo-bes';
		}
	}else{
		if($count > 24 && $count < 51){
			return 'orange-mo-bes';
		}elseif($count > 50){
			return 'red-mo-bes';
		}elseif($count < 25){
			return 'green-mo-bes';
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
	if(mysqli_num_rows($res)<1){
		
		$data = array();
		return $data=array();
	}
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
	$sql="Select * from diseases where isDeleted = false order by disease_name ASC";
	$res = mysqli_query($conn,$sql);
	
	return (mysqli_fetch_all($res,MYSQLI_ASSOC));
	/*if(mysqli_num_rows($res)==0){
		return $data==array();
	}
	while($row =mysqli_fetch_array($res)){
		$data[]=array('id'=>$row['id'],'name'=>$row['disease_name'],'description'=>$row['description'],'created_at'=>$row['created_at']);
		
	}
	return $data;
	*/
}

function getDiseaseViaID(){
	require "config.php";
	$sql="Select description from diseases where isDeleted = false";

	$res =	mysqli_fetch_assoc($res);
	$data=array('description'=>$row['description']);
	return $data;
}
function deleteDiseaseViaID($id){
	require "config.php";
	$sql="Update diseases set isDeleted = true where id= '$id'";
	mysqli_query($conn,$sql);
	return 200;
}
function getDiseaseViaIDNumber($id){
	require "config.php";
	$sql="Select * from diseases where id = '$id' and isDeleted = false";

	$result = mysqli_query($conn,$sql);
	
	return mysqli_fetch_all($result,MYSQLI_ASSOC);

}
function getPatientCollection($rhu_id =""){
	require "config.php";
	$sql="Select * from patients where created_by = '$rhu_id' and isDeleted = false";
	if($rhu_id==""){
		$sql="Select * from patients where isDeleted = false";
	}
	$res = mysqli_query($conn,$sql);
	$data;
	if(mysqli_num_rows($res)==0){
		
		return $data=array();
	}

	while($row =mysqli_fetch_array($res)){
		$data[]=array('id'=>$row['id'],'firstname'=>$row['firstname'],'lastname'=>$row['lastname'],'birthday'=>$row['birthday'],'address'=>$row['address'],'contact'=>$row['contact'],'created_at'=>$row['created_at'],'created_by'=>$row['created_by'],'age'=>computeAge($row['birthday']),'gender'=>$row['gender'],'baranggay'=>getBarangay($row['baranggay_id']),'baranggay_id'=>$row['baranggay_id'],'zone'=>$row['zone'],'street'=>$row['street'],'block'=>$row['block']);
		
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
function qryOutbreakPerBaranggay(array $arr=array(),$status){
	require "config.php";
	$sql ="SELECT COUNT(baranggay_id) AS total_count, baranggay_name FROM 
(SELECT p.id AS patient_id,b.`id` AS baranggay_id, b.`name` AS baranggay_name,o.id,p.firstname,p.lastname,p.birthday,p.address,p.contact,p.gender,d.id AS disease_id, d.disease_name,d.description,b.name, TIMESTAMPDIFF(YEAR, p.birthday,CURDATE()) AS age, o.status,o.`lattitude`,o.`longitude`,o.created_at FROM outbreak o LEFT JOIN patients p ON o.`patient_id` = p.`id` LEFT JOIN diseases d ON o.`disease_id` = d.`id` LEFT JOIN baranggays b ON p.`baranggay_id` = b.`id`  and status ='$status'";
	$filter="";
	$rows = count($arr);
	$ctr=0;

	$isRanged = false;
	if(isset($arr['month']) && isset($arr['month2'])){
			$isRanged = true;
	}


	if($rows>0){
		$filter = "where ";
		foreach($arr as $key=>$value){
			
				if($value!=""){
					if($isRanged){

						//if may ranged na params
							$ctr++;
							if($key=="month" || $key=="month2"){

							}else{
								if($ctr!=$rows){

									$filter.=$key.=" = '".$value."' and ";
								}else{
									$filter.=$key.=" = '".$value."' ";
								}
							}
					}else{

							$ctr++;
							if($ctr!=$rows){

								$filter.=$key.=" = '".$value."' and ";
							}else{
								$filter.=$key.=" = '".$value."' ";
							}
					}

				}
			
		}
	
	}


	if($isRanged){
		$ctr--;
		$from = $arr['month'];
		$to = $arr['month2'];
		if($ctr>1){
				$sql = $sql.$filter. " and month between '$from' and '$to' order by created_at DESC";
		}else{
				$sql = $sql.$filter. " month between '$from' and '$to' order by created_at DESC";
		}
	}else{
		$sql = $sql.$filter. " order by created_at DESC";
	
	}

	$sql = $sql.") ex GROUP BY baranggay_id";
		//Execute the query and put data into a result
	
	$result = mysqli_query($conn,$sql);

	
	return mysqli_fetch_all($result,MYSQLI_ASSOC);

}

function convertDateTime($datetime){
	$date = new DateTime($datetime);
	return $date->format('m/d/Y h:i:s a ');	
}
function qryOutbreak(array $arr=array()){
	require 'config.php';
	$sql = "SELECT p.id AS patient_id,o.status,o.id,p.firstname,p.lastname,p.birthday,p.address,p.contact,p.gender,b.name,d.id AS disease_id, d.disease_name,d.description,b.name, TIMESTAMPDIFF(YEAR, p.birthday,CURDATE()) AS age, o.status,o.`lattitude`,o.`longitude`,o.created_at FROM outbreak o LEFT JOIN patients p ON o.`patient_id` = p.`id` LEFT JOIN diseases d ON o.`disease_id` = d.`id` LEFT JOIN baranggays b ON p.`baranggay_id` = b.`id` ";
	$filter="";
	$rows = count($arr);
	$ctr=0;
	$isRanged = false;
	if(isset($arr['month']) && isset($arr['month2'])){
			$isRanged = true;
	}


	if($rows>0){
		$filter = "where ";
		foreach($arr as $key=>$value){
			
				if($value!=""){
					if($isRanged){

						//if may ranged na params
							$ctr++;
							if($key=="month" || $key=="month2"){

							}else{
								if($ctr!=$rows){

									$filter.=$key.=" = '".$value."' and ";
								}else{
									$filter.=$key.=" = '".$value."' ";
								}
							}
					}else{

							$ctr++;
							if($ctr!=$rows){

								$filter.=$key.=" = '".$value."' and ";
							}else{
								$filter.=$key.=" = '".$value."' ";
							}
					}

				}
			
		}
	
	}


	if($isRanged){
		$ctr--;
		$from = $arr['month'];
		$to = $arr['month2'];
		if($ctr>1){
				$sql = $sql.$filter. " and month between '$from' and '$to' order by created_at DESC";
		}else{
				$sql = $sql.$filter. " month between '$from' and '$to' order by created_at DESC";
		}
	}else{
		$sql = $sql.$filter. " order by created_at DESC";
	
	}	//Execute the query and put data into a result
	$result = mysqli_query($conn,$sql);
	
	return mysqli_fetch_all($result,MYSQLI_ASSOC);
}
function qryOutbreakRHU(array $arr=array(),$rhu_id=""){
	require 'config.php';
	if($rhu_id==""){
	$sql = "SELECT p.id AS patient_id,o.status,o.id,p.firstname,p.lastname,p.birthday,p.address,p.contact,p.gender,b.name,d.id AS disease_id, d.disease_name,d.description,b.name, TIMESTAMPDIFF(YEAR, p.birthday,CURDATE()) AS age, o.status,o.`lattitude`,o.`longitude`,o.created_at FROM outbreak o LEFT JOIN patients p ON o.`patient_id` = p.`id` LEFT JOIN diseases d ON o.`disease_id` = d.`id` LEFT JOIN baranggays b ON p.`baranggay_id` = b.`id` ";
		
	}else{
		$sql = "SELECT p.id AS patient_id,o.status,o.id,p.firstname,p.lastname,p.birthday,p.address,p.contact,p.gender,b.name,d.id AS disease_id, d.disease_name,d.description,b.name, TIMESTAMPDIFF(YEAR, p.birthday,CURDATE()) AS age, o.status,o.`lattitude`,o.`longitude`,o.created_at FROM outbreak o LEFT JOIN patients p ON o.`patient_id` = p.`id` LEFT JOIN diseases d ON o.`disease_id` = d.`id` LEFT JOIN baranggays b ON p.`baranggay_id` = b.`id` where o.`created_by` ='$rhu_id'";
	
	}

	$filter="";
	$rows = count($arr);
	$ctr=0;
	if($rows>0){
		$filter = "where ";
		foreach($arr as $key=>$value){
			if($key!="myTable_length"){

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
	
	}
	$sql = $sql.$filter. " order by created_at DESC";
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
	$isRanged = false;
	if(isset($arr['month']) && isset($arr['month2'])){
			$isRanged = true;
	}


	if($rows>0){
		$filter = " and ";
		foreach($arr as $key=>$value){
			
				if($value!=""){
					if($isRanged){

						//if may ranged na params
							$ctr++;
							if($key=="month" || $key=="month2"){

							}else{
								if($ctr!=$rows){

									$filter.=$key.=" = '".$value."' and ";
								}else{
									$filter.=$key.=" = '".$value."' ";
								}
							}
					}else{

							$ctr++;
							if($ctr!=$rows){

								$filter.=$key.=" = '".$value."' and ";
							}else{
								$filter.=$key.=" = '".$value."' ";
							}
					}

				}
			
		}
	
	}


	if($isRanged){
		$ctr--;
		$from = $arr['month'];
		$to = $arr['month2'];
		if($ctr>1){
				$sql = $sql.$filter. " and month between '$from' and '$to' ";
		}else{
				$sql = $sql.$filter. " month between '$from' and '$to' ";
		}
	}else{
		$sql = $sql.$filter. "";
	
	}	//Execute the query and put data into a result


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
	$isRanged = false;
	if(isset($arr['month']) && isset($arr['month2'])){
			$isRanged = true;
	}


	if($rows>0){
		$filter = " and ";
		foreach($arr as $key=>$value){
			
				if($value!=""){
					if($isRanged){

						//if may ranged na params
							$ctr++;
							if($key=="month" || $key=="month2"){

							}else{
								if($ctr!=$rows){

									$filter.=$key.=" = '".$value."' and ";
								}else{
									$filter.=$key.=" = '".$value."' ";
								}
							}
					}else{

							$ctr++;
							if($ctr!=$rows){

								$filter.=$key.=" = '".$value."' and ";
							}else{
								$filter.=$key.=" = '".$value."' ";
							}
					}

				}
			
		}
	
	}


	if($isRanged){
		$ctr--;
		$from = $arr['month'];
		$to = $arr['month2'];
		if($ctr>1){
				$sql = $sql.$filter. " and month between '$from' and '$to' ";
		}else{
				$sql = $sql.$filter. " month between '$from' and '$to' ";
		}
	}else{
		$sql = $sql.$filter. "";
	
	}	//Execute the query and put data into a result
		//Execute the query and put data into a result
	$result = mysqli_query($conn,$sql);

	return mysqli_fetch_all($result,MYSQLI_ASSOC);
}
function totalCountViaDiseaseID($id,$status){
	require "config.php";
	$sql = "Select * from outbreak where disease_id = '$id' and status = '$status'";
	return mysqli_num_rows(mysqli_query($conn,$sql));
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
$isRanged = false;
			if(isset($arr['month']) && isset($arr['month2'])){
					$isRanged = true;
			}


			if($rows>0){
				$filter = "where ";
				foreach($arr as $key=>$value){
					
						if($value!=""){
							if($isRanged){

								//if may ranged na params
									$ctr++;
									if($key=="month" || $key=="month2"){

									}else{
										if($ctr!=$rows){

											$filter.=$key.=" = '".$value."' and ";
										}else{
											$filter.=$key.=" = '".$value."' ";
										}
									}
							}else{

									$ctr++;
									if($ctr!=$rows){

										$filter.=$key.=" = '".$value."' and ";
									}else{
										$filter.=$key.=" = '".$value."' ";
									}
							}

						}
					
				}
			
			}
	$sql = $sql;
	
	$total_m = mysqli_num_rows(mysqli_query($conn,$sql));



		
	$sql ="select  * from (SELECT p.id AS patient_id,o.status,o.id,p.firstname,p.lastname,p.birthday,p.address,p.contact,p.gender,b.name,d.id AS disease_id, d.disease_name,d.description,p.baranggay_id as baranggay_id, TIMESTAMPDIFF(YEAR, p.birthday,CURDATE()) AS age,o.`lattitude`,o.`longitude`,o.created_at,o.month,o.year FROM outbreak o LEFT JOIN patients p ON o.`patient_id` = p.`id` LEFT JOIN diseases d ON o.`disease_id` = d.`id` LEFT JOIN baranggays b ON p.`baranggay_id` = b.`id` WHERE gender ='Female' and disease_id = '$id' and status='mortality') p where age between '$start' and '$end'";
	$rows = count($arr);
	$ctr=0;
$isRanged = false;
			if(isset($arr['month']) && isset($arr['month2'])){
					$isRanged = true;
			}


			if($rows>0){
				$filter = "where ";
				foreach($arr as $key=>$value){
					
						if($value!=""){
							if($isRanged){

								//if may ranged na params
									$ctr++;
									if($key=="month" || $key=="month2"){

									}else{
										if($ctr!=$rows){

											$filter.=$key.=" = '".$value."' and ";
										}else{
											$filter.=$key.=" = '".$value."' ";
										}
									}
							}else{

									$ctr++;
									if($ctr!=$rows){

										$filter.=$key.=" = '".$value."' and ";
									}else{
										$filter.=$key.=" = '".$value."' ";
									}
							}

						}
					
				}
			
			}
	$sql = $sql;
	
	

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
	$isRanged = false;
	if(isset($arr['month']) && isset($arr['month2'])){
			$isRanged = true;
	}


	if($rows>0){
		$filter = " and ";
		foreach($arr as $key=>$value){
			
				if($value!=""){
					if($isRanged){

						//if may ranged na params
							$ctr++;
							if($key=="month" || $key=="month2"){

							}else{
								if($ctr!=$rows){

									$filter.=$key.=" = '".$value."' and ";
								}else{
									$filter.=$key.=" = '".$value."' ";
								}
							}
					}else{

							$ctr++;
							if($ctr!=$rows){

								$filter.=$key.=" = '".$value."' and ";
							}else{
								$filter.=$key.=" = '".$value."' ";
							}
					}

				}
			
		}
	
	}


	if($isRanged){
		$ctr--;
		$from = $arr['month'];
		$to = $arr['month2'];
		if($ctr>1){
				$sql = $sql.$filter. " and month between '$from' and '$to' ";
		}else{
				$sql = $sql.$filter. " month between '$from' and '$to' ";
		}
	}else{
		$sql = $sql.$filter. "";
	
	}

	$sql = $sql.$filter;

	$total_m = mysqli_num_rows(mysqli_query($conn,$sql));




		
	$sql ="select  * from (SELECT p.id AS patient_id,o.status,o.id,p.firstname,p.lastname,p.birthday,p.address,p.contact,p.gender,b.name,d.id AS disease_id, d.disease_name,d.description,p.baranggay_id as baranggay_id, TIMESTAMPDIFF(YEAR, p.birthday,CURDATE()) AS age,o.`lattitude`,o.`longitude`,o.created_at,o.month,o.year FROM outbreak o LEFT JOIN patients p ON o.`patient_id` = p.`id` LEFT JOIN diseases d ON o.`disease_id` = d.`id` LEFT JOIN baranggays b ON p.`baranggay_id` = b.`id` WHERE gender ='Female' and disease_id = '$id' and status='morbidity') p where age between '$start' and '$end'";
	$rows = count($arr);
	$ctr=0;
	$isRanged = false;
	if(isset($arr['month']) && isset($arr['month2'])){
			$isRanged = true;
	}


	if($rows>0){
		$filter = " and ";
		foreach($arr as $key=>$value){
			
				if($value!=""){
					if($isRanged){

						//if may ranged na params
							$ctr++;
							if($key=="month" || $key=="month2"){

							}else{
								if($ctr!=$rows){

									$filter.=$key.=" = '".$value."' and ";
								}else{
									$filter.=$key.=" = '".$value."' ";
								}
							}
					}else{

							$ctr++;
							if($ctr!=$rows){

								$filter.=$key.=" = '".$value."' and ";
							}else{
								$filter.=$key.=" = '".$value."' ";
							}
					}

				}
			
		}
	
	}


	if($isRanged){
		$ctr--;
		$from = $arr['month'];
		$to = $arr['month2'];
		if($ctr>1){
				$sql = $sql.$filter. " and month between '$from' and '$to' ";
		}else{
				$sql = $sql.$filter. " month between '$from' and '$to' ";
		}
	}else{
		$sql = $sql.$filter. "";
	
	}
	

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

function rankings($status, string $year="asdasd"){
	require 'config.php';
	if($status=="morbidity"){
			$sql  = "SELECT *, FIND_IN_SET( total_count, (
					SELECT GROUP_CONCAT( total_count ORDER BY total_count DESC ) 
					FROM morbidity_scores )
			) AS rank
			FROM morbidity_scores ORDER BY rank ASC" ;
	}else{
			$sql  = "SELECT *, FIND_IN_SET( total_count, (
					SELECT GROUP_CONCAT( total_count ORDER BY total_count DESC ) 
					FROM mortality_scores )
			) AS rank
			FROM mortality_scores ORDER BY rank ASC" ;		
	}
	
	return mysqli_fetch_all(mysqli_query($conn,$sql),MYSQLI_ASSOC);


}
function setMorbidityRanking(){
	require "config.php";
	$sql = "AS SELECT 
		  disease_id,
		  d.`disease_name`,
		  IF(
		    COUNT(disease_id) > 0,
		    COUNT(disease_id),
		    0
		  ) AS total_count 
		FROM
		  outbreak o 
		  LEFT JOIN diseases d 
		    ON d.id = o.`disease_id` 
		    WHERE o.`status` ='morbidity'
		GROUP BY disease_id ";
	}

function setMortalityRanking(){
	require "config.php";
	$sql = "AS SELECT 
		  disease_id,
		  d.`disease_name`,
		  IF(
		    COUNT(disease_id) > 0,
		    COUNT(disease_id),
		    0
		  ) AS total_count 
		FROM
		  outbreak o 
		  LEFT JOIN diseases d 
		    ON d.id = o.`disease_id` 
		    WHERE o.`status` ='mortality'
		GROUP BY disease_id ";

}

function getBaranggayOutbreak(){
require "config.php";
$sql = "SELECT o.patient_id, o.disease_id,b.`id`,b.`name` FROM outbreak o LEFT JOIN patients p ON p.id = o.`patient_id` LEFT JOIN baranggays b ON p.`baranggay_id` = b.`id`";
return mysqli_fetch_all(mysqli_query($conn,$sql),MYSQLI_ASSOC);
}

function getMortalityGraphPerBaranggay(){
	require 'config.php';
	$sql ="SELECT COUNT(o.disease_id) AS total_count ,b.`id` AS baranggay_id,b.`name` FROM outbreak o LEFT JOIN patients p ON p.id = o.`patient_id` LEFT JOIN baranggays b ON p.`baranggay_id` = b.`id` GROUP BY baranggay_id";

	return mysqli_fetch_all(mysqli_query($conn,$sql),MYSQLI_ASSOC);


}
?>