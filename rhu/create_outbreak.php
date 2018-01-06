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
	<title>DOH - Dashboard</title>
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/font-awesome.min.css" rel="stylesheet">
	<link href="../css/datepicker3.css" rel="stylesheet">
	<link href="../css/styles.css" rel="stylesheet">
	<link href="../css/datatables.css" rel="stylesheet">
	
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
				<img src="<?=$_SESSION['user']['img_url']?>" class="img-responsive" alt="">
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name"><?=$_SESSION['user']['username']?></div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>RHU Officer</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>
	
		<ul class="nav menu">
			<li class="parent "><a data-toggle="collapse" href="#sub-item-1">
				<em class="fa fa-user">&nbsp;</em> Patients <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li><a class="" href="index.php">
						<span class="fa fa-arrow-right">&nbsp;</span> View Patients
					</a></li>
					<li><a class="" href="create_patient.php">
						<span class="fa fa-arrow-right">&nbsp;</span> Create Patient
					</a></li>
					
				</ul>
			</li>
			<li class="parent "><a data-toggle="collapse" href="#sub-item-2">
				<em class="fa fa-navicon">&nbsp;</em> Outbreak Mgmt <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-2">
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
						Patients
						<a href="create_patient.php"><button class="btn btn-success" style="float:right;">Create New Patient</button></a>
					</div>
					<div class="panel-body">
						<table class="table table-striped" id="myTable">
							<thead>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Gender</th>
								<th>Age</th>
								<th>Baranggay</th>

								<th>Created At</th>
								<th>Actions</th>
							</thead>
							<?php 
								$data = getPatientCollection();
								if($count = count($data) > 0){

									foreach($data as $key=>$value){
									?>
										<tr>
											<td><?=$value['firstname']?></td>
											<td><?=$value['lastname']?></td>
											<td><?=$value['gender']?></td>
											<td><?=$value['age']?></td>
											<td><?=$value['baranggay']?></td>
											<td><?=$value['created_at']?></td>
											<td>
												<button class="btn btn-warning outbreak" 
												id="<?=$value['id']?>" 
												firstname="<?=$value['firstname']?>" lastname="<?=$value['lastname']?>" 
												birthday="<?=$value['birthday']?>" address="<?=$value['address']?>" 
												contact="<?=$value['contact']?>" gender="<?=$value['gender']?>"
												baranggay="<?=$value['baranggay_id']?>"> <span class="fa fa-pencil"></span> </button>

												<button class="btn btn-danger delete" id="<?=$value['id']?>" firstname="<?=$value['firstname']?>" lastname="<?=$value['lastname']?>" > <span class="fa fa-trash-o"></span> </button>

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
	<form id="frmUpdatePatient" method="POST" target="<?php echo $_SERVER['PHP_SELF'] ?> ">
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
					<label class="control-label" for="firstname" id="lblfirstname">First Name</label>
					<input type="hidden" id="edit_patient_id">
					
					<input type="text" class="form-control" id="firstname" name ="firstname" placeholder="firstname" required="">
				</div>
				<div class="form-group col-md-6">
					<label class="control-label" for="lastname">Last Name</label>
					<input type="text" class="form-control" id="lastname" name ="lastname" placeholder="lastname" required>
				</div>							
				<div class="form-group col-md-3">
					<label class="control-label" for="birthday">Birthday</label>
					<input type="date" class="form-control" id="birthday" name ="birthday" placeholder="birthday" required="" >
				</div>
				<div class="form-group col-md-9">
					<label class="control-label" for="address">Address</label>
					<input type="text" id="address" name="address" class="form-control" required="">
				</div>
				<div class="form-group col-md-6">
					<label class="control-label" for="contact">Contact # <i>(09191234567)</i></label>
					<input type="tel" id="contact" name="contact" class="form-control" required="">
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

	        </div>
	        <div class="modal-footer">
	          <button type="submit " id="btnUpdate" class="btn btn-success" >Update</button>
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
	          <h3>Are you sure you want to delete this Patient?</h3>

	          <center><h3 id="mdlPatient" class=""></h3></center>
	          <input type ="hidden" name="patient_id" id="patient_id">
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
	<script src="../js/datatables.js"></script>

	<script>
		$(function(){
			 $('#myTable').DataTable();
		})
		$('.outbreak').click(function(){

			$('#edit_patient_id').val($(this).attr('id'))
			$('#firstname').val($(this).attr('firstname'))
			$('#lastname').val($(this).attr('lastname'))
			$('#birthday').val($(this).attr('birthday'))
			$('#address').val($(this).attr('address'))
			$('#contact').val($(this).attr('contact'))
			$('#gender').val($(this).attr('gender'))
			$('#baranggay').val($(this).attr('baranggay'))
		
		
			$('#myModal').modal('show')
		})
		$('.delete').click(function(){
			$('#alertModal').modal('show')
			$('#patient_id').val($(this).attr('id'))

			$('#mdlPatient').html($(this).attr('firstname') +' '+$(this).attr('lastname'))

		})
		$("#frmUpdatePatient").submit(function(e){
			console.log($(this).serialize())
			console.log('$(this).serialize()')
			var id = $("#edit_patient_id").val()
			var fname =$('#firstname').val()
			var lname= $('#lastname').val()
			var bday = $('#birthday').val()
			var address = $('#address').val()
			var contact = $('#contact').val()
			var gender = $('#gender').val()
			var baranggay = $('#baranggay').val();
			var error = 0

			if(id=="" || fname=="" || lname=="" || bday=="" || address=="" || contact=="" || gender==""||baranggay==""){
				error++
			}e.preventDefault()
			
			$.ajax({
				url:'../api.php',
				data:{request:'updatePatientViaID',id:id,fname:fname,lname:lname,bday:bday,address:address,contact:contact,gender:gender,baranggay:baranggay},
				dataType:'JSON',
				type:'POST',
				success:function(data){
					if(data.msg==200){
						alert('Patient Updated!')
						location.reload()
					}
				}
			}) 
			if(error > 0){
				e.preventDefault()
				return false;
			}
		})
		$('#btnDeleteAccount').click(function(){
			var id = $('#patient_id').val()
			$.ajax({
				url:'../api.php',
				data:{request:'deletePatientViaID',id:id},
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