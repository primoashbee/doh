<?php 
require "../config.php";
require "../functions.php";
if(isset($_SESSION['old_user'])){
unset($_SESSION['old_user']);
};
session_start();

if(checkIfLoggedIn()==false || ifLoggedIsAdmin()==false){
	header('location:../index.php');

}
getMortalityGraphPerBaranggay(getBaranggayOutbreak());


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
				<img src="<?=$_SESSION['user']['img_url']."?".rand(0,100)?>" class="img-responsive" alt="">
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
						<span class="fa fa-arrow-right">&nbsp;</span> Add Account
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
						<span class="fa fa-arrow-right">&nbsp;</span> Add Disease
					</a></li>
				</ul>
			</li>
			<li class="parent "><a data-toggle="collapse" href="#sub-item-3">
				<em class="fa fa-navicon">&nbsp;</em> Reports <span data-toggle="collapse" href="#sub-item-3" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-3">
					<li><a class="" href="morbidity.php">
						<span class="fa fa-arrow-right">&nbsp;</span> Reports
					</a>
				</ul>
			</li>

			<li><a href="setting.php"><em class="fa fa-gear">&nbsp;</em> Setting</a></li>
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
						Accounts
						<a href="create_account.php"><button class="btn btn-success" style="float:right;">Add Account</button></a>
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<th>Username</th>
								<th>Name</th>
								<th>Created At</th>
								<th>Actions</th>
							</thead>
							<?php 
								$data = getAccountsCollection();
								if($count = count($data) > 0){

									foreach($data as $key=>$value){
									?>
										<tr>
											<td><?=$value['username']?></td>
											<td><?=$value['name']?></td>
											<td><?=convertDateTime($value['created_at'])?></td>
											<td>
												<button class="btn btn-warning edit" id="<?=$value['id']?>" fname="<?=$value['fname']?>" lname="<?=$value['lname']?>" username="<?=$value['username']?>" birthday="<?=$value['birthday']?>" gender="<?=$value['gender']?>" > <span class="fa fa-pencil"></span> </button>
												<button class="btn btn-danger delete" id="<?=$value['id']?>" fname="<?=$value['fname']?>" lname="<?=$value['lname']?>" username="<?=$value['username']?>"> <span class="fa fa-trash-o"></span> </button>

											</td>
										</tr>

									<?php
									}
								}
							?>	

						</table>
					</div>
				</div>
			</div>
		</div><!--/.row-->
		
	</div>	<!--/.main-->
	<!-- Modal -->
	<form action ="<?=$_SERVER['PHPSELF']?>" method="POST" id="frmUpdateAccount">

	  <div class="modal fade" id="myModal" role="dialog">
	    <div class="modal-dialog modal-lg">
	    
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Edit Account</h4>
	        </div>
	        <div class="modal-body">
 				 <div class="form-group col-md-6" id="divUsername">
 				 	<input type="hidden" id="update_account_id">
					<label class="control-label" for="username" id="lblUsername">Username</label>
					<input type="text" class="form-control" id="username" name ="username" placeholder="username" required="" readonly="">
				</div>
				<div class="form-group col-md-6">
					<label class="control-label" for="firstname">Firstname</label>
					<input type="text" class="form-control" id="firstname" name ="firstname" placeholder="firstname" required>
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
				<hr>
				<div class="form-group col-md-12 divPassword" >
					<label class="control-label" for="password" id="lblPassword">Password</label>
					<input type="password" class="form-control" id="password" name ="password" placeholder="Password required" required="">
				</div>
				<div class="clearfix"></div>					
	        </div>
	        <div class="modal-footer">
	          <button type="button " class="btn btn-success" >Update</button>
	          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        </div>
	      </div>
	      
	    </div>
	  </div>
	</form>
	  <!-- Modal -->
	  <div class="modal fade" id="alertModal" role="dialog" style="margin-top:150px">
	    <div class="modal-dialog modal-xs">
	    
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Alert</h4>
	        </div>
	        <div class="modal-body">
	          <h3>Are you sure you want to delete this account?</h3>

	          <center><h3 id="mdllblUsername" class=""></h3></center>
	          <input type ="hidden" name="account_id" id="account_id">
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-success" id="btnDeleteAccount">Yes</button>
	          <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
	        </div>
	      </div>
	      
	    </div>
	  </div>
	  
	<script src="../js/jquery-1.11.1.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/chart.min.js"></script>
	<script src="../js/chart-data.js"></script>
	<script src="../js/easypiechart.js"></script>
	<script src="../js/easypiechart-data.js"></script>
	<script src="../js/bootstrap-datepicker.js"></script>
	<script src="../js/custom.js"></script>

	<script>

		$('.edit').click(function(){

			$('#update_account_id').val($(this).attr('id'))
			$('#username').val($(this).attr('username'))
			$('#firstname').val($(this).attr('fname'))
			$('#lastname').val($(this).attr('lname'))
			$('#birthday').val($(this).attr('birthday'))
			$('#gender').val($(this).attr('gender'))
		
		
			$('#myModal').modal('show')
		})
		$('.delete').click(function(){
			$('#alertModal').modal('show')
			$('#account_id').val($(this).attr('id'))

			$('#mdllblUsername').html($(this).attr('username'))

		})
		$("#frmUpdateAccount").submit(function(e){
			var id = $('#update_account_id').val()
			var firstname = $('#firstname').val()
			var lastname = $('#lastname').val()
			var gender = $('#gender').val()
			var password = $('#password').val()
			var birthday = $('#birthday').val()
			
			$.ajax({
				url:'../api.php',
				data:{request:'updateAccountViaID',id:id,firstname:firstname,lastname:lastname,gender:gender,password:password,birthday:birthday},
				type:'POST',
				dataType:'JSON',
				success:function(data){

					console.log(data)
					if(data.msg=="200"){
						alert('Account Updated')
						location.reload()
					}
				}
			})
			e.preventDefault();
		})
		$('#btnDeleteAccount').click(function(){
			var id = $('#account_id').val()
			$.ajax({
				url:'../api.php',
				data:{request:'deleteAccountViaID',id:id},
				dataType:'JSON',
				type:'post',
				success:function(data){
					if(data.msg==200){
						console.log('Account Deleted')
						alert('Account Deleted')
						location.reload()
					}
				}
			})
		})
	</script>

		
</body>
</html>