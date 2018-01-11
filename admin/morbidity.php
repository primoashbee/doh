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
	<style>
	 #map {
        height: 100%;
      }
   		#floating-panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
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
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name">ADMIN</div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>Administrator
				</div>
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
				<h1 class="page-header">Welcome, <i> Administrator</i></h1>
					
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						Outbreaks
						<a href="create_outbreak.php"><button class="btn btn-success" style="float:right;">Create Outbreak	</button></a>
					</div>

					<div class="panel-body">
						<div class="col-xs-12 col-md-12" style="margin-left:-10px">
						<form action ="<?=$_SERVER['PHP_SELF']?>" method ="get" id="frmFilter">
						<div class="form-inline">
							<label for="status">Status:  </label>
							<select name="status" id="status" class ="form-control filter">
								<option value="">------</option>
								<option value="morbidity">Morbidity</option>
								<option value="mortality">Mortality</option>
							</select>	
							
							<label for="status">Baranggay:  </label>
							<select name="baranggay_id" id="baranggay_id" class ="form-control filter" >
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
							<label for="month">Month:  </label>
							<select name="month" id="month" class ="form-control filter">
								<option value="">------</option>
								<option value="1">January</option>
								<option value="2">February</option>
								<option value="3">March</option>
								<option value="4">April</option>
								<option value="5">May</option>
								<option value="6">June</option>
								<option value="7">July</option>
								<option value="8">August</option>
								<option value="9">September</option>
								<option value="10">October</option>
								<option value="11">November</option>
								<option value="12">December</option>
							</select>						
							<label for="year">Year:  </label>
							<select name="year" id="year" class ="form-control filter">
								<option value="">------</option>
								<?php
									$years= getYears();
									
									foreach ($years as $key => $value) {
									?>
									<option value="<?=$value['year']?>"><?=$value['year']?></option>
									<?php
									}
								 ?>
							</select>
							<button type="submit" class="btn" style="background-color:#30a5ff;border-color:#30a5ff;color: white;float:right;">Enter</button>
							<a href="reports/disease_report.php?<?=$_SERVER['QUERY_STRING']?>" onClick=""><button type="button" class="btn btn-warning" style="float:right;"><i class="fa fa-print fa-2" aria-hidden="true">  Print Result</i></button></a>
							</div>
							</div>
						</div>
						</form>
						<div class="clearfix" style="padding-bottom: 10px"></div>

						<table class="table table-striped" id="myTable">
							<thead>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Gender</th>
								<th>Age</th>
								<th>Diseases</th>
								<th>Baranggay</th>
								<th>Status</th>

								<th>Encoded On</th>
							</thead>
							<?php 
								$data = qryOutbreak($_GET);
								$_SESSION['QRY_STRING'] = $_GET;
								if($count = count($data) > 0){

									foreach($data as $key=>$value){
									?>
										<tr>
											<td><?=$value['firstname']?></td>
											<td><?=$value['lastname']?></td>
											<td><?=$value['gender']?></td>
											<td><?=computeAge($value['birthday'])?></td>
											<td><?=$value['disease_name']?></td>
											<td><?=$value['name']?></td>
											<td><?=ucfirst($value['status'])?></td>
											<td><?=$value['created_at']?></td>
											
										</tr>

									<?php
									}
								}
							?>	

						</table>
						<hr>
						<h3> Map Information </h3>
						<iframe src="heatmap.php" width="100%" height="500px"></iframe>
					</div>
				</div>
			</div>
		</div><!--/.row-->
		
	</div>	<!--/.main-->
	
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
			 <?php 
			 	$params = count($_GET);
			 	
			 	if($params>0){
			 		foreach ($_GET as $key => $value) {	
			 		?>
		$('#<?=$key?>').val('<?=$value?>')
						<?php

						}
					}
				?>
		})
		
		$('#frmFilter').submit(function(){
			$('.filter').each(function(){
				if($(this).val()==""){
					$(this).attr('disabled','disabled')

			}
			})
		})

	function generateReport(){
		var qry = '<?=$_SERVER['PHP_SELF'].'/'.$_SERVER['QUERY_STRING']?>';
		var data = '<?=$_SERVER['QUERY_STRING']?>'
		var type = 'all'

		/*$.ajax({
			url:'',
			type:'GET',
			success:function(data){

			}
		})*/
		location.href="reports/disease_report.php?"+data

	}

</script>

		
</body>
</html>