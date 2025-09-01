<?php 

	require_once('lib/functions.php');

	$db		=	new login_function();
		
	if(isset($_SESSION['current_login_admin']))
	{
		$current_login_admin	=	$_SESSION['current_login_admin'];
	}
	if(!isset($_SESSION['current_login_admin']))
	{	
		header("location:index.php");
	}
		
	
	$flag						=	0;
	$SuccessMsg				=	0;
	
	$current_password			=	"";
	$new_password				=	"";
	$confirm_password			=	"";
	$confirm_password_error		=	"";
	$current_password_error		=	"";
	$email_id					=	$_SESSION['current_login_admin'];
	
	if(isset($_POST['change_pwd_btn']))
	{
		$current_password	=	$_POST['current_password'];
		$new_password		=	$_POST['new_password'];
		$confirm_password	=	$_POST['confirm_password'];
		
		$db_password	=	$db->get_password_from_user_name($email_id);
		
		if($db_password=="")
		{
		?>
		<script>
			alert("This Admin Not Registerd With Us");
		</script>
		<?php
			
		}
		if($db_password==$current_password)
		{
			if($new_password==$confirm_password)
			{
				if($db->change_user_password($email_id,$new_password))
				{
					
					$SuccessMsg	=	1;
				}
			}
			else
			{
			?>
			<script>
				alert("Please Match Password With Confirm Password");
			</script>
		<?php
			}

		}
		else
			{
			?>
			<script>
				alert("Please Enter Correct Current Password");
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
  
    <!-- PLUGINS STYLES-->
    <!-- THEME STYLES-->
    <link href="css/main.min.css" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
<style>
.col-md-8
{
	width:100%;
	margin:auto;
	margin-top:20px;
}

@media only screen and (max-width: 600px) {
	.col-md-8
	{
		margin:30px;
		width:100%;
	}
	.alert
	{
		width:100%;
	}
	.side-row
	{
		width:49%;
		display:inline-table;
	}
}

</style>

<script>
function validateForm() {
  var current_password = document.forms["myForm"]["current_password"].value;
  var new_password = document.forms["myForm"]["new_password"].value;
  var confirm_password = document.forms["myForm"]["confirm_password"].value;
  if (current_password == "") {
    alert("Enter Current Password ");
    return false;
  }
  if (new_password == "") {
    alert("Enter New Password");
    return false;
  }
   if (confirm_password == "") {
    alert("Enter Confirm Password");
    return false;
  }
}
</script>
</head>

<body class="fixed-navbar">
    <div class="page-wrapper">
        <?php include('header.php'); ?>
        <?php include('side-bar.php'); ?>
			<div class="content-wrapper">
               <div class="row">
				 <div class="col-md-8">
                        <div class="ibox">
                            <form class="form-pink" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" name="myForm" onsubmit="return validateForm()" autocomplete="off">
								<?php
								if($SuccessMsg ==1)
								{
								?>
									<div class="alert alert-pink">
									<span class="alert-link">Success!</span>Your Password Changed Successfully.
									</div>
								<?php
								}
								?>	
								<?php
								if($SuccessMsg ==2)
								{
								?>
									<div class="alert alert-danger">
									<span class="alert-link">Sorry!</span> Failed To Change Password.
									</div>
								<?php
								}
								?>	
                                <div class="ibox-head">
                                    <div class="ibox-title"> <i class="sidebar-item-icon fas fa-user-cog"></i> Change Password</div>
                                </div>
                                <div class="ibox-body">
                                  <div class="form-group mb-4">
								  <label class="form-group mb-4 set-row"><b>Current Password</b></label>

									<div class="input-group-icon input-group-icon-left">
										<span class="input-icon input-icon-left"><i class="fas fa-lock"></i></span>
										<input type="password"  class="form-control form-control-air" placeholder="Enter Current Password" value="<?php echo $current_password; ?>" name="current_password"   />
									</div>
								</div>
								<div class="form-group mb-4">
								<label class="form-group mb-4 set-row"><b>New Password</b></label>
									<div class="input-group-icon input-group-icon-left">
										<span class="input-icon input-icon-left"><i class="fas fa-lock"></i></span>
										<input  type="password" class="form-control form-control-air" placeholder="Enter New Password" value="<?php echo $new_password; ?>" name="new_password"  />
									</div>
								</div>
								<div class="form-group mb-4">
								<label class="form-group mb-4 set-row"><b>Confirm New Password</b></label>
									<div class="input-group-icon input-group-icon-left">
										<span class="input-icon input-icon-left"><i class="fas fa-lock"></i></span>
										<input  type="password" class="form-control form-control-air" placeholder="Enter Confirm Password" value="<?php echo $confirm_password; ?>" name="confirm_password"  />
									</div>
								</div>		 
                                <div class="ibox-footer">
                                   <center> <button class="btn btn-pink btn-air mr-2" type="submit"name="change_pwd_btn">Change Password</button> </center>
                                   
                                </div>
                            </form>
                        
                        </div>
                    </div>
                </div>
                <?php include('footer.php'); ?>
			</div>
    </div>
    <?php include('search.php'); ?>
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
    <?php include('right-side-bar.php'); ?>
	
	
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