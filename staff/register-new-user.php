 
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
	
	$flag			=	0;
	$email_error	=	"";
	$password_error	=	"";
	$full_name		=   "";
	$email_id	    =	"";
	$mobile_no      =   "";
	$password       =   "";
	$reference_id   =   "";
	$success_msg 	= 	0;
	$SuccessMsg  	=	0;
	$application_name=	"";
	$token			=	"";
	if(isset($_POST['add']))
	{
		$full_name		=	$_POST['full_name'];
		$email_id	    =	$_POST['email'];
		$mobile_no      =   $_POST['mobile_number'];
		$password       =   $_POST['password'];
		$reference_id   =   $_POST['ref_mob_no'];
		
		if(isset($_POST['application_name']))
		{
			$application_name = $_POST['application_name'];
		}
		else
		{
			echo $app_id;
			$application_name = $app_id;
		}
		$db_password =	$db->get_user_password($mobile_no);
		$get_name	 =  $db->get_full_name_from_user_table_for_val($full_name);
		
		if(!is_numeric($mobile_no))
		{
		    $success_msg = 6;
		}
		else if(strlen($mobile_no)!=10)
		{
		    $success_msg = 4;
		}
		else if($reference_id!="" AND strlen($reference_id)!=10)
		{
		    $success_msg = 5;
		}
		else
		{
			if($db_password!="")
    		{			
    			$success_msg = 3;
    		}
    		else if($get_name!="")
    		{
    			$success_msg = 3;
    		}
    		else
    		{
                if($db->register_new_agent($full_name,$email_id,$mobile_no,$password,$reference_id,$token,$current_login_admin,$application_name))
                {
                    $success_msg = 1;
                }
                else
                {
                    $success_msg = 2;
                }
    		}
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

<div class="ibox" style="border-radius:5px; padding:7px;">
	
	<form class="form-pink" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" name="myForm" onsubmit="return validateForm()" autocomplete="off" enctype="multipart/form-data">
		
		<div class="ibox-head">
			<div class="ibox-title"><i class="fas fa-user-tie" style="margin-right:10px;"></i>Add New User</div>
		</div>
		
		<div class="ibox-body">
			<div class="row">
				<div class="col-sm-4 form-group mb-4">
					<label class="form-group mb-4 set-row label_marg"><b>Select Apllication</b></label>
					<div class="input-group-icon input-group-icon-left  set-row">
						<span class="input-icon input-icon-left"><i class="fa fa-check"></i></span>
						
						<?php
						if($app_id==1)
						{
						?>
						
						<select name="application_name" class="form-control">
						<option value="Select Apllication" <?php if($application_name=="Select Apllication") { ?> Selected <?php } ?> >Select Apllication</option>
						<?php

							$app_data	=	array();
							
							$app_data	=	$db->get_all_franchise_records();
							
							if(!empty($app_data))
							{
								$counter	=	0;
								
								foreach($app_data as $record)
								{
									$res_id			=	$record[0];
									$res_name		=	$record[1];
									$res_login_id	=	$record[5];
									$res_application_name=	$record[4];
							?>
							<option value="<?php echo $res_id; ?>" <?php if($application_name==$res_id) { ?> Selected <?php } ?>><?php echo $res_application_name; ?></option>
							<?php
								$counter++;
								}
							}echo $app_id;
							?>
						</select>
						<?php
						}
						else
						{
						?>
						<select name="application_name" class="form-control">
						<?php
						echo $app_id;
						$data	=	array();
						$data	=	$db->get_franchises_details_by_id($app_id);
						if(!empty($data))
						{
							$res_id			=	$data[0];
							$res_application_name	=	$data[4];
							
						}
						?>
						<option value="<?php echo $res_id; ?>" <?php if($application_name==$res_id) { ?> Selected <?php } ?>><?php echo $res_application_name; ?></option>
						</select>	
						<?php
						}
						?>
					</div>
				</div>
				
				<div class="col-sm-4 form-group mb-4">
					<label class="form-group mb-4 set-row label_marg"><b>Enter Full Name</b></label>
					<div class="input-group-icon input-group-icon-left  set-row">
						<span class="input-icon input-icon-left"><i class="fas fa-edit"></i></span>
						<input type="text" name="full_name" class="form-control form-control-air" value="<?php echo $full_name; ?>" placeholder="Enter Full Name" required  />
					</div>
				</div>
				
				<div class="col-sm-4 form-group mb-4">
					<label class="form-group mb-4 set-row label_marg"><b>Enter Email ID (Optional)</b></label>
					<div class="input-group-icon input-group-icon-left  set-row">
						<span class="input-icon input-icon-left"><i class="fas fa-edit"></i></span>
						<input type="text" name="email" class="form-control form-control-air" value="<?php echo $email_id; ?>" placeholder="Enter Email ID (Optional)"   />
					</div>
				</div>
				
				 <div class="col-sm-4 form-group mb-4">
					<label class="form-group mb-4 set-row label_marg"><b>Enter Mobile Number</b></label>
					<div class="input-group-icon input-group-icon-left  set-row">
						<span class="input-icon input-icon-left"><i class="fas fa-edit"></i></span>
						<input type="number" name="mobile_number" class="form-control form-control-air" value="<?php echo $mobile_no; ?>" placeholder="Enter Mobile Number"  required />
					</div>
				</div>
				
				<div class="col-sm-4 form-group mb-4">
					<label class="form-group mb-4 set-row label_marg"><b>Enter Reference Mobile No</b></label>
					<div class="input-group-icon input-group-icon-left  set-row">
						<span class="input-icon input-icon-left"><i class="fas fa-edit"></i></span>
						<input type="number" name="ref_mob_no" class="form-control form-control-air" value="<?php echo $reference_id; ?>" placeholder="Reference Mobile Number (Optional)"   />
					</div>
				</div>
				
				<div class="col-sm-4 form-group mb-4">
					<label class="form-group mb-4 set-row label_marg"><b>Enter Password</b></label>
					<div class="input-group-icon input-group-icon-left  set-row">
						<span class="input-icon input-icon-left"><i class="fas fa-edit"></i></span>
						<input type="password" name="password" class="form-control form-control-air" value="<?php echo $password; ?>" placeholder="Enter password"  required/>
					</div>
				</div>
				
				<div class="col-sm-12 form-group mb-12" style="text-align:center; padding-left:0px; padding-right:0px; padding-top:20px;">
					<div class="col-sm-4 form-group mb-4" style="margin:auto;">
						<button class="btn btn-pink btn-air" type="submit" name="add" style="width:100%;">Register New User</button>
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