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
   
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    <!-- Main Body Area Start Here -->
    <div id="wrapper" style="min-height:700px;">
        <!-- Header Area Start Here -->
        <header>
            <div id="header1" class="header1-area">
                <div class="main-menu-area bg-primary" id="sticker">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-3">
                                <div class="logo-area">
                                    <a href="index.html"><img class="img-responsive" src="images/logo.png" alt="logo"></a>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-9">
                                <nav id="desktop-nav">
                                    <ul>
                                        <li class="active"><a href="#">Home</a></li>
										<li><a href="#">About Us</a></li>
										<li><a href="student/index.php">Student</a></li>
										<li><a href="staff/">Staff</a></li>
										<li><a href="contact.php">Contact Us</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu Area Start -->
            <div class="mobile-menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mobile-menu">
                                <nav id="dropdown">
                                    <ul>
                                        <li><a href="#">Home</a>
                                            <ul>
                                                <li><a href="index.html">Home 1</a></li>
                                                <li><a href="index2.html">Home 2</a></li>
                                                <li><a href="index3.html">Home 3</a></li>
                                                <li><a href="index4.html">Home 4</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">Pages</a>
                                            <ul>
                                                <li><a href="about1.html">About 1</a></li>
                                                <li><a href="about2.html">About 2</a></li>
                                                <li><a href="about3.html">About 3</a></li>
                                                <li><a href="about4.html">About 4</a></li>
                                                <li><a href="lecturers1.html">lecturers 1</a></li>
                                                <li><a href="lecturers2.html">lecturers 2</a></li>
                                                <li><a href="single-lecturers.html">lecturers Details</a></li>
                                                <li><a href="pricing1.html">Pricing Plan 1</a></li>
                                                <li><a href="pricing2.html">Pricing Plan 2</a></li>
                                                <li><a href="shop1.html">Shop 1</a></li>
                                                <li><a href="shop2.html">Shop 2</a></li>
                                                <li><a href="single-shop.html">Shop Details</a></li>
                                                <li><a href="faq.html">Faq</a></li>
                                                <li><a href="404.html">404 Error</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">Courses</a>
                                            <ul>
                                                <li><a href="courses1.html">Courses 1</a></li>
                                                <li><a href="courses2.html">Courses 2</a></li>
                                                <li><a href="courses3.html">Courses 3</a></li>
                                                <li><a href="single-courses1.html">Course Details 1</a></li>
                                                <li><a href="single-courses2.html">Course Details 2</a></li>
                                                <li><a href="single-courses3.html">Course Details 3</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">Research</a>
                                            <ul>
                                                <li><a href="research1.html">Research 1</a></li>
                                                <li><a href="research2.html">Research 2</a></li>
                                                <li><a href="research3.html">Research 3</a></li>
                                                <li><a href="single-research.html">Research Details</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">News</a>
                                            <ul>
                                                <li class="has-child-menu"><a href="#">News</a>
                                                    <ul class="thired-level">
                                                        <li><a href="news1.html">News 1</a></li>
                                                        <li><a href="news2.html">News 2</a></li>
                                                        <li><a href="single-news.html">News Details</a></li>
                                                    </ul>
                                                </li>
                                                <li class="has-child-menu"><a href="#">Event</a>
                                                    <ul class="thired-level">
                                                        <li><a href="event.html">Event</a></li>
                                                        <li><a href="single-event.html">Event Details</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a href="#">Gallery</a>
                                            <ul>
                                                <li><a href="gallery1.html">Gallery 1</a></li>
                                                <li><a href="gallery2.html">Gallery 2</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">Contact</a>
                                            <ul>
                                                <li><a href="contact1.html">Contact 1</a></li>
                                                <li><a href="contact2.html">Contact 2</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu Area End -->
        </header>
        <!-- Header Area End Here -->
  
        <!-- About 1 Area Start Here -->
        <div class="about1-area">
            <div class="container">
				<br />
                <h1 class="about-title wow fadeIn" data-wow-duration="1s" data-wow-delay=".2s">Question Banks</h1>
				
				<h4>Download Question Banks From Here</h4>
            </div>
        </div>
   
   
			<table class="table table-bordered table-hover" id="example" style="width:80%; margin:auto; text-align:center;">
			<thead class="thead-default thead-lg">
				<tr>
					<th style="text-align:center;">Sr.No</th>
					<th style="text-align:center;">Title</th> 
					<th style="text-align:center;">Attachment</th>
					<th style="text-align:center;">Posted On</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$data	=	array();
				$data	=	$db->get_all_question_paper_details();
				
				if(!empty($data))
					{
						$counter =0;
						foreach($data as $record)
						{
							$id						=	$record[0];
							$res_title				=	$record[1];
							$res_attachment			=	$record[2];
							$res_date				=	$record[3];
							$res_time				=	$record[4];
							
							
							$date_data = explode("-",$res_date);
							$date = $date_data[2]."-".$date_data[1]."-".$date_data[0];
							
							?>
							<tr> 
								<td><?php echo $counter+1; ?></td>
								<td style="text-align:left;"><?php echo $res_title; ?></td>
								
								<?php
									if($res_attachment!="")
									{
									?>
									<td>
										<a href="question-papers/<?php echo $res_attachment; ?>" target="_blank"><img src="images/attachment.jpg" height="30px" width="30px"></a>
										<br />
										<a href="question-papers/<?php echo $res_attachment; ?>" download style="color:orangered;">Download</a>
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
								<td><?php echo $date; ?><br /><?php echo $res_time; ?></td>
							
								
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
