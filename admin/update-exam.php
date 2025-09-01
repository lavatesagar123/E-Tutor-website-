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
	
	if(isset($_GET['up_id']))
		{
			$up_id	=	$_GET['up_id'];
			$_SESSION['up_id'] = $up_id;
		}
		else if(isset($_SESSION['up_id']))
		{
			$up_id	= $_SESSION['up_id'];
		}
		
		if(isset($_GET['image']))
		{
			$image  = $_GET['image'];	
			$db->update_exam_pdf_file($up_id);
			unlink('exam_attachment/'.$image);
				
		}
		
		
		if(isset($_GET['edit_id']))
		{
			$edit_id	=	$_GET['edit_id'];
			$_SESSION['edit_id'] = $edit_id;
		}
		 else if(isset($_SESSION['edit_id']))
		{
			$edit_id	= $_SESSION['edit_id'];
		}
		
		$flag=0;
		$scheme="";
		$title="";
		$instruction="";
		$hour="";
		$minutes="";
		$time_section="";
		$attachment="";
	
		if(isset($_POST['update']))
		{	
			$scheme			= $_POST['scheme'];
			$title	 		= $_POST['title'];
			$instruction 	= $_POST['instruction'];
			$hour	 		= $_POST['hour'];
			$minutes		= $_POST['minutes'];
			$time_section 	= $_POST['time_section'];
			
			$db_exam_title	=	$db->get_exam_exist_to_update($title,$edit_id);
			
			if($db_exam_title=="")
			{
					if($db->update_exam($scheme,$title,$hour,$minutes,$time_section,$instruction,$edit_id))
					{
					?>
						<script>
						alert("Exam Updated Successfully...!!!");
						window.location.href="exam-report.php";
						</script>
					<?php
						
					}
					
			}
			else
			{
					?>
					<script>
					alert("Exam Failed to Update...!!! Already Exist");
					</script>
				<?php
					
			}
		}
	
	
	$record	=	array();
	$record = $db->get_exam_details_by_id($edit_id);
	
	if(!empty($record))
	{
		$id						=	$record[0];
		$res_scheme				=	$record[1];
		$res_title				=	$record[2];
		$res_hour				=	$record[3];
		$res_minutes			=	$record[4];
		$res_time_section		=	$record[5];
		$res_instruction		=	$record[6];
		$res_attachment			=	$record[7];
		
	}
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Update Exam</title>
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
	  var a = document.forms["myForm"]["scheme"].value;
	  var b = document.forms["myForm"]["title"].value;
	  var d = document.forms["myForm"]["hour"].value;
	  var e = document.forms["myForm"]["minutes"].value;
	  var f = document.forms["myForm"]["time_section"].value;
	  var c = document.forms["myForm"]["instruction"].value;
	 var g = document.forms["myForm"]["attachment"].value;
	  if (a == "") {
		alert("Select Scheme Pattern of Exam");
		return false;
	  }
	  if (b == "") {
		alert("Enter  Title");
		return false;
	  }
	 
	   if (d == "Select") {
		alert("Enter Hour");
		return false;
	  }
	   if (e == "Select") {
		alert("Enter Minutes");
		return false;
	  }
	   if (f == "Select") {
		alert("Select  AM or PM");
		return false;
	  }
	   if (c == "") {
		alert("Enter Instruction");
		return false;
	  }
	   if (g == "") {
		alert("Upload PDF Attachment");
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
			<div class="ibox-head">
				<div class="ibox-title"><i class="fas fa-edit" style="margin-right:10px;"></i>UPDATE EXAM</div>
				
			</div>
		<div class="row">
		<div class="col-sm-8" style="border-radius:5px; padding-left:50px;">
		<form class="form-pink" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" name="myForm" onsubmit="return validateForm()" autocomplete="off" enctype="multipart/form-data">
			<div class="ibox-body">	
				<div class="row">
					<div class="col-sm-4 col-md-4 col-lg-4 form-group mb-4">
						<label class="form-group mb-4 set-row label_marg"><b>Select Scheme :</b></label>
							
						<div class="input-group-icon input-group-icon-left  set-row">
							<label class="radio-inline">
							  <input type="radio" name="scheme" value="Paid" <?php if($res_scheme=="Paid") { ?> Checked <?php } ?> >Paid
							</label>
							<label class="radio-inline">
							  <input type="radio" name="scheme" value="Free"<?php if($res_scheme=="Free") { ?> Checked <?php } ?> >Free
							</label>
						</div>
					</div>
					<div class="col-sm-8 col-md-8 col-lg-8 form-group mb-8">
						<label class="form-group mb-4 set-row label_marg"><b>Enter Title</b></label>
						<div class="input-group-icon input-group-icon-left  set-row">
							<span class="input-icon input-icon-left"><i class="fas fa-angle-double-right"></i></span>
							<input class="form-control form-control-air" name="title" id="title" placeholder="Enter Title" value="<?php echo $res_title; ?>" >
						</div>
					</div>
					<div class="col-sm-4 col-md-4 col-lg-4 form-group mb-4">
						<label class="form-group mb-2 set-row label_marg"><b>Hrs</b></label>
						<div class="input-group-icon input-group-icon-left  set-row">
							<span class="input-icon input-icon-left"><i class="fas fa-angle-double-right"></i></span>
								<select name="hour" id="hour" class="form-control form-control-air">
									<option value="Select" <?php if($res_hour=="Select") { ?> Selected <?php } ?> >Select</option>
									<option value="0" <?php if($res_hour=="0") { ?> Selected <?php } ?> >0</option>
									<option value="1" <?php if($res_hour=="1") { ?> Selected <?php } ?> >1</option>
									<option value="2" <?php if($res_hour=="2") { ?> Selected <?php } ?> >2</option>
									<option value="3" <?php if($res_hour=="3") { ?> Selected <?php } ?> >3</option>
									<option value="4" <?php if($res_hour=="4") { ?> Selected <?php } ?> >4</option>
									<option value="5" <?php if($res_hour=="5") { ?> Selected <?php } ?> >5</option>
									<option value="6" <?php if($res_hour=="6") { ?> Selected <?php } ?> >6</option>
									<option value="7" <?php if($res_hour=="7") { ?> Selected <?php } ?> >7</option>
									<option value="8" <?php if($res_hour=="8") { ?> Selected <?php } ?> >8</option>
									<option value="9" <?php if($res_hour=="9") { ?> Selected <?php } ?> >9</option>
									
								</select>
						</div>
					</div>
					<div class="col-sm-4 col-md-4 col-lg-4 form-group mb-4">
						<label class="form-group mb-2 set-row label_marg"><b>Min</b></label>
						<div class="input-group-icon input-group-icon-left  set-row">
							<span class="input-icon input-icon-left"><i class="fas fa-angle-double-right"></i></span>
								<select name="minutes" id="minutes" class="form-control form-control-air">
									<option value="Select" <?php if($res_minutes=="Select") { ?> Selected <?php } ?> >Select</option>
									<option value="00" <?php if($res_minutes=="00") { ?> Selected <?php } ?> >00</option>
									<option value="15" <?php if($res_minutes=="15") { ?> Selected <?php } ?> >15</option>
									<option value="30" <?php if($res_minutes=="30") { ?> Selected <?php } ?> >30</option>
									<option value="45" <?php if($res_minutes=="45") { ?> Selected <?php } ?> >45</option>
									
								</select>
						</div>
					</div>
					<div class="col-sm-4 col-md-4 col-lg-4 form-group mb-4">
						<label class="form-group mb-4 set-row label_marg"><b>AM / PM</b></label>
						<div class="input-group-icon input-group-icon-left  set-row">
							<span class="input-icon input-icon-left"><i class="fas fa-angle-double-right"></i></span>
								<select name="time_section" id="time_section" class="form-control form-control-air">
									<option value="Select" <?php if($res_time_section=="Select") { ?> Selected <?php } ?> >Select</option>
									<option value="AM" <?php if($res_time_section=="AM") { ?> Selected <?php } ?> >AM</option>
									<option value="PM" <?php if($res_time_section=="PM") { ?> Selected <?php } ?> >PM</option>
								</select>
						</div>
					</div>
					<div class="col-sm-12 col-md-12 col-lg-12 form-group mb-12">
						<label class="form-group mb-4 set-row label_marg"><b>Instruction</b></label>
						<div class="input-group-icon input-group-icon-left  set-row">
							<span class="input-icon input-icon-left"><i class="fas fa-angle-double-right"></i></span>
							<textarea placeholder="Enter Instruction" type="text" name="instruction" id="instruction" class="form-control form-control-air"><?php echo $res_instruction; ?></textarea>
						</div>
					</div>
					
					<div class="col-sm-12 form-group mb-12" style="text-align:center; padding-left:0px; padding-right:0px; padding-top:20px;">
					<div class="col-sm-4 form-group mb-4" style="margin:auto;">
						<button class="btn btn-pink btn-air" type="submit" name="update" style="width:100%;" onclick="submitData()">Update</button>
					</div>
				</div>
				</div>
				</div>
		</form>
		</div>
		<div class="col-sm-4" style="border-radius:5px; padding:50px;">
				<?php
								$flag=0;
								$attachment="";
								if(isset($_POST['update_attach']))
								{
									$valid_formats = array("pdf","PDF");
			
									if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
									{	
										$name 				= 	$_FILES['attachment']['name'];
										$size 				= 	$_FILES['attachment']['size'];

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
													
													$actual_image = $current_random_string.".".strtolower($ext);						

													$tmp = $_FILES['attachment']['tmp_name'];
													
													$img_Dir = "exam_attachment/";
													
													if(!file_exists($img_Dir))
													{
														mkdir($img_Dir);
													}
													
													if(move_uploaded_file($tmp,$img_Dir.$actual_image))
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
									
										unlink('exam_attachment/'.$res_attachment);
										if($db->update_exam_attachment($actual_image,$id))
										{
										?>
											<script>
											alert("Exam Attachment Updated Successfully...!!!");
											window.location.href="exam-report.php";
											</script>
										<?php
											
										}
									}
									else
									{
									?>
										<script>
										alert("Failed..!!! Upload PDF File");
										window.location.href="exam-report.php";
										</script>
									<?php
										
									}
								}
								?>
				<form class="form-pink" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" name="myForm" onsubmit="return validateForm()" autocomplete="off" enctype="multipart/form-data" >
					<div class="input-group-icon input-group-icon-left  set-row">
										<?php
											if($res_attachment!= "")
											{
											?>
											<a href="exam_attachment/<?php echo $res_attachment; ?>" target="_blank"><img src="images/pdf.png" height="50px" width="50px"></a><br />
											<label><a href="update-exam.php?up_id=<?php echo $id; ?>&image=<?php echo $res_attachment; ?>" onclick="return confirm('Are You Sure to Remove this Attachment');" style="font-size:12px;color:red;">Remove Attachment</a></label>
										
											<?php
											}
											else
											{
											?>
											<img src="icon/no-image.png" height="50px" width="200px">

											<?php
											}
										?>
									</div>
									<label class="form-group set-row label_marg"><b>Upload</b></label>
									<div class="input-group-icon input-group-icon-left  set-row">
										<span class="input-icon input-icon-left"><i class="fas fa-cloud-upload-alt"></i></span>
										<input class="form-control form-control-air " placeholder="Upload Image" name="attachment" type="file" required>
									</div>
									<button class="btn btn-pink btn-air"  style="margin:auto;margin-top:10px;width:100%;" type="submit" name="update_attach" onclick="submitData()" style="width:100%;">Update Attachment</button>
							</form>
			
			</div>
			
		</div>
		<center>
				<a href="exam-report.php" class="btn btn-outline-danger btn-rounded waves-effect"><i class="fas fa-angle-double-left">&nbsp;&nbsp;</i>Exam Report</a>
			</center>
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