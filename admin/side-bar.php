<style>
.table-responsive
{
	font-size:11px !important;
	width:100%;
}
tr th
{
	background-color:#DE1559 !important;
	color:#FFFFFF !important;
	font-size:12px;
	text-align:center;
}
tr td
{
	color:#000000 !important;
	font-size:12px;
	text-align:center;
}
.company_logo
{
	color:#DAAADB !important;
	font-size:12px !important;
	width:200px !important;
}
.company_logo:hover
{
	text-decoration:underline;
	color:#98E0AD !important;
}
.label_marg
{
	margin-bottom:4px !important;
	font-size:12px;
	color:#232B99;
}
.form-control
{
	color:#333 !important;
}
.ibox-title
{
	font-size:22px !important;
	color:#DE1559 !important;
}
.font-strong mb-4
{
	font-size:22px !important;
	color:#DE1559 !important;color:#DE1559 !important;
}
h5
{
	font-size:22px !important;
	color:#DE1559 !important;color:#DE1559 !important;
}
.content-wrapper
{
	padding-top:100px !important;
	background-image:url('images/background-image.jpg');
	background-size:100% 100%;
}
.ibox .ibox-head {
	border-bottom: 1px dotted #f75a5f !important;
}
.mb-4 
{
     margin-bottom: 0.5rem!important;
	 font-size:12px;
	 color:#232B99;	
}
.mb-6 
{
     margin-bottom: 0.5rem!important; 
	 font-size:12px;
	 color:#232B99;
}
.mb-12 
{
     margin-bottom: 0.5rem!important; 
	 font-size:12px;
	 color:#232B99;
}
</style>
<header class="header">
	<div class="page-brand" style="background-color:#000;">
		<a href="dashboard.php">
			<span class="brand" style="font-size:20px;">E-Tutor</span>
			<span class="brand-mini">E-Tutor</span>
		</a>
	</div>
	<div class="flexbox flex-1">
		<!-- START TOP-LEFT TOOLBAR-->
		<ul class="nav navbar-toolbar">
			<li>
				<a class="nav-link sidebar-toggler js-sidebar-toggler" href="javascript:;">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
			</li>
			<li>
				<!--<a class="nav-link search-toggler js-search-toggler"><i class="fas fa-search"></i>
					<span>Search here...</span>
				</a>-->
			</li>
		</ul>
	</div>
</header>
<nav class="page-sidebar" id="sidebar" style="background-color:#333333;">
	<div id="sidebar-collapse">
		<ul class="side-menu metismenu">
			<li>
				<a href="dashboard.php"><i class="sidebar-item-icon fas fa-home"></i>
				<span class="nav-label">Dashboards</span></a>
			</li>
			<li>
				<a href="question-paper.php"><i class="sidebar-item-icon fas fa-plus"></i>
				<span class="nav-label">Question Paper</span></a>
			</li>
			
			<li>
				<a href="registration-approved.php"><i class="sidebar-item-icon fas fa-user"></i>
				<span class="nav-label">Student Reg. Report</span></a>
			</li>
				
			<li>
			<a href="javascript:;"><i class="sidebar-item-icon fas fa-arrow-alt-circle-right"></i>
				<span class="nav-label">Testimonial</span><i class="fas fa-angle-left arrow"></i></a>
			<ul class="nav-2-level collapse">
				
				<li>
					<a href="testimonial-approved.php"><i class="sidebar-item-icon fas fa-check"></i>
					<span class="nav-label">Testimonial Approved</span></a>
				</li>
				<li>
					<a href="testimonial-pending.php"><i class="sidebar-item-icon fas fa-clock "></i>
					<span class="nav-label">Testimonial Pending</span></a>
				</li>
				
				</ul>
			</li>
			<li>
			<a href="javascript:;"><i class="sidebar-item-icon fas fa-user-graduate"></i>
				<span class="nav-label">Course Section</span><i class="fas fa-angle-left arrow"></i></a>
			<ul class="nav-2-level collapse">
				
				<li>
					<a href="add-courses.php"><i class="sidebar-item-icon fas fa-plus-circle"></i>
					<span class="nav-label">Add Course</span></a>
				</li>
				<li>
					<a href="courses.php"><i class="sidebar-item-icon fas fa-list "></i>
					<span class="nav-label">Course Report</span></a>
				</li>
				
				</ul>
			</li>
			
			<li>
			<a href="javascript:;"><i class="sidebar-item-icon fas fa-user-tie"></i>
				<span class="nav-label">Staff Section</span><i class="fas fa-angle-left arrow"></i></a>
			<ul class="nav-2-level collapse">
				
				<li>
					<a href="add-staff.php"><i class="sidebar-item-icon fas fa-plus-circle"></i>
					<span class="nav-label">Create Staff</span></a>
				</li>
				<li>
					<a href="staff-details.php"><i class="sidebar-item-icon fas fa-list "></i>
					<span class="nav-label">Staff Report</span></a>
				</li>
				
				</ul>
			</li>
			
			<li>
					<a href="notification.php"><i class="sidebar-item-icon fas fa-bell"></i>
					<span class="nav-label">Add Notification</span></a>
				</li>
				
				<li>
					<a href="change-password.php"><i class="sidebar-item-icon fas fa-user-cog"></i>
					<span class="nav-label">Change Password</span></a>
				</li>
			<li>
				<a href="contact-us-report.php"><i class="sidebar-item-icon fas fa-hand-point-right "></i>
				<span class="nav-label">Contact Us Report</span></a>
			</li>
			
			 
		<div class="sidebar-footer" style="background-color:#000;">
			<a href="index.php?logout"><i class="fas fa-power-off"></i></a>
			<a href="" class="company_logo">Software by <br /> Computer Department, BMP</a>
		</div>
	</div>
</nav>