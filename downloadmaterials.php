<?php
session_start();
$S_id=$_SESSION["Reg _id"];
$S_Name=$_SESSION["S_Name"];
?>

<!DOCTYPE html>
<html>
<head>
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
				<h4>Welcome, <?php echo strtoupper($S_Name)?></h4>
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
		<section class="section-1">
		<?php 
			require_once("classes/DataAccess.class.php");
			$dao = new DataAccess();
			$fields=array("Module","Materials","sub_id");
			if($materials = $dao->getData($fields,"tbl_material"))
			{
				//var_dump(students);
				?>
					<table>
						<tr>
							
							<th>Module</th>
							<th>Subject</th>
							<th>Materials</th>
							
							
							

							
						</tr>
						<?php
						foreach($materials as $material)
						{
							?>
							<tr>
								
								<td><?php echo $material["Module"]; ?></td>
								<td><?php echo $material["sub_id"]; ?></td>
								<td><a href="materials/<?php echo $material["Materials"]; ?>">Download</a></td>
								
								

							</tr>

							<?php
						}

						?>

					</table>


				<?php
			}
			else
			{
				echo "<h3>No Materials found ".$dao->getErrors()."</h3>";
			}


		?>
		
		</section>
	</div>

</body>
</html>
