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
	
	$class_name="";
	$SuccessMsg="";
	$subject="";
	$chapter="";
	$topic="";
	if(isset($_GET['del_id']))
	{
		$delete_id	=	$_GET['del_id'];
		
		if($db->delete_contact_record($delete_id))
		{
			
			$SuccessMsg = 3;
		}
	}
	
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Contact Us Report</title>
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


<script>
function validateForm() {
  var a = document.forms["myForm"]["class_name"].value;
  var b = document.forms["myForm"]["subject"].value;
  var c = document.forms["myForm"]["chapter"].value;
  var d = document.forms["myForm"]["topic"].value;
 
  if (a == "" || a=="Select") {
    alert("Please Select Class");
    return false;
  }
  if (b == "" || b=="Select") {
    alert("Please Select Subject");
    return false;
  }
  if (c == "" || c=="Select") {
    alert("Please Select Chapter");
    return false;
  }
  if (d == "") {
    alert("Enter Topic");
    return false;
  }
}
</script>


</head>

<body class="fixed-navbar">
<div class="page-wrapper">
<?php include('header.php'); ?>
<?php include('side-bar.php'); ?>
<div class="content-wrapper">
<div class="row">
<div class="col-md-12">
<?php 
if($SuccessMsg == 3)
{
?>
<div class="alert alert-pink">
<span class="alert-link">Successfully ! </span> Record Deleted...
</div>	
<?php 
} 

?>

<div class="page-content fade-in-up">
<div class="ibox">
<div class="ibox-body">
<h5 class="font-strong mb-4">Contact Us Report</h5>
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
	<th>Full Name</th> 
	<th>Email</th> 
	<th>Contact No</th> 
	<th>Meaasge</th> 
	
	<th>Delete</th> 
	
</tr>
</thead>
<tbody>
<?php
$data	=	array();
$data	=	$db->get_all_contact_us_details();

if(!empty($data))
{
	$counter=0;
	foreach($data as $record)
	{
		$res_id				=	$record[0];
		$full_name			=	$record[1];
		$email				=	$record[2];
		$contact_no			=	$record[3];
		$message			=	$record[4];
		$date				=	$record[5];
		$time				=	$record[6];
		
		$date_data = explode("-",$date);
	
		$date = $date_data[2]."-".$date_data[1]."-".$date_data[0];
		
		
		?>
		<tr> 
			<td><?php echo $counter+1; ?></td>
			<td><?php echo $full_name; ?></td>
			<td><?php echo $email; ?></td>
			<td><?php echo $contact_no; ?></td>
			<td><?php echo $message; ?></td>
			<td><a href="contact-us-report.php?del_id=<?php echo $res_id; ?>" onclick="return confirm('Are you Sure to Delete This record?');"><i class="fas fa-trash"style="color:red;margin-left:20px;"></i></td>								
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
                <?php include('footer.php'); ?>
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
                pageLength: 25,
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