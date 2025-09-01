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
	if(isset($_POST['submit']))
	{	
		$title 				= 	$_POST['title'];
		
		if($flag==0)
		{
			if($db->update_question($up_id,$title))
			{
				$success_msg = 1 ;
			}
		}
	}
	if(isset($_POST['add_btn']))
	{	
		
		
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
						
						$img_Dir = "../question-papers/";
						
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
		
		if($flag==0)
		{
			
				if($db->update_question_paper($up_id,$actual_image_name))
				{
					$success_msg = 1 ;
					
					$title 		= "";
					
				}
				else
				{
					$success_msg = 3 ;
				}
			
			
		}
	}
	$record = $db->get_question_paper_by_id($up_id);
	if(!empty($record))
	{
		
		$id						=	$record[0];
		$title					=	$record[1];
		$attachment				=	$record[2];
	
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
	alert("Question Updated Successfully");
	
</script>
<?php 
} 
if($success_msg == 2)
{
?>
<script type="text/javascript">
	alert("Failed To Update Question");
</script>
<?php 
} 
?>
<div class="ibox" style="width:100%; border-radius:5px; padding:7px; margin:auto;">
	
	<form class="form-pink" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" name="myForm" onsubmit="return validateForm()" autocomplete="off" enctype="multipart/form-data">
		
		<div class="ibox-head">
			<div class="ibox-title"><i class="fas fa-cloud-download-alt" style="margin-right:10px;"></i>Edit Question</div>
			<a href="question-paper.php" class="btn btn-outline-danger btn-rounded waves-effect" style="font-style:italic;"><< Question Report </a>
		</div>
		
		<div class="ibox-body">
			<div class="row">
			

			<div class="col-lg-12">
			<form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?> " enctype="multipart/form-data" autocomplete="off">
				<div class="col-sm-6 form-group mb-6">
				<label class="form-group mb-4 set-row"><b>Enter Title</b></label>
				<div class="input-group-icon input-group-icon-left  set-row">
					<span class="input-icon input-icon-left"><i class="fas fa-edit"></i></span>
					<input class="form-control form-control-air " placeholder="Enter Title" name="title" type="text" value="<?php echo $title; ?>" required >
				
				</div>
				</div>
				<div class="form-group col-lg-12" style="text-align:center;">
					<button type="submit" class="btn btn-success" name="submit">Update Record</button>
				</div>
				</div>
			</form>
			</div>	
			</div>	
			
			
			<div class="ibox-body">
			<div class="row">
			

			<div class="col-lg-12">
			<form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?> " enctype="multipart/form-data" autocomplete="off">
				<div class="form-group col-lg-4" style="text-align:center;">
					<label>Edit/Update Pdf:</label><br />
					
					<?php
						if($attachment!="")
						{
						?>
						
							<a href="../question-papers/<?php echo $attachment; ?>" target="_blank"><img src="images/attachment.jpg" height="50px" width="50px"></a>
						<?php
						}
						else
						{
						?>
							<a href="icon/no-image.png" target="_blank"><img src="icon/no-image.png" height="50px" width="100px"></a>
						<?php
						}
					?>
					<input type="file" name="picture" value="<?php echo $attachment; ?>" class="form-control"><br />
					
					<div class="form-group col-lg-12" style="text-align:center;">
						<button type="submit" class="btn btn-pink" name="add_btn">Update Record</button>
					</div>
				</div>
			</form>
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