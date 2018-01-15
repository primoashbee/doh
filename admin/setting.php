<?php 
require "../config.php";
require "../functions.php";
if(isset($_SESSION['old_user'])){
unset($_SESSION['old_user']);
};
session_start();

if(checkIfLoggedIn()==false){
	header('location:../index.php');

}
$id = $_SESSION['user']['id'];
$sql="Select * from accounts where id ='$id'";
$me=mysqli_fetch_assoc(mysqli_query($conn,$sql));


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>DOH - Dashboard</title>
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/font-awesome.min.css" rel="stylesheet">
	<link href="../css/datepicker3.css" rel="stylesheet">
	<link href="../css/styles.css" rel="stylesheet">
	
	<!--Custom Font-->

	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	<style>
		.profile-pic {
		    border-radius: 50%;
		    height: 250px;
		    width: 250px;
		    background-size: cover;
		    background-position: center;
		    background-blend-mode: multiply;
		    vertical-align: middle;
		    text-align: center;
		    color: transparent;
		    transition: all .3s ease;
		    text-decoration: none;
		}

		.profile-pic:hover {
		    background-color: rgba(0,0,0,.5);
		    z-index: 10000;
		    color: #fff;
		    transition: all .3s ease;
		    text-decoration: none;
		}

		.profile-pic span {
		    display: inline-block;
		    padding-top: 4.5em;
		    padding-bottom: 4.5em;
		}
	</style>
</head>
<body>
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
				<a class="navbar-brand" href="#"><span><?php echo $app_name[0] ?></span>|<?php  echo $app_name[1] ?></a>
				
			</div>
		</div><!-- /.container-fluid -->
	</nav>
	<div id="" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="<?=$_SESSION['user']['img_url']."?".rand(0,100)?>" class="img-responsive" alt="">
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name">ADMIN</div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>ADMINISTRATOR</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>
	
		<ul class="nav menu">
			<li class="parent "><a data-toggle="collapse" href="#sub-item-1">
				<em class="fa fa-user">&nbsp;</em> Accounts <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li><a class="" href="index.php">
						<span class="fa fa-arrow-right">&nbsp;</span> View Accounts
					</a></li>
					<li><a class="" href="create_account.php">
						<span class="fa fa-arrow-right">&nbsp;</span> Create Accounts
					</a></li>
					
				</ul>
			</li>
			<li class="parent "><a data-toggle="collapse" href="#sub-item-2">
				<em class="fa fa-navicon">&nbsp;</em> Diseases <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-2">
					<li><a class="" href="diseases.php">
						<span class="fa fa-arrow-right">&nbsp;</span> View Diseases
					</a></li>
					<li><a class="" href="create_disease.php">
						<span class="fa fa-arrow-right">&nbsp;</span> Create Disease
					</a></li>
				</ul>
			</li>
			<li class="parent "><a data-toggle="collapse" href="#sub-item-2">
				<em class="fa fa-navicon">&nbsp;</em> Reports <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-2">
					<li><a class="" href="morbidity.php">
						<span class="fa fa-arrow-right">&nbsp;</span> Morbidity
						</a>
					</li>
				</ul>
			</li>
			<li><a href="setting.php"><em class="fa fa-gear">&nbsp;</em> Setting</a></li>
			<li><a href="logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Welcome, <i><?=$_SESSION['user']['firstname']?></i></h1>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						Update Information
						
					</div>
					
					<div class="panel-body">
						<?php
						if(isset($_SESSION['msg'])){
							
							?>
								<div class="alert alert-success fade in alert-dismissable" style="margin-top:18px;">
								    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
								    <strong>Success!</strong> <?=$_SESSION['msg'];?>
								</div>
							<?php
							unset($_SESSION['msg']);
						}
					?>
						<form action="setting1.php" method="POST" id="frmUpdateAccount" enctype="multipart/form-data">
							<div class="col-md-6 col-xs-12 col-lg-3" >

								<input type="file" accept="image/*" id="img_src" name="img_src" onchange="loadFile(event)" style="visibility: hidden">

								<center><img id="output" class="img img-circle" style="width: 250px;height: 250px;margin-top: -30px"/></center>
								 <br><br>
								 <div id="changeImage"><center><b></b></center>
								 </div>
								 <center><button type="button" 	id="btnUpload" class="btn btn-success"><span class="glyphicon glyphicon-camera"></span>
								  <span>Change Image</span></button></center>
							 	

								<script>
								  var loadFile = function(event) {
								    var output = document.getElementById('output');
								    output.src = URL.createObjectURL(event.target.files[0]);
								  };
								</script>
							</div>

							<div class="form-group col-md-5 col-lg-4" id="divUsername" >
								<label class="control-label" for="username" id="lblUsername">Username</label>
								<input type="text" class="form-control" id="username" name ="username" placeholder="username" required="" value="<?=$me['username'] ?>" readonly>
							</div>
								
							
							<div class="form-group col-md-5 col-lg-4 divPassword" >
								<label class="control-label" for="password" id="lblPassword">Password</label>
								<input type="password" class="form-control" id="password" name ="password" placeholder="Password required" >
							</div>
							<div class="form-group col-md-5 col-lg-4 divPassword">
								<label class="control-label" for="password_confirm">Password Confirm</label>
								<input type="password" class="form-control" id="password_confirm" name ="password_confirm" placeholder="Retype Password">
							</div>
							<button type="submit" class="btn btn-lg btn-success" style="margin-top:25px">Submit</button>
						</form>
					</div>
				</div>


			</div><!--/.row-->
		</div>
	</div>	<!--/.main-->
	
	<script src="../js/jquery-1.11.1.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/chart.min.js"></script>
	<script src="../js/chart-data.js"></script>
	<script src="../js/easypiechart.js"></script>
	<script src="../js/easypiechart-data.js"></script>
	<script src="../js/bootstrap-datepicker.js"></script>
	<script src="../js/custom.js"></script>
	<script>
	
		$("#frmUpdateAccount").submit(function(e){
			var errors =0
			if($('#password').val()!="" || $('#password_confirm').val()!=""){
				if(!checkPasswordIfMatched($("#password").val(),$('#password_confirm').val())){
					$('#lblPassword').html('Password (Password must match)');
					$('.divPassword').addClass('has-error')
					errors++
				}else{
					$('#lblPassword').html('Password ');
					$('.divPassword').removeClass('has-error')
				}
			}
			if(errors>0){
				e.preventDefault()
			}
		})

	
		function checkPasswordIfMatched(pass1,pass2){
			if(pass1==pass2){
				return true;
			}
				return false;
		}
		$("#btnUpload").click(function(){
			$('#img_src').click();
		})
		$(function(){
			$('#output').attr('src',"<?=$me['img_url']."?".rand(1,32000)?>")
  		});

	</script>
		
</body>
</html>