<?php 
	require_once("lib/functions.php");
	$db 			= new login_function();
	$flag 			= 0;
	$success_msg 	= 0;
	$staff_name		=	"";
	$email			=	"";
	$mobile_no		=	"";
	$password		=	"";
	$address		=	"";
	$mobile_no_error=	"";
	if(!isset($_SESSION['current_login_admin']))
	{
		header("Location:/admin/index.php");
	}
	if(isset($_SESSION['current_login_admin']))
	{
		$a_email	=	$_SESSION['current_login_admin'];
	}
	if(isset($_GET['up_id']))
	{
		$up_id	=	$_GET['up_id'];
		$_SESSION['current_update_id'] = $up_id;
	}
	else if(isset($_SESSION['current_update_id']))
	{
		$up_id	= $_SESSION['current_update_id'];
	}
	if(isset($_POST['add_btn']))
	{	
		$staff_name 	= $_POST['staff_name'];
		$email 			= $_POST['email'];
		$mobile_no 		= $_POST['mobile_no'];
		$password 		= $_POST['password'];
		$address		= $_POST['address'];
		if(strlen($mobile_no)!=10)
		{
			$mobile_no_error="Please Enter 10 Digit Mobile No";
			$flag=1;
		}
		if($flag==0)
		{
			$db_id=$db->get_staff_password_from_mobile_no_edit($mobile_no,$up_id);
			if($db_id=='')
			{
				if($db->update_staff($staff_name,$email,$mobile_no,$password,$address,$up_id))
				{
					$success_msg = 1 ;
					$staff_name		=	"";
					$email			=	"";
					$mobile_no		=	"";
					$password		=	"";
					$address		=	"";
				}
				else
				{
					$success_msg = 2 ;
				}
			}
			else
			{
					$success_msg = 2 ;
			}
		}
	}
	$report_details = $db->get_all_staff_reg_details_by_id($up_id);
	if(!empty($report_details))
	{
		$id				=	$report_details[0];
		$staff_name		=	$report_details[1];
		$email			=	$report_details[2];
		$mobile_no		=	$report_details[3];
		$password		=	$report_details[4];
		$address		=	$report_details[5];
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
  
<div class="page-wrapper" style="min-height:800px;">
<?php include('header.php'); ?>
<?php include('side-bar.php'); ?>
<div class="content-wrapper">
<div class="row" style="padding:0px; margin:0px; margin-top:15px; border-radius:15px;">
<?php 
if($success_msg == 1)
{
?>
<script type="text/javascript">
	alert("Staff Record Updated Successfully");
	
</script>
<?php 
} 
if($success_msg == 2)
{
?>
<script type="text/javascript">
	alert("Staff Alerady Exist");
</script>
<?php 
} 
?>
<div class="ibox" style="border-radius:5px; padding:7px; margin:auto;">
	
	<form class="form-pink" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" name="myForm" onsubmit="return validateForm()" autocomplete="off" enctype="multipart/form-data">
		
		<div class="ibox-head">
			<div class="ibox-title"><i class="fas fa-user-tie" style="margin-right:10px;"></i>Add Staff</div>
			<a href="staff-details.php" class="btn btn-outline-danger btn-rounded waves-effect" style="font-style:italic;"><< Staff Details Report </a>
		</div>
		
		<div class="ibox-body">
			<div class="row">
					
			<div class="col-sm-6 form-group mb-6">
			<label class="form-group mb-4 set-row"><b>Enter Staff Name</b></label>
			<div class="input-group-icon input-group-icon-left  set-row">
				<span class="input-icon input-icon-left"><i class="fas fa-edit"></i></span>
				 <input class="form-control form-control-air " placeholder="Enter Staff Name" name="staff_name" type="text" value="<?php echo $staff_name; ?>" required >
				
			</div>
			</div>	
			<div class="col-sm-6 form-group mb-6">
			<label class="form-group mb-4 set-row"><b>Enter Email</b></label>
			<div class="input-group-icon input-group-icon-left  set-row">
				<span class="input-icon input-icon-left"><i class="fas fa-edit"></i></span>
				 <input class="form-control form-control-air " placeholder="Enter Email" name="email" type="email" value="<?php echo $email; ?>"  >
				
			</div>
			
			</div>
			<div class="col-sm-6 form-group mb-6">
			<label class="form-group mb-4 set-row"><b>Enter Mobile No</b></label>
			<div class="input-group-icon input-group-icon-left  set-row">
				<span class="input-icon input-icon-left"><i class="fas fa-edit"></i></span>
				 <input class="form-control form-control-air " placeholder="Enter Mobile No" name="mobile_no" type="number" value="<?php echo $mobile_no; ?>" required >
				<span style="color:red;"><?php echo $mobile_no_error; ?></span>
			</div>
			</div>	
			<div class="col-sm-6 form-group mb-6">
			<label class="form-group mb-4 set-row"><b>Enter Password</b></label>
			<div class="input-group-icon input-group-icon-left  set-row">
				<span class="input-icon input-icon-left"><i class="fas fa-edit"></i></span>
				 <input class="form-control form-control-air " placeholder="Enter Password" name="password" type="password" value="<?php echo $password; ?>" required >
				
			</div>
			</div>	
			<div class="col-sm-12 form-group mb-12">
			<label class="form-group mb-4 set-row"><b>Enter Address</b></label>
			<div class="input-group-icon input-group-icon-left  set-row">
				<span class="input-icon input-icon-left"><i class="fas fa-edit"></i></span>
				 <input class="form-control form-control-air " placeholder="Enter Address" name="address" type="text" value="<?php echo $address; ?>" required >
				
			</div>
			</div>
			
					
			<div class="col-sm-12 form-group mb-12">
				<br />
				
				<center><button class="btn btn-pink btn-air mr-2" type="submit" name="add_btn">Add  Details</button></center>
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