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
	
	$link_title="";
	$link	   ="";
	$SuccessMsg="";
	$profile_error="";
	if(isset($_GET['edit_id']))
	{
		$edit_id					=	$_GET['edit_id'];
		$_SESSION['edit_id']		=	$edit_id;
	}

	if(isset($_SESSION['edit_id']))
	{
		$edit_id		=	$_SESSION['edit_id'];
	}
	
	
	
	
	if(isset($_POST['update']))
	{
		$link_title	=	$_POST['link_title'];
		$link		=	$_POST['link'];
		

		if($db->update_link($link_title,$link,$edit_id))
		{
			$SuccessMsg = 1;
		} 
		else
		{
			$SuccessMsg = 2;
		}
	}
	

	if(isset($_POST['update_image']))
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
						
						$img_Dir = "icon/";
						
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
	
		$image_name = $db->get_icon_from_link($edit_id);
		if($image_name!="")
		{
			$db->update_icon_in_link($edit_id,$actual_image_name);
			unlink('icon/'.$image_name);
			 $SuccessMsg=3;
		}
		else
		{
			$db->update_icon_in_link($edit_id,$actual_image_name);
			
			 $SuccessMsg=3;
		}
		
	}	
		
	}
	if(isset($_GET['remove_image']))
	{
		 $image_name = $db->get_icon_from_link($edit_id);
		 $db->delete_icon_from_link($edit_id);
		 unlink('icon/'.$image_name);
		 header("location:update-link.php");
		 $SuccessMsg=4;
	}
	$data = array();
	$data	=	$db->get_link_details_by_id($edit_id);
	
	if(!empty($data))
	{
		$res_id 		=	$data[0];
		$link_title		=	$data[1];
		$link			=	$data[2];
		$icon			=	$data[3];
		
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
.col-md-8
{
	width:100%;
	margin:auto;
	margin-top:20px;
}

@media only screen and (max-width: 600px) {
	.col-md-8
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
    <div class="page-wrapper">
        <?php include('header.php'); ?>
        <?php include('side-bar.php'); ?>
			<div class="content-wrapper">
               <div class="row">
                    <div class="col-md-8">
						<?php 
						if($SuccessMsg == 1)
						{
						?>
						<div class="alert alert-pink">
							<span class="alert-link">Successfully ! </span> Record Updated...
						</div>	
						<?php 
						} 
						?>
						<?php 
						if($SuccessMsg == 3)
						{
						?>
						<div class="alert alert-success">
							<span class="alert-link">Successfully ! </span> Image Updated...
						</div>	
						<?php 
						} 
						?>
						<?php 
						if($SuccessMsg == 4)
						{
						?>
						<div class="alert alert-success">
							<span class="alert-link">Successfully ! </span>Image Removed...
						</div>	
						<?php 
						} 
						?>
                        <div class="ibox">
							
                            <form class="form-pink" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" name="myForm" onsubmit="return validateForm()" autocomplete="off">
								
                                <div class="ibox-head">
                                    <div class="ibox-title">Update Link Details</div>
                                </div>
                                <div class="ibox-body">
                                    <div class="row">
                                           <div class="col-sm-6 form-group mb-6">
											<label class="form-group mb-4 set-row"><b>Enter Title</b></label>
											<div class="input-group-icon input-group-icon-left  set-row">
												<span class="input-icon input-icon-left"><i class="fas fa-chalkboard-teacher"></i></span>
												<input type="text" name="link_title" class="form-control form-control-air" value="<?php echo $link_title; ?>" placeholder="Enter Title" required />
											</div>
										</div>
										 <div class="col-sm-6 form-group mb-6">
											<label class="form-group mb-4 set-row"><b>Enter Link</b></label>
											<div class="input-group-icon input-group-icon-left  set-row">
												<span class="input-icon input-icon-left"><i class="fas fa-chalkboard-teacher"></i></span>
												<input type="text" name="link" class="form-control form-control-air" value="<?php echo $link; ?>" placeholder="Enter Link" required />
											</div>
										</div>
									 
										<div class="col-sm-2 form-group mb-4">
										<br />
										<br />
											<button class="btn btn-pink btn-air mr-2" type="submit" name="update">Update Link</button>
										</div>
									</div>
								</div>
								
                             </form>
							 <!--UPDATE ICON-->
							  <form class="form-pink" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" name="myForm" onsubmit="return validateForm()" autocomplete="off" enctype="multipart/form-data" >
								
                               
                                <div class="ibox-body">
                                    <div class="row">
                                        <div class="form-group mb-4">
											<label class="form-group mb-4"><b>Update Icon</b></label>
											<div class="input-group-icon input-group-icon-left  set-row">
												<?php
											if($icon != "")
											{
								
											?>
											<a href="icon/<?php echo $icon; ?>" target="_blank"><img src="icon/<?php echo $icon; ?>" height="50px" width="50px" title="view"></a><br /><br />
											
											<?php
											}
											
											else
											{
											?>
											<img src="icon/no-image.png" style="height:90px;width:200px;" /><br /><br />

											<?php
											}
											?>
											<label><a href="<?php echo $_SERVER['PHP_SELF']."?remove_image"; ?>">Remove Image</a></label>
                                            <br /><br />
											 <input class="form-control form-control-air " placeholder="Enter Name" name="picture" type="file" required>
											</span> 
											</div>
										</div>
									 
										<div class="col-sm-12 form-group mb-4">
										<br />
										<br />
											<button class="btn btn-success btn-air mr-2" type="submit" name="update_image">Update Icon</button>
										</div>
									</div>
								</div>
								
                             </form>
							<center><a href="add-link.php" style="text-decoration:underline;" >Back</a></center>
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
                pageLength: 30,
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