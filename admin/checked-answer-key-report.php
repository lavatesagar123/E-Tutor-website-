<?php 
	require_once("lib/functions.php");
	$db 			= new login_function();
	
	if(!isset($_SESSION['current_login_admin']))
	{
		header("Location:/admin/index.php");
	}
	if(isset($_SESSION['current_login_admin']))
	{
		$email	=	$_SESSION['current_login_admin'];
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
	$select_staff	="";
	
	if(isset($_GET['edit_id']))
	{
		$edit_id	=	$_GET['edit_id'];
		$_SESSION['edit_id'] = $edit_id;
	}
	else if(isset($_SESSION['edit_id']))
	{
		$edit_id	= $_SESSION['edit_id'];
	}
	//FOR SET DB
	if(isset($_POST['staff_assign']))
	{
		$total_rows	=	$_POST['total_rows'];
		for($x=0;$x<$total_rows;$x++)
		{
			if(isset($_POST['count_'.$x]))
			{
				 
				
				  $user_id		=	$_POST['res_user_id_'.$x];
				  $question_id	=	$_POST['res_question_id_'.$x];
				  
				 
				 if($flag==0)
				 {
					//$db_id=$db->check_staff_assign_or_not($user_id,$question_id);
					
					//if($db_id=='')
					//{
						if($db->set_checked_status_for_answer_key($user_id,$question_id))
						{
							$success_msg=1;
						}
					//}
					else
					{
						$success_msg=1;	
					}
					
					
					
				 } 
			}
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
  
<div class="page-wrapper" style="height:1000px;">
<?php include('header.php'); ?>
<?php include('side-bar.php'); ?>
<div class="content-wrapper">
<?php
if($success_msg==1)
{
?>
 <script>
	alert("AnswerKey Checked .....!!");
	window.location="user_answer_key_details.php";
 </script>
</div>
<?php
}
?>
<?php
/*if($success_msg==2)
{
?>
 <script>
	alert("Staff Alerady Assigned To Check Answer Key.....!!");
	window.location="user_answer_key_details.php";
 </script>
</div>
<?php
}*/
?>
<div class="page-content fade-in-up">
<div class="ibox" style="border-radius:5px;padding:7px;">
	<div class="ibox-head">
		<div class="ibox-title">Checked Answer Key Report</div>
	</div>	
	
	<div class="flexbox mb-4" style="margin-left:20px;margin-right:20px;margin-top:20px;">
		<div class="input-group-icon input-group-icon-left mr-3">
			<span class="input-icon input-icon-right font-16"><i class="fas fa-search"></i></span>
			<input class="form-control form-control-rounded form-control-solid" id="key-search" type="text" placeholder="Search ...">
		</div>
		
		
	</div>
	
	<div class="table-wrapper-scroll-y table-wrapper-scroll-x my-custom-scrollbar">

	<div class="table-responsive" id="table_response" style="height:100%; width:100%; overflow:auto;">
	<form class="form-pink" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" name="myForm" onSubmit="return formSubmit();" autocomplete="off" enctype="multipart/form-data">

	<table class="table table-bordered table-hover" id="example" >
	<thead class="thead-default thead-lg">
	<tr>
	<th>Sr.No</th>
	<th>Question Paper Title</th>
	<th>User Name</th>
	<th>User Contact Number</th>
	<th>Action</th>
	 
	</tr>
	</thead>
	<tbody>
	<?php
	$counter=	0;
	$data	=	array();
	$data	=	$db->get_all_answer_keys_details_checked_by_staff();

	if(!empty($data))
	{
		$counter =0;
		foreach($data as $record)
		{
			$res_user_id	=	$record[0];
			$res_question_id=	$record[1];
			
			$db_question_title	=	$db->get_question_paper_title($res_question_id);
			
			$db_user_name	=	$db->get_user_name($res_user_id);
			$db_user_contact=	$db->get_user_contact_no($res_user_id);
			
			
			?>
			<tr> 
				<td><?php echo $counter+1; ?></td>
				<td><?php echo $db_question_title; ?></td>
				<td><?php echo $db_user_name; ?></td>
				<td><?php echo $db_user_contact; ?></td>
				<td>
					<a href="view-user-answers.php?user_id=<?php echo $res_user_id;?>&ques_id=<?php echo $res_question_id; ?>" style="color:green;"> View Individual Answer Keys
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


	?>
	</tr> 
	</tbody> 
	</table> 
	
	<?php
	/*if($counter>0)
	{
	?>
	<div class="row">
	
	<div class="col-sm-3 col-md-3 col-lg-3 form-group mb-4">
	<center>
	<input type="submit" class="btn btn-pink"  style="margin-left:300px;text-align:center;"  
	name="staff_assign" value="SUBMIT" onclick="return confirm('Are You Sure for Submit?');" >
	</center>
	</div>
	
	</div>
	<?php
	}*/
	?>
		<input type="hidden" name="total_rows" value="<?php echo $counter; ?>">
		</form>
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
	<script>
	$("#checkall").click(function()
	{
	$('input:checkbox').not(this).prop('checked', this.checked);

	});		
	</script>
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