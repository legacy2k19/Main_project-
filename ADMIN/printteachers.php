
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
			<?php
			require_once("classes/DataAccess.class.php");
			$dao = new DataAccess();
			if(isset($_POST["id"]))
			{
			$id=$_POST["id"];
			if(isset($_POST["block"]))
			{
			$data["Status"]="B";
			}
			elseif (isset($_POST["unblock"]))
			{
			$data["status"]="A";
			}
			else
			{
			
			}
			if($dao->update($data,"tr_registration","T_id=$id"))
			{
			$msg="success!";
			}
			}
			
			if($teachers = $dao->getData("*","tr_registration"))
			{
			//var_dump(students);
			?>
			<table>
			<tr>

			<th>Name</th>
			<th>ID Proof </th>
			<th>Contact Number</th>
			<th>Subject</th>
			<th>Email</th>
			<th>Status</th>



			</tr>
			<?php
			foreach($teachers as $teacher)
			{
			?>
			<form method="POST">
			<tr>
			<input type="hidden" name="id" value="<?php echo $teacher["T_id"];?>">
			<td><?php echo $teacher["T_Name"]; ?></td>
			<td><?php echo $teacher["ID_Proof"]; ?></td>
			<td><?php echo $teacher["Phone"]; ?></td>
			<td><?php echo $teacher["Subject_Taken"]; ?></td>
			<td><?php echo $teacher["T_Email"]; ?></td>
			
			<td>
			<?php
											if($teacher["Status"]=="A")
											{
											?>
											<input type="submit" name="block" value="block"/>
											<?php
											}
											if($teacher["Status"]=="B")
											{
											?>
			<input type="submit" name="unblock" value="unblock"/></td>
											<?php
											}
											?>

			</tr>
			</form>

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
			<center><a href="printteachers.php">PRINT</a></center>
			<script>
			document.getElementById("print").onclick=function()
			{
			window.print();
			};
			</script>
	
	</div>

</body>
</html>
