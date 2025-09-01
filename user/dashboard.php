<?php 
require_once('../admin/lib/functions.php');

$db		=	new login_function();

	if(isset($_GET['logout']))
	{
		unset($_SESSION['user_login']);	
	}
	if(!isset($_SESSION['user_login']))
	{	
		header("location:../index.php");
	}

	if(isset($_GET['id']))
	{
		$user_login	=	$_GET['id'];
		
		
		$_SESSION['user_login'] = $user_login;
	}
	else if(isset($_SESSION['user_login']))
	{
		$user_login	= $_SESSION['user_login'];
	}
	
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
			<h5 class="font-strong mb-4"><i class="fas fa-bell" style="margin-right:10px;"></i>Students Notification</h5>
			
			<div class="table-responsive row">
			<table class="table table-bordered table-hover" id="example" style="overflow-x:auto;overflow-y:auto;">
				<thead class="thead-default thead-lg">
					<tr>
						<th>SR</th> 
						 <th>Titles</th>
                         <th>Attachment</th>
						
					</tr>
				</thead>
				<tbody>
				<?php
				$report_details = $db->get_all_notification();
				if(!empty($report_details))
				{
					$counter =0;
					foreach($report_details as $record)
					{
						$id				=	$report_details[$counter][0];
						$title			=	$report_details[$counter][1];
						$image			=	$report_details[$counter][2];
							
				?>
				<tr> 
					<td><?php echo $counter+1; ?></td>
					<td><?php echo $title; ?></td>
					<?php
					if($image != "")
					{
						list($txt, $ext) = explode(".", $image);
						if($ext=="pdf")
						{
				
					?>
					<td><a href="../downloads/<?php echo $image; ?>" target="_blank"><img src="../images/pdfimg.jpg" height="50px" width="50px" title="view"></a></td>

					<?php
					}
					else
					{
					?>
					<td> <a href="/downloads/<?php echo $image; ?>" target="_blank"><img src="/downloads/<?php echo $image; ?>" height="50px" width="50px" title="view"></a></td>

					<?php
					}
					?>											
					<?php
					}
					else
					{
					?>
					<td><img src="icon/no_image_available.png" style="height:90px;width:90px;" /></td>

					<?php
					}
					?>
								
													
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