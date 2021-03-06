<?php
session_start();

$S_Name=$_SESSION["S_Name"];
if(!isset($_SESSION['S_Name']))
{
	header("location:student.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Online Leaning Portal</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
	<input type="checkbox" id="checkbox">
	<header class="header">
		<h2 class="u-name"><b><em>Student</em></b>
			<label for="checkbox">
				<i id="navbtn" class="fa fa-bars" aria-hidden="true"></i>
			</label>
		</h2>
		<i class="fa fa-user" aria-hidden="true"></i>
	</header>
	<div class="body">
		<nav class="side-bar">
			<div class="user-p">
				<img src="assets/img/user.jpg">
				<h4>Welcome <b><?php echo strtoupper($S_Name)?></b></h4>
			</div>
			<ul>
				
				<li>
					<a href="downloadmaterials.php">
						<i class="fa fa-eye" aria-hidden="true"></i>
						<span>Materials</span>
					</a>
				</li>
				
				<li>
					<a href="viewAlert.php">
						<i class="fa fa-bell" aria-hidden="true"></i>
						<span>Notification</span>
					</a>
				</li>
				
				<li>
					<a href="feedback.php">
						<i class="fa fa-comment-o" aria-hidden="true"></i>
						<span>Feedback</span>
					</a>
				</li>
				<li>
					<a href="logout.php">
						<i class="fa fa-sign-out" aria-hidden="true"></i>
						<span>Logout</span>
					</a>
				</li>
				
			</ul>
		</nav>
		</nav>
		<section class="section-1">
			
		</section>
	</div>

</body>
</html>
