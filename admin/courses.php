<?php 
	require_once("lib/functions.php");
	$db = new login_function();
	$flag = 0;
	$actual_image_name="";
	$success_msg = 0;
	$image_error="";
	$department_error="";
	$succ_flag= 0 ;
	$department = "";
	$description="";
	$succ_flag = 0;
	if(!isset($_SESSION['current_login_admin']))
	{
		header("Location:/admin/index.php");
	}
	if(isset($_SESSION['current_login_admin']))
	{
		$email	=	$_SESSION['current_login_admin'];
	}
	if(isset($_GET['delete_id']))
	{
		$del_id	=	$_GET['delete_id'];
		$db->delete_courses($del_id);
		$success_msg	=	2;
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
		<div class="ibox-title"><i class="fas fa-list" style="margin-right:10px;"></i> Courses Details Report</div>
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
				<th>Section</th>
				<th>Title</th>
                <th>Duration</th>
				<th>Mode</th>
				<th>Description</th>
				<th>Fees</th>
				<th>Contact Details</th>
				<th>View Details</th>
                <th>Action</th>
				<th>Action</th>
            </tr>
		</thead>
		<tbody>
		<?php
			$report_details = $db->get_all_course_info();
			if(!empty($report_details))
			{
				$counter =0;
				foreach($report_details as $record)
				{
					$id				=	$report_details[$counter][0];
					$c_section		=	$report_details[$counter][1];
					$title			=	$report_details[$counter][2];
					$duration		=	$report_details[$counter][3];
					$mode			=	$report_details[$counter][4];
					$description	=	$report_details[$counter][5];
					$fees			=	$report_details[$counter][6];
					$contact_no		=	$report_details[$counter][7];
					$image			=	$report_details[$counter][8];
							
		?>
			<tr> 
				 <td><?php echo $counter+1; ?></td>
				<td><?php echo $c_section; ?></td>
				<td><?php echo $title; ?></td>
				<td><?php echo $duration; ?></td>
				<td><?php echo $mode; ?></td>
				<td><?php echo $description; ?></td>
				<td><?php echo $fees; ?></td>
				<td><?php echo $contact_no; ?></td>
				<td>
				<?php
				if($image != "")
				{
					list($txt, $ext) = explode(".", $image);
					if($ext=="pdf")
					{
			
				?>
				<a href="../gallery/<?php echo $image; ?>" target="_blank"><img src="../images/pdfimg.jpg" height="50px" width="50px"></a>

				<?php
					}
				}else
				{
				?>
				<img src="icon/no_image_available.png" style="height:50px;width:50px;" /><br /><br />

				<?php
				}
				
				?>
				</td>
				 <td><a href="edit-courses.php?up_id=<?php echo $id;?>"> <i class="fas fa-edit"style="color:blue;margin-left:20px;"></i></a></td>
				<td><a href="courses.php?delete_id=<?php echo $id;?>"> <i class="fas fa-trash"style="color:red;margin-left:20px;"></i> </a></td>
				
				
	  <?php
			$counter++;
		}
			
	}
	else
		{
	?>
	<tr >
	<td colspan="11"> NO Data Available </td>
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