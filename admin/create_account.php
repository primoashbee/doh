<?php 
require "../config.php";
require "../functions.php";
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name">ADMIN</div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>Administrator</div>
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
					<li><a class="" href="create_accounts.php">
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
					<li><a class="" href="create_diseases.php">
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
			<li><a href="logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Welcome, Admin</h1>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						Create Account
						<a href="create_account.php"><button class="btn btn-success" style="float:right;">Create New Account</button></a>
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
						<form action="create_account1.php" method="POST" id="frmCreateAccount">
							<div class="form-group col-md-6" id="divUsername">
								<label class="control-label" for="username" id="lblUsername">Username</label>
								<input type="text" class="form-control" id="username" name ="username" placeholder="username" required="">
							</div>
							<div class="form-group col-md-6">
								<label class="control-label" for="firstname">Firstname</label>
								<input type="text" class="form-control" id="firstname" name ="firstname" placeholder="firstname" req>
							</div>							
							<div class="form-group col-md-6">
								<label class="control-label" for="lastname">Lastname</label>
								<input type="text" class="form-control" id="lastname" name ="lastname" placeholder="lastname" required="" >
							</div>
							<div class="form-group col-md-3">
								<label class="control-label" for="birthday">Birthday</label>
								<input type="date" id="birthday" name="birthday" class="form-control" required="">
							</div>
							<div class="form-group col-md-3">
								<label class="control-label" for="gender">Gender</label>
								<select name="gender" id="gender" class="form-control" style="height:46px" required="">
									<option value="">------</option>
									<option value="Male">Male</option>
									<option value="Female">Female</option>
								</select>
							</div>							
							
							<div class="clearfix"></div>
							<hr>
							<div class="form-group col-md-6 divPassword" >
								<label class="control-label" for="password" id="lblPassword">Password</label>
								<input type="password" class="form-control" id="password" name ="password" placeholder="Password required">
							</div>
							<div class="form-group col-md-6 divPassword">
								<label class="control-label" for="password_confirm">Password Confirm</label>
								<input type="password" class="form-control" id="password_confirm" name ="password_confirm" placeholder="Retype Password" required="">
							</div>
							<button type="submit" class="btn btn-success">Submit</button>
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
	
		$("#frmCreateAccount").submit(function(e){
			var errors = 0
			$.ajax({
					url:'../api.php',
					data:{request:'checkIfUsernameExists',username:$('#username').val()},
					type:'POST',
					success:function(data){
						console.log(data)
						if(data==200){
							console.log('existing')
							$("#divUsername").addClass('has-error')
							$("#lblUsername").html('Username (Username already existing)')
							errors++
						}else{
							console.log('pwede')
							$("#divUsername").removeClass('has-error')
							$("#lblUsername").html('Username')}
						
					}
				})
			
			if(!checkPasswordIfMatched($("#password").val(),$('#password_confirm').val())){
				$('#lblPassword').html('Password (Password must match)');
				$('.divPassword').addClass('has-error')
				errors++
			}else{
				$('#lblPassword').html('Password ');
				$('.divPassword').removeClass('has-error')
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
	</script>
		
</body>
</html>