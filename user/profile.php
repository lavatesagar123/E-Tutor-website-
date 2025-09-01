<?php 
require_once('../admin/lib/functions.php');
$db		=	new login_function();

if(!isset($_SESSION['user_login']))
{	
	header("location:../index.php");
}

if(isset($_SESSION['user_login']))
{
	$user_login	=	$_SESSION['user_login'];
}


	$current_id	=	1;
	$res_username="";
	$res_mobile_no="";
	$res_email="";
	$res_password="";
	
	$flag=0;
	$user_id="";
	$actual_logo="";
	
	
	$mobile_id = $db->get_user_id_by_mobile($user_login);
	$email_id  = $db->get_user_id_by_email($user_login);
	
	if($mobile_id!="")
	{
	$user_id	=	$mobile_id;
	}
	else
	{
	$user_id	=	$email_id;
	}
			
		
	
	if(isset($_POST['update']))
		{	
			$username	 	= $_POST['username'];
			$email	 		= $_POST['email'];
			$mobile_no 		= $_POST['mobile_no'];
			if(strlen($mobile_no)!=10)
			{
			
				$flag=1;
			}
			$password	 	= $_POST['password'];
			
			$db_mobile_id	=	$db->get_contact_no_exist($mobile_no,$user_id);
			$db_email_id	=	$db->get_email_exist($email,$user_id);
			
			if($flag==0)
			{
				if($db_mobile_id=="" AND $db_email_id=="")
				{
					if($db->update_user_profile($username,$email,$mobile_no,$password,$user_id))
					{
					?>
						<script>
						alert("Details Successfully Updated...!!!");
						//window.location.href="user-report.php";
						</script>
					<?php
						
					}
				}
				else
				{
				?>
						<script>
						alert("Mobile Number or Email ID Already Exist");
						//window.location.href="user-report.php";
						</script>
					<?php
				}
			}
			else
			{
				?>
				<script>
				alert("Admin Details Failed to Update...!!!  Please Enter 10 digit Contact Number");
				</script>
			<?php
				
			}
		}
		
	$record	=	array();
	$record = $db->get_profile_by_mob_no($user_id);
	
	if(!empty($record))
	{
		$id						=	$record[0];
		$res_username			=	$record[1];
		$res_email				=	$record[2];
		$res_mobile_no			=	$record[3];
		$res_password			=	$record[4];
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
				<div class="col-sm-6 col-md-6 col-lg-6 form-group mb-6">
					<label class="form-group mb-4 set-row label_marg"><b>Enter User Name</b></label>
					<div class="input-group-icon input-group-icon-left  set-row">
						<span class="input-icon input-icon-left"><i class="fas fa-edit"></i></span>
						<input class="form-control form-control-air" type="text" name="username" id="username" placeholder="Enter User Name" value="<?php echo $res_username; ?>" readonly />
					</div>
				</div>
				<div class="col-sm-6 col-md-6 col-lg-6 form-group mb-6">
					<label class="form-group mb-4 set-row label_marg"><b>Enter Email Address</b></label>
					<div class="input-group-icon input-group-icon-left  set-row">
						<span class="input-icon input-icon-left"><i class="fas fa-edit"></i></span>
						<input class="form-control form-control-air" type="text" name="email" id="email" placeholder="Enter Email Address" value="<?php echo $res_email; ?>" readonly />
					</div>
				</div>
				
				
				<div class="col-sm-6 col-md-6 col-lg-6 form-group mb-6">
					<label class="form-group mb-4 set-row label_marg"><b>Enter Mobile Number</b></label>
					<div class="input-group-icon input-group-icon-left  set-row">
						
					<span class="input-icon input-icon-left"><i class="fas fa-phone"></i></span>
						<input class="form-control form-control-air" type="number" name="mobile_no" placeholder="Enter Mobile Number" value="<?php echo $res_mobile_no; ?>"   readonly />
					</div>
				</div>
				
				<div class="col-sm-6 col-md-6 col-lg-6 form-group mb-6">
					<label class="form-group mb-4 set-row label_marg"><b>Enter Password</b></label>
					<div class="input-group-icon input-group-icon-left  set-row">
						<span class="input-icon input-icon-left"><i class="fas fa-edit"></i></span>
						<input class="form-control form-control-air" type="password" name="password" id="password" placeholder="Enter Password" value="<?php echo $res_password; ?>" readonly  />
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