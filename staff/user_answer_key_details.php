<?php 
	require_once('../admin/lib/functions.php');
	$db		=	new login_function();
	
	if(isset($_SESSION['staff_login']))
	{
		$staff_login	=	$_SESSION['staff_login'];
	}
	if(!isset($_SESSION['staff_login']))
	{	
		header("location:../index.php");
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
	$to_date 		= date('d-m-Y');
	$from_date 		= date('d-m-Y');
	$question_paper	= "";
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
				  $select_staff	=	$_POST['select_staff'];
				 
				 if($flag==0)
				 {
					$db_id=$db->check_checked_status_assign_or_not($user_id,$question_id);
					
					if($db_id=='')
					{
						if($db->set_staff_for_answer_key($user_id,$question_id,$select_staff))
						{
							$success_msg=1;
						}
					}
					else
					{
						$success_msg=1;	
					}
					
					
					
				 } 
			}
		}	
			
	}
	
	
	if(isset($_POST['search_btn']))
	{	
		$to_date		= $_POST['to_date'];
		$from_date		= $_POST['from_date'];
		$question_paper	= $_POST['question_paper'];	
		$_SESSION['from_date']			=	$from_date;
		$_SESSION['to_date']			=	$to_date;
		$_SESSION['question_paper']		=	$question_paper;
	}
	if(isset($_SESSION['from_date']) AND isset($_SESSION['to_date']) )
	{
		
		$from_date  		= $_SESSION['from_date'];
		$to_date  			= $_SESSION['to_date'];
		$question_paper  	= $_SESSION['question_paper'];
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
	alert("Staff Assigned To Check Answer Sheet.....!!");
	window.location="user_answer_key_details.php";
 </script>
</div>
<?php
}
?>
<?php
if($success_msg==2)
{
?>
 <script>
	alert("Paper is Checked By Staff.....!!");
	window.location="user_answer_key_details.php";
 </script>
</div>
<?php
}
?>
<div class="page-content fade-in-up">
<!--<div class="ibox">
							
<form class="form-pink" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" name="myForm" onsubmit="return validateForm()" autocomplete="off" enctype="multipart/form-data">

<div class="ibox-head">
<div class="ibox-title"><i class="fas fa-search" style="margin-right:10px;"></i>Search By </div>
</div>
<div class="ibox-body">
<div class="row">
<div class="col-sm-3 form-group mb-3">
<label class="form-group mb-4 set-row"><b>From Date</b></label>
	<div class="input-group-icon input-group-icon-left  set-row">
		<span class="input-icon input-icon-left"><i class="fas fa-edit"></i></span>
		<input type="text" name="from_date" class="form-control form-control-air" value="<?php echo $from_date; ?>" placeholder="Enter from_date" required id="from_date"  />
	</div>
</div>
<div class="col-sm-3 form-group mb-3">
<label class="form-group mb-4 set-row"><b>To Date</b></label>
	<div class="input-group-icon input-group-icon-left  set-row">
		<span class="input-icon input-icon-left"><i class="fas fa-edit"></i></span>
		<input type="text" name="to_date" class="form-control form-control-air" value="<?php echo $to_date; ?>" placeholder="Enter to_date" required id="to_date"  />
	</div>
</div>
<input type="hidden" value="all" name="question_paper" >
<!--<div class="col-sm-3 form-group mb-3">
<label class="form-group mb-4 set-row"><b>Select  Question Paper </b></label>
<select class="form-control" style="width:100%;" name="question_paper">
<option value="all">All</option>
<?php
$data1	=	array();
$data1	=	$db->get_all_question_paper_details();

if(!empty($data1))
	{
		$counter =0;
		foreach($data1 as $record1)
		{
			$id						=	$recor1[0];
			$res_title				=	$record1[1];
			$res_attachment			=	$record1[2];
			$res_date				=	$record1[3];
			$res_time				=	$record1[4];
		
?>
<option value="<?php echo $id; ?>" <?php if($question_paper==$id){ ?> Selected <?php } ?>><?php echo $res_title; ?></option>
<?php
		$counter++;
	}
	
}
?>
</select>
</div>-
<div class="col-sm-3 form-group mb-3">
	<label class="form-group mb-4 set-row"><b>.</b></label> <br /> 
	<button class="btn btn-pink btn-air mr-2" type="submit" name="search_btn">Search</button>
</div>

</div>
</div>

</form>
</div>-->
<div class="ibox" style="border-radius:5px;padding:7px; height:1000px;">
	<div class="ibox-head">
		<div class="ibox-title">Student Answer Sheet</div>
	</div>	
	
	<div class="flexbox mb-4" style="margin-left:20px;margin-right:20px;margin-top:20px;">
		<div class="input-group-icon input-group-icon-left mr-3">
			<span class="input-icon input-icon-right font-16"><i class="fas fa-search"></i></span>
			<input class="form-control form-control-rounded form-control-solid" id="key-search" type="text" placeholder="Search ...">
		</div>
		
		
	</div>
		<form class="form-pink" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" name="myForm" onSubmit="return formSubmit();" autocomplete="off" enctype="multipart/form-data">

	<div class="table-wrapper-scroll-y table-wrapper-scroll-x my-custom-scrollbar">

	<div class="table-responsive" id="table_response" style="height:500px; width:100%; overflow:auto;">

	<table class="table table-bordered table-hover" id="example" >
	<thead class="thead-default thead-lg">
	<tr>
	<th>Sr.No</th>
	
	<th>Question Paper Title</th>
	<th>User Name</th>
	<th>User Contact Number</th>
	<th>Answer Sheet</th>
	
	</tr>
	</thead>
	<tbody>
	<?php

	$data	=	array();
	$data	=	$db->get_all_answer_keys_details_assign_to_staff($staff_login);

	if(!empty($data))
	{
		$counter =0;
		foreach($data as $record)
		{
			$res_user_id	=	$record[0];
			$res_question_id=	$record[1];
			$res_attachment=	$record[2];
			$db_question_title	=	$db->get_question_paper_title($res_question_id);
			
			$db_user_name	=	$db->get_user_name($res_user_id);
			$db_user_contact=	$db->get_user_contact_no($res_user_id);
			
			$staff_mobile_no=$db->check_staff_assign_or_not($res_user_id,$res_question_id);
			$checked_status=$db->check_checked_status_assign_or_not($res_user_id,$res_question_id);
			if($checked_status!='')
			{
				
				$checked_status="Checked";
			}
			else
			{
				$checked_status="Not Checked";
			}
			
			if($staff_mobile_no!='')
			{
				 $staff_name=$db->get_staff_name($staff_mobile_no);
				$assign_status="assign";
			}
			else
			{
				$assign_status="not_assign";
			}
			?>
			<tr> 
				<td><?php echo $counter+1; ?></td>
				
				<td><?php echo $db_question_title; ?></td>
				<td><?php echo $db_user_name; ?></td>
				<td><?php echo $db_user_contact; ?></td>
				<?php
					if($res_attachment!="")
					{
					?>
					<td style="text-align:center;">
						<a href="../answer-keys/<?php echo $res_attachment; ?>" target="_blank" ><img src="images/attachment.jpg" height="50px" width="50px"></a>
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
	
		<input type="hidden" name="total_rows" value="<?php echo $counter; ?>">
	</form>
	
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
	<script src="datatable/datatables.min.js"></script>
    <script src="js/app.min.js"></script>
	
</body>
</html>