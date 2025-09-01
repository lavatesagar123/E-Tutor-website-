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

$flag=0;
$new_pass="";
$password="";
$new_confirm_pass="";				
$current_password_error="";
$result_password="";
$result_id="";
		
		if(isset($_POST['add']))
		{	
			$password			= $_POST['password'];
			$new_pass	 		= $_POST['new_pass'];
			$new_confirm_pass 	= $_POST['new_confirm_pass'];
			
			$mobile_id = $db->get_user_id_by_mobile($user_login);
			$email_id  = $db->get_user_id_by_email($user_login);
			
			if($mobile_id!="")
			{
			$result_id	=	$mobile_id;
			}
			else
			{
			$result_id	=	$email_id;
			}
			
			$result_password=$db->get_user_password($result_id);
				
			if($new_confirm_pass!=$new_pass)
			{
			
			$flag=1;
			}
			if($flag==0)
			{
				if($result_password==$password)
				{	
					$db->change_user_new_password($new_pass,$result_id);
					?>
					<script>
							alert("Password Changed Successfully...!!! ");
							window.location.href="change-password.php";
					</script>
					<?php
				}
				else
				{
					?>
					<script>
							alert("Please enter correct current password");
							
					</script>
					<?php
					
				}
			}
			else
			{
				?>
				<script>
						alert("New Password & Confirm Password does not match");
						
				</script>
				
			<?php
				
			}
	
	}
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Change Password</title>
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
	  var a = document.forms["myForm"]["password"].value;
	  var b = document.forms["myForm"]["new_pass"].value;
	  var c = document.forms["myForm"]["new_confirm_pass"].value;
	 
	  if (a == "") {
		alert("Enter Current Password");
		return false;
	  }
	  if (b == "") {
		alert("Enter New Password");
		return false;
	  }
	  if (c == "") {
		alert("Enter Confirm New Password");
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

<div class="ibox col" style="border-radius:5px; padding:7px;">
	 <form class="form-pink" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" name="myForm" onsubmit="return validateForm()" autocomplete="off" enctype="multipart/form-data">
		
		<div class="ibox-head">
			<div class="ibox-title"><i class="fas fa-edit" style="margin-right:10px;"></i>Change Password</div>
		</div>
		
		<div class="ibox-body">
			<div class="row">
				
				<div class="col-sm-4 col-md-4 col-lg-4 form-group mb-4">
					<label class="form-group mb-4 set-row label_marg"><b>Current Password</b></label>
					<div class="input-group-icon input-group-icon-left  set-row">
						<span class="input-icon input-icon-left"><i class="fas fa-lock"></i></span>
						<input type="text" id="password" class="form-control form-control-air"  placeholder="Enter Current Password"  value="<?php echo $password; ?>" name="password" >
					</div>
					<span style="color:red;"><?php echo $current_password_error; ?></span>
				</div>
				<div class="col-sm-4 col-md-4 col-lg-4 form-group mb-4">
					<label class="form-group mb-4 set-row label_marg"><b>New Password</b></label>
					<div class="input-group-icon input-group-icon-left  set-row">
						<span class="input-icon input-icon-left"><i class="fas fa-lock"></i></span>
						<input type="text" id="new_pass" class="form-control form-control-air"  placeholder="Enter New Password" name="new_pass"  value="<?php echo $new_pass; ?>">
					</div>
				</div>
				<div class="col-sm-4 col-md-4 col-lg-4 form-group mb-4">
					<label class="form-group mb-4 set-row label_marg"><b>Re-Type New Password</b></label>
					<div class="input-group-icon input-group-icon-left  set-row">
						<span class="input-icon input-icon-left"><i class="fas fa-lock"></i></span>
						<input type="text" name="new_confirm_pass" id="new_confirm_pass" placeholder="Enter Confirm New Password" name="new_pass" class="form-control form-control-air" value="<?php echo $new_confirm_pass; ?>"  />
					</div>
					
				</div>
				
				
				<div class="col-sm-12 form-group mb-12" style="text-align:center; padding-left:0px; padding-right:0px; padding-top:20px;">
					<div class="col-sm-4 form-group mb-4" style="margin:auto;">
						<button class="btn btn-pink btn-air" type="submit" name="add" style="width:100%;" onclick="submitData()">CHANGE PASSWORD</button>
					</div>
				</div>
			</div>
		</div>
	</form>
	</div>
</div>
</div>

</div>
</div>
<?php include('footer.php'); ?>
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