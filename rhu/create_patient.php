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
				<div class="profile-usertitle-name"><?=$_SESSION['user']['username']?></div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>RHU Officer</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>
	
		<ul class="nav menu">

			<li class="parent "><a data-toggle="collapse" href="#sub-item-2">
				<em class="fa fa-navicon">&nbsp;</em> Outbreak Management <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-2">
					<li>
					<a class="" href="index.php">
						<span class="fa fa-arrow-right">&nbsp;</span> View Patients
					</a>
					</li>
					<li><a class="" href="create_patient.php">
						<span class="fa fa-arrow-right">&nbsp;</span> Create New Patient
					</a></li>
					<li><a class="" href="outbreaks.php">
						<span class="fa fa-arrow-right">&nbsp;</span> View Outbreaks
					</a></li>
					<li><a class="" href="create_outbreak.php">
						<span class="fa fa-arrow-right">&nbsp;</span> Create Outbreaks
					</a></li>
				</ul>
			</li>
			
			<li><a href="setting.php"><em class="fa fa-gear">&nbsp;</em> Settings</a></li>
			<li><a href="logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Welcome, <i><?=$_SESSION['user']['firstname']." ".$_SESSION['user']['lastname']?></i></h1>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						Add New Patient Record
						
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
						<form action="create_patient1.php" method="POST" id="frmCreatePatient">
							<div class="form-group col-md-6" id="divUsername">
								<label class="control-label" for="firstname" id="lblfirstname">First Name</label>
								<input type="text" class="form-control" id="firstname" name ="firstname" pholder="firstname" required="">
							</div>
							<div class="form-group col-md-6">
								<label class="control-label" for="lastname">Last Name</label>
								<input type="text" class="form-control" id="lastname" name ="lastname" pholder="lastname" req>
							</div>							
							<div class="form-group col-md-3">
								<label class="control-label" for="birthday">Birthday</label>
								<input type="date" class="form-control" id="birthday" name ="birthday" pholder="birthday" required="" >
							</div>
							<div class="form-group col-md-9">
								<label class="control-label" for="address">Home no.</label>
								<input type="text" id="address_number" name="address_number" class="form-control" required="">
							</div>
							<div class="form-group col-md-3">
								<label class="control-label" for="address">Street</label>
								<input type="text" id="address_street" name="address_street" class="form-control" required="">
							</div>
							<div class="form-group col-md-3">
								<label class="control-label" for="address">Zone</label>
								<input type="text" id="address_zone" name="address_zone" class="form-control" required="">
							</div>
							<div class="form-group col-md-3">
								<label class="control-label" for="address">Block</label>
								<input type="text" id="address_block" name="address_block" class="form-control" required="">
							</div>
							<div class="form-group col-md-6">
								<label class="control-label" for="contact">Contact # <i>(639191234567)</i></label>
								<input type="text" id="contact" name="contact" class="form-control" required="">
							</div>
							<div class="form-group col-md-3">
								<label class="control-label" for="gender">Gender</label>
								<select name="gender" id="gender" class="form-control" style="height:46px" required="">
									<option value="">------</option>
									<option value="Male">Male</option>
									<option value="Female">Female</option>
								</select>
							</div>								
							<div class="form-group col-md-3">
								<label class="control-label" for="baranggay">Baranggay</label>
								<select name="baranggay" id="baranggay" class="form-control" style="height:46px" required="">
									<option value="">------</option>
									<?php 
											$data = getBaranggayCollection();
											foreach($data as $key=>$value){
												?>
										<option value="<?=$value['id']?>"><?=html_entity_decode($value['name'])?></option>
												<?php
												
											}
									?>
								</select>
							</div>							
							
							<div class="clearfix"></div>
							<hr>
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
	<script src="../js/mask.js"></script>
	<script src="../js/bootstrap-inputmask.min.js"></script>
	<script src="../js/jquery-validate.js"></script>
	<script>

		$(function(){
			$('#contact').mask('639999999999');
	
		      $( "#frmCreatePatient" ).validate({
		          rules: {
		            contact: {
		              required: true,
		              maxlength: 12,
		              minlength: 12
		            }
		          }
		        });

		})
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