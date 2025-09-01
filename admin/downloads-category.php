<?php 
	require_once("lib/functions.php");
	$db = new login_function();
	$flag = 0;
	$title="";
	$success_msg = 0;
	$image_error="";
	$department_error="";
	$succ_flag= 0 ;
	$department = "";
	$title_error="";
	$succ_flag = 0;
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
		$title = $_POST['title'];
		if($flag==0)
		{
			$check_category = $db->check_category_exist_or_not($title);
			if($check_category == "")
			{
				if($db->new_downloads_category($title))
				{
					$success_msg = 1 ;
					$title = "";
					$description="";
				}
				
			}
			else
			{
				$success_msg=2;
			}
			
			
		}
	}
	if(isset($_GET['delete_id']))
	{
		 $del_id	=	$_GET['delete_id'];
		 $db->delete_download_category($del_id);
		 $success_msg	=	3;
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
  
<div class="page-wrapper" style="min-height:850px;">
<?php include('header.php'); ?>
<?php include('side-bar.php'); ?>
<div class="content-wrapper">
<div class="row" style="padding:0px; margin:0px; margin-top:15px; border-radius:15px;">
<?php 
if($success_msg == 1)
{
?>
<script type="text/javascript">
	alert("Download Category Added Successfully");
	
</script>
<?php 
} 
if($success_msg == 2)
{
?>
<script type="text/javascript">
	alert("Failed To Add Download Category");
</script>
<?php 
} 
?>
<div class="ibox" style="border-radius:5px; padding:7px; margin:auto;">
	
	<form class="form-pink" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" name="myForm" onsubmit="return validateForm()" autocomplete="off" enctype="multipart/form-data">
		
		<div class="ibox-head">
			<div class="ibox-title"><i class="fas fa-cloud-download-alt" style="margin-right:10px;"></i>Add Download Category</div>
		</div>
		
		<div class="ibox-body">
			<div class="row">
			
			<div class="col-sm-6 form-group mb-6">
			<label class="form-group mb-4 set-row"><b>Enter Title</b></label>
			<div class="input-group-icon input-group-icon-left  set-row">
				<span class="input-icon input-icon-left"><i class="fas fa-list"></i></span>
				 <input class="form-control form-control-air " placeholder="Enter Title" name="title" type="text" value="<?php echo $title; ?>" required >
				
			</div>
			</div>				
			<div class="col-sm-6 form-group mb-6">
				<br />
				
				<center><button class="btn btn-pink btn-air mr-2" type="submit" name="add_btn">Add Download Category</button></center>
			</div>
		</div>
	</form>
	</div>
</div>
   <?php 
		if($success_msg == 3)
		{
		?>
		<script type="text/javascript">
			alert("Download Category Deleted Successfully");
		</script>
	<?php 
		} 
	?>
	<div class="page-content fade-in-up" style="width:100%;">
	<div class="ibox">
		<div class="ibox-body">
			<h5 class="font-strong mb-4"> Download Category Report</h5>
			<div class="flexbox mb-4">
				<div class="input-group-icon input-group-icon-left mr-3">
					<span class="input-icon input-icon-right font-16"><i class="fas fa-search"></i></span>
					<input class="form-control form-control-rounded form-control-solid" id="key-search" type="text" placeholder="Search ...">
				</div>
			</div>
			<div class="table-responsive row">
			<table class="table table-bordered table-hover" id="example" style="overflow-x:auto;overflow-y:auto;">
				<thead class="thead-default thead-lg">
					<tr>
						<th>SR</th> 
						<th>Title</th> 
						<th>Edit</th> 
						<th>Delete</th> 
					</tr>
				</thead>
				<tbody>
				<?php
					$report_details = $db->get_all_download_category();
					if(!empty($report_details))
					{
						$counter =0;
						foreach($report_details as $record)
						{
							$id				=	$report_details[$counter][0];
							$title			=	$report_details[$counter][1];
							
				?>
				<tr> 
					<td><?php echo $counter+1; ?></td>
					<td><?php echo $title; ?></td>
					<td><a href="edit-download-category.php?up_id=<?php echo $id;?>"><i class="fas fa-edit"style="color:blue;margin-left:20px;"></a></td>
					<td><a href="downloads-category.php?delete_id=<?php echo $id; ?>" onclick="return confirm('Are you Sure to Delete this Record?');"><i class="fas fa-trash"style="color:red;margin-left:20px;"></i></td>
													
				</tr> 
				<?php
						$counter++;		
						}
					}
					?>
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