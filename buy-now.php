<?php
require_once('admin/lib/functions.php');
$db		=	new login_function();


if(isset($_GET['tut_id']))
{
 $tut_id=$_GET['tut_id'];
 $_SESSION['tut_id']=$tut_id;
}
$tut_id=$_SESSION['tut_id'];

$report_details = $db->get_all_course_info_by_id($tut_id);
if(!empty($report_details))
{
	$counter =0;
	$id				=	$report_details[$counter][0];
	$c_type			=	$report_details[$counter][1];
	$title			=	$report_details[$counter][2];
	$duration		=	$report_details[$counter][3];
	$mode			=	$report_details[$counter][4];
	$description	=	$report_details[$counter][5];
	$fees			=	$report_details[$counter][6];
	$contact		=	$report_details[$counter][7];
	$image			=	$report_details[$counter][8];
}


if(isset($_POST['submit_btn']))
{
	$payment_type = $_POST['payment_type'];
	$payment_amount = $_POST['payment_amount'];
	$payment_description = $_POST['payment_description'];
	$purchase_by = $_SESSION['user_login'];
	
	if($db->add_order($payment_type,$payment_amount,$payment_description,$tut_id,$purchase_by))
	{
?>
<script>
	alert("Your order placed successsfully.. You can access this tutorial in your account.");
	window.location="index.php";
</script>
<?php		
	}
}
?>
<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>E-Tutor</title>
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
    <div id="wrapper">
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
										<li><a href="student/">Student</a></li>
										<li><a href="staff/">Staff</a></li>
										<li><a href="contact.php">Contact Us</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		
        <!-- Contact Us Page 2 Area Start Here -->
        <div class="contact-us-page2-area" style="margin-top:50px;">
            <div class="container">
                <div class="row">
                   
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <h2 class="title-default-left title-bar-high">Buy Now</h2>
                            </div>
							
							<div style="color:purple; font-size:25px; background-color:#EFEFEF; display:inline-table; width:500px; padding:15px;">
								<?php
									echo "Title : ".$title;
								?>
								<div style="font-size:15px; color:#2BC469;">
								<span>Duration : <?php echo $duration; ?></span><br />
								<span>Mode : <?php echo $mode; ?></span><br />
								
								<span>Fees : <?php echo $fees; ?></span><br />
								
								<span>Description : <?php echo $description; ?></span>
								</div>
								<br />
							</div>
                        </div>
                        <div class="row">
                            <div class="contact-form2">
							<?php
								if(!isset($_SESSION['user_login']))
								{
									?>
							<div style="color:red; margin-bottom:25px;">You are not logged in as student to account.. please login to buy this tutorial</div>		
							</br />
							<a href="user/">Student Login ---->></a>
							
									<?php
								}
								else
								{
							?>
							<div style="color:green; margin-bottom:25px;">You are buying this tutorial under <?php echo $_SESSION['user_login']; ?> account</div>
							
                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                    <fieldset>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <select class="form-control" name="payment_type">
													<option value="Select">Select</option>
													<option value="UPI ID">UPI ID</option>
													<option value="Net Banking">Net Banking</option>
												</select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" placeholder="Enter payment UPI Id/Net Baking ID" class="form-control" name="payment_description" id="form-email" required>
                                            </div>
                                        </div>
										
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
												Price : 
                                                <input type="text" readonly placeholder="Enter amount" class="form-control" name="payment_amount" value="<?php echo $fees; ?>" required>
                                            </div>
                                        </div>
										
                                        <br /><br /><br /><br />
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-sm-12">
                                            <div class="form-group margin-bottom-none">
                                                <input type="submit" name="submit_btn" class="default-big-btn" value="Pay Now" />
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
								<?php		
								}
							?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         
        </div>


<br />
<br />
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
    </div>
    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->
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
    <!-- Google Map js -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgREM8KO8hjfbOC0R_btBhQsEQsnpzFGQ"></script>
    <!-- Validator js -->
    <script src="js/validator.min.js" type="text/javascript"></script>
    <!-- Magic Popup js -->
    <script src="js/jquery.magnific-popup.min.js" type="text/javascript"></script>
    <!-- Custom Js -->
    <script src="js/main.js" type="text/javascript"></script>
</body>

</html>
