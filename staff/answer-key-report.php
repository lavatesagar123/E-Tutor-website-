<?php 
	require_once('../admin/lib/functions.php');
	$db		=	new login_function();
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
	if(isset($_SESSION['staff_login']))
	{
		$staff_login	=	$_SESSION['staff_login'];
	}
	if(!isset($_SESSION['staff_login']))
	{	
		header("location:../index.php");
	}
	
	if(isset($_POST['add_btn']))
	{	
		$title 		= $_POST['title'];
		
		$db_title_id	=	$db->get_title_exists($title);
		
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
			if($db_title_id=="")
			{
				if($db->add_question_paper($title,$actual_image_name))
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
		
		if($db->delete_question_paper($del))
		{
			unlink('../question-papers/'.$attach);
			?>
				<script>
				alert("Question Paper Successfully Deleted...!!!");
				window.location.href="question-paper.php";
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

<div class="page-content fade-in-up">
<div class="ibox" style="border-radius:5px;padding:7px;">
	<div class="ibox-head">
		<div class="ibox-title">Answer Key Report</div>
		
	</div>	
	
	<div class="flexbox mb-4" style="margin-left:20px;margin-right:20px;margin-top:20px;">
		<div class="input-group-icon input-group-icon-left mr-3">
			<span class="input-icon input-icon-right font-16"><i class="fas fa-search"></i></span>
			<input class="form-control form-control-rounded form-control-solid" id="key-search" type="text" placeholder="Search ...">
		</div>
		
		
	</div>
	
	<div class="table-wrapper-scroll-y table-wrapper-scroll-x my-custom-scrollbar">

	<div class="table-responsive" id="table_response" style="height:600px; width:100%; overflow:auto;">
		<table class="table table-bordered table-hover" id="example" >
			<thead class="thead-default thead-lg">
				<tr>
					<th>Sr.No</th>
					<th>Title</th> 
					<th>Attachment</th>
					<th>Action</th>
					
				</tr>
			</thead>
			<tbody>
			<?php
				$data	=	array();
				$data	=	$db->get_all_question_paper_details();
				
				if(!empty($data))
					{
						$counter =0;
						foreach($data as $record)
						{
							$id						=	$record[0];
							$res_title				=	$record[1];
							$res_attachment			=	$record[2];
							$res_date				=	$record[3];
							$res_time				=	$record[4];
							
							
							$date_data = explode("-",$res_date);
							$date = $date_data[2]."-".$date_data[1]."-".$date_data[0];
							
							?>
							<tr> 
								<td><?php echo $counter+1; ?></td>
								<td><?php echo $res_title; ?></td>
								
								<?php
									if($res_attachment!="")
									{
									?>
									<td>
										<a href="../question-papers/<?php echo $res_attachment; ?>" target="_blank"><img src="images/attachment.jpg" height="50px" width="50px"></a>
									</td>
									<?php
									}
									else
									{
									?>
									<td>
										<a href="icon/no-image.png" target="_blank"><img src="icon/no-image.png" height="50px" width="100px"></a>
									</td>
									<?php
									}
								?>
								<td>
									<a href="user_answer_key_details.php?edit_id=<?php echo $id;?>" style="color:green;">View Details</a>
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