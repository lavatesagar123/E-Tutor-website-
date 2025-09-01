<?php 
require_once('../admin/lib/functions.php');

$db		=	new login_function();

	if(isset($_SESSION['user_login']))
	{
		$user_login	=	$_SESSION['user_login'];
	}
	if(!isset($_SESSION['user_login']))
	{	
		header("location:../index.php");
	}
	$flag 			= 0;
	$success_msg 	= 0;
	$title 			= "";
	$duration 		= "";
	$mode 			= "";
	$fees 			= "";
	$description	= "";
	$contact 		= "";
	$course_error 	= "";
	$c_type 		= "";
	$image_error 	= "";
	
	
	

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title><?php echo $project_title; ?></title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <link href="css/line-awesome.min.css" rel="stylesheet" />
    <link href="css/themify-icons.css" rel="stylesheet" />
    <link href="css/animate.min.css" rel="stylesheet" />
    <link href="css/toastr.min.css" rel="stylesheet" />
    <link href="css/bootstrap-select.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  
    <!-- THEME STYLES-->
    <link href="css/main.min.css" rel="stylesheet" />
	<link href="datatable/datatables.min.css" rel="stylesheet" />

	<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
	<script src="js/wow.min.js"></script>
</head>
<body class="fixed-navbar">
  
<div class="page-wrapper" style="min-height:800px;">
<?php include('header.php'); ?>
<?php include('side-bar.php'); ?>
<div class="content-wrapper">

<div class="page-content fade-in-up">
<div class="ibox" style="border-radius:5px;padding:7px;">
	<div class="ibox-head">
		<div class="ibox-title">Question Paper Report</div>
		
	</div>	
	
	<div class="flexbox mb-4" style="margin-left:20px;margin-right:20px;margin-top:20px;">
		<div class="input-group-icon input-group-icon-left mr-3">
			<span class="input-icon input-icon-right font-16"><i class="fas fa-search"></i></span>
			<input class="form-control form-control-rounded form-control-solid" id="key-search" type="text" placeholder="Search ...">
		</div>
		
		
	</div>
	
	<div class="table-wrapper-scroll-y table-wrapper-scroll-x my-custom-scrollbar">

	<div class="table-responsive" id="table_response" style="height:100%; width:100%; overflow:auto;">
		<table class="table table-bordered table-hover" id="example" >
			<thead class="thead-default thead-lg">
				<tr>
					<th>Sr.No</th>
					<th>Title</th> 
					<th>Attachment</th>
					<th>Date</th>
					<th>Time</th>
					<th>Action</th>
					
				</tr>
			</thead>
			<tbody>
			<?php
				$data	=	array();
				$data	=	$db->get_all_question_paper_details();
				
				if(!empty($data))
					{
						$counter =0;
						foreach($data as $record)
						{
							$id						=	$record[0];
							$res_title				=	$record[1];
							$res_attachment			=	$record[2];
							$res_date				=	$record[3];
							$res_time				=	$record[4];
							
							
							$date_data = explode("-",$res_date);
							$date = $date_data[2]."-".$date_data[1]."-".$date_data[0];
							
							?>
							<tr> 
								<td><?php echo $counter+1; ?></td>
								<td><?php echo $res_title; ?></td>
								
								<?php
									if($res_attachment!="")
									{
									?>
									<td style="text-align:center;">
										<a href="../question-papers/<?php echo $res_attachment; ?>" target="_blank" ><img src="images/attachment.jpg" height="50px" width="50px"></a>
									</td>
									<?php
									}
									else
									{
									?>
									<td>
										<a href="icon/no-image.png" target="_blank"><img src="icon/no-image.png" height="50px" width="100px"></a>
									</td>
									<?php
									}
								?>
								<td><?php echo $date; ?></td>
								<td><?php echo $res_time; ?></td>
								
								<td>
									<a href="upload-answer-keys.php?id=<?php echo $id;?>" style="color:green;">Upload Answer Keys
									</a>
								</td>
								
						<?php
						$counter++;
						}
						
					}
					
					else
					{
					?>
					<td>No Data Found...</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<?php
					}
				   ?>
				</tr> 
			</tbody> 
		</table> 
	</div>
	</div>
	</div>
</div>



</div>
</div>
</div>
    </div>
    <?php //include('search.php'); ?>
   
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/metisMenu.min.js"></script>
    <script src="js/jquery.slimscroll.min.js"></script>
    <script src="js/idle-timer.min.js"></script>
    <script src="js/toastr.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/bootstrap-select.min.js"></script>
	<script src="datatable/datatables.min.js"></script>
    <script src="js/app.min.js"></script>
	
</body>
</html>