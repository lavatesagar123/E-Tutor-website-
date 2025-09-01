<?php 
	require_once("lib/functions.php");
	$db = new login_function();
	$flag 				= 0;
	$title				="";
	$success_msg 		= 0;
	$image_error		="";
	$succ_flag			= 0 ;
	$title_error		="";
	$no_of_papers		=	"";
	$package_description=	"";
	if(isset($_GET['up_id']))
	{
		$up_id	=	$_GET['up_id'];
		$_SESSION['current_update_id'] = $up_id;
	}
	else if(isset($_SESSION['current_update_id']))
	{
		$up_id	= $_SESSION['current_update_id'];
	}
	
	if(!isset($_SESSION['current_login_admin']))
	{
		header("Location:/admin/index.php");
	}
	if(isset($_SESSION['current_login_admin']))
	{
		$email	=	$_SESSION['current_login_admin'];
	}
	if(isset($_POST['add_btn']))
	{	
		$title 				= 	$_POST['title'];
		$rate 				= 	$_POST['rate'];
		
		if($flag==0)
		{
			if($db->update_containt_category($up_id,$title,$rate))
			{
				$success_msg = 1 ;
			}
		}
	}
	$report_details = $db->get_all_category_by_id($up_id);
	if(!empty($report_details))
	{
		
		$id				=	$report_details[0];
		$title			=	$report_details[1];
		$rate			=	$report_details[2];
		
	}
	
	
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
  
<div class="page-wrapper" style="height:850px;">
<?php include('header.php'); ?>
<?php include('side-bar.php'); ?>
<div class="content-wrapper">
<div class="row" style="padding:0px; margin:0px; margin-top:15px; border-radius:15px;">
<?php 
if($success_msg == 1)
{
?>
<script type="text/javascript">
	alert("Containt Category Updated Successfully");
	
</script>
<?php 
} 
if($success_msg == 2)
{
?>
<script type="text/javascript">
	alert("Failed To Update Package");
</script>
<?php 
} 
?>
<div class="ibox" style="border-radius:5px; padding:7px; margin:auto;">
	
	<form class="form-pink" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" name="myForm" onsubmit="return validateForm()" autocomplete="off" enctype="multipart/form-data">
		
		<div class="ibox-head">
			<div class="ibox-title"><i class="fas fa-cloud-download-alt" style="margin-right:10px;"></i>Update Containt Category</div>
			<a href="containt-category.php" class="btn btn-outline-danger btn-rounded waves-effect" style="font-style:italic;"><< Containt Category Report </a>
		</div>
		
		<div class="ibox-body">
			<div class="row">
			
			<div class="col-sm-6 form-group mb-3">
			<label class="form-group mb-4 set-row"><b>Enter Title</b></label>
			<div class="input-group-icon input-group-icon-left  set-row">
				<span class="input-icon input-icon-left"><i class="fas fa-edit"></i></span>
				 <input class="form-control form-control-air " placeholder="Enter Title" name="title" type="text" value="<?php echo $title; ?>" required >
				
			</div>
			</div>
			<div class="col-sm-6 form-group mb-3">
			<label class="form-group mb-4 set-row"><b>Enter Amount</b></label>
			<div class="input-group-icon input-group-icon-left  set-row">
				<span class="input-icon input-icon-left"><i class="fas fa-edit"></i></span>
				 <input class="form-control form-control-air " placeholder="Enter Rate" name="rate" type="number" value="<?php echo $rate; ?>" required >
				
			</div>
			</div>
			
			<div class="col-sm-12 form-group mb-3">
				<br />
				
				<center><button class="btn btn-pink btn-air mr-2" type="submit" name="add_btn">Update Category</button></center>
			</div>
		</div>
	</form>
	</div>
</div>
  


</div>

</div>
</div>
</div>
    </div>
    <?php include('search.php'); ?>
   
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