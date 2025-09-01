 <?php 
	require_once("lib/functions.php");
	$db 		= new login_function();
	$flag 		= 0;
	$actual_image_name="";
	$success_msg = 0;
	$image_error="";
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
		$valid_formats = array("jpg","png","gif","bmp","jpeg","pdf","JPEG","JPG","BMP","PNG","GIF","PDF");
	
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
		
		if($flag==0)
		{
			$db->new_images($actual_image_name);
			$flag = 1 ;
		}
	}
	if(isset($_GET['delete_id']))
	{
		 $del_id	=	$_GET['delete_id'];
		
		 $db->delete_feedback($del_id);
		
		 $success_msg	=	2;
	}
	
	if(isset($_GET['pending_id']))
	{
	
		 $pending_id	=	$_GET['pending_id'];
		
		 $db->pending_testimonial($pending_id);
		
		
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
	 <link href="datatable/datatables.min.css" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
<style>
.col-md-12
{
	width:100%;
	margin:auto;
	margin-top:20px;
}
table,th,td
{
	text-align:center;
}
@media only screen and (max-width: 600px) {
	.col-md-12
	{
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

<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
</head>
<body class="fixed-navbar">

<div class="page-wrapper" style="min-height:800px;">

<?php include('header.php'); ?>
<?php include('side-bar.php'); ?>

<div class="content-wrapper">
<div class="page-content fade-in-up">
<?php 
if($success_msg == 2)
{
?>
<script type="text/javascript">
	alert("Record Deleted Successfully");
</script>
<?php 
} 
?>
<div class="ibox" style="border-radius:5px; padding:7px;">

<div class="ibox-body" style="padding:7px; padding-top:0px;">
	
	<div class="ibox-head">
		<div class="ibox-title"><i class="fas fa-clock" style="margin-right:10px;"></i>Testimonial Pending Report</div>
	</div>
	
	<br />
		
	<div class="flexbox mb-4">
		<div class="input-group-icon input-group-icon-left mr-3">
			<span class="input-icon input-icon-right font-16"><i class="fas fa-search"></i></span>
			<input class="form-control form-control-rounded form-control-solid" id="key-search" type="text" placeholder="Search ...">
		</div>
	</div>
	
<div class="table-responsive row">
	<table class="table table-bordered table-hover" id="example" style="overflow-x:auto;overflow-y:auto;" cellpadding=0 cellspacing=0>
		<thead class="thead-default thead-lg">
			<tr>
			  <th>Sr.No</th>
			  <th>Name</th>
			  <th>Email</th>
			  <th>Contact No</th>
			  <th>Feedback</th>
			  <th>Profile</th>
			  <th>Status</th>
			  <th>Action</th>
            </tr>
		</thead>
		<tbody>
		<?php
			$report_details = $db->get_all_feedback();
			if(!empty($report_details))
			{
				$counter =0;
				foreach($report_details as $record)
				{
					$id				=	$report_details[$counter][0];
					$name			=	$report_details[$counter][1];
					$email			=	$report_details[$counter][2];
					$contact		=	$report_details[$counter][3];
					$feedback		=	$report_details[$counter][4];
					$status			=	$report_details[$counter][5];
					$profile		=	$report_details[$counter][6];
							
		?>
			<tr> 
			<td><?php echo $counter+1; ?></td>
			<td><?php echo $name; ?></td>
			<td><?php echo $email; ?></td>
			<td><?php echo $contact; ?></td>
			<td><?php echo $feedback; ?></td>
			<td><a href="../profile/<?php echo $profile; ?>" target="_blank"><img src="../profile/<?php echo $profile; ?>" height="50" width="50"></a></td>
			<td><a href="testimonial-pending.php?pending_id=<?php echo $id; ?>"><i class="fas fa-clock"style="color:red;margin-left:20px;"></i></a></td>
			<td><a href="testimonial-pending.php?delete_id=<?php echo $id;?>" onclick="return confirm('Are you sure?');"><i class="fas fa-trash"style="color:red;margin-left:20px;"></i></a></td>
		<?php
			$counter++;
		}
			
	}
	else
	{
	?>
	<tr >
	<td colspan="8"> NO Data Available </td>
	<tr>
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
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		
<script>

$( function()  {
		$( "#from_date" ) .datepicker({ dateFormat: 'dd-mm-yy'   }) ;
		$( "#to_date" ) .datepicker({ dateFormat: 'dd-mm-yy'   }) ;
		
}  ) ;
		


</script>
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
<script src="datatable/datatables.min.js"></script>
<script src="js/app.min.js"></script>
<script>
$(function() {
	$('#example').DataTable({
		pageLength: 20,
		fixedHeader: true,
		responsive: true,
		"sDom": 'rtip',
		columnDefs: [{
			targets: 'no-sort',
			orderable: false
		}]
	});

	var table = $('#example').DataTable();
	$('#key-search').on('keyup', function() {
		table.search(this.value).draw();
	});
  
});

</script>


	
    <!-- PAGE LEVEL SCRIPTS-->
</body>

</html>