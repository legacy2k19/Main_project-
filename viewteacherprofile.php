<?php
session_start();
$T_id=$_SESSION["T_id"];
$T_N=$_SESSION["T_Name"];
if(!isset($_SESSION['T_Name']))
{
	header("location:teacher.php");
}
?>
<!DOCTYPE html>
<html>
<head>

    <title>Teacher</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<style>
		table,td,th
		{
			
		}
		table
		{
			border-collapse: collapse;
			margin: 0 auto;
			width:80%;
		}
		td,th
		{
			text-align: center;
			border-radius: 10px 10px 10px 10px;
			height:40px;
		}
		tr:nth-child(even)
		{
			background-color:#c3e4d4;
		}
		tr:nth-child(odd)
		{
			background-color: powderblue;
		}
		tr:nth-child(1)
		{
			background-color: gray;
		}
		</style>
</head>
<body>
	<input type="checkbox" id="checkbox">
	<header class="header">
		<h2 class="u-name"><b><em>GUIDE</em></b>
			<label for="checkbox">
				<i id="navbtn" class="fa fa-bars" aria-hidden="true"></i>
			</label>
		</h2>
		<i  class="fa fa-user" aria-hidden="true"> </i>
	</header>
	<div class="body">
		<nav class="side-bar">
			<div class="user-p">
				<img src="assets/img/user.jpg">
				<h4>HI, <?php echo strtoupper($T_N)?></h4>
			</div>
			<ul>
				<li>
					<a href="viewteacherprofile.php">
						<i class="fa fa-desktop" aria-hidden="true"></i>
						<span>Profile</span>
					</a>
				</li>
				<li>
					
						<i class="fa fa-university" aria-hidden="true"></i>
						<span>Academics</span>
					
				</li>
				<li>
					<a href="uploadmaterials.php">
						<i class="fa fa-plus" aria-hidden="true"></i>
						<span> Add materials</span>
					</a>
				</li>
				<li>
					<a href="viewmaterials.php">
						<i class="fa fa-eye" aria-hidden="true"></i>
						<span> View Materials</span>
					</a>
				</li>
				<li>
					<a href="uploadassignment.php">
						<i class="fa fa-plus" aria-hidden="true"></i>
						<span>Add Assignments</span>
					</a>
				</li>
				
				<li>
					<a href="viewfeedback.php">
						<i class="fa fa-comment-o" aria-hidden="true"></i>
						<span>Feedback</span>
					</a>
				</li>
				<li>
					<a href="notification.php">
						<i class="fa fa-comment-o" aria-hidden="true"></i>
						<span>Alert</span>
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
			<?php
			require_once("classes/DataAccess.class.php");
			$dao = new DataAccess();
			$fields=array("T_Name","ID_Proof","Phone","Subject_Taken","T_Email");
			if($teachers = $dao->getData($fields,"tr_registration","T_id=$T_id"))
			{
			//var_dump(students);
			?>`
			<table>
			<tr>

			<th>Name</th>
			<th>ID_Proof</th>
			<th>Phone</th>
			<th>Subject</th>
			<th>Email</th>
			<th>Update</th>



			</tr>
			<?php
			foreach($teachers as $teacher)
			{
			?>
			<tr>

			<td><?php echo $teacher["T_Name"]; ?></td>
			<td><a href="ids/<?php echo $teacher["ID_Proof"]; ?>">Download</a></td>
			<td><?php echo $teacher["Phone"]; ?></td>

			<td><?php echo $teacher["Subject_Taken"]; ?></td>
			<td><?php echo $teacher["T_Email"];?></td>
			<td><a class="btn" href="updateprofile.php">update</a></td>



			</tr>

			<?php
			}

			?>

			</table>


			<?php
			}
			else
			{
			echo "<h3>No Teacher found ".$dao->getErrors()."</h3>";
			}


			?>
		</section>
	</div>

</body>
</html>
