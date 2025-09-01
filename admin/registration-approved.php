 
<?php 
	require_once("lib/functions.php");
	$db = new login_function();
	$flag 			= 0;
	$success_msg 	= 0;
	$to_date 		= date('d-m-Y');
	$from_date 		= date('d-m-Y');
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
		
		 $db->delete_staff_registration($del_id);
		
		 $success_msg	=	2;
	}
	if(isset($_POST['search_btn']))
	{	
		$to_date		= $_POST['to_date'];
		$from_date		= $_POST['from_date'];
		$_SESSION['from_date']			=	$from_date;
		$_SESSION['to_date']			=	$to_date;
	}
	if(isset($_SESSION['from_date']) AND isset($_SESSION['to_date']) )
	{
		
		$from_date  = $_SESSION['from_date'];
		$to_date  	= $_SESSION['to_date'];
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
<div class="ibox">
							
<form class="form-pink" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" name="myForm" onsubmit="return validateForm()" autocomplete="off" enctype="multipart/form-data">

<div class="ibox-head">
<div class="ibox-title"><i class="fas fa-search" style="margin-right:10px;"></i>Search By </div>
</div>
<div class="ibox-body">
<div class="row">
<div class="col-sm-4 form-group mb-4">
<label class="form-group mb-4 set-row"><b>From Date</b></label>
	<div class="input-group-icon input-group-icon-left  set-row">
		<span class="input-icon input-icon-left"><i class="fas fa-edit"></i></span>
		<input type="text" name="from_date" class="form-control form-control-air" value="<?php echo $from_date; ?>" placeholder="Enter from_date" required id="from_date"  />
	</div>
</div>
<div class="col-sm-4 form-group mb-4">
<label class="form-group mb-4 set-row"><b>To Date</b></label>
	<div class="input-group-icon input-group-icon-left  set-row">
		<span class="input-icon input-icon-left"><i class="fas fa-edit"></i></span>
		<input type="text" name="to_date" class="form-control form-control-air" value="<?php echo $to_date; ?>" placeholder="Enter to_date" required id="to_date"  />
	</div>
</div>
 <div class="col-sm-4 form-group mb-4">
	<label class="form-group mb-4 set-row"><b>.</b></label> <br /> 
	<button class="btn btn-pink btn-air mr-2" type="submit" name="search_btn">Search</button>
</div>

</div>
</div>

</form>
</div>
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
		<div class="ibox-title"><i class="fas fa-user-tie" style="margin-right:10px;"></i>Registration Approved Report</div>
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
				<th>Other Mobile  No</th>
				<th>Address</th>
				<th>State</th>
				<th>City</th>
				<th>token</th>
				<th>Photo</th>
				<th>Sign</th>
				<th>Status</th>
				
                <th>Action</th>
            </tr>
		</thead>
		<tbody>
		<?php
			$report_details = $db->get_all_approved_registrations($from_date,$to_date);
			if(!empty($report_details))
			{
				$counter =0;
				foreach($report_details as $record)
				{
					$id				=	$report_details[$counter][0];
					$name			=	$report_details[$counter][1];
					$email			=	$report_details[$counter][2];
					$contact		=	$report_details[$counter][3];
					$status			=	$report_details[$counter][4];
					$password		=	$report_details[$counter][5];
					$other_mobile_no=	$report_details[$counter][6];
					$address		=	$report_details[$counter][7];
					$state			=	$report_details[$counter][8];
					$photo			=	$report_details[$counter][9];
					$sign			=	$report_details[$counter][10];
					$token			=	$report_details[$counter][11];
					$city			=	$report_details[$counter][12];
					
					
							
		?>
			<tr> 
				<td><?php echo $counter+1; ?></td>
				<td><?php echo $name; ?></td>
				<td><?php echo $email; ?></td>
				<td><?php echo $contact; ?></td>
				<td><?php echo $other_mobile_no; ?></td>
				<td><?php echo $address; ?></td>
				<td><?php echo $state; ?></td>
				<td><?php echo $city; ?></td>
				<td><?php echo $token; ?></td>
				<?php
				if($photo!="")
				{
				?>
				<td>
					<a href="../api/post_images/<?php echo $photo; ?>" target="_blank"><img src="../api/post_images/<?php echo $photo; ?>" height="50px" width="50px"></a>
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
				<?php
				if($sign!="")
				{
				?>
				<td>
					<a href="../api/post_images/<?php echo $sign; ?>" target="_blank"><img src="../api/post_images/<?php echo $photo; ?>" height="50px" width="50px"></a>
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
				<td><i class="fas fa-check"style="color:green;margin-left:20px;"></i></td>
				 <td><a href="registration-approved.php?delete_id=<?php echo $id;?>" onclick="return confirm('Are you sure For Delete This Record?');"><i class="fas fa-trash"style="color:red;margin-left:20px;"></i></a></td>
				
	  <?php
			$counter++;
		}
			
	}
	else
	{
	?>
	<tr >
	<td colspan="6"> NO Data Available </td>
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