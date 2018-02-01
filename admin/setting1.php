<?php
	
	require "../config.php";
	require "../functions.php";
	session_start();
	$password = addslashes($_POST['password']);
	$id = $_SESSION['user']['id'];
	if(!file_exists($_FILES['img_src']['tmp_name']) || !is_uploaded_file($_FILES['img_src']['tmp_name'])) {
		if($password ==""){

			header('location:setting.php');
		}else{
		$sql ="Update accounts set 
		password ='$password' where id ='$id'";
		}
		if(mysqli_query($conn,$sql)){
				$_SESSION['msg'] = 'Account Succesffuly Upaded';
				$_SESSION['user'] = mysqli_fetch_assoc(mysqli_query($conn,$sql));
				
				header('location:setting.php');
			}
	}else{
	$target_dir = "../images/avatar/";
	$target_file = $target_dir . basename($id.'.jpg');
	
	    $check = getimagesize($_FILES["img_src"]["tmp_name"]);
	    if($check !== false) {
		  
			$info = pathinfo($_FILES['img_src']['name']);
			$ext = $info['extension']; // get the extension of the file
			$newname = $id.".".$ext; 

			$target = '../images/avatar/'.$newname;
			if($password ==""){

				$sql ="Update accounts set 
				 img_url='$target' where id ='$id'";
			}else{
				$sql ="Update accounts set 
				password ='$password', img_url='$target' where id ='$id'";
			}

			if(mysqli_query($conn,$sql)){
				move_uploaded_file( $_FILES['img_src']['tmp_name'], $target);
				$_SESSION['msg'] = 'Account Succesffuly Upaded';
				$sql="Select * from accounts where id ='$id'";
				$_SESSION['user'] = mysqli_fetch_assoc(mysqli_query($conn,$sql));

				header('location:setting.php');
			}
	    } else {
	    	echo 'File not an Image';

	    }
	 }
	 echo $sql;
	

?>