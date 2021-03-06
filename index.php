<?php 
require "functions.php";
session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>DOH - Login</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body style="background-image: url('bg.jpg')" >

	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4" >
			<div class="login-panel panel panel-default" style="opacity: 0.9; border-radius: 25px" >
				
				<div class="panel-body" >
					<center><h1>DOH - BATAAN</h1></center>
					<center><img src="images/balanga.png" class = "img img-responsive" width="50%"></center>
					<center><p class ="lead center" style="font-size:1.5em;font-weight: 900">Log in</p></center>
					<?php if(isset($_SESSION['msg'])){
						?>
					<div class="alert alert-danger">
					  <strong>Alert!</strong> <?php echo $_SESSION['msg'];?>
					</div>
					<?php 

					}
					unset($_SESSION['msg']);
					?>
					<form action="signin.php" method="POST" role="form">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Username" name="username" type="username" value ="<?=oldUsername()?>" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" type="password" value="">
							</div>
							
							<button type="submit" class="btn btn-success" style="width:100%">Login</button>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	

<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
