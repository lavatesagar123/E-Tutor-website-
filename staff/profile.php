<?php 
require_once('../admin/lib/functions.php');

$db		=	new login_function();

if(isset($_SESSION['staff_login']))
{
	$staff_login	=	$_SESSION['staff_login'];
}
if(!isset($_SESSION['staff_login']))
{	
	header("location:../index.php");
}

	$current_id	=	1;
	$report_details = $db->get_all_staff_reg_details_by_mobile_no($staff_login);
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
    <title>My Profile</title>
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
	<script>
	function validateForm() {
	  var a = document.forms["myForm"]["username"].value;
	  var d = document.forms["myForm"]["email"].value;
	  var e = document.forms["myForm"]["mobile_no"].value;
	  var f = document.forms["myForm"]["password"].value;
	 if (a == "") {
		alert("Enter Your Name");
		return false;
	  }
	  
	   if (d == "") {
		alert("Enter Email Address");
		return false;
	  }
	   if (e == "") {
		alert("Enter Mobile Number");
		return false;
	  }
	   if (f == "") {
		alert("Enter Password");
		return false;
	  }
	}
	</script>
	

</head>
<body class="fixed-navbar">
  
<div class="page-wrapper" style="min-height:600px;">
<?php include('header.php'); ?>
<?php include('side-bar.php'); ?>
<div class="content-wrapper">
	<div class="row" style="padding:0px; margin:0px; margin-top:15px; border-radius:15px;">
		<div class="ibox" style="border-radius:5px; padding:7px;">
			<form class="form-pink" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" name="myForm" onsubmit="return validateForm()" autocomplete="off" enctype="multipart/form-data">
			<div class="ibox-head">
				<div class="ibox-title"><i class="fas fa-edit" style="margin-right:10px;"></i>MY PROFILE</div>
			</div>
			<div class="ibox-body">
			<div class="row">
				<div class="col-sm-6 form-group mb-6">
			<label class="form-group mb-4 set-row"><b>Staff Name</b></label>
			<div class="input-group-icon input-group-icon-left  set-row">
				<span class="input-icon input-icon-left"><i class="fas fa-edit"></i></span>
				 <input class="form-control form-control-air " placeholder="Enter Staff Name" name="staff_name" type="text" value="<?php echo $staff_name; ?>" readonly >
				
			</div>
			</div>	
			<div class="col-sm-6 form-group mb-6">
			<label class="form-group mb-4 set-row"><b>Email</b></label>
			<div class="input-group-icon input-group-icon-left  set-row">
				<span class="input-icon input-icon-left"><i class="fas fa-edit"></i></span>
				 <input class="form-control form-control-air " placeholder="Enter Email" name="email" type="email" value="<?php echo $email; ?>"  readonly >
				
			</div>
			
			</div>
			<div class="col-sm-6 form-group mb-6">
			<label class="form-group mb-4 set-row"><b>Mobile No</b></label>
			<div class="input-group-icon input-group-icon-left  set-row">
				<span class="input-icon input-icon-left"><i class="fas fa-edit"></i></span>
				 <input class="form-control form-control-air " placeholder="Enter Mobile No" name="mobile_no" type="number" value="<?php echo $mobile_no; ?>" readonly >
				
			</div>
			</div>	
			<div class="col-sm-6 form-group mb-6">
			<label class="form-group mb-4 set-row"><b>Password</b></label>
			<div class="input-group-icon input-group-icon-left  set-row">
				<span class="input-icon input-icon-left"><i class="fas fa-edit"></i></span>
				 <input class="form-control form-control-air " placeholder="Enter Password" name="password" type="password" value="<?php echo $password; ?>" readonly >
				
			</div>
			</div>	
			<div class="col-sm-12 form-group mb-12">
			<label class="form-group mb-4 set-row"><b>Address</b></label>
			<div class="input-group-icon input-group-icon-left  set-row">
				<span class="input-icon input-icon-left"><i class="fas fa-edit"></i></span>
				 <input class="form-control form-control-air " placeholder="Enter Address" name="address" type="text" value="<?php echo $address; ?>" readonly >
				
			</div>
			</div>
				
				<!--<div class="col-sm-12 form-group mb-12" style="text-align:center; padding-left:0px; padding-right:0px; padding-top:20px;">
					<div class="col-sm-4 form-group mb-4" style="margin:auto;">
						<button class="btn btn-pink btn-air" type="submit" name="update" style="width:100%;" onclick="submitData()">UPDATE ADMIN</button>
					</div>
				</div>-->
				
				
		</div>
		</div>
		</form>
		
		
			
		</div>
		
<br />		
	</div>
</div>

</div>
</div>
<?php include('footer.php'); ?>

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