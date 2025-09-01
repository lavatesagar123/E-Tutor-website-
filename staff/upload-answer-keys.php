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
	$user_login		=	$_SESSION['user_login'];
	
	$db_mob_id 	= $db->get_user_id_by_contact($user_login);
	$dbemail_id = $db->get_user_id_by_email($user_login);
	
	
	
	if(isset($_GET['id']))
	{
		$id	=	$_GET['id'];
		$_SESSION['id'] = $id;
	}
	else if(isset($_SESSION['id']))
	{
		$id	= $_SESSION['id'];
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
						
						$img_Dir = "../answer-keys/";
						
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
		
		if($db_mob_id!="")
		{
			if($flag==0)
			{
				if($db->add_answer_key($id,$actual_image_name,$db_mob_id))
				{
					$success_msg = 1 ;
					
					$title 		= "";
					
				}
				else
				{
					$success_msg = 3 ;
				}
			}
			else
			{
				$success_msg = 2 ;
			}
		}
		elseif(dbemail_id!="")
		{
			if($flag==0)
			{
				if($db->add_answer_key($id,$actual_image_name,$dbemail_id))
				{
					$success_msg = 1 ;
					
					$title 		= "";
					
				}
				else
				{
					$success_msg = 3 ;
				}
			}
			else
			{
				$success_msg = 2 ;
			}
			
		}
		
		
		
	}
	
	
	if(isset($_GET['del']) AND ($_GET['attach']))
	{
		$del	=	$_GET['del'];
		$attach 	 	= $_GET['attach'];
		
		if($db->delete_answer_key($del))
		{
			unlink('../answer-keys/'.$attach);
			?>
				<script>
				alert("Answer Key Successfully Deleted...!!!");
				window.location.href="upload-answer-keys.php";
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

<div class="ibox col" style="border-radius:5px; padding:7px; margin:auto;">
	
	<form class="form-pink" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" name="myForm" onsubmit="return validateForm()" autocomplete="off" enctype="multipart/form-data">
		
		<div class="ibox-head">
			<div class="ibox-title"><i class="fas fa-plus-circle" style="margin-right:10px;"></i>Add Answers Keys</div>
			
		</div>
		
		<div class="ibox-body">
			<div class="row">
			
			<div class="col-sm-6 form-group mb-6">
				<label class="form-group mb-4 set-row"><b>Upload Attachment</b></label>
				<div class="input-group-icon input-group-icon-left  set-row">
					<span class="input-icon input-icon-left"><i class="fas fa-edit"></i></span>
					<input class="form-control form-control-air " placeholder="Upload" name="picture" type="file" required >
					<span style="color:red;"><?php echo $image_error; ?></span>
				</div>
			</div>			
			<div class="col-sm-6 form-group mb-6">
				<br />
				<br />
				<center><button class="btn btn-pink btn-air mr-2" type="submit" name="add_btn">Upload</button></center>
			</div>
		</div>
	</form>
	</div>
</div>
</div>

<div class="page-content fade-in-up">
<div class="ibox" style="border-radius:5px;padding:7px;">
	<div class="ibox-head">
		<div class="ibox-title">Answer Key Report</div>
		<a href="question-paper.php" class="btn btn-outline-danger btn-rounded waves-effect" style="font-style:italic;"><< Question Paper List </a>
	</div>	
	
	<div class="flexbox mb-4" style="margin-left:20px;margin-right:20px;margin-top:20px;">
		<div class="input-group-icon input-group-icon-left mr-3">
			<span class="input-icon input-icon-right font-16"><i class="fas fa-search"></i></span>
			<input class="form-control form-control-rounded form-control-solid" id="key-search" type="text" placeholder="Search ...">
		</div>
		
		
	</div>
	
	<div class="table-wrapper-scroll-y table-wrapper-scroll-x my-custom-scrollbar">

	<div class="table-responsive" id="table_response" style="height:100%; width:100%; overflow:auto;">
		<table class="table table-bordered table-hover" id="example" >
			<thead class="thead-default thead-lg">
				<tr>
					<th>Sr.No</th>
					<th>Question Paper Title</th>
					<th>Attachment</th>
					<th>Action</th>
					
				</tr>
			</thead>
			<tbody>
			<?php
			if($db_mob_id!="")
			{
				$data	=	array();
				$data	=	$db->get_all_answer_keys_details_for_user($db_mob_id,$id);
				
				if(!empty($data))
					{
						$counter =0;
						foreach($data as $record)
						{
							$id						=	$record[0];
							$res_question_id		=	$record[1];
							$res_attachment			=	$record[2];
							$res_user_id			=	$record[3];
							$res_date				=	$record[4];
							$res_time				=	$record[5];
							
							
							$date_data = explode("-",$res_date);
							$date = $date_data[2]."-".$date_data[1]."-".$date_data[0];
							
							$db_question_title	=	$db->get_question_paper_title($res_question_id);
							
							
							?>
							<tr> 
								<td><?php echo $counter+1; ?></td>
								<td><?php echo $db_question_title; ?></td>
								
								<?php
									if($res_attachment!="")
									{
									?>
									<td style="text-align:center;">
										<a href="../answer-keys/<?php echo $res_attachment; ?>" target="_blank"><img src="images/attachment.jpg" height="50px" width="50px"></a>
									</td>
									<?php
									}
									else
									{
									?>
									<td style="text-align:center;">
										<a href="icon/no-image.png" target="_blank"><img src="icon/no-image.png" height="50px" width="100px"></a>
									</td>
									<?php
									}
								?>
								
								<td>
									<a href="upload-answer-keys.php?del=<?php echo $id;?>&attach=<?php echo $res_attachment;?>" onclick="return confirm('Are You Sure to Delete this Answer Paper?');"><i class="fas fa-trash"style="color:red;margin-left:20px;"></i>
									</a>
								</td>
								
						<?php
						$counter++;
						}
						
					}
					
					else
					{
					?>
					<td>No Data Found...</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<?php
					}
			}
			elseif($dbemail_id!="")
			{
				$data	=	array();
				$data	=	$db->get_all_answer_keys_details_for_user($dbemail_id,$id);
				
				if(!empty($data))
					{
						$counter =0;
						foreach($data as $record)
						{
							$id						=	$record[0];
							$res_question_id		=	$record[1];
							$res_attachment			=	$record[2];
							$res_user_id			=	$record[3];
							$res_date				=	$record[4];
							$res_time				=	$record[5];
							
							
							$date_data = explode("-",$res_date);
							$date = $date_data[2]."-".$date_data[1]."-".$date_data[0];
							
							$db_question_title	=	$db->get_question_paper_title($res_question_id);
							
							
							?>
							<tr> 
								<td><?php echo $counter+1; ?></td>
								<td><?php echo $db_question_title; ?></td>
								
								<?php
									if($res_attachment!="")
									{
									?>
									<td style="text-align:center;">
										<a href="../answer-keys/<?php echo $res_attachment; ?>" target="_blank"><img src="images/attachment.jpg" height="50px" width="50px"></a>
									</td>
									<?php
									}
									else
									{
									?>
									<td style="text-align:center;">
										<a href="icon/no-image.png" target="_blank"><img src="icon/no-image.png" height="50px" width="100px"></a>
									</td>
									<?php
									}
								?>
								
								<td>
									<a href="upload-answer-keys.php?del=<?php echo $id;?>&attach=<?php echo $res_attachment;?>" onclick="return confirm('Are You Sure to Delete this Answer Paper?');"><i class="fas fa-trash"style="color:red;margin-left:20px;"></i>
									</a>
								</td>
								
						<?php
						$counter++;
						}
						
					}
					
					else
					{
					?>
					<td>No Data Found...</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<?php
					}
				
				
			}
				   ?>
				</tr> 
			</tbody> 
		</table> 
	</div>
	</div>
	</div>
</div>



</div>
</div>
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