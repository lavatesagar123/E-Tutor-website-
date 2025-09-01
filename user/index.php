<?php 
require_once('../admin/lib/functions.php');

$db		=	new login_function();


$email_error 	=	"";
$password_error	=	"";
$flag 			=	0 ;
$email_error_show=  "";
$email_id		=	"";
$password		=	"";
	/*if(isset($_GET['logout']))
	{
		unset($_SESSION['user_login']);	
	}
	if(isset($_SESSION['user_login']))
	{
		header("Location:dashboard.php");
	}*/
/*
	if(isset($_POST['login1']))
	{

	  $email_id 	  	= $_POST['email_id'];

	  $password       		= $_POST['password'];
	  
	    $db_password 		= $db->get_password_from_user_name($email_id);
	  
		if($db_password=="")
		{
			
			$email_error_show = 1;
			$flag = 1;
		}
		if($flag == 0)
		{
			if($db_password==$password)
			{
				$_SESSION['current_login_admin']=$email_id;
				
				?>
				<script>
				window.location="dashboard.php";
				</script>
				<?php
			}
			else
			{
				$password_error = 1;
				$flag = 2;
			}
		}
}*/

		if(isset($_POST['login']))
		{
			$user_id 	= $_POST['email_id'];
			$password	= $_POST['password'];
			
			$db_pass_mobile =	$db->get_user_password_by_mobile($user_id);
			
			if($db_pass_mobile!="")
			{
				if($db_pass_mobile==$password)
				{
					$_SESSION['user_login']=$user_id;

					?>
					<script>
					window.location="dashboard.php";
					</script>
					<?php
					
				}
				else
				{
					$success	=	2;
					$password_error = 1;
				}
				
			}
			else{
						?>
<script>
	alert("This user is not exist");
</script>
<?php	
				echo "This user is not exist";
			}
		}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Login Page</title>
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
.col-md-6
{
	margin:auto;
	margin-top:100px;
}

@media only screen and (max-width: 500px) {
	.col-md-6
	{
		margin:30px;
	}
}
</style>

<script>
function validateForm() {
  var x = document.forms["myForm"]["admin_email_id"].value;
  var y = document.forms["myForm"]["password"].value;
  if (x == "") {
    alert("Enter Username");
    return false;
  }
  if (y == "") {
    alert("Enter Password");
    return false;
  }
}
</script>

</head>

<body class="fixed-navbar">
    
               <div class="row">
                    <div class="col-md-6">
                        <div class="ibox">
                            <form class="form-pink" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" name="myForm" onsubmit="return validateForm()" autocomplete="off">
								<?php
								if($password_error ==1)
								{
								?>
									<div class="alert alert-danger">
									<span class="alert-link">Please!</span> Enter Correct Password.
									</div>
								<?php
								}
								?>	
								<?php
								if($email_error_show == 1)
								{
								?>
									<div class="alert alert-danger">
									<span class="alert-link">Please!</span> Enter Correct Email ID.
									</div>
								<?php
								}
								?>	
                                <div class="ibox-head">
                                    <div class="ibox-title">USER LOGIN</div>
                                </div>
                                <div class="ibox-body">
                                    <div class="form-group mb-4">
                                        <div class="input-group-icon input-group-icon-left">
                                            <span class="input-icon input-icon-left"><i class="fas fa-user"></i></span>
                                            <input class="form-control form-control-air" name="email_id"  placeholder="Username" value="<?php echo $email_id; ?>"  required />
                                        </div>
                                    </div>
                                    
                                    <div class="form-group mb-4">
                                        <div class="input-group-icon input-group-icon-left">
                                            <span class="input-icon input-icon-left"><i class="fas fa-lock"></i></span>
                                            <input class="form-control form-control-air" type="password" name="password" placeholder="Password"  value="<?php echo $password; ?>" required >
                                        </div>
                                    </div>
                                    
									
                                </div>
                                <div class="ibox-footer">
                                    <button class="btn btn-pink btn-air mr-2" type="submit" name="login">SIGN IN</button>
                                    <button class="btn btn-secondary" type="reset">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
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
    <!-- PAGE LEVEL PLUGINS-->
    <!-- CORE SCRIPTS-->
    <script src="js/app.min.js"></script>
    <!-- PAGE LEVEL SCRIPTS-->
</body>

</html>