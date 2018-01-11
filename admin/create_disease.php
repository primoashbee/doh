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
			<li class="parent "><a data-toggle="collapse" href="#sub-item-3">
				<em class="fa fa-navicon">&nbsp;</em> Reports <span data-toggle="collapse" href="#sub-item-3" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-3">
					<li><a class="" href="morbidity.php">
						<span class="fa fa-arrow-right">&nbsp;</span> Morbidity
					</a></li>
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
						Create Disease
						<a href="create_disease.php"><button class="btn btn-success" style="float:right;">Create New Disease</button></a>
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
						<form action="create_disease1.php" method="POST" id="frmCreateDisease">
							<div class="form-group" id="divName">
								<label class="control-label" for="disease" id="lbldisease">Disease Name</label>
								<input type="text" class="form-control" id="disease" name ="disease" placeholder="Name" required="">
							</div>
							<div class="form-group" >

								<label class="control-label" for="description">Description</label>
								<textarea name="description" id="description" cols="30" rows="10" class="form-control" required="" placeholder="Type Description here..."></textarea>
								
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
	
		$("#frmCreateDisease").submit(function(e){
			var errors = 0
			$.ajax({
					url:'../api.php',
					data:{request:'checkIfDiseaseExists',disease:$('#disease').val()},
					type:'POST',
					success:function(data){
						
						if(data==200){
							$("#divName").addClass('has-error')
							$("#lbldisease").html('Disease Name (Disease already existing)')
							errors++
						}else{
						
							$("#divName").removeClass('has-error')
							$("#lbldisease").html('Disease Name')}
						
					}
				})
			
			if(errors>0){
				e.preventDefault()
			}

		})

	</script>
		
</body>
</html>