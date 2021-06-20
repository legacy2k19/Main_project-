<?php
session_start();
$T_id=$_SESSION["T_id"];
$T_N=$_SESSION["T_Name"];
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
		<h2 class="u-name"><b><em>Teacher</em></b>
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
				<h4>Welcome <b><?php echo strtoupper($T_N)?></b></h4>
			</div>
			<ul>
				<li>
					<a href="adminhome.php">
						<i class="fa fa-desktop" aria-hidden="true"></i>
						<span>Profile</span>
					</a>
				</li>
				<li>
					<a href="downloadmaterials.php">
						<i class="fa fa-eye" aria-hidden="true"></i>
						<span>Materials</span>
					</a>
				</li>
				<li>
					<a href="viewteacher.php">
						<i class="fa fa-eye" aria-hidden="true"></i>
						<span> Exam</span>
					</a>
				</li>
				<li>
					<a href="#">
						<i class="fa fa-bell" aria-hidden="true"></i>
						<span>Notification</span>
					</a>
				</li>
				
				<li>
					<a href="">
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
			<table>

<form action="/action_page.php">
<tr>
  <td><label for="cars">subject</label>
  <select id="cars" name="cars">
  <option value="volvo">Choose subject</option>
    <option value="volvo">malayalam</option>
    <option value="saab">matha</option>
    <option value="fiat">english</option>
    <option value="audi">biology</option>
    <option value="audi">history</option>
    <option value="audi">geography</option>
    <option value="audi">chemistry</option>
    <option value="audi">physics</option>
    <option value="audi">hindi</option>
  </select></td>
  <tr>

</form>
</table>
		</section>
	</div>

</body>
</html>
