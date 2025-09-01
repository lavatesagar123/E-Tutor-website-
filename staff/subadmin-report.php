 
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
$SuccessMsg			=0;
$fullname			= "";
$user_id     		="";
if(isset($_GET['del']))
{
	$del	=	$_GET['del'];
	
	$db->delete_franchise($del);
	$SuccessMsg=3;
}
	
if(isset($_GET['block']))
{
	$block	=	$_GET['block'];
	
	$db->update_block_status($block);
}

if(isset($_GET['active']))
{
	$active	=	$_GET['active'];
	
	$db->update_active_status($active);
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

<div class="page-wrapper" style="height:800px;">

<?php include('header.php'); ?>
<?php include('side-bar.php'); ?>

<div class="content-wrapper">
<div class="page-content fade-in-up">
<div class="ibox" style="border-radius:5px; padding:7px;">

<div class="ibox-body" style="padding:7px; padding-top:0px;">
	
	<div class="ibox-head">
		<div class="ibox-title"><i class="fas fa-user-tie" style="margin-right:10px;"></i>Report</div>
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
				<th>Reg No.</th>
				<th>Application Name</th> 	
				<th>Full Name</th> 
				<th>Address</th> 
				<th>Mobile No.</th> 
				<th>User ID</th> 
				<th>Password</th> 
				<th>Status</th> 
				<th>Edit</th> 
				<th>Delete</th> 
				<th>Action</th> 
			</tr>
		</thead>
		<tbody>
		<?php
			$data	=	array();
			$data	=	$db->get_franchise_details($fullname,$user_id);
			
			if(!empty($data))
				{
					$counter =0;
					foreach($data as $record)
					{
						$id					=	$record[0];
						$res_fullname		=	$record[1];
						$res_address		=	$record[2];
						$res_mobile			=	$record[3];
						$res_service_area	=	$record[4];
						$res_user_id		=	$record[5];
						$res_password		=	$record[6];
						$res_status			=	$record[7];
						$res_date			=	$record[8];
						$res_time			=	$record[9];
							
				?>
					<tr> 
				<td><?php echo $counter+1; ?></td>
				<td><?php echo $id; ?></td>
				<td><?php echo $res_service_area; ?></td>
				<td><?php echo $res_fullname; ?></td> 
				<td><?php echo $res_address; ?></td> 
				<td><?php echo $res_mobile; ?></td>
				<td><?php echo $res_user_id; ?></td>
				<td><?php echo $res_password; ?></td>
				<td><?php echo $res_status; ?></td>
				<td>
					<a  style="width:50px;padding:0px;" href="edit-subadmin.php?edit_id=<?php echo $id; ?>">
					<i style="color:#085820; margin-left:20px;" class="fas fa-edit"></i> 
				</td>
				<td>
					<a style="width:50px;padding:0px;" href="subadmin-report.php?del=<?php echo $id; ?>" onclick="return confirm('Are You Sure To Delete the Subadmin ?');">
					<i class="fas fa-trash"style="color:red;margin-left:20px;"></i>
				</td>
				<td>
				<?php
				if($res_status=="Active")
				{
					?>
						<center><a style="width:50px;padding:0px;" href="report-frenchies.php?block=<?php echo $id;?>" onclick="return confirm('Are You Sure To Block the Franchisor ?');">Block</a></center>
					<?php
				}
				else
				{
					?>
						<center><a style="width:50px;padding:0px;" href="report-frenchies.php?active=<?php echo $id;?>" onclick="return confirm('Are You Sure To Active the Franchisor ?');">Active</a></center>
					<?php
				}
				
				?>
				<?php
			$counter++;
		}
			
	}
	else
	{
	?>
	<td colspan="4">No Data Found...</td>
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
		<?php include('footer.php'); ?>
	</div>
</div>
<?php //include('search.php'); ?>
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
<?php //include('right-side-bar.php'); ?>
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
<script src="datatable/datatables.min.js"></script>
<script src="js/app.min.js"></script>
<script>
$(function() {
	$('#example').DataTable({
		pageLength: 50,
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