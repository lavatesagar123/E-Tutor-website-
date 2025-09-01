<?php 
	require_once("lib/functions.php");
	$db 			= new login_function();
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
		$c_type 	= $_POST['c_type'];
		$title 		= $_POST['title'];
		$duration 	= $_POST['duration'];
		$mode 		= $_POST['mode'];
		$description= $_POST['description'];
		$fees 		= $_POST['fees'];
		$contact 	= $_POST['contact'];
		$valid_formats = array("pdf","PDF","jpg","JPG","png","PNG");
	
		if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
		{	
			$name 				= 	$_FILES['picture']['name'];
			$size 				= 	$_FILES['picture']['size'];

			if(strlen($name))
				{				
					list($txt, $ext) = explode(".", $name);
					
					if(in_array($ext,$valid_formats))
					{
						$files	=	array();

						function generateRandomString($length = 10) {
							$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
							$charactersLength = strlen($characters);
							$randomString = '';
							for ($i = 0; $i < $length; $i++) 
							{
								$randomString .= $characters[rand(0, $charactersLength - 1)];
							}
							return $randomString;
						}
						
						$current_random_string = generateRandomString();
						
						$actual_image_name = $current_random_string.".".strtolower($ext);						

						$tmp = $_FILES['picture']['tmp_name'];
						
						$img_Dir = "../gallery/";
						
						if(!file_exists($img_Dir))
						{
							mkdir($img_Dir);
						}
						
						if(move_uploaded_file($tmp,$img_Dir.$actual_image_name))
						{
							
						}
						else
						{
							$image_error	=	"failed" ;
							$flag				=	1;
						}	
					}
					else
					{
						$image_error	= "Invalid file format";
						$flag				=	1;	
					}	
				}	
		}
		if($c_type == "Select Courses Type")
		{
		?>
		<script type="text/javascript">
			alert("Please Select Courses Type");
		</script>
		<?php
			
			$flag = 1;
		}
		if($flag==0)
		{
			if($db->add_courses($c_type,$title,$duration,$mode,$description,$fees,$contact,$actual_image_name))
			{
				$success_msg = 1 ;
				$c_type 	= "";
				$title 		= "";
				$duration 	= "";
				$mode 		= "";
				$description= "";
				$fees 		= "";
				$contact 	= "";
			}
			else
			{
				$success_msg = 2 ;
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
	alert("Course Added Successfully");
	
</script>
<?php 
} 
if($success_msg == 2)
{
?>
<script type="text/javascript">
	alert("Failed To Add Course");
</script>
<?php 
} 
?>
<div class="ibox" style="border-radius:5px; padding:7px; margin:auto;">
	
	<form class="form-pink" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" name="myForm" onsubmit="return validateForm()" autocomplete="off" enctype="multipart/form-data">
		
		<div class="ibox-head">
			<div class="ibox-title"><i class="fas fa-plus-circle" style="margin-right:10px;"></i>Add Course Details</div>
			<a href="courses.php" class="btn btn-outline-danger btn-rounded waves-effect" style="font-style:italic;"><< Course Details Report </a>
		</div>
		
		<div class="ibox-body">
			<div class="row">
			<div class="col-sm-6 form-group mb-6">
			<label class="form-group mb-4 set-row"><b>Courses Type</b></label>
			<div class="input-group-icon input-group-icon-left  set-row">
				<span class="input-icon input-icon-left"><i class="fas fa-check"></i></span>
				 <select class="form-control" name="c_type" style="form-group mb-4 set-row">
				   <?php
						if($c_type != "")
						{
				   ?>
						<option value="<?php echo $c_type; ?>"><?php echo $c_type; ?></option>
				   <?php
						}
				   ?>
						<option value="Select Courses Type">Select Courses Type</option>
						<option value="Classroom Courses">Classroom Courses</option>
						<option value="Postal Courses">Postal Courses</option>
						<option value="Test Series">Test Series</option>
						<option value="Interview Guidence">Interview Guidence</option>
						<option value="Online Courses">Online Courses</option>
						<option value="Mentorship Courses">Mentorship Courses</option>
						<option value="Foundation Courses">Foundation Courses</option>
				   </select>
			</div>
			</div>		
			<div class="col-sm-6 form-group mb-6">
			<label class="form-group mb-4 set-row"><b>Enter Title</b></label>
			<div class="input-group-icon input-group-icon-left  set-row">
				<span class="input-icon input-icon-left"><i class="fas fa-edit"></i></span>
				 <input class="form-control form-control-air " placeholder="Enter Title" name="title" type="text" value="<?php echo $title; ?>" required >
				
			</div>
			</div>	
			<div class="col-sm-6 form-group mb-6">
			<label class="form-group mb-4 set-row"><b>Enter Duration</b></label>
			<div class="input-group-icon input-group-icon-left  set-row">
				<span class="input-icon input-icon-left"><i class="fas fa-edit"></i></span>
				 <input class="form-control form-control-air " placeholder="Enter Duration" name="duration" type="text" value="<?php echo $duration; ?>" required >
				
			</div>
			</div>
			<div class="col-sm-6 form-group mb-6">
			<label class="form-group mb-4 set-row"><b>Enter Mode</b></label>
			<div class="input-group-icon input-group-icon-left  set-row">
				<span class="input-icon input-icon-left"><i class="fas fa-edit"></i></span>
				 <input class="form-control form-control-air " placeholder="Enter Mode" name="mode" type="text" value="<?php echo $mode; ?>" required >
				
			</div>
			</div>	
			<div class="col-sm-6 form-group mb-6">
			<label class="form-group mb-4 set-row"><b>Enter Description</b></label>
			<div class="input-group-icon input-group-icon-left  set-row">
				<span class="input-icon input-icon-left"><i class="fas fa-edit"></i></span>
				 <input class="form-control form-control-air " placeholder="Enter Description" name="description" type="text" value="<?php echo $description; ?>" required >
				
			</div>
			</div>	
			<div class="col-sm-6 form-group mb-6">
			<label class="form-group mb-4 set-row"><b>Enter Fees</b></label>
			<div class="input-group-icon input-group-icon-left  set-row">
				<span class="input-icon input-icon-left"><i class="fas fa-edit"></i></span>
				 <input class="form-control form-control-air " placeholder="Enter Fees" name="fees" type="text" value="<?php echo $fees; ?>" required >
				
			</div>
			</div>
			<div class="col-sm-6 form-group mb-6">
			<label class="form-group mb-4 set-row"><b>Enter Contact Details</b></label>
			<div class="input-group-icon input-group-icon-left  set-row">
				<span class="input-icon input-icon-left"><i class="fas fa-edit"></i></span>
				 <input class="form-control form-control-air " placeholder="Enter Contact Details" name="contact" type="text" value="<?php echo $contact; ?>" required >
				
			</div>
			</div>		
			<div class="col-sm-6 form-group mb-6">
			<label class="form-group mb-4 set-row"><b>PDF</b></label>
			<div class="input-group-icon input-group-icon-left  set-row">
				<span class="input-icon input-icon-left"><i class="fas fa-edit"></i></span>
				 <input class="form-control form-control-air " placeholder="Enter picture" name="picture" type="file" required >
				
			</div>
			</div>			
			<div class="col-sm-12 form-group mb-12">
				<br />
				
				<center><button class="btn btn-pink btn-air mr-2" type="submit" name="add_btn">Add Course Details</button></center>
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