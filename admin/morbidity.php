<?php 
require "../config.php";
require "../functions2.php";
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
				<img src="<?=$_SESSION['user']['img_url']."?".rand(0,100)?>" class="img-responsive" alt="">
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
					</a></li>
					
				</ul>
			</li>

			<li><a href="setting.php"><em class="fa fa-gear">&nbsp;</em> Setting</a></li>
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
						
					</div>

					<div class="panel-body">
						<form action ="<?=$_SERVER['PHP_SELF']?>" method ="get" id="frmFilter">
							<div class="form-inline">
								<label for="status">Status:  </label>
								<select name="status" id="status" class ="form-control filter">
									<option value="">ALL</option>
									<option value="morbidity">Morbidity</option>
									<option value="mortality">Mortality</option>
								</select>	
								<label class="control-label" for="disease_id">Disease</label>
								<select name="disease_id" id="disease_id" class="form-control filter" >
									<option value="">ALL</option>
									<?php 
											$data = getDiseaseCollection();
											if($count = count($data) > 0){
												foreach($data as $key=>$value){
												?>
										<option value="<?=$value['id']?>"><?=($value['disease_name'])?></option>
												<?php
												
											}
										}
									?>
								</select>
								<label for="status">Baranggay:  </label>
								<select name="baranggay_id" id="baranggay_id" class ="form-control filter" >
									<option value="">ALL</option>
									<?php 
											$data = getBaranggayCollection();
											foreach($data as $key=>$value){
												?>
										<option value="<?=$value['id']?>"><?=html_entity_decode($value['name'])?></option>
												<?php
												
											}
									?>
								</select>
								<br>
								<label for="month">Month From:  </label>
								<select name="month" id="month" class ="form-control filter">
									<option value="">ALL</option>
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
								<label for="month2">To:  </label>
								<select name="month2" id="month2" class ="form-control filter">
									<option value="">ALL</option>
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
								<br>				
								<label for="year">Year:    </label>
								<select name="year" id="year" class ="form-control filter" style="margin-left:12px">
									<option value="">ALL</option>
									<?php
										$years= getYears();
										
										foreach ($years as $key => $value) {
										?>
										<option value="<?=$value['year']?>"><?=$value['year']?></option>
										<?php
										}
									 ?>
								</select>
								<button type="submit" class="btn" style="background-color:#30a5ff;border-color:#30a5ff;color: white;float:right;width: 110px">Enter</button>
								<button id="btnGenerateReport" type="button" class="btn btn-warning" style="float:right;"><i class="fa fa-print fa-2" aria-hidden="true">  Print Result</i></button>
							</div>
						</form>

						<div class="clearfix" style="margin-top: 25px"></div>
								<ul class="nav nav-tabs">
				                  <li class="active "><a data-toggle="tab" href="#home">List</a></li>
				                  <li class=""><a data-toggle="tab" href="#bgraph">Baranggay Graph</a></li>
				                  <li class=""><a data-toggle="tab" href="#agraph">Age Graph</a></li>
				                  <li class=""><a data-toggle="tab" href="#outbreak">Outbreak</a></li>
				                  <li class=""><a data-toggle="tab" href="#rankings">Rankings</a></li>
				                </ul>
				                <div class="tab-content">
				                  <div id="home" class="tab-pane fade in active">
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
															<td><?=convertDateTime($value['created_at'])?></td>
															
														</tr>

													<?php
													}
												}
											?>	

										</table>
				                  </div>
				                  <div id="bgraph" class="tab-pane fade in ">
										<div class="canvas-wrapper">
											<h3 style="text-align: center"> Mortality Graph </h3>
											<canvas class="main-chart" id="mortalityGraph" height="100" width="600"></canvas>
										</div>
										<div class="canvas-wrapper">
											<h3 style="text-align: center"> Morbidity Graph </h3>
											<canvas class="main-chart" id="morbidityGraph" height="100" width="600"></canvas>
										</div>				
				                  </div>
				                  <div id="agraph" class="tab-pane fade in ">
										<div class="canvas-wrapper">
											<h3 style="text-align: center"> Age Morbidity Graph </h3>
											<canvas class="main-chart" id="AgeMorbidityGraph" height="300" width="600"></canvas>
										</div>						
										<div class="canvas-wrapper">
											<h3 style="text-align: center"> Age Mortality Graph </h3>
											<canvas class="main-chart" id="AgeMortalityGraph" height="300" width="600"></canvas>
										</div>
				                  </div>
				                  <div id="outbreak" class="tab-pane fade in ">
										<div class="col-xs-12 col-lg-12 col-md-12">
											<h3> <center> Map Information </center> </h3>
											<iframe src="heatmap.php" width="100%" height="500px"></iframe>
										</div>	
				                  </div>
				                  <div id="rankings" class="tab-pane fade in ">
				                  			<h3><center> Legend</center></h3>
											<div class="col-xs-12 col-md-4 col-lg-4">	
				                  			<label for="">Safe Level </label><span class ="green-mo-bes" style="width: 50px;margin-left: 5px"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
				                  			</div>
											<div class="col-xs-12 col-md-4 col-lg-4">	
				                  			<label for="">Warning Level </label><span class ="orange-mo-bes" style="width: 50px;margin-left: 5px"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
				                  			</div>
											<div class="col-xs-12 col-md-4 col-lg-4">	
				                  			<label for="">Danger Level </label><span class ="red-mo-bes" style="width: 50px;margin-left: 5px"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
				                  			</div>
				                  			<div class="col-xs-12 col-lg-6 col-md-6">
												<h3>  <center>Morbidty Rankings</center> </h3>
												<?php 
													$morbidity = rankings('morbidity');
													
													$ctr=1;
												?>
												<table class="table table-striped" id="tblMorbidityRankings">
													<thead>
														<th>#</th>
														<th>Name</th>
														<th>Count</th>
														<th>Rank</th>
													</thead>
													<tbody>	
														<?php
															foreach ($morbidity as $key => $value) {
															?> 
															<tr total ="<?=$value['total_count']?>" status ="morbidity" d_name = "<?=$value['disease_name']?>" disease_id="<?=$value['disease_id']?>" class="viewCount <?=trClassViaID($value['disease_id'],'morbidity',$value['disease_name'])?>">
																<td><?=$ctr++?></td>
																<td><?=$value['disease_name']?></td>
																<td><?=$value['total_count']?></td>
																<td><?=$value['rank']?></td>
															</tr>
															<?php
														}
													?>
													</tbody>
												</table>
												</div>						
												<div class="col-xs-12 col-lg-6 col-md-6">
												<h3> <center>Mortality Rankings</center> </h3>
																		<?php 
													$mortality = rankings('mortality');
													$ctr=1;
												?>
												<table class="table table-striped" id="tblMortalityRankings">
													<thead>
														<th>#</th>
														<th>Name</th>
														<th>Count</th>
														<th>Rank</th>
													</thead>
													<tbody>	
														<?php
															foreach ($mortality as $key => $value) {
															?> 
															<tr total ="<?=$value['total_count']?>" status ="mortality" d_name = "<?=$value['disease_name']?>" disease_id="<?=$value['disease_id']?>" class="viewCount <?=trClassViaID($value['disease_id'],'mortality',$value['disease_name'])?>">
																<td><?=$ctr++?></td>
																<td><?=$value['disease_name']?></td>
																<td><?=$value['total_count']?></td>
																<td><?=$value['rank']?></td>
															</tr>
															<?php
														}
													?>
													</tbody>
												</table>
												</div>
											</div>
				                  </div>
				                 </div>



					
						
				</div>
			</div>
		</div><!--/.row-->

<div id="rankingModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><center><span id="mdl_disease_name">Disease Name</span></center></h4>
      </div>
      <div class="modal-body">
        <table class="table table-condesed">
        	<thead>
        		<th> Baranggay Name </th>
        		<th> Count</th>
        	</thead>
        	<tbody id="rankingTable">
        		
        	</tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
		
	</div>	<!--/.main-->
	
	<script src="../js/jquery-1.11.1.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/chart-data.js"></script>
	<script src="../js/easypiechart.js"></script>
	<script src="../js/easypiechart-data.js"></script>
	<script src="../js/bootstrap-datepicker.js"></script>
	<script src="../js/custom.js"></script>
	<script src="../js/datatables.js"></script>
	<script src="../js/ashbee.js"></script>
	<script>
	var mt_labels = <?php 
		$mt_label=array();
		$mb_label=array();
		$mt_disease = qryOutbreakPerBaranggay($_GET,'mortality');
		$mb_disease = qryOutbreakPerBaranggay($_GET,'morbidity');
		$mt_colors =array();
		$mb_colors =array();
		$totalCountMortality =array();
		$totalCountMorbidity =array();
		
		foreach ($mt_disease as $key => $value) {
			if(!is_null($value['baranggay_name'])){
			array_push($mt_label,$value['baranggay_name']);
			array_push($totalCountMortality,$value['total_count']);
			array_push($mt_colors,generateColor());
			}
		}
		foreach ($mb_disease as $key => $value) {
			if(!is_null($value['baranggay_name'])){
			array_push($mb_label,$value['baranggay_name']);
			array_push($totalCountMorbidity,$value['total_count']);
			array_push($mb_colors,generateColor2());
			}
		}
		$mortality_counts =array();	
		
		echo json_encode($mt_label);
	?>;
	var mb_labels = <?php echo json_encode($mb_label)?>;
	var mt_colors = <?php echo json_encode($mt_colors)?>;
	var mb_colors = <?php echo json_encode($mb_colors)?>;
	
	var mt_data = <?php echo json_encode($totalCountMortality)?>;
	var mb_data = <?php echo json_encode($totalCountMorbidity)?>;
	
	var morbidityGraph = document.getElementById("morbidityGraph").getContext("2d");
	var mortalityGraph = document.getElementById("mortalityGraph").getContext("2d");
	var ageMorbidityGraph = document.getElementById("AgeMorbidityGraph").getContext("2d");
	var ageMortalityGraph = document.getElementById("AgeMortalityGraph").getContext("2d");
	var mbData = {
	    labels:mb_labels,
	    datasets: [{
	        label: "Morbidity",
	        data: mb_data,
	        backgroundColor: mb_colors,
	        hoverBackgroundColor: ["#66A2EB", "#FCCE56"]
	    }]
	};	
	var mtData = {
	    labels:mt_labels,
	    datasets: [{
	        label: "Mortality",
	        data: mt_data,
	        backgroundColor: mt_colors,
	        hoverBackgroundColor: ["#66A2EB", "#FCCE56"]
	    }]
	};
	var mbGraph = new Chart(morbidityGraph, {
	    type: 'bar',
	    data: mbData,
	    options: {
	        scales: {
	            xAxes: [{
	                ticks: {
	            		min: 60
	                }
	            }],
	            yAxes: [{
	            	stacked: true
	            }]
	        }
	    }
	});
	var mtGraph = new Chart(mortalityGraph, {
	    type: 'bar',
	    data: mtData,
	    options: {
	        scales: {
	            xAxes: [{
	                ticks: {
	            		min: 60
	                }
	            }],
	            yAxes: [{
	            	stacked: true
	            }]
	        }
	    }
	});
	var male_values_morbidity=<?php 	
		 echo json_encode(getAgeCountMorbidity($_GET,'male'));
	?>;
	var female_values_morbidity=<?php 	
		 echo json_encode(getAgeCountMorbidity($_GET,'female'));
	?>;
	var male_values_mortality=<?php 	
		 echo json_encode(getAgeCountMortality($_GET,'male'));
	?>;
	var female_values_mortality=<?php 	
		 echo json_encode(getAgeCountMortality($_GET,'female'));
	?>;
	var ageDataMorbidity = {
	    labels: ["Under 1","1 to 4","5 to 9","10 to 14"," 15 to 19","20 to 24","25 to 29","30-34","35 to 39","40 to 44","45 to 49","50 to 54","55-59","60 to 64", "65 & above"],
	    datasets: [
	        {
	            label: "Male",
	            backgroundColor: "#f2c351",
	            data: male_values_morbidity
	        },
	        {
	            label: "Female",
	            backgroundColor: "#fb8c29",
	            data: female_values_morbidity 
	        }
	        
	        
	    ]
	};
	var ageDataMortality = {
	    labels: ["Under 1","1 to 4","5 to 9","10 to 14"," 15 to 19","20 to 24","25 to 29","30-34","35 to 39","40 to 44","45 to 49","50 to 54","55-59","60 to 64", "65 & above"],
	    datasets: [
	        {
	            label: "Male",
	            backgroundColor: "#f2c351",
	            data: male_values_mortality
	        },
	        {
	            label: "Female",
	            backgroundColor: "#fb8c29",
	            data: female_values_mortality
	        }
	        
	        
	    ]
	};
	var myBarChartMorbidity = new Chart(ageMorbidityGraph, {
	    type: 'horizontalBar',
	    data: ageDataMorbidity,
	    options: {
	        barValueSpacing: 20,
	        scales: {
	            xAxes: [{
	                ticks: {
	                    min: 0,
	                    beginAtZero:true
	                }
	            }]
	        }
	    }
	});	
	var myBarChartMortality = new Chart(ageMortalityGraph, {
	    type: 'horizontalBar',
	    data: ageDataMortality,
	    options: {
	        barValueSpacing: 20,
	        scales: {
	            xAxes: [{
	                ticks: {
	                    min: 0,
	                    beginAtZero:true
	                }
	            }]
	        }
	    }
	});
	</script>
	<script>
		
		$(function(){
			 $('#myTable').DataTable();

			 $('.viewCount').click(function(){
			 	var disease = ($(this).attr('d_name'));
			 	var total =($(this).attr('total'))
			 	var status =($(this).attr('status'))
			 	$.ajax({
			 		url:'../api.php',
			 		data:{request:'baranggayListRanking',disease_id:$(this).attr('disease_id'),status:status},
			 		dataType:'JSON',
			 		type:'POST',
			 		success:function(data){
			 			$('#mdl_disease_name').html(status.toUpperCase()+'-'+disease)
			 			$('#rankingTable').empty();
			 			$.each(data,function(k,v){
			 				$('#rankingTable').append('<tr><td>'+v.name+'</td><td>'+v.total+'</td></tr>')
			 			})
			 			$('#rankingTable').append('<tr><td style="text-align:right"><b>Total</b></td><td><b>'+total+'</b></td></tr>')
			 			$('#rankingModal').modal('show');
			 			console.log(data);
			 		}
			 	})
			 })















			 $('#tblMortalityRankings').DataTable();
			 $('#tblMorbidityRankings').DataTable();
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
		
		$('#frmFilter').submit(function(e){
			if($('#month2').val() !=""){
				if($('#month').val() =="" || $('#year').val()==""){
					alert('Please select Month(from) and Year')
					e.preventDefault()
					return false;
				}

			 }
			$('.filter').each(function(){
				if($(this).val()==""){
					$(this).attr('disabled','disabled')
			}
			})
		})
		$('#btnGenerateReport').click(function(){
			if(!validateParams()){
				return false;
			}
			window.location ="reports/disease_report.php?<?=$_SERVER['QUERY_STRING']?>"
		})
		function validateParams(){
						if($('#month2').val() !=""){
				if($('#month').val() =="" || $('#year').val()==""){
					alert('Please select Month(from) and Year')
					
					return false;
				}

			 }
			 return true;

		}
	function generateReport(){
		return false;
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