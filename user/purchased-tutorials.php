<?php 
require_once('../admin/lib/functions.php');

$db		=	new login_function();

	
	if(!isset($_SESSION['user_login']))
	{	
		header("location:../index.php");
	}
	$user = $_SESSION['user_login'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Dashboard</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <link href="css/line-awesome.min.css" rel="stylesheet" />
    <link href="css/themify-icons.css" rel="stylesheet" />
    <link href="css/animate.min.css" rel="stylesheet" />
    <link href="css/toastr.min.css" rel="stylesheet" />
    <link href="css/bootstrap-select.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  
    <!-- PLUGINS STYLES-->
    <!-- THEME STYLES-->
    <link href="css/main.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  
    <!-- PAGE LEVEL STYLES-->
</head>

<body class="fixed-navbar">
    <div class="page-wrapper">
        <!-- START HEADER-->
        <?php include('header.php'); ?>
        <!-- END HEADER-->
        <!-- START SIDEBAR-->
        <?php include('side-bar.php'); ?>
        <!-- END SIDEBAR-->
        <div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            
			<div class="page-content fade-in-up" style="width:100%;">
	<div class="ibox">
		<div class="ibox-body">
			<h5 class="font-strong mb-4"><i class="fas fa-bell" style="margin-right:10px;"></i>Purchased Tutorials</h5>
			
			<div class="table-responsive row">
			<table class="table table-bordered table-hover" id="example" style="overflow-x:auto;overflow-y:auto;">
				<thead class="thead-default thead-lg">
					<tr>
						<th>SR</th> 
						 <th>Tutorial Details</th>
                         <th>Fees</th>
						<th>Payment Method</th>
						<th>Details</th>
						<th>Date</th>
						<th>Time</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$report_details = $db->get_all_my_tutorials($user);
				
				if(!empty($report_details))
				{
					$counter =0;
					foreach($report_details as $record)
					{
						$id					=	$report_details[$counter][0];
						$tuto_id			=	$report_details[$counter][1];
						$fees				=	$report_details[$counter][2];
						$purchase_by		=	$report_details[$counter][3];
						$payment_method		=	$report_details[$counter][4];
						$payment_by_id		=	$report_details[$counter][5];
						$date				=	$report_details[$counter][6];					
						$time				=	$report_details[$counter][7];
						
					$tutorial_data = $db->get_all_course_info_by_id($tuto_id);
					if(!empty($tutorial_data))
					{
						$counter =0;
						$id				=	$tutorial_data[$counter][0];
						$c_type			=	$tutorial_data[$counter][1];
						$title			=	$tutorial_data[$counter][2];
						$duration		=	$tutorial_data[$counter][3];
						$mode			=	$tutorial_data[$counter][4];
						$description	=	$tutorial_data[$counter][5];
						$fees			=	$tutorial_data[$counter][6];
						$contact		=	$tutorial_data[$counter][7];
						$image			=	$tutorial_data[$counter][8];
					}
						
				?>
				<tr> 
					<td><?php echo $counter+1; ?></td>
					<td>Id : <?php echo $tuto_id; ?>
						<br />
						Title : <?php echo $title; ?>
						<br />
						Description : <?php echo $description; ?>
						<br />
						<a href="../gallery/<?php echo $image; ?>" target="_blank" class="apply-now-btn" style="color:#660010 !important;padding:5px !important; width:80px; font-weight:bold;">View</a>
								<a href="../gallery/<?php echo $image; ?>" download class="apply-now-btn" style="color:#138535 !important;padding:5px !important; width:80px; font-weight:bold;">Download</a>
						<br />
					</td>
					<td><?php echo $fees; ?></td>
					<td><?php echo $payment_method; ?></td>
					<td><?php echo $payment_by_id; ?></td>
					<td><?php echo $date; ?></td>
					<td><?php echo $time; ?></td>
													
				</tr> 
				<?php
						$counter++;		
						}
				}
				
				?>
				</tbody> 
			</table> 
		</div>
	</div>
	</div>
</div>
			
            
            <!-- END PAGE CONTENT-->
           
        </div>
    </div>
	 <?php include('footer.php'); ?>
    <!-- START SEARCH PANEL-->
    <?php //include('search.php'); ?>
    <!-- END SEARCH PANEL-->
    <!-- BEGIN THEME CONFIG PANEL-->
    
    <!-- END THEME CONFIG PANEL-->
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->
    <!-- New question dialog-->
    
    <!-- End New question dialog-->
    <!-- QUICK SIDEBAR-->
    <?php //include('right-side-bar.php'); ?>
    <!-- END QUICK SIDEBAR-->
    <!-- CORE PLUGINS-->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/metisMenu.min.js"></script>
    <script src="js/jquery.slimscroll.min.js"></script>
    <script src="js/idle-timer.min.js"></script>
    <script src="js/toastr.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/bootstrap-select.min.js"></script>
    <!-- PAGE LEVEL PLUGINS-->
    <!-- CORE SCRIPTS-->
    <script src="js/app.min.js"></script>
    <!-- PAGE LEVEL SCRIPTS-->
</body>

</html>