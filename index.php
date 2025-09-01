<?php
	require_once('admin/lib/functions.php');
	$db		=	new login_function();
?>
<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>ETutor</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
    <!-- Normalize CSS -->
    <link rel="stylesheet" href="css/normalize.css">
    <!-- Main CSS -->
    <link rel="stylesheet" href="css/main.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="css/animate.min.css">
    <!-- Font-awesome CSS-->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Owl Caousel CSS -->
    <link rel="stylesheet" href="vendor/OwlCarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="vendor/OwlCarousel/owl.theme.default.min.css">
    <!-- Main Menu CSS -->
    <link rel="stylesheet" href="css/meanmenu.min.css">
    <!-- nivo slider CSS -->
    <link rel="stylesheet" href="vendor/slider/css/nivo-slider.css" type="text/css" />
    <link rel="stylesheet" href="vendor/slider/css/preview.css" type="text/css" media="screen" />
    <!-- Datetime Picker Style CSS -->
    <link rel="stylesheet" href="css/jquery.datetimepicker.css">
    <!-- Magic popup CSS -->
    <link rel="stylesheet" href="css/magnific-popup.css">
    <!-- Switch Style CSS -->
    <link rel="stylesheet" href="css/hover-min.css">
    <!-- ReImageGrid CSS -->
    <link rel="stylesheet" href="css/reImageGrid.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- Modernizr Js -->
    <script src="js/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- Add your site or application content here -->
    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    <!-- Main Body Area Start Here -->
    <div id="wrapper">
        <!-- Header Area Start Here -->
      <?php
		require_once('header.php');
	  ?>
        <!-- Header Area End Here -->
        <!-- Slider 1 Area Start Here -->
        <div class="slider1-area overlay-default index1">
            <div class="bend niceties preview-1">
                <div id="ensign-nivoslider-3" class="slides">
                    <img src="images/1.png" alt="slider" title="#slider-direction-1" />
                    <img src="images/2.png" alt="slider" title="#slider-direction-2" />
                    <img src="images/3.png" alt="slider" title="#slider-direction-3" />
					<img src="images/4.png" alt="slider" title="#slider-direction-3" />
					<img src="images/5.png" alt="slider" title="#slider-direction-3" />
                </div>
                <div id="slider-direction-1" class="t-cn slider-direction">
                    <div class="slider-content s-tb slide-1">
                        <div class="title-container s-tb-c">
                            <div class="title1">Best Education For Design</div>
                            <p>Emply dummy text of the printing and typesetting industry orem Ipsum has been the industry's standard
                                <br>dummy text ever sinceprinting and typesetting industry. </p>
                            <div class="slider-btn-area">
                                <a href="#" class="default-big-btn">Start a Course</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="slider-direction-2" class="t-cn slider-direction">
                    <div class="slider-content s-tb slide-2">
                        <div class="title-container s-tb-c">
                            <div class="title1">Best Education For HTML Template</div>
                            <p>Emply dummy text of the printing and typesetting industry orem Ipsum has been the industry's standard
                                <br>dummy text ever sinceprinting and typesetting industry. </p>
                            <div class="slider-btn-area">
                                <a href="#" class="default-big-btn">Start a Course</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="slider-direction-3" class="t-cn slider-direction">
                    <div class="slider-content s-tb slide-3">
                        <div class="title-container s-tb-c">
                            <div class="title1">Best Education Into PHP</div>
                            <p>Emply dummy text of the printing and typesetting industry orem Ipsum has been the industry's standard
                                <br>dummy text ever sinceprinting and typesetting industry. </p>
                            <div class="slider-btn-area">
                                <a href="#" class="default-big-btn">Start a Course</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Slider 1 Area End Here -->
        <!-- Service 1 Area Start Here -->
        <div class="service1-area">
            <div class="service1-inner-area">
                <div class="container">
                    <div class="row service1-wrapper">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 service-box1">
                            <div class="service-box-content">
                                <h3><a href="#">Scholarship Facility</a></h3>
                                <p>Eimply dummy text printing ypese tting industry.</p>
                            </div>
                            <div class="service-box-icon">
                                <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 service-box1">
                            <div class="service-box-content">
                                <h3><a href="#">Skilled Lecturers</a></h3>
                                <p>Eimply dummy text printing ypese tting industry.</p>
                            </div>
                            <div class="service-box-icon">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 service-box1">
                            <div class="service-box-content">
                                <h3><a href="#">Book Library & Store</a></h3>
                                <p>Eimply dummy text printing ypese tting industry.</p>
                            </div>
                            <div class="service-box-icon">
                                <i class="fa fa-book" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Service 1 Area End Here -->
        <!-- About 1 Area Start Here -->
        <div class="about1-area">
            <div class="container">
                <h1 class="about-title wow fadeIn" data-wow-duration="1s" data-wow-delay=".2s">Welcome To E-Tutor</h1>
				
				<a href="question-bank.php">
				<div style="color:orangered; font-weight:bold;">
					Browse The Question Banks, Which Will Help You For Exams<br />
					<img src="images/questionbank.png" style="height:100px;" />
					<br />
					Question Banks,Click Here
				</div>
				</a>
				
            </div>
        </div>
   
   <?php
	$title_search	=	"";
				if(isset($_POST['title_search']))
				{
					$title_search	=	$_POST['title_search'];
					$_SESSION['title_search']	=	$title_search;
				}
				else if(isset($_SESSION['title_search']))
				{
					$title_search	=	$_SESSION['title_search'];
				}
   ?>
        <!-- Lecturers Area Start Here -->
        <div class="lecturers-area" style="background-color:#EFEFEF;">
				<div style="width:100%; text-align:center; display:inline-table; ">
				<form action="index.php" method="post">
					
			<input type="text" placeholder="Search by title" class="form-control" name="title_search" id="form-name" value="<?php echo $title_search; ?>" data-error="Name field is required" required style="width:500px; display:inline-table;">

			<button type="submit" class="default-big-btn" style="display:inline-table;">Search</button>

			<div class="col-lg-8 col-md-8 col-sm-6 col-sm-12">
				<div class='form-response'></div>
			</div>
					
				</form>
				</div>
				<br /><br />
				
            <div class="container">
                <h2 class="title-default-left">Our Best Tutor Sessions-Lectures</h2>
            </div>
			
			
            <div class="container">
                <div class="rc-carousel" data-items="4" data-margin="30"  data-autoplay-timeout="10000" data-smart-speed="2000" data-dots="false" data-nav="true" data-nav-speed="false" data-r-x-small="1" data-r-x-small-nav="true" data-r-x-small-dots="false" data-r-x-medium="2" data-r-x-medium-nav="true" data-r-x-medium-dots="false" data-r-small="3" data-r-small-nav="true" data-r-small-dots="false" data-r-medium="4" data-r-medium-nav="true" data-r-medium-dots="false" data-r-large="4" data-r-large-nav="true" data-r-large-dots="false">
				
				
		<?php
			$report_details = $db->get_all_course_info_by_search($title_search);
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
			
					if(strlen($title)>20)
					{
						$title = substr($title,0,20);
					}
					
		?>
                    <div class="single-item" style="background-color:#FFF; padding:10px; height:400px; border:1px solid #DDDDDD;">
                        <div class="lecturers1-item-wrapper">
                            <div class="lecturers-img-wrapper" style="border-bottom:1px solid #DFDFDF;">
                                <a href="#"><img class="img-responsive" src="images/digital.jpg" alt="team"></a>
                            </div>
                            <div class="lecturers-content-wrapper">
                                <h3 class="item-title" style="font-size:15px;"><a href="#"><?php echo $title; ?></a></h3>
								<div style="text-align:left;">
                                <span>Duration : <?php echo $duration; ?></span><br />
								<span>Mode : <?php echo $mode; ?></span><br />
								
								<span>Fees : <?php echo $fees; ?></span><br />
								<span>Contact : <?php echo $contact_no; ?></span><br />
								<span>Description : <?php echo $description; ?></span>
								<br />
								<br />
								<center>
								<?php
									if($fees>0)
									{
								?>
								<a href="buy-now.php?tut_id=<?php echo $id; ?>" class="apply-now-btn" style="color:#333 !important; padding:5px !important;">Buy Now</a>
								<?php
									}
									else
									{
								?>
								<a href="gallery/<?php echo $image; ?>" target="_blank" class="apply-now-btn" style="color:#333 !important;padding:5px !important; width:80px;">View</a>
								<a href="gallery/<?php echo $image; ?>" download class="apply-now-btn" style="color:#333 !important;padding:5px !important; width:80px;">Download</a>
								<?php
									}
								?>
								</center>
								</div>
								
                                <!--<ul class="lecturers-social">
                                    <li><a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                </ul>-->
                            </div>
                        </div>
                    </div>
					
					 <?php
			$counter++;
		}
			
	}
   ?>
                
                </div>
            </div>
        </div>
      
	  <footer>
            
            <div class="footer-area-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <p>&copy; 2023 All Rights Reserved. &nbsp; </p>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <ul class="payment-method">
                                <li>
                                    <a href="#"><img alt="payment-method" src="img/payment-method1.jpg"></a>
                                </li>
                                <li>
                                    <a href="#"><img alt="payment-method" src="img/payment-method2.jpg"></a>
                                </li>
                                <li>
                                    <a href="#"><img alt="payment-method" src="img/payment-method3.jpg"></a>
                                </li>
                                <li>
                                    <a href="#"><img alt="payment-method" src="img/payment-method4.jpg"></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer Area End Here -->
    </div>
    <!-- Main Body Area End Here -->
    <!-- jquery-->
    <script src="js/jquery-2.2.4.min.js" type="text/javascript"></script>
    <!-- Plugins js -->
    <script src="js/plugins.js" type="text/javascript"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <!-- WOW JS -->
    <script src="js/wow.min.js"></script>
    <!-- Nivo slider js -->
    <script src="vendor/slider/js/jquery.nivo.slider.js" type="text/javascript"></script>
    <script src="vendor/slider/home.js" type="text/javascript"></script>
    <!-- Owl Cauosel JS -->
    <script src="vendor/OwlCarousel/owl.carousel.min.js" type="text/javascript"></script>
    <!-- Meanmenu Js -->
    <script src="js/jquery.meanmenu.min.js" type="text/javascript"></script>
    <!-- Srollup js -->
    <script src="js/jquery.scrollUp.min.js" type="text/javascript"></script>
    <!-- jquery.counterup js -->
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/waypoints.min.js"></script>
    <!-- Countdown js -->
    <script src="js/jquery.countdown.min.js" type="text/javascript"></script>
    <!-- Isotope js -->
    <script src="js/isotope.pkgd.min.js" type="text/javascript"></script>
    <!-- Magic Popup js -->
    <script src="js/jquery.magnific-popup.min.js" type="text/javascript"></script>
    <!-- Gridrotator js -->
    <script src="js/jquery.gridrotator.js" type="text/javascript"></script>
    <!-- Custom Js -->
    <script src="js/main.js" type="text/javascript"></script>
</body>

</html>
